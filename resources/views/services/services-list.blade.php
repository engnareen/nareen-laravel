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
                    <div class="card-header" style="font-weight:bold"><i style="padding-right:7px" class="fas fa-plus-circle"></i>ADD NEW SERVICE</div>
                    <div class="card-body">
                        <form action="{{ route('add.service') }}" method="post" id="add-service-form" autocomplete="off">
                            @csrf
                            <div class="form-group">
                                <label style="font-weight:bold" for="">Service name</label>
                                <input type="text" class="form-control" name="service_name" placeholder="Enter service name">
                                <span class="text-danger error-text service_name_error"></span>
                            </div>
                            <div class="form-group">
                                <label style="font-weight:bold" for="">Service ICON</label>
                                <input type="text" class="form-control" name="service_icon" placeholder="Enter service icon">
                                <span class="text-danger error-text service_icon_error"></span>
                            </div>
                            <div class="form-group">
                                <label style="font-weight:bold" for="">Details</label>
                                <textarea id="" class="form-control" name="details" placeholder="Enter Details" cols="30" rows="10"></textarea>
                                <span class="text-danger error-text details_error"></span>
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
                    <div class="card-header" style="font-weight: bold"><i style="padding-right:7px" class="fab fa-servicestack"></i>SERVICES</div>
                    <div class="card-body">
                        <table class="table table-hover table-condensed" id="services-table">
                            <thead>
                                <th><input type="checkbox" name="main_checkbox"><label></label></th>
                                <th>#</th>
                                <th>Service name</th>
                                <th>Actions <button class="btn btn-sm btn-danger d-none" id="deleteAllBtn">Delete All</button></th>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>

</div>

@include('services.edit-service-modal')

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

            //ADD NEW Service
            $('#add-service-form').on('submit', function(e){
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
                            $('#services-table').DataTable().ajax.reload(null, false);
                            toastr.success(data.msg);
                            }
                        }
                });
            });

            //GET ALL SERVICES
            var table =  $('#services-table').DataTable({
                    processing:true,
                    info:true,
                    ajax:"{{ route('get.services.list') }}",
                    "pageLength":5,
                    "aLengthMenu":[[5,10,25,50,-1],[5,10,25,50,"All"]],
                    columns:[
                    //  {data:'id', name:'id'},
                        {data:'checkbox', name:'checkbox', orderable:false, searchable:false},
                        {data:'DT_RowIndex', name:'DT_RowIndex'},
                        {data:'service_name', name:'service_name'},
                        {data:'actions', name:'actions', orderable:false, searchable:false},
                    ]
            }).on('draw', function(){
                $('input[name="service_checkbox"]').each(function(){this.checked = false;});
                $('input[name="main_checkbox"]').prop('checked', false);
                $('button#deleteAllBtn').addClass('d-none');
            });

            $(document).on('click','#editServiceBtn', function(){
                var service_id = $(this).data('id');
                $('.editService').find('form')[0].reset();
                $('.editService').find('span.error-text').text('');
                $.post('<?= route("get.service.details") ?>',{service_id:service_id}, function(data){
                    $('.editService').find('input[name="cid"]').val(data.details.id);
                    $('.editService').find('input[name="service_name"]').val(data.details.service_name);
                    $('.editService').find('input[name="service_icon"]').val(data.details.service_icon);
                    $('.editService').find('textarea[name="details"]').val(data.details.details);
                    $('.editService').modal('show');
                },'json');
            });


            //UPDATE Service DETAILS
            $('#update-service-form').on('submit', function(e){
                e.preventDefault();
                var form = this;
                $.ajax({
                    url:$(form).attr('action'),
                    method:$(form).attr('method'),
                    data:new FormData(form),
                    processData:false,
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
                                $('#services-table').DataTable().ajax.reload(null, false);
                                $('.editService').modal('hide');
                                $('.editService').find('form')[0].reset();
                                toastr.success(data.msg);
                            }
                    }
                });
            });

            //DELETE SERVICE RECORD
            $(document).on('click','#deleteServiceBtn', function(){
                var service_id = $(this).data('id');
                var url = '<?= route("delete.service") ?>';

                swal.fire({
                        title:'Are you sure?',
                        html:'You want to <b>delete</b> this service',
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
                            $.post(url,{service_id:service_id}, function(data){
                                if(data.code == 1){
                                    $('#services-table').DataTable().ajax.reload(null, false);
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
                $('input[name="service_checkbox"]').each(function(){
                    this.checked = true;
                });
                }else{
                    $('input[name="service_checkbox"]').each(function(){
                        this.checked = false;
                    });
                }
                toggledeleteAllBtn();
        });

        $(document).on('change','input[name="service_checkbox"]', function(){

            if( $('input[name="service_checkbox"]').length == $('input[name="service_checkbox"]:checked').length ){
                $('input[name="main_checkbox"]').prop('checked', true);
            }else{
                $('input[name="main_checkbox"]').prop('checked', false);
            }
            toggledeleteAllBtn();
        });


        function toggledeleteAllBtn(){
            if( $('input[name="service_checkbox"]:checked').length > 0 ){
                $('button#deleteAllBtn').text('Delete ('+$('input[name="service_checkbox"]:checked').length+')').removeClass('d-none');
            }else{
                $('button#deleteAllBtn').addClass('d-none');
            }
        }


        $(document).on('click','button#deleteAllBtn', function(){
            var checkedServices = [];
            $('input[name="service_checkbox"]:checked').each(function(){
                checkedServices.push($(this).data('id'));
            });

            var url = '{{ route("delete.selected.services") }}';
            if(checkedServices.length > 0){
                swal.fire({
                    title:'Are you sure?',
                    html:'You want to delete <b>('+checkedServices.length+')</b> services',
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
                        $.post(url,{services_ids:checkedServices},function(data){
                            if(data.code == 1){
                                $('#services-table').DataTable().ajax.reload(null, true);
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
