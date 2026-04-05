@extends('layouts.kepala.app')

@section('content')

<div style="padding-left:260px; padding-top:40px;">

    <h3 style="margin-bottom:30px;">Edit Petugas</h3>

    <div style="
        background:#f2f2f2;
        padding:25px;
        border-radius:10px;
        width:400px;
    ">

        <form action="{{ route('kepala.petugas.update', $petugas->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div style="margin-bottom:15px;">
                <label>Nama</label>
                <input type="text" name="name" value="{{ $petugas->name }}" style="
                    width:100%;
                    padding:8px;
                    border:1px solid #ccc;
                    border-radius:5px;
                ">
            </div>

            <div style="margin-bottom:15px;">
                <label>Email</label>
                <input type="email" name="email" value="{{ $petugas->email }}" style="
                    width:100%;
                    padding:8px;
                    border:1px solid #ccc;
                    border-radius:5px;
                ">
            </div>

            <div style="margin-bottom:15px;">
                <label>Password (opsional)</label>
                <input type="password" name="password" placeholder="Kosongkan jika tidak diubah" style="
                    width:100%;
                    padding:8px;
                    border:1px solid #ccc;
                    border-radius:5px;
                ">
            </div>

            <div style="text-align:right;">
                <a href="{{ route('kepala.petugas.index') }}" style="
                    background:#95a5a6;
                    color:white;
                    padding:8px 15px;
                    border-radius:6px;
                    text-decoration:none;
                    margin-right:10px;
                ">Batal</a>

                <button type="submit" style="
                    background:#27ae60;
                    color:white;
                    padding:8px 15px;
                    border:none;
                    border-radius:6px;
                ">
                    Update
                </button>
            </div>

        </form>

    </div>

</div>

@endsection
