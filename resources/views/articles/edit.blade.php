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
    <div class="card-header" style="font-weight: bold"><i style="padding-right:7px" class="fas fa-edit"></i>Edit ARTICLE
    </div>
        <div class="card-body">
    <form action="{{ route('article.update', [$article->id]) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('put')

        @include('articles._form')
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
                    @if($article->image_path != '')

                    '{{ asset('uploads/Articles/'. $article->image_path) }}'
                    @endif

                ],
                initialPreviewAsData: true,
                initialPreviewFileType: 'image',
                initialPreviewConfig: [
                @if($article->image_path != '')
                {
                    caption: "{{ $article->image_path }}" ,
                    size: '1111',
                    width: "120px",
                    url: "{{ route('article.remove_image', ['article_id' => $article->id, '_token' => csrf_token()]) }}",
                    key: {{ $article->id }},
                }
                @endif

                ],

            });
        });
    </script>
@endsection


