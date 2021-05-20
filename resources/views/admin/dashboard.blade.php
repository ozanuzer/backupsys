@extends('layouts.panel',['pageName' => 'Dashboard'])


@section('extrascripts')
<script src="admin/assets/libs/morris-js/morris.min.js"></script>
<script src="admin/assets/libs/raphael/raphael.min.js"></script>

<script src="admin/assets/js/pages/dashboard.init.js"></script>
@endsection

@section('content')
<!-- ============================================================== -->
            <!-- Start Page Content here -->
            <!-- ============================================================== -->

            <div class="content-page">
                <div class="content">

                    <!-- Start container-fluid -->
                    <div class="container-fluid">

                        <div class="row">
                            <div class="col-12">
                                <div>
                                    <h4 class="header-title mb-3">Panel</h4>
                                </div>
                            </div>
                        </div>
                        <!-- end row -->

                        <div class="row">
                            <div class="col-12">
                                <div>
                                    <div class="card-box widget-inline">
                                        <div class="row">
                                            <div class="col-xl-6 col-sm-6 widget-inline-box">
                                                <div class="text-center p-3">
                                                    <h2 class="mt-2"><i class="text-primary mdi mdi-account-multiple-outline mr-2"></i> <b></b></h2>
                                                    <p class="text-muted mb-0">Model</p>
                                                </div>
                                            </div>

                                            <div class="col-xl-6 col-sm-6 widget-inline-box">
                                                <div class="text-center p-3">
                                                    <h2 class="mt-2"><i class="text-primary mdi mdi-newspaper-variant-outline mr-2"></i> <b></b></h2>
                                                    <p class="text-muted mb-0">Bülten</p>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--end row -->

                      

                    </div>
                    <!-- end container-fluid -->
@endsection
