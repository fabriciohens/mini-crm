@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
        <h2>{{ __('messages.employee') }}</h2>
            {!! Form::open() !!}
                <div class="form-group">
                    {!! Form::label('first_name', __('messages.first_name')) !!}
                    {!! Form::text('first_name', $employee->first_name, ['class' => 'form-control', 'disabled']) !!}                            
                </div>
                <div class="form-group">
                    {!! Form::label('last_name', __('messages.last_name')) !!}
                    {!! Form::text('last_name', $employee->last_name, ['class' => 'form-control', 'disabled']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('company_id', __('messages.company')) !!}
                    {!! Form::select('company_id', $companies, $employee->company_id, ['class' => 'form-control', 'disabled']); !!}
                </div>
                <div class="form-group">
                    {!! Form::label('email', __('messages.email')) !!}
                    {!! Form::text('email', $employee->email, ['class' => 'form-control', 'disabled']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('phone', __('messages.phone')) !!}
                    <div class="row">
                        <div class="col-md-4">
                            {!! Form::select('phone_country', Country::all(), $employee->phone_country, ['class' => 'form-control', 'disabled']); !!}
                        </div>
                        <div class="col-md-8">
                            {!! Form::text('phone', $employee->phone, ['class' => 'form-control', 'disabled']) !!}
                        </div>
                    </div>
                </div>
            {!! Form::close() !!}
        </div>
    </div>    
</div>
@endsection