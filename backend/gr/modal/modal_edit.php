<div class="modal fade bd-example-modal-xl" tabindex="-1" id="modal_edit" role="dialog" data-backdrop="static"
    aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-xl">
        <div class="modal-content w3-flat-turquoise" style="overflow-y: auto;">
            <div class="modal-header"
                style="color:white;background : linear-gradient(to right, #61398F, #8B5FBF); text-shadow:2px 2px 4px #000000;">
                <h5 class="modal-title">แก้ไขใบรับสินค้า</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form name="frmEditGR" id="frmEditGR" method="POST" style="padding:10px;" action="javascript:void(0);">
                <div class="modal-body">
                    <div class="form-group col-md-12">
                        <button type="button" id="btnPrintGR" class="btn btn-primary"><i class="fa fa-print"
                                aria-hidden="true"></i> ปริ้นใบรับสินค้า</button>
                        <button type="button" id="btnCancleGR" class="btn btn-danger"><i class="fas fa-times-circle"
                                aria-hidden="true"></i> ยกเลิกการรับสินค้า</button>


                    </div>
                    <div class="row">
                        <div class="form-group col-lg-2 col-12">
                            <label for="recipient-name" class="col-form-label">เลขที่ GR</label>
                            <input type="text" class="form-control" name="grcode" id="grcode" maxlength="50" readonly>
                        </div>
                        <div class="form-group col-lg-4 col-12">
                            <label class="col-form-label">รหัสผู้ขาย</label>
                            <input type="text" class="form-control" name="supcode" id="supcode" readonly>
                        </div>
                        <div class="form-group col-lg-6 col-12">
                            <label for="recipient-name" class="col-form-label">ชื่อผู้ขาย</label>
                            <input type="text" class="form-control" name="supname" id="supname" readonly>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-lg-12 col-12">
                            <label for="recipient-name" class="col-form-label">ที่อยู่ผู้ขาย</label>
                            <input type="text" class="form-control" name="address" id="address" readonly>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-lg-4 col-12">
                            <label for="recipient-name" class="col-form-label">วันที่รับสินค้า</label>
                            <input type="date" class="form-control" name="grdate" id="grdate" required>
                        </div>
                        <div class="form-group col-lg-4 col-12">
                            <label for="recipient-name" class="col-form-label">เลขที่ Invoice</label>
                            <input type="text" class="form-control" name="invcode" id="invcode">
                        </div>
                        <div class="form-group col-lg-4 col-12">
                            <label for="recipient-name" class="col-form-label">วันที่ออก Invoice</label>
                            <input type="date" class="form-control" name="invdate" id="invdate" required>
                        </div>

                    </div>
                    <div class="row">
                        <div class="form-group col-lg-4 col-12">
                            <label for="recipient-name" class="col-form-label">การชำระเงิน</label>
                            <select class="form-control" name="payment" id="payment" required>
                                <option value="เงินสด">เงินสด</option>
                                <option value="30 วัน">30 วัน</option>
                                <option value="45 วัน">45 วัน</option>
                                <option value="60 วัน">60 วัน</option>
                                <option value="90 วัน">90 วัน</option>
                                <option value="120 วัน">120 วัน</option>
                            </select>
                        </div>
                    </div>
                    <div class="table-responsives overflow-auto ">
                        <table name="tableEditGRDetail" id="tableEditGRDetail"
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
                            <tbody>


                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="col text-center">
                        <button type="button" class="btn"
                            style="color:white;background : #BFACE2; text-shadow:2px 2px 4px #000000;"
                            data-dismiss="modal">ปิด</button>
                        <button type="submit" form="frmEditGR" class="btn"
                            style="color:white;background : #7e57c2; text-shadow:2px 2px 4px #000000;">แก้ไข</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>