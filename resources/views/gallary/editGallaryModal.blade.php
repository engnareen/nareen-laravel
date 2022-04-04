<div class="modal fade editGallaryModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"
    data-keyboard="false" data-backdrop="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title"><i style="padding-right:7px" class="fas fa-user-edit"></i>Edit Photo</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('update.gallary')}}" id="update_form" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="t_id">


                    <div class="form-group">
                        <label style="font-weight:bold" for="">Photo Description</label>
                        <textarea name="details" class="form-control" placeholder="Enter description" id="" cols="30" rows="10"></textarea>
                        <span class="text-danger error-text details_error"></span>
                    </div>

                    <div class="form-group">
                        <label for="">Upload Photo<button id="clear_image" type="button" class="btn btn-danger btn-sm">Clear</button></label>
                        <input type="file" name="image" class="form-control" data-value="">
                        <span class="text-danger error-text image_error"></span>

                    </div>
                    <div class="image-holder-update"></div>

                    <button type="submit" class="btn btn-primary">Save changes</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </form>
            </div>
            {{-- <div class="modal-footer">

            </div> --}}
        </div>
    </div>
</div>
