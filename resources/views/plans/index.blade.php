@extends('layouts.dashboard')

@section('page-title')
        <small><a style="font-weight:bold" href="{{ route('plan.create') }}" class="btn btn-sm btn-outline-primary"><i style="padding-right:7px" class="fa fa-plus"></i>CREATE PLAN</a></small>

@endsection

@section('content')

{{-- <x-alert-message /> --}}

<table id="planTable" class="table table-striped table-bordered" style="width:100%">
    <thead>
        <tr>
            <th>#Code</th>
            <th>Photo</th>
            <th>Name</th>
            <th>Popular</th>
            <th>Cost</th>
            <th>Type</th>
            <th>Tags</th>
            <th>Created at</th>
            <th>Action</th>
        </tr>
    </thead>

    <tbody>
        @foreach($plans as $plan)

        <tr>
            <td>{{ $plan->id }}</td>
            <td><img src="{{ asset('uploads/Plans/'. $plan->image_path) }}" width="50" alt=""></td>

            <td>{{ $plan->name }}</td>
            <td>{{ $plan->is_popular() }}</td>
            <td>{{ $plan->cost }}</td>
            <td>{{ $plan->type }}</td>
            <td>{{ $plan->tags->pluck('name')->join(', ') }}</td>
            <th>{{ $plan->created_at->format('d-m-Y') }}</th>

            <td style="display:flex; margin:5px 10px">
                <a href="{{ route('plan.edit', [$plan->id]) }}" ><i style="color: orange ; margin: 0 5px;" class="fa fa-edit"></i></a>
                <a href="javascript:void(0);" style="border: none"
                onclick="if (confirm ('Are you sure to delete this record?')) { document.getElementById('delete-plan-{{ $plan->id }}').submit(); } else { return false; }"><i style="color: red" class="fa fa-trash"></i></a>
                <form method="post" action="{{ route('plan.destroy', ['id' => $plan->id]) }}" id="delete-plan-{{$plan->id}}" class="d-none">
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
        dataTable =  $("#planTable").DataTable({
        "language": {
        "emptyTable" : "No data found, Please click on <b><a href='{{ route('plan.create') }}'>Create plan</a></b> Button"
        },
    });
});
</script>
@endsection


