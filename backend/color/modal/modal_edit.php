<div class="modal fade bd-example-modal-xl" tabindex="-1" id="modal_edit" role="dialog" data-backdrop="static"
    aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content w3-flat-turquoise">
            <div class="modal-header"
                style="color:white;background : linear-gradient(to right, #61398F, #8B5FBF); text-shadow:2px 2px 4px #000000;">
                <h5 class="modal-title">แก้ไขสีสินค้า</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form name="frmEditColor" id="frmEditColor" method="POST" style="padding:10px;"
                action="javascript:void(0);">
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-lg-6 col-12">
                            <label class="col-form-label">ชื่อสี </label>
                            <input type="text" class="form-control" name="clname" id="clname" required>
                        </div>
                        <div class="form-group col-lg-6 col-12">
                            <label class="col-form-label">หมวดสินค้า </label>
                            <select class="form-control" name="grcode" id="grcode" required>
                                <?php 
                                            
                                        	$sql = "SELECT * FROM `group` where status = 'Y' ";
                                            $query = mysqli_query($conn,$sql);
                                        
                                            while($row = $query->fetch_assoc()) {
                                                echo '<option value="'.$row["grcode"].'">'.$row["grname"].'</option>';
                                            }
                                    ?>
                            </select>
                        </div>

                    </div>
                    <div class="row">
                        <div class="form-group col-lg-6 col-12">
                            <label class="col-form-label">สถานะการใช้งาน</label>
                            <select class="form-control" name="status" id="status">

                                <option value="Y">เปิดการใช้งาน</option>
                                <option value="N">ปิดการใช้งาน</option>

                            </select>
                        </div>
                    </div>


                    <hr>
                    <input type="hidden" id="clcode" name="clcode">
                </div>
                <div class="modal-footer">
                    <div class="col text-center">
                        <button type="button" class="btn" data-dismiss="modal"
                            style="color:white;background : #BFACE2;text-shadow:2px 2px 4px #000000;">ปิด</button>
                        <button type="submit" form="frmEditColor" class="btn"
                            style="color:white;background :  #7e57c2;text-shadow:2px 2px 4px #000000;">แก้ไข</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>