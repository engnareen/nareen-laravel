@extends('layouts.dashboard')
@section('content')

@section('style')
    <link rel="stylesheet" href="{{ asset('sweetalert/css/sweetalert2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('toastr/toastr.min.css') }}">
@endsection

<div class="container">
<div class="row" style="margin-top: 50px">
    <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-grey text-black" style="font-weight:bold"><i style="padding-right:10px" class="fas fa-user-plus"></i>ADD NEW MEMBER</div>
                <div class="card-body">
                    <form action="{{route('save.teams')}}" method="post" enctype="multipart/form-data" id="form">
                    @csrf
                        <div class="form-group">
                            <label style="font-weight:bold" for="">Member's Name</label>
                            <input type="text" name="name" class="form-control" placeholder="Enter name">
                            <span class="text-danger error-text name_error"></span>
                        </div>
                        <div class="form-group">
                            <label style="font-weight:bold" for="">Job Title</label>
                            <input type="text" name="job_description" class="form-control" placeholder="Enter job title">
                            <span class="text-danger error-text job_description_error"></span>
                        </div>
                        <div class="form-group">
                            <label style="font-weight:bold" for="">Member Photo</label>
                            <input type="file" name="image" id="image_path" class="file-input-overview">
                            <span class="text-danger error-text image_error"></span>
                        </div>
                        <div class="img-holder"></div>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </form>
                </div>
            </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-header bg-grey text-black" style="font-weight:bold"><i style="padding-right:10px" class="fas fa-users"></i>ALL TEAM MEMBERS</div>
            <div class="card-body" id="AllTeams">

            </div>
        </div>
    </div>
</div>
</div>

@include('team.editTeamModal')

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
                        fetchAllTeams();
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

        //Fetch all Teams
        fetchAllTeams();
        function fetchAllTeams(){
            $.get('{{route("fetch.teams")}}',{}, function(data){
                    $('#AllTeams').html(data.result);
            },'json');
        }

        // Edit teams
        $(document).on('click','#editBtn',function(){
            var team_id = $(this).data('id');
            //alert(team_id);
            var url = "{{ route('get.team.details')}}";
            $.get(url, {id: team_id}, function(data){
                //alert(data.result.name);
                var teamModal = $('.editTeamModal');

                $(teamModal).find('form').find('input[name="t_id"]').val(data.result.id);
                $(teamModal).find('form').find('input[name="name"]').val(data.result.name);
                $(teamModal).find('form').find('input[name="job_description"]').val(data.result.job_description);
                $(teamModal).find('form').find('.image-holder-update').html('<img src="/storage/TeamMembers/'+ data.result.image+'" class="img-fluid" style="max-width:100px; margin-bottom:10px" >');
                $(teamModal).find('form').find('input[type="file"]').attr('data-value', '<img src="/storage/TeamMembers/'+ data.result.image +'" class="img-fluid" style="max-width:100px; margin-bottom:10px;" >');
                $(teamModal).find('form').find('input[type="file"]').val('');
                $(teamModal).find('form').find('span.error-text').text('');
                $(teamModal).modal('show');

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
        // update team
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
                        fetchAllTeams();
                        $('.editTeamModal').modal('hide');
                    }
                }

            });

        });

        // delete a member from the form
        $(document).on('click','#delBtn', function(){
            var team_id = $(this).data('id');
            //alert(team_id);
            var url = "{{ route('delete.member')}}";
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
                    'data': {id: team_id},
                    'datatype': 'json',
                    success: function(data){
                        if(data.code == 1){
                            fetchAllTeams();
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
{{--

    </body>
</html> --}}

@endsection
