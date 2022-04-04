

<div class="row" style="margin-top:10px;">
    <div class="col-md-4">
        <input type="file" name="profile_photo" id="profile_photo" class="file-input-overview" value="{{ $profile->profile_photo }}">
    </div>
    <div class="col-md-8">
        <img style="border-radius:50%" width="200" height="200" src="{{ Auth::user()->profile_photo_url }}" class="form-group"
            alt="User Image">
    </div>
</div>

<div class="row">
    <div class="col-md-4">
        <label for="first_name">First Name</label>
        <x-form.input type="text" name="first_name" id="first_name" placeholder="First Name"
            value='{{ $profile->first_name }}' />
    </div>

    <div class="col-md-4">
        <label for="last_name">Last Name</label>
        <x-form.input type="text" name="last_name" id="last_name" placeholder="Last Name"
            value='{{ $profile->last_name }}' />
    </div>

    <div class="col-md-4">
        <label for="email">Email Address</label>
        <x-form.input type="text" name="email" id="email" placeholder="E-Mail"
            value='{{ $profile->user->email }}' />
    </div>
</div>

<div class="row" style="margin-top:15px;">

    <div class="col-md-4">
        <label for="job_title">Job Title</label>
        <x-form.input type="text" name="job_title" id="job_title" placeholder="Job Title"
            value='{{ $profile->job_title }}' />
    </div>

    <div class="col-md-4">
        <label for="country">Select Country</label>
        <x-country-select id="country" :selected="$profile->country" />
    </div>

    <div class="col-md-4">
        <label for="birthday">Birthday</label>
        <x-form.input type="text" name="birthday" id="datepicker" placeholder="" value="{{ $profile->birthday != '' ? $profile->birthday->format('Y-m-d') : '' }} "/>
    </div>
</div>

<div class="row" style="margin-top:15px;">
    <div class="col-md-4">
        <label for="gender">Gender</label>

        <x-form.select name="gender" id="gender" :options="$gender" :selected="$profile->gender" required="required"/>
    </div>
    <div class="col-md-8">
        <label for="description">Description</label>
        <x-form.input type="text" name="description" id="description" placeholder=""
            value='{{ $profile->description }}' />
    </div>
</div>

<footer class="card-footer" style="margin-top:20px">
    <div class="buttons has-addons">
        <button type="submit" id="btn" name="save" class="btn btn-primary">Save Changes</button>

        <a class="btn btn-info" href=""> Cancel </a>
    </div>
</footer>


