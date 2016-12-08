<?php

namespace App\Http\Controllers;

use App\Attendance;
use App\Clazz;
use App\Group;
use App\Institute;
use App\Student;
use App\University;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class GroupController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware(['auth', 'student']);
        $this->middleware(['steward'], ['only' => ['edit', 'delete', 'update', 'destroy']]);
    }

    public function index()
    {
        /* @var Student $student */
        $student = auth()->user()->student;
        $groups = [];
        foreach ($student->groups()->select(['id', 'name', 'steward_id'])->get()->all() as $group) {
            $groups[$group->id] = $group;
        }
        foreach ($student->stewarded()->select(['id', 'name', 'steward_id'])->get()->all() as $group) {
            $groups[$group->id] = $group;
        }
        ksort($groups);
        return view('group.index', compact('groups', 'student'));
    }

    public function create(Request $request)
    {
        if ($request->ajax()) {
            return $this->create_ajax($request);
        }

        $group = new Group();
        $supers = [];
        $student = auth()->user()->student;
        $supers[null] = 'НЕТ';
        foreach (Group::roots()->all() as $el) {
            $supers[$el->id] = $el->name;
        }
        foreach ($student->stewarded->all() as $el) {
            $supers[$el->id] = $el->name;
        }
        $universities = [
            null => 'Выберите университет'
        ];
        foreach (University::all() as $university) {
            $universities[$university->id] = $university->name;
        }

        return view('group.create', compact('group', 'supers', 'universities'));
    }

    private function create_ajax(Request $request)
    {
        if ($request->has('super_id')) {
            $super = Group::find($request->get('super_id'));
            if ($super) {
                return [
                    'university_id' => $super->cathedra->institute->university_id,
                    'institute' => $super->cathedra->institute->name,
                    'cathedra' => $super->cathedra->name,
                ];
            }
            abort(404);
        } else if ($request->has('university_id')) {
            $university = University::find($request->get('university_id'));
            if ($university) {
                $list = [];
                foreach ($university->institutes as $el) {
                    $list[$el->id] = $el->name;
                }
                return $list;
            }
            abort(404);
        } else if ($request->has('institute_id')) {
            $institute = Institute::find($request->get('institute_id'));
            if ($institute) {
                $list = [];
                foreach ($institute->cathedras as $el) {
                    $list[$el->id] = $el->name;
                }
                return $list;
            }
            abort(404);
        }
    }

    public function show(Group $group)
    {
        $student_id = auth()->user()->student->id;
        $steward_id = $group->steward_id;
        $canEdit = $steward_id == $student_id;
        $studentColor = function ($id) use ($steward_id, $student_id) {
            if ($id == $steward_id) {
                return 'success';
            }
            if ($id == $student_id) {
                return 'warning';
            }
            return '';
        };

        return view('group.show', compact('group', 'studentColor', 'canEdit'));
    }

    public function edit(Group $group)
    {
        $this->restrictSteward($group);
        return view('group.edit', compact('group'));
    }

    private function restrictSteward(Group $group)
    {
        if ($group->steward_id != auth()->user()->student_id) {
            abort(403, 'Для того, что бы зайти на эту страницу необходимо быть старостой этой группы');
        }
    }

    public function delete(Group $group)
    {
        $this->restrictSteward($group);
        return view('group.delete', compact('group'));
    }

    public function stat(Group $group)
    {
        $weeks = [];
        $stats = [];


        $students = $group->students()->get(['id', 'name']);

        $student_ids = array_unique(array_map(function ($el) {
            return $el->id;
        }, $students->all()));
        $attendances = Attendance::whereIn('student_id', $student_ids)->get(['class_id', 'student_id', 'presence', 'reason']);

        $class_ids = array_unique(array_map(function ($el) {
            return $el->class_id;
        }, $attendances->all()));
        $classes = [];
        foreach (Clazz::whereIn('id', $class_ids)->get(['id', 'date'])->all() as $class) {
            $classes[$class->id] = $class;
        }

        foreach ($student_ids as $student_id) {
            $stats[$student_id] = [
                'weeks' => [],
                'total' => [
                    'no_reason' => 0,
                    'total' => 0,
                ],
                'pos' => -1,
            ];
        }
        foreach ($attendances as $atd) {
            $class = $classes[$atd->class_id];

            $week_start = $class->date->copy()->startOfWeek();
            $week_end = $class->date->copy()->endOfWeek();
            $weed_id = $week_start->format('Y/m/d');
            if (!array_key_exists($weed_id, $weeks)) {
                $weeks[$weed_id] = [
                    'start' => $week_start,
                    'end' => $week_end,
                ];
                foreach ($student_ids as $student_id) {
                    $stats[$student_id]['weeks'][$weed_id] = [
                        'no_reason' => 0,
                        'total' => 0,
                    ];
                }
            }
            $student_id = $atd->student_id;

            if (!array_key_exists($weed_id, $stats[$student_id]['weeks'])) {
                $stats[$student_id]['weeks'][$weed_id] = [
                    'no_reason' => 0,
                    'total' => 0,
                ];
            }

            $total = &$stats[$student_id]['total'];
            $week = &$stats[$student_id]['weeks'][$weed_id];
            if (!$atd->presence) {
                $week['total'] += 1;
                $total['total'] += 1;
                if ($atd->reason == null) {
                    $week['no_reason'] += 1;
                    $total['no_reason'] += 1;
                }
            }
        }
        ksort($weeks);

        $k = 1;
        while ($k <= count($stats)) {
            foreach ($stats as $i => $i_stat) {
                if ($stats[$i]['pos'] !== -1) {
                    continue;
                }
                $max = $i;
                foreach ($stats as $j => $j_stat) {
                    if ($j_stat['pos'] !== -1) {
                        continue;
                    }
                    if ($stats[$max]['total']['total'] < $j_stat['total']['total']) {
                        $max = $j;
                    }
                }
                $stats[$max]['pos'] = $k++;
            }
        }

        return view('group.stat', compact('group', 'students', 'weeks', 'stats'));
    }

    public function list(Group $group)
    {
        $super = null;
        $available = [];
        if ($group->super) {
            $super = $group->super;
            $available = $super->students->all();
        }
        $list = array_map(function ($el) {
            return $el->id;
        }, $group->students->all());
        $isSelected = function ($id) use ($list) {
            return in_array($id, $list);
        };

        return view('group.list', compact('group', 'available', 'isSelected'));
    }

    public function list_update(Request $request, Group $group)
    {
        $this->restrictSteward($group);
        $available = [];
        if ($group->super) {
            $available = $group->super->students->all();
        }
        $selected = [];
        foreach ($available as $el) {
            if ($request->has('student-' . $el->id) && $request->get('student-' . $el->id)) {
                $selected[] = $el->id;
            }
        }
        $group->students()->sync($selected);

        return redirect()->route('group.show', [$group]);
    }

    public function store(Request $request)
    {
        /* @var Student $student */
        $student = auth()->user()->student;

        $this->validate($request, [
            'name' => 'required|string',
            'course' => 'required|integer|min:1|max:9',
            'super_id' => [
                'required',
                'integer',
                Rule::exists('group', 'id')->where('steward_id', $student->id),
            ],
        ]);

        $cathedra_id = Group::find($request->get('super_id'), ['cathedra_id'])->cathedra_id;
        $student = auth()->user()->student;
        $group = new Group($request->all());
        $group->cathedra_id = $cathedra_id;
        $group->super_id = $request->super_id;
        $student->stewarded()->save($group);

        return redirect()->route('group.index');
    }

    public function update(Request $request, Group $group)
    {
        $this->restrictSteward($group);

        $this->validate($request, [
            'name' => 'required|string',
            'course' => 'required|integer|min:1|max:9'
        ]);

        $group
            ->fill($request->all())
            ->save();

        return redirect()->route('group.index');
    }

    public function destroy(Group $group)
    {
        $this->restrictSteward($group);

        $group->delete();

        return redirect()->route('group.index');
    }
}
