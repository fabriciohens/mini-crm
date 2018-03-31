@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <h2>{{ __('messages.view_company') }}</h2>
            {!! Form::open() !!}                
                <div class="form-group">
                    {!! Form::label('name', __('messages.name')) !!}
                    {!! Form::text('name', $company->name, ['class' => 'form-control', 'disabled']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('email', __('messages.email')) !!}
                    {!! Form::text('email', $company->email, ['class' => 'form-control', 'disabled']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('logo', __('messages.logo')) !!}
                    @if ($company->logo != '')
                        <img src="{{ asset($company->logo) }}" alt="company-logo" width="100" height="100">
                    @else
                        <p>{{ __('messages.no_logo') }}</p>
                    @endif
                </div>      
                <div class="form-group">
                    {!! Form::label('website', __('messages.website')) !!}
                    {!! Form::text('website', $company->website, ['class' => 'form-control', 'disabled']) !!}
                </div>
            {!! Form::close() !!}   
        </div>
    </div>    
</div>
@endsection