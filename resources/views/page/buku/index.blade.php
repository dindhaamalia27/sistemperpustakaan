@extends('layouts.app')

@section('content')

<div class="container-fluid" style="padding-left:260px; padding-top:20px;">

<!-- Form pencarian buku -->
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

<!-- Daftar buku -->
<div class="row">

@php $search = strtolower(request('search')); @endphp

{{-- Loop untuk menampilkan buku dari database --}}
@foreach($buku as $item)
<div class="col-md-3 mb-4">
    <div class="card text-center shadow-sm p-3 border-0"
         style="border-radius:15px; background:#f1f1f1;">

        <img src="{{ asset('storage/' . $item->foto) }}"
             class="mx-auto mb-2"
             style="width:90px; height:130px; object-fit:cover;">

        <p class="mb-2">{{ $item->judul }}</p>

        <div>

            @php
                // Hitung jumlah peminjaman aktif berdasarkan buku_id
                $dipinjam = \App\Models\Peminjaman::where('buku_id', $item->id)
                    ->where('status', 'dipinjam')
                    ->count();

                $stok = $item->stok ?? 1;

                // Cek apakah user sudah meminjam buku ini
                $sudahPinjamBukuIni = \App\Models\Peminjaman::where('user_id', Auth::id())
                    ->where('buku_id', $item->id)
                    ->where('status', 'dipinjam')
                    ->exists();

                // Cek total peminjaman aktif user
                $totalPinjamanAktif = \App\Models\Peminjaman::where('user_id', Auth::id())
                    ->where('status', 'dipinjam')
                    ->count();
            @endphp

            {{-- 🔥 STATUS --}}
            @if($sudahPinjamBukuIni)
                <small style="
                    background: orange;
                    color: white;
                    padding: 4px 10px;
                    border-radius: 6px;
                    font-size: 12px;
                    display: inline-block;
                    margin-bottom: 6px;
                ">
                    Sedang dipinjam
                </small>
            @elseif($totalPinjamanAktif >= 2)
                <small style="
                    background: blue;
                    color: white;
                    padding: 4px 10px;
                    border-radius: 6px;
                    font-size: 12px;
                    display: inline-block;
                    margin-bottom: 6px;
                ">
                    Maksimal peminjaman tercapai
                </small>
            @elseif($dipinjam >= $stok && $stok > 0)
                <small style="
                    background: red;
                    color: white;
                    padding: 4px 10px;
                    border-radius: 6px;
                    font-size: 12px;
                    display: inline-block;
                    margin-bottom: 6px;
                ">
                    Stok habis
                </small>
            @endif

            @if($sudahPinjamBukuIni || $totalPinjamanAktif >= 2 || ($dipinjam >= $stok && $stok > 0))
                <button class="btn btn-primary btn-sm" disabled>Pinjam</button>
            @else
                <a href="/buku/{{ $item->id }}/pinjam" class="btn btn-primary btn-sm">Pinjam</a>
            @endif
            <a href="/buku/{{ $item->id }}" class="btn btn-info btn-sm">Detail</a>
        </div>
    </div>
</div>
@endforeach

 {{-- ✅ TAMBAHAN: SEMBUNYIKAN YANG ATAS --}}
@if($buku->count() == 0)

<!-- BUKU 1 -->
@if(!$search || str_contains('si tudung merah', $search))
@php
    $dipinjam1 = \App\Models\Peminjaman::where('buku_id', 1)
        ->where('status', 'dipinjam')
        ->count();
    $stok1 = 1;
    $sudahPinjam1 = \App\Models\Peminjaman::where('user_id', Auth::id())
        ->where('buku_id', 1)
        ->where('status', 'dipinjam')
        ->exists();
    $totalPinjamanAktif = \App\Models\Peminjaman::where('user_id', Auth::id())
        ->where('status', 'dipinjam')
        ->count();
@endphp
<div class="col-md-3 mb-4">
    <div class="card text-center shadow-sm p-3 border-0"
         style="border-radius:15px; background:#f1f1f1;">

        <img src="{{ asset('storage/tudung merah.jpg') }}"
             class="mx-auto mb-2"
             style="width:90px; height:130px; object-fit:foto;">

        <p class="mb-2">Si Tudung Merah</p>

        <div>
            @if($sudahPinjam1)
                <small style="
                    background: orange;
                    color: white;
                    padding: 4px 10px;
                    border-radius: 6px;
                    font-size: 12px;
                    display: inline-block;
                    margin-bottom: 6px;
                ">
                    Sedang dipinjam
                </small>
            @elseif($totalPinjamanAktif >= 2)
                <small style="
                    background: blue;
                    color: white;
                    padding: 4px 10px;
                    border-radius: 6px;
                    font-size: 12px;
                    display: inline-block;
                    margin-bottom: 6px;
                ">
                    Maksimal peminjaman tercapai
                </small>
            @elseif($dipinjam1 >= $stok1 && $stok1 > 0)
                <small style="
                    background: red;
                    color: white;
                    padding: 4px 10px;
                    border-radius: 6px;
                    font-size: 12px;
                    display: inline-block;
                    margin-bottom: 6px;
                ">
                    Stok habis
                </small>
            @endif
            @if($sudahPinjam1 || $totalPinjamanAktif >= 2 || ($dipinjam1 >= $stok1 && $stok1 > 0))
                <button class="btn btn-primary btn-sm" disabled>Pinjam</button>
            @else
                <a href="/buku/1/pinjam" class="btn btn-primary btn-sm">Pinjam</a>
            @endif
            <a href="/buku/1" class="btn btn-info btn-sm">Detail</a>
        </div>
    </div>
</div>
@endif

<!-- BUKU 2 -->
@if(!$search || str_contains('angkasa', $search))
@php
    $dipinjam2 = \App\Models\Peminjaman::where('buku_id', 2)
        ->where('status', 'dipinjam')
        ->count();
    $stok2 = 1;
    $sudahPinjam2 = \App\Models\Peminjaman::where('user_id', Auth::id())
        ->where('buku_id', 2)
        ->where('status', 'dipinjam')
        ->exists();
@endphp
<div class="col-md-3 mb-4">
    <div class="card text-center shadow-sm p-3 border-0"
         style="border-radius:15px; background:#f1f1f1;">

        <img src="{{ asset('storage/angkasa.jpg') }}"
             class="mx-auto mb-2"
             style="width:90px; height:130px; object-fit:foto;">

        <p class="mb-2">Angkasa</p>

        <div>
            @if($sudahPinjam2)
                <small style="
                    background: orange;
                    color: white;
                    padding: 4px 10px;
                    border-radius: 6px;
                    font-size: 12px;
                    display: inline-block;
                    margin-bottom: 6px;
                ">
                    Sedang dipinjam
                </small>
            @elseif($totalPinjamanAktif >= 2)
                <small style="
                    background: blue;
                    color: white;
                    padding: 4px 10px;
                    border-radius: 6px;
                    font-size: 12px;
                    display: inline-block;
                    margin-bottom: 6px;
                ">
                    Maksimal peminjaman tercapai
                </small>
            @elseif($dipinjam2 >= $stok2 && $stok2 > 0)
                <small style="
                    background: red;
                    color: white;
                    padding: 4px 10px;
                    border-radius: 6px;
                    font-size: 12px;
                    display: inline-block;
                    margin-bottom: 6px;
                ">
                    Stok habis
                </small>
            @endif
            @if($sudahPinjam2 || $totalPinjamanAktif >= 2 || ($dipinjam2 >= $stok2 && $stok2 > 0))
                <button class="btn btn-primary btn-sm" disabled>Pinjam</button>
            @else
                <a href="/buku/2/pinjam" class="btn btn-primary btn-sm">Pinjam</a>
            @endif
            <a href="/buku/2" class="btn btn-info btn-sm">Detail</a>
        </div>
    </div>
</div>
@endif

<!-- BUKU 3 -->
@if(!$search || str_contains('bahasa indonesia', $search))
@php
    $dipinjam3 = \App\Models\Peminjaman::where('buku_id', 3)
        ->where('status', 'dipinjam')
        ->count();
    $stok3 = 1;
    $sudahPinjam3 = \App\Models\Peminjaman::where('user_id', Auth::id())
        ->where('buku_id', 3)
        ->where('status', 'dipinjam')
        ->exists();
@endphp
<div class="col-md-3 mb-4">
    <div class="card text-center shadow-sm p-3 border-0"
         style="border-radius:15px; background:#f1f1f1;">

        <img src="{{ asset('storage/indonesia.jpg') }}"
             class="mx-auto mb-2"
             style="width:90px; height:130px; object-fit:foto;">

        <p class="mb-2">Bahasa Indonesia</p>

        <div>
            @if($sudahPinjam3)
                <small style="
                    background: orange;
                    color: white;
                    padding: 4px 10px;
                    border-radius: 6px;
                    font-size: 12px;
                    display: inline-block;
                    margin-bottom: 6px;
                ">
                    Sedang dipinjam
                </small>
            @elseif($totalPinjamanAktif >= 2)
                <small style="
                    background: blue;
                    color: white;
                    padding: 4px 10px;
                    border-radius: 6px;
                    font-size: 12px;
                    display: inline-block;
                    margin-bottom: 6px;
                ">
                    Maksimal peminjaman tercapai
                </small>
            @elseif($dipinjam3 >= $stok3 && $stok3 > 0)
                <small style="
                    background: red;
                    color: white;
                    padding: 4px 10px;
                    border-radius: 6px;
                    font-size: 12px;
                    display: inline-block;
                    margin-bottom: 6px;
                ">
                    Stok habis
                </small>
            @endif
            @if($sudahPinjam3 || $totalPinjamanAktif >= 2 || ($dipinjam3 >= $stok3 && $stok3 > 0))
                <button class="btn btn-primary btn-sm" disabled>Pinjam</button>
            @else
                <a href="/buku/3/pinjam" class="btn btn-primary btn-sm">Pinjam</a>
            @endif
            <a href="/buku/3" class="btn btn-info btn-sm">Detail</a>
        </div>
    </div>
</div>
@endif

<!-- BUKU 4 -->
@if(!$search || str_contains('adiku yang hilang', $search))
@php
    $dipinjam4 = \App\Models\Peminjaman::where('buku_id', 4)
        ->where('status', 'dipinjam')
        ->count();
    $stok4 = 1;
    $sudahPinjam4 = \App\Models\Peminjaman::where('user_id', Auth::id())
        ->where('buku_id', 4)
        ->where('status', 'dipinjam')
        ->exists();
@endphp
<div class="col-md-3 mb-4">
    <div class="card text-center shadow-sm p-3 border-0"
         style="border-radius:15px; background:#f1f1f1;">

        <img src="{{ asset('storage/adiku yang hilang.jpg') }}"
             class="mx-auto mb-2"
             style="width:90px; height:130px; object-fit:foto;">

        <p class="mb-2">Adiku yang Hilang</p>

        <div>
            @if($sudahPinjam4)
                <small style="
                    background: orange;
                    color: white;
                    padding: 4px 10px;
                    border-radius: 6px;
                    font-size: 12px;
                    display: inline-block;
                    margin-bottom: 6px;
                ">
                    Sedang dipinjam
                </small>
            @elseif($totalPinjamanAktif >= 2)
                <small style="
                    background: blue;
                    color: white;
                    padding: 4px 10px;
                    border-radius: 6px;
                    font-size: 12px;
                    display: inline-block;
                    margin-bottom: 6px;
                ">
                    Maksimal peminjaman tercapai
                </small>
            @elseif($dipinjam4 >= $stok4 && $stok4 > 0)
                <small style="
                    background: red;
                    color: white;
                    padding: 4px 10px;
                    border-radius: 6px;
                    font-size: 12px;
                    display: inline-block;
                    margin-bottom: 6px;
                ">
                    Stok habis
                </small>
            @endif
            @if($sudahPinjam4 || $totalPinjamanAktif >= 2 || ($dipinjam4 >= $stok4 && $stok4 > 0))
                <button class="btn btn-primary btn-sm" disabled>Pinjam</button>
            @else
                <a href="/buku/4/pinjam" class="btn btn-primary btn-sm">Pinjam</a>
            @endif
            <a href="/buku/4" class="btn btn-info btn-sm">Detail</a>
        </div>
    </div>
</div>
@endif

@endif

</div>
</div>
@endsection

<style>
.container-fluid {
    max-height: 90vh;
    overflow-y: auto;
}

.container-fluid::-webkit-scrollbar {
    display: none;
}

.container-fluid {
    scrollbar-width: none;
}
</style>
