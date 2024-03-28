<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\userbatch;
use App\Models\subject;
use App\Models\course;
use App\Models\detail;
use App\Models\address;
use App\Models\payment;

class SubjectController extends Controller
{
    
    public function subject(){

        $courses = subject::get();
        return view('subject.subject')->with('courses',$courses);
    }

    public function addsubject(){

        $courses = course::get();
        return view ('subject.addsubject')->with('courses',$courses);

    }

    public function storesubject(Request $request){

        $request->validate([
            'course' => ['required'],
            'subject' => ['required'],
        ]);

        subject::create([
            'course_id'=>$request->course,
            'subject'=>$request->subject,
        ]);
        
        return redirect('/subject');

    }
}
