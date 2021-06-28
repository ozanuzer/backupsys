@extends('layouts.panel',['pageName' => 'Backups'])


@section('extrascripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script>
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


    function saveSchedule(){
        //console.log(document.getElementById('testmode').checked);
        $.ajax({
            url: "{{route('panel.backups.storesch', @$hosting->id)}}",
            type: "POST",
            data:  {period: $('#formperiod').val(), remoteid: $('#formremoteid').val(), formfiles: document.getElementById("formfiles").checked, formdatabases: document.getElementById("formdatabases").checked },
            success: function (data, textStatus, jqXHR) {
                if(data.success){
                Swal.fire(
                    'Success!',
                    'Schedule Added!',
                    'success'
                    ).then(function (){
                        //location.reload();
                        $( "#scheduleTable" ).html(function() {
                            var thtml = '';
                            $.each(data.schedule, function(i, item) {
                                thtml += '<tr>';
                                thtml += '<th scope="row">'+data.schedule[i].id+'</th>';
                                thtml += '<td>'+data.schedule[i].periodName+'</td>';
                                thtml += '<td>'+data.schedule[i].remoteName+'</td>';
                                thtml += '<td>'+data.schedule[i].backupItemsName+'</td>';
                                thtml += '<td><a href="#" type="button" class="btn btn-secondary dbtalbe_button" onclick="deleteSchedule('+data.schedule[i].id+');" >Delete</a></td>';
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

    function deleteSchedule(id){
        //console.log(document.getElementById('testmode').checked);
        var r = confirm('Do you confirm delete?');
        if (r == true) {
            $.ajax({
                url: "/panel/backups/deletesch/"+id,
                type: "POST",
                data:  { hid: {{@$hosting->id}} },
                success: function (data, textStatus, jqXHR) {
                    if(data.success){
                    Swal.fire(
                        'Success!',
                        'Schedule Deleted!',
                        'success'
                        ).then(function (){
                            //location.reload();
                            $( "#scheduleTable" ).html(function() {
                                var thtml = '';
                                $.each(data.schedule, function(i, item) {
                                    thtml += '<tr>';
                                    thtml += '<th scope="row">'+data.schedule[i].id+'</th>';
                                    thtml += '<td>'+data.schedule[i].periodName+'</td>';
                                    thtml += '<td>'+data.schedule[i].remoteName+'</td>';
                                    thtml += '<td>'+data.schedule[i].backupItemsName+'</td>';
                                    thtml += '<td><a href="#" type="button" class="btn btn-secondary dbtalbe_button" onclick="deleteSchedule('+data.schedule[i].id+');" >Delete</a></td>';
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
                                                        <!--<th>Username</th>
                                                        <th>Password</th>-->
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
                                            <!--<div class="col-md-6">
                                                <input id="dbusername" type="text" class="form-control" placeholder="Username..." value="">
                                            </div>
                                            <div class="col-md-6">
                                                <input id="dbpass" type="text" class="form-control" placeholder="Password..." value="">
                                            </div>-->
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
                                    <div class="table-responsive">
                                            <table class="table table-striped m-0">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Period</th>
                                                        <th>Remote Name</th>
                                                        <th>Items</th>
                                                        <th>Process</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="scheduleTable">
                                                @foreach ($schedule as $item)
                                                    <tr>
                                                        <th scope="row">{{ $item->id }}</th>
                                                        <td>{{ $item->periodName }}</td>
                                                        <td>{{ $item->remoteName }}</td>
                                                        <td>{{ $item->backupItemsName }}</td>
                                                        <td><a href="#" type="button" class="btn btn-secondary dbtalbe_button" onclick="deleteSchedule({{ $item->id }});" >Delete</a></td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="form-group row" style="margin-top:25px;">
                                        <div class="col-md-6">
                                            <select class="form-control" id="formperiod" >
                                                <option selected="true" disabled="disabled">Period</option>
                                                <option value="0">Daily</option>
                                                <option value="1">Weekly</option>
                                                <option value="2">Monthly</option>
                                            </select>
                                        </div>
                                            <div class="col-md-6">
                                            <select class="form-control" id="formremoteid" >
                                                <option selected="true" disabled="disabled">Remote Settings</option>
                                            @foreach ($remotesettings as $item)
                                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                            @endforeach
                                            </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                        <label class="col-md-2 col-form-label">Backup Items</label>
                                            <div class="col-md-6">
                                                <div class="checkbox checkbox-primary">
                                                    <input id="formfiles" type="checkbox" checked>
                                                    <label for="formfiles">
                                                        Files
                                                    </label>
                                                </div>
                                                <div class="checkbox checkbox-primary">
                                                    <input id="formdatabases" type="checkbox" checked>
                                                    <label for="formdatabases">
                                                        Databases
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-md-4 form-group text-right mb-0">
                                                <button class="btn btn-primary waves-effect waves-light mr-1" type="submit" onclick="saveSchedule()">
                                                    Send
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="logs">
                                    <div class="table-responsive">
                                            <table class="table table-striped m-0">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Backup Date</th>
                                                        <th>Status</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="logsTable">
                                                @foreach ($logs as $log)
                                                    <tr>
                                                        <th scope="row">{{ $log->id }}</th>
                                                        <td>{{ $log->backupDate }}</td>
                                                        <td>{{ $log->status }}</td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    </div>
                    <!-- end container-fluid -->
@endsection