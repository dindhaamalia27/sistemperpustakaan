<style>
  .left-sidebar {
    position: fixed;
    top: 0;
    left: 0;
    bottom: 0;
    width: 260px; /* samakan sama sidebar kamu */
}
</style>
 <aside class="left-sidebar" style="padding-top:55px; border-right:1px solid #ddd; background:#83c2e1 !important;">
    <!-- JUDUL -->
    <div style="text-align:center; padding:4px 0;">
        <div style="font-size:14px; font-weight:600; line-height:18px; margin:0;">
           Sistem <br>Perpustakaan Digital
        </div>
    </div>

    <!-- PROFILE -->
    <div style="text-align:center; padding:4px 0;">

        <!-- INISIAL A -->
        <div style="
            width:50px;
            height:50px;
            border-radius:50%;
            background:#5a9ec9;
            color:white;
            display:flex;
            align-items:center;
            justify-content:center;
            margin:auto;
            font-weight:bold;
            font-size:18px;
        ">
            A
        </div>

        <div style="font-size:12px; margin-top:4px;">anggota</div>
    </div>

    <!-- MENU -->
    <nav class="sidebar-nav scroll-sidebar" style="margin-top:5px; padding-top:0;">
        <ul id="sidebarnav">

            <li class="sidebar-item">
                <a class="sidebar-link" href="/dashboard">
                    <i class="ti ti-home"></i>
                    <span class="hide-menu">Dashboard</span>
                </a>
            </li>

            <li class="sidebar-item">
                <a class="sidebar-link" href="/buku">
                    <i class="ti ti-book"></i>
                    <span class="hide-menu">Buku</span>
                </a>
            </li>

            <li class="sidebar-item">
                <a class="sidebar-link" href="/peminjaman">
                    <i class="ti ti-user"></i>
                    <span class="hide-menu">Peminjaman</span>
                </a>
            </li>

            <li class="sidebar-item">
                <a class="sidebar-link" href="/pengembalian">
                    <i class="ti ti-refresh"></i>
                    <span class="hide-menu">Pengembalian</span>
                </a>
            </li>
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
