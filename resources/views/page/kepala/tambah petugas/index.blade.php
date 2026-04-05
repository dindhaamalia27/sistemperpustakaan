@extends('layouts.kepala.app')

@section('content')

<div style="padding-left:260px; padding-top:40px;">

    <h3 style="margin-bottom:30px;">Data Petugas</h3>

    <!-- tombol tambah -->
    <div style="margin-bottom:20px;">

        <a href="{{ route('kepala.petugas.create') }}" style="

            background:#27ae60;
            color:white;
            padding:8px 15px;
            border-radius:8px;
            text-decoration:none;
        ">
            + Tambah Petugas
        </a>
    </div>

    <div style="
        background:#f2f2f2;
        padding:15px 20px;
        border-radius:10px;
        display:inline-block;
        min-width:600px;
    ">

        <table style="width:100%; border-collapse:collapse;">

            <thead>
                <tr style="text-align:left; font-size:13px; color:#555;">
                    <th>No</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th style="text-align:center;">Aksi</th>
                </tr>
            </thead>

            <tbody>
                @foreach($petugas as $item)
                <tr style="border-top:1px solid #ddd;">
                    <td style="padding:10px;">{{ $loop->iteration }}</td>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->email }}</td>

                    <!-- AKSI -->
                    <td style="padding:10px; text-align:center; white-space:nowrap;">

                        <!-- EDIT -->
                        <a href="{{ route('kepala.petugas.edit', $item->id) }}" style="
                            background:#f39c12;
                            color:white;
                            padding:5px 12px;
                            border-radius:6px;
                            font-size:12px;
                            text-decoration:none;
                            margin-right:6px;
                            display:inline-block;
                        ">
                            Edit
                        </a>

                        <!-- HAPUS -->
                        <form action="{{ route('kepala.petugas.destroy', $item->id) }}" method="POST" style="display:inline-block;">
                       @csrf
               @method('DELETE')
             <button type="submit" style="
             background:#e74c3c;
        color:white;
        padding:5px 12px;
        border:none;
        border-radius:6px;
        font-size:12px;
        cursor:pointer;
         ">
        Hapus
        </button>
         </form>
                    </td>

                </tr>
                @endforeach
            </tbody>

        </table>

    </div>

</div>

@endsection
