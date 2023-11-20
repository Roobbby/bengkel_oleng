
<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
      <a href="#" class="app-brand-link">
        <span class="app-brand-logo demo">
          <svg width="30" height="20" viewBox="0 0 30 20" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path
            fill-rule="evenodd"
            clip-rule="evenodd"
            d="M0.00172773 0V6.85398C0.00172773 6.85398 -0.133178 9.01207 1.98092 10.8388L13.6912 21.9964L19.7809 21.9181L18.8042 9.88248L16.4951 7.17289L9.23799 0H0.00172773Z"
            fill="#7367F0" />
            <path
            opacity="0.06"
            fill-rule="evenodd"
            clip-rule="evenodd"
            d="M7.69824 16.4364L12.5199 3.23696L16.5541 7.25596L7.69824 16.4364Z"
            fill="#161616" />
            <path
            opacity="0.06"
            fill-rule="evenodd"
            clip-rule="evenodd"
            d="M8.07751 15.9175L13.9419 4.63989L16.5849 7.28475L8.07751 15.9175Z"
            fill="#161616" />
            <path
            fill-rule="evenodd"
            clip-rule="evenodd"
            d="M7.77295 16.3566L23.6563 0H32V6.88383C32 6.88383 31.8262 9.17836 30.6591 10.4057L19.7824 22H13.6938L7.77295 16.3566Z"
            fill="#7367F0" />
          </svg>
        </span>
        <span class="app-brand-text demo menu-text fw-bold ">Bengkel</span>
      </a>

      <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
        <i class="ti menu-toggle-icon d-none d-xl-block ti-sm align-middle"></i>
        <i class="ti ti-x d-block d-xl-none ti-sm align-middle"></i>
      </a>
    </div>

    <div class="menu-inner-shadow"></div>

    @php
    $userStatus = auth()->user()->status;
    $userRole = auth()->user()->role;
    $user = Auth::user();
    @endphp

  <ul class="menu-inner py-1">
      <!-- Page -->
    @if ($userStatus == 0) {{-- Status 0, Semua User --}}
    <li class="menu-item {{ Route::currentRouteName() == 'dashboard' ? 'active' : '' }}">
        <a href="{{ route('dashboard') }}" class="menu-link">
            <i class="menu-icon tf-icons ti ti-home"></i>
            <div data-i18n="Page 1">Dashboard</div>
        </a>
    </li>
    @elseif ($userStatus == 1)
    @if ($userRole == 0) {{-- Status 1 dan Role Super Admin --}}
        <li class="menu-item {{ Route::currentRouteName() == 'dashboard' ? 'active' : '' }}">
            <a href="{{ route('dashboard') }}" class="menu-link">
                <i class="menu-icon tf-icons ti ti-home"></i>
                <div data-i18n="Page 1">Dashboard</div>
            </a>
        </li>
            
        <li class="menu-item {{ Route::currentRouteName() == 'admin.index' ? 'active' : '' }}">
            <a href="{{ route('admin.index') }}" class="menu-link">
                <i class="menu-icon tf-icons ti ti-user-cog"></i>
                <div data-i18n="Page 3">Admin Management</div>
            </a>
        </li>
        <li class="menu-item {{ Route::currentRouteName() == 'user.index' ? 'active' : '' }}">
            <a href="{{ route('user.index') }}" class="menu-link">
                <i class="menu-icon tf-icons ti ti-user-edit"></i>
                <div data-i18n="Page 4">User Management</div>
            </a>
        </li>
        @elseif ($userRole == 1) {{-- Status 1 dan Role Admin --}}
        <li class="menu-item {{ Route::currentRouteName() == 'dashboard' ? 'active' : '' }}">
            <a href="{{ route('dashboard') }}" class="menu-link">
                <i class="menu-icon tf-icons ti ti-home"></i>
                <div data-i18n="Page 1">Dashboard</div>
            </a>
        </li>
        <li class="menu-item {{ Route::currentRouteName() == 'user.index' ? 'active' : '' }}">
          <a href="{{ route('user.index') }}" class="menu-link">
              <i class="menu-icon tf-icons ti ti-user-edit"></i>
              <div data-i18n="Page 4">User Management</div>
          </a>
        </li>
        <li class="menu-item {{ Route::currentRouteName() == 'transaction' ? 'active' : '' }}">
          <a href="{{ route('transaction') }}" class="menu-link">
              <i class="menu-icon tf-icons ti ti-user-edit"></i>
              <div data-i18n="Page 4">Data Transaksi</div>
          </a>
        </li>
        <li class="menu-item {{ Route::currentRouteName() == 'whatsapp.admin' ? 'active' : '' }}">
          <a href="{{ route('whatsapp.admin') }}" class="menu-link">
              <i class="menu-icon tf-icons ti ti-user-edit"></i>
              <div data-i18n="Page 4">WhatsApp</div>
          </a>
        </li>
        {{-- <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Profile &amp; Settings</span>
        </li>
          <li class="menu-item {{ Route::currentRouteName() == 'user.index' ? 'active' : '' }}">
            <a href="{{ route('user.index') }}" class="menu-link">
                <i class="menu-icon tf-icons ti ti-user-edit"></i>
                <div data-i18n="Page 4">Profile</div>
            </a>
          </li>
          <li class="menu-item {{ Route::currentRouteName() == 'user.index' ? 'active' : '' }}">
            <a href="{{ route('user.index') }}" class="menu-link">
                <i class="menu-icon tf-icons ti ti-user-edit"></i>
                <div data-i18n="Page 4">Settings</div>
            </a>
          </li> --}}
        @elseif ($userRole == 2) {{-- Status 1 dan Role User --}}
        <li class="menu-item {{ Route::currentRouteName() == 'dashboard.user' ? 'active' : '' }}">
              <a href="{{ route('dashboard.user' , ['id' => $user->domain->id]) }}" class="menu-link">
                  <i class="menu-icon tf-icons ti ti-home"></i>
                  <div data-i18n="Page 1">Dashboard</div>
              </a>
          </li>
          <li class="menu-item {{ Route::currentRouteName() == 'pos.user' ? 'active' : '' }}">
              <a href="{{ route('pos.user' , ['id' => $user->domain->id]) }}" class="menu-link">
                  <i class="menu-icon tf-icons ti ti-home"></i>
                  <div data-i18n="Page 5">POS</div>
              </a>
          </li>
          <li class="menu-item {{ Route::currentRouteName() == 'cos.user' ? 'active' : ''}}">
              <a href="{{ route('cos.user' , ['id' => $user->domain->id]) }}" class="menu-link">
                  <i class="menu-icon tf-icons ti ti-home"></i>
                  <div data-i18n="Page 5"> Data Pelanggan</div>
              </a>
          </li>
          <li class="menu-item">
              <a href="#" class="menu-link">
                  <i class="menu-icon tf-icons ti ti-home"></i>
                  <div data-i18n="Page 5">Data Transaksi</div>
              </a>
          </li>
          <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
              <i class="menu-icon tf-icons ti ti-book"></i>
              <div data-i18n="Academy">Data Sparepart</div>
            </a>
            <ul class="menu-sub">
              <li class="menu-item">
                <a href="" class="menu-link">
                  <div data-i18n="Dashboard">List Sparepart</div>
                </a>
              </li>
              <li class="menu-item">
                <a href="" class="menu-link">
                  <div data-i18n="My Course">List Category</div>
                </a>
              </li>
            </ul>
          </li>
          <li class="menu-item">
              <a href="#" class="menu-link">
                  <i class="menu-icon tf-icons ti ti-home"></i>
                  <div data-i18n="Page 6">Laporan</div>
              </a>
          </li>
          <li class="menu-item {{ Route::currentRouteName() == 'profile.com' ? 'active' : '' }}">
            <a href="{{ route('profile.com' ,['id' => $user->domain->id])}}" class="menu-link ">
                <i class="menu-icon tf-icons ti ti-home"></i>
                <div data-i18n="Page 7">Profile</div>
            </a>
        </li>
      @endif
  @endif
  </ul>
  </aside>