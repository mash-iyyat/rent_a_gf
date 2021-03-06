<!DOCTYPE html>
<html>
<head>
	<title>Rent a GIRLFRIEND</title>
  <meta name="viewport" content="width=device-width, initial-scale=0.86, maximum-scale=5.0, minimum-scale=0.86">
	<link rel="stylesheet" type="text/css" href="/css/materialize.min.css">
	<link rel="stylesheet" type="text/css" href="/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="/css/app.css">
  <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
	<ul id="slide-out" class="side-nav fixed">
		<li>
			<div class="user-view">
	      <div class="background">
	        <img src="/images/cover1.jpg">
	      </div>
        @auth
          @if(Auth::user()->image == 'no-image.jpg')
	          <a href="/"><img class="circle" src="/images/avatar.png"></a>
          @else
	          <a href="/"><img class="circle" src="/storage/images/profiles/{{ Auth::user()->image }}"></a>
          @endif
        @endauth
	      <a><span class="white-text name">Rent A girlfriend</span></a>
	      <a><span class="white-text email">Join us and rent your girlfriend now</span></a>
    	</div>
    </li>
    <li class="no-padding">
      <ul class="collapsible collapsible-accordion">
      	<li>
      		 <a href="{{ route('index') }}"><i class="fa fa-home fa-3"></i> Home</a>
      	</li>
      	@auth
          @if(auth()->user()->role == 'admin')
            <li>
               <a href="{{ route('dashboard') }}"><i class="fa fa-list fa-3"></i> Admin Panel</a>
            </li>
          @endif
      	<li class="bold">
      		<a class="collapsible-header waves-effect waves-teal">
      		  <i class="fa fa-sort-desc"></i>Account
      		</a>
          <div class="collapsible-body">
            <ul>
              <li><a href="{{ route('profile') }}">Profile <i class="fa fa-user black-text"></i></a></li>
              @if(auth()->user()->alreadyRegisteredGirlfriend())
              <li>
                <a href="{{ route('girlfriend-account') }}">
                  Girlfriend Account <i class="fa fa-user-o black-text"></i>
                </a>
              </li>
              @endif
              <li><a href="{{ route('my-rent') }}">My Rent <i class="fa fa-heart black-text"></i></a></li>
              <li><a href="#!" onclick="logout()">Logout <i class="fa fa-sign-out"></i></a></li>
              <form id="logout-form" action="{{ route('logout-user') }}" method="POST" style="display: none;">
                @csrf
              </form>
            </ul>
          </div>
        </li>
        <li>
          <a href="{{ route('notifications') }}">
            Notifications <i class="fa fa-bell black-text"></i>
            <span class="badge white-text red new">
              {{ auth()->user()->unreadNotifications->count() }} 
            </span>
          </a>
        </li>
        @endauth

        <li><a href="{{ route('rent') }}">Rent a girlfriend<i class="fa fa-heart black-text"></i></a></li>
        <li><a href="{{ route('tags') }}">Tags <i class="fa fa-tag black-text"></i></a></li>
        <li><a href="{{ route('search') }}">Search Girlfriend <i class="fa fa-search black-text"></i></a></li>
        @auth
          @if(!auth()->user()->alreadyRegisteredGirlfriend())
            <li><a href="{{ route('apply') }}">Apply as a girlfriend <i class="fa fa-sign-in"></i></a></li>
          @endif
        @endauth

        @guest
        <li class="bold">
        	<a class="collapsible-header waves-effect waves-teal">
      		  <i class="fa fa-sort-desc"></i>Join Us
      		</a>
          <div class="collapsible-body">
            <ul>
              <li><a href="{{ route('register') }}">Register <i class="fa fa-sign-in"></i></a></li>
              <li><a href="{{ route('login') }}">Login <i class="fa fa-sign-in"></i></a></li>
            </ul>
          </div>
        </li>
        @endguest
      </ul>
    </li>
  </ul><!-- sidenav -->
 
  <div class="body-container">
  	@yield('content')
  </div>
</body>
	<script src="/js/jquery-3.2.1.min.js"></script>
	<script src="/js/materialize.min.js"></script>
  <script src="/js/sweetalert.min.js"></script>
	<script src="/js/app.js"></script>
  @yield('scripts')
</html>