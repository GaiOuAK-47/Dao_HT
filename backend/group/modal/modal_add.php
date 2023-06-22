<div class="modal fade bd-example-modal-xl" tabindex="-1" id="modal_add" role="dialog" data-backdrop="static"
    aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content w3-flat-turquoise">
            <div class="modal-header "
                style="color:white;background : linear-gradient(to right, #61398F, #8B5FBF);text-shadow:2px 2px 4px #000000;">
                <h5 class="modal-title">เพิ่มหมวดสินค้า</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form name="frmAddGroup" id="frmAddGroup" method="POST" style="padding:10px;"
                    action="javascript:void(0);">
                    <div class="row">
                        <div class="form-group col-lg-9 col-12">
                            <label class="col-form-label">ชื่อหมวดสินค้า </label>
                            <input type="text" class="form-control" name="add_grname" id="add_grname" required>
                        </div>
                        <div class="form-group col-lg-3 col-12">
                            <label class="col-form-label">รหัสนำหน้าของรหัสสินค้า </label>
                            <input type="text" class="form-control" name="add_grprecode" id="add_grprecode"
                                minlength="3" maxlength="3" required>
                        </div>
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <div class="col text-center">
                    <button type="button" class="btn" data-dismiss="modal"
                        style="color:white;background : #BFACE2;text-shadow:2px 2px 4px #000000;">ปิด</button>
                    <button type="submit" form="frmAddGroup" class="btn"
                        style="color:white;background : #7e57c2;text-shadow:2px 2px 4px #000000;">เพิ่ม</button>
                </div>
            </div>
        </div>
    </div>
</div>