@extends('layouts.template')

@section('content')
    <form action="{{ route('letterType.store') }}" method="POST" class="card p-5">
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
                Tambah Data Klasifikasi Surat
            </h4>
            @if (Session::get('failed'))
            <div class="alert alert-danger">{{ Session::get('failed')}}</div>
            @endif
            <p style="color:steelblue;">Home / Data Klasifikasi Surat/ Tambah Data Klasifikasi Surat</p>
        
        <div class="mb-3 row">
            <label for="letter_code" class="col-sm-2 col-form-label">Kode Surat :</label>
            <div class="col-sm-10">
                <input type="number" class="form-control" id="letter_code" name="letter_code">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="name_type" class="col-sm-2 col-form-label">Klasifikasi Surat :</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="name_type" name="name_type">
            </div>
        </div>
        <button type="submit" class="btn btn-primary mt-3">Tambah data</button>
    </form>
@endsection