<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
  <!-- Left navbar links -->
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" data-widget="pushmenu" href="{{route('home')}}" role="button"><i class="fas fa-bars"></i></a>
    </li>
  </ul>

  <ul class="navbar-nav ml-auto">
    <div class="user-panel d-flex  pb-1 pt-1">
      <div class="image">
        <img src="{{ auth()->user()->getAvatar() }}" class="img-circle elevation-1" alt="User Image">
      </div>
      <div class="info">
        <a>{{ auth()->user()->getFullname() }}</a>
      </div>
    </div>
  </ul>

</nav>
<!-- /.navbar -->