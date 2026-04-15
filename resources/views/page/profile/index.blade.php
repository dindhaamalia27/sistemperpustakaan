
@extends('layouts.app')


@section('content')

<div class="container-fluid" style="padding-left:260px; padding-top:0px;">

    <h4 class="mb-4">Profil Saya</h4>

    <div class="card p-4 shadow-sm border-0"
         style="border-radius:15px; background:#F6F4F4; max-width:600px;">

        <div class="row">
            <div class="col-md-4 text-center">
                <div style="
                    width:100px;
                    height:100px;
                    border-radius:50%;
                    background:#5a9ec9;
                    color:white;
                    display:flex;
                    align-items:center;
                    justify-content:center;
                    margin:auto;
                    font-weight:bold;
                    font-size:36px;
                ">
                    {{ strtoupper(substr($user->nama ?? $user->name, 0, 1)) }}
                </div>
            </div>
            <div class="col-md-8">
                <h5>{{ $user->nama ?? $user->name }}</h5>
                <p><strong>Email:</strong> {{ $user->email }}</p>
                <p><strong>Role:</strong> {{ $user->role ?? 'Anggota' }}</p>
                <p><strong>Tanggal Daftar:</strong> {{ $user->created_at->format('d M Y') }}</p>
                @if($user->login_count)
                <p><strong>Jumlah Login:</strong> {{ $user->login_count }}</p>
                @endif

            </div>
        </div>

    </div>
</div>
@endsection
