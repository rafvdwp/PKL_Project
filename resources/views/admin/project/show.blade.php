@extends('layouts.app')

@section('content')
<div class="min-h-screen flex flex-row bg-gray-200">
    <!-- Sidebar -->
    <div class="flex flex-col w-56 bg-gray-400 overflow-hidden mr-5">
        <!-- Project Title -->
        <div class="flex items-center justify-center h-20 shadow-md">
            <h1 class="text-lg uppercase text-white font-bold">{{ $project->name }}</h1>
        </div>

        <!-- Subsystem List -->
        <ul class="flex flex-col py-4">
            @foreach ($project->subSystem as $subSystem)
                <li class="bg-gray-300 mb-3 flex w-full">
                    <!-- Delete Button -->
                    <form action="{{ route('subsystem.delete', ['project' => $subSystem]) }}" method="POST">
                        @method('DELETE')
                        @csrf
                        <button type="submit" class="text-white font-medium bg-red-600 p-1 mx-2 my-3 rounded-lg flex flex-row items-center justify-center" style="border: 5px solid;">
                            <svg xmlns="http://www.w3.org/2000/svg" 
                                 fill="none" 
                                 viewBox="0 0 24 24" 
                                 stroke-width="1.5" 
                                 stroke="currentColor" 
                                 class="w-5 h-5">
                                <path stroke-linecap="round" 
                                      stroke-linejoin="round" 
                                      d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                            </svg>
                        </button>
                    </form>

                    <!-- Subsystem Link -->
                    <a href="{{ $subSystem->category === 'bulk_material' 
                        ? route('project.subSystembulkmaterial', [
                            'project' => $project->id,
                            'subSystem' => $subSystem->id,
                        ])
                        : route('project.subSystem', [
                            'project' => $project->id, 
                            'subSystem' => $subSystem->id
                        ]) }}"
                        class="flex flex-row items-center w-1/2 justify-center my-3 transform hover:translate-x-2 transition-transform ease-in duration-200 hover:text-gray-800">
                        <span class="text-lg font-medium ml-12 {{ 
                            $subSystem->category === 'bulk_material' ? 'text-red-600' : 
                            ($subSystem->category === 'badgetory' ? 'text-green-600' : 'text-gray-600') 
                        }}">
                            {{ $subSystem->name }}
                        </span>
                    </a>
                </li>
            @endforeach
                
            <!-- Subsystem Form -->
            <form id="subSystemForm" action="{{ route('subSystem.store', [$project->id]) }}" method="POST">
                @csrf
                <input type="hidden" id="subSystem" name="name" value="">
                <button type="submit" class="btn btn-primary hidden" id="submitBtn">Submit</button>
            </form>

            <!-- Add Subsystem Button -->
            <li class="relative text-center">
                <button id="menuButton" class="bg-blue-600 text-white p-2 rounded-full">
                    <svg class="w-7 h-7" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                            clip-rule="evenodd" />
                    </svg>
                </button>

                <!-- Dropdown Menu -->
                <ul id="dropdownMenu" class="absolute left-1/2 transform -translate-x-1/2 mt-2 w-32 bg-white shadow-lg rounded-lg hidden">
                    @php
                        $subSystemSelect = $managesubSystem->pluck('name')->toArray();
                    @endphp

                    @foreach ($subSystemSelect as $subSystem)
                        <li class="p-2 cursor-pointer hover:bg-gray-200 rounded-lg" data-value="{{ $subSystem }}">
                            {{ $subSystem }}
                        </li>
                    @endforeach
                </ul>
            </li>
        </ul>
    </div>

    <!-- Content Area -->
    <div class="flex-1">
        @yield('showLayout')
    </div>
</div>

<!-- Script for form submission -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const menuButton = document.getElementById('menuButton');
        const dropdownMenu = document.getElementById('dropdownMenu');
        const subSystemInput = document.getElementById('subSystem');
        const subSystemForm = document.getElementById('subSystemForm');

        // Toggle dropdown visibility
        menuButton.addEventListener('click', function() {
            dropdownMenu.classList.toggle('hidden');
        });

        // Set hidden input value and submit form when a dropdown item is clicked
        dropdownMenu.addEventListener('click', function(event) {
            if (event.target.tagName === 'LI') {
                const selectedValue = event.target.getAttribute('data-value');
                subSystemInput.value = selectedValue;
                subSystemForm.submit();
            }
        });

        // Close dropdown when clicking outside
        document.addEventListener('click', function(event) {
            if (!menuButton.contains(event.target) && !dropdownMenu.contains(event.target)) {
                dropdownMenu.classList.add('hidden');
            }
        });
    });
</script>
@endsection