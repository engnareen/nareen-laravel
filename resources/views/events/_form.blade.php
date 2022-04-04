
<div class="form-group">
    <label style="font-weight:bold" for="">Title</label>
    <x-form.input type="text" name="title" id="title" value="{{ $event->title }}" />
</div>


<div class="form-group">
    <label style="font-weight:bold" for="">Summary</label>
    <x-form.input type="text" name="summary" id="summary" value="{{ $event->summary }}" />
</div>

<div class="row">
    <div class="col-6">
        <label style="font-weight:bold" for="date">Event Date</label>
        <x-form.input type="date" name="date" id="date" value="{{ $event->date }}" />
    </div>
    <div class="col-6">
    <label style="font-weight:bold" for="time">Event Time</label>
        <x-form.input type="time" name="time" id="time" value="{{ $event->time }}" />
    </div>
</div>


<div class="form-group">
    <label style="font-weight:bold" for="">Upload Photo</label>

    <input type="file" name="image_path" id="image_path" class="file-input-overview @if($errors->has('image_path')) is-invalid @endif ">
    @if($errors->has('image_path'))
    <p class="invalid-feedback"><strong>{{ $errors->first('image_path') }}</strong></p>
    @endif
</div>

<div class="form-group">
    <button type="submit" class="btn btn-primary">Save</button>
</div>



