@extends('layouts.dashboard')

@section('page.title', 'Edit Settings')

@section('content')

    <div class="card main-card">
        <div class="card-header">
            <div>
                <span class="icon is-small">
                    <i class="fa fa-cogs"></i>
                </span>
                <span>Site Settings</span>
            </div>
        </div>
        {!! Form::model($setting,['method' => 'PATCH', 'files' => true, 'url' => route('settings.update', $setting->id)]) !!}
        @include('settings._form')
        {!! Form::close() !!}
    </div>

@endsection


