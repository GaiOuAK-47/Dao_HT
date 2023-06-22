<div class="modal fade bd-example-modal-xl" tabindex="-1" id="modal_reset" data-backdrop="static" role="dialog"
    aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content w3-flat-turquoise">
            <div class="modal-header"
                style="color:white;background : linear-gradient(to right, #61398F, #8B5FBF);text-shadow:2px 2px 4px #000000;">
                <h5 class="modal-title">Reset Password</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form name="frmReset" id="frmReset" method="POST" style="padding:10px;" action="javascript:void(0);">
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-lg-6 col-12">
                            <label class="col-form-label">ชื่อ</label>
                            <input type="text" class="form-control" name="resetfirstname" id="resetfirstname" required
                                disabled>
                        </div>
                        <div class="form-group col-lg-6 col-12">
                            <label class="col-form-label">นามสกุล</label>
                            <input type="text" class="form-control" name="resetlastname" id="resetlastname" required
                                disabled>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-lg-12 col-12">
                            <label class="col-form-label">Password ใหม่</label>
                            <input type="text" class="form-control" name="editpassword" id="editpassword" required>
                        </div>
                    </div>
                    <input type="hidden" id="perresetcode" name="perresetcode">
                    <div class="modal-footer">
                        <div class="col text-center">
                            <button type="button" class="btn" data-dismiss="modal"
                                style="color:white;background : #BFACE2;">ปิด</button>
                            <button type="submit" id="btnReset" form="frmReset" class="btn"
                                style="color:white;background :  #7e57c2;">รีเซ็ต</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>