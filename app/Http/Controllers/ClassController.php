<?php

namespace App\Http\Controllers;

use App\Attendance;
use App\Clazz;
use App\Discipline;
use App\Group;
use App\Student;
use App\Teacher;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ClassController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware(['auth', 'student']);
        $this->middleware(['steward'], ['only' => ['create', 'store', 'edit', 'delete', 'update', 'destroy']]);
    }

    public function index(Request $request)
    {
        /* @var Student $student */
        $student = auth()->user()->student;

        $date = Carbon::now();
        if ($request->has('date')) {
            $date = Carbon::parse($request->get('date'));
        }

        $today = $date->copy()->startOfDay();
        $yesterday = $today->copy()->subDay();
        $tomorrow = $today->copy()->addDay();

        $groups = array_map(function ($el) {
            return $el->id;
        }, $student->groups()->get(['id'])->all());
        foreach (Group::where('steward_id', $student->id)->get(['id'])->all() as $el) {
            $groups[] = $el->id;
        }
        array_unique($groups);
        $classes = Clazz::whereIn('group_id', $groups)
            ->whereBetween('date', [$today, $today->copy()->endOfDay()])
            ->with('discipline', 'teacher')
            ->ordered()
            ->get()
            ->all();

        $classStatus = function (Clazz $class) {
            $now = Carbon::now();
            if ($now->lt($class->date)) {
                return 'future';
            }
            if ($now->lte($class->duration)) {
                return 'present';
            }
            return 'past';
        };

        return view('class.index', compact('classes', 'today', 'yesterday', 'tomorrow', 'classStatus'));
    }

    public function create()
    {
        /* @var Student $student */
        $student = auth()->user()->student;

        $class = new Clazz();
        $disciplines = [];
        foreach (Discipline::all(['id', 'name']) as $el) {
            $disciplines[$el->id] = $el->name;
        }
        asort($disciplines);
        $teachers = [];
        foreach (Teacher::all(['id', 'name']) as $el) {
            $teachers[$el->id] = $el->name;
        }
        asort($teachers);
        $groups = [];
        foreach ($student->stewarded()->getQuery()->get(['id', 'name'])->all() as $el) {
            $groups[$el->id] = $el->name;
        }
        $types = [
            'lection' => 'Лекция',
            'laboratory' => 'Лабораторная работа',
            'practice' => 'Практическое занятие',
            'seminar' => 'Семинар',
            'course' => 'Курсовая работа',
        ];
        $repeats = [
            null => 'Нет',
            'once' => 'Раз в 2 недели',
            'twice' => 'Каждую неделю',
        ];

        return view('class.create', compact('class', 'disciplines', 'teachers', 'groups', 'types', 'repeats'));
    }

    public function edit(Clazz $class)
    {
        /* @var Student $student */
        $student = auth()->user()->student;
        $disciplines = [];
        foreach (Discipline::all(['id', 'name']) as $el) {
            $disciplines[$el->id] = $el->name;
        }
        asort($disciplines);
        $teachers = [];
        foreach (Teacher::all(['id', 'name']) as $el) {
            $teachers[$el->id] = $el->name;
        }
        asort($teachers);
        $groups = [];
        foreach ($student->stewarded()->getQuery()->get(['id', 'name'])->all() as $el) {
            $groups[$el->id] = $el->name;
        }
        $types = [
            'lection' => 'Лекция',
            'laboratory' => 'Лабораторная работа',
            'practice' => 'Практическое занятие',
            'seminar' => 'Семинар',
            'course' => 'Курсовая работа',
        ];

        return view('class.edit', compact('class', 'disciplines', 'teachers', 'groups', 'types'));
    }

    public function update(Request $request, Clazz $class)
    {
        /* @var Student $student */
        $student = auth()->user()->student;

        $this->validate($request, [
            'group_id' => [
                'required',
                'integer',
                Rule::exists('group', 'id')->where('steward_id', $student->id),
            ],
            'discipline_id' => 'required|integer|exists:discipline,id',
            'teacher_id' => 'integer|exists:teacher,id',
            'date' => [
                'required',
                'date_format:Y-m-i\TH:i'
            ],
            'duration' => [
                'required',
                'date_format:H:i'
            ],
            'location' => 'required',
            'type' => 'required|in:lection,laboratory,practice,seminar,course',
        ]);

        $class->fill($request->all());
        $class->group_id = $request->get('group_id');
        $class->discipline_id = $request->get('discipline_id');
        $class->teacher_id = $request->get('teacher_id');
        $class->save();

        return redirect()->route('class.show', $class);
    }

    public function store(Request $request)
    {
        /* @var Student $student */
        $student = auth()->user()->student;

        $this->validate($request, [
            'group_id' => [
                'required',
                'integer',
                Rule::exists('group', 'id')->where('steward_id', $student->id),
            ],
            'discipline_id' => 'required|integer|exists:discipline,id',
            'teacher_id' => 'integer|exists:teacher,id',
            'date' => [
                'required',
                'date_format:Y-m-i\TH:i'
            ],
            'duration' => [
                'required',
                'date_format:H:i:s'
            ],
            'location' => 'required',
            'type' => 'required|in:lection,laboratory,practice,seminar,course',
            'repeat' => 'sometimes|in:once,twice',
            'repeat_till' => 'sometimes|date_format:Y-m-d|after:now',
        ]);

        $repeat = 0;
        switch ($request->get('repeat', 'none')) {
            case 'once':
                $repeat = 2;
                break;
            case 'twice':
                $repeat = 1;
                break;
        }
        $repeat_till = Carbon::parse($request->get('repeat_till'));

        $class = new Clazz($request->all());
        $class->group_id = $request->get('group_id');
        $class->discipline_id = $request->get('discipline_id');
        $class->teacher_id = $request->get('teacher_id');
        $class->save();
        if ($repeat) {
            /* @var Carbon $date */
            $date = $class->date;
            while (($date = $date->copy()->addWeek($repeat))->lte($repeat_till)) {
                /* @var Clazz $class */
                $class = $class->replicate();
                $class->date = $date;
                $class->save();
            }
        }

        return redirect()->route('class.index');
    }

    public function delete(Clazz $class)
    {
        $this->restrictSteward($class);

        return view('class.delete', compact('class'));
    }

    private function restrictSteward(Clazz $class)
    {
        if ($class->group()->getQuery()->first(['steward_id'])->steward_id != auth()->user()->student_id) {
            abort(403, 'Для того, что бы зайти на эту страницу необходимо быть старостой группы');
        }
    }

    public function destroy(Request $request, Clazz $class)
    {
        $this->restrictSteward($class);

        $class->delete();

        return redirect()->route('class.index');
    }

    public function show(Clazz $class)
    {
        /* @var Student $student */
        $student = auth()->user()->student;

        $students = [];
        foreach ($class->students as $stud) {
            $students[$stud->id] = $stud->name;
        }
        foreach ($class->attendances as $attendance) {
            $students[$attendance->student_id] = $attendance;
        }
        $reasons = [
            'ill' => 'Болезнь',
            'conference' => 'Конференция',
            'other' => 'Другое',
        ];

        $canEdit = $class->group->steward_id == $student->id;
        return view('class.show', compact('class', 'canEdit', 'students', 'reasons'));
    }

    public function attendance(Request $request, Clazz $class)
    {
        $this->restrictSteward($class);
        $this->validate($request, [
            'student.presence' => 'sometimes|boolean',
            'student.reason' => 'in:ill,conference,other',
            'student.mark' => 'sometimes|integer|min:0|max:100',
        ]);

        foreach ($request->get('student', []) as $stud_id => $stud) {
            /* @var Attendance $attendance */
            $attendance = Attendance::firstOrNew(['class_id' => $class->id, 'student_id' => $stud_id]);
            if (!$attendance->id) {
                $attendance->class_id = $class->id;
                $attendance->student_id = $stud_id;
            }
            $attendance->presence = (isset($stud['presence']) ? $stud['presence'] : false) ? 1 : 0;
            if ($attendance->presence) {
                $attendance->reason = null;
            } else {
                $attendance->reason = (isset($stud['reason']) && !empty($stud['reason'])) ? $stud['reason'] : null;
            }
            $attendance->mark = (isset($stud['mark']) && !empty($stud['mark'])) ? $stud['mark'] : null;

            $attendance->save();
        }

        return redirect()->route('class.show', [$class]);
    }

}
