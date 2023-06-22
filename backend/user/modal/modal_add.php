<div class="modal fade bd-example-modal-xl" id="modal_add" tabindex="-1" role="dialog" data-backdrop="static"
    aria-labelledby="" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content w3-flat-turquoise">
            <div class="modal-header"
                style="color:white;background : linear-gradient(to right, #61398F, #8B5FBF);text-shadow:2px 2px 4px #000000;">
                <h5 class="modal-title"><i class="fa fa-users" aria-hidden="true"></i> เพิ่มผู้ใช้งาน</h5>
            </div>
            <form name="frmAddUser" id="frmAddUser" action="" method="post">
                <div class="modal-body">
                    <div class="form-row">
                        <div class="col-md-6">
                            <label class="col-form-label">User</label>
                            <input type="text" class="form-control" name="userusername" id="userusername" required>
                        </div>

                        <div class="form-group col-md-6">
                            <label class="col-form-label">Password</label>
                            <input type="password" class="form-control" name="userpassword" id="userpassword" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-6">

                            <label class="col-form-label">ชื่อจริง</label>
                            <input type="text" class="form-control" name="userfirstname" id="userfirstname" required>
                        </div>

                        <div class="col-md-6">
                            <label class="col-form-label">นามสกุล</label>
                            <input type="text" class="form-control" name="userlastname" id="userlastname" required>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-md-6">
                            <label class="col-form-label">ประเภท</label>
                            <select class="form-control" name="usertype" id="usertype">
                                <option value="ฝ่ายขาย">ฝ่ายขาย</option>
                                <option value="ฝ่ายจัดการ">ฝ่ายจัดการ</option>
                                <option value="Admin">Admin</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="col-form-label">เบอร์โทรศัพท์</label>
                            <input type="text" class="form-control" name="usertel" id="usertel">
                        </div>

                    </div>


                    <div class="form-row">
                        <div class="col-md-12">
                            <label class="col-form-label">Email</label>
                            <input type="email" class="form-control" name="useremail" id="useremail">
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn"
                        style="color:white;background : #BFACE2;text-shadow:2px 2px 4px #000000;"
                        data-dismiss="modal">ปิด</button>
                    <input type="submit" class="btn"
                        style="color:white;background :  #7e57c2;text-shadow:2px 2px 4px #000000;" value="เพิ่ม">
                </div>
            </form>

        </div>
    </div>
</div>