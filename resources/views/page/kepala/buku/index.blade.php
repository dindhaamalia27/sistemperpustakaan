@extends('layouts.kepala.app')

@section('content')

<div class="container-fluid" style="padding-left:260px; padding-top:20px;">

    <!-- SEARCH -->
    <form method="GET" action="{{ route('kepala.buku.index') }}">
        <div class="mb-4 position-relative">

            <i class="ti ti-search"
               style="position:absolute; top:50%; left:15px; transform:translateY(-50%); color:#999;">
            </i>

            <input type="text"
                   name="search"
                   class="form-control"
                   placeholder="Cari buku"
                   value="{{ request('search') }}"
                   style="padding-left:40px;">
        </div>
    </form>

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
