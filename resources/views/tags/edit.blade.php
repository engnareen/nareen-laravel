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
    <div class="card-header" style="font-weight: bold"><i style="padding-right:7px" class="fas fa-edit"></i>EDIT TAG
    </div>
        <div class="card-body">
    <form action="{{ route('tag.update', [$tag->id]) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('put')

        @include('tags._form')
    </form>
    </div>
</div>

@endsection



