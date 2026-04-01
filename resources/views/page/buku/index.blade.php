@extends('layouts.app')

@section('content')

<div class="container-fluid" style="padding-left:260px; padding-top:20px;">

<!-- SEARCH -->
<form method="GET" action="{{ route('buku.index') }}">
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

@php $search = strtolower(request('search')); @endphp

<!-- BUKU 1 -->
@if(!$search || str_contains('si tudung merah', $search))
<div class="col-md-3 mb-4">
    <div class="card text-center shadow-sm p-3 border-0"
         style="border-radius:15px; background:#f1f1f1;">

        <img src="{{ asset('storage/tudung merah.jpg') }}"
             class="mx-auto mb-2"
             style="width:90px; height:130px; object-fit:foto;">

        <p class="mb-2">Si Tudung Merah</p>

        <div>
            <a href="/buku/1/pinjam" class="btn btn-primary btn-sm">Pinjam</a>
            <a href="/buku/1" class="btn btn-info btn-sm">Detail</a>
        </div>
    </div>
</div>
@endif

<!-- BUKU 2 -->
@if(!$search || str_contains('angkasa', $search))
<div class="col-md-3 mb-4">
    <div class="card text-center shadow-sm p-3 border-0"
         style="border-radius:15px; background:#f1f1f1;">

        <img src="{{ asset('storage/angkasa.jpg') }}"
             class="mx-auto mb-2"
             style="width:90px; height:130px; object-fit:foto;">

        <p class="mb-2">Angkasa</p>

        <div>
            <a href="/buku/2/pinjam" class="btn btn-primary btn-sm">Pinjam</a>
            <a href="/buku/2" class="btn btn-info btn-sm">Detail</a>
        </div>
    </div>
</div>
@endif

<!-- BUKU 3 -->
@if(!$search || str_contains('bahasa indonesia', $search))
<div class="col-md-3 mb-4">
    <div class="card text-center shadow-sm p-3 border-0"
         style="border-radius:15px; background:#f1f1f1;">

        <img src="{{ asset('storage/indonesia.jpg') }}"
             class="mx-auto mb-2"
             style="width:90px; height:130px; object-fit:foto;">

        <p class="mb-2">Bahasa Indonesia</p>

        <div>
            <a href="/buku/3/pinjam" class="btn btn-primary btn-sm">Pinjam</a>
            <a href="/buku/3" class="btn btn-info btn-sm">Detail</a>
        </div>
    </div>
</div>
@endif

<!-- BUKU 4 -->
@if(!$search || str_contains('adiku yang hilang', $search))
<div class="col-md-3 mb-4">
    <div class="card text-center shadow-sm p-3 border-0"
         style="border-radius:15px; background:#f1f1f1;">

        <img src="{{ asset('storage/adiku yang hilang.jpg') }}"
             class="mx-auto mb-2"
             style="width:90px; height:130px; object-fit:foto;">

        <p class="mb-2">Adiku yang Hilang</p>

        <div>
            <button class="btn btn-warning btn-sm">Dipinjam</button>
            <a href="/buku/4" class="btn btn-info btn-sm">Detail</a>
        </div>
    </div>
</div>
@endif

</div>
</div>
@endsection
