@extends('layouts.app')

@section('content')
    <div class="min-h-screen flex flex-row bg-gray-200">
        <div class="flex flex-col w-56 bg-gray-400 overflow-hidden mr-5">
            <div class="flex items-center justify-center h-20 shadow-md">
                <h1 class="text-lg uppercase text-white font-bold">{{ $project->name }}</h1>
            </div>
            <ul class="flex flex-col py-4">
                @foreach ($project->subSystem as $subSystem)
                    <li class="bg-gray-300 mb-3">
                        <a href="{{ $subSystem->category === 'bulk_material'
                            ? route('admin.project.subSystembulkmaterial', [
                                'project' => $project->id,
                                'subSystem' => $subSystem->id,
                            ])
                            : route('admin.project.subSystem', ['project' => $project->id, 'subSystem' => $subSystem->id]) }}"
                            class="flex flex-row items-center justify-center h-12 transform hover:translate-x-2 transition-transform ease-in duration-200 hover:text-gray-800">
                            <span
                                class="text-lg font-medium 
                {{ $subSystem->category === 'bulk_material' ? 'text-red-600' : '' }}
                {{ $subSystem->category === 'badgetory' ? 'text-green-600' : '' }}
                {{ !in_array($subSystem->category, ['bulk_material', 'badgetory']) ? 'text-gray-600' : '' }}
            ">
                                {{ $subSystem->name }}
                            </span>
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>

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
        });
    </script>
@endsection