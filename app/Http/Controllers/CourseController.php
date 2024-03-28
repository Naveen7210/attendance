<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\userbatch;
use App\Models\subject;
use App\Models\course;
use App\Models\detail;
use App\Models\address;
use App\Models\payment;

class CourseController extends Controller
{

    public function course(){

        $courses = course::get();
        return view('course.course')->with('courses',$courses);
    }

    public function addcourse(){

        return view ('course.addcourse');

    }

    public function storecourse(Request $request){

        $request->validate([
            'course' => ['required'],
        ]);

        course::create([
            'course'=>$request->course,
        ]);
        
        return redirect('/course');

    }
}
