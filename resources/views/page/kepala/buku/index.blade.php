@extends('layouts.kepala.app')

@section('content')

<div class="container-fluid" style="padding-left:260px; padding-top:20px;">

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

                <div class="d-flex justify-content-center">

                    <a href="{{ route('kepala.buku.detail', $item->id) }}" class="btn btn-info btn-sm">Detail</a>

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
