@extends('layouts.dashboard')

@section('content')


@section('style')
    {{-- <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('datatable/css/dataTables.bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('datatable/css/dataTables.bootstrap4.min.css') }}"> --}}
    <link rel="stylesheet" href="{{ asset('sweetalert/css/sweetalert2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('toastr/toastr.min.css') }}">
@endsection
<div class="container">
        <div class="row" style="margin-top: 45px">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header" style="font-weight:bold"><i style="padding-right:7px" class="fas fa-plus-circle"></i>ADD NEW Skill</div>
                    <div class="card-body">
                        <form action="{{ route('add.skill') }}" method="post" id="add-skill-form" autocomplete="off">
                            @csrf
                            <div class="form-group">
                                <label style="font-weight:bold" for="">Skill name</label>
                                <input type="text" class="form-control" name="name" placeholder="Enter skill name">
                                <span class="text-danger error-text name_error"></span>
                            </div>
                            <div class="form-group">
                                <label style="font-weight:bold" for="">Skill Range</label>
                                <input type="range" class="form-control" name="range">
                                <span class="text-danger error-text range_error"></span>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-block btn-primary">SAVE</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-8">

                <div class="card">
                    <div class="card-header" style="font-weight: bold"><i style="padding-right:7px" class="fab fa-buromobelexperte"></i>SKILLS</div>
                    <div class="card-body">
                        <table class="table table-hover table-condensed" id="skills-table">
                            <thead>
                                <th><input type="checkbox" name="main_checkbox"><label></label></th>
                                <th>#</th>
                                <th>Skill name</th>
                                <th>Skill range</th>

                                <th>Actions <button class="btn btn-sm btn-danger d-none" id="deleteAllBtn">Delete All</button></th>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>

</div>

@include('skills.edit-skill-modal')

@section('script')
{{-- <script src="{{ asset('jquery/js/jquery-3.6.0.min.js') }}"></script>
<script src="{{ asset('bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('datatable/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('datatable/js/dataTables.bootstrap4.min.js') }}"></script> --}}
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

            //ADD NEW Skill
            $('#add-skill-form').on('submit', function(e){
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
                                $.each(data.error, function(prefix, val){
                                    $(form).find('span.'+prefix+'_error').text(val[0]);
                                });
                            }else{
                                $(form)[0].reset();
                            //  alert(data.msg);
                            $('#skills-table').DataTable().ajax.reload(null, false);
                            toastr.success(data.msg);
                            }
                        }
                });
            });

            //GET ALL skills
            var table =  $('#skills-table').DataTable({
                    processing:true,
                    info:true,
                    ajax:"{{ route('get.skills.list') }}",
                    "pageLength":5,
                    "aLengthMenu":[[5,10,25,50,-1],[5,10,25,50,"All"]],
                    columns:[
                        {data:'checkbox', name:'checkbox', orderable:false, searchable:false},
                        {data:'DT_RowIndex', name:'DT_RowIndex'},
                        {data:'name', name:'name'},
                        {data:'range', name:'range'},

                        {data:'actions', name:'actions', orderable:false, searchable:false},
                    ]
            }).on('draw', function(){
                $('input[name="skill_checkbox"]').each(function(){this.checked = false;});
                $('input[name="main_checkbox"]').prop('checked', false);
                $('button#deleteAllBtn').addClass('d-none');
            });

            $(document).on('click','#editSkillBtn', function(){
                var skill_id = $(this).data('id');
                $('.editSkill').find('form')[0].reset();
                $('.editSkill').find('span.error-text').text('');
                $.post('<?= route("get.skill.details") ?>',{skill_id:skill_id}, function(data){
                    //alert(data.details.name);
                    $('.editSkill').find('input[name="cid"]').val(data.details.id);
                    $('.editSkill').find('input[name="name"]').val(data.details.name);
                    $('.editSkill').find('input[name="range"]').val(data.details.range);
                    $('.editSkill').modal('show');
                },'json');
            });


            //UPDATE Skill DETAILS
            $('#update-skill-form').on('submit', function(e){
                e.preventDefault();
                var form = this;
                $.ajax({
                    url:$(form).attr('action'),
                    method:$(form).attr('method'),
                    data:new FormData(form),
                    processData:false,
                    dataType:'json',
                    dataType:'json',
                    contentType:false,
                    beforeSend: function(){
                            $(form).find('span.error-text').text('');
                    },
                    success: function(data){
                            if(data.code == 0){
                                $.each(data.error, function(prefix, val){
                                    $(form).find('span.'+prefix+'_error').text(val[0]);
                                });
                            }else{
                                $('#skills-table').DataTable().ajax.reload(null, false);
                                $('.editSkill').modal('hide');
                                $('.editSkill').find('form')[0].reset();
                                toastr.success(data.msg);
                            }
                    }
                });
            });

            //DELETE skill RECORD
            $(document).on('click','#deleteSkillBtn', function(){
                var skill_id = $(this).data('id');
                var url = '<?= route("delete.skill") ?>';

                swal.fire({
                        title:'Are you sure?',
                        html:'You want to <b>delete</b> this skill',
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
                            $.post(url,{skill_id:skill_id}, function(data){
                                if(data.code == 1){
                                    $('#skills-table').DataTable().ajax.reload(null, false);
                                    toastr.success(data.msg);
                                }else{
                                    toastr.error(data.msg);
                                }
                            },'json');
                        }
                });

            });




        $(document).on('click','input[name="main_checkbox"]', function(){
                if(this.checked){
                $('input[name="skill_checkbox"]').each(function(){
                    this.checked = true;
                });
                }else{
                    $('input[name="skill_checkbox"]').each(function(){
                        this.checked = false;
                    });
                }
                toggledeleteAllBtn();
        });

        $(document).on('change','input[name="skill_checkbox"]', function(){

            if( $('input[name="skill_checkbox"]').length == $('input[name="skill_checkbox"]:checked').length ){
                $('input[name="main_checkbox"]').prop('checked', true);
            }else{
                $('input[name="main_checkbox"]').prop('checked', false);
            }
            toggledeleteAllBtn();
        });


        function toggledeleteAllBtn(){
            if( $('input[name="skill_checkbox"]:checked').length > 0 ){
                $('button#deleteAllBtn').text('Delete ('+$('input[name="skill_checkbox"]:checked').length+')').removeClass('d-none');
            }else{
                $('button#deleteAllBtn').addClass('d-none');
            }
        }


        $(document).on('click','button#deleteAllBtn', function(){
            var checkedskills = [];
            $('input[name="skill_checkbox"]:checked').each(function(){
                checkedskills.push($(this).data('id'));
            });

            var url = '{{ route("delete.selected.skills") }}';
            if(checkedskills.length > 0){
                swal.fire({
                    title:'Are you sure?',
                    html:'You want to delete <b>('+checkedskills.length+')</b> skills',
                    showCancelButton:true,
                    showCloseButton:true,
                    confirmButtonText:'Yes, Delete',
                    cancelButtonText:'Cancel',
                    confirmButtonColor:'#556ee6',
                    cancelButtonColor:'#d33',
                    width:300,
                    allowOutsideClick:false
                }).then(function(result){
                    if(result.value){
                        $.post(url,{skills_ids:checkedskills},function(data){
                            if(data.code == 1){
                                $('#skills-table').DataTable().ajax.reload(null, true);
                                toastr.success(data.msg);
                            }
                        },'json');
                    }
                })
            }
        });




        });

</script>
@endsection

@endsection
