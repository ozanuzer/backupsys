<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8" />
        <title>Panel | Dashboard</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Responsive bootstrap 4 admin template" name="description" />
        <meta content="Coderthemes" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="/admin/assets/images/favicon.ico">
        <!-- third party css -->
        @yield('extrastyles')
        <!-- App css -->
        <link href="/admin/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" id="bootstrap-stylesheet" />
        <link href="/admin/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
        <link href="/admin/assets/css/app.min.css" rel="stylesheet" type="text/css" id="app-stylesheet" />

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
                            <img src="/assets/images/logo-dark.png" alt="" height="56">
                            <!-- <span class="logo-lg-text-dark">Simple</span> -->
                        </span>
                        <span class="logo-sm">
                            <!-- <span class="logo-lg-text-dark">S</span> -->
                            <img src="/assets/images/logo-dark.png" alt="" height="22">
                        </span>
                    </a>

                    <a href="{{ route('dashboard') }}" class="logo text-center logo-light">
                        <span class="logo-lg">
                            <img src="/assets/images/logo-light.png" alt="" height="56">
                            <!-- <span class="logo-lg-text-light">Simple</span> -->
                        </span>
                        <span class="logo-sm">
                            <!-- <span class="logo-lg-text-light">S</span> -->
                            <img src="/assets/images/logo-dark.png" alt="" height="22">
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
                            <p class="text-muted m-0">Yönetim Paneli</p>
                        </div>
                    </div>
    
            <!--- Sidemenu -->
            <div id="sidebar-menu">
    
                <ul class="metismenu" id="side-menu">
    
                    <li class="menu-title">Menü</li>
    
                    <li>
                        <a href="{{ route('dashboard') }}">
                            <i class="ti-home"></i>
                            <span> Ana Sayfa </span>
                        </a>
                    </li>
                    <li>
                        <a href="javascript: void(0);">
                            <i class="mdi mdi-account-multiple-outline"></i>
                            <span>  Modeller  </span>
                            <span class="menu-arrow"></span>
                        </a>
                        <ul class="nav-second-level nav" aria-expanded="false">
                            <li>
                                <a href="{{ route('panel.models.women') }}" class >Kadın</a>
                            </li>
                            <li>
                                <a href="{{ route('panel.models.man') }}">Erkek</a>
                            </li>
                            <li>
                                <a href="{{ route('panel.models.intown') }}">Şehirdekiler</a>
                            </li>
                            <li>
                                <a href="{{ route('panel.models.timeless') }}">Timeless</a>
                            </li>
                        </ul>
                    </li>
    
                    <li>
                        <a href="{{ route('panel.slider') }}">
                            <i class="mdi mdi-message-image-outline"></i>
                            <span> Slider </span>
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('panel.news') }}">
                            <i class="mdi mdi-newspaper-variant-outline"></i>
                            <span> Bülten </span>
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
                                    2020 &copy; <a href="https://puxo.com.tr/" target='_blank'>Puxo</a>
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
                <h5 class="font-16 m-0 text-white">Tema</h5>
            </div>
            <div class="slimscroll-menu">
        
                <div class="p-4">
                    <div class="mb-2">
                        <img src="/admin/assets/images/layouts/light.png" class="img-fluid img-thumbnail" alt="">
                    </div>
                    <div class="custom-control custom-switch mb-3">
                        <input type="checkbox" class="custom-control-input theme-choice" id="light-mode-switch" checked />
                        <label class="custom-control-label" for="light-mode-switch">Light</label>
                    </div>
            
                    <div class="mb-2">
                        <img src="/admin/assets/images/layouts/dark.png" class="img-fluid img-thumbnail" alt="">
                    </div>
                    <div class="custom-control custom-switch mb-3">
                        <input type="checkbox" class="custom-control-input theme-choice" id="dark-mode-switch" data-bsStyle="/admin/assets/css/bootstrap-dark.min.css" 
                            data-appStyle="/admin/assets/css/app-dark.min.css" />
                        <label class="custom-control-label" for="dark-mode-switch">Dark</label>
                    </div>
                </div>
            </div> <!-- end slimscroll-menu-->
        </div>
        <!-- /Right-bar -->

        <!-- Right bar overlay-->
        <div class="rightbar-overlay"></div>

        <a href="javascript:void(0);" class="right-bar-toggle demos-show-btn">
            <i class="mdi mdi-settings-outline mdi-spin"></i> &nbsp;Tema
        </a>

        <!-- Vendor js -->
        <script src="/admin/assets/js/vendor.min.js"></script>
        @yield('extrascripts')
        <!-- App js -->
        <script src="/admin/assets/js/app.min.js"></script>
        

    </body>

</html>