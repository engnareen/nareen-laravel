
<div class="card-content" style="margin:10px 30px">
    <div class="form-group">
        <div class="field-label is-normal">
            <label class="label required">Site Name</label>
        </div>
        <div class="field-body">
            <div class="field">
                <div class="control">
                    {!! Form::text('site_name', null, ['class' => 'form-control', 'required']) !!}
                </div>
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="field-label is-normal">
            <label class="label required">Description</label>
        </div>
        <div class="field-body">
            <div class="field">
                <div class="control">
                    {!! Form::textarea('site_description', null, ['class' => 'form-control', 'rows' => 3  , 'required'] )!!}
                </div>
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="field-label is-normal">
            <label class="label">Email Address</label>
        </div>
        <div class="field-body">
            <div class="field">
                <div class="control">
                    {!! Form::text('email', null, ['class' => 'form-control'] )!!}
                </div>
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="field-label is-normal">
            <label class="label">Mobile</label>
        </div>
        <div class="field-body">
            <div class="field">
                <div class="control">
                    {!! Form::text('phone', null, ['class' => 'form-control'] )!!}
                </div>
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="field-label is-normal">
            <label class="label">Whatsapp</label>
        </div>
        <div class="field-body">
            <div class="field">
                <div class="control">
                    {!! Form::text('whatsapp', null, ['class' => 'form-control'] )!!}
                </div>
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="field-label is-normal">
            <label class="label">FaceBook</label>
        </div>
        <div class="field-body">
            <div class="field">
                <div class="control">
                    {!! Form::text('facebook', null, ['class' => 'form-control'] )!!}
                </div>
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="field-label is-normal">
            <label class="label">Twitter</label>
        </div>
        <div class="field-body">
            <div class="field">
                <div class="control">
                    {!! Form::text('twitter', null, ['class' => 'form-control'] )!!}
                </div>
            </div>
        </div>
    </div>

    <div class="form-group">
        <div class="field-label is-normal">
            <label class="label">LinkedIn</label>
        </div>
        <div class="field-body">
            <div class="field">
                <div class="control">
                    {!! Form::text('linkedin', null, ['class' => 'form-control'] )!!}
                </div>
            </div>
        </div>
    </div>

    <div class="form-group">
        <div class="field-label is-normal">
            <label class="label">Instgram</label>
        </div>
        <div class="field-body">
            <div class="field">
                <div class="control">
                    {!! Form::text('instagram', null, ['class' => 'form-control'] )!!}
                </div>
            </div>
        </div>
    </div>

    <div class="form-group">
        <div class="field-label is-normal">
            <label class="label">YouTube</label>
        </div>
        <div class="field-body">
            <div class="field">
                <div class="control">
                    {!! Form::text('youtube', null, ['class' => 'form-control'] )!!}
                </div>
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="field-label is-normal">
            <label class="label required">Address</label>
        </div>
        <div class="field-body">
            <div class="field">
                <div class="control">
                    {!! Form::text('address', null, ['class' => 'form-control']) !!}
                </div>
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="field-label is-normal">
            <label class="label required">Google Map</label>
        </div>
        <div class="field-body">
            <div class="field">
                <div class="control">
                    <google-map :editable="true" @if(isset($setting)) :address="{latitude:{{ $setting->latitude }}, longitude:{{ $setting->longitude }}}" @endif></google-map>
                </div>
            </div>
        </div>
    </div>
</div>

<footer class="card-footer">
    <div class="buttons has-addons">
        <button type="submit" class="btn btn-success">Save</button>

        <a class="btn btn-info" href=""> Cancel </a>
    </div>
</footer>
