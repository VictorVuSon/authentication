@extends('layouts.master')
@section('title')
Manager food
@stop
@section('content')
<section class="content-header">
    <h1>Manager food
        <small>List foods</small>
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
                    {!! Form::open(['url' => '/delete-food', 'method' => 'post', 'role' => 'form']) !!}
                    <table id="example2" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Image</th>
                                <th>Category</th>
                                <th>
                                    {!! Form::submit('DELETE', 
                                    array('class'=>'btn btn-secondary')) !!}<br>
                                    {{Form::checkbox('check-all', 'checkall',false, array('id' => 'checkAll'))}}
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($foods as $food)
                            <tr>
                                <td><a href = "edit-food/{{$food->id}}">F - {{$food->id}}</a></td>
                                <td>{{$food->name}}</td>
                                <td><img src = "{{URL::to('/uploads/'.$food->image)}}" style="width:150px;border-radius: 50%"  /></td>
                                <td>{{$food->category_id}}</td>
                                <td>
                                    {{Form::checkbox('check-item[]', $food->id,false, array('class' => 'itemCheck','id'=>$food->id))}}
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
                {"orderable": false, "targets": 3}
            ],
            "info": true,
            "autoWidth": false
        });
    });
</script>
@stop