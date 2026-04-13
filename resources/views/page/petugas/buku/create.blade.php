@extends('layouts.petugas.app')

@section('content')

<div class="top-bar"></div>

<div class="container-fluid" style="padding-left:260px; padding-top:0px;">


    <h5 class="mb-4">Tambah buku</h5>

    <div class="card p-4 shadow-sm border-0 mx-auto"
         style="border-radius:15px; max-width:600px; background:#6d6b6b;"> <!-- ✅ diperkecil -->

        <form action="{{ route('petugas.buku.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- FOTO -->
            <div class="mb-3">
                <label>Foto</label>

                <div class="file-wrapper">
                    <input type="file" name="foto" class="real-file">
                    <div class="fake-input">
                        <span class="btn-file">Choose File</span>
                    </div>
                </div>
            </div>

            <!-- JUDUL -->
            <div class="mb-3">
                <label>Judul Buku</label>
                <input type="text" name="judul" class="form-control">
            </div>

            <!-- PENGARANG-->
            <div class="mb-3">
                <label>Pengarang</label>
                <input type="text" name="pengarang" class="form-control">
            </div>

            <!-- TAHUN -->
            <div class="mb-3">
                <label>Tahun Terbit</label>
                <input type="text" name="tahun_terbit" class="form-control">
            </div>

            <!-- STOK -->
            <div class="mb-3">
                <label>Stok</label>
                <input type="number" name="stok" class="form-control">
            </div>

             <!-- PENERbit -->
               <div class="mb-3">
               <label>Penerbit</label>
                 <input type="text" name="penerbit" class="form-control">
                   </div>

               <!-- DESKRIPSI -->
              <div class="mb-3">
              <label>   Sinopsis</label>
             <textarea name="deskripsi" class="form-control" rows="3"></textarea>
             </div>



            <!-- BUTTON -->
            <div class="d-flex justify-content-end">
                <a href="{{ route('petugas.buku.index') }}" class="btn btn-light btn-sm me-2">
                    Batal
                </a>
                <button type="submit" class="btn btn-primary btn-sm">
                    simpan
                </button>
            </div>

        </form>

    </div>

</div>

@endsection


<style>
body {
    background: #ffffff !important;
}

h5 {
    font-size: 18px;
    color: #141414;
    margin-top: -10px;
}
.card {
    background: #f1f1f1 !important;
    border-radius: 10px !important;
    margin-top: -30px; /* ⬅️ TAMBAHIN INI */
}

label {
    font-size: 12px;
    color: #0e0e0e;
}

.form-control {
    border: 1px solid #121212 !important;
    border-radius: 3px !important;
    font-size: 13px;
    background: #fff !important; /* ✅ input jadi putih */
}

.btn-light {
    background: #fff !important;
    border: 1px solid #121212 !important;
    font-size: 12px;
    padding: 6px 10px;
}

.btn-primary {
    background: #1e88e5 !important;
    border: none;
    font-size: 12px;
}

/* FILE INPUT */
.file-wrapper {
    position: relative;
    width: 100%;
}

.real-file {
    position: absolute;
    width: 100%;
    height: 100%;
    opacity: 0;
    cursor: pointer;
}

.fake-input {
    border: 1px solid #121212;
    height: 35px;
    display: flex;
    align-items: center;
    padding-left: 5px;
    background: #fff;
}

.btn-file {
    background: #ddd;
    padding: 5px 10px;
    font-size: 12px;
    border: 1px solid #999;
}

/* ✅ TAMBAHAN SCROLL (TANPA GARIS ABU) */
.card {
    max-height: 80vh;
    overflow-y: auto;
}

.card::-webkit-scrollbar {
    display: none;
}

.card {
    scrollbar-width: none;
}
</style>
<!-- ✅ TAMBAHAN (JANGAN DIUBAH YANG ATAS) -->
<script>
document.querySelector('.real-file').addEventListener('change', function(e) {
    let fileName = e.target.files[0]?.name;
    if (fileName) {
        document.querySelector('.fake-input').innerHTML = fileName;
    }
});
</script>
