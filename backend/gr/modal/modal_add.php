<div class="modal fade bd-example-modal-xl" tabindex="-1" id="modal_add" role="dialog" data-backdrop="static"
    aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable  modal-xl">
        <div class="modal-content w3-flat-turquoise" style="overflow-y: auto;">
            <div style="color:white;background : linear-gradient(to right, #61398F, #8B5FBF); text-shadow:2px 2px 4px #000000;"
                class="modal-header">
                <h5 class="modal-title">เพิ่มใบรับสินค้า</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form name="frmAddGR" id="frmAddGR" method="POST" style="padding:10px;" action="javascript:void(0);">
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-lg-2 col-12">
                            <label for="recipient-name" class="col-form-label">เลขที่ GR</label>
                            <input type="text" class="form-control" name="add_grcode" id="add_grcode" maxlength="50"
                            readonly>
                        </div>
                        <div class="form-group col-lg-4 col-12">
                            <label class="col-form-label">รหัสผู้ขาย</label>
                            <div class="input-group">
                                <input type="text" class="form-control" name="add_supcode" id="add_supcode" required>
                                <span class="input-group-btn">
                                    <button class="btn btn-default" data-toggle="modal" data-target="#modal_supplier"
                                        type="button"><span class="fa fa-search"></span></button>
                                </span>
                            </div>
                        </div>
                        <div class="form-group col-lg-6 col-12">
                            <label for="recipient-name" class="col-form-label">ชื่อผู้ขาย</label>
                            <input type="text" class="form-control" name="add_supname" id="add_supname" readonly>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-lg-12 col-12">
                            <label for="recipient-name" class="col-form-label">ที่อยู่ผู้ขาย</label>
                            <input type="text" class="form-control" name="add_address" id="add_address" readonly>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-lg-4 col-12">
                            <label for="recipient-name" class="col-form-label">วันที่รับสินค้า</label>
                            <input type="date" class="form-control" name="add_grdate" id="add_grdate" required>
                        </div>
                        <div class="form-group col-lg-4 col-12">
                            <label for="recipient-name" class="col-form-label">เลขที่ Invoice</label>
                            <input type="text" class="form-control" name="add_invcode" id="add_invcode">
                        </div>
                        <div class="form-group col-lg-4 col-12">
                            <label for="recipient-name" class="col-form-label">วันที่ออก Invoice</label>
                            <input type="date" class="form-control" name="add_invdate" id="add_invdate" required>
                        </div>

                    </div>
                    <div class="row">
                        <div class="form-group col-lg-4 col-12">
                            <label for="recipient-name" class="col-form-label">การชำระเงิน</label>
                            <select class="form-control" name="add_payment" id="add_payment" required>
                                <option value="เงินสด" selected>เงินสด</option>
                                <option value="30 วัน">30 วัน</option>
                                <option value="45 วัน">45 วัน</option>
                                <option value="60 วัน">60 วัน</option>
                                <option value="90 วัน">90 วัน</option>
                                <option value="120 วัน">120 วัน</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group col-md-12">
                        <button type="button" id="btnGetPO" class="btn btn-success"><i class="fas fa-clone"
                                aria-hidden="true"></i>
                            เพิ่มรายการ</button>
                        <button type="button" id="btnClearGRdetail" style="display:none;" class="btn btn-danger"
                            onClick="onDeleteDetail('tableGRDetail','btnClearGRdetail');"><i class="	fas fa-times"
                                aria-hidden="true"></i>
                            ลบรายการ</button>

                    </div>
                    <div class="table-responsives overflow-auto ">
                        <table name="tableGRDetail" id="tableGRDetail"
                            class="table table-striped table-valign-middle table-bordered table-hovers text-nowarp">
                            <thead class="sticky-top table-defalut bg-gray">
                                <tr>
                                    <th style="text-align:center">ลำดับ</th>
                                    <th style="text-align:left">ใบสั่งซื้อ</th>
                                    <th style="text-align:center">รหัสสินค้า</th>
                                    <th style="width:300px;text-align:left">รายการสินค้า</th>
                                    <th style="width:100px;text-align:center">หน่วย</th>
                                    <th style="text-align:center">จำนวนรับแล้ว</th>
                                    <th style="text-align:center">จำนวนรับ</th>
                                    <th style="width:120px;text-align:center">สถานะ</th>
                                </tr>
                            </thead>
                            <tbody class="text-nowrap">


                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="col text-center">
                        <button type="button" class="btn"
                          s  style="color:white;background : #BFACE2; text-shadow:2px 2px 4px #000000;"
                            data-dismiss="modal">ปิด</button>
                        <button type="submit" form="frmAddGR" class="btn "
                            style="color:white;background : #7e57c2; text-shadow:2px 2px 4px #000000;">เพิ่ม</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>