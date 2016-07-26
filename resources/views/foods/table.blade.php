<table class="table table-responsive" id="foods-table">
    <thead>
    <th>Name
        <input type="text" name="search" placeholder="Name..." value = "<?php echo (isset($_GET['name']) ? $_GET['name'] : null); ?>" id='myInp'>
    </th>
    <th>Image</th>
    <th>Category:
        {!! Form::select('category_id',$categories,isset($_GET['cat']) ? $_GET['cat']:null   , ['class' => 'form-control id_cat','id'=>'sel1']) !!}
    </th>
    <th>Author
    </th>
    <th>Content</th>
    <th>{!!Form::button('Search',['class'=>'btn-default search-btn','onclick'=>'search()'])!!}</th>
</thead>

<script>
    $('.id_cat').change(function () {
        var name = $('#myInp').val();
        $(this).find(":selected").each(function () {
//                console.log($(this).val());
            window.location.replace("foods?name=" + name + "&&cat=" + $(this).val());
        });
    });
    function search() {
        var name = $('#myInp').val();
        var id_cat = $('.id_cat').val();
        window.location.replace("foods?name=" + name + "&&cat=" + id_cat);
    }
</script>
<tbody>
    @foreach($foods as $food)
    @if(Auth::user()->id == $food->author)
    <tr>
        <td>{!! $food->name !!}</td>
        <td><img src ="{{url('/uploads/'.$food->image)}}" id ="" class ="img-small" /></td>
        <td>{{$food -> category->name}}</td>
        <td>{{$food->user->name}}</td>
        <td>{!! $food->content !!}</td>
        <td>
            {!! Form::open(['route' => ['foods.destroy', $food->id], 'method' => 'delete']) !!}
            <div class='btn-group'>
                <a href="{!! route('foods.show', [$food->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                <a href="{!! route('foods.edit', [$food->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
            </div>
            {!! Form::close() !!}
        </td>
    </tr>
    @endif
    @endforeach
</tbody>
</table>
