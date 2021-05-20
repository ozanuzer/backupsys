<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8" />
        <title>Login Page | Simple - Responsive Bootstrap 4 Admin Dashboard</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Responsive bootstrap 4 admin template" name="description" />
        <meta content="Coderthemes" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="admin/assets/images/favicon.ico">
        <!-- App css -->
        <link href="admin/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" id="bootstrap-stylesheet" />
        <link href="admin/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
        <link href="admin/assets/css/app.min.css" rel="stylesheet" type="text/css" id="app-stylesheet" />

    </head>

    <body>
        <div class="account-pages my-5 pt-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="text-center mb-4 mt-3">
                                    <a href="index.html">
                                        <span><img src="assets/images/logo-dark.png" alt="" height="30"></span>
                                    </a>

                                </div>
                                <form action="{{ route('login') }}" class="p-2" method="post">
                                @csrf
                                    <div class="form-group">
                                        <label for="name">Kullanıcı Adı</label>
                                        <input class="form-control" type="text" name="name" id="name" required="" placeholder="kullanıcı adı">
                                    </div>
                                    <div class="form-group">
                                        <label for="password">Şifre</label>
                                        <input class="form-control" type="password" name="password" required="" id="password" placeholder="Şifre">
                                    </div>

                                    <div class="form-group mb-4 pb-3">
                                        <div class="custom-control custom-checkbox checkbox-primary">
                                            <input type="checkbox" class="custom-control-input" id="checkbox-signin" name="remember_me">
                                            <label class="custom-control-label" for="checkbox-signin">Beni Hatırla</label>
                                        </div>
                                    </div>
                                    <div class="mb-3 text-center">
                                        <button class="btn btn-primary btn-block" type="submit"> Sign In </button>
                                    </div>
                                </form>
                            </div>
                            <!-- end card-body -->
                        </div>
                        <!-- end card -->
                    </div>
                    <!-- end col -->
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </div>
        <!-- end page -->

        <!-- Vendor js -->
        <script src="admin/assets/js/vendor.min.js"></script>

        <!-- App js -->
        <script src="admin/assets/js/app.min.js"></script>

    </body>

</html>