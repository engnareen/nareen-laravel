@extends('layouts.dashboard')

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
<div class="card">
    <div class="card-header" style="font-weight: bold"><i style="padding-right:7px" class="fas fa-edit"></i>EDIT FEATURE
    </div>
        <div class="card-body">
    <form action="{{ route('feature.update', [$feature->id]) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('put')

        @include('features._form')
    </form>
    </div>
</div>

@endsection

@section('script')
    <script>
        $(function(){
            $('#image_path').fileinput({
                theme: 'fas',
                maxFileCount: 1,
                allowedFileTypes: ['image'],
                showCancel: true,
                showRemove: false,
                showUpload: false,
                overwriteIntial: false,

                initialPreview: [
                    @if($feature->image_path != '')

                    '{{ asset('uploads/Features/'. $feature->image_path) }}'
                    @endif

                ],
                initialPreviewAsData: true,
                initialPreviewFileType: 'image',
                initialPreviewConfig: [
                @if($feature->image_path != '')
                {
                    caption: "{{ $feature->image_path }}" ,
                    size: '1111',
                    width: "120px",
                    url: "{{ route('feature.remove_image', ['feature_id' => $feature->id, '_token' => csrf_token()]) }}",
                    key: {{ $feature->id }},
                }
                @endif

                ],

            });
        });
    </script>
@endsection


