<style>
    .form2div {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 20px;
    }
</style>
<x-app-layout>
    <x-slot name="header" class="space-x-8 sm:-my-px sm:ms-10  sm:flex">
        <x-nav-link class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('New Subject') }}
        </x-nav-link>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="POST" action="{{ url('addsubject') }}">
                        @csrf

                        <div class="form2div">
                            <!-- Course -->
                            <div class="mt-4">
                                <x-input-label for="course" :value="__('Course')" />
                                <select name="course" class="block mt-1 w-full">
                                    <option value="">Select Course</option>
                                    @foreach($courses as $courses)
                                    <option value="{{$courses->id}}">{{$courses->course}}</option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('course')" class="mt-2" />
                            </div>
                            
                            <!-- Subject -->
                            <div class="mt-4">
                                <x-input-label for="subject" :value="__('Subject')" />
                                <x-text-input id="subject" class="block mt-1 w-full" type="text" name="subject" :value="old('subject')" required autofocus autocomplete="name" />
                                <x-input-error :messages="$errors->get('subject')" class="mt-2" />
                            </div>
                        </div>

                        <div class="flex items-center justify-center mt-4">
                            <x-primary-button class="ms-4">
                                {{ __('Add Subject') }}
                            </x-primary-button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>