<?php

namespace App\Http\Controllers;

use App\Models\attendance;
use App\Models\detail;
use App\Models\User;
use App\Models\userbatch;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $attenden = attendance::get();
        $student = detail::get();
        $students = detail::get();
        $batchs = userbatch::get();
        $dates = date('Y-m-d');
        $batches = '';

        // $attendancetoday =[];
        // $k =0;
        // for($i=0;$i<count($attenden);$i++){
        //     for($j=0;$j<count($student);$j++){
        //         if($attenden[$i]->user_id == $student[$j]->id){
        //             $attendancetoday[] = detail::where('id','=',$attenden[$i]->user_id)->get();
        //         }
        //     }
        //     $k++;
        // }

        //return $student;

        return view('attendance.attendance')->with('attenden',$attenden)->with('student',$student)->with('batchs',$batchs)->with('dates',$dates)->with('students',$students)->with('batches',$batches);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {   


        $idvalue = $request->ids;
        $presentvalue = $request->present;
        $attendancedate = $request->attdate;
        //$attendancebatch = $request->chbatch;

        //return $attendancebatch;

        $checkdate = attendance::get();

        for($i=0;$i<count($checkdate);$i++){
            $checking =  $checkdate[$i]->date;

            if($checking == $attendancedate){
                $alertmessage = 'You already submitted the attendance';
                return redirect('/attendance')->with('alertmessage',$alertmessage); 
            }
            // elseif($checking == $attendancedate){
            //     $alertmessage = 'You already submitted the attendance for' . " " . $attendancedate;
            //     return redirect('/attendance')->with('alertmessage',$alertmessage); 
            // }
        }


        for($i=0;$i<count($idvalue);$i++){

            attendance::create([
                'user_id' => $idvalue[$i],
                'attendance' => $presentvalue[$i],
                'date' => $attendancedate,
            ]);
        }

        return redirect('/attendance');
    }

    public function attendance_filter(Request $request)
    {
        $datevalue = $request->date;
        $batchvalue = $request->batchlist;
        

        $attenden = attendance::get();
        $batchs = userbatch::get();
        $students = detail::get();

        $student = detail::where('batch_id','=',$batchvalue)->get();

        $dates = $datevalue;
        $batches = $batchvalue;


        //return $student;
        return view('attendance.attendance')->with('attenden',$attenden)->with('student',$student)->with('batchs',$batchs)->with('dates',$dates)->with('students',$students)->with('batches',$batches);

    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
