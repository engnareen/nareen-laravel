@extends('layouts.dashboard')

@section('page-title')
        <small><a style="font-weight:bold" href="{{ route('event.create') }}" class="btn btn-sm btn-outline-primary"><i style="padding-right:7px" class="fa fa-plus"></i>CREATE EVENT</a></small>

@endsection

@section('content')

<table id="eventTable" class="table table-striped table-bordered" style="width:100%">
    <thead>
        <tr>
            <th>#Code</th>
            <th>Event Photo</th>
            <th>Event Title</th>
            <th>Event Date</th>
            <th>Time</th>
            <th>Action</th>
        </tr>
    </thead>

    <tbody>
        @foreach($events as $event)

        <tr>
            <td>{{ $event->id }}</td>
            <td><img src="{{ asset('uploads/Events/'. $event->image_path) }}" width="70" alt=""></td>
            <td>{{ $event->title }}</td>
            <td>{{ $event->date }}</td>
            <td>{{ $event->time }}</td>
            <td style="display:flex; margin:5px 10px">
                <a href="{{ route('event.edit', [$event->id]) }}" ><i style="color: orange ; margin: 0 5px;" class="fa fa-edit"></i></a>
                <a href="javascript:void(0);" style="border: none"
                onclick="if (confirm ('Are you sure to delete this record?')) { document.getElementById('delete-event-{{ $event->id }}').submit(); } else { return false; }"><i style="color: red" class="fa fa-trash"></i></a>
                <form method="post" action="{{ route('event.destroy', ['id' => $event->id]) }}" id="delete-event-{{$event->id}}" class="d-none">
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
            dataTable =  $("#eventTable").DataTable({
            "language": {
            "emptyTable" : "No data found, Please click on <b><a href='{{ route('event.create') }}'>Create Event</a></b> Button"
            },
        });
    });
    </script>

@endsection

