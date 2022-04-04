@extends('layouts.dashboard')
@section('style')
    <link rel="stylesheet" href="{{ asset('assets/select2/css/select2.min.css') }}">
@endsection
@section('content')

<x-flash-message />
@if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $erorr)
            <li>{{ $erorr }}</li>
            @endforeach
        </ul>
    </div>
@endif
<div class="card">
    <div class="card-header" style="font-weight: bold"><i style="padding-right:7px" class="fas fa-edit"></i>EDIT PLAN
    </div>
        <div class="card-body">
    <form action="{{ route('plan.update', [$plan->id]) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('put')

        @include('plans._form')
    </form>
    </div>
</div>

@endsection


@section('script')

    <script src="{{ asset('assets/select2/js/select2.full.min.js') }}"></script>

    <script>
        $(function(){

            function matchStart(params, data) {
                // If there are no search terms, return all of the data
                if ($.trim(params.term) === '') {
                    return data;
                }

                // Skip if there is no 'children' property
                if (typeof data.children === 'undefined') {
                    return null;
                }

                // `data.children` contains the actual options that we are matching against
                var filteredChildren = [];
                $.each(data.children, function (idx, child) {
                    if (child.text.toUpperCase().indexOf(params.term.toUpperCase()) == 0) {
                        filteredChildren.push(child);
                    }
                });

                // If we matched any of the timezone group's children, then set the matched children on the group
                // and return the group object
                if (filteredChildren.length) {
                    var modifiedData = $.extend({}, data, true);
                    modifiedData.children = filteredChildren;

                    // You can return modified objects from here
                    // This includes matching the `children` how you want in nested data sets
                    return modifiedData;
                }

                // Return `null` if the term should not be displayed
                return null;
            }

            $(".select2").select2({
                tags: true,
                closeOnSelect: false,
                minimumResultsForSearch: Infinity,
                matcher: matchStart
            });


            $('#image_path').fileinput({
                theme: 'fas',
                maxFileCount: 1,
                allowedFileTypes: ['image'],
                showCancel: true,
                showRemove: false,
                showUpload: false,
                overwriteIntial: false,
                initialPreview: [
                    @if($plan->image_path != '')

                    '{{ asset('uploads/Plans/'. $plan->image_path) }}'
                    @endif

                ],
                initialPreviewAsData: true,
                initialPreviewFileType: 'image',
                initialPreviewConfig: [
                @if($plan->image_path != '')
                {
                    caption: "{{ $plan->image_path }}" ,
                    size: '1111',
                    width: "120px",
                    url: "{{ route('plan.remove_image', ['plan_id' => $plan->id, '_token' => csrf_token()]) }}",
                    key: {{ $plan->id }},
                }
                @endif

                ],

            });

        });
    </script>
@endsection

