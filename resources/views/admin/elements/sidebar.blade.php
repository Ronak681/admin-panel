<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item nav-profile">
            <a href="#" class="nav-link">
                <div class="nav-profile-image">
                    <img src="{{asset('adminn/assets/images/faces/face1.jpg')}}" alt="profile" />
                    <span class="login-status online"></span>
                </div>
                <div class="nav-profile-text d-flex flex-column">
                    <span class="font-weight-bold mb-2">David Grey. H</span>
                    <span class="text-secondary text-small">Project Manager</span>
                </div>
                <i class="mdi mdi-bookmark-check text-success nav-profile-badge"></i>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.dashboard')}}">
                <span class="menu-title">Dashboard</span>
                <i class="mdi mdi-view-dashboard menu-icon"></i> 
            </a>
        </li>
        <li class="nav-item">
            <button type="button" class="navbar-toggler border-0 order-1" data-bs-toggle="collapse" data-bs-target="#nav" aria-controls="nav" aria-expanded="false" aria-label="Toggle navigation" style="color: #b66dff;">
                User Management
            </button>
            <i class="mdi mdi-account-group menu-icon" style="margin-left:30px; color:#b66dff; font-size:1.125rem;"></i> 

            <div class="collapse navbar-collapse order-last" id="nav">
                <ul class="navbar-nav flex-column w-100 justify-content-center">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="userHomeDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Trainee
                        </a>
                        <ul class="dropdown-menu dropdown-menu-light dropdown-menu-end w-100 text-center" aria-labelledby="userHomeDropdown">
                            <li><a class="dropdown-item" href="{{ route('add.user',['role_id' => 0])}}">Add</a></li>
                            <li><a class="dropdown-item" href="{{ route('show.list',['role_id' => 0])}}">List</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
            <div class="collapse navbar-collapse order-last" id="nav">
      <ul class="navbar-nav flex-column w-100 justify-content-center">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="userHomeDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Developer
          </a>
          <ul class="dropdown-menu dropdown-menu-light dropdown-menu-end w-100 text-center" aria-labelledby="userHomeDropdown">
          <li><a class="dropdown-item" href="{{ route('add.user',['role_id' => 1])}}">Add</a></li>
          <li><a class="dropdown-item" href="{{ route('show.list',['role_id' => 1])}}">List</a></li>

              
            </li>
          </ul>
        </li>
      </ul>
    </div> 
    <div class="collapse navbar-collapse order-last" id="nav">
      <ul class="navbar-nav flex-column w-100 justify-content-center">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="userHomeDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
           Senior Developer
        </a>
          <ul class="dropdown-menu dropdown-menu-light dropdown-menu-end w-100 text-center" aria-labelledby="userHomeDropdown">
          <li><a class="dropdown-item" href="{{ route('add.user',['role_id' => 2])}}">Add</a></li>
          <li><a class="dropdown-item" href="{{ route('show.list',['role_id' => 2])}}">List</a></li>

              
            </li>
          </ul>
        </li>
      </ul>
    </div>
    <div class="collapse navbar-collapse order-last" id="nav">
      <ul class="navbar-nav flex-column w-100 justify-content-center">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="userHomeDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Team Lead
          </a>
          <ul class="dropdown-menu dropdown-menu-light dropdown-menu-end w-100 text-center" aria-labelledby="userHomeDropdown">
          <li><a class="dropdown-item" href="{{ route('add.user',['role_id' => 3])}}">Add</a></li>
          <li><a class="dropdown-item" href="{{ route('show.list',['role_id' => 3])}}">List</a></li>

              
            </li>
          </ul>
        </li>
      </ul>
    </div>
    <div class="collapse navbar-collapse order-last" id="nav">
      <ul class="navbar-nav flex-column w-100 justify-content-center">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="userHomeDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            CTO
          </a>
          <ul class="dropdown-menu dropdown-menu-light dropdown-menu-end w-100 text-center" aria-labelledby="userHomeDropdown">
          <li><a class="dropdown-item" href="{{ route('add.user',['role_id' => 4])}}">Add</a></li>
          <li><a class="dropdown-item" href="{{ route('show.list',['role_id' => 4])}}">List</a></li>

              
            </li>
          </ul>
        </li>
      </ul>
    </div>
          
        </li>
        <li class="nav-item">
    <button type="button" class="navbar-toggler border-0 order-1 pt-4" data-bs-toggle="collapse" data-bs-target="#supplier-nav" aria-controls="supplier-nav" aria-expanded="false" aria-label="Toggle navigation" style="color: #b66dff;">
        Supplier Management
    </button>
    <i class="mdi mdi-truck menu-icon" style="margin-left:5px; color:#b66dff; font-size:1.125rem;"></i> <!-- Updated Icon -->

    <div class="collapse navbar-collapse order-last" id="supplier-nav">
        <ul class="navbar-nav flex-column w-100 justify-content-center">
            <li class="nav-item dropdown">
                <a class="dropdown-item pt-3" href="{{ route('supplier.list') }}">
                    Supplier
                </a>
            </li>
           
        </ul>
    </div>
</li>


        <li class="nav-item">
            <button type="button" class="navbar-toggler border-0 order-1 pt-4" data-bs-toggle="collapse" data-bs-target="#order-nav" aria-controls="order-nav" aria-expanded="false" aria-label="Toggle navigation" style="color: #b66dff;">
                Order Management
            </button>
            <i class="mdi mdi-cart menu-icon" style="margin-left:19px; color:#b66dff; font-size:1.125rem;"></i> <!-- Updated Icon -->
            <div class="collapse navbar-collapse order-last" id="order-nav">
                <ul class="navbar-nav flex-column w-100 justify-content-center">
                    <li class="nav-item dropdown">
                        <a class="dropdown-item pt-3" href="{{ route('purchase.list')}}" >
                            Purchase Order
                        </a>
                    </li>
                </ul>
            </div>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.product')}}">
                <span class="menu-title">Product</span>
                <i class="mdi mdi-package-variant menu-icon"></i> <!-- Updated Icon -->
            </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('list.category')}}">
              <span class="menu-title">Category</span>
              <i class="mdi mdi-package-variant menu-icon"></i> <!-- Updated Icon -->
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('headerlist')}}">
              <span class="menu-title">header list</span>
              <i class="mdi mdi-plus-circle menu-icon"></i> <!-- Updated Icon -->
          </a>
      </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('blog.post') }}">
                <span class="menu-title">Add Post</span>
                <i class="mdi mdi-pencil menu-icon"></i> <!-- Updated Icon -->
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('blog.list') }}">
                <span class="menu-title">Show Post</span>
                <i class="mdi mdi-eye menu-icon"></i> <!-- Updated Icon -->
            </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('about.list') }}">
              <span class="menu-title">About</span>
              <i class="mdi mdi-eye menu-icon"></i> <!-- Updated Icon -->
          </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ route('contact.list') }}">
            <span class="menu-title">Contact</span>
            <i class="mdi mdi-contacts menu-icon"></i> <!-- Updated Icon -->
        </a>
    </li>
    </ul>
</nav>
