@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-11">
            <h2>{{ __('messages.companies') }}</h2>
            <a href="companies/create" class="btn btn-primary" style="margin-bottom: 15px;">{{ __('messages.create_new') }}</a>
            @if (Session('message'))
                <div class="alert alert-info alert-dismissible">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <p>{{Session('message')}}</p>
                </div>
            @endif
        </div>
        <div class="col-md-11">
        <table id="table_id" class="table table-striped">
                <thead>
                    <tr>
                        <th >#</th>
                        <th>{{ __('messages.name') }}</th>
                        <th>{{ __('messages.email') }}</th>
                        <th>{{ __('messages.website') }}</th>
                        <th>{{ __('messages.logo') }}</th>
                        <th>{{ __('messages.action') }}</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($companies as $company)
                    <tr>
                        <td >{!! $company->id !!}</td>
                        <td>{!! $company->name !!}</td>
                        <td>{!! $company->email !!}</td>
                        <td>{!! $company->website !!}</td>
                        <td>{{ ( $company->logo != '' ) ? __('messages.yes') : __('messages.no') }}</td>
                        <td>
                            <a class="btn btn-default btn-sm" href="{!! 'companies/' . $company->id !!}">{{ __('messages.view') }}</a>
                            <a class="btn btn-success btn-sm" href="{!! 'companies/' . $company->id . '/edit' !!}">{{ __('messages.edit') }}</a>
                            {!! Form::open(['method' => 'DELETE', 'url' => '/companies/' . $company->id, 'style' => 'display: inline-block;']) !!}
                                {!! Form::submit(__('messages.delete'), ['class' => 'btn btn-danger btn-sm']) !!}
                            {!! Form::close() !!}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@section('script')
<script type="text/javascript">
    $(document).ready( function () {
        $('#table_id').DataTable({
            "language": {
                "emptyTable": '{{ __('messages.empty_table') }}',
                "info": '{{ __('messages.info') }}',
                "infoEmpty": '{{ __('messages.info_empty') }}',
                "infoFiltered": '{{ __('messages.info_filtered') }}',
                "lengthMenu": '{{ __('messages.length_menu') }}',
                "loadingRecords": '{{ __('messages.loading_records') }}',
                "processing": '{{ __('messages.processing') }}',
                "search": '{{ __('messages.search') }}',
                "zeroRecords": '{{ __('messages.zero_records') }}',
                "paginate": {
                    "first": '{{ __('messages.paginate_first') }}',
                    "last": '{{ __('messages.paginate_last') }}',
                    "next": '{{ __('messages.paginate_next') }}',
                    "previous": '{{ __('messages.paginate_previous') }}'
                },
                "aria": {
                    "sortAscending": '{{ __('messages.aria_sort_ascending') }}',
                    "sortDescending": '{{ __('messages.aria_sort_descending') }}'
                }
            }
        });
    } )
</script>
@endsection
