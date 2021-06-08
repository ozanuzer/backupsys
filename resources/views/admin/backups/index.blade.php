@extends('layouts.panel',['pageName' => 'Backups'])

@section('extrastyles')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('extrascripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    function saveDatabase(){
        //console.log(document.getElementById('testmode').checked);
        $.ajax({
            url: "{{route('panel.backups.storedb', @$hosting->id)}}",
            type: "POST",
            data:  {dbusername: $('#dbusername').val(), dbpass: $('#dbpass').val(), dbname: $('#dbname').val() },
            success: function (data, textStatus, jqXHR) {
                if(data.success){
                Swal.fire(
                    'Success!',
                    'Database Added!',
                    'success'
                    ).then(function (){
                        //location.reload();
                        $( "#databaseTable" ).html(function() {
                            var thtml = '';
                            $.each(data.databases, function(i, item) {
                                thtml += '<tr>';
                                thtml += '<th scope="row">'+data.databases[i].id+'</th>';
                                thtml += '<td>'+data.databases[i].username+'</td>';
                                thtml += '<td>'+data.databases[i].password+'</td>';
                                thtml += '<td>'+data.databases[i].dbname+'</td>';
                                thtml += '<td><a href="#" type="button" class="btn btn-secondary dbtalbe_button" onclick="deleteDatabase('+data.databases[i].id+');" >Delete</a></td>';
                                thtml += '</tr>';
                            });
                            return thtml;
                        });
                    });
                }else{
                    Swal.fire(
                    'Error!',
                    'System Error!',
                    'error'
                    ).then(function (){
                        location.reload();
                    });
                }
            },error: function(jqXHR, textStatus, errorThrown) {
            }
        });
    }

    function deleteDatabase(id){
        //console.log(document.getElementById('testmode').checked);
        var r = confirm('Do you confirm delete?');
        if (r == true) {
            $.ajax({
                url: "/panel/backups/deletedb/"+id,
                type: "POST",
                data:  { hid: {{@$hosting->id}} },
                success: function (data, textStatus, jqXHR) {
                    if(data.success){
                    Swal.fire(
                        'Success!',
                        'Database Deleted!',
                        'success'
                        ).then(function (){
                            //location.reload();
                            $( "#databaseTable" ).html(function() {
                                var thtml = '';
                                $.each(data.databases, function(i, item) {
                                    thtml += '<tr>';
                                    thtml += '<th scope="row">'+data.databases[i].id+'</th>';
                                    thtml += '<td>'+data.databases[i].username+'</td>';
                                    thtml += '<td>'+data.databases[i].password+'</td>';
                                    thtml += '<td>'+data.databases[i].dbname+'</td>';
                                    thtml += '<td><a href="#" type="button" class="btn btn-secondary dbtalbe_button" onclick="deleteDatabase('+data.databases[i].id+');" >Delete</a></td>';
                                    thtml += '</tr>';
                                });
                                return thtml;
                            });
                        });
                    }else{
                        Swal.fire(
                        'Error!',
                        'System Error!',
                        'error'
                        ).then(function (){
                            location.reload();
                        });
                    }
                },error: function(jqXHR, textStatus, errorThrown) {
                }
            });
        }
    }

</script>
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
                                        <a href="#databases" data-toggle="tab" aria-expanded="true" class="nav-link">
                                            <span class="d-block d-sm-none"><i class="mdi mdi-home-variant-outline font-18"></i></span>
                                            <span class="d-none d-sm-block">Databases</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#schedules" data-toggle="tab" aria-expanded="false" class="nav-link active">
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
                                    <div class="tab-pane" id="databases">
                                        <div class="table-responsive">
                                            <table class="table table-striped m-0">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Username</th>
                                                        <th>Password</th>
                                                        <th>DB Name</th>
                                                        <th>Process</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="databaseTable">
                                                @foreach ($databases as $db)
                                                    <tr>
                                                        <th scope="row">{{ $db->id }}</th>
                                                        <td>{{ $db->username }}</td>
                                                        <td>{{ $db->password }}</td>
                                                        <td>{{ $db->dbname }}</td>
                                                        <td><a href="#" type="button" class="btn btn-secondary dbtalbe_button" onclick="deleteDatabase({{ $db->id }});" >Delete</a></td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="form-group row" style="margin-top:25px;">
                                            <div class="col-md-6">
                                                <input id="dbusername" type="text" class="form-control" placeholder="Username..." value="">
                                            </div>
                                            <div class="col-md-6">
                                                <input id="dbpass" type="text" class="form-control" placeholder="Password..." value="">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-md-6">
                                                <input id="dbname" type="text" class="form-control" placeholder="Database Name..." value="">
                                            </div>
                                            <div class="col-md-6 form-group text-right mb-0">
                                                <button class="btn btn-primary waves-effect waves-light mr-1" type="submit" onclick="saveDatabase()">
                                                    Send
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane show active" id="schedules">
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