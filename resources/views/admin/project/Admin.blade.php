@extends('layouts.app')

@section('content')
    <nav class="bg-gray-800">
        <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
            <a href="#" class="flex items-center space-x-3 rtl:space-x-reverse">
                <span class="self-center text-2xl font-semibold whitespace-nowrap text-white">Admin Site</span>
            </a>
            <div class="flex gap-2 md:order-2 space-x-3 md:space-x-0 rtl:space-x-reverse">
                <a href="{{ route('admin.project.manageProject', ['user']) }}">
                    <button
                        class="block text-white hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-3 py-1.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                        style="background-color: rgb(29, 180, 29);" type="button">
                        List Project
                    </button>
                </a>
                <button data-modal-target="crud-modal" data-modal-toggle="crud-modal"
                    class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-3 py-1.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                    type="button">
                    Create New Project
                </button>
                <a href="#">
                    <button class="bg-red-500 text-white text-center font-bold p-1 px-2 rounded-lg">
                        <i class="fa fa-arrow-back"></i>Logout
                    </button>
                </a>
            </div>

            @include('admin.project.create')

            <div class="items-center justify-between w-full md:flex md:w-auto md:order-1" id="navbar-sticky">
                <ul
                    class="flex flex-col gap-3 p-4 md:p-0 mt-4 font-medium border border-gray-100 rounded-lg md:space-x-8 md:flex-row md:mt-0 md:border-0">
                    <li>
                        <a href="{{ route('admin.project.userManage') }}"
                            class="block p-1 px-3 text-white rounded hover:bg-gray-100 hover:text-gray-900"
                            aria-current="page">User Management</a>
                    </li>

                    <button id="dropdownInformationButton" data-dropdown-toggle="dropdownInformation"
                        class="text-white bg-gray-800 hover:bg-white hover:text-black font-medium rounded-md text-md p-1 px-3 text-center inline-flex items-center"
                        type="button">Data Management <svg class="w-2.5 h-2.5 ms-3" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 4 4 4-4" />
                        </svg>
                    </button>
                    <div id="dropdownInformation"
                        class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44">
                        <div class="px-4 py-3 text-md text-white bg-blue-600">
                            <div>Equipment Data Management</div>
                        </div>
                        <ul class="py-2 text-sm text-gray-700 dark:text-gray-200"
                            aria-labelledby="dropdownInformationButton">
                            <li>
                                <a href="{{ route('admin.project.managesubSystem') }}" class="block px-4 py-2 hover:bg-gray-100">Sub System</a>
                            </li>
                            <li>
                                <a href="{{ route('admin.project.manageDescription') }}" class="block px-4 py-2 hover:bg-gray-100">Description</a>
                            </li>
                            <li>
                                <a href="{{ route('admin.manageSpecification.index') }}" class="block px-4 py-2 hover:bg-gray-100">Specification</a>
                            </li>
                            <li>
                                <a href="{{ route('admin.manageUnit') }}" class="block px-4 py-2 hover:bg-gray-100">Unit</a>
                            </li>
                        </ul>
                        <div class="px-4 py-3 text-md text-white bg-red-600">
                            <div>Bulk Material Data Management</div>
                        </div>
                        <ul class="py-2 text-sm text-gray-700 dark:text-gray-200"
                            aria-labelledby="dropdownInformationButton">
                            <li>
                                <a href="{{ route('admin.project.manageBulkMaterial') }}" class="block px-4 py-2 hover:bg-gray-100">Bulk Material</a>
                            </li>
                            <li>
                                <a href="{{ route('admin.project.manageDescription') }}" class="block px-4 py-2 hover:bg-gray-100">Description</a>
                            </li>
                            <li>
                                <a href="{{ route('admin.manageSpecification.index') }}" class="block px-4 py-2 hover:bg-gray-100">Material Type</a>
                            </li>
                            <li>
                                <a href="{{ route('admin.manageUnit') }}" class="block px-4 py-2 hover:bg-gray-100">Unit</a>
                            </li>
                        </ul>
                    </div>
                </ul>
            </div>
        </div>
    </nav>

    <section class="bg-gray-500 bg-blend-multiply"
        style="background-image:url(https://www.rekayasa.com/wp-content/uploads/2021/06/FIP_7973-copy.jpg); background-size:cover; background-repeat:no-repeat;">
        <div class="px-4 mx-auto max-w-screen-xl text-center py-24">
            <div class="mx-auto max-w-screen-xl">
                <div class="grid gap-4">
                    <div class="block md:flex gap-4">
                        <div
                            class="w-full mb-4 md:mb-0 md:w-1/2 bg-gray-50 dark:bg-gray-800 border border-gray-200 rounded-lg p-8 md:p-11">
                            <h2 class="text-gray-900 dark:text-white text-2xl font-extrabold mb-4">Tata Cara Penggunaan
                                Website</h2>
                            <div>
                                <p class="text-md font-normal text-gray-600 dark:text-gray-400 mb-4 bg-gray-200 p-3 rounded"
                                    style="text-align: start">
                                    1. Klik tombol berwarna <span class="text-blue-500 font-extrabold">biru</span> untuk
                                    masuk kedalam detail project.<br>
                                    2. Klik tombol berwarna <span class="text-red-600 font-extrabold">merah</span> untuk
                                    menghapus project.<br>
                                    3. Klik tombol <button
                                        class=" text-white hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-2 py-1 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                                        style="background-color: rgb(29, 180, 29);" type="button">List Project</button>
                                    untuk melihat project yang sudah pernah ada.<br>
                                </p>
                            </div>
                        </div>

                        <div class="w-full md:w-1/2 bg-gray-50 dark:bg-gray-800 border border-gray-200 rounded-lg p-6">
                            <img src="https://cdn.medcom.id/dynamic/content/2023/05/24/1571936/AyDUBzvjHR.jpeg?w=1024"
                                alt="" class="rounded-lg">
                        </div>
                    </div>


                    <div
                        class="bg-gray-200 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg p-8 md:p-8">
                        <h2 class="text-gray-900 dark:text-white text-2xl font-extrabold mb-4">Table List Project</h2>
                        <div class="relative shadow-lg rounded">
                            <div class="max-h-[330px] overflow-y-auto">
                                <div style="max-height: 330px; overflow-y: auto; border-radius: 0.5rem;">
                                    <table
                                        class="w-full text-sm text-left rounded rtl:text-right text-gray-500 dark:text-gray-400">
                                        <thead
                                            class="sticky top-0 text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                            <tr>
                                                <th scope="col" class="px-6 py-3 text-center">
                                                    Project name
                                                </th>
                                                <th scope="col" class="px-6 py-3 text-center">
                                                    Date
                                                </th>
                                                <th scope="col" class="px-6 py-3 text-center">
                                                    Action
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($project as $item)
                                                <tr
                                                    class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                                                    <th class="px-6 py-4 gap-2 justify-center text-center">
                                                        <a
                                                            href="{{ route('admin.project.show', ['project' => $item->id]) }}">{{ $item->name }}</a>
                                                    </th>
                                                    <td class="px-6 py-4 gap-2 justify-center text-center">
                                                        {{ $item->created_at->format('d-m-Y | H:i') }}
                                                    </td>
                                                    <td class="px-6 py-4 flex gap-2 justify-center">
                                                        <button onclick="initiateCopyProject('{{ $item->id }}')"
                                                            class="inline-flex items-center px-3 py-1 text-sm font-medium text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300">
                                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor"
                                                                viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    stroke-width="2"
                                                                    d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z">
                                                                </path>
                                                            </svg>
                                                            Copy
                                                        </button>
                                                        <a href="{{ route('admin.project.show', ['project' => $item->id]) }}"
                                                            class="font-medium text-white rounded p-1"
                                                            style="background-color:rgb(29, 112, 255);">
                                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                viewBox="0 0 24 24" stroke-width="1.5"
                                                                stroke="currentColor" class="size-6">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    d="M3.75 12h16.5m-16.5 3.75h16.5M3.75 19.5h16.5M5.625 4.5h12.75a1.875 1.875 0 0 1 0 3.75H5.625a1.875 1.875 0 0 1 0-3.75Z" />
                                                            </svg>
                                                        </a>
                                                        <form
                                                            action="{{ route('admin.project.destroy', ['project' => $item->id]) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit"
                                                                class="font-medium text-white rounded p-1"
                                                                style="background-color:rgb(221, 34, 34);">
                                                                <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg"
                                                                    fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                                                    stroke="currentColor">
                                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                                        d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0">
                                                                    </path>
                                                                </svg>
                                                            </button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>



        <div id="copyProjectModal" tabindex="-1" aria-hidden="true"
            class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative w-full max-w-md max-h-full">
                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                    <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white">Copy Project</h3>
                        <button type="button"
                            class="text-gray-400 bg-transparent hover:bg-gray-200 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600"
                            data-modal-hide="copyProjectModal">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                            </svg>
                        </button>
                    </div>
                    <form id="copyProjectForm" method="POST" class="p-4 md:p-5">
                        @csrf
                        <div class="grid gap-4 mb-4">
                            <div>
                                <label for="projectName"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">New Project
                                    Name</label>
                                <input type="text" name="name" id="projectName"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                    placeholder="Enter project name" required>
                            </div>
                        </div>
                        <button type="submit"
                            class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700">
                            Copy Project
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <script>
        function initiateCopyProject(projectId) {
            const modal = document.getElementById("copyProjectModal");
            const form = document.getElementById("copyProjectForm");

            // Set the form action URL for copying the project
            form.action = `/project/${projectId}/copy`;

            // Show the modal
            modal.classList.remove("hidden");
        }

        // Add event listener to close modal when clicking outside or on close button
        document.querySelectorAll("[data-modal-hide='copyProjectModal']").forEach((element) => {
            element.addEventListener("click", () => {
                document.getElementById("copyProjectModal").classList.add("hidden");
            });
        });
    </script>
@endsection
