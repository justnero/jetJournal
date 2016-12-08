<?php

namespace App\Http\Controllers;

use App\Student;
use Illuminate\Http\Request;
use Symfony\Component\Finder\Exception\AccessDeniedException;

class StudentController extends Controller
{

    public function show(Student $student) {
        /* @var 'Student $student */
        $me = auth()->user()->student;
        $allowed = true;
        if($student->id != $me->id) {
            $allowed = false;
            foreach ($student->groups as $group) {
                if($group->steward_id == $me->id) {
                    $allowed = true;
                    break;
                }
            }
        }
        if(!$allowed) {
            abort(403, 'Для того, что бы зайти на эту страницу необходимо быть старостой');
        }

        return view('student.show', compact('student'));
    }

    public function link() {
        $me = auth()->user();
        if(!$me->student_id) {
            return back();
        }

    }

}
