<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Project</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css" />
</head>
<body>
    
    <div class="min-h-screen flex flex-row bg-gray-200">
        <div class="flex flex-col w-56 bg-gray-400 rounded-r-3xl overflow-hidden">
            <div class="flex items-center justify-center h-20 shadow-md">
                <h1 class="text-lg uppercase text-white font-bold">Projek Lombok</h1>
            </div>
            <ul class="flex flex-col py-4">
                <li class="bg-gray-300 mb-3">
                    <a href="{{ route('inproject.lan') }}" class="flex flex-row items-center justify-center h-12 transform hover:translate-x-2 transition-transform ease-in duration-200 text-gray-600 hover:text-gray-800">
                      <span class="text-lg font-medium">LAN</span>
                    </a>
                </li>
                <li class="relative text-center">
                    <!-- Tombol -->
                    <button id="menuButton" class="bg-blue-600 text-white p-2 rounded-full">
                        <svg class="w-7 h-7" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path>
                        </svg>
                    </button>
                    <!-- Dropdown Menu -->
                    <ul id="dropdownMenu" class="absolute left-1/2 transform -translate-x-1/2 mt-2 w-32 bg-white shadow-lg rounded-lg hidden">
                        <li class="p-2 cursor-pointer hover:bg-gray-200 rounded-lg">LAN</li>
                        <li class="p-2 cursor-pointer hover:bg-gray-200 rounded-lg">Teleph</li>
                        <li class="p-2 cursor-pointer hover:bg-gray-200 rounded-lg">PAGA</li>
                        <li class="p-2 cursor-pointer hover:bg-gray-200 rounded-lg">ACS</li>
                        <li class="p-2 cursor-pointer hover:bg-gray-200 rounded-lg">Hotline</li>
                        <li class="p-2 cursor-pointer hover:bg-gray-200 rounded-lg">PIDS</li>
                        <li class="p-2 cursor-pointer hover:bg-gray-200 rounded-lg">Radio System</li>
                        <li class="p-2 cursor-pointer hover:bg-gray-200 rounded-lg">Radio DMR</li>
                        <li class="p-2 cursor-pointer hover:bg-gray-200 rounded-lg">CCTV</li>
                        <li class="p-2 cursor-pointer hover:bg-gray-200 rounded-lg">CATV</li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>

    <script>
        // Dapatkan referensi ke tombol dan dropdown
        const menuButton = document.getElementById('menuButton');
        const dropdownMenu = document.getElementById('dropdownMenu');

        // Tambahkan event listener untuk tombol
        menuButton.addEventListener('click', () => {
            // Toggle visibilitas dropdown
            dropdownMenu.classList.toggle('hidden');
        });

        // Tambahkan event listener untuk menghilangkan dropdown saat mengklik di luar
        document.addEventListener('click', (event) => {
            if (!menuButton.contains(event.target) && !dropdownMenu.contains(event.target)) {
                dropdownMenu.classList.add('hidden');
            }
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.1/dist/flowbite.min.js"></script>
</body>
</html>