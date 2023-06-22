<div class="modal fade bd-example-modal-xl" tabindex="-1" id="modal_add" role="dialog" data-backdrop="static"
    aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content w3-flat-turquoise">
            <div class="modal-header"
                style="color:white;background : linear-gradient(to right, #61398F, #8B5FBF);text-shadow:2px 2px 4px #000000;">
                <h5 class="modal-title">เพิ่ม Unit</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form name="frmAddUnit" id="frmAddUnit" method="POST" style="padding:10px;"
                    action="javascript:void(0);">
                    <div class="form-row">
                        <div class="col-md-6">
                            <label class="col-form-label">ชื่อ Unit </label>
                            <input type="text" class="form-control" name="add_unit" id="add_unit" required>
                        </div>
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <div class="col text-center">
                    <button type="button" class="btn"
                        style="color:white;background : #BFACE2;text-shadow:2px 2px 4px #000000;"
                        data-dismiss="modal">ปิด</button>
                    <button type="submit" form="frmAddUnit"
                        style="color:white;background :  #7e57c2;text-shadow:2px 2px 4px #000000;"
                        class="btn">เพิ่ม</button>
                </div>
            </div>
        </div>
    </div>
</div>