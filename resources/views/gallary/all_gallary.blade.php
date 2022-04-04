

@forelse ($gallaries as $gallary)
    <div class="media mb-4">
        <img src="{{ asset('/storage/Gallary/' . $gallary->image ) }}" alt="" class="d-flex align-self-start rounded mr-3" height="80">
        <div class="media-body">
            <h6 style="font-weight:bold" class="mt-0 font-16">{{$gallary->details}}</h6>

            <div class="btn-group">
                <button class="btn btn-sm btn-primary" data-toggle="modal" data-id="{{$gallary->id}}" id="editBtn">Edit</button>
                <button class="btn btn-sm btn-danger" data-id="{{$gallary->id}}" id="delBtn">Delete</button>
            </div>
        </div>
    </div>
@empty
    <code>No Photos found</code>
@endforelse

