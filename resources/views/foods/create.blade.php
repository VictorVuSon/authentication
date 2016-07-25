@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            food
        </h1>
    </section>
    <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">

            <div class="box-body">
                <div class="row">
                    
                    {!! Form::model($pass, ['route' => ['foods.store'],'files'=>true]) !!}

                        @include('foods.fields')

                   {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
