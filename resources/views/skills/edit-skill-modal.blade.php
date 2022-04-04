<div class="modal fade editSkill" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="font-weight:bold" class="modal-title" id="exampleModalLabel"><i style="padding-right:7px" class="fa fa-edit"></i>Edit Skills</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                    <form action="<?= route('update.skill.details') ?>" method="post" id="update-skill-form">
                    @csrf
                        <input type="hidden" name="cid">
                        <div class="form-group">
                            <label style="font-weight:bold" for="">Skill Name</label>
                            <input type="text" class="form-control" name="name" placeholder="Enter skill name">
                            <span class="text-danger error-text name_error"></span>
                        </div>
                        <div class="form-group">
                            <label style="font-weight:bold" for="">Skill Range</label>
                            <input type="range" class="form-control" name="range">
                            <span class="text-danger error-text range_error"></span>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-block btn-primary">Save Changes</button>
                        </div>
                    </form>


            </div>
        </div>
    </div>
    </div>
