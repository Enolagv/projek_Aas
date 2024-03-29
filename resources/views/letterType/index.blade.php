@extends('layouts.template')

@section('content')
<br>
<div class="jumbroton py-2 px-1">
    <h4 class="display" style="color: black;">
        Data Klasifikasi Surat
    </h4>
    <p style="color: black;">Home / Data  Klasifikasi Surat</p>

    @if(Session::get('success'))
        <div class="alert alert-success"> {{ Session::get('success') }} </div>
    @endif

    @if(Session::get('deleted'))
        <div class="alert alert-warning"> {{ Session::get('deleted') }} </div>
    @endif
    <div class="justify-content-end d-flex">
        <a style="margin-right: 860px;" href="{{ route('letterType.create') }}" class="btn btn-primary">Tambah Pengguna</a>
        <a href="{{ route('letterType.download-excel') }}" class="btn btn-success">Export Excel</a>
    </div>{{-- <button type="submit" href="#" class="btn btn-secondary">Tambah Pengguna</button> --}}
    <br>
    <table class="table table-striped table-bordered table-hover">
        <thead>
            <tr>
                <th>No</th>
                <th>Kode Surat</th>
                <th>klasifikasi Surat</th>
                <th>Surat Tertaut</th>
                <th class="text-center">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @php $no = 1; @endphp
            @foreach ($letterTypes as $item)
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ ucwords($item['letter_code']) }}</td>
                    <td>{{ $item['name_type'] }}</td>
                    <td>{{ $item['surat_tertaut']}}0</td>
                    <td class="d-flex justify-content-center">
                        <a href="" class="btn btn-primary me-3">Lihat</a>
                        <a href="{{ route('letterType.edit', $item['id']) }}" class="btn btn-primary me-3">Edit</a>
                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal-{{ $item['id']}}">Hapus</button>
                    </td>
                </tr>  
                
        <div class="modal fade" id="confirmDeleteModal-{{ $item['id']}}" tabindex="-1" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="confirmDeleteModalLabel">Konfirmasi hapus</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Yakin ingin menghapus data ini?
                        <br>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <form action="{{ route('letterType.delete', $item['id']) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Hapus</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </tbody>
</table>
        @endsection
