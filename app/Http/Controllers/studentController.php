<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\userbatch;
use App\Models\subject;
use App\Models\course;
use App\Models\detail;
use App\Models\address;
use Illuminate\Support\Facades\Hash;
use App\Models\payment;
use App\Models\User;
use App\Models\usersubject;

class studentController extends Controller
{
    public function newstudent(){

        $courses = course::get();
        $subjects = subject::get();
        $batchlist = userbatch::get();
        return view('student.newstudent')->with('batchlist',$batchlist)->with('courses',$courses)->with('subjects',$subjects);

    }

    public function storestudent(Request $request){


        $request->validate([
            'name' => ['required'],
            'email' =>  ['required'],
            'age' =>  ['required'],
            'gender' =>  ['required'],
            'mobileno' =>  ['required'],
            'address' =>  ['required'],
            'batch' =>  ['required'],
            'course' =>  ['required'],
            'subject' =>  ['required'],
        ]);

        $useridvalue = User::orderBy('id','DESC')->get();
        $detailidvalue = detail::orderBy('id','DESC')->get();

        if(count($useridvalue)==0){
            $userid = 1;
        }else{
            $userid = $useridvalue[0]->id + 1;
        }

        if(count($detailidvalue)==0){
            $detailid = 1;
        }else{
            $detailid = $detailidvalue[0]->id + 1;
        }

        detail::create([
            'user_id' => $userid,
            'name' => $request->name,
            'email' =>  $request->email,
            'age' =>  $request->age,
            'gender' =>  $request->gender,
            'mobileno' =>  $request->mobileno,
            'batch_id' =>  $request->batch,
            'course_id' =>  $request->course,
            'subject_id' =>  $detailid,
        ]);

        address::create([
            'user_id' => $userid,
            'address' =>  $request->address,
        ]);

        $sub = $request->subject;

        for($i=0;$i<count($sub);$i++){
            
            usersubject::create([
                'user_id' => $detailid,
                'subject' => $sub[$i],
            ]);
        }

        $userroll = 2;

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->mobileno),
            'user_type' => $userroll,
        ]);

        return redirect('/attendance');

    }
}
