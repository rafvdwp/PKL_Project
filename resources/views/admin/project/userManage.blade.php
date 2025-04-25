@extends('layouts.app')

@section('content')
    <nav class="bg-gray-800">
        <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
            <a href="#" class="flex items-center space-x-3 rtl:space-x-reverse">
                <span class="self-center text-2xl font-semibold whitespace-nowrap text-white">Admin Site</span>
            </a>

            <div data-modal-target="create-user" data-modal-toggle="create-user"
                class="flex gap-2 md:order-2 space-x-3 md:space-x-0 rtl:space-x-reverse">
                <button
                    class="flex text-white hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-3 py-1.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                    style="background-color: rgb(29, 180, 29);" type="button">
                    Add User Access List<svg enable-background="new 0 0 50 50" height="20px" id="Layer_1" version="1.1"
                        viewBox="0 0 50 50" width="20px" xml:space="preserve" xmlns="http://www.w3.org/2000/svg"
                        xmlns:xlink="http://www.w3.org/1999/xlink">
                        <rect fill="none" height="50" width="50" />
                        <line fill="none" stroke="#fff" stroke-miterlimit="10" stroke-width="4" x1="9"
                            x2="41" y1="25" y2="25" />
                        <line fill="none" stroke="#fff" stroke-miterlimit="10" stroke-width="4" x1="25"
                            x2="25" y1="9" y2="41" />
                    </svg>
                </button>
            </div>
        </div>
    </nav>

    <section class="bg-gray-500 bg-blend-multiply"
        style="background-image:url(https://www.rekayasa.com/wp-content/uploads/2021/06/FIP_7973-copy.jpg); background-size:cover; background-repeat:no-repeat; height:100vh;">
        <div class="px-4 mx-auto max-w-screen-xl text-center py-24">
            <div class="mx-auto max-w-screen-xl">
                <main>
                    <div class="mx-auto max-w-8xl px-4 py-6 sm:px-6">
                        <div class="flex flex-col">
                            <div class="-m-1.5 overflow-x-auto">
                                <div class="p-1.5 w-full inline-block align-middle">
                                    <div class="border rounded-lg overflow-hidden">
                                        <table class="w-full divide-y divide-gray-200 bg-gray-100">
                                            <thead class="bg-gray-50">
                                                <tr>
                                                    <th scope="col"
                                                        class="px-6 py-3 text-xs font-medium text-gray-500 uppercase">
                                                        Username</th>
                                                    <th scope="col"
                                                        class="px-6 py-3 text-xs font-medium text-gray-500 uppercase">E-mail
                                                    </th>
                                                    <th scope="col"
                                                        class="px-6 py-3 text-xs font-medium text-gray-500 uppercase">
                                                        Password</th>
                                                    <th scope="col"
                                                        class="px-6 py-3 text-xs font-medium text-gray-500 uppercase">Action
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody class="divide-y divide-gray-200 text-center">
                                                @foreach ($users as $item)
                                                    <tr>
                                                        <td
                                                            class="px-6 py-2 whitespace-nowrap text-sm font-medium text-gray-800">
                                                            {{ $item->name }}
                                                        </td>
                                                        <td
                                                            class="px-6 py-2 whitespace-nowrap text-sm font-medium text-gray-800">
                                                            {{ $item->email }}
                                                        </td>
                                                        <td
                                                            class="px-6 py-2 whitespace-nowrap text-sm text-gray-800 justify-center">
                                                            {{ $item->password }}
                                                        </td>
                                                        
                                                        <td class="flex justify-center px-6 py-2 whitespace-nowrap text-sm text-gray-800"
                                                            method="post">
                                                            <a href="{{ route('admin.project.destroyusers', $item->id) }}"
                                                                class="font-medium text-white rounded p-1"
                                                                style="background-color:rgb(221, 34, 34);"><svg
                                                                    class="w-6 h-6" xmlns="http://www.w3.org/2000/svg"
                                                                    fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                                                    stroke="currentColor" class="size-6">
                                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                                        d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0"
                                                                        method='POST'>
                                                                </svg>
                                                                @csrf
                                                                @method('DELETE')
                                                            </a>
                                                            <a href="{{ route('admin.project.index', $item->id) }}"
                                                                class="font-medium text-white rounded p-1"
                                                                style="background-color:rgb(29, 112, 255);"><svg
                                                                    xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                    viewBox="0 0 24 24" stroke-width="1.5"
                                                                    stroke="currentColor" class="size-6">
                                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                                        d="M3.75 12h16.5m-16.5 3.75h16.5M3.75 19.5h16.5M5.625 4.5h12.75a1.875 1.875 0 0 1 0 3.75H5.625a1.875 1.875 0 0 1 0-3.75Z" />
                                                                </svg></a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <a href="{{ route('admin.index') }}"
                            class="my-3 absolute items-center gap-1 text-md flex bg-gray-500 text-white px-3 py-1 rounded-full">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="size-5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
                            </svg>
                            Back
                        </a>
                    </div>
                </main>
            </div>
        </div>
    </section>
    @include('auth.registar')
@endsection
