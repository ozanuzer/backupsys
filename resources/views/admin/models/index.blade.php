@extends('layouts.panel',['pageName' => 'Models'])

@section('extrastyles')
    <link href="/admin/assets/libs/datatables/dataTables.bootstrap4.css" rel="stylesheet" type="text/css" />
    <link href="/admin/assets/libs/datatables/buttons.bootstrap4.css" rel="stylesheet" type="text/css" />
    <link href="/admin/assets/libs/datatables/responsive.bootstrap4.css" rel="stylesheet" type="text/css" />
    <link href="/admin/assets/libs/datatables/select.bootstrap4.css" rel="stylesheet" type="text/css" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('extrascripts')
    <!-- Required datatable js -->
    <script src="/admin/assets/libs/datatables/jquery.dataTables.min.js"></script>
    <script src="/admin/assets/libs/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Buttons examples -->
    <script src="/admin/assets/libs/datatables/dataTables.buttons.min.js"></script>
    <script src="/admin/assets/libs/datatables/buttons.bootstrap4.min.js"></script>
    <script src="/admin/assets/libs/datatables/dataTables.keyTable.min.js"></script>
    <script src="/admin/assets/libs/datatables/dataTables.select.min.js"></script>
    <script src="/admin/assets/libs/jszip/jszip.min.js"></script>
    <script src="/admin/assets/libs/pdfmake/pdfmake.min.js"></script>
    <script src="/admin/assets/libs/pdfmake/vfs_fonts.js"></script>
    <script src="/admin/assets/libs/datatables/buttons.html5.min.js"></script>
    <script src="/admin/assets/libs/datatables/buttons.print.min.js"></script>

    <!-- Responsive examples -->
    <script src="/admin/assets/libs/datatables/dataTables.responsive.min.js"></script>
    <script src="/admin/assets/libs/datatables/responsive.bootstrap4.min.js"></script>

    <!-- Datatables init -->
    <script>
        $(document).ready(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $("#datatable").DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{route('panel.models.ajaxget', @$type)}}",
                    type: "POST"
                },
                columns: [
                    { data: '{{@$sortPrefix}}' },
                    { data: 'name' },
                    { data: 'surname' },
                    { data: 'height' },
                    { data: 'size' },
                    { data: 'hair_tr' },
                    { data: 'eyes_tr' },
                    { data: 'status' },
                    { data: 'actions' },
                ]
            });
        });
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
                                    <h4 class="header-title mb-3">{{$title}} <a href='{{ route('panel.models.create', @$type) }}' type="button" class="btn btn-success new_button" >Yeni Model</a></h4>
                                </div>
                            </div>
                        </div>
                        <!-- end row -->

                        <div class="row">
                            <div class="col-12">
                                <div>

                                    <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                        <thead>
                                            <tr>
                                                <th>Sıra</th>
                                                <th>Ad</th>
                                                <th>Soyad</th>
                                                <th>Boy</th>
                                                <th>Beden</th>
                                                <th>Saç Rengi</th>
                                                <th>Göz Rengi</th>
                                                <th>Aktif/Pasif</th>
                                                <th>Aksiyonlar</th>
                                            </tr>
                                        </thead>
                                    </table>

                                </div>
                            </div>
                        </div>
                        <!-- end row -->

                    </div>
                    <!-- end container-fluid -->
@endsection