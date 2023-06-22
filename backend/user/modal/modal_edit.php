<div class="modal fade bd-example-modal-xl" id="modelUserEdit" tabindex="-1" data-backdrop="static" role="dialog"
    aria-labelledby="modelEditLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content w3-flat-turquoise">
            <div class="modal-header"
                style="color:white;background : linear-gradient(to right, #61398F, #8B5FBF);text-shadow:2px 2px 4px #000000;">
                <h5 class="modal-title"><i class="fa fa-users" aria-hidden="true"></i> แก้ไขผู้ใช้งาน</h5>
            </div>
            <form name="frmEditUser" id="frmEditUser" method="POST" style="padding:10px;" action="javascript:void(0);">
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-lg-5 col-12">
                            <label class="col-form-label">User</label>
                            <input type="text" class="form-control" name="editusername" id="editusername">
                        </div>
                        <div class="form-group col-lg-5 col-12">
                            <label class="col-form-label">Password</label>
                            <input type="password" class="form-control" name="password" id="password" required disabled>
                        </div>
                        <div class="form-group col-lg-2 col-12">
                            <label class="col-form-label">รีเซ็ต Password</label>
                            <button type="button" class="btn btn-secondary form-control" data-toggle="modal"
                                data-target="#modal_reset" data-dismiss="modal">Reset</button>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-6">
                            <label class="col-form-label">ชื่อจริง</label>
                            <input type="text" class="form-control" name="editfirstname" id="editfirstname">
                        </div>

                        <div class="col-md-6">
                            <label class="col-form-label">ชื่อสกุล</label>
                            <input type="text" class="form-control" name="editlastname" id="editlastname">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-md-6">
                            <label class="col-form-label">ประเภท</label>
                            <select class="form-control" name="edittype" id="edittype">
                                <option value="ฝ่ายขาย">ฝ่ายขาย</option>
                                <option value="ฝ่ายจัดการ">ฝ่ายจัดการ</option>
                                <option value="Admin">Admin</option>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="col-form-label">Status</label>
                            <select class="form-control" name="editstatus" id="editstatus">
                                <option value="Y">Y</option>
                                <option value="N">N</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-12">
                            <label class="col-form-label">Email</label>
                            <input type="text" class="form-control" name="editemail" id="editemail">
                        </div>
                    </div>


                    <!-- <div class="form-group col-md-6">
                                <label for="inputEmail4">Money</label>
                                <input type="text" class="form-control" name="lastname" id="lastname" disabled>
                            </div> -->



                    <input type="hidden" class="form-control" name="code" id="code">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn"
                        style="color:white;background : #BFACE2;text-shadow:2px 2px 4px #000000;"
                        data-dismiss="modal">ปิด</button>
                    <button type="submit" form="frmEditUser" class="btn"
                        style="color:white;background :  #7e57c2;text-shadow:2px 2px 4px #000000;">แก้ไข</button>
                </div>
            </form>
        </div>
    </div>
</div>