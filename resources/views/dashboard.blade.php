<x-app-layout>
    <x-slot name="header" class="space-x-8 sm:-my-px sm:ms-10  sm:flex">
        <x-nav-link :href="url('attendance')" :active="request()->routeIs('attendance')">
            {{ __('Attendance') }}
        </x-nav-link>
        <x-nav-link :href="url('new_student')" :active="request()->routeIs('new_student')">
            {{ __('New Student') }}
        </x-nav-link>
        <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
            {{ __('New Staff') }}
        </x-nav-link>
        <x-nav-link :href="url('add_course')" :active="request()->routeIs('add_course')">
            {{ __('Add Course') }}
        </x-nav-link>
        <x-nav-link :href="url('add_subject')" :active="request()->routeIs('add_subject')">
            {{ __('Add Subject') }}
        </x-nav-link>
        <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
            {{ __('Batch') }}
        </x-nav-link>
        <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
            {{ __('Fees Details') }}
        </x-nav-link>

    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>