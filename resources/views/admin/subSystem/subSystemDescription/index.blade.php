@extends('admin.project.show')

@section('showLayout')
    <div class="block w-full">
        <div class="flex mr-5 my-5 text-center h-10 text-2xl font-extrabold justify-between">
            <form
                action="{{ route('admin.project.subSystem.edit', ['project' => $project->id, 'subSystem' => $subSystem->id]) }}"
                method="POST" id="categoryForm">
                @csrf
                @method('PUT')
                <select class="block appearance-none w-full border-grey-200 text-grey-darker py-3 px-4 pr-8 rounded-lg"
                    id="categorySelect" name="category" onchange="this.form.submit()">
                    <option value="bulk_material" {{ $subSystem->category == 'bulk_material' ? 'selected' : '' }}>Bulk
                        Material</option>
                    <option value="budgetary" {{ $subSystem->category == 'budgetary' ? 'selected' : '' }}>Budgetary
                    </option>
                </select>
            </form>
            <div class="flex gap-3">
                <button
                    class="flex items-center gap-2 bg-blue-500 text-white hover:bg-blue-800 rounded-lg font-bold px-3 text-center"
                    onclick="window.location.href='{{ route('export.specification.budgetary', ['id' => $projectId]) }}'">
                    <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                        <path fill="white"
                            d="M128 0C92.7 0 64 28.7 64 64l0 96 64 0 0-96 226.7 0L384 93.3l0 66.7 64 0 0-66.7c0-17-6.7-33.3-18.7-45.3L400 18.7C388 6.7 371.7 0 354.7 0L128 0zM384 352l0 32 0 64-256 0 0-64 0-16 0-16 256 0zm64 32l32 0c17.7 0 32-14.3 32-32l0-96c0-35.3-28.7-64-64-64L64 192c-35.3 0-64 28.7-64 64l0 96c0 17.7 14.3 32 32 32l32 0 0 64c0 35.3 28.7 64 64 64l256 0c35.3 0 64-28.7 64-64l0-64zM432 248a24 24 0 1 1 0 48 24 24 0 1 1 0-48z" />
                    </svg>
                    BUDGETARY
                </button>

                <button
                    class="flex items-center gap-2 bg-red-600 text-white hover:bg-red-800 font-bold rounded-lg px-3 py-1.5 text-center"
                    onclick="window.location.href='{{ route('export.specification.bulk_material', ['id' => $projectId]) }}'">
                    <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                        <path fill="white"
                            d="M128 0C92.7 0 64 28.7 64 64l0 96 64 0 0-96 226.7 0L384 93.3l0 66.7 64 0 0-66.7c0-17-6.7-33.3-18.7-45.3L400 18.7C388 6.7 371.7 0 354.7 0L128 0zM384 352l0 32 0 64-256 0 0-64 0-16 0-16 256 0zm64 32l32 0c17.7 0 32-14.3 32-32l0-96c0-35.3-28.7-64-64-64L64 192c-35.3 0-64 28.7-64 64l0 96c0 17.7 14.3 32 32 32l32 0 0 64c0 35.3 28.7 64 64 64l256 0c35.3 0 64-28.7 64-64l0-64zM432 248a24 24 0 1 1 0 48 24 24 0 1 1 0-48z" />
                    </svg>
                    BULK
                </button>

                <button
                    class="flex items-center gap-2 text-white bg-gray-500 hover:bg-gray-800 rounded-lg px-3 text-center font-bold"
                    onclick="window.location.href='{{ route('admin.printthree', ['projectId' => $projectId]) }}'">
                    <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                        <path fill="white"
                            d="M128 0C92.7 0 64 28.7 64 64l0 96 64 0 0-96 226.7 0L384 93.3l0 66.7 64 0 0-66.7c0-17-6.7-33.3-18.7-45.3L400 18.7C388 6.7 371.7 0 354.7 0L128 0zM384 352l0 32 0 64-256 0 0-64 0-16 0-16 256 0zm64 32l32 0c17.7 0 32-14.3 32-32l0-96c0-35.3-28.7-64-64-64L64 192c-35.3 0-64 28.7-64 64l0 96c0 17.7 14.3 32 32 32l32 0 0 64c0 35.3 28.7 64 64 64l256 0c35.3 0 64-28.7 64-64l0-64zM432 248a24 24 0 1 1 0 48 24 24 0 1 1 0-48z" />
                    </svg>
                    PDF
                </button>
            </div>
            <button data-modal-target="add-modal" data-modal-toggle="add-modal" class="rounded-xl px-2 bg-green-500 hover:bg-green-800">
                <svg class="w-8 h-8" fill="white" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                        d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                        clip-rule="evenodd"></path>
                </svg>
            </button>
            {{-- <div class="flex gap-3">
                <button
                    class="flex items-center gap-2 bg-blue-500 text-white hover:bg-blue-800 rounded-lg font-bold px-3 text-center"
                    onclick="window.location.href='{{ route('export.specification.budgetary', ['id' => $projectId]) }}'">
                    <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                        <path fill="white"
                            d="M128 0C92.7 0 64 28.7 64 64l0 96 64 0 0-96 226.7 0L384 93.3l0 66.7 64 0 0-66.7c0-17-6.7-33.3-18.7-45.3L400 18.7C388 6.7 371.7 0 354.7 0L128 0zM384 352l0 32 0 64-256 0 0-64 0-16 0-16 256 0zm64 32l32 0c17.7 0 32-14.3 32-32l0-96c0-35.3-28.7-64-64-64L64 192c-35.3 0-64 28.7-64 64l0 96c0 17.7 14.3 32 32 32l32 0 0 64c0 35.3 28.7 64 64 64l256 0c35.3 0 64-28.7 64-64l0-64zM432 248a24 24 0 1 1 0 48 24 24 0 1 1 0-48z" />
                    </svg>
                    BUDGETARY
                </button>

                <button
                    class="flex items-center gap-2 bg-red-600 text-white hover:bg-red-800 font-bold rounded-lg px-3 py-1.5 text-center"
                    onclick="window.location.href='{{ route('export.specification.bulk_material', ['id' => $projectId]) }}'">
                    <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                        <path fill="white"
                            d="M128 0C92.7 0 64 28.7 64 64l0 96 64 0 0-96 226.7 0L384 93.3l0 66.7 64 0 0-66.7c0-17-6.7-33.3-18.7-45.3L400 18.7C388 6.7 371.7 0 354.7 0L128 0zM384 352l0 32 0 64-256 0 0-64 0-16 0-16 256 0zm64 32l32 0c17.7 0 32-14.3 32-32l0-96c0-35.3-28.7-64-64-64L64 192c-35.3 0-64 28.7-64 64l0 96c0 17.7 14.3 32 32 32l32 0 0 64c0 35.3 28.7 64 64 64l256 0c35.3 0 64-28.7 64-64l0-64zM432 248a24 24 0 1 1 0 48 24 24 0 1 1 0-48z" />
                    </svg>
                    BULK
                </button>

                <button
                    class="flex items-center gap-2 text-white bg-gray-500 hover:bg-gray-800 rounded-lg px-3 text-center font-bold"
                    onclick="window.location.href='{{ route('admin.printthree', ['projectId' => $projectId]) }}'">
                    <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                        <path fill="white"
                            d="M128 0C92.7 0 64 28.7 64 64l0 96 64 0 0-96 226.7 0L384 93.3l0 66.7 64 0 0-66.7c0-17-6.7-33.3-18.7-45.3L400 18.7C388 6.7 371.7 0 354.7 0L128 0zM384 352l0 32 0 64-256 0 0-64 0-16 0-16 256 0zm64 32l32 0c17.7 0 32-14.3 32-32l0-96c0-35.3-28.7-64-64-64L64 192c-35.3 0-64 28.7-64 64l0 96c0 17.7 14.3 32 32 32l32 0 0 64c0 35.3 28.7 64 64 64l256 0c35.3 0 64-28.7 64-64l0-64zM432 248a24 24 0 1 1 0 48 24 24 0 1 1 0-48z" />
                    </svg>
                    PDF
                </button>
            </div> --}}
        </div>


        <!-- Master Checkbox -->
        <div class="flex text-2xl items-center mb-4 justify-between w-full">
            <div class="flex">
                <input id="master-checkbox" type="checkbox" value=""
                    class="w-6 h-6 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                    onchange="toggleAllTables()">
                <label for="master-checkbox" class="ms-2 text-lg font-medium text-gray-900 dark:text-gray-300">
                    Toggle All Tables
                </label>
            </div>
            <div class="relative" style="margin-right: 1.25rem">
                <input class="border-2 border-gray-300 bg-white h-12 rounded-lg text-sm focus:outline-none flex-grow"
                    style="padding-right:3.5rem; width:425px;" type="text" name="search" placeholder="Search">
                <button type="submit" class="absolute right-0 top-0 mt-4 mr-5">
                    <svg class="text-gray-600 h-5 w-5 fill-current" xmlns="http://www.w3.org/2000/svg"
                        xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px"
                        viewBox="0 0 56.966 56.966" style="enable-background:new 0 0 56.966 56.966;" xml:space="preserve"
                        width="512px" height="512px">
                        <path
                            d="M55.146,51.887L41.588,37.786c3.486-4.144,5.396-9.358,5.396-14.786c0-12.682-10.318-23-23-23s-23,10.318-23,23  s10.318,23,23,23c4.761,0,9.298-1.436,13.177-4.162l13.661,14.208c0.571,0.593,1.339,0.92,2.162,0.92  c0.779,0,1.518-0.297,2.079-0.837C56.255,54.982,56.293,53.08,55.146,51.887z M23.984,6c9.374,0,17,7.626,17,17s-7.626,17-17,17  s-17-7.626-17-17S14.61,6,23.984,6z" />
                    </svg>
                </button>
            </div>
        </div>

        @foreach ($subSystemDescription as $item)
            <div class="flex flex-row bg-gray-50 mr-5 p-5 rounded-xl shadow-lg mb-8">
                <div class="w-full">
                    <div class="flex justify-between items-center">
                        <div class="mb-4 overflow-y-auto" style="width:750px; height:80px;">
                            <h2 class="text-xl uppercase font-extrabold">
                                {{ $item->Description_name }}
                            </h2>
                        </div>
                        <div class="flex" style="gap: 4rem;">
                            <label>
                                <h2 class="text-xl font-bold">
                                    {{ $item->Description_jumlah }}
                                </h2>
                            </label>
                            <label>
                                <h2 class="text-xl font-bold">
                                    {{-- {{ $item->??? }} --}}
                                    Rp. 10.000
                                </h2>
                            </label>
                            <label>
                                <h2 class="text-xl mr-2 font-bold">
                                    {{-- {{ $item->??? }} --}}
                                    Rp. 100.000.000
                                </h2>
                            </label>
                        </div>
                    </div>
                    <div class="flex text-2xl mb-3 justify-between">
                        <h2 class="font-semibold">
                            Specification Table
                        </h2>
                        <div class="flex gap-5">
                            <div class="flex">
                                <input id="table-toggle-checkbox-{{ $item->id }}" type="checkbox" value=""
                                    class="table-checkbox w-6 h-6 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                                    onchange="toggleTable({{ $item->id }})">
                                <label for="table-toggle-checkbox-{{ $item->id }}"
                                    class="ms-2 text-lg font-medium text-gray-900 dark:text-gray-300">
                                    Show Table
                                </label>
                            </div>
                            <form
                                action="{{ route('project.description.delete', ['project' => $item, 'subSystem' => $item]) }}"
                                method="get">
                                @method('delete')
                                <button class="rounded-xl text-white px-2 h-7 bg-red-600">
                                    <svg class="h-7 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                        <path fill="white"
                                            d="M432 256c0 17.7-14.3 32-32 32L48 288c-17.7 0-32-14.3-32-32s14.3-32 32-32l352 0c17.7 0 32 14.3 32 32z" />
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </div>
                    {{-- <div class="flex text-2xl mb-3 justify-between">
                        <h2 class="font-semibold">
                            Specification Table
                        </h2>
                        <div class="flex gap-5">
                            <div class="flex">
                                <input id="table-toggle-checkbox-{{ $item->id }}" type="checkbox" value=""
                                    class="table-checkbox w-6 h-6 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                                    onchange="toggleTable({{ $item->id }})">
                                <label for="table-toggle-checkbox-{{ $item->id }}"
                                    class="ms-2 text-lg font-medium text-gray-900 dark:text-gray-300">
                                    Show Table
                                </label>
                            </div>
                            <button data-modal-target="subAdd-modal-{{ $item->id }}"
                                data-modal-toggle="subAdd-modal-{{ $item->id }}" class="rounded-xl text-white px-2 h-8"
                                style="background-color: rgb(41, 165, 16)">
                                <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                                        clip-rule="evenodd"></path>
                                </svg>
                            </button>
                        </div>
                    </div> --}}
                    <table id="table-section-{{ $item->id }}" class="w-full divide-y divide-gray-200">
                        <thead class="bg-gray-200">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-xs font-medium text-gray-500 uppercase">
                                    Specification
                                </th>
                                <th scope="col" class="px-6 py-3 text-xs font-medium text-gray-500 uppercase">
                                    Part Number</th>
                                <th scope="col" class="px-6 py-3 text-xs font-medium text-gray-500 uppercase">Unit
                                </th>
                                <th scope="col" class="px-6 py-3 text-xs font-medium text-gray-500 uppercase">qty
                                </th>
                                <th scope="col" class="px-6 py-3 text-xs font-medium text-gray-500 uppercase">Unit
                                    Price
                                </th>
                                <th scope="col" class="px-6 py-3 text-xs font-medium text-gray-500 uppercase">Total
                                    Price
                                </th>
                                <th scope="col" class="px-6 py-3 text-xs font-medium text-gray-500 uppercase">ACTION
                                </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y bg-gray-100 divide-gray-200 text-center">
                            @foreach ($specification[$item->id] ?? [] as $spec)
                                <tr>
                                    <td class="px-6 py-2 text-md font-medium text-gray-800 break-words text-left">
                                        {{ $spec->specification }}
                                    </td>
                                    <td class="px-6 py-2 whitespace-nowrap text-sm text-gray-800 justify-center">
                                        <input name="part_number" type="text"
                                            class= "text-sm w-full rounded-lg focus:ring-primary-500 focus:border-primary-500 block p-2.5"
                                            placeholder="Part Number" required>
                                    </td>
                                    <td class="px-6 py-2 whitespace-nowrap text-sm text-gray-800">
                                        <select name="" id="" class="rounded-lg"
                                            style="max-width:75px;">
                                            <option value=""></option>
                                            <option value="">TestTTTTTTTTTT</option>
                                        </select>
                                    </td>
                                    <td class="px-6 py-2 whitespace-nowrap text-sm text-gray-800">
                                        {{ $spec->qty }}
                                    </td>
                                    <td class="px-6 py-2 whitespace-nowrap text-sm text-gray-800">
                                        {{-- Rp. {{ number_format($spec->unit_price, 2) }} --}}
                                        Unit Price Description
                                    </td>
                                    <td class="px-6 py-2 whitespace-nowrap text-sm text-gray-800">
                                        Rp. {{ number_format($spec->unit_price, 2) }}
                                    </td>

                                    <td class="px-6 pt-6 flex gap-3 text-gray-800">
                                        <button type="submit"
                                            class="text-white w-full inline-flex items-center focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm py-2 px-3 text-center justify-center bg-green-500 hover:bg-green-800">
                                            Add
                                        </button>
                                        <button data-modal-target="editModal" data-modal-toggle="editModal"
                                            class="text-white w-full inline-flex items-center focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm py-2 px-3 text-center justify-center bg-yellow-400">
                                            Edit
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div id="editModal" tabindex="-1" aria-hidden="true"
                class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                <div class="relative p-4 max-h-full" style="max-width: 400px;">
                    <div class="relative pt-4 px-4 bg-white rounded-lg shadow dark:bg-gray-700 pl-4">
                        <div class="flex gap-3">
                            <div class="flex justify-between items-center overflow-x-auto whitespace-nowrap w-full">
                                <h2 class="text-2xl uppercase font-extrabold">{{ $item->Description_name }}</h2>
                            </div>
                        </div>
                        <form class="py-4 md:py-5"
                            action="{{ route('specification.store', ['project' => $project->id, 'subSystem' => $subSystem->id, 'subSystemDescription' => $item->id]) }}"
                            method="post">
                            @csrf
                            <div class="grid w-full gap-4 mb-4 grid-cols-1">
                                <div class="col-span-1 sm:col-span-1">
                                    <div class="flex gap-5 mt-2">
                                        <input name="part_number" type="text"
                                        class="h-10 bg-gray-100 w-full  border border-gray-300 text-gray-900 text-sm rounded-lg"
                                        placeholder="Part Number" required>
                                        <select name="unit" id="unit-{{ $item->id }}"
                                            class="bg-gray-100 w-1/2 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block p-2.5">
                                            <option value="" selected>Unit</option>
                                            @if (isset($manageSpecification[$item->id]))
                                                @foreach ($manageSpecification[$item->id] as $specName)
                                                    <option value="{{ $specName }}">{{ $specName }}
                                                    </option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <button type="submit"
                                class="text-white w-full inline-flex items-center focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm py-2 px-3 text-center justify-center bg-yellow-400">
                                Edit
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <div id="subAdd-modal-{{ $item->id }}" tabindex="-1" aria-hidden="true"
                class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                <div class="relative p-4 max-h-full" style="max-width: 800px;">
                    <div class="relative pt-4 px-4 bg-white rounded-lg shadow dark:bg-gray-700 pl-4">
                        <div class="flex gap-3">
                            <div class="flex justify-between items-center overflow-x-auto whitespace-nowrap w-full">
                                <h2 class="text-2xl uppercase font-extrabold">{{ $item->Description_name }}</h2>
                            </div>
                        </div>
                        <form class="py-4 md:py-5"
                            action="{{ route('specification.store', ['project' => $project->id, 'subSystem' => $subSystem->id, 'subSystemDescription' => $item->id]) }}"
                            method="post">
                            @csrf
                            <div class="grid w-full gap-4 mb-4 grid-cols-1">
                                <div class="col-span-1 sm:col-span-1">
                                    <div class="flex gap-5 mt-2">
                                        <select name="specification" id="specification-{{ $item->id }}"
                                            class="bg-gray-100 w-full border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block p-2.5">
                                            <option value="" selected> Specification</option>
                                            @if (isset($manageSpecification[$item->id]))
                                                @foreach ($manageSpecification[$item->id] as $specName)
                                                    <option value="{{ $specName }}">{{ $specName }}
                                                    </option>
                                                @endforeach
                                            @endif
                                        </select>
                                        <input name="qty" type="number"
                                            class="h-10 bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg"
                                            placeholder="qty" required>
                                    </div>
                                </div>
                            </div>
                            <button type="submit"
                                class="text-white w-full inline-flex items-center focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm py-2 px-3 text-center justify-center bg-green-500 hover:bg-green-800">
                                Add
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
        <div class="sticky flex p-5 mr-5 bg-gray-100 items-center rounded-xl shadow-xl justify-between">
            <div class="w-1/2">
                {{-- Total subSystem --}}
                <div class="mb-6 pb-4 border-b border-gray-300">
                    <h2 class="text-xl font-semibold text-gray-600">Total Sub System {{ $subSystem->name }}</h2>
                    <h2 class="text-3xl font-bold text-green-600">Rp.
                        {{ number_format($summationsubSystem, 0, ',', '.') }}</h2>
                </div>

                {{-- Total Project --}}
                <div class="mb-6 pb-4 border-b border-gray-300">
                    <h2 class="text-xl font-semibold text-gray-600">Total Project {{ $project->name }}</h2>
                    <h2 class="text-3xl font-bold text-blue-600">Rp.
                        {{ number_format($summationProject, 0, ',', '.') }}</h2>
                </div>
            </div>
            <a type="button" href="{{ route('admin.summation', ['projectId' => $project->id]) }}"
                class="bg-blue-500 hover:bg-blue-600 rounded-lg p-2 px-4 text-white transition-colors">
                View More Details
            </a>
        </div>
        <br>
        <div id="add-modal" tabindex="-1" aria-hidden="true"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-md max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                        Select Description
                    </h3>
                    <button type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-toggle="add-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <form class="p-4 md:p-5" id="form_id"
                    action="{{ route('subSystemDescription.store', ['project' => $project->id, 'subSystem' => $subSystem->id]) }}"
                    method="POST">
                    @csrf
                    <div class="grid gap-4 mb-4 grid-cols-2">
                        <div class="col-span-2 sm:col-span-1">
                            <select name="Description_name" id="subSystem"
                                class="bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5">
                                <option value="" selected>Select an item for {{ $subSystem->name }}</option>
                                @foreach ($manageDescription as $item)
                                    <option value="{{ $item->Description_name }}">
                                        {{ $item->Description_name }}</option>
                                @endforeach
                            </select>

                        </div>
                        <div class="col-span-2 sm:col-span-1">
                            <input name="Description_jumlah" type="number"
                                class="h-10 w-20 bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg"
                                placeholder="Jumlah" required>
                        </div>
                    </div>
                    <button type="submit"
                        class="text-white inline-flex items-center focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm py-2 px-3 text-center bg-green-500 hover:bg-green-800">
                        Add
                    </button>
                </form>
            </div>
        </div>
    </div>  
        <script>
            function toggleTable(itemId) {
                const checkbox = document.getElementById(`table-toggle-checkbox-${itemId}`);
                const tableSection = document.getElementById(`table-section-${itemId}`);
                tableSection.style.display = checkbox.checked ? 'table' : 'none';

                // Check if all checkboxes are checked
                updateMasterCheckbox();
            }

            // Function to toggle all tables
            function toggleAllTables() {
                const masterCheckbox = document.getElementById('master-checkbox');
                const allCheckboxes = document.getElementsByClassName('table-checkbox');
                const allTables = document.querySelectorAll('[id^="table-section-"]');

                // Update all checkboxes and tables
                Array.from(allCheckboxes).forEach((checkbox, index) => {
                    checkbox.checked = masterCheckbox.checked;
                    allTables[index].style.display = masterCheckbox.checked ? 'table' : 'none';
                });
            }

            // Function to update master checkbox state
            function updateMasterCheckbox() {
                const masterCheckbox = document.getElementById('master-checkbox');
                const allCheckboxes = document.getElementsByClassName('table-checkbox');
                const allChecked = Array.from(allCheckboxes).every(checkbox => checkbox.checked);

                // Update master checkbox without triggering its onchange
                masterCheckbox.checked = allChecked;
            }

            // Initialize on page load
            window.onload = function() {
                // Hide all tables initially
                const tables = document.querySelectorAll('[id^="table-section-"]');
                tables.forEach(table => {
                    table.style.display = 'none';
                });

                // Ensure master checkbox is unchecked
                document.getElementById('master-checkbox').checked = false;

                // Ensure all individual checkboxes are unchecked
                const allCheckboxes = document.getElementsByClassName('table-checkbox');
                Array.from(allCheckboxes).forEach(checkbox => {
                    checkbox.checked = false;
                });
            }

            function toggleButtons() {
                const checkbox = document.getElementById('checked-checkbox');
                const summationButton = document.getElementById('summation-button');
                const listProjectButton = document.getElementById('list-project-button');

                if (checkbox.checked) {
                    summationButton.style.display = 'inline-block';
                    listProjectButton.style.display = 'none';
                } else {
                    summationButton.style.display = 'none';
                    listProjectButton.style.display = 'block';
                }
            }
        </script>
    @endsection
