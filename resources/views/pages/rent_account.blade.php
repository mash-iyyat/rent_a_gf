@extends('layouts.app')

@section('content')
<nav class="blue lighten-1">
  <div class="nav-wrapper container">
    <a href="#!" class="brand-logo right">Rent a Girlfriend</a>
    <a href="#" data-activates="slide-out" class="button-collapse">
      <i class="fa fa-bars"></i>
    </a>
  </div>
</nav><!-- navbar -->

<div class="row body-components-container">
  <div class="row profile-header">
    <div class="profile-cover col l4 offset-l4 m4 offset-m4 s6 offset-s3">
      @if($girlfriend->user->image == 'no-image.jpg')
        <img src="{{ asset('images/avatar.png') }}" alt="" class="max-width circle">
      @else
        <img src="/storage/images/profiles/{{ $girlfriend->user->image }}" alt="" class="max-width circle">
      @endif
    </div>
    <div class="col s12 m10 offset-m1 profile-details">
      <div class="center">
        <h4>{{ $girlfriend->username }}</h4>
        <b><i class="fa fa-map-marker"></i> {{$girlfriend->user->address }}</b><br>
      </div>
      <ul class="collection">
        <li class="collection-item">
          @if($girlfriend->availability == true)
            <i class="fa fa-circle green-text"></i> Available
          @else
            <i class="fa fa-circle grey-text"></i> Not Available
          @endif
        </li>
        <li class="collection-item">
          <i class="fa fa-envelope"></i> Email: {{ $girlfriend->user->email }}
        </li>
        <li class="collection-item">
          @foreach($girlfriend->tags as $tag)
            <div class="chip grey darken-2 white-text">
              <i class="fa fa-tag"></i> {{ $tag->tag }}
            </div>
          @endforeach
        </li>
        <li class="collection-item">
          <i class="fa fa-pencil"></i> Description: {!! $girlfriend->description !!}
        </li>
        <li class="collection-item">
          <i class="fa fa-list"></i> Total Rents: {{  $girlfriend->rents()->where('status','completed')->count() }}
        </li>
        <li id="rent-btn-container">
          <!-- ============= APPEND BUTTON HERE ============ -->
        </li>
      </ul>
    </div>  
  </div>
  <div class="row feedbacks-container">
    <ul class="collection with-header">
      <li class="collection-header row">
        <h5>Feedbacks:</h5>
      </li>
      <div id="feedbacks-container">
        <!-- =========== APPEND HERE ============ -->
      </div>
      <li class="collection-item">
        @if($girlfriend->feedbacks()->count() > 5) 
        <button class="btn btn-flat waves-effect waves-light blue white-text max-width" id="view-more-feedback-btn">
          <i class="fa fa-sort-desc"></i>
        </button>
        @endif
      </li>
    </ul>
    <div class="input-field feedback-form-container">
      <form id="feedback-form" autocomplete="off">
        {{ @csrf_field() }}
        <input type="hidden" name="girlfriend_id" value="{{ $girlfriend->id }}">
        <input type="text" name="feedback" id="feedback-input" placeholder="Enter your feedback">
      </form>
    </div> 
  </div>
</div><!-- body-components-container -->
@endsection

@section('scripts')
  <script>
    const girlfriend_id = '{{ $girlfriend->id }}';
    $(document).ready(() => {
      checkGirlfriendRent(girlfriend_id);
      getGirlfriendFeedbacks();
    });
  </script>
  <script src="/js/user/rent.js"></script>
  <script src="/js/user/rent_girlfriend.js"></script>
  <script src="/js/user/feedback.js"></script>
  
@endsection