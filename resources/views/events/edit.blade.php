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
    <div class="card-header" style="font-weight: bold"><i style="padding-right:7px" class="fas fa-highlighter"></i>Edit
        EVENT
    </div>
    <div class="card-body">
        <form action="{{ route('event.update', [$event->id]) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('put')

            @include('events._form')
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
                    @if($event->image_path != '')

                    '{{ asset('uploads/Events/'. $event->image_path) }}'
                    @endif

                ],
                initialPreviewAsData: true,
                initialPreviewFileType: 'image',
                initialPreviewConfig: [
                @if($event->image_path != '')
                {
                    caption: "{{ $event->image_path }}" ,
                    size: '1111',
                    width: "120px",
                    url: "{{ route('remove_image', ['event_id' => $event->id, '_token' => csrf_token()]) }}",
                    key: {{ $event->id }},
                }
                @endif

                ],




            });
        });
    </script>
@endsection

