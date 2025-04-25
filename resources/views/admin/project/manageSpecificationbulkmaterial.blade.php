@extends('layouts.app')

@section('content')
    <nav class="bg-gray-800">
        <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
            <a href="#" class="flex items-center space-x-3 rtl:space-x-reverse">
                <span class="self-center text-2xl font-semibold whitespace-nowrap text-white">Admin Site</span>
            </a>
            <div class="items-center justify-between hidden w-full md:flex md:w-auto md:order-1" id="navbar-sticky">
                <ul
                    class="flex flex-col p-4 md:p-0 mt-4 font-medium border border-gray-100 rounded-lg md:space-x-8 md:flex-row md:mt-0 md:border-0">
                    <li>
                        <a href="{{ route('admin.manageUnit') }}"
                            class="block p-1 text-white rounded hover:bg-gray-100 hover:text-gray-900">unit Management</a>
                    </li>
                </ul>
            </div>
        </div>

    </nav>



    <section class="bg-gray-500 bg-blend-multiply"
        style="background-image:url(https://www.rekayasa.com/wp-content/uploads/2021/06/FIP_7973-copy.jpg); background-size:cover; background-position:center; background-repeat:no-repeat; height:100vh;">
        <div class="px-2 mx-auto max-w-screen-xl py-24">
            <div class="bg-gray-200 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg p-6 md:p-6">
                <div class="flex mx-auto max-w-screen-xl">
                    <div class="bg-gray-700 w-8 h-12 rounded">
                        <a href="#">
                            <svg class="w-8 h-12 text-gray-800 dark:text-white text-center" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 12h14M5 12l4-4m-4 4 4 4" />
                            </svg>
                        </a>
                    </div>
                    <main class="w-full">
                        <div class="mx-auto max-w-8xl px-4 sm:px-2">
                            <div class="grid grid-cols-1 gap-4">
                                <div class="mb-2 bg-gray-900 border-solid rounded-lg shadow-sm w-full">
                                    <form action="{{ route('admin.manageSpecificationbulkmaterial.store') }}" method="post">
                                        @csrf
                                        <div
                                            class="bg-gray-700 px-3 py-3 rounded-t-lg border-solid w-full font-extrabold text-md text-gray-200">
                                            Specification Management
                                        </div>
                                        <div class="p-3 block">
                                            <div class="flex">
                                                <label class="block w-1/2">
                                                    <span class="text-sm font-bold text-white">
                                                        Select subSystem
                                                    </span>
                                                    <div class="block">
                                                        <select id="subSystem-select" name="name"
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
                                                <label class="block w-1/2 mx-2">
                                                    <span class="text-sm font-bold text-white">
                                                        Select Description
                                                    </span>
                                                    <div class="block">
                                                        <select id="Description-select" name="Description_name"
                                                            class="mr-4 mt-1 px-4 py-1 bg-gray-700 border shadow-sm border-slate-300 placeholder-slate-400 block w-full rounded-lg text-white"
                                                            required>
                                                            <option value="">Pilih Description</option>
                                                        </select>
                                                    </div>
                                                </label>
                                                <label class="block w-1/2">
                                                    <span class="text-sm font-bold text-white">
                                                        Add New Specification Name
                                                    </span>
                                                    <div class="block">
                                                        <input type="text" value="{{ old('material_type') }}"
                                                            name="material_type"
                                                            class="mr-4 mt-1 px-4 py-1 bg-gray-700 border shadow-sm border-slate-300 placeholder-slate-400 block w-full rounded-lg text-white"
                                                            required />
                                                    </div>
                                                </label>
                                            </div>
                                            <div style="right:0%;">
                                                <button
                                                    class="mt-2 bg-green-500 hover:bg-green-800 text-white font-bold py-2 px-4 rounded-full text-right">
                                                    Submit
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                                <table
                                    class="w-full text-sm text-left rounded rtl:text-right text-gray-500 dark:text-gray-400">
                                    <thead
                                        class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-200">
                                        <tr>
                                            <th scope="col" class="px-6 py-3 text-center">
                                                material_type
                                            </th>
                                            <th scope="col" class="px-6 py-3 text-center">
                                                subSystem
                                            </th>
                                            <th scope="col" class="px-6 py-3 text-center">
                                                Description Name
                                            </th>
                                            <th scope="col" class="rounded-e-lg px-6 py-3 text-center ">
                                                Action
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($manageSpecificationbulkmaterial as $item)
                                            <tr
                                                class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                                                <td
                                                    class="px-6 py-4 gap-2 font-medium text-gray-900 whitespace-nowrap dark:text-white text-center">
                                                    {{ $item->material_type }}
                                                </td>
                                                <td
                                                    class="px-6 py-4 gap-2 font-medium text-gray-900 whitespace-nowrap dark:text-white text-center">
                                                    {{ $item->name }}
                                                </td>
                                                <td
                                                    class="px-6 py-4 gap-2 font-medium text-gray-900 whitespace-nowrap dark:text-white text-center">
                                                    {{ $item->Description_name }}
                                                </td>
                                                <td class="px-6 py-4 flex gap-2 justify-center">
                                                    <form action="{{ route('admin.manageSpecification.delete', $item->id) }}" method="get">
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
        </div>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const subSystemSelect = document.getElementById('subSystem-select');
            const DescriptionSelect = document.getElementById('Description-select');

            // Function to update Descriptions based on selected subSystem
            function updateDescription(subSystemName) {
                // Clear current options
                DescriptionSelect.innerHTML = '<option value="">Pilih Description</option>';

                if (subSystemName) {
                    // Fetch Descriptions for selected subSystem
                    fetch(`/admin/get-Descriptions/${subSystemName}`)
                        .then(response => response.json())
                        .then(Descriptions => {
                            Descriptions.forEach(Description => {
                                const option = document.createElement('option');
                                option.value = Description.Description_name;
                                option.textContent = Description.Description_name;
                                DescriptionSelect.appendChild(option);
                            });
                        });
                }
            }

            // Add event listener to subSystem select
            subSystemSelect.addEventListener('change', function() {
                updateDescription(this.value);
            });
        });
    </script>
@endsection
