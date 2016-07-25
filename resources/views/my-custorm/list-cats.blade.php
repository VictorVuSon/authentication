@extends('layouts.master')
@section('title')
Manager cats
@stop
@section('content')
<section class="content-header">
    <h1>Manager categories
        <small>List categoris</small>
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
                    {!! Form::open(['url' => '/delete-cat', 'method' => 'post', 'role' => 'form']) !!}
                    <table id="example2" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Image</th>
                                <th>
                                    {!! Form::submit('DELETE', 
                                    array('class'=>'btn btn-secondary')) !!}<br>
                                    {{Form::checkbox('check-all', 'checkall',false, array('id' => 'checkAll'))}}
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($cats as $cat)
                            <tr>
                                <td><a href = "edit-cat/{{$cat->id}}">CAT - {{$cat->id}}</a></td>
                                <td>{{$cat->name}}</td>
                                <td><img src = "{{URL::to('/uploads/'.$cat->image)}}" style="width:150px;border-radius: 50%"  /></td>
                                <td>
                                    {{Form::checkbox('check-item[]', $cat->id,false, array('class' => 'itemCheck','id'=>$cat->id))}}
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
                {"orderable": false, "targets": 2}
            ],
            "info": true,
            "autoWidth": false
        });
    });
</script>
@stop