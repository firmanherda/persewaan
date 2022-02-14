@php
$keranjangs = \App\Models\Keranjang::with(['barang'])
    ->where('user_id', auth()->id())
    ->get();
@endphp

<div class="navbar-bg"></div>
<nav class="navbar navbar-expand-lg main-navbar">
  <form class="form-inline me-auto">
    <ul class="navbar-nav me-3">
      <li><a href="#" data-bs-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
      <li><a href="#" data-bs-toggle="search" class="nav-link nav-link-lg d-sm-none"><i class="fas fa-search"></i></a>
      </li>
    </ul>
  </form>
  <ul class="navbar-nav navbar-right">
    <li class="dropdown dropdown-list-toggle"><a href="#" data-bs-toggle="dropdown"
        class="nav-link notification-toggle nav-link-lg beep"><i class="fas fa-shopping-bag"></i></a>
      <div class="dropdown-menu dropdown-list dropdown-menu-right">
        <div class="dropdown-header">
          <p>Keranjang</p>
        </div>
        <div class="dropdown-list-content dropdown-list-icons">
          @forelse ($keranjangs as $keranjang)
            <a href="#" class="dropdown-item dropdown-item-unread">
              <div class="dropdown-item-icon bg-primary text-white">
                <img src="https://picsum.photos/50" alt="">
              </div>
              <div class="dropdown-item-desc">
                <div class="d-inline-block text-truncate">{{ $keranjang->barang->nama }}</div>
                <div class="time text-primary">@rupiah($keranjang->barang->harga * $keranjang->jumlah)</div>
              </div>
            </a>
          @empty
            <p>Tidak ada item di keranjang</p>
          @endforelse
        </div>
        <div class="dropdown-footer text-center">
          <a href="{{ route('user.keranjang.index') }}">Checkout <i class="fas fa-chevron-right"></i></a>
        </div>
      </div>
    </li>
    <li class="dropdown"><a href="#" data-bs-toggle="dropdown"
        class="nav-link dropdown-toggle nav-link-lg nav-link-user">
        <div class="d-sm-none d-lg-inline-block">Hi,{{ Auth::user()->nama }}</div>
      </a>
      <div class="dropdown-menu dropdown-menu-right">
        <a href="features-profile.html" class="dropdown-item has-icon">
          <i class="far fa-user"></i> Profile
        </a>
        <div class="dropdown-divider"></div>
        <a href="{{ route('logout') }}"
          onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
          class="dropdown-item has-icon text-danger">
          <i class="fas fa-sign-out-alt"></i> Logout
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
          @csrf
        </form>
      </div>
    </li>
  </ul>
</nav>
<div class="main-sidebar">
  <aside id="sidebar-wrapper">
    <div class="sidebar-brand">
      <a href="index.html">Stisla</a>
    </div>
    <div class="sidebar-brand sidebar-brand-sm">
      <a href="index.html">St</a>
    </div>
    <ul class="sidebar-menu">
      <li class="menu-header">Dashboard</li>
      <li class="nav-item dropdown active">
        <a href="#" class="nav-link has-dropdown"><i class="fas fa-fire"></i><span>Dashboard</span></a>
        <ul class="dropdown-menu">
          <li><a class="nav-link" href="index-0.html">General Dashboard</a></li>
          <li class="active"><a class="nav-link" href="index.html">Ecommerce Dashboard</a></li>
        </ul>
      </li>
      <li class="menu-header">Starter</li>
      <li class="nav-item dropdown">
        <a href="#" class="nav-link has-dropdown" data-bs-toggle="dropdown"><i class="fas fa-columns"></i>
          <span>Layout</span></a>
        <ul class="dropdown-menu">
          <li><a class="nav-link" href="layout-default.html">Default Layout</a></li>
          <li><a class="nav-link" href="layout-transparent.html">Transparent Sidebar</a></li>
          <li><a class="nav-link" href="layout-top-navigation.html">Top Navigation</a></li>
        </ul>
      </li>
      <li><a class="nav-link" href="blank.html"><i class="far fa-square"></i> <span>Blank Page</span></a></li>
      <li class="nav-item dropdown">
        <a href="#" class="nav-link has-dropdown"><i class="fas fa-th"></i> <span>Bootstrap</span></a>
        <ul class="dropdown-menu">
          <li><a class="nav-link" href="bootstrap-alert.html">Alert</a></li>
          <li><a class="nav-link" href="bootstrap-badge.html">Badge</a></li>
          <li><a class="nav-link" href="bootstrap-breadcrumb.html">Breadcrumb</a></li>
          <li><a class="nav-link" href="bootstrap-buttons.html">Buttons</a></li>
          <li><a class="nav-link" href="bootstrap-card.html">Card</a></li>
          <li><a class="nav-link" href="bootstrap-carousel.html">Carousel</a></li>
          <li><a class="nav-link" href="bootstrap-collapse.html">Collapse</a></li>
          <li><a class="nav-link" href="bootstrap-dropdown.html">Dropdown</a></li>
          <li><a class="nav-link" href="bootstrap-form.html">Form</a></li>
          <li><a class="nav-link" href="bootstrap-list-group.html">List Group</a></li>
          <li><a class="nav-link" href="bootstrap-media-object.html">Media Object</a></li>
          <li><a class="nav-link" href="bootstrap-modal.html">Modal</a></li>
          <li><a class="nav-link" href="bootstrap-nav.html">Nav</a></li>
          <li><a class="nav-link" href="bootstrap-navbar.html">Navbar</a></li>
          <li><a class="nav-link" href="bootstrap-pagination.html">Pagination</a></li>
          <li><a class="nav-link" href="bootstrap-popover.html">Popover</a></li>
          <li><a class="nav-link" href="bootstrap-progress.html">Progress</a></li>
          <li><a class="nav-link" href="bootstrap-table.html">Table</a></li>
          <li><a class="nav-link" href="bootstrap-tooltip.html">Tooltip</a></li>
          <li><a class="nav-link" href="bootstrap-typography.html">Typography</a></li>
        </ul>
      </li>
      <li class="menu-header">Stisla</li>
      <li class="nav-item dropdown">
        <a href="#" class="nav-link has-dropdown"><i class="fas fa-th-large"></i> <span>Components</span></a>
        <ul class="dropdown-menu">
          <li><a class="nav-link" href="components-article.html">Article</a></li>
          <li><a class="nav-link beep beep-sidebar" href="components-avatar.html">Avatar</a></li>
          <li><a class="nav-link" href="components-chat-box.html">Chat Box</a></li>
          <li><a class="nav-link beep beep-sidebar" href="components-empty-state.html">Empty State</a></li>
          <li><a class="nav-link" href="components-gallery.html">Gallery</a></li>
          <li><a class="nav-link beep beep-sidebar" href="components-hero.html">Hero</a></li>
          <li><a class="nav-link" href="components-multiple-upload.html">Multiple Upload</a></li>
          <li><a class="nav-link beep beep-sidebar" href="components-pricing.html">Pricing</a></li>
          <li><a class="nav-link" href="components-statistic.html">Statistic</a></li>
          <li><a class="nav-link" href="components-tab.html">Tab</a></li>
          <li><a class="nav-link" href="components-table.html">Table</a></li>
          <li><a class="nav-link" href="components-user.html">User</a></li>
          <li><a class="nav-link beep beep-sidebar" href="components-wizard.html">Wizard</a></li>
        </ul>
      </li>
      <li class="nav-item dropdown">
        <a href="#" class="nav-link has-dropdown"><i class="far fa-file-alt"></i> <span>Forms</span></a>
        <ul class="dropdown-menu">
          <li><a class="nav-link" href="forms-advanced-form.html">Advanced Form</a></li>
          <li><a class="nav-link" href="forms-editor.html">Editor</a></li>
          <li><a class="nav-link" href="forms-validation.html">Validation</a></li>
        </ul>
      </li>
      <li class="nav-item dropdown">
        <a href="#" class="nav-link has-dropdown"><i class="fas fa-map-marker-alt"></i> <span>Google Maps</span></a>
        <ul class="dropdown-menu">
          <li><a href="gmaps-advanced-route.html">Advanced Route</a></li>
          <li><a href="gmaps-draggable-marker.html">Draggable Marker</a></li>
          <li><a href="gmaps-geocoding.html">Geocoding</a></li>
          <li><a href="gmaps-geolocation.html">Geolocation</a></li>
          <li><a href="gmaps-marker.html">Marker</a></li>
          <li><a href="gmaps-multiple-marker.html">Multiple Marker</a></li>
          <li><a href="gmaps-route.html">Route</a></li>
          <li><a href="gmaps-simple.html">Simple</a></li>
        </ul>
      </li>
      <li class="nav-item dropdown">
        <a href="#" class="nav-link has-dropdown"><i class="fas fa-plug"></i> <span>Modules</span></a>
        <ul class="dropdown-menu">
          <li><a class="nav-link" href="modules-calendar.html">Calendar</a></li>
          <li><a class="nav-link" href="modules-chartjs.html">ChartJS</a></li>
          <li><a class="nav-link" href="modules-datatables.html">DataTables</a></li>
          <li><a class="nav-link" href="modules-flag.html">Flag</a></li>
          <li><a class="nav-link" href="modules-font-awesome.html">Font Awesome</a></li>
          <li><a class="nav-link" href="modules-ion-icons.html">Ion Icons</a></li>
          <li><a class="nav-link" href="modules-owl-carousel.html">Owl Carousel</a></li>
          <li><a class="nav-link" href="modules-sparkline.html">Sparkline</a></li>
          <li><a class="nav-link" href="modules-sweet-alert.html">Sweet Alert</a></li>
          <li><a class="nav-link" href="modules-toastr.html">Toastr</a></li>
          <li><a class="nav-link" href="modules-vector-map.html">Vector Map</a></li>
          <li><a class="nav-link" href="modules-weather-icon.html">Weather Icon</a></li>
        </ul>
      </li>
      <li class="menu-header">Pages</li>
      <li class="nav-item dropdown">
        <a href="#" class="nav-link has-dropdown"><i class="far fa-user"></i> <span>Auth</span></a>
        <ul class="dropdown-menu">
          <li><a href="auth-forgot-password.html">Forgot Password</a></li>
          <li><a href="auth-login.html">Login</a></li>
          <li><a class="beep beep-sidebar" href="auth-login-2.html">Login 2</a></li>
          <li><a href="auth-register.html">Register</a></li>
          <li><a href="auth-reset-password.html">Reset Password</a></li>
        </ul>
      </li>
      <li class="nav-item dropdown">
        <a href="#" class="nav-link has-dropdown"><i class="fas fa-exclamation"></i> <span>Errors</span></a>
        <ul class="dropdown-menu">
          <li><a class="nav-link" href="errors-503.html">503</a></li>
          <li><a class="nav-link" href="errors-403.html">403</a></li>
          <li><a class="nav-link" href="errors-404.html">404</a></li>
          <li><a class="nav-link" href="errors-500.html">500</a></li>
        </ul>
      </li>
      <li class="nav-item dropdown">
        <a href="#" class="nav-link has-dropdown"><i class="fas fa-bicycle"></i> <span>Features</span></a>
        <ul class="dropdown-menu">
          <li><a class="nav-link" href="features-activities.html">Activities</a></li>
          <li><a class="nav-link" href="features-post-create.html">Post Create</a></li>
          <li><a class="nav-link" href="features-posts.html">Posts</a></li>
          <li><a class="nav-link" href="features-profile.html">Profile</a></li>
          <li><a class="nav-link" href="features-settings.html">Settings</a></li>
          <li><a class="nav-link" href="features-setting-detail.html">Setting Detail</a></li>
          <li><a class="nav-link" href="features-tickets.html">Tickets</a></li>
        </ul>
      </li>
      <li class="nav-item dropdown">
        <a href="#" class="nav-link has-dropdown"><i class="fas fa-ellipsis-h"></i> <span>Utilities</span></a>
        <ul class="dropdown-menu">
          <li><a href="utilities-contact.html">Contact</a></li>
          <li><a class="nav-link" href="utilities-invoice.html">Invoice</a></li>
          <li><a href="utilities-subscribe.html">Subscribe</a></li>
        </ul>
      </li>
      <li><a class="nav-link" href="credits.html"><i class="fas fa-pencil-ruler"></i> <span>Credits</span></a>
      </li>
    </ul>

    <div class="mt-4 mb-4 p-3 hide-sidebar-mini">
      <a href="https://getstisla.com/docs" class="btn btn-primary btn-lg btn-block btn-icon-split">
        <i class="fas fa-rocket"></i> Documentation
      </a>
    </div>
  </aside>
</div>
