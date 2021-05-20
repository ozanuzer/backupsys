@extends('layouts.panel',['pageName' => 'Models'])

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
                        <h4 class="header-title mb-3"> 
                            @if (empty($news))
                            Bülten
                            @else
                            <div class="btn-group">
                                <a href="{{ route('panel.news.gallery', @$news->id) }}" type="button" class="btn btn-secondary dbtalbe_button">Görseller</a>
                            </div>
                            @endif
                        </h4>
                        
                    </div>
                </div>
            </div>
            <!-- end row -->

            <div class="row">
                <div class="col-lg-12">
                    @if (empty($news))
                    <form class="form-horizontal" method='post' action='{{ route('panel.news.store') }}'>
                    @else
                    <form class="form-horizontal" method='post' action='{{ route('panel.news.update', $news->id) }}'>
                    @endif
                    @csrf
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">Başlık</label>
                            <div class="col-md-10">
                                <input name="subject" type="text" class="form-control" placeholder="Name..." value="{{ @$news->subject }}">
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
