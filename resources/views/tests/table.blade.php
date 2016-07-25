<table class="table table-responsive" id="tests-table">
    <thead>
        <th>Name</th>
        <th>Email</th>
        <th>Other</th>
        <th colspan="3">Action</th>
    </thead>
    <tbody>
    @foreach($tests as $test)
        <tr>
            <td>{!! $test->name !!}</td>
            <td>{!! $test->email !!}</td>
            <td>{!! $test->other !!}</td>
            <td>
                {!! Form::open(['route' => ['tests.destroy', $test->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('tests.show', [$test->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('tests.edit', [$test->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>