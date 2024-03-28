<style>
    .form2div {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 20px;
    }

    .flexdiv {
        display: flex;
        gap: 10px;
    }

    .griddiv {
        display: grid;
        align-items: center;
        justify-content: left;
        grid-template-columns: repeat(2, 1fr);
        column-gap: 1px;
    }
</style>
<x-app-layout>
    <x-slot name="header" class="space-x-8 sm:-my-px sm:ms-10  sm:flex">
        <x-nav-link class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('New Student') }}
        </x-nav-link>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="POST" action="{{ url('addstudent') }}">
                        @csrf

                        <div class="form2div">
                            <!-- Name -->
                            <div class="mt-4">
                                <x-input-label for="name" :value="__('Name')" />
                                <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                                <x-input-error :messages="$errors->get('name')" class="mt-2" />
                            </div>

                            <!-- Email Address -->
                            <div class="mt-4">
                                <x-input-label for="email" :value="__('Email')" />
                                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
                                <x-input-error :messages="$errors->get('email')" class="mt-2" />
                            </div>

                            <!-- Gender -->
                            <div class="mt-4">
                                <x-input-label for="gender" :value="__('Gender')" />
                                <select name="gender" class="block mt-1 w-full">
                                    <option value="">Select Gender</option>
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                </select>
                                <x-input-error :messages="$errors->get('gender')" class="mt-2" />
                            </div>

                            <!-- Age -->
                            <div class="mt-4">
                                <x-input-label for="age" :value="__('Age')" />
                                <x-text-input id="age" class="block mt-1 w-full" type="number" name="age" :value="old('age')" required autocomplete="username" />
                                <x-input-error :messages="$errors->get('age')" class="mt-2" />
                            </div>

                            <!-- Mobile No -->
                            <div class="mt-4">
                                <x-input-label for="mobileno" :value="__('Mobile No')" />
                                <x-text-input id="mobileno" class="block mt-1 w-full" type="tel" name="mobileno" :value="old('mobileno')" required autocomplete="username" />
                                <x-input-error :messages="$errors->get('mobileno')" class="mt-2" />
                            </div>

                            <!-- Address -->
                            <div class="mt-4">
                                <x-input-label for="address" :value="__('Address')" />
                                <x-text-input id="address" class="block mt-1 w-full" type="text" name="address" :value="old('address')" required autocomplete="username" />
                                <x-input-error :messages="$errors->get('address')" class="mt-2" />
                            </div>

                            <!-- Batch -->
                            <div class="mt-4">
                                <x-input-label for="batch" :value="__('Batch')" />
                                <select name="batch" class="block mt-1 w-full">
                                    <option value="">Select Batch</option>
                                    @foreach($batchlist as $batchlist)
                                    <option value="{{$batchlist->id}}">
                                        @if($batchlist->batch == 'morning') Moring Batch @endif
                                        @if($batchlist->batch == 'evening') Evening Batch @endif
                                    </option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('batch')" class="mt-2" />
                            </div>

                            <!-- Course -->
                            <div class="mt-4">
                                <x-input-label for="course" :value="__('Course')" />
                                <select name="course" id="course" class="block mt-1 w-full">
                                    <option value="">Select course</option>
                                    @foreach($courses as $courses)
                                    <option value="{{$courses->id}}">{{$courses->course}}</option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('course')" class="mt-2" />
                            </div>
                            <input id="subjects" value="{{$subjects}}" hidden>
                            <!-- Subject -->
                            <div class="mt-4">
                                <x-input-label for="subject" :value="__('Subject')" />
                                <div class="flexdiv">
                                    <div class="griddiv" id="griddiv">
                                    </div>
                                </div>
                                <x-input-error :messages="$errors->get('subject')" class="mt-2" />
                            </div>
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button class="ms-4">
                                {{ __('Register') }}
                            </x-primary-button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

</script>
<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script>
    var count = 0
    var courseid = document.getElementById('course');
    courseid.onchange = function() {
        let courses = this.value;
        console.log(courses)

        counts = count++

        var subjects = document.getElementById('subjects');
        let coursevalue = JSON.parse(subjects.value);

        if (counts > 0) {
            const checkboxsss = document.getElementById('griddiv')
            $("#griddiv").find("input").remove().end()
            $("#griddiv").find("label").remove().end()
        }

        for (i = 0; i < coursevalue.length; i++) {
            if (courses == 2 || courses == 3) {

                if (courses == coursevalue[i].course_id) {

                    let idname = 'checkboxid' + i
                    console.log(idname)
                    let checkboxs = document.getElementById('griddiv');
                    let boxsvalue = document.createElement('input');
                    let boxsname = document.createElement('label');
                    boxsvalue.type = 'checkbox'
                    boxsvalue.value = coursevalue[i].subject
                    boxsvalue.id = idname
                    boxsvalue.name = 'subject[]'
                    boxsname.textContent = coursevalue[i].subject
                    boxsname.id = 'checkboxidname'
                    checkboxs.append(boxsvalue, boxsname)
                    document.getElementById(idname).checked = true;
                }
            } else if (courses == 1 || courses == 4) {

                let idname = 'checkboxid' + i
                console.log(idname)
                let checkboxs = document.getElementById('griddiv');
                let boxsvalue = document.createElement('input');
                let boxsname = document.createElement('label');
                boxsvalue.type = 'checkbox'
                boxsvalue.value = coursevalue[i].subject
                boxsvalue.id = idname
                boxsvalue.name = 'subject[]'
                boxsname.textContent = coursevalue[i].subject
                boxsname.id = 'checkboxidname'
                checkboxs.append(boxsvalue, boxsname)
                document.getElementById(idname).checked = true;
            }

        }

        var subjectss = document.getElementById('checkboxid');
        //let coursevalues = JSON.parse(subjectss.value);
        console.log(subjectss.id)
    }
</script>