<style>
  .left-sidebar {
    position: fixed;
    top: 0;
    left: 0;
    bottom: 0;
    width: 260px;
    background:#83c2e1 !important;
    border-right:1px solid #ddd;
    padding-top:55px;
  }
</style>

<aside class="left-sidebar">
    <!-- JUDUL -->
    <div style="text-align:center; padding:4px 0;">
        <div style="font-size:14px; font-weight:600; line-height:18px; margin:0;">
           Sistem <br>Perpustakaan Digital
        </div>
    </div>

    <!-- PROFILE -->
    <div style="text-align:center; padding:4px 0;">
        <img src="{{ asset('images/profile.jpg') }}"
             style="width:50px; height:50px; border-radius:50%; object-fit:cover;">
              <div style="font-size:12px; margin-top:4px;">petugas</div>

    <!-- MENU -->
    <nav class="sidebar-nav scroll-sidebar" style="margin-top:5px; padding-top:0;">
        <ul id="sidebarnav">

            <li class="sidebar-item">
                <a class="sidebar-link" href="{{ route('petugas.dashboard.index') }}">
                    <i class="ti ti-home"></i>
                    <span class="hide-menu">Dashboard</span>
                </a>
            </li>

            <li class="sidebar-item">
                <a class="sidebar-link" href="{{ route('petugas.buku.index') }}">
                    <i class="ti ti-book"></i>
                    <span class="hide-menu">Data Buku</span>
                </a>
            </li>

            <li class="sidebar-item">
                <a class="sidebar-link" href="{{ route('petugas.peminjaman.index') }}">
                    <i class="ti ti-user"></i>
                    <span class="hide-menu"> Data Peminjaman</span>
                </a>
            </li>

            <li class="sidebar-item">
                <a class="sidebar-link" href="{{ route('petugas.anggota.index') }}">
                    <i class="ti ti-users"></i>

                    <span class="hide-menu"> Data anggota</span>
                </a>
            </li>

           <li class="sidebar-item">
    <a class="sidebar-link" href="{{ route('petugas.pengembalian.index') }}">
        <i class="ti ti-refresh"></i>
        <span class="hide-menu">Data Pengembalian</span>
    </a>
</li>
            <!-- Logout -->
            <li class="sidebar-item">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="sidebar-link" style="border:none; background:none; width:100%; text-align:left;">
                        <i class="ti ti-logout"></i>
                        <span class="hide-menu">Logout</span>
                    </button>
                </form>
            </li>

        </ul>
    </nav>
</aside>
