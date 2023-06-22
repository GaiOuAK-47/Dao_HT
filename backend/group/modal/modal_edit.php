<div class="modal fade bd-example-modal-xl" tabindex="-1" id="modal_edit" role="dialog" data-backdrop="static"
    aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content w3-flat-turquoise">
            <div class="modal-header"
                style="color:white;background : linear-gradient(to right, #61398F, #8B5FBF);text-shadow:2px 2px 4px #000000;">
                <h5 class="modal-title">แก้ไขหมวดสินค้า</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form name="frmEditGroup" id="frmEditGroup" method="POST" style="padding:10px;"
                action="javascript:void(0);">
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-lg-6 col-12">
                            <label class="col-form-label">ชื่อหมวดสินค้า</label>
                            <input type="text" class="form-control" name="grname" id="grname" required>
                        </div>
                        <div class="form-group col-lg-3 col-12">
                            <label class="col-form-label">รหัสนำหน้าของรหัสสินค้า </label>
                            <input type="text" class="form-control" name="grprecode" id="grprecode" minlength="3"
                                maxlength="3" required>
                        </div>
                        <div class="form-group col-lg-3 col-12">
                            <label class="col-form-label">สถานะการใช้งาน</label>
                            <select class="form-control" name="status" id="status">

                                <option value="Y">เปิดการใช้งาน</option>
                                <option value="N">ปิดการใช้งาน</option>

                            </select>
                        </div>
                    </div>


                    <hr>
                    <input type="hidden" id="grcode" name="grcode">
                </div>
                <div class="modal-footer">
                    <div class="col text-center">
                        <button type="button" class="btn "
                            style="color:white;background : #BFACE2;text-shadow:2px 2px 4px #000000;"
                            data-dismiss="modal">ปิด</button>
                        <button type="submit" form="frmEditGroup" class="btn"
                            style="color:white;background : #7e57c2;text-shadow:2px 2px 4px #000000;">แก้ไข</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>