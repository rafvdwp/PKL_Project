@extends('layouts.app')

@section('content')
    <nav class="bg-gray-800">
        <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
            <div class="flex gap-5">
                <a href="{{ route('admin.index', ['user']) }}"
                    class="flex text-center gap-1 items-center text-white text-lg pr-4 pl-2 border border-solid rounded-xl hover:bg-gray-700">
                    <svg class="w-10 h-10 text-white text-center" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M5 12h14M5 12l4-4m-4 4 4 4" />
                    </svg>
                    Back
                </a>
                <div class="flex items-center space-x-3 rtl:space-x-reverse">
                    <span class="self-center text-2xl font-semibold whitespace-nowrap text-white">Admin Site</span>
                </div>
            </div>
            <div class="items-center justify-between w-full md:flex md:w-auto md:order-1" id="navbar-sticky">
                <ul
                    class="flex flex-col gap-3 p-4 md:p-0 mt-4 font-medium border border-gray-100 rounded-lg md:space-x-8 md:flex-row md:mt-0 md:border-0">
                    <button data-popover-target="menu"
                        class="rounded-md bg-slate-800 border  border-transparent text-center text-md text-white transition-all shadow-md hover:shadow-lg focus:bg-slate-700 focus:shadow-none active:bg-slate-700 hover:bg-slate-700 active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                        type="button">
                        Data Management
                    </button>
                    <ul role="menu" data-popover="menu" data-popover-placement="bottom"
                        class="absolute z-10 min-w-[180px] overflow-auto rounded-lg border border-slate-200 bg-white p-1.5 shadow-lg focus:outline-none">
                        <a href=" {{ route('admin.project.managesubSystem') }}">
                            <li role="menuitem"
                                class="cursor-pointer text-slate-800 flex w-full text-sm items-center rounded-md p-3 transition-all hover:bg-slate-100 focus:bg-slate-100 active:bg-slate-100">
                                Sub System Management
                            </li>
                        </a>
                        <a href=" {{ route('admin.project.manageDescription') }}">
                            <li role="menuitem"
                                class="cursor-pointer text-slate-800 flex w-full text-sm items-center rounded-md p-3 transition-all hover:bg-slate-100 focus:bg-slate-100 active:bg-slate-100">
                                Description Management
                            </li>
                        </a>
                        <a href=" {{ route('admin.manageSpecification.index') }}">
                            <li role="menuitem"
                                class="cursor-pointer text-slate-800 flex w-full text-sm items-center rounded-md p-3 transition-all hover:bg-slate-100 focus:bg-slate-100 active:bg-slate-100">
                                Specification Management
                            </li>
                        </a>
                        <a href=" {{ route('admin.manageUnit') }}">
                            <li role="menuitem"
                                class="cursor-pointer text-slate-800 flex w-full text-sm items-center rounded-md p-3 transition-all hover:bg-slate-100 focus:bg-slate-100 active:bg-slate-100">
                                Unit Management
                            </li>
                        </a>
                    </ul>
                </ul>
            </div>
        </div>
    </nav>

    <section class="bg-gray-500 bg-blend-multiply"
        style="background-image:url(https://www.rekayasa.com/wp-content/uploads/2021/06/FIP_7973-copy.jpg); background-size:cover; background-position:center; background-repeat:no-repeat; height:cover;">
        <div class="mx-auto max-w-screen-xl py-24">
            <div class="px-2 flex mx-auto max-w-screen-xl">
                <main class="w-full">
                    <div class="mx-auto max-w-8xl">
                        <div class="grid grid-cols-1 gap-4">
                            <div class="mb-2 bg-gray-800 border-solid rounded-lg shadow-sm w-full">
                                <form action="{{ route('admin.subSystemDescription.store') }}" method="post">
                                    @csrf
                                    <div
                                        class="bg-gray-700 px-3 py-3 rounded-t-lg border-solid w-full font-extrabold text-md text-gray-400">
                                        Description Management
                                    </div>
                                    <div class="p-3 block">
                                        <div class="block">
                                            <label class="block">
                                                <span class="text-sm font-bold text-gray-200">
                                                    Select Subsystem
                                                </span>
                                                <div class="block max-w-[300px] mb-3">
                                                    <select type="dropdown" value="{{ old('name') }}" name="name"
                                                        class="mr-4 mt-1 px-4 py-1 bg-gray-700 border shadow-sm border-slate-300 placeholder-slate-400 block w-full rounded-lg text-white"
                                                        required>
                                                        <option value="">Pilih subSystem</option>
                                                        @foreach ($managesubSystem as $item)
                                                            <option value="{{ $item->name }}">{{ $item->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </label>
                                            <div class="flex w-full">
                                                <div class="block w-full">
                                                    <div id="multipleInput" class="overflow-y-auto" style="max-height: 250px;">
                                                        <article>
                                                            <div class="flex w-full gap-3">
                                                                <label class="block w-full">
                                                                    <span class="text-sm font-bold text-gray-200">
                                                                        Add New Description
                                                                    </span>
                                                                    <div class="block">
                                                                        <input type="text" value="{{ old('Description_name') }}"
                                                                        name="inputs[0]['Description_name']"
                                                                        class="mr-4 mt-1 px-4 py-1 bg-gray-700 shadow-sm block w-full rounded-lg text-white"
                                                                        required autocomplete="off" />
                                                                    </div>
                                                                </label>
                                                                <label class="block w-full">
                                                                    <span class="text-sm font-bold text-gray-200">
                                                                        Add New Sub Description
                                                                    </span>
                                                                    <div class="block">
                                                                        <input type="text" value="{{ old('Description_name') }}"
                                                                        name="inputs[0]['name']"
                                                                        class="mr-4 mt-1 px-4 py-1 bg-gray-700 shadow-sm block w-full rounded-lg text-white"
                                                                        required autocomplete="off" />
                                                                    </div>
                                                                </label>
                                                                <label class="block w-1/2">
                                                                    <span class="text-sm font-bold text-gray-200">
                                                                        Add New Table            
                                                                    </span>
                                                                    <div id="addMoreInput" style="padding-top: 2.7px; padding-bottom: 2.7px;" class="mt-1 w-full flex bg-green-600 hover:bg-green-800 justify-center rounded-lg">
                                                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="w-7 h-7">
                                                                            <path fill="white"
                                                                            d="M256 80c0-17.7-14.3-32-32-32s-32 14.3-32 32l0 144L48 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l144 0 0 144c0 17.7 14.3 32 32 32s32-14.3 32-32l0-144 144 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l-144 0 0-144z" />
                                                                        </svg>
                                                                    </div>
                                                                </label>
                                                            </div>
                                                        </article>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="flex justify-end">
                                            <button
                                                class="mt-2 bg-gray-700 hover:bg-green-500 text-white font-bold py-2 px-4 rounded-full text-right">
                                                Submit
                                            </button>
                                        </div>
                                    </div>
                                    @if (session('error'))
                                        <div class="bg-red-500 text-white p-4 rounded">
                                            {{ session('error') }}
                                        </div>
                                    @endif

                                    @if (session('success'))
                                        <div class="bg-green-500 text-white p-4 rounded">
                                            {{ session('success') }}
                                        </div>
                                    @endif
                                </form>
                            </div>
                        </div>
                    </div>
                </main>
            </div>

            <div class="px-2 mx-auto max-w-screen-xl py-8">
                <div class="bg-gray-800 border border-gray-700 rounded-lg p-6 md:p-6">
                    <div class="flex mx-auto max-w-screen-xl">
                        <main class="w-full">
                            <div class="mx-auto max-w-8xl px-4 sm:px-2">
                                <div class="grid grid-cols-1 gap-4">
                                    <div class="flex">
                                        <div class="text-gray-400 font-bold h w-1/2 text-3xl pl-6">Table Description</div>
                                        <div class="w-full flex justify-end">
                                            <form class="max-w-md w-full border rounded-lg">
                                                <div class="flex">
                                                    <div class="relative w-full">
                                                        <input type="search" id="search-dropdown"
                                                            class="rounded-lg block p-2.5 w-full z-20 text-sm rounded-e-lg border-s-2 border bg-gray-700 border-s-gray-700 border-gray-600 placeholder-gray-400 text-white"
                                                            placeholder="Search Subsystem, Description" required />
                                                        <button type="submit"
                                                            class="absolute top-0 end-0 p-2.5 text-sm font-medium h-full text-white rounded-e-lg border-l border-gray-300 hover:bg-blue-600 focus:ring-4 focus:outline-none bg-gray-700">
                                                            <svg class="w-4 h-4" aria-hidden="true"
                                                                xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                viewBox="0 0 20 20">
                                                                <path stroke="currentColor" stroke-linecap="round"
                                                                    stroke-linejoin="round" stroke-width="2"
                                                                    d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                                                            </svg>
                                                            <span class="sr-only">Search</span>
                                                        </button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="overflow-y-auto" style="max-height: 65vh">
                                        <table
                                            class="table-fixed w-full text-sm text-left rounded rtl:text-right text-gray-400">
                                            <thead class="text-xs uppercase bg-gray-700 text-gray-200">
                                                <tr>
                                                    <th scope="col" class="rounded-s-lg px-6 py-3 text-center">
                                                        Subsystem
                                                    </th>
                                                    <th scope="col" class="py-3 text-center">
                                                        Description
                                                    </th>
                                                    <th scope="col" class="py-3 text-center">
                                                        Sub Description
                                                    </th>
                                                    <th scope="col" class="rounded-e-lg px-6 py-3 text-center ">
                                                        Action
                                                    </th>
                                                </tr>

                                            </thead>
                                            <tbody>
                                                @foreach ($manageDescription as $item)
                                                    <tr class="odd:bg-gray-900  even:bg-gray-900 border-b border-gray-500">
                                                        <th scope="row" class="px-6 py-4 font-medium text-white">
                                                            {{ $item->name }}
                                                        </th>
                                                        <td class="px-6 py-4 gap-2 font-medium text-white text-left"
                                                            style="max-width: 450px; word-wrap: break-word; white-space: normal; overflow-wrap: break-word;">
                                                            {{ $item->Description_name }}
                                                        </td>
                                                        <td class="px-6 py-4 gap-2 font-medium text-white text-left"
                                                            style="max-width: 450px; word-wrap: break-word; white-space: normal; overflow-wrap: break-word;">
                                                            {{ $item->Description_name }}
                                                        </td>
                                                        <td class="px-6 py-4 flex gap-2 text-center justify-center">
                                                            <form
                                                                action="{{ route('admin.project.manageDescription.delete', $item->id) }}"
                                                                method="get">
                                                                @csrf
                                                                @method('delete')
                                                                <button class="font-medium text-white rounded p-1"
                                                                    style="background-color:rgb(221, 34, 34);"><svg
                                                                        class="w-6 h-6" xmlns="http://www.w3.org/2000/svg"
                                                                        fill="none" viewBox="0 0 24 24"
                                                                        stroke-width="1.5" stroke="currentColor"
                                                                        class="size-6">
                                                                        <path stroke-linecap="round"
                                                                            stroke-linejoin="round"
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
                            </div>
                        </main>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

<script>
    var i = 0;
    $('#addMoreInput').click(function() {
        ++i;
        $('#multipleInput').append(
            `<article class="mt-2">
                <div class="flex w-full gap-3">
                    <label class="block w-full">
                        <div class="block">
                            <input type="text" value="{{ old('Description_name') }}"
                            name="inputs['+i+']['Description_name']"
                            class="mr-4 mt-1 px-4 py-1 bg-gray-700 shadow-sm block w-full rounded-lg text-white"
                            required autocomplete="off" />
                        </div>
                    </label>
                    <label class="block w-full">
                        <div class="block">
                            <input type="text" value="{{ old('Description_name') }}"
                            name="inputs[0]['name']"
                            class="mr-4 mt-1 px-4 py-1 bg-gray-700 shadow-sm block w-full rounded-lg text-white"
                            required autocomplete="off" />
                        </div>
                    </label>
                    <label class="block w-1/2">
                        <div style="padding-top: 2.7px; padding-bottom: 2.7px;" class="removeAdd mt-1 w-full flex bg-red-600 hover:bg-red-800 justify-center rounded-lg">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 448 512" class="w-7 h-7">
                                <path fill="white"
                                    d="M432 256c0 17.7-14.3 32-32 32L48 288c-17.7 0-32-14.3-32-32s14.3-32 32-32l352 0c17.7 0 32 14.3 32 32z" />
                            </svg>
                        </div>
                    </label>
                </div>
            </article> `);      
    });

    $(document).on('click', '.removeAdd', function() {
        $(this).parents('article').remove();
    });
</script>