@extends('layouts.master')
@section('title')
Manager users
@stop
@section('content')
<section class="content-header">
    <h1>Manager users
        <small>List users</small>
    </h1>
</section>
<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Hover Data Table</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    {!! Form::open(['url' => '/delete-user', 'method' => 'post', 'role' => 'form']) !!}
                    <table id="example2" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Email</th>
                                <th>Name</th>
                                <th>Role</th>
                                <th>
                                    {!! Form::submit('DELETE', 
                                    array('class'=>'btn btn-secondary')) !!}<br>
                                    {{Form::checkbox('check-all', 'checkall',false, array('id' => 'checkAll'))}}
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                            <tr>
                                <td><a href = "edit-user/{{$user->id}}">U - {{$user->id}}</a></td>
                                <td>{{$user->email}}</td>
                                <td>{{$user->name}}</td>
                                <td>
                                    @if($user->is_admin)
                                    Admin
                                    @else
                                    User
                                    @endif
                                </td>
                                <td>
                                    @if($user->is_admin == 0)
                                    {{Form::checkbox('check-item[]', $user->id,false, array('class' => 'itemCheck','id'=>$user->id))}}
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {!! Form::close() !!}
                </div>
                <!-- /.box-body -->
            </div>
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->

</section>
<!-- /.content -->
@stop
@section('table_js')
<script>
    $(function () {
        $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "columnDefs": [
                {"orderable": false, "targets": 3},
                {"orderable": false, "targets": 4}
            ],
            "info": true,
            "autoWidth": false
        });
    });
</script>
@stop