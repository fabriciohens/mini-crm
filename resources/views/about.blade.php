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
            <h2>{{ __('messages.about') }}</h2>
            <h3>Mini-CRM</h3>
            <p>{{ __('messages.about_description') }}</p>
            <p>{{ __('messages.developed_with') }} <a href="http://www.php.net/">PHP</a> {{ __('messages.and') }} <a href="https://laravel.com/">Laravel</a>.</p>
        </div>
    </div>
</div>
@endsection