@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-11">
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif
            <h2>{{ __('messages.change_localization_to') }}</h2>
            {!! Form::open(['method' => 'POST', 'url' => '/localization/' . 'en', 'style' => 'display: inline-block;' ]) !!}
                {!! Form::submit(__('messages.english'), ['class' => 'btn btn-primary']) !!}
            {!! Form::close() !!}
            {!! Form::open(['method' => 'POST', 'url' => '/localization/' . 'pt', 'style' => 'display: inline-block;']) !!}
                {!! Form::submit(__('messages.portuguese'), ['class' => 'btn btn-primary']) !!}
            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection