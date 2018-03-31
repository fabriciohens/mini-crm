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
        <h2>
        {{ __('messages.welcome') }}
        </h2>
        <p>{{ __('messages.welcome_description') }}</p>
        </div>
    </div>
</div>
@endsection
