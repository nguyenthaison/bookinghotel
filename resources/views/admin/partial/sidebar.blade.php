<?php
	return;
?>
<!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

      <!-- Sidebar user panel (optional) -->
      <div class="user-panel">
        <div class="pull-left image">

          <img src="{{ asset("/assets/images/vendor/user2-160x160.jpg")}}" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>admin</p>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <ul class="sidebar-menu">
        <!-- Optionally, you can add icons to the links -->
        <li class="header">Configuration</li>
        
        @can('create-role', 'edit-role', 'delete-role')
        <li class="treeview">
          <a href="#"><i class="fa fa-link"></i> <span>Role</span> <i class="fa fa-angle-left pull-right"></i></a>
          <ul class="treeview-menu">
            <li>{!! link_to_route(env('ADMIN_URL').'.role.index', 'List') !!}</li>
            <li>{!! link_to_route(env('ADMIN_URL').'.role.create', 'Add') !!}</li>
          </ul>
        </li>
        @endcan

        @can('create-user', 'edit-user', 'delete-user')
        <li class="treeview">
          <a href="#"><i class="fa fa-link"></i> <span>User</span> <i class="fa fa-angle-left pull-right"></i></a>
          <ul class="treeview-menu">
            <li>{!! link_to_route(env('ADMIN_URL').'.user.index', 'List') !!}</li>
            <li>{!! link_to_route(env('ADMIN_URL').'.user.create', 'Add') !!}</li>
          </ul>
        </li>
        @endcan

        @can('create-permission', 'edit-permission', 'delete-permission')
        <li class="treeview">
          <a href="#"><i class="fa fa-link"></i> <span>Permission</span> <i class="fa fa-angle-left pull-right"></i></a>
          <ul class="treeview-menu">
            <li>{!! link_to_route(env('ADMIN_URL').'.permission.index', 'List') !!}</li>
            <li>{!! link_to_route(env('ADMIN_URL').'.permission.create', 'Add') !!}</li>
          </ul>
        </li>
        @endcan

        @can('assign-permission')
        <li class="treeview">
          <a href="#"><i class="fa fa-link"></i> <span>Assign Permissions to Role</span> <i class="fa fa-angle-left pull-right"></i></a>
          <ul class="treeview-menu">
            <li>{!! link_to_route(env('ADMIN_URL').'.assignment', 'List') !!}</li>
          </ul>
        </li>
        @endcan
        
        <li class="header">Master Data</li>

        @can('create-bedroom', 'edit-bedroom', 'delete-bedroom')
        <li class="treeview">
          <a href="#"><i class="fa fa-link"></i> <span>Bedroom</span> <i class="fa fa-angle-left pull-right"></i></a>
          <ul class="treeview-menu">
            <li>{!! link_to_route(env('ADMIN_URL').'.bedroom.index', 'List') !!}</li>
            <li>{!! link_to_route(env('ADMIN_URL').'.bedroom.create', 'Add') !!}</li>
          </ul>
        </li>
        @endcan

        @can('create-region', 'edit-region', 'delete-region')
        <li class="treeview">
          <a href="#"><i class="fa fa-link"></i> <span>Region</span> <i class="fa fa-angle-left pull-right"></i></a>
          <ul class="treeview-menu">
            <li>{!! link_to_route(env('ADMIN_URL').'.region.index', 'List') !!}</li>
            <li>{!! link_to_route(env('ADMIN_URL').'.region.create', 'Add') !!}</li>
          </ul>
        </li>
        @endcan

        @can('create-area', 'edit-area', 'delete-area')
        <li class="treeview">
          <a href="#"><i class="fa fa-link"></i> <span>Area</span> <i class="fa fa-angle-left pull-right"></i></a>
          <ul class="treeview-menu">
            <li>{!! link_to_route(env('ADMIN_URL').'.area.index', 'List') !!}</li>
            <li>{!! link_to_route(env('ADMIN_URL').'.area.create', 'Add') !!}</li>
          </ul>
        </li>
        @endcan

        @can('create-season', 'edit-season', 'delete-season')
        <li class="treeview">
          <a href="#"><i class="fa fa-link"></i> <span>Season</span> <i class="fa fa-angle-left pull-right"></i></a>
          <ul class="treeview-menu">
            <li>{!! link_to_route(env('ADMIN_URL').'.season.index', 'List') !!}</li>
            <li>{!! link_to_route(env('ADMIN_URL').'.season.create', 'Add') !!}</li>
          </ul>
        </li>
        @endcan

        @can('create-environment', 'edit-environment', 'delete-environment')
        <li class="treeview">
          <a href="#"><i class="fa fa-link"></i> <span>Environment</span> <i class="fa fa-angle-left pull-right"></i></a>
          <ul class="treeview-menu">
            <li>{!! link_to_route(env('ADMIN_URL').'.environment.index', 'List') !!}</li>
            <li>{!! link_to_route(env('ADMIN_URL').'.environment.create', 'Add') !!}</li>
          </ul>
        </li>
        @endcan

        @can('create-gallery-groups', 'edit-gallery-groups', 'delete-galery-groups')
        <li class="treeview">
          <a href="#"><i class="fa fa-link"></i> <span>Gallery Groups</span> <i class="fa fa-angle-left pull-right"></i></a>
          <ul class="treeview-menu">
            <li>{!! link_to_route(env('ADMIN_URL').'.gallery-group.index', 'List') !!}</li>
            <li>{!! link_to_route(env('ADMIN_URL').'.gallery-group.create', 'Add') !!}</li>
          </ul>
        </li>
        @endcan

        @can('create-villa', 'edit-villa', 'delete-villa')
        <li class="header">Content</li>
        <li class="treeview">
          <a href="#"><i class="fa fa-link"></i> <span>Villa</span> <i class="fa fa-angle-left pull-right"></i></a>
          <ul class="treeview-menu">
            <li>{!! link_to_route(env('ADMIN_URL').'.villa.index', 'List') !!}</li>
            <li>{!! link_to_route(env('ADMIN_URL').'.villa.create', 'Add') !!}</li>
          </ul>
        </li>
        @endcan

        @can('create-special-offer', 'edit-special-offer', 'delete-special-offer')
        <li class="treeview">
          <a href="#"><i class="fa fa-link"></i> <span>Special Offers</span> <i class="fa fa-angle-left pull-right"></i></a>
          <ul class="treeview-menu">
            <li>{!! link_to_route(env('ADMIN_URL').'.specialoffers.index', 'List') !!}</li>
            <li>{!! link_to_route(env('ADMIN_URL').'.specialoffers.create', 'Add') !!}</li>
          </ul>
        </li>
        @endcan

        @can('create-review', 'approve-review', 'delete-review')
        <li class="treeview">
          <a href="#"><i class="fa fa-link"></i> <span>Villa Reviews</span> <i class="fa fa-angle-left pull-right"></i></a>
          <ul class="treeview-menu">
            <li>{!! link_to_route(env('ADMIN_URL').'.reviews.index', 'List') !!}</li>
            <li>{!! link_to_route(env('ADMIN_URL').'.reviews.create', 'Add') !!}</li>
          </ul>
        </li>
        @endcan

         @can('create-testimonial', 'approve-testimonial', 'delete-testimonial')
        <li class="treeview">
          <a href="#"><i class="fa fa-link"></i> <span>Guest Testimonial</span> <i class="fa fa-angle-left pull-right"></i></a>
          <ul class="treeview-menu">
            <li>{!! link_to_route(env('ADMIN_URL').'.testimonial.index', 'List') !!}</li>
            <li>{!! link_to_route(env('ADMIN_URL').'.testimonial.create', 'Add') !!}</li>
          </ul>
        </li>
        @endcan

      </ul>
      <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
  </aside>