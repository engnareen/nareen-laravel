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
    <div class="card-header" style="font-weight: bold"><i style="padding-right:7px" class="fas fa-tasks"></i>CREATE TAG
    </div>
        <div class="card-body">
        <form action="{{ route('tag.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            @include('tags._form')
        </form>
        </div>
</div>

@endsection



