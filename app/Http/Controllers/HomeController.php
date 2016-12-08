<?php

namespace App\Http\Controllers;

use App\Clazz;
use App\Student;
use Carbon\Carbon;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index']]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(auth()->guest()) {
            return view('home.welcome');
        }

        /* @var Student $student */
        $student = auth()->user()->student;

        $today = Carbon::now()->startOfDay();
        $groups = array_map(function ($el) {
            return $el->id;
        }, $student->groups()->get(['id'])->all());
        $classes = Clazz::whereIn('group_id', $groups)
            ->whereBetween('date', [$today, $today->copy()->endOfDay()])
            ->with('discipline', 'teacher')
            ->ordered()
            ->get()
            ->all();

        $classStatus = function (Clazz $class) {
            $now = Carbon::now();
            if($now->lt($class->date)) {
                return 'future';
            }
            if($now->lte($class->duration)) {
                return 'present';
            }
            return 'past';
        };

        return view('home.dashboard', compact('classes', 'today', 'classStatus'));
    }
}
