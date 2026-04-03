@extends('layouts.petugas.app')

@section('content')
<style>
    
    /* Garis antar data */
    table tbody tr {
        border-bottom: 1px solid #ddd;
    }

    /* Hilangkan garis terakhir */
    table tbody tr:last-child {
        border-bottom: none;
    }
</style>


<div class="container-fluid" style="padding-left:260px; padding-top:40px;">

    <h5 class="mb-4">Data anggota</h5>

    <div class="card shadow-sm border-0 p-4 mx-auto"
         style="border-radius:15px; max-width:800px; background:#F6F4F4;">

        <table class="table table-borderless text-center align-middle">
            <thead>
                <tr style="color:#666;">
                    <th>no</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($anggota as $index => $item)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->email }}</td>
                    <td>
                        <form action="{{ route('petugas.anggota.delete', $item->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm px-3"
                                    style="border-radius:20px;">
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
