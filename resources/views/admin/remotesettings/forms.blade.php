@extends('layouts.panel',['pageName' => 'Hosting'])

@section('extrastyles')
@endsection

@section('extrascripts')
@endsection

@section('content')
<div class="content-page">
    <div class="content">

        <!-- Start container-fluid -->
        <div class="container-fluid">

            <!-- start  -->
            <div class="row">
                <div class="col-12">
                    <div>
                        <h4 class="header-title mb-3">New Remote</h4>
                        
                    </div>
                </div>
            </div>
            <!-- end row -->

            <div class="row">
                <div class="col-lg-12">
                    @if (empty($savedb))
                    <form class="form-horizontal" method='post' action='{{ route('panel.remotesettings.store') }}'>
                    @else
                    <form class="form-horizontal" method='post' action='{{ route('panel.remotesettings.update', $savedb->id) }}'>
                    @endif
                    @csrf
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">Name</label>
                            <div class="col-md-10">
                                <input name="name" type="text" class="form-control" placeholder="Name..." value="{{ @$savedb->name }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">Remote IP/Domain</label>
                            <div class="col-md-10">
                                <input name="remoteip" type="text" class="form-control" placeholder="IP or Domain..." value="{{ @$savedb->remoteip }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">Remote Username</label>
                            <div class="col-md-10">
                                <input name="remotelogin" type="text" class="form-control" placeholder="Username..." value="{{ @$savedb->remotelogin }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">Remote Password</label>
                            <div class="col-md-10">
                                <input name="remotepassword" type="text" class="form-control" placeholder="Password..." value="{{ @$savedb->remotepass }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">Remote Port</label>
                            <div class="col-md-10">
                                <input name="remoteport" type="text" class="form-control" placeholder="Port..." value="{{ @$savedb->remoteport }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">Remote Save Path</label>
                            <div class="col-md-10">
                                <input name="remotepath" type="text" class="form-control" placeholder="Remote files path..." value="{{ @$savedb->remotepath }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">Remote Type</label>
                            <div class="col-md-10">
                                <select class="form-control" name="remotetype" >
                                    <option value="ftp" 
                                    @if (@$savedb->remotetype == 'ftp')
                                    selected='' 
                                    @endif
                                    >FTP</option>
                                    <option value="sftp"
                                    @if (@$savedb->remotetype == 'sftp')
                                    selected='' 
                                    @endif
                                    >SFTP/SSH</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="form-group text-right mb-0">
                            <button class="btn btn-primary waves-effect waves-light mr-1" type="submit">
                                Send
                            </button>
                        </div>
                    </form>
                </div>
                <!-- end -->

            </div>
            <!-- end row -->

    </div>
    <!-- end container-fluid -->

@endsection
