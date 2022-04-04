@extends('layouts.dashboard')

@section('page-title')
        <small><a style="font-weight:bold" href="{{ route('feature.create') }}" class="btn btn-sm btn-outline-primary"><i style="padding-right:7px" class="fa fa-plus"></i>CREATE FEATURE</a></small>

@endsection

@section('content')

<table id="featuredTable" class="table table-striped table-bordered" style="width:100%">
    <thead>
        <tr>
            <th>#</th>
            <th>Image</th>
            <th>Title</th>
            <th>Summary</th>
            <th>Action</th>
        </tr>
    </thead>

    <tbody>
        @foreach($features as $feature)

        <tr>
            <td>{{ $feature->id }}</td>
            <td><img src="{{ asset('uploads/Features/'. $feature->image_path) }}" width="70" alt=""></td>
            <td>{{ $feature->title }}</td>
            <td>{{ $feature->summary }}</td>
            <td style="display:flex; margin:5px 10px">
                <a href="{{ route('feature.edit', [$feature->id]) }}" ><i style="color: orange ; margin: 0 5px;" class="fa fa-edit"></i></a>
                <a href="javascript:void(0);" style="border: none"
                onclick="if (confirm ('Are you sure to delete this record?')) { document.getElementById('delete-feature-{{ $feature->id }}').submit(); } else { return false; }"><i style="color: red" class="fa fa-trash"></i></a>
                <form method="post" action="{{ route('feature.destroy', ['id' => $feature->id]) }}" id="delete-feature-{{$feature->id}}" class="d-none">
                    @csrf
                    @method('delete')
                </form>
            </td>
        </tr>
        @endforeach

    </tbody>
</table>


@endsection

@section('script')

<script>
    var Popup, dataTable;
    $(document).ready( function () {
        dataTable =  $("#featuredTable").DataTable({
        "language": {
        "emptyTable" : "No data found, Please click on <b><a href='{{ route('feature.create') }}'>Create Feature</a></b> Button"
        },
    });
});
</script>
@endsection
