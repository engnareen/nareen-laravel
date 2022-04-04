@extends('layouts.dashboard')

@section('style')
    <link rel="stylesheet" href="{{ asset('assets/datepicker/themes/classic.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/datepicker/themes/classic.date.css') }}">
    <style>
        .picker__select--month, .picker__select--year {
            padding: 0 !important;
        }
    </style>

@section('content')

<x-flash-message />
@if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $erorr)
            <li>{{ $erorr }}</li>
            @endforeach
        </ul>
    </div>
@endif

    <div class="card main-card">
        <div class="card-header">
            <div>
                <span class="icon is-small">
                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>

                </span>
                <span>My Profile</span>
            </div>
        </div>
    <form style="padding:20px 20px" action="{{ route('profile.edit') }}" method="POSt" id="profile_form" enctype="multipart/form-data">
        {{-- <input type="hidden" id="token" value="{{ @csrf_token() }}"> --}}
        @csrf
        @method('put')

        @include('profile._form')
    </form>
</div>



@endsection


@section('script')
        <script src="{{ asset('assets/datepicker/picker.js')}}"></script>
        <script src="{{ asset('assets/datepicker/picker.date.js')}}"></script>

        <script type="text/javascript">
        $(function(){

            $('#job_title').keyup(function () {
                this.value = this.value.toUpperCase();
            });

            $('#datepicker').pickadate({
                format: 'yyyy-mm-dd',
                selectMonths: true, // Creates a dropdown to control month
                selectYears: true, // Creates a dropdown to control month
                clear: 'Clear',
                close: 'Ok',
                closeOnSelect: true // Close upon selecting a date,
            });

            //image
            $('#profile_photo').fileinput({
                theme: 'fas',
                maxFileCount: 1,
                allowedFileTypes: ['image'],
                showCancel: true,
                showRemove: false,
                showUpload: false,
                overwriteIntial: false,
                initialPreview: [
                    @if($profile->image_path != '')

                    '{{ asset('images/profile_photos/'. $profile->image_path) }}'
                    @endif

                ],
                initialPreviewAsData: true,
                initialPreviewFileType: 'image',
                initialPreviewConfig: [
                @if($profile->image_path != '')
                {
                    caption: "{{ $profile->image_path }}" ,
                    size: '1111',
                    width: "120px",
                    url: "{{ route('profile.remove_image', ['profile_id' => $profile->id, '_token' => csrf_token()]) }}",
                    key: {{ $profile->id }},
                }
                @endif

                ],
            });
        });

        </script>

@endsection
