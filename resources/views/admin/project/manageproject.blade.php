@extends('layouts.app')

@section('content')
<section class="bg-gray-500 bg-blend-multiply min-h-screen"
    style="background-image:url(https://www.rekayasa.com/wp-content/uploads/2021/06/FIP_7973-copy.jpg); 
           background-size: cover; 
           background-position: center; 
           background-repeat: no-repeat;">
    <div class="min-h-full">
        <header class="bg-gray-800 shadow">
            <div class="mx-auto max-w-7xl px-2 py-6 sm:px-6 lg:px-1 flex justify-between">
                <h2 class="text-3xl font-bold tracking-tight text-white">List Project</h2>
                <form action="{{ route('admin.project.search') }}" method="get">
                    <div class="relative text-gray-600 flex">
                        <input type="text" name="search" placeholder="Search"
                            class="bg-white h-10 mx-1 px-5 pr-10 rounded-full text-sm focus:outline-none">
                        <button type="submit" class="bg-blue-400 p-3 rounded-full">
                            <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px"
                                viewBox="0 0 56.966 56.966" style="enable-background:new 0 0 56.966 56.966;"
                                xml:space="preserve" width="512px" height="512px">
                                <path
                                    d="M55.146,51.887L41.588,37.786c3.486-4.144,5.396-9.358,5.396-14.786c0-12.682-10.318-23-23-23s-23,10.318-23,23  s10.318,23,23,23c4.761,0,9.298-1.436,13.177-4.162l13.661,14.208c0.571,0.593,1.339,0.92,2.162,0.92  c0.779,0,1.518-0.297,2.079-0.837C56.255,54.982,56.293,53.08,55.146,51.887z M23.984,6c9.374,0,17,7.626,17,17s-7.626,17-17,17  s-17-7.626-17-17S14.61,6,23.984,6z" />
                            </svg>
                        </button>
                    </div>
                </form>
            </div>
        </header>
        <main>
            <div class="mx-auto bg-gray-300 mt-4 max-w-8xl px-4 py-6 sm:px-6 rounded-xl">
                <h2 class="mb-4 bg-gray-100 max-w-sm text-center rounded-xl text-2xl font-bold p-2">Table Process And
                    Budgeting</h2>
                <div class="flex flex-col">
                    <div class="-m-1.5 overflow-x-auto">
                        <div class="p-1.5 w-full inline-block align-middle">
                            <div class="border rounded-lg overflow-y-auto" style="max-height:500px;">
                                <table class="w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-200">
                                        <tr>
                                            <th scope="col"
                                                class="px-6 py-3 text-xs font-medium text-gray-500 uppercase">Project Name
                                            </th>
                                            <th scope="col"
                                                class="px-6 py-3 text-xs font-medium text-gray-500 uppercase">Action</th>
                                            <th scope="col"
                                                class="px-6 py-3 text-xs font-medium text-gray-500 uppercase">Date</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-200 bg-gray-50 text-center">
                                        @foreach ($project as $item)
                                            <tr>
                                                <td class="px-6 py-2 whitespace-nowrap text-sm font-medium text-gray-800">
                                                    <a href="#">{{ $item->name }}</a>
                                                </td>
                                                <td
                                                    class="px-6 py-2 whitespace-nowrap text-end text-sm font-medium flex justify-center gap-2">
                                                    <a href="{{ route('admin.project.show', ['project' => $item->id]) }}" class="font-medium text-white rounded p-1"
                                                        style="background-color:rgb(29, 112, 255);">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                            class="size-6">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                d="M3.75 12h16.5m-16.5 3.75h16.5M3.75 19.5h16.5M5.625 4.5h12.75a1.875 1.875 0 0 1 0 3.75H5.625a1.875 1.875 0 0 1 0-3.75Z" />
                                                        </svg>
                                                    </a>
                                                    <form
                                                        action="{{ route('admin.project.manageUsers.destroy', ['project' => $item->id]) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="font-medium text-white rounded p-1"
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
                                                <td class="px-6 py-2 whitespace-nowrap text-sm text-gray-800">
                                                    {{ $item->created_at->format('d-m-Y | H:i') }}
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
    <a href="{{ route('admin.index') }}"
        class="ml-3 my-3 absolute items-center gap-1 text-md flex bg-gray-500 text-white px-3 py-1 rounded-full">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
            class="size-5">
            <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
        </svg>
        Back
    </a>
    </main>
    </div>
</section>
@endsection
