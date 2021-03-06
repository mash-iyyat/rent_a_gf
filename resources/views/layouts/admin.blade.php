<html>
  <head>
    <title>Side nav</title>
    <meta name="viewport" content="width=device-width, initial-scale=0.86, maximum-scale=5.0, minimum-scale=0.86">
    <link rel="stylesheet" href="/css/materialize.css">
    <link rel="stylesheet" href="/css/font-awesome.min.css">
    <link rel="stylesheet" href="/css/app.css">
    <link rel="stylesheet" href="/css/admin.css">
  </head>
  <body>
    <ul id="slide-out" class="side-nav fixed">
      <li>
        <div class="user-view">
          <div class="background">
            <img src="/images/cover1.jpg">
          </div>
          <a href="/"><img class="circle" src="/images/avatar.png"></a>
          <a><span class="white-text name">Rent A girlfriend</span></a>
          <a><span class="white-text email">Admin Panel</span></a>
        </div>
      </li>
      <li class="no-padding">
        <ul class="collapsible collapsible-accordion">
          <li>
            <a href="{{ route('index') }}"><i class="fa fa-home fa-3"></i> Home</a>
          </li>
          <li>
             <a href="{{ route('dashboard') }}"><i class="fa fa-list fa-3"></i> Dashboard</a>
          </li>
          <li class="bold">
            <a class="collapsible-header waves-effect waves-teal">
              <i class="fa fa-sort-desc"></i>Account
            </a>
            <div class="collapsible-body">
              <ul>
                <li><a href="{{ route('accountlist') }}">Account List <i class="fa fa-list black-text"></i></a></li>
                <!-- <li><a href="#">Archive <i class="fa fa-trash black-text"></i></a></li> -->
                <li><a onclick="logout()" href="#!">Logout <i class="fa fa-sign-out"></i></a></li>
                <form id="logout-form" action="{{ route('logout-user') }}" method="POST" style="display: none;">
                  @csrf
                </form>
              </ul>
            </div>
          </li>
          <li class="bold">
            <a class="collapsible-header waves-effect waves-teal">
              <i class="fa fa-sort-desc"></i>Girlfriends
            </a>
            <div class="collapsible-body">
              <ul>
                <li><a href="{{ route('addgirlfriend') }}">Add Girlfriend <i class="fa fa-plus black-text"></i></a></li>
                <li><a href="{{ route('girlfriendlist') }}">Girlfriend List <i class="fa fa-list black-text"></i></a></li>
                <li><a href="{{ route('girlfriendrequests') }}">Girlfriend Requests <i class="fa fa-list black-text"></i></a></li>
                <li><a href="{{ route('girlfriendarchive') }}">Archive <i class="fa fa-trash black-text"></i></a></li>
              </ul>
            </div>
          </li>
            <!-- <li class="bold">
              <a class="collapsible-header waves-effect waves-teal">
                <i class="fa fa-sort-desc"></i>Rents
              </a>
              <div class="collapsible-body">
                <ul>
                  <li><a href="{{ route('activerents') }}">Active rents <i class="fa fa-list black-text"></i></a></li>
                  <li><a href="grid.html">Rent List<i class="fa fa-list black-text"></i></a></li>
                </ul>
              </div>
            </li> -->
        </ul>
      </li>
    </ul><!-- sidenav -->
    <div class="body-container">
      <nav>
        <div class="nav-wrapper container">
          <a href="{{ route('dashboard') }}" class="brand-logo right">Admin Panel</a>
          <a href="#" data-activates="slide-out" class="button-collapse">
            <i class="fa fa-bars"></i>
          </a>
        </div>
      </nav><!-- navbar -->
      @yield('content')
    </div>

  </body>
  <script src="/js/jquery-3.2.1.min.js"></script>
  <script src="/js/materialize.min.js"></script>
  <script src="/js/sweetalert.min.js"></script>
  <script src="/js/app.js"></script>
  @yield('scripts')
</html>