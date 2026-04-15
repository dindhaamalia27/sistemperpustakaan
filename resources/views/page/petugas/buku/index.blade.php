@extends('layouts.petugas.app')

@section('content')

<div class="container-fluid" style="padding-left:260px; padding-top:20px;">

    <!-- TOMBOL TAMBAH BUKU -->
    <div class="mb-4 text-end">
        <a href="{{ route('petugas.buku.create') }}" class="btn btn-success btn-sm">Tambah Buku</a>
    </div>

    <!-- SEARCH -->
    <form method="GET" action="{{ route('petugas.buku.index') }}">
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

               @if($item->stok == 0)
             <p style="color:red; font-size:13px; margin-top:-5px;">Stok habis</p>

            @elseif(\App\Models\Petugas\Peminjaman::where('buku_id', $item->id)->whereNull('tanggal_kembali')->exists())
           <p style="color:orange; font-size:13px; margin-top:-5px;">Sedang dipinjam</p>

           @else
          <p style="color:green; font-size:13px; margin-top:-5px;">Tersedia</p>
          @endif


                <div class="d-flex justify-content-center gap-2">

                    <a href="{{ route('petugas.buku.detail', $item->id) }}" class="btn btn-info btn-sm">Detail</a>

                    <a href="{{ route('petugas.buku.edit', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>

                    <!--  BAGIAN YANG DIUBAH -->
                    <form action="{{ route('petugas.buku.delete', $item->id) }}" method="POST" class="m-0">
                        @csrf
                        @method('DELETE')

                        @if(\App\Models\Petugas\Peminjaman::where('buku_id', $item->id)->whereNull('tanggal_kembali')->exists())
                            <button type="button" class="btn btn-danger btn-sm"
                                onclick="alert('Buku sedang dipinjam, tidak bisa dihapus!')">
                                Hapus
                            </button>
                        @else
                            <button type="submit" class="btn btn-danger btn-sm"
                                onclick="return confirm('Yakin mau hapus buku ini?')">
                                Hapus
                            </button>
                        @endif

                    </form>
                    <!--  END -->

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
