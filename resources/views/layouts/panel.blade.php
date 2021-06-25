<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8" />
        <title>BackupSys | Panel</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Backup System Software" name="description" />
        <meta content="OzanUzer" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="/favicon.png">
        <!-- third party css -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        @yield('extrastyles')
        <!-- App css -->
        
        @if ( Auth::user()->paneltheme == "light" )
            <link href="/admin/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" id="bootstrap-stylesheet"/>
            <link href="/admin/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
            <link href="/admin/assets/css/app.min.css" rel="stylesheet" type="text/css" id="app-stylesheet" />
        @elseif ( Auth::user()->paneltheme == "dark" )
            <link href="/admin/assets/css/bootstrap-dark.min.css" rel="stylesheet" type="text/css" id="bootstrap-stylesheet"/>
            <link href="/admin/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
            <link href="/admin/assets/css/app-dark.min.css" rel="stylesheet" type="text/css" id="app-stylesheet" />
        @else
        <script>
            if (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches) {
                document.write('<link href="/admin/assets/css/bootstrap-dark.min.css" rel="stylesheet" type="text/css" id="bootstrap-stylesheet"/>');
                document.write('<link href="/admin/assets/css/icons.min.css" rel="stylesheet" type="text/css" />');
                document.write('<link href="/admin/assets/css/app-dark.min.css" rel="stylesheet" type="text/css" id="app-stylesheet" />');
            } else {
                document.write('<link href="/admin/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" id="bootstrap-stylesheet"/>');
                document.write('<link href="/admin/assets/css/icons.min.css" rel="stylesheet" type="text/css" />');
                document.write('<link href="/admin/assets/css/app.min.css" rel="stylesheet" type="text/css" id="app-stylesheet" />');
            }
        </script>
        @endif
            
        
        <style>
            .new_button{
                float:right; margin-top:-10px; color:#fff !important;
            }
            .dbtalbe_button{
                color:#fff !important;
            }
        </style>

    </head>

    <body>

        <!-- Begin page -->
        <div id="wrapper">

            
            <!-- Topbar Start -->
            <div class="navbar-custom">
                <ul class="list-unstyled topnav-menu float-right mb-0">

                    <li class="dropdown notification-list">
                        <a href="{{ route('logout') }}" class="nav-link">
                        <i class="mdi mdi-logout-variant"></i>
                                <span>Logout</span>
                        </a>
                    </li>

                    <li class="dropdown notification-list">
                        <a href="javascript:void(0);" class="nav-link right-bar-toggle">
                            <i class="mdi mdi-settings-outline noti-icon"></i>
                        </a>
                    </li>


                </ul>

                <!-- LOGO -->
                <div class="logo-box">
                    <a href="{{ route('dashboard') }}" class="logo text-center logo-dark">
                        <span class="logo-lg">
                            <img src="/logo.png" alt="" height="56">
                            <!-- <span class="logo-lg-text-dark">Simple</span> -->
                        </span>
                        <span class="logo-sm">
                            <!-- <span class="logo-lg-text-dark">S</span> -->
                            <img src="logo.png" alt="" height="22">
                        </span>
                    </a>

                    <a href="{{ route('dashboard') }}" class="logo text-center logo-light">
                        <span class="logo-lg">
                            <img src="/logo_dark.png" alt="" height="56">
                            <!-- <span class="logo-lg-text-light">Simple</span> -->
                        </span>
                        <span class="logo-sm">
                            <!-- <span class="logo-lg-text-light">S</span> -->
                            <img src="/logo_dark.png" alt="" height="22">
                        </span>
                    </a>
                </div>

                <ul class="list-unstyled topnav-menu topnav-menu-left m-0">
                    <li>
                        <button class="button-menu-mobile">
                            <i class="mdi mdi-menu"></i>
                        </button>
                    </li>
        
                    <li class="d-none d-sm-block" style="display:none !important;">
                        <form class="app-search">
                            <div class="app-search-box">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Search...">
                                    <div class="input-group-append">
                                        <button class="btn" type="submit">
                                            <i class="fas fa-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </li>
                </ul>
            </div>
            <!-- end Topbar --> <!-- ========== Left Sidebar Start ========== -->
<div class="left-side-menu">


                <div class="user-box">
                        <div class="float-left">
                            <img src="/admin/assets/images/user.png" alt="" class="avatar-md rounded-circle">
                        </div>
                        <div class="user-info">
                            <a href="#">{{ Auth::user()->name }}</a>
                            <p class="text-muted m-0">Admin Panel</p>
                        </div>
                    </div>
    
            <!--- Sidemenu -->
            <div id="sidebar-menu">
    
                <ul class="metismenu" id="side-menu">
    
                    <li class="menu-title">Menu</li>
    
                    <li>
                        <a href="{{ route('dashboard') }}">
                            <i class="ti-home"></i>
                            <span> Dashboard </span>
                        </a>
                    </li>
    
                    <li>
                        <a href="{{ route('panel.hosting') }}">
                            <i class="mdi mdi-message-image-outline"></i>
                            <span> Hosting </span>
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('panel.remotesettings') }}">
                            <i class="mdi mdi-newspaper-variant-outline"></i>
                            <span> Remote Settings </span>
                        </a>
                    </li>
    
                    
                </ul>
    
            </div>
            <!-- End Sidebar -->
    
            <div class="clearfix"></div>

    
    </div>
    <!-- Left Sidebar End -->

    @yield('content')


                    <!-- Footer Start -->
                    <footer class="footer">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-12">
                                    2021 &copy; <a href="#" target='_blank'>BackupSys</a>
                                </div>
                            </div>
                        </div>
                    </footer>
                    <!-- end Footer -->

                </div>
                <!-- end content -->

            </div>
            <!-- END content-page -->

        </div>
        <!-- END wrapper -->

        
        <!-- Right Sidebar -->
        <div class="right-bar">
            <div class="rightbar-title">
                <a href="javascript:void(0);" class="right-bar-toggle float-right">
                    <i class="mdi mdi-close"></i>
                </a>
                <h5 class="font-16 m-0 text-white">Theme</h5>
            </div>
            <div class="slimscroll-menu">
        
                <div class="p-4">
                    <div class="mb-2">
                        <img src="/admin/assets/images/layouts/light.png" class="img-fluid img-thumbnail" alt="">
                    </div>
                    <div class="custom-control custom-switch mb-3">
                        @if ( Auth::user()->paneltheme == "light" )
                        <input type="checkbox" class="custom-control-input theme-choice" id="fk-light-mode-switch" checked />
                        @else
                        <input type="checkbox" class="custom-control-input theme-choice" id="fk-light-mode-switch" />
                        @endif                        
                        <label class="custom-control-label" for="fk-light-mode-switch">Light</label>
                    </div>
            
                    <div class="mb-2">
                        <img src="/admin/assets/images/layouts/dark.png" class="img-fluid img-thumbnail" alt="">
                    </div>
                    <div class="custom-control custom-switch mb-3">
                        @if ( Auth::user()->paneltheme == "dark" )
                        <input type="checkbox" class="custom-control-input theme-choice" id="fk-dark-mode-switch" checked />
                        @else
                        <input type="checkbox" class="custom-control-input theme-choice" id="fk-dark-mode-switch" />
                        @endif
                        <input type="checkbox" class="custom-control-input theme-choice" id="dark-mode-switch" data-bsStyle="/admin/assets/css/bootstrap-dark.min.css" 
                            data-appStyle="/admin/assets/css/app-dark.min.css" style="display:none;" />
                        <label class="custom-control-label" for="fk-dark-mode-switch">Dark</label>
                    </div>

                    <div class="mb-2">
                        <img src="/admin/assets/images/layouts/system.png" class="img-fluid img-thumbnail" alt="">
                    </div>
                    <div class="custom-control custom-switch mb-3">
                        @if ( Auth::user()->paneltheme == "system" )
                        <input type="checkbox" class="custom-control-input theme-choice" id="fk-system-mode-switch" checked />
                        @else
                        <input type="checkbox" class="custom-control-input theme-choice" id="fk-system-mode-switch" />
                        @endif
                        <label class="custom-control-label" for="fk-system-mode-switch">System</label>
                    </div>
                </div>
            </div> <!-- end slimscroll-menu-->
        </div>
        <!-- /Right-bar -->

        <!-- Right bar overlay-->
        <div class="rightbar-overlay"></div>

        <a href="javascript:void(0);" class="right-bar-toggle demos-show-btn">
            <i class="mdi mdi-settings-outline mdi-spin"></i> &nbsp;Theme
        </a>

        <!-- Vendor js -->
        <script src="/admin/assets/js/vendor.min.js"></script>
        @yield('extrascripts')
        <!-- App js -->
        <script src="/admin/assets/js/app.min.js"></script>
        <script>
        $(document).ready(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', e => {
                const newColorScheme = e.matches ? "dark" : "light";
                if (newColorScheme === "dark"){
                    $('#bootstrap-stylesheet').attr('href', "/admin/assets/css/bootstrap-dark.min.css");
                    $('#app-stylesheet').attr('href', "/admin/assets/css/app-dark.min.css");
                } else {
                    $('#bootstrap-stylesheet').attr('href', "/admin/assets/css/bootstrap.min.css");
                    $('#app-stylesheet').attr('href', "/admin/assets/css/app.min.css");
                }                
            });
            $("#fk-light-mode-switch").on('change', function() {
                if (this.checked) {
                    $('#bootstrap-stylesheet').attr('href', "/admin/assets/css/bootstrap.min.css");
                    $('#app-stylesheet').attr('href', "/admin/assets/css/app.min.css");

                    $("#fk-dark-mode-switch").prop('checked', false);
                    $("#fk-system-mode-switch").prop('checked', false);
                    $.ajax({
                        url: "{{route('dashboard.changetheme')}}",
                        type: "POST",
                        data:  { theme: 'light' },
                        success: function (data, textStatus, jqXHR) {
                            if(data.success){
                            Swal.fire(
                                'Success!',
                                'Theme Saved',
                                'success'
                                ).then(function (){
                                    //location.reload();
                                });
                            }else{
                                Swal.fire(
                                'Error!',
                                'System Error!',
                                'error'
                                ).then(function (){
                                    location.reload();
                                });
                            }
                        },error: function(jqXHR, textStatus, errorThrown) {
                        }
                    });
                }
            });
            $("#fk-dark-mode-switch").on('change', function() {
                if (this.checked) {
                    $('#bootstrap-stylesheet').attr('href', "/admin/assets/css/bootstrap-dark.min.css");
                    $('#app-stylesheet').attr('href', "/admin/assets/css/app-dark.min.css");

                    $("#fk-light-mode-switch").prop('checked', false);
                    $("#fk-system-mode-switch").prop('checked', false);
                    $.ajax({
                        url: "{{route('dashboard.changetheme')}}",
                        type: "POST",
                        data:  { theme: 'dark' },
                        success: function (data, textStatus, jqXHR) {
                            if(data.success){
                            Swal.fire(
                                'Success!',
                                'Theme Saved',
                                'success'
                                ).then(function (){
                                    //location.reload();
                                });
                            }else{
                                Swal.fire(
                                'Error!',
                                'System Error!',
                                'error'
                                ).then(function (){
                                    location.reload();
                                });
                            }
                        },error: function(jqXHR, textStatus, errorThrown) {
                        }
                    });
                }
            });
            $("#fk-system-mode-switch").on('change', function() {
                if (this.checked) {
                    if (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches) {
                        $('#bootstrap-stylesheet').attr('href', "/admin/assets/css/bootstrap-dark.min.css");
                        $('#app-stylesheet').attr('href', "/admin/assets/css/app-dark.min.css");
                    } else {
                        $('#bootstrap-stylesheet').attr('href', "/admin/assets/css/bootstrap.min.css");
                        $('#app-stylesheet').attr('href', "/admin/assets/css/app.min.css");
                    }

                    $("#fk-light-mode-switch").prop('checked', false);
                    $("#fk-dark-mode-switch").prop('checked', false);
                    $.ajax({
                        url: "{{route('dashboard.changetheme')}}",
                        type: "POST",
                        data:  { theme: 'system' },
                        success: function (data, textStatus, jqXHR) {
                            if(data.success){
                            Swal.fire(
                                'Success!',
                                'Theme Saved',
                                'success'
                                ).then(function (){
                                    //location.reload();
                                });
                            }else{
                                Swal.fire(
                                'Error!',
                                'System Error!',
                                'error'
                                ).then(function (){
                                    location.reload();
                                });
                            }
                        },error: function(jqXHR, textStatus, errorThrown) {
                        }
                    });
                }
            });   
        });
        </script>
        

    </body>

</html>