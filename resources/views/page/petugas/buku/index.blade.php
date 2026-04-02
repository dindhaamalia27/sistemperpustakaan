@extends('layouts.petugas.app')

@section('content')

<div class="container-fluid" style="padding-left:260px; padding-top:20px;">

    <!-- TOMBOL TAMBAH BUKU -->
    <div class="mb-4 text-end">
        <a href="{{ route('petugas.buku.create') }}" class="btn btn-success btn-sm">Tambah Buku</a>
    </div>

    <!-- LIST BUKU -->
    <div class="row">

        @foreach($buku as $item)
        <div class="col-md-3 mb-4">
            <div class="card text-center shadow-sm p-3 border-0"
                 style="border-radius:15px; background:#f1f1f1;">

                <img src="{{ asset('storage/' . $item->foto) }}"
                     class="mx-auto mb-2"
                     style="width:90px; height:130px; object-fit:cover;">

                <p class="mb-2">{{ $item->judul }}</p>

                <div class="d-flex justify-content-center gap-2">

                    <a href="{{ route('petugas.buku.detail', $item->id) }}" class="btn btn-info btn-sm">Detail</a>

                    <a href="{{ route('petugas.buku.edit', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>

                    <form action="{{ route('petugas.buku.delete', $item->id) }}" method="POST" class="m-0">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm">Hapus</button>
                    </form>

                </div>
            </div>
        </div>
        @endforeach

    </div>
</div>

@endsection
<style>
.container-fluid {
    max-height: 90vh;
    overflow-y: auto;
}

/* hilangkan scrollbar (garis abu) */
.container-fluid::-webkit-scrollbar {
    display: none;
}

.container-fluid {
    scrollbar-width: none;
}
</style>
