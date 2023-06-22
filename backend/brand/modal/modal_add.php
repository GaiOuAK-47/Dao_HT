<div class="modal fade bd-example-modal-xl" tabindex="-1" id="modal_add" role="dialog" data-backdrop="static"
    aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content w3-flat-turquoise">
            <div class="modal-header"
                style="color:white;background : linear-gradient(to right, #61398F, #8B5FBF);text-shadow:2px 2px 4px #000000;">
                <h5 class="modal-title">เพิ่มแบรนด์สินค้า</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form name="frmAddBrand" id="frmAddBrand" method="POST" style="padding:10px;"
                    action="javascript:void(0);">
                    <div class="form-row">
                        <div class="col-md-6">
                            <label class="col-form-label">ชื่อแบรนด์สินค้า </label>
                            <input type="text" class="form-control" name="add_bdname" id="add_bdname" required>
                        </div>
                        <div class="col-md-6">
                            <label class="col-form-label">หมวดสินค้า</label>
                            <select class="form-control" name="add_grcode" id="add_grcode" required>
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

                </form>
            </div>
            <div class="modal-footer">
                <div class="col text-center">
                    <button type="button" class="btn"
                        style="color:white;background :#BFACE2; text-shadow:2px 2px 4px #000000;"
                        data-dismiss="modal">ปิด</button>
                    <button type="submit" form="frmAddBrand" class="btn"
                        style="color:white;background :  #7e57c2; text-shadow:2px 2px 4px #000000;">เพิ่ม</button>
                </div>
            </div>
        </div>
    </div>
</div>