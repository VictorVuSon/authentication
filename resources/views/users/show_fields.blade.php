<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{!! $user->id !!}</p>
</div>

<!-- Email Field -->
<div class="form-group">
    {!! Form::label('email', 'Email:') !!}
    <p>{!! $user->email !!}</p>
</div>


<!-- Name Field -->
<div class="form-group">
    {!! Form::label('name', 'Name:') !!}
    <p>{!! $user->name !!}</p>
</div>

<!-- Avatar Field -->
<div class="form-group">
    {!! Form::label('avatar', 'Avatar:') !!}
    <p>{!! $user->avatar !!}</p>
</div>

<!-- Is Admin Field -->
<div class="form-group">
    {!! Form::label('is_admin', 'Is Admin:') !!}
    @if($user->is_admin == 1)
    <p>Admin</p>
    @else
    <p>User</p>
    @endif
</div>


