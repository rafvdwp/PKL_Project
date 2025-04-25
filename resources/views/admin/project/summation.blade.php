@extends('layouts.app')

@section('content')
    <nav class="bg-gray-800">
        <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
            <a href="#" class="flex items-center space-x-3 rtl:space-x-reverse">
                <span class="self-center text-2xl font-semibold whitespace-nowrap text-white">Admin Site</span>
            </a>
        </div>
    </nav>

    <section class="bg-gray-500 bg-blend-multiply"
        style="background-image:url(https://www.rekayasa.com/wp-content/uploads/2021/06/FIP_7973-copy.jpg); background-size:cover; background-position:center; background-repeat:no-repeat; height:100vh;">
        <div class="px-2 mx-auto max-w-screen-xl py-24">
            <div class="bg-gray-200 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg p-6 md:p-6">
                <div class="flex mx-auto max-w-screen-xl">
                    <div class="bg-gray-700 w-8 h-12 rounded">
                        <a href="{{ route('admin.index') }}">
                            <svg class="w-8 h-12 text-gray-800 dark:text-white text-center" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 12h14M5 12l4-4m-4 4 4 4" />
                            </svg>
                        </a>
                    </div>

                    <div class="bg-gray-700 w-8 h-12 rounded">
                        <a href="{{ route('admin.printthree', ['projectId' => $projectId]) }}">
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
                                <table
                                    class="w-full text-sm text-left rounded rtl:text-right text-gray-500 dark:text-gray-400">
                                    <thead
                                        class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-200">
                                        <tr>

                                            <th scope="col" class="rounded-s-lg px-6 py-3">
                                                No.
                                            </th>
                                            <th scope="col" class="px-6 py-3 text-center">
                                                Description
                                            </th>
                                            <th scope="col" class="px-6 py-3 text-center">
                                                Specification
                                            </th>
                                            <th scope="col" class="px-6 py-3 text-center">
                                                Port Number
                                            </th>
                                            <th scope="col" class="px-6 py-3 text-center">
                                                Qty.
                                            </th>
                                            <th scope="col" class="px-6 py-3 text-center">
                                                Unit
                                            </th>
                                            <th scope="col" class="px-6 py-3 text-center">
                                                Unit Price
                                            </th>
                                            <th scope="col" class="rounded-e-lg px-6 py-3 text-center">
                                                Sub Total
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($Specifiation as $item)
                                            <tr
                                                class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                                                <th scope="row"
                                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                    {{ $loop->iteration }}
                                                </th>
                                                <td
                                                    class="px-6 py-4 gap-2 font-medium text-gray-900 whitespace-nowrap dark:text-white text-center">
                                                    {{ $item->subSystemDescription->Description_name }}
                                                </td>
                                                <td
                                                    class="px-6 py-4 gap-2 font-medium text-gray-900 whitespace-nowrap dark:text-white text-center">
                                                    {{ $item->specification }}
                                                </td>
                                                <td
                                                    class="px-6 py-4 gap-2 font-medium text-gray-900 whitespace-nowrap dark:text-white text-center">
                                                    {{ $item->part_number }}
                                                </td>
                                                <td
                                                    class="px-6 py-4 gap-2 font-medium text-gray-900 whitespace-nowrap dark:text-white text-center">
                                                    {{ $item->qty }}
                                                </td>
                                                <td
                                                    class="px-6 py-4 gap-2 font-medium text-gray-900 whitespace-nowrap dark:text-white text-center">
                                                    {{ $item->unit }}
                                                </td>
                                                <td
                                                    class="px-6 py-4 gap-2 font-medium text-gray-900 whitespace-nowrap dark:text-white text-center">
                                                    {{ $item->unit_price }}
                                                </td>
                                            </tr>
                                        @endforeach

                                        </tr>
                                    </tbody>
                                </table>
                                <div class="font-bold text-xl text-gray-900 dark:text-white">
                                    Total Price : Rp. {{ $totalPrice }}
                                </div>
                            </div>
                        </div>
                    </main>
                </div>
            </div>
        </div>
    </section>
@endsection
