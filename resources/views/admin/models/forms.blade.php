@extends('layouts.panel',['pageName' => 'Models'])

@section('extrastyles')
<link href="/admin/assets/libs/bootstrap-datepicker/bootstrap-datepicker.css" rel="stylesheet">
@endsection

@section('extrascripts')
<script src="/admin/assets/libs/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
<!-- Init js-->
<script>
!(function (o) {
    "use strict";
    var t = function () {};
    (t.prototype.initSwitchery = function () {
        o('[data-plugin="switchery"]').each(function (t, e) {
            new Switchery(o(this)[0], o(this).data());
        });
    }),
        (t.prototype.initDatePicker = function () {
            o("#datepicker").datepicker(),
                o("#datepicker-autoclose").datepicker({ format: "mm/dd/yyyy", autoclose: !0, todayHighlight: !0 }),
                o("#datepicker-autoclose2").datepicker({ format: "mm/dd/yyyy", autoclose: !0, todayHighlight: !0 });
        }),
        (t.prototype.init = function () {
            
                this.initDatePicker();
        }),
        (o.Components = new t()),
        (o.Components.Constructor = t);
})(window.jQuery),
    (function (t) {
        "use strict";
        window.jQuery.Components.init();
    })();

</script>
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
                            @if (empty($models))
                            <a href="{{ route(@$type) }}">Model</a>
                            @else
                                @if (!empty($type))
                                    <a href="{{ route(@$type) }}">Model</a> -> {{$models->name.' '.$models->surname}} | 
                                @else
                                    Model -> {{$models->name.' '.$models->surname}} | 
                                @endif
                            <div class="btn-group">
                                <a href="{{ route('models.gallery', @$models->id) }}" type="button" class="btn btn-secondary dbtalbe_button">Görseller</a>
                                <a href="{{ route('models.poloraid', @$models->id) }}" type="button" class="btn btn-secondary dbtalbe_button">Poloraid</a>
                                <a href="{{ route('models.sedcard', @$models->id) }}" type="button" class="btn btn-secondary dbtalbe_button">Sedcard</a>
                            </div>
                            @endif
                        </h4>
                        
                    </div>
                </div>
            </div>
            <!-- end row -->

            <div class="row">
                <div class="col-lg-12">
                    @if (empty($models))
                    <form class="form-horizontal" method='post' action='{{ route('panel.models.store') }}'>
                    @else
                    <form class="form-horizontal" method='post' action='{{ route('panel.models.update', $models->id) }}'>
                    @endif
                    @csrf
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">Ad</label>
                            <div class="col-md-10">
                                <input name="name" type="text" class="form-control" placeholder="Ad..." value="{{ @$models->name }}" required="required">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">Soyad</label>
                            <div class="col-md-10">
                                <input name="surname" type="text" class="form-control" placeholder="Soyad..." value="{{ @$models->surname }}" required="required">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">Doğum Yılı</label>
                            <div class="col-md-10">
                                <input name="birth_year" type="text" class="form-control" placeholder="Doğum Yılı..." value="{{ @$models->birth_year }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">Saç</label>
                            <div class="col-md-10">
                                <input name="hair_tr" type="text" class="form-control" placeholder="Türkçe..." value="{{ @$models->hair_tr }}" required="required"><br>
                                <input name="hair" type="text" class="form-control" placeholder="İngilizce..." value="{{ @$models->hair }}" required="required">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">Cinsiyet</label>
                            <div class="col-md-10" style="margin-top: 10px;">
                                <div class="radio radio-info form-check-inline">
                                    <input type="radio" id="erkek" value="1" name="gender" {{ @$models->gender === 1 ? "checked" : "" }}>
                                    <label for="erkek"> Erkek </label>
                                </div>
                                <div class="radio radio-info form-check-inline">
                                    <input type="radio" id="kadin" value="2" name="gender" {{ @$models->gender === 2 ? "checked" : "" }} {{ empty($models->gender) ? "checked" : "" }}>
                                    <label for="kadin"> Kadın </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">Şehirdekiler</label>
                            <div class="col-md-10" style="margin-top: 10px;">
                                <div class="radio radio-info form-check-inline">
                                    <input type="radio" id="yesintown" value="1" name="intown" {{ @$models->type === 1 ? "checked" : "" }}>
                                    <label for="yesintown"> Evet </label>
                                </div>
                                <div class="radio radio-info form-check-inline">
                                    <input type="radio" id="nointown" value="2" name="intown" {{ @$models->type === 2 ? "checked" : "" }} {{ empty($models->type) ? "checked" : "" }}>
                                    <label for="nointown"> Hayır </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">Timeless</label>
                            <div class="col-md-10" style="margin-top: 10px;">
                                <div class="radio radio-info form-check-inline">
                                    <input type="radio" id="yestimeless" value="1" name="timeless" {{ @$models->timeless === 1 ? "checked" : "" }}>
                                    <label for="yestimeless"> Evet </label>
                                </div>
                                <div class="radio radio-info form-check-inline">
                                    <input type="radio" id="notimeless" value="0" name="timeless" {{ @$models->timeless === 0 ? "checked" : "" }} {{ empty($models->timeless) ? "checked" : "" }}>
                                    <label for="notimeless"> Hayır </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">Boy</label>
                            <div class="col-md-10">
                                <input name="height" type="text" class="form-control" placeholder="Boy..." value="{{ @$models->height }}" required="required">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">Vücut Ölçüleri</label>
                            <div class="col-md-10">
                                <input name="body_size" type="text" class="form-control" placeholder="Vücut Ölçüleri..." value="{{ @$models->body_size }}" required="required">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">Beden</label>
                            <div class="col-md-10">
                                <input name="size" type="text" class="form-control" placeholder="Beden..." value="{{ @$models->size }}" required="required">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">Ayak</label>
                            <div class="col-md-10">
                                <input name="shoes" type="text" class="form-control" placeholder="Ayak Numarası..." value="{{ @$models->shoes }}" required="required">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">Göz Rengi</label>
                            <div class="col-md-10">
                                <input name="eyes_tr" type="text" class="form-control" placeholder="Türkçe..." value="{{ @$models->eyes_tr }}" required="required"><br>
                                <input name="eyes" type="text" class="form-control" placeholder="İngilizce..." value="{{ @$models->eyes }}" required="required">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">Varış Zamanı</label>
                            <div class="col-md-10">
                                <div>
                                    <div class="input-group">
                                        @if(empty(@$models->arrival))
                                        <input name='arrival' type="text" class="form-control" placeholder="mm/dd/yyyy" id="datepicker-autoclose" >
                                        @else
                                        <input name='arrival' type="text" class="form-control" placeholder="mm/dd/yyyy" id="datepicker-autoclose" value="{{ date('m/d/Y', strtotime(@$models->arrival)) }}">
                                        @endif
                                        <div class="input-group-append">
                                            <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                        </div>
                                    </div>
                                    <!-- input-group -->
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">Ayrılış Zamanı</label>
                            <div class="col-md-10">
                                <div>
                                    <div class="input-group">
                                        @if(empty(@$models->arrival))
                                        <input name='departure' type="text" class="form-control" placeholder="mm/dd/yyyy" id="datepicker-autoclose2">
                                        @else
                                        <input name='departure' type="text" class="form-control" placeholder="mm/dd/yyyy" id="datepicker-autoclose2" value="{{ date('m/d/Y', strtotime(@$models->departure)) }}">
                                        @endif
                                        <div class="input-group-append">
                                            <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                        </div>
                                    </div>
                                    <!-- input-group -->
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">Video (Vimeo ID)</label>
                            <div class="col-md-10">
                                <input name="video_url" type="text" class="form-control" placeholder="Vimeo ID..." value="{{ @$models->video_url }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">Instagram Url</label>
                            <div class="col-md-10">
                                <input name="instagram" type="text" class="form-control" placeholder="Instagram link..." value="{{ @$models->instagram }}">
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
