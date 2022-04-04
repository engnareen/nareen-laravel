
<div class="row">
    <div class="col-md-3">
        <label for="name">Plan Type</label>
        <x-form.select name="name" id="name" :options="$name" :selected="$plan->name" required="required"/>
    </div>

    <div class="col-md-3">
        <label for="name">Cost</label>
        <x-form.input type="number" name="cost" value="{{ $plan->cost}}"/>
    </div>
    <div class="col-md-3">
        <label for="type">Cost/per</label>
        <x-form.select name="type" id="type" :options="$type" :selected="$plan->type" required="required"/>
    </div>

    <div class="col-3">
        <label for="is_popular">Popular</label>
        <select name="is_popular" class="form-control">
            <option value="1" {{ old('is_popular') == 1 ? 'selected' : null }}>Yes</option>
            <option value="0" {{ old('is_popular') == 0 ? 'selected' : null }}>No</option>
        </select>
        @error('is_popular')<span class="text-danger">{{ $message }}</span>@enderror
    </div>

</div>

<div class="row" style="margin-top:15px">
    <div class="col-6">
        <label for="tags">tags</label>
        <select name="tags[]" class="form-control select2" multiple="multiple">
            @forelse($tags as $tag)
                {{-- <option value="{{ $tag->id }}">{{ $tag->name }}</option> --}}
                <option value="{{ $tag->id }}" {{ in_array($tag->id, $plan->tags->pluck('id')->toArray()) ? 'selected' : null }}>{{ $tag->name }}</option>

            @empty
            @endforelse
        </select>


    </div>
    <div class="col-6">
        <label for="">Plan Photo</label>
        <input type="file" name="image_path" id="image_path" class="file-input-overview @if($errors->has('image_path')) is-invalid @endif ">
        @if($errors->has('image_path'))
        <p class="invalid-feedback"><strong>{{ $errors->first('image_path') }}</strong></p>
        @endif
    </div>

</div>

<div class="form-group pt-4">
    <button type="submit" name="submit" class="btn btn-primary">Save Plan</button>
</div>



