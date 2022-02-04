@include('layouts.sb-admin-2.cabecalho')
<body id="page-top"  > <!-- class="sidebar-toggled" -->
    <!-- Page Wrapper -->
    <div id="wrapper">
        <!-- Sidebar -->
        @include('layouts.sb-admin-2.projeto.menu')
        <!-- End of Sidebar -->
        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">
                <!-- Topbar -->
                    @include('layouts.sb-admin-2.projeto.topo')
                <!-- End of Topbar -->
                <!-- Begin Page Content -->
                <div class="container-fluid">
                    @yield('content')
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- End of Main Content -->
            <!-- Footer -->
                @include('layouts.sb-admin-2.projeto.rodape')
            <!-- End of Footer -->
        </div>
        <!-- End of Content Wrapper -->
    </div>
    <!-- End of Page Wrapper -->
    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>
    <!-- Logout Modal-->
    @include('layouts.sb-admin-2.projeto.logout_modal')
    <!-- Footer layout-->
    @include('layouts.sb-admin-2.javascript')
</body>
</html>
