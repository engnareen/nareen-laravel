@forelse ($teams as $team)
    <div class="media mb-4">
        <img src="{{ asset('/storage/TeamMembers/' . $team->image ) }}" alt="" class="d-flex align-self-start rounded mr-3" height="80">
        <div class="media-body">
            <h6 style="font-weight:bold" class="mt-0 font-16">{{$team->name}}</h6>
            <p class="mt-0 font-16">{{$team->job_description}}</p>

            <div class="btn-group">
                <button class="btn btn-sm btn-primary" data-toggle="modal" data-id="{{$team->id}}" id="editBtn">Edit</button>
                <button class="btn btn-sm btn-danger" data-id="{{$team->id}}" id="delBtn">Delete</button>
            </div>
        </div>
    </div>
@empty
    <code>No members found</code>
@endforelse
