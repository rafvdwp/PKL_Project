@extends('layouts.app')

@section('content')
    <nav class="bg-gray-800">
        <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
            <a href="https://flowbite.com/" class="flex items-center space-x-3 rtl:space-x-reverse">
                <span class="self-center text-2xl font-semibold whitespace-nowrap text-white">Add New Project Site</span>
            </a>
            <div class="flex md:order-2 space-x-3 md:space-x-0 rtl:space-x-reverse">
                <button data-modal-target="crud-modal" data-modal-toggle="crud-modal" class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-3 py-1.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">
                    Create New Project
                </button>
            </div>
        </div>
    </nav>

    <section class="bg-gray-500 bg-blend-multiply" style="background-image:url(https://www.rekayasa.com/wp-content/uploads/2021/06/FIP_7973-copy.jpg);">
        <div class="px-4 mx-auto max-w-screen-xl text-center py-24 lg:py-56">
            <div class="mx-auto max-w-screen-xl">
                <div class="grid md:grid-cols-2 gap-4">
                    <div class="bg-gray-200 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg p-8 md:p-8">
                        <h2 class="text-gray-900 dark:text-white text-2xl font-extrabold mb-4">Table List Project</h2>
                        <div class="relative overflow-x-auto shadow-lg rounded">
                            <table class="w-full text-sm text-left rounded rtl:text-right text-gray-500 dark:text-gray-400">
                                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                    <tr>
                                        <th scope="col" class="px-6 py-3">
                                            Project name
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-center">
                                            Action
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($projects as $item)
                                    <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                    <a href="{{ route('projects.show', $item->id) }}">{{ $item->name }}</a>   
                                            </th>
                                            <td class="px-6 py-4 flex gap-2 justify-center">
                                                <a href="{{ route('projects.show', $item->id) }}" class="font-medium text-white rounded p-1" style="background-color:rgb(29, 112, 255);"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 12h16.5m-16.5 3.75h16.5M3.75 19.5h16.5M5.625 4.5h12.75a1.875 1.875 0 0 1 0 3.75H5.625a1.875 1.875 0 0 1 0-3.75Z" /></svg></a>
                                                <button data-modal-target="edit-modal{{ $item->id }}" data-modal-toggle="edit-modal{{ $item->id }}" class="font-medium text-white rounded p-1" style="background-color:rgb(251, 187, 49);"><svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6"><path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" /></svg></button>
                                                <a href="{{ route('projects.destroy', $item->id) }}" class="font-medium text-white rounded p-1" style="background-color:rgb(221, 34, 34);"><svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6"><path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" method='post'></svg>
                                                    @csrf
                                                    

                                                </a>
                                            </td>
                                        </tr>
                                        @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg p-8 md:p-11">
                        <h2 class="text-gray-900 dark:text-white text-2xl font-extrabold mb-4">Tata Cara Penggunaan Website</h2>
                        <div>
                            <h3 class="text-xl text-gray-700 font-extrabold mb-2" style="text-align:start;">Tambah Projek</h3>
                            <p class="text-md font-normal text-gray-600 dark:text-gray-400 mb-4 bg-gray-200 p-2 rounded" style="text-align: start">
                                1. Klik tombol "Create New Project" di sebelah kanan atas.<br>
                                2. Masukkan nama projek di dalam form yang sudah tertera.<br>
                                3. Klik tombol "+ Add New Project" jika ingin menambahkan projek.
                            </p>
                        </div>
                        <div>
                            <h3 class="text-xl text-gray-700 font-extrabold mb-2" style="text-align:start;">Masuk Projek</h3>
                            <p class="text-md font-normal text-gray-600 dark:text-gray-400 mb-4 bg-gray-200 p-2 rounded" style="text-align: start">
                                1. Klik tombol berwarna <span class="text-blue-500 font-extrabold">biru</span> di dalam "Table List Project".<br>
                                2. Masukkan item yang dibutuhkan dalam projek baru.<br>
                                3. Lorem ipsum dolor sit amet consectetur.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Create New Project Modal --}}
    @include('projects.create')

    {{-- Edit Modal --}}
    @include('projects.edit')
@endsection