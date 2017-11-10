<!-- Header -->
    @include('admin/partial/header')

    </head>

    <body class="hold-transition skin-blue sidebar-mini" ng-app="backend" style="background:url('{{ asset("/assets/images/login-bg.jpg") }}') scroll 0 0 repeat-y;">
    <div class="container" id="wrapper" style="box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);">

      <!-- Main Header -->
      @include('admin/partial/topnav')

    <!-- Sidebar -->
    <!--@include('admin/partial/sidebar')-->

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper" style="margin-left: 0px; margin-top:50px;">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            @yield('heading_breadcrumb')
            @if (strpos(url()->current(), 'create') == false && strpos(url()->current(), 'assignment') == false && strpos(url()->current(), 'edit') == false 
                        && strpos(url()->current(), 'rates') == false && strpos(url()->current(), 'gallery') == false && strcmp(url()->current(), url(env('ADMIN_URL'))) != 0
                        && strpos(url()->current(), 'profile') == false)
                <a href="{{ url()->current().'/create' }}" class="btn btn-success" style="margin-top:10px;"><i class="fa fa-plus"></i></a>
            @endif
			
        </section>

        <!-- Main content -->
        <section class="content">
            <!-- Your Page Content Here -->
            @yield('content')
        </section><!-- /.content -->
    </div><!-- /.content-wrapper -->

    <!-- Footer -->
    @include('admin/partial/footer')
	