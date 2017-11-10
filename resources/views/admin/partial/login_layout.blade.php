<!-- Header -->
    @include('admin/partial/header')

    </head>

    <body class="hold-transition login-page" ng-app="backend" style="background-color:white;">
    <div class="login-box">
        <!-- Login Logo -->
        <div class="login-logo">
            @yield('logo')
        </div>

        <!-- Login Wrapper -->
        <div class="login-box-body" style="background-color:#eee;">
            <!-- Main content -->
            <section class="content">
                <!-- Your Page Content Here -->
                @yield('content')
            </section><!-- /.content -->
        </div><!-- /.Login Wrapper -->
    </div>
    <!-- Footer -->
  @include('admin/partial/script')

  </body>
</html>