<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div>

    <div>
    <h1>User Availability Details</h1>
    <table>
        <tr>
            <th>From Time</th>
            <th>To Time</th>
        </tr>
        
        <tr>
            <td>{{ $availability->first()->from_time }}</td>
            <td>{{ $availability->first()->to_time }}</td>
        </tr>

    </table>
    </div>

</x-app-layout>
