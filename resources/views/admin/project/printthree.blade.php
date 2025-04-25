@extends('layouts.app')

@section('content')
    <nav class="bg-gray-800 hide-print">
        <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
            <a href="#" class="flex items-center space-x-3 rtl:space-x-reverse">
                <span class="self-center text-2xl font-semibold whitespace-nowrap text-white">MTO</span>
            </a>
        </div>
    </nav>

    <section class="bg-gray-500 bg-blend-multiply"
        style="background-image:url(https://www.rekayasa.com/wp-content/uploads/2021/06/FIP_7973-copy.jpg); background-size:cover; background-position:center; background-repeat:no-repeat;">
        <div class="px-2 mx-auto max-w-screen-xl py-10 hide-padding hide-pt">
            @if ($TablePDFImg->isEmpty())
                <form action="{{ route('admin.printthree.ImgStore', ['projectId' => $projectId]) }}" method="post"
                    enctype="multipart/form-data">
                    @method('POST')
                    @csrf
                    <input name="img"
                        class="mb-5 block w-full text-lg text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                        id="large_size" type="file" accept="image/*">
                    <button type="submit"
                        class="bg-green-500 hover:bg-green-700 rounded-lg py-2 px-4 mr-2 font-bold text-white">Submit</button>
                </form>
            @endif

            <div class="flex flex-wrap">
                @foreach ($TablePDFImg as $item)
                    <div class="relative">
                        <img src="{{ asset($item->img) }}" alt="PDF Header Image" class="max-w-xs">
                        <form
                            action="{{ route('admin.printthree.updateImage', ['projectId' => $projectId, 'id' => $item->id]) }}"
                            method="POST" enctype="multipart/form-data" class="absolute top-0 right-0">
                            @csrf
                            @method('PUT')
                            <input type="file" name="img" required>
                            <button type="submit" class="bg-blue-500 text-white p-1 rounded">
                                Update Image
                            </button>
                        </form>
                    </div>
                @endforeach
            </div>

        </div>
        <div
            class="bg-gray-200 dark:bg-gray-800 border max-w-screen-xl mx-auto border-gray-200 dark:border-gray-700 rounded-lg p-6 md:p-6">
            <div class="flex mx-auto max-w-screen-xl">
                <main class="w-full">
                    <div class="mx-auto max-w-8xl px-4 sm:px-2">
                        <div class="grid grid-cols-1 gap-4">
                            <form action="{{ route('admin.printthree.TablePDFOneStore', ['projectId' => $projectId]) }}"
                                method="post">
                                @method('POST')
                                @csrf
                                <input type="text" name="table_title1" placeholder="Masukkan Judul Untuk Tabel"
                                    class="rounded-lg w-80 mr-3">
                                <button type="submit"
                                    class="bg-green-500 hover:bg-green-700 rounded-lg py-2 px-4 mr-2 font-bold text-white">Submit</button>
                            </form>
                            @foreach ($TablePDFOne as $item)
                                <form action="" method="get">
                                    <div class="font-bold text-xl flex gap-3">
                                        {{ $item->table_title1 }}
                                        @csrf
                                        @method('delete')
                                        <button class="font-medium text-white rounded p-1"
                                            style="background-color:rgb(221, 34, 34);"><svg class="w-5 h-5"
                                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="size-6">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0"
                                                    method='post'>
                                            </svg>
                                        </button>
                                    </div>
                                </form>
                            @endforeach

                            <table class="w-full text-sm text-left rounded rtl:text-right text-gray-500 dark:text-gray-400">
                                <thead
                                    class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-200">
                                    <tr>
                                        <th scope="col" class="rounded-s-lg px-6 py-3">
                                            No.
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-center">
                                            Code
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-center">
                                            Description
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-center">
                                            Type
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-center">
                                            Unit
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-center">
                                            Qty.
                                        </th>
                                        <th scope="col" class="rounded-e-lg px-6 py-3 text-center">
                                            Action
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <form
                                        action="{{ route('admin.printthree.TableOneFillStore', ['projectId' => $projectId]) }}"
                                        method="post">
                                        @method('post')
                                        @csrf
                                        <tr
                                            class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                                            <th scope="row"
                                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                Num.
                                            </th>
                                            <td
                                                class="px-6 py-4 gap-2 font-medium text-gray-900 whitespace-nowrap dark:text-white text-center">
                                                <div class="w-full max-w-sm min-w-[200px]">
                                                    <div class="relative">
                                                        <input type="text" name="code" placeholder="code"
                                                            class="rounded-lg w-20 mr-3">
                                                    </div>
                                                </div>
                                            </td>
                                            <td
                                                class="px-6 py-4 gap-2 font-medium text-gray-900 dark:text-white text-center">
                                                <div class="w-full max-w-sm min-w-[200px]">
                                                    <div class="relative">
                                                        <select name="description"
                                                            class="w-full bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-slate-200 rounded pl-3 pr-8 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-400 shadow-sm focus:shadow-md appearance-none cursor-pointer">
                                                            @foreach ($manageDescription as $item)
                                                                <option value="{{ $item->Description_name }}">
                                                                    {{ $item->Description_name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </td>
                                            <td
                                                class="px-6 py-4 gap-2 font-medium text-gray-900 dark:text-white text-center">
                                                <div class="w-full max-w-sm min-w-[200px]">
                                                    <div class="relative">
                                                        <select name="type"
                                                            class="w-full bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-slate-200 rounded pl-3 pr-8 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-400 shadow-sm focus:shadow-md appearance-none cursor-pointer">
                                                            @foreach ($manageSpecification as $item)
                                                                <option value="{{ $item->specification_name }}">
                                                                    {{ $item->specification_name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </td>
                                            <td
                                                class="px-6 py-4 gap-2 font-medium text-gray-900 whitespace-nowrap dark:text-white text-center">
                                                <div class="w-full max-w-sm min-w-[200px]">
                                                    <div class="relative">
                                                        <select name="unit"
                                                            class="w-30 bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-slate-200 rounded pl-3 pr-8 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-400 shadow-sm focus:shadow-md appearance-none cursor-pointer">
                                                            @foreach ($manageUnit as $item)
                                                                <option value="{{ $item->name }}">{{ $item->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </td>
                                            <td
                                                class="px-6 py-4 gap-2 font-medium text-gray-900 whitespace-nowrap dark:text-white text-center">
                                                <input name="qty" type="number" class="rounded-lg w-16">
                                            </td>
                                            <td>
                                                <button type="submit"
                                                    class="bg-green-500 hover:bg-green-700 rounded-lg py-2 px-4 mr-2 font-bold text-white">Submit</button>
                                            </td>
                                    </form>
                                    </tr>
                                    @foreach ($TableOneFill as $index => $item)
                                        <tr
                                            class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                                            <th scope="row"
                                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                {{ $index + 1 }}
                                            </th>
                                            <td
                                                class="px-6 py-4 gap-2 font-medium text-gray-900 whitespace-nowrap dark:text-white text-center">
                                                {{ $item->code }}
                                            </td>
                                            <td
                                                class="px-6 py-4 gap-2 font-medium text-gray-900 dark:text-white text-left">
                                                {{ $item->description }}
                                            </td>
                                            <td
                                                class="px-6 py-4 gap-2 font-medium text-gray-900 dark:text-white text-left">
                                                {{ $item->type }}
                                            </td>
                                            <td
                                                class="px-6 py-4 gap-2 font-medium text-gray-900 whitespace-nowrap dark:text-white text-center">
                                                {{ $item->unit }}
                                            </td>
                                            <td
                                                class="px-6 py-4 gap-2 font-medium text-gray-900 whitespace-nowrap dark:text-white text-center">
                                                {{ $item->qty }}
                                            </td>
                                            <td
                                                class="px-6 py-4 gap-2 font-medium text-gray-900 whitespace-nowrap dark:text-white text-center">
                                                <form action="" method="get">
                                                    @csrf
                                                    @method('delete')
                                                    <button class="font-medium text-white rounded p-1"
                                                        style="background-color:rgb(221, 34, 34);"><svg class="w-6 h-6"
                                                            xmlns="http://www.w3.org/2000/svg" fill="none"
                                                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                            class="size-6">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0"
                                                                method='post'>
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
                </main>
            </div>
        </div>

        <div class="mx-auto max-w-screen-xl py-12 hide-padding hide-pt">
            <div class="bg-gray-200 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg p-6 md:p-6">
                <div class="flex mx-auto max-w-screen-xl">
                    <main class="w-full">
                        <div class="mx-auto max-w-8xl px-4 sm:px-2">
                            <div class="grid grid-cols-1 gap-4">
                                <form
                                    action="{{ route('admin.printthree.TablePDFTwoStore', ['projectId' => $projectId]) }}"
                                    method="post">
                                    @method('POST')
                                    @csrf
                                    <input type="text" name="table_title2" placeholder="Masukkan Judul Untuk Tabel"
                                        class="rounded-lg w-80 mr-3 mb-4">

                                    {{-- <button type="submit" class="bg-green-500 hover:bg-green-700 rounded-lg py-2 px-3 font-bold text-white">Submit</button> --}}
                                    <table
                                        class="w-full text-sm text-left rounded rtl:text-right text-gray-500 dark:text-gray-400">
                                        <thead
                                            class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-200">
                                            <tr>
                                                <th scope="col" class="rounded-s-lg px-6 py-3 text-center">
                                                    No.
                                                </th>
                                                <th scope="col" class="px-6 py-3 text-center">
                                                    Specification
                                                </th>
                                                <th scope="col" class="px-6 py-3 text-center">
                                                    Size
                                                </th>
                                                <th scope="col" class="px-6 py-3 text-center">
                                                    Unit
                                                </th>
                                                <th scope="col" class="px-6 py-3 text-center">
                                                    Qty.
                                                </th>
                                                <th scope="col" class="rounded-e-lg px-6 py-3 text-center">
                                                    Action
                                                </th>
                                            </tr>
                                        </thead>
                                        <button type="submit"
                                            class="bg-green-500 hover:bg-green-700 rounded-lg py-2 px-4 mr-2 font-bold text-white">Submit</button>
                                </form>
                                <br>
                                @foreach ($TablePDFTwo as $item)
                                    <div class="text-xl font-bold flex gap-3 mb-3">
                                        {{ $item->table_title2 }}
                                        <button class="font-medium text-white rounded p-1"
                                            style="background-color:rgb(221, 34, 34);"><svg class="w-5 h-5"
                                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="size-6">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0"
                                                    method='post'>
                                            </svg>
                                        </button>
                                    </div>
                                @endforeach

                                <tbody>
                                    <form
                                        action="{{ route('admin.printthree.TableTwoFillStore', ['projectId' => $projectId]) }}"
                                        method="post">
                                        @method('post')
                                        @csrf
                                        <tr
                                            class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                                            <th scope="row"
                                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                Num.
                                            </th>
                                            <td
                                                class="px-6 py-4 gap-2 font-medium text-gray-900 w-1/2 dark:text-white text-center">
                                                <div class="w-full">
                                                    <div class="relative">
                                                        <select name="specification"
                                                            class="w-full bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-slate-200 rounded pl-3 pr-8 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-400 shadow-sm focus:shadow-md appearance-none cursor-pointer">
                                                            @foreach ($DetailSpecification as $item)
                                                                <option value="{{ $item->DetailSpecification }}">
                                                                    {{ $item->DetailSpecification }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </td>
                                            <td
                                                class="px-6 py-4 gap-2 font-medium text-gray-900 w-1/2 dark:text-white text-center">
                                                <div class="w-full">
                                                    <div class="relative">
                                                        <select name="size"
                                                            class="w-full bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-slate-200 rounded pl-3 pr-8 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-400 shadow-sm focus:shadow-md appearance-none cursor-pointer">
                                                            @foreach ($TableSize as $item)
                                                                <option value="{{ $item->Size }}">{{ $item->Size }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </td>
                                            <td
                                                class="px-6 py-4 gap-2 font-medium text-gray-900 whitespace-nowrap dark:text-white text-center">
                                                <div class="w-full max-w-sm min-w-[200px]">
                                                    <div class="relative">
                                                        <select name="unit"
                                                            class="w-16 bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-slate-200 rounded pl-3 pr-8 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-400 shadow-sm focus:shadow-md appearance-none cursor-pointer">
                                                            @foreach ($manageUnit as $item)
                                                                <option value="{{ $item->name }}">{{ $item->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </td>
                                            <td
                                                class="px-6 py-4 gap-2 font-medium text-gray-900 whitespace-nowrap dark:text-white text-center">
                                                <input type="number" name="qty" class="rounded-lg w-16">
                                            </td>
                                            <td>
                                                <button type="submit"
                                                    class="bg-green-500 hover:bg-green-700 rounded-lg py-2 px-4 mr-2 font-bold text-white">Submit</button>
                                            </td>
                                        </tr>
                                    </form>
                                    @foreach ($TableTwoFill as $index => $item)
                                        <tr
                                            class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                                            <th scope="row"
                                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                {{ $index + 1 }}
                                            </th>
                                            <td
                                                class="px-6 py-4 gap-2 font-medium text-gray-900 w-1/2 dark:text-white text-left">
                                                {{ $item->specification }}
                                            </td>
                                            <td
                                                class="px-6 py-4 gap-2 font-medium text-gray-900 w-1/2 dark:text-white text-left">
                                                {{ $item->size }}
                                            </td>
                                            <td
                                                class="px-6 py-4 gap-2 font-medium text-gray-900 whitespace-nowrap dark:text-white text-center">
                                                {{ $item->unit }}
                                            </td>
                                            <td
                                                class="px-6 py-4 gap-2 font-medium text-gray-900 whitespace-nowrap dark:text-white text-center">
                                                {{ $item->qty }}
                                            </td>
                                            <td></td>
                                        </tr>
                                        </tr>
                                    @endforeach
                                </tbody>
                                </table>
                            </div>
                        </div>
                    </main>
                </div>
            </div>
            <div class="px-2 mx-auto max-w-screen-xl py-10 hide-padding hide-pt">
                <div
                    class="bg-gray-200 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg p-6 md:p-6">
                    <div class="flex mx-auto max-w-screen-xl">
                        <main class="w-full">
                            <div class="mx-auto max-w-8xl px-4 sm:px-2">
                                <div class="grid grid-cols-1 gap-4">
                                    <form
                                        action="{{ route('admin.printthree.TablePDFThreeStore', ['projectId' => $projectId]) }}"
                                        method="post">
                                        @method('POST')
                                        @csrf
                                        <div class="flex">
                                            <input type="text" name="table_title3"
                                                placeholder="Masukkan Judul Untuk Tabel"
                                                class="rounded-lg w-80 mr-3 mb-4">
                                            <br>
                                            <button type="submit"
                                                class="bg-green-500 hover:bg-green-700 rounded-lg h-10 py-2 px-4 mr-2 font-bold text-white">Submit</button>
                                        </div>
                                        @foreach ($TablePDFThree as $item)
                                            <div class="font-bold text-xl flex gap-3 mb-3">
                                                {{ $item->table_title3 }}
                                                <button class="font-medium text-white rounded p-1"
                                                    style="background-color:rgb(221, 34, 34);"><svg class="w-5 h-5"
                                                        xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                        class="size-6">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0"
                                                            method='post'>
                                                    </svg>
                                                </button>
                                            </div>
                                        @endforeach
                                        <table
                                            class="w-full text-sm text-left rounded rtl:text-right text-gray-500 dark:text-gray-400">
                                            <thead
                                                class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-200">
                                                <tr>
                                                    <th scope="col" class="rounded-s-lg px-4 py-3 text-center">
                                                        ITEM NO.
                                                    </th>
                                                    <th scope="col" class="px-4 py-3 text-center">
                                                        ID NO.
                                                    </th>
                                                    <th scope="col" class="w-1/2 px-6 py-3 text-center">
                                                        Description
                                                    </th>
                                                    <th scope="col" class="px-4 py-3 text-center">
                                                        Unit
                                                    </th>
                                                    <th scope="col" class="px-4 py-3 text-center">
                                                        Qty.
                                                    </th>
                                                    <th scope="col" class="rounded-e-lg px-4 py-3 text-center">
                                                        Action
                                                    </th>
                                                </tr>
                                            </thead>
                                    </form>
                                    <tbody>
                                        <form
                                            action="{{ route('admin.printthree.TableThreeFillStore', ['projectId' => $projectId]) }}"
                                            method="post">
                                            @method('post')
                                            @csrf
                                            <tr
                                                class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                                                <th scope="row"
                                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                    Num.
                                                </th>
                                                <td
                                                    class="px-6 py-4 gap-2 font-medium text-gray-900 whitespace-nowrap dark:text-white text-center">
                                                    <div class="w-full max-w-sm min-w-[200px]">
                                                        <div class="relative">
                                                            <input type="text" name="idno" placeholder="idno"
                                                                class="rounded-lg w-20 mr-3">
                                                        </div>
                                                    </div>
                                                </td>
                                                <td
                                                    class="px-6 py-4 gap-2 font-medium text-gray-900 w-full whitespace-nowrap dark:text-white text-center">
                                                    <div class="w-full">
                                                        <div class="relative">
                                                            <select name="description"
                                                                class="w-full bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-slate-200 rounded pl-3 pr-8 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-400 shadow-sm focus:shadow-md appearance-none cursor-pointer">
                                                                @foreach ($manageDescription as $item)
                                                                    <option value="{{ $item->Description_name }}">
                                                                        {{ $item->Description_name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td
                                                    class="px-6 py-4 gap-2 font-medium text-gray-900 whitespace-nowrap dark:text-white text-center">
                                                    <div class="w-full max-w-sm min-w-[200px]">
                                                        <div class="relative">
                                                            <select name="unit"
                                                                class="w-16 bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-slate-200 rounded pl-3 pr-8 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-400 shadow-sm focus:shadow-md appearance-none cursor-pointer">
                                                                @foreach ($manageUnit as $item)
                                                                    <option value="{{ $item->name }}">
                                                                        {{ $item->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td
                                                    class="px-6 py-4 gap-2 font-medium text-gray-900 whitespace-nowrap dark:text-white text-center">
                                                    <input type="number" name="qty" class="rounded-lg w-16">
                                                </td>
                                                <td>
                                                    <button type="submit"
                                                        class="bg-green-500 hover:bg-green-700 rounded-lg py-2 px-4 mr-2 font-bold text-white">Submit</button>
                                                </td>
                                            </tr>
                                        </form>
                                        @foreach ($TableThreeFill as $index => $item)
                                            <tr
                                                class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                                                <th scope="row"
                                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                    {{ $index + 1 }}.
                                                </th>
                                                <td
                                                    class="px-6 py-4 gap-2 font-medium text-gray-900 whitespace-nowrap dark:text-white text-center">
                                                    {{ $item->idno }}
                                                </td>
                                                <td
                                                    class="px-6 py-4 gap-2 font-medium text-gray-900 dark:text-white text-left">
                                                    {{ $item->description }}
                                                </td>
                                                <td
                                                    class="px-6 py-4 gap-2 font-medium text-gray-900 whitespace-nowrap dark:text-white text-center">
                                                    {{ $item->unit }}
                                                </td>
                                                <td
                                                    class="px-6 py-4 gap-2 font-medium text-gray-900 whitespace-nowrap dark:text-white text-center">
                                                    {{ $item->qty }}
                                                </td>
                                                <td></td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    </table>
                                </div>
                            </div>
                        </main>
                    </div>
                </div>
                <form action="{{ route('admin.printthree.TablePDFFooterStore', ['projectId' => $projectId]) }}"
                    method="post">
                    @method('POST')
                    @csrf
                    <div class="bg-gray-200 mt-10 p-5 w-full max-h-screen-xl rounded-lg">
                        <label for="footer" class="block mb-2 text-lg font-medium text-gray-900">Fill this out for
                            the
                            footer section</label>
                        <textarea name="footer" id="footer" rows="4"
                            class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Write your footer here..."></textarea>
                        @foreach ($TablePDFFooter as $item)
                            <textarea>{{ $item->footer }}</textarea>
                        @endforeach
                        <button type="submit"
                            class="bg-green-500 hover:bg-green-700 rounded-lg py-2 px-4 mr-2 mt-4 font-bold text-white">Submit</button>
                    </div>
                </form>
                <div class="font-bold flex justify-between mt-5">
                    <p class="text-2xl text-gray-900 invisible">Total Price : Rp. {{ $totalPrice }}</p>
                    <div>
                        <button type="submit"
                            class="bg-green-500 hover:bg-green-700 rounded-lg py-2 px-4 mr-2 font-bold text-white">Submit</button>
                        <a href="{{ route('printpdf') }}" target="_blank"
                            class="hide-print text-lg shadow-lg bg-blue-700 text-white py-2 px-3 rounded-lg"><i
                                class="fa-solid fa-print"></i> Print</a>
                    </div>
                </div>
            </div>
    </section>
@endsection
