@extends('layouts.app')

@section('content')
    <div class="min-h-screen flex flex-row bg-gray-200">
        <div class="flex flex-col w-56 bg-gray-400 rounded-r-3xl overflow-hidden">
            <div class="flex items-center justify-center h-20 shadow-md">
                <h1 class="text-lg uppercase text-white font-bold">{{ $projects->name }}</h1>
            </div>
            <ul class="flex flex-col py-4">
                @foreach ($projects->category as $category)
                    <li class="bg-gray-300 mb-3">
                        <a href="{{ route('projects.category', ['project' => $projects->id, 'category' => $category->id]) }}" class="flex flex-row items-center justify-center h-12 transform hover:translate-x-2 transition-transform ease-in duration-200 text-gray-600 hover:text-gray-800">
                            <span class="text-lg font-medium">{{ $category->name }}</span>
                        </a>
                    </li>
                @endforeach


                <form id="categoryForm" action="{{ route('categories.store', $projects->id) }}" method="POST">
                    @csrf
                    <!-- Hidden input field untuk mengirim data pilihan -->
                    <input type="hidden" id="category" name="name" value="">
                    <button type="submit" class="btn btn-primary hidden" id="submitBtn">Submit</button>
                </form>

            <li class="relative text-center">
                <!-- Tombol -->
                <button id="menuButton" class="bg-blue-600 text-white p-2 rounded-full">
                    <svg class="w-7 h-7" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path>
                    </svg>
                </button>
                <!-- Dropdown Menu -->
                <ul id="dropdownMenu" class="absolute left-1/2 transform -translate-x-1/2 mt-2 w-32 bg-white shadow-lg rounded-lg hidden">
                    <li class="p-2 cursor-pointer hover:bg-gray-200 rounded-lg" data-value="LAN">LAN</li>
                    <li class="p-2 cursor-pointer hover:bg-gray-200 rounded-lg" data-value="Teleph">Teleph</li>
                    <li class="p-2 cursor-pointer hover:bg-gray-200 rounded-lg" data-value="PAGA">PAGA</li>
                    <li class="p-2 cursor-pointer hover:bg-gray-200 rounded-lg" data-value="ACS">ACS</li>
                    <li class="p-2 cursor-pointer hover:bg-gray-200 rounded-lg" data-value="Hotline">Hotline</li>
                    <li class="p-2 cursor-pointer hover:bg-gray-200 rounded-lg" data-value="PIDS">PIDS</li>
                    <li class="p-2 cursor-pointer hover:bg-gray-200 rounded-lg" data-value="Radio System">Radio System</li>
                    <li class="p-2 cursor-pointer hover:bg-gray-200 rounded-lg" data-value="Radio DMR">Radio DMR</li>
                    <li class="p-2 cursor-pointer hover:bg-gray-200 rounded-lg" data-value="CCTV">CCTV</li>
                    <li class="p-2 cursor-pointer hover:bg-gray-200 rounded-lg" data-value="CATV">CATV</li>
                </ul>
            </li>

<script>
// Toggle dropdown visibility
document.getElementById('menuButton').addEventListener('click', function() {
    const dropdownMenu = document.getElementById('dropdownMenu');
    dropdownMenu.classList.toggle('hidden');
});

// Set hidden input value and submit form when dropdown item is clicked
document.querySelectorAll('#dropdownMenu li').forEach(function(item) {
    item.addEventListener('click', function() {
        const selectedValue = this.getAttribute('data-value');
        document.getElementById('category').value = selectedValue; // Set hidden input value
        document.getElementById('categoryForm').submit(); // Submit form automatically

        // Optionally, hide the dropdown after selection
        document.getElementById('dropdownMenu').classList.add('hidden');
    });
});
</script>


    
@endsection