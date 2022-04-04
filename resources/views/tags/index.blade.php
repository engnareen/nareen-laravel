@extends('layouts.dashboard')

@section('page-title')
        <small><a style="font-weight:bold" href="{{ route('tag.create') }}" class="btn btn-sm btn-outline-primary"><i style="padding-right:7px" class="fa fa-plus"></i>CREATE TAG</a></small>

@endsection

@section('content')


<table id="tagTable" class="table table-striped table-bordered" style="width:100%">
    <thead>
        <tr>
            <th>#Code</th>
            <th>Name</th>
            <th>Status</th>
            <th>Created at</th>
            <th>Action</th>
        </tr>
    </thead>

    <tbody>
        @foreach($tags as $tag)

        <tr>
            <td>{{ $tag->id }}</td>
            <td>{{ $tag->name }}</td>
            <td>{{ $tag->status() }}</td>
            <th>{{ $tag->created_at->format('Y-m-d') }}</th>

            <td style="display:flex; margin:5px 10px">
                <a href="{{ route('tag.edit', [$tag->id]) }}" ><i style="color: orange ; margin: 0 5px;" class="fa fa-edit"></i></a>
                <a href="javascript:void(0);" style="border: none"
                onclick="if (confirm ('Are you sure to delete this record?')) { document.getElementById('delete-tag-{{ $tag->id }}').submit(); } else { return false; }"><i style="color: red" class="fa fa-trash"></i></a>
                <form method="post" action="{{ route('tag.destroy', ['id' => $tag->id]) }}" id="delete-tag-{{$tag->id}}" class="d-none">
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
        dataTable =  $("#tagTable").DataTable({
        "language": {
        "emptyTable" : "No data found, Please click on <b><a href='{{ route('tag.create') }}'>Create Tag</a></b> Button"
        },
    });
});
</script>
@endsection
