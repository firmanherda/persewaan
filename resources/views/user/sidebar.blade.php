<div class="main-sidebar">
  <aside id="sidebar-wrapper">
    <div class="sidebar-brand">
      <a href="{{ route('user.barang.index') }}">Sewa Alat Camping</a>
    </div>
    <div class="sidebar-brand sidebar-brand-sm">
      <a href="{{ route('user.barang.index') }}">St</a>
    </div>
    <ul class="sidebar-menu">

      <li class="menu-header">Halaman User</li>
      <li class="nav-item">
        <a href="{{ route('user.home') }}" class="nav-link">
          <i class="fas fa-fire"></i>
          <span>Home</span>
        </a>
      <li>
      <li class="nab-item">
        <a class="nav-link" href="{{ route('user.profil.index') }}">
          <i class="fas fa-address-card"></i>
          <span>Profil</span>
        </a>
      </li>
      {{-- <li class="nav-item">
        <a class="nav-link" href="{{ route('user.barang.index') }}">
          <i class="far fa-square"></i>
          <span>Paket</span>
        </a>
      </li> --}}
      <li class="nav-item">
        <a class="nav-link" href="{{ route('user.keranjang.index') }}">
          <i class="fas fa-shopping-cart"></i>
          <span>Keranjang</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ route('user.pesanan.index') }}">
          <i class="far fa-clock"></i>
          <span>Pesanan</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ route('user.sedangdisewa.index') }}">
          <i class="fas fa-receipt"></i>
          <span>Sedang disewa</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ route('user.riwayattransaksi.index') }}">
          <i class="far fa-clock"></i>
          <span>Riwayat Pesanan</span>
        </a>
      </li>

      <li class="nav-item dropdown">
        <a href="#" class="nav-link has-dropdown" data-bs-toggle="dropdown">
          <i class="fas fa-columns"></i>
          <span>Rekomendasi Alat Mendaki</span>
        </a>
        <ul class="dropdown-menu">
          <li><a class="nav-link" href="layout-default.html">Kriteria</a></li>
          <li><a class="nav-link" href="layout-transparent.html">Alternatif</a></li>
          {{-- <li><a class="nav-link" href="{{route('barang.index')}}">Barang</a></li> --}}
        </ul>
      </li>

      </li>
      <li class="menu-header">Sistem Penunjang Keputusan</li>
      <li class="nav-item dropdown">
        <a href="#" class="nav-link has-dropdown" data-bs-toggle="dropdown"><i class="fas fa-columns"></i>
          <span>Layout</span></a>
        <ul class="dropdown-menu">
          <li><a class="nav-link" href="layout-default.html">Default Layout</a></li>
          <li><a class="nav-link" href="layout-transparent.html">Transparent Sidebar</a></li>
          {{-- <li><a class="nav-link" href="{{route('barang.index')}}">Barang</a></li> --}}
        </ul>
      </li>


  </aside>
</div>
