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
                        <h4 class="header-title mb-3">New Hosting</h4>
                        
                    </div>
                </div>
            </div>
            <!-- end row -->

            <div class="row">
                <div class="col-lg-12">
                    @if (empty($hosting))
                    <form class="form-horizontal" method='post' action='{{ route('panel.hosting.store') }}'>
                    @else
                    <form class="form-horizontal" method='post' action='{{ route('panel.hosting.update', $hosting->id) }}'>
                    @endif
                    @csrf
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">Name</label>
                            <div class="col-md-10">
                                <input name="name" type="text" class="form-control" placeholder="Name..." value="{{ @$hosting->name }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">Files Path</label>
                            <div class="col-md-10">
                                <input name="path" type="text" class="form-control" placeholder="Hosting files path..." value="{{ @$hosting->path }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">Database Path</label>
                            <div class="col-md-10">
                                <input name="dbpath" type="text" class="form-control" placeholder="Hosting database path..." value="{{ @$hosting->dbpath }}">
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
