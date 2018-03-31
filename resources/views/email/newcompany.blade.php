<h3>{{ __('messages.hello_email') }}:</h3>
<p><strong>{{ __('messages.name') }}: </strong>{{ $company->name }}</p>
<p><strong>{{ __('messages.email') }}: </strong>{{ $company->email }}</p>
<p><strong>{{ __('messages.website') }}: </strong><a href="{{ $company->website }}">{{ $company->website }}</a></p>
<p><strong>{{ __('messages.logo') }}: </strong>{{ $company->logo != '' ? __('messages.yes') : __('messages.no') }}</p>