@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.country.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('global.country.fields.shortcode')</th>
                            <td field-key='shortcode'>{{ $country->shortcode }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.country.fields.title')</th>
                            <td field-key='title'>{{ $country->title }}</td>
                        </tr>
                    </table>
                </div>
            </div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.countries.index') }}" class="btn btn-default">@lang('global.app_back_to_list')</a>
        </div>
    </div>
@stop


