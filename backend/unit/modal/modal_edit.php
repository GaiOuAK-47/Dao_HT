<div class="modal fade bd-example-modal-xl" tabindex="-1" id="modal_edit" role="dialog" data-backdrop="static"
    aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content w3-flat-turquoise">
            <div class="modal-header"
                style="color:white;background : linear-gradient(to right, #61398F, #8B5FBF);text-shadow:2px 2px 4px #000000;">
                <h5 class="modal-title">แก้ไขชื่อ Unit</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form name="frmEditUnit" id="frmEditUnit" method="POST" style="padding:10px;" action="javascript:void(0);">
                <div class="modal-body">
                    <div class="form-row">
                        <div class="col-md-6">
                            <label class="col-form-label">ชื่อ Unit </label>
                            <input type="text" class="form-control" name="unit" id="unit" required>
                        </div>
                        <div class="col-md-6">
                            <label class="col-form-label">สถานะการใช้งาน</label>
                            <select class="form-control" name="status" id="status">

                                <option value="Y">เปิดการใช้งาน</option>
                                <option value="N">ปิดการใช้งาน</option>

                            </select>
                        </div>
                    </div>


                    <hr>
                    <input type="hidden" id="unitcode" name="unitcode">
                </div>
                <div class="modal-footer">
                    <div class="col text-center">
                        <button type="button" class="btn" data-dismiss="modal"
                            style="color:white;background : #BFACE2;text-shadow:2px 2px 4px #000000;">ปิด</button>
                        <button type="submit" form="frmEditUnit" class="btn "
                            style="color:white;background : #7e57c2;text-shadow:2px 2px 4px #000000;">แก้ไข</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>