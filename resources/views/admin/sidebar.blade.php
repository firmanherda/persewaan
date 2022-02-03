<div class="main-sidebar">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="index.html">Sewa Alat Camping</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="index.html">St</a>
        </div>
        <ul class="sidebar-menu">

            <li class="menu-header">Dashboardsdsd</li>
            <li class="nav-item">
                <a href="{{ route('homeadmin') }}" class="nav-link"><i
                        class="fas fa-fire"></i><span>Dashdsdsboard</span></a>
            <li><a class="nav-link" href="{{ route('member.index') }}"><i class="far fa-user  "></i>
                    <span>Member</span></a></li>
            <li class="nav-item dropdown">
                <li><a class="nav-link" href="{{ route('verifikasimember.index') }}"><i class="far fa-user  "></i>
                    <span>Verifikasi Member</span></a></li>
            <li class="nav-item dropdown">
            <li><a class="nav-link" href="{{ route('admin.barang.index') }}"><i class="far fa-square"></i>
                    <span>Barang</span></a></li>
            <li><a class="nav-link" href="{{ route('member.index') }}"><i class="far fa-user  "></i>
                    <span>Paket</span></a></li>
            <li class="nav-item dropdown">
            <li><a class="nav-link" href="{{ route('member.index') }}"><i class="far fa-envelope  "></i>
                    <span>Pesanan Masuk</span></a></li>
            <li class="nav-item dropdown">
            <li><a class="nav-link" href="{{ route('member.index') }}"><i class="far fa-bell  "></i>
                    <span>Barang Sedang Disewa</span></a></li>
            <li class="nav-item dropdown">
                <li><a class="nav-link" href="{{ route('member.index') }}"><i class="far fa-file  "></i>
                    <span>Riwayat Transaksi Selesai</span></a></li>

            </li>

            </li>
            <li class="menu-header">Sistem Penunjang Keputusan</li>
            <li class="nav-item dropdown">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i>
                    <span>Layout</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="layout-default.html">Default Layout</a></li>
                    <li><a class="nav-link" href="layout-transparent.html">Transparent Sidebar</a></li>
                    {{-- <li><a class="nav-link" href="{{route('barang.index')}}">Barang</a></li> --}}
                </ul>
            </li>


    </aside>
</div>
