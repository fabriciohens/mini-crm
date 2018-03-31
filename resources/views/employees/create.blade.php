@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
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
            <h2>{{ __('messages.create_new_employee') }}</h2>
            {!! Form::open(['id' => 'dataForm', 'url' => '/employees']) !!}
                <div class="form-group">
                    {!! Form::label('first_name', __('messages.first_name')) !!}
                    {!! Form::text('first_name', null, ['class' => 'form-control']) !!}                            
                </div>
                <div class="form-group">
                    {!! Form::label('last_name', __('messages.last_name')) !!}
                    {!! Form::text('last_name', null, ['class' => 'form-control']) !!}                            
                </div>
                <div class="form-group">
                    {!! Form::label('company_id', __('messages.company')) !!}
                    {!! Form::select('company_id', $companies, null, ['class' => 'form-control']); !!}
                </div>
                <div class="form-group">
                    {!! Form::label('email', __('messages.email')) !!}
                    {!! Form::text('email', null, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('phone', __('messages.phone')) !!}
                    <div class="row">
                        <div class="col-md-4">
                            {!! Form::select('phone_country', Country::all(), null, ['class' => 'form-control']); !!}
                        </div>
                        <div class="col-md-8">
                            {!! Form::text('phone', null, ['class' => 'form-control']) !!}
                        </div>
                    </div>
                </div>
                {!! Form::submit(__('messages.create'), ['class' => 'btn btn-primary pull-right']) !!}
            {!! Form::close() !!} 
        </div>
    </div>    
</div>
@endsection