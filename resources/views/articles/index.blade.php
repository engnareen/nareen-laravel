@extends('layouts.dashboard')

@section('page-title')
        <small><a style="font-weight:bold" href="{{ route('article.create') }}" class="btn btn-sm btn-outline-primary"><i style="padding-right:7px" class="fa fa-plus"></i>CREATE ARTICLE</a></small>

@endsection

@section('content')


<table id="employeeTable" class="table table-striped table-bordered" style="width:100%">
    <thead>
        <tr>
            <th>#Code</th>
            <th>Image</th>
            <th>Title</th>
            <th>Summary</th>
            <th>Action</th>
        </tr>
    </thead>

    <tbody>
        @foreach($articles as $article)

        <tr>
            <td>{{ $article->id }}</td>
            <td><img src="{{ asset('uploads/Articles/'. $article->image_path) }}" width="70" alt=""></td>
            <td>{{ $article->title }}</td>
            <td>{{ $article->summary }}</td>
            <td style="display:flex; margin:5px 10px">
                <a href="{{ route('article.edit', [$article->id]) }}" ><i style="color: orange ; margin: 0 5px;" class="fa fa-edit"></i></a>
                <a href="javascript:void(0);" style="border: none"
                onclick="if (confirm ('Are you sure to delete this record?')) { document.getElementById('delete-article-{{ $article->id }}').submit(); } else { return false; }"><i style="color: red" class="fa fa-trash"></i></a>
                <form method="post" action="{{ route('article.destroy', ['id' => $article->id]) }}" id="delete-article-{{$article->id}}" class="d-none">
                    @csrf
                    @method('delete')
                    {{-- <button style="border: none" onclick="Delete({{ $article->id }}); "><i style="color: red" class="fa fa-trash"></i></button> --}}
                </form>
            </td>
        </tr>
        @endforeach

    </tbody>
</table>


@endsection


@section('script')

{{-- <script src="{{ asset('jquery/js/jquery-3.6.0.min.js') }}"></script> --}}

<script>
    var Popup, dataTable;
    $(document).ready( function () {
        dataTable =  $("#employeeTable").DataTable({
        "language": {
        "emptyTable" : "No data found, Please click on <b><a href='{{ route('article.create') }}'>Create Article</a></b> Button"
        },
    });
});
</script>

@endsection

