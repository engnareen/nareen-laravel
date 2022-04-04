
<div class="row">
    <div class="col-9">
        <label style="font-weight:bold" for="">Name</label>
        <x-form.input type="text" name="name" id="name" value="{{ $tag->name }}" />
    </div>

    <div class="col-3">
        <label for="status">Status</label>
        <select name="status" class="form-control">
            <option value="1" {{ old('status') == 1 ? 'selected' : null }}>Active</option>
            <option value="0" {{ old('status') == 0 ? 'selected' : null }}>Inactive</option>
        </select>
        @error('status')<span class="text-danger">{{ $message }}</span>@enderror
    </div>

</div>

<div class="form-group pt-4">
    <button type="submit" name="submit" class="btn btn-primary">Save Tag</button>
</div>



