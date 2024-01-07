@extends('layouts.template')

@section('content')
    <form action="{{ route('guru.store') }}" method="POST" class="card p-5">
        @csrf

        @if(Session::get('success'))
            <div class="alert alert-success"> {{ Session::get('success') }} </div>
        @endif
        @if($errors->any())
            <ul class="alert alert-danger">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif
        <div class="jumbroton py-2 px-3">
            <h4 class="display" style="color:royalblue;">
                Tambah Data Guru
            </h4>
            @if (Session::get('failed'))
            <div class="alert alert-danger">{{ Session::get('failed')}}</div>
            @endif
            <p style="color:steelblue;">Home / Data User/ Data Guru / Tambah Data Guru</p>
        <div class="mb-3 row">
            <label for="name" class="col-sm-2 col-form-label">Name :</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="name" name="name">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="price" class="col-sm-2 col-form-label">Email :</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="email" name="email">
            </div>
        </div>
        <button type="submit" class="btn btn-primary mt-3">Tambah data</button>
    </form>
@endsection