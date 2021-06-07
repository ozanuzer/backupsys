@extends('layouts.panel',['pageName' => 'Hosting'])

@section('extrastyles')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('extrascripts')
@endsection

@section('content')
<div class="content-page">
                <div class="content">
                    <!-- Start container-fluid -->
                    <div class="container-fluid">

                    <div class="col-xl-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="header-title mb-4">{{ $hosting->name }}</h4>
                                <ul class="nav nav-pills navtab-bg nav-justified">
                                    <li class="nav-item">
                                        <a href="#databases" data-toggle="tab" aria-expanded="true" class="nav-link active">
                                            <span class="d-block d-sm-none"><i class="mdi mdi-home-variant-outline font-18"></i></span>
                                            <span class="d-none d-sm-block">Databases</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#schedules" data-toggle="tab" aria-expanded="false" class="nav-link">
                                            <span class="d-block d-sm-none"><i class="mdi mdi-account-outline font-18"></i></span>
                                            <span class="d-none d-sm-block">Schedules</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#logs" data-toggle="tab" aria-expanded="false" class="nav-link">
                                            <span class="d-block d-sm-none"><i class="mdi mdi-email-outline font-18"></i></span>
                                            <span class="d-none d-sm-block">Logs</span>
                                        </a>
                                    </li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane show active" id="databases">
                                        <div class="table-responsive">
                                            <table class="table table-striped m-0">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Username</th>
                                                        <th>Password</th>
                                                        <th>DB Name</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                @foreach ($databases as $db)
                                                    <tr>
                                                        <th scope="row">{{ $db->id }}</th>
                                                        <td>{{ $db->username }}</td>
                                                        <td>{{ $db->password }}</td>
                                                        <td>{{ $db->dbname }}</td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="form-group row" style="margin-top:25px;">
                                            <div class="col-md-6">
                                                <input name="name" type="text" class="form-control" placeholder="Username..." value="">
                                            </div>
                                            <div class="col-md-6">
                                                <input name="path" type="text" class="form-control" placeholder="Password..." value="">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-md-6">
                                                <input name="dbpath" type="text" class="form-control" placeholder="Database Name..." value="">
                                            </div>
                                            <div class="col-md-6 form-group text-right mb-0">
                                                <button class="btn btn-primary waves-effect waves-light mr-1" type="submit">
                                                    Send
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="schedules">
                                        <p>Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt.Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim.</p>
                                        <p class="mb-0">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim.</p>
                                    </div>
                                    <div class="tab-pane" id="logs">
                                        <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim.</p>
                                        <p class="mb-0">Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt.Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    </div>
                    <!-- end container-fluid -->
@endsection