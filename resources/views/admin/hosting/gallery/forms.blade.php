@extends('layouts.panel',['pageName' => 'Models'])

@section('extrastyles')

@endsection

@section('extrascripts')
<script src="/admin/assets/libs/bootstrap-filestyle2/bootstrap-filestyle.min.js"></script>
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
                        <h4 class="header-title mb-3">{{$title}}</h4>
                        
                    </div>
                </div>
            </div>
            <!-- end row -->

            <div class="row">
                <div class="col-lg-12">
                    <form class="form-horizontal" method='post' action='{{ route('panel.news.gallery.store', @$news->id) }}' enctype="multipart/form-data">
                    <input type="hidden" name="id" value="{{ @$news->id }}">
                    @csrf
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">Görsel</label>
                            <div class="col-md-10">
                            <input name="image" type="file" class="filestyle" data-btnClass="btn-primary">
                            </div>
                        </div>
                        
                        <div class="form-group text-right mb-0">
                            <button class="btn btn-primary waves-effect waves-light mr-1" type="submit">
                                Gönder
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
