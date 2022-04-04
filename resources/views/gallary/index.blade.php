@extends('layouts.dashboard')

@section('style')
    <link rel="stylesheet" href="{{ asset('sweetalert/css/sweetalert2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('toastr/toastr.min.css') }}">
@endsection

@section('content')

<div class="container">
<div class="row" style="margin-top: 50px">
    <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-grey text-black" style="font-weight:bold"><i style="padding-right:10px" class="fas fa-plus"></i>ADD NEW GALLERY</div>
                <div class="card-body">
                    <form action="{{route('save.gallary')}}" method="post" enctype="multipart/form-data" id="form">
                    @csrf

                        <div class="form-group">
                            <label style="font-weight:bold" for="">Upload Photo</label>
                            <input type="file" name="image" id="image_path" class="file-input-overview">
                            <span class="text-danger error-text image_error"></span>
                        </div>
                        <div class="img-holder"></div>

                        <div class="form-group">
                            <label style="font-weight:bold" for="">Photo Description</label>
                            <textarea name="details" class="form-control" placeholder="Enter description" id="" cols="30" rows="10"></textarea>
                            <span class="text-danger error-text details_error"></span>
                        </div>

                        <button type="submit" class="btn btn-primary">Save</button>
                    </form>
                </div>
            </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-header bg-grey text-black" style="font-weight:bold"><i style="padding-right:10px" class="fas fa-photo-video"></i>ALL Gallery</div>
            <div class="card-body" id="AllGallary">
                @forelse ($gallaries as $gallary)
                <div class="media mb-4">
                    <img src="{{ asset('/storage/Gallary/' . $gallary->image ) }}" alt="" class="d-flex align-self-start rounded mr-3" height="80">
                    <div class="media-body">
                    <div class="btn-group">
                    <button class="btn btn-sm btn-primary" data-toggle="modal" data-id="{{$gallary->id}}" id="editBtn">Edit</button>
                    <button class="btn btn-sm btn-danger" data-id="{{$gallary->id}}" id="delBtn">Delete</button>
                    </div>
                    </div>
                </div>
                @empty
                <code>No Photos found</code>
                @endforelse
            </div>
        </div>
    </div>
</div>
</div>

@include('gallary.editGallaryModal')


@endsection


@section('script')

<script src="{{ asset('sweetalert/js/sweetalert2.min.js') }}"></script>
<script src="{{ asset('toastr/toastr.min.js') }}"></script>
<script>

    toastr.options.preventDuplicates = true;
    $.ajaxSetup({
        headers:{
            'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
        }
    });

$(function(){

        $('#form').on('submit', function(e){
            e.preventDefault();

            var form = this;
            $.ajax({
                url:$(form).attr('action'),
                method:$(form).attr('method'),
                data:new FormData(form),
                processData:false,
                dataType:'json',
                contentType:false,
                beforeSend:function(){
                    $(form).find('span.error-text').text('');
                },
                success:function(data){
                    if(data.code == 0){
                        $.each(data.error, function(prefix,val){
                            $(form).find('span.'+prefix+'_error').text(val[0]);
                        });
                    }else{
                        $(form)[0].reset();
                        //alert(data.msg);
                        toastr.success(data.msg);
                        fetchAllGallary();
                    }
                }
            });
        });

        //Reset input file
        $('input[type="file"][name="image"]').val('');
        //Image preview
        $('input[type="file"][name="image"]').on('change', function(){
            var img_path = $(this)[0].value;
            var img_holder = $('.img-holder');
            var extension = img_path.substring(img_path.lastIndexOf('.')+1).toLowerCase();

            if(extension == 'jpeg' || extension == 'jpg' || extension == 'png'){
                    if(typeof(FileReader) != 'undefined'){
                        img_holder.empty();
                        var reader = new FileReader();
                        reader.onload = function(e){
                            $('<img/>',{'src':e.target.result,'class':'img-fluid','style':'max-width:100px;margin-bottom:10px;'}).appendTo(img_holder);
                        }
                        img_holder.show();
                        reader.readAsDataURL($(this)[0].files[0]);
                    }else{
                        $(img_holder).html('This browser does not support FileReader');
                    }
            }else{
                $(img_holder).empty();
            }
        });

        //Fetch all gallary
        fetchAllGallary();
        function fetchAllGallary(){
            $.get('{{route("fetch.gallary")}}',{}, function(data){
                    $('#Allgallary').html(data.result);
            },'json');
        }

        // Edit Gallary
        $(document).on('click','#editBtn',function(){
            var gallary_id = $(this).data('id');
            //alert(gallary_id);
            var url = "{{ route('get.gallary.details')}}";
            $.get(url, {id: gallary_id}, function(data){
                //alert(data.result.name);
                var gallaryModal = $('.editGallaryModal');

                $(gallaryModal).find('form').find('input[name="t_id"]').val(data.result.id);
                $(gallaryModal).find('form').find('textarea[name="details"]').val(data.result.details);
                $(gallaryModal).find('form').find('.image-holder-update').html('<img src="/storage/Gallary/'+ data.result.image+'" class="img-fluid" style="max-width:100px; margin-bottom:10px" >');
                $(gallaryModal).find('form').find('input[type="file"]').attr('data-value', '<img src="/storage/Gallary/'+ data.result.image +'" class="img-fluid" style="max-width:100px; margin-bottom:10px;" >');
                $(gallaryModal).find('form').find('input[type="file"]').val('');
                $(gallaryModal).find('form').find('span.error-text').text('');
                $(gallaryModal).modal('show');

            }, 'json');
        });

        $('input[type="file"][name= "image"]').on('change', function(){
            var img_path = $(this)[0].value;
            var img_holder = $('.image-holder-update');
            var current_image = $(this).data('value');
            var extension = img_path.substring(img_path.lastIndexOf('.')+1).toLowerCase();
            if(extension == 'jpeg' || extension == 'jpg' || extension == 'png'){
                if(typeof(FileReader) != 'undefined'){
                        img_holder.empty();
                        var reader = new FileReader();
                        reader.onload = function(e){
                            $('<img/>',{'src':e.target.result,'class':'img-fluid','style':'max-width:100px;margin-bottom:10px;'}).appendTo(img_holder);
                        }
                        img_holder.show();
                        reader.readAsDataURL($(this)[0].files[0]);
                    }else{
                        $(img_holder).html('This browser does not support FileReader');
                    }
            }else{
                $('img_holder').html(current_image);
            }
        });
        //clear image
        $(document).on('click','#clear_image', function(){
            var form = $(this).closest('form');
            $(form).find('input[type="file"]').val('');
            $(form).find('.image-holder-update').html($(form).find('input[type="file"]').data('value'));

        });
        // update gallary
        $('#update_form').on('submit', function(e){
            e.preventDefault();
            var form = this;
            $.ajax({
                url:$(form).attr('action'),
                method:$(form).attr('method'),
                data:new FormData(form),
                processData:false,
                dataType:'json',
                contentType:false,
                beforeSend:function(){
                    $(form).find('span.error-text').text('');
                },
                success:function(data){
                    if(data.code == 0){
                        $.each(data.error, function(prefix,val){
                            $(form).find('span.'+prefix+'_error').text(val[0]);
                        });
                    }
                    else{
                        //alert(data.msg);
                        toastr.success(data.msg);
                        fetchAllGallary();
                        $('.editGallaryModal').modal('hide');
                    }
                }

            });

        });

        // delete a gallary from the form
        $(document).on('click','#delBtn', function(){
            var gallary_id = $(this).data('id');
            //alert(gallary_id);
            var url = "{{ route('delete.gallary')}}";
            swal.fire({
                    title:'Are you sure?',
                    html:'You want to <b>delete</b> this country',
                    showCancelButton:true,
                    showCloseButton:true,
                    cancelButtonText:'Cancel',
                    confirmButtonText:'Yes, Delete',
                    cancelButtonColor:'#d33',
                    confirmButtonColor:'#556ee6',
                    width:300,
                    allowOutsideClick:false
            }).then(function(result){

                if(result.value){
                $.ajax({
                    headers:{
                    'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
                    },
                    'url': url,
                    'method': 'POST',
                    'data': {id: gallary_id},
                    'datatype': 'json',
                    success: function(data){
                        if(data.code == 1){
                            fetchAllGallary();
                            toastr.success(data.msg);

                        }
                        else{
                            //alert(data.msg);
                            toastr.error(data.msg);

                        }
                    }


                })

                }
            })

        });
    })

    // fileinput
        $(function(){
            $('#image_path').fileinput({
                theme: 'fas',
                maxFileCount: 1,
                allowedFileTypes: ['image'],
                showCancel: true,
                showRemove: false,
                showUpload: false,
                overwriteIntial: false,
            });
        });
</script>

@endsection

