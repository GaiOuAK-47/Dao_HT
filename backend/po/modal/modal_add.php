<div class="modal fade bd-example-modal-xl" tabindex="-1" id="modal_add" role="dialog" data-backdrop="static"
    aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-xl">
        <div class="modal-content w3-flat-turquoise" style="overflow-y: auto;">
            <div class="modal-header"
                style="color:white;background : linear-gradient(to right, #61398F, #8B5FBF); text-shadow:2px 2px 4px #000000;">
                <h5 class="modal-title">เพิ่มใบสั่งซื้อสินค้า</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form name="frmAddPO" id="frmAddPO" method="POST" style="padding:10px;" action="javascript:void(0);">
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-lg-2 col-12">
                            <label for="recipient-name" class="col-form-label">เลขที่ PO</label>
                            <input type="text" class="form-control" name="add_pocode" id="add_pocode" maxlength="50"
                            readonly>
                        </div>
                        <div class="form-group col-lg-4 col-12">
                            <label class="col-form-label">รหัสผู้ขาย</label>
                            <div class="input-group">
                                <input type="text" class="form-control" name="add_supcode" id="add_supcode" required>
                                <span class="input-group-append">
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
                            <label for="recipient-name" class="col-form-label">วันที่สั่งซื้อ</label>
                            <input type="date" class="form-control" name="add_podate" id="add_podate" required>
                        </div>
                        <div class="form-group col-lg-4 col-12">
                            <label for="recipient-name" class="col-form-label">วันที่นัดส่งของ</label>
                            <input type="date" class="form-control" name="add_deldate" id="add_deldate" required>
                        </div>
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
                    <div class="row">
                        <div class="form-group col-lg-4 col-12">
                            <label for="recipient-name" class="col-form-label">ใบเสนอราคา</label>
                            <input type="text" class="form-control" name="add_poqua" id="add_poqua">
                        </div>
                        <div class="form-group col-lg-4 col-12">
                            <label for="recipient-name" class="col-form-label">สกุลเงิน</label>
                            <select class="form-control" name="add_currency" id="add_currency" required>
                                <option value="บาท" selected>บาท</option>
                                <option value="ดอลล่า">ดอลล่า</option>
                                <option value="เยน">เยน</option>
                            </select>
                        </div>
                        <div class="form-group col-lg-4 col-12">
                            <label for="recipient-name" class="col-form-label">ภาษี</label>
                            <div class="radio form-group clearfix d-flex">
                                <div class="icheck-primary d-inline px-3">
                                    <input type="radio" id="radioPrimary1" name="add_vat" value="Y" checked>
                                    <label for="radioPrimary1">มี</label>
                                </div>
                                <div class="icheck-primary d-inline px-3">
                                    <input type="radio" id="radioPrimary2" name="add_vat" value="N" />
                                    <label for="radioPrimary2">ไม่มี</label>
                                </div>
                                <!-- <label class="radio-inline">
                                    <input type="radio" name="add_vat" value="Y" checked> มี
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="add_vat" value="N"> ไม่มี
                                </label> -->
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <div class="form-group">
                                <label class="col-form-label">หมายเหตุ :</label>
                                <textarea class="form-control" value="" name="add_remark" id="add_remark"
                                    style="height: 10vh; max-height: 10vh; min-height: 10vh;"
                                    placeholder="กรอกหมายเหตุ"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-md-12">
                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal_stock"><i
                                class="	fas fa-cart-plus" aria-hidden="true"></i>
                            เพิ่มสินค้า
                        </button>
                    </div>
                    <div class="table-responsives overflow-auto ">
                        <table name="tablePoDetail" id="tablePoDetail"
                            class="table table-striped table-valign-middle table-bordered table-hovers text-nowarp">
                            <thead class="sticky-top table-defalut bg-gray">
                                <tr>
                                    <th style="text-align:center">ลำดับ</th>
                                    <th style="text-align:left">รหัสสินค้า</th>
                                    <th style="text-align:left">รายการสินค้า</th>
                                    <th style="text-align:center">จำนวน</th>
                                    <th style="text-align:center">หน่วย</th>
                                    <th style="text-align:center">ราคาซื้อ</th>
                                    <th style="text-align:center">ส่วนลด</th>
                                    <th style="text-align:center">จำนวนเงิน</th>
                                    <th style="text-align:center"></th>
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
                            style="color:white;background : #BFACE2;;text-shadow:2px 2px 4px #000000;"
                            data-dismiss="modal">ปิด</button>
                        <button type="submit" form="frmAddPO" class="btn"
                            style="color:white;background :   #7e57c2;;text-shadow:2px 2px 4px #000000;">เพิ่ม</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>