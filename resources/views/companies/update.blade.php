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
            <h2>{{ __('messages.update_company') }}</h2>
            {!! Form::open(['id' => 'dataForm', 'method' => 'PATCH', 'url' => '/companies/' . $company->id, 'files' => 'true']) !!}
                <div class="form-group">
                    {!! Form::label('name', __('messages.name')) !!}
                    {!! Form::text('name', $company->name, ['class' => 'form-control']) !!}                            
                </div>
                <div class="form-group">
                    {!! Form::label('email', __('messages.email')) !!}
                    {!! Form::text('email', $company->email, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('logo', __('messages.logo')) !!}
                    {!! Form::file('logo') !!}
                </div>
                <div class="form-group">
                    {!! Form::label('website', __('messages.website')) !!}
                    {!! Form::text('website', $company->website, ['class' => 'form-control']) !!}
                </div>
                {!! Form::submit(__('messages.update'), ['class' => 'btn btn-primary pull-right']) !!}
            {!! Form::close() !!}
        </div>
    </div>    
</div>
@endsection