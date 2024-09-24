@extends('layouts.app')

@section('content')
    <h2>Tambah SubKategori untuk Kategori: {{ $category->name }}</h2>

    <form action="{{ route('subcategories.store', $category->id) }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Nama SubKategori</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('projects.show', $category->project_id) }}" class="btn btn-secondary">Kembali</a>
    </form>
@endsection
