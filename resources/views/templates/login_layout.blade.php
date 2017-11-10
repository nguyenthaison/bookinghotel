<!-- Header -->
    @include('templates/admin_header')

    </head>

    <body class="hold-transition login-page" ng-app="backend">
    <div class="login-box">
        <!-- Login Logo -->
        <div class="login-logo">
            @yield('logo')
        </div>

        <!-- Login Wrapper -->
        <div class="login-box-body">
            <!-- Main content -->
            <section class="content">
                <!-- Your Page Content Here -->
                @yield('content')
            </section><!-- /.content -->
        </div><!-- /.Login Wrapper -->
    </div>
    <!-- Footer -->
    @include('templates/admin_js')

  </body>
</html>