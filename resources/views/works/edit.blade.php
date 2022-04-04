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
    <div class="card-header" style="font-weight: bold"><i style="padding-right:7px" class="fas fa-edit"></i>EDIT WORK
    </div>
        <div class="card-body">
    <form action="{{ route('work.update', [$work->id]) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('put')

        @include('works._form')
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
                    @if($work->image_path != '')

                    '{{ asset('uploads/Works/'. $work->image_path) }}'
                    @endif

                ],
                initialPreviewAsData: true,
                initialPreviewFileType: 'image',
                initialPreviewConfig: [
                @if($work->image_path != '')
                {
                    caption: "{{ $work->image_path }}" ,
                    size: '1111',
                    width: "120px",
                    url: "{{ route('work.remove_image', ['work_id' => $work->id, '_token' => csrf_token()]) }}",
                    key: {{ $work->id }},
                }
                @endif

                ],

            });
        });
    </script>
@endsection


