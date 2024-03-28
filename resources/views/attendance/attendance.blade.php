<style>

    #alert-danger {
        display: none;
    }
</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap4.min.css">
<x-app-layout>
    <x-slot name="header" class="space-x-8 sm:-my-px sm:ms-10  sm:flex">
        <x-nav-link class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Today Attendance') }}
        </x-nav-link>
        <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
            {{ __('Month Attendance') }}
        </x-nav-link>
        <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
            {{ __('Absent List') }}
        </x-nav-link>
    </x-slot>

    <div class="py-6">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-4">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @if(Session::has('alertmessage'))
                    <div class="alert-danger">
                        {{ session()->get('alertmessage') }}
                    </div>
                    @endif

                    @if(Session::has('success'))
                    <div class="alert-danger">
                        {{ session()->get('success') }}
                    </div>
                    @endif

                    <div class="alert-danger" id="alert-danger">
                        <h2 id="messages"></h2>
                    </div>
                </div>

                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="post" action="{{url('attendancefilter')}}">
                        @csrf
                        <select name="batchlist">
                            <option value="">Select Batch</option>
                            @foreach($batchs as $batchs)
                            <option value="{{$batchs->id}}">{{$batchs->batch}}</option>
                            @endforeach
                        </select>
                        <input type="date" id="date" name="date" value="">
                        <button type="submit" id="submits">Add Attendance</button>
                    </form>
                </div>
                <div class="p-6 text-gray-900 dark:text-gray-100 " id="atttable">
                    <table id="example" class="table table-striped" width="100%">
                        <form method="post" action="{{url('todayattendance')}}">
                            @csrf
                            <thead>
                                <tr>
                                    <th>Sl No</th>
                                    <th>Name</th>
                                    <th>Attendance</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = 1;
                                ?>
                                @foreach($student as $student)

                                <tr>
                                    <td><?php echo $i; ?></td>
                                    <td>{{$student->name}}</td>
                                    <td>
                                        <input type="checkbox" name="present[]" value="0">
                                        <label>Present</label>
                                        <input hidden name="ids[]" value="{{$student->id}}">
                                        <input type="checkbox" name="present[]" value="1">
                                        <label>Absent</label>
                                    </td>
                                </tr>
                                <?php $i++; ?>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th></th>
                                    <th></th>
                                    <input hidden name="attdate" value="{{$dates}}">
                                    <input hidden id="todaydate" name="attdate" type="date" value="<?php echo date('Y-m-d') ?>">
                                    <input hidden name="chbatch" id="chbatch" value="{{$batches}}">
                                    <th><button type="submit">Submit</button></th>
                                </tr>
                            </tfoot>
                        </form>
                    </table>
                </div>
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <table id="example" class="table table-striped" width="100%">
                        <thead>
                            <tr>
                                <th>Sl No</th>
                                <th>Name</th>
                                <th>Attendance</th>
                                <th>Date</th>
                                <th>batch</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 1;
                            ?>
                            @foreach($attenden as $attenden)
                            @foreach($students as $studs)
                            @if($studs->id == $attenden->user_id)

                            <tr>
                                <td><?php echo $i; ?></td>
                                <td>
                                    {{$studs->name}}
                                </td>
                                <td>
                                    @if($attenden->attendance == 0) Present @endif
                                    @if($attenden->attendance == 1) Absent @endif
                                </td>
                                <td>{{$attenden->date}}</td>
                                <td>
                                    @if($studs->batch_id == 1) Morning @endif
                                    @if($studs->batch_id == 2) Evening @endif</td>
                            </tr>
                            <?php $i++; ?>
                            @endif
                            @endforeach
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap4.min.js"></script>
