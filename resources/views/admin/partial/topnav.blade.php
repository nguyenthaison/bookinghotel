
<?php 
	$me = Auth::user();
	$auth_role = 'admin';
	$auth_role_type = 1;
	if ($me->hasRole('reservation')){
		$auth_role = 'reservation';
		$auth_role_type = 2;
	}
	else if ($me->hasRole('guest')) {
		$auth_role_type = 3;
		$auth_role = 'guest';
	}
	?>
<!-- Header Navbar -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
		<div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
				<a href="{{ url(env('ADMIN_URL')) }}">
					<img src="{{ asset('/assets/images/new_logo.png') }}" alt="" width=60px; height=30px; style="margin:10px 30px;" />
                </a>
            </div>
            <div class="collapse navbar-collapse navbar-ex1-collapse">
		        
                <ul class="nav navbar-nav navbar-right navbar-user" style="margin-right:50px;">
					<?php if ($auth_role_type!=3){ ?>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-database"></i> Content<b class="caret"></b></a>
						<ul class="dropdown-menu">
							<li><a href="{{ route(env('ADMIN_URL').'.villa.index') }}"><i class="fa fa-home"></i> Villa</a></li>
							<li><a href="{{ route(env('ADMIN_URL').'.specialoffers.index') }}"><i class="fa fa-coffee"></i> Special Offers</a></li>
							<li><a href="{{ route(env('ADMIN_URL').'.reviews.index') }}"><i class="fa fa-star-half-o"></i> Villa Reviews</a></li>
							<li><a href="{{ route(env('ADMIN_URL').'.testimonial.index') }}"><i class="fa fa-check-square"></i> Guest Testimonial</a></li>
						</ul>
					</li>
					
                    <li class="divider-vertical"></li>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-hotel"></i> Master Data<b class="caret"></b></a>
						<ul class="dropdown-menu">
							<li><a href="{{ route(env('ADMIN_URL').'.bedroom.index') }}"><i class="fa fa-list"></i> Bedroom</a></li>
							<li><a href="{{ route(env('ADMIN_URL').'.region.index') }}"><i class="fa fa-location-arrow"></i> Region</a></li>
							<li><a href="{{ route(env('ADMIN_URL').'.area.index') }}"><i class="fa fa-globe"></i> Area</a></li>
							<li><a href="{{ route(env('ADMIN_URL').'.season.index') }}"><i class="fa fa-cloud"></i> Season</a></li>
							<li><a href="{{ route(env('ADMIN_URL').'.environment.index') }}"><i class="fa fa-tree"></i> Environment</a></li>
							<li><a href="{{ route(env('ADMIN_URL').'.gallery-group.index') }}"><i class="fa fa-file-photo-o"></i> Gallery Group</a></li>
						</ul>
					</li>
					<?php } 
					if ($auth_role_type == 1){
					?>
                    <li class="divider-vertical"></li>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-cogs"></i> Configuration<b class="caret"></b></a>
						<ul class="dropdown-menu">
							<li><a href="{{ route(env('ADMIN_URL').'.role.index') }}"><i class="fa fa-users"></i> Role</a></li>
							<li><a href="{{ route(env('ADMIN_URL').'.user.index') }}"><i class="fa fa-user"></i> User</a></li>
							<li><a href="{{ route(env('ADMIN_URL').'.permission.index') }}"><i class="fa fa-unlock-alt"></i> Permission</a></li>
							<li><a href="{{ route(env('ADMIN_URL').'.assignment') }}"><i class="fa fa-user-plus"></i> Assign Permission to Role</a></li>
						</ul>
					</li>
					<?php } ?>
					
                    <li class="divider-vertical"></li>
                    <li class="dropdown user-header">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
							<i class="fa fa-user-plus"></i>
							 <?= $auth_role?><b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="{{ url(env('ADMIN_URL').'/profile') }}"><i class="fa fa-user"></i> Profile</a></li>
                            <li><a href="#"><i class="fa fa-gear"></i> Settings</a></li>
                            <li class="divider"></li>
                            <li><a href="{{ url('/logout') }}"><i class="fa fa-power-off"></i> Log Out</a></li>

                        </ul>
                    </li>
                </ul>
            </div>
		</div>
    </nav>