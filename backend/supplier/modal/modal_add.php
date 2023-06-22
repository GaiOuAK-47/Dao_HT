<div class="modal fade bd-example-modal-xl" tabindex="-1" id="modal_add" role="dialog" data-backdrop="static"
    aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content w3-flat-turquoise">
            <div class="modal-header"
                style="color:white;background : linear-gradient(to right, #61398F, #8B5FBF);text-shadow:2px 2px 4px #000000;">
                <h5 class="modal-title">เพิ่มผู้ขาย</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form name="frmAddSupplier" id="frmAddSupplier" method="POST" style="padding:10px;"
                    action="javascript:void(0);">
                    <div class="row">
                        <div class="form-group col-lg-3 col-12">
                            <label for="recipient-name" class="col-form-label">รหัสผู้ขาย</label>
                            <input type="text" class="form-control" name="add_supcode" id="add_supcode" minlength="3"
                                maxlength="4" readonly>
                        </div>
                        <div class="form-group col-lg-9 col-12">
                            <label for="recipient-name" class="col-form-label">ชื่อผู้ขาย</label>
                            <input type="text" class="form-control" name="add_supname" id="add_supname" required>
                        </div>

                        <div class="form-group col-lg-6 col-12">
                            <label for="recipient-name" class="col-form-label">เลขที่</label>
                            <input type="text" class="form-control" name="add_idno" id="add_idno">
                        </div>

                        <div class="form-group col-lg-3 col-12">
                            <label for="recipient-name" class="col-form-label">ถนน</label>
                            <input type="text" class="form-control" name="add_road" id="add_road">
                        </div>

                        <div class="form-group col-lg-3 col-12">
                            <label for="recipient-name" class="col-form-label">ตำบล</label>
                            <input type="text" class="form-control" name="add_subdistrict" id="add_subdistrict">
                        </div>

                        <div class="form-group col-lg-3 col-12">
                            <label for="recipient-name" class="col-form-label">อำเภอ</label>
                            <input type="text" class="form-control" name="add_district" id="add_district">
                        </div>

                        <div class="form-group col-lg-3 col-12">
                            <label for="recipient-name" class="col-form-label">จังหวัด</label>
                            <select class="form-control" name="add_province" id="add_province">
                                <?php getProvince();?>
                            </select>
                        </div>

                        <div class="form-group col-lg-3 col-12">
                            <label for="recipient-name" class="col-form-label">รหัสไปรษณีย์</label>
                            <input type="text" class="form-control" name="add_zipcode" id="add_zipcode">
                        </div>

                        <div class="form-group col-lg-3 col-12">
                            <label for="recipient-name" class="col-form-label">เบอร์โทรศัพท์</label>
                            <input type="text" class="form-control" name="add_tel" id="add_tel">
                        </div>

                        <div class="form-group col-lg-3 col-12">
                            <label for="recipient-name" class="col-form-label">เบอร์แฟ็ค</label>
                            <input type="text" class="form-control" name="add_fax" id="add_fax">
                        </div>

                        <div class="form-group col-lg-3 col-12">
                            <label for="recipient-name" class="col-form-label">เลขผู้เสียภาษี</label>
                            <input type="text" class="form-control" name="add_taxnumber" id="add_taxnumber">
                        </div>

                        <div class="form-group col-lg-3 col-12">
                            <label for="recipient-name" class="col-form-label">Email</label>
                            <input type="text" class="form-control" name="add_email" id="add_email">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <div class="col text-center">
                    <button type="button" class="btn"
                        style="color:white;background : #BFACE2;text-shadow:2px 2px 4px #000000;"
                        data-dismiss="modal">ปิด</button>
                    <button type="submit"class="btn" id="frmAddSupplier" form="frmAddSupplier" 
                        style="color:white;background :  #7e57c2;text-shadow:2px 2px 4px #000000;"><i
                                class="fas fa-user-plus" aria-hidden="true"></i> เพิ่ม</button>
                </div>
            </div>
        </div>
    </div>
</div>