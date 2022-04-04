
<div class="form-group">
    <label style="font-weight:bold" for="">Title</label>
    <x-form.input type="text" name="title" id="title" value="{{ $work->title }}" />
</div>


<div class="form-group">
    <label style="font-weight:bold" for="">Summary</label>
    <x-form.input type="text" name="summary" id="summary" value="{{ $work->summary }}" />
</div>


<div class="form-group">
    <label style="font-weight:bold" for="">Work Photo</label>
    <input type="file" name="image_path" id="image_path" class="file-input-overview @if($errors->has('image_path')) is-invalid @endif ">
    @if($errors->has('image_path'))
    <p class="invalid-feedback"><strong>{{ $errors->first('image_path') }}</strong></p>
    @endif
</div>

<div class="form-group">
    <button type="submit" class="btn btn-primary">Save</button>
</div>



