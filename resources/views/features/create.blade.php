@extends('layouts.dashboard')

@section('content')

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
    <div class="card-header" style="font-weight: bold"><i style="padding-right:7px" class="fas fa-plus-circle"></i>CREATE FEATURES
    </div>
        <div class="card-body">
        <form action="{{ route('feature.store') }}" method="post" enctype="multipart/form-data">
            @csrf
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


            });
        });
    </script>
@endsection

