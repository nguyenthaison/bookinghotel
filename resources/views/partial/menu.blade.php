	<nav class="navbar navbar-default navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a href="{{ url('/temporary') }}" class="navbar-brand"> <img src="{{ asset('assets/images/new_logo.png') }}" style="width:60px; height:30px;"/> </a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
            <li><a href="{{ url('/temporary') }}"> Home </a></li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> Villa By Area <span class="caret"></span></a>
              <ul class="dropdown-menu">
                @foreach ($areas as $area)
                  <li><a href="{{ url('/area/'. $area->slug) }}"> {{ $area->title }} </a></li>
                @endforeach
              </ul>
            </li>
            <li><a href="{{ url('/contact-us') }}"> Contact Us </a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>