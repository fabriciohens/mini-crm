@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-11">
            @if ($errors->any())
                <div class="alert alert-warning alert-dismissible">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <h2>{{ __('messages.create_new_company') }}</h2>
            {!! Form::open(['url' => '/companies', 'files' => 'true']) !!}
                <div class="form-group">
                    {!! Form::label('name', __('messages.name')) !!}
                    {!! Form::text('name', null, ['class' => 'form-control']) !!}                            
                </div>
                <div class="form-group">
                    {!! Form::label('email', __('messages.email')) !!}
                    {!! Form::text('email', null, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('logo', __('messages.logo')) !!}
                    {!! Form::file('logo') !!}
                </div>
                <div class="form-group">
                    {!! Form::label('website', __('messages.website')) !!}
                    {!! Form::text('website', null, ['class' => 'form-control']) !!}
                </div>
                {!! Form::submit(__('messages.create'), ['class' => 'btn btn-primary pull-right']) !!}
            {!! Form::close() !!}   
        </div>
    </div>    
</div>
@endsection