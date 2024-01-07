@extends('layouts.template')

@section('content')
<br>
<div class="jumbroton py-2 px-1">
    <h4 class="display" style="color: black;">
        Data Surat
    </h4>
    <p style="color: black;">Home / Data Surat</p>

    @if(Session::get('success'))
        <div class="alert alert-success"> {{ Session::get('success') }} </div>
    @endif

    @if(Session::get('deleted'))
        <div class="alert alert-warning"> {{ Session::get('deleted') }} </div>
    @endif
    <div class="justify-content-start d-flex">
        <a href="{{ route('letter.create') }}" class="btn btn-secondary">Tambah Pengguna</a>
        <a href="" class="btn btn-secondary" style="margin-left: 1rem">Export Data Surat</a>
    </div>

    <br>
    <table class="table table-striped table-bordered table-hover">
        <thead>
            <tr>
                <th>No</th>
                <th>Nomor Surat</th>
                <th>Perihal</th>
                <th>Tanggal Keluar</th>
                <th>Penerima Surat</th>
                <th>Notulis</th>
                <th>Hasil Rapat</th>
                <th class="text-center">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @php $no = 1; @endphp
            @foreach ($letters as $item)
                <tr>
                    <td>{{$no++}}</td>
                    <td>{{$item->letterType->letter_code}}/000{{$item->id}}/SMK Wikrama/XII/{{ date('Y') }}</td>
                    <td>{{$item->letter_perihal}}</td>
                    <td>{{$item->created_at->format('j F Y')}}</td>
                    <td>{{implode(', ', array_column($item->recipients, 'name'))}}</td>
                    <td>{{$item->user->name}}</td>
                    <td class="d-flex justify-content-center">
                        <a href="{{ route('letter.edit', $item['id']) }}" class="btn btn-primary me-3">Edit</a>
                        <a href="{{ route('letter.detail', $item['id'])}}" class="btn btn-primary me-3">Lihat</a>
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
                        <form action="{{ route('letter.delete', $item['id']) }}" method="POST">
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
