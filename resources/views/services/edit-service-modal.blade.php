<div class="modal fade editService" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="font-weight:bold" class="modal-title" id="exampleModalLabel"><i style="padding-right:7px" class="fa fa-edit"></i>Edit Service</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                    <form action="<?= route('update.service.details') ?>" method="post" id="update-service-form">
                    @csrf
                        <input type="hidden" name="cid">
                        <div class="form-group">
                            <label style="font-weight:bold" for="">Service Name</label>
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
                            <textarea name="details" class="form-control" id="" cols="30" rows="10" placeholder="Enter Details"></textarea>
                            {{-- <input type="text" class="form-control" name="details" placeholder="Enter Details"> --}}
                            <span class="text-danger error-text details_error"></span>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-block btn-primary">Save Changes</button>
                        </div>
                    </form>


            </div>
        </div>
    </div>
    </div>
