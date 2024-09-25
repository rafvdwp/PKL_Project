@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Kategori {{ $category->name }} pada Proyek {{ $projects->name }}</h1>
        <p>Data dari kategori {{ $category->name }} terkait proyek {{ $projects->name }}.</p>
    </div>

    <div>
        <table>
            <tr>
                <th>route</th>
                <th>switch</th>
                <th>hub</th>
                <th>bridge</th>
                <th>brepeater</th>
                <th>kabel utp</th>
                <th>kabel optik</th>
            </tr>
            <tr>
                <td>{{ $projects->route }}</td>
                <td>{{ $projects->switch }}</td>
                <td>{{ $projects->hub }}</td>
                <td>{{ $projects->bridge }}</td>
                <td>{{ $projects->brepeater }}</td>
                <td>{{ $projects->kabel_utp }}</td>
                <td>{{ $projects->kabel_optik }}</td>
            </tr>
        </table>
    </div>;
@endsection