@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Kategori {{ $category->name }} pada Proyek {{ $projects->name }}</h1>
        <p>Data dari kategori {{ $category->name }} terkait proyek {{ $projects->name }}.</p>
        tampilan radios
    </div>
@endsection
