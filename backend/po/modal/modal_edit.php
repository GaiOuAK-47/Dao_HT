<div class="modal fade bd-example-modal-xl" tabindex="-1" id="modal_edit" role="dialog" data-backdrop="static" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-xl">
        <div class="modal-content w3-flat-turquoise" style="overflow-y: auto;">
            <div class="modal-header" style="color:white;background : linear-gradient(to right, #61398F, #8B5FBF);text-shadow:2px 2px 4px #000000;">
                <h5 class="modal-title">แก้ไขใบสั่งซื้อสินค้า</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form name="frmEditPO" id="frmEditPO" method="POST" style="padding:10px;" action="javascript:void(0);">
                    <div class="form-group col-md-12">
                        <button type="button" id="btnPrintPO" class="btn btn-primary"><i class="fa fa-print" aria-hidden="true"></i> ปริ้นใบสั่งซื้อ</button>
                        <button type="button" id="btnCanclePO" class="btn btn-danger"><i class="fas fa-times-circle" aria-hidden="true"></i> ยกเลิกการสั่งซื้อ</button>
                    </div>
                    <div class="row">
                        <div class="form-group col-lg-2 col-12">
                            <label for="recipient-name" class="col-form-label">เลขที่ PO</label>
                            <input type="text" class="form-control" name="pocode" id="pocode" maxlength="50" readonly>
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
                            <label for="recipient-name" class="col-form-label">วันที่สั่งซื้อ</label>
                            <input type="date" class="form-control" name="podate" id="podate" required>
                        </div>
                        <div class="form-group col-lg-4 col-12">
                            <label for="recipient-name" class="col-form-label">วันที่นัดส่งของ</label>
                            <input type="date" class="form-control" name="deldate" id="deldate" required>
                        </div>
                        <div class="form-group col-lg-4 col-12">
                            <label for="recipient-name" class="col-form-label">การชำระเงิน</label>
                            <select class="form-control" name="payment" id="payment" required>
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
                            <input type="text" class="form-control" name="poqua" id="poqua">
                        </div>
                        <div class="form-group col-lg-4 col-12">
                            <label for="recipient-name" class="col-form-label">สกุลเงิน</label>
                            <select class="form-control" name="currency" id="currency" required>
                                <option value="บาท" selected>บาท</option>
                                <option value="ดอลล่า">ดอลล่า</option>
                                <option value="เยน">เยน</option>
                            </select>
                        </div>
                        <div class="form-group col-lg-4 col-12">
                            <label for="recipient-name" class="col-form-label">ภาษี</label>
                            <div class="radio form-group clearfix d-flex">
                                <div class="icheck-primary d-inline px-3">
                                    <input type="radio" id="radioEdit1" name="vat" value="Y" />
                                    <label for="radioEdit1">มี</label>
                                </div>
                                <div class="icheck-primary d-inline px-3">
                                    <input type="radio" id="radioEdit2" name="vat" value="N" />
                                    <label for="radioEdit2">ไม่มี</label>
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
                                <textarea class="form-control" value="" name="remark" id="remark" style="height: 10vh; max-height: 10vh; min-height: 10vh;" placeholder="กรอกหมายเหตุ"></textarea>
                            </div>
                        </div>
                    </div>
                    <ul class="nav nav-tabs" id="custom-content-below-tab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="custom-content-below-home-tab" data-toggle="pill" href="#custom-content-below-home" role="tab" aria-controls="custom-content-below-home" aria-selected="false">ใบเสร็จ</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="custom-content-below-profile-tab" data-toggle="pill" href="#custom-content-below-profile" role="tab" aria-controls="custom-content-below-profile" aria-selected="true">แนบไฟล์</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="custom-content-below-tabContent" >
                        <div class="tab-pane fade p-3  active show" id="custom-content-below-home" role="tabpanel" aria-labelledby="custom-content-below-home-tab">
                            <div class="card">
                                <div class="card-header border-0 w-100 d-flex align-items-center justify-content-between">
                                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal_stock"><i class="	fas fa-cart-plus" aria-hidden="true"></i>เพิ่มสินค้า</button>
                                    <!-- <button type="button" class="btn btn-info" onclick="openEditFile(event)"><i class="far fa-file-alt mr-2"></i>ไฟล์เอกสาร</button> -->
                                </div>
                                <div class="card-body table-responsives overflow-auto pt-0" style="max-height:36vh;">
                                    <div class="table-responsives overflow-auto ">
                                        <table name="tableEditPoDetail" id="tableEditPoDetail" class="table table-striped table-valign-middle table-bordered table-hovers text-nowarp">
                                            <thead class="position-sticky sticky-top table-defalut bg-gray">
                                                <tr>
                                                    <th style="text-align:center">ลำดับ</th>
                                                    <th style="text-align:left">รหัสสินค้า</th>
                                                    <th style="text-align:left">รายการสินค้า</th>
                                                    <th style="text-align:center">จำนวนสั่งซื้อ</th>
                                                    <th style="text-align:center">จำนวนรับแล้ว</th>
                                                    <th style="text-align:center">หน่วย</th>
                                                    <th style="text-align:center">ราคาซื้อ</th>
                                                    <th style="text-align:center">ส่วนลด</th>
                                                    <th style="text-align:center">จำนวนเงิน</th>
                                                </tr>
                                            </thead>
                                            <tbody></tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade p-3" id="custom-content-below-profile" role="tabpanel" aria-labelledby="custom-content-below-profile-tab">
                            <div class="section-attach-file">
                                <div class="card">
                                    <div class="card-header border-0 w-100 d-flex align-items-center justify-content-between">
                                        <h4 class="card-title col-6" style="font-size: 0.9rem; font-weight: 600;">รายการ
                                            ไฟล์แนบ</h4>
                                        <div class="card-tools col-6 text-right">
                                            <a href="#" class="btn btns-tool btn-sm btn-success" onclick="openMgnFile('#attachFileList')">
                                                <i class="fas fa-paperclip mr-2"></i>
                                                <span>แนบไฟล์เอกสาร</span>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="card-body table-responsives overflow-auto pt-0" style="max-height:36vh;">
                                        <table class="table table-striped table-valign-middle table-hovers" id="attachFileList">
                                            <thead class="table-white">
                                                <tr class="position-sticky sticky-top bg-gray">
                                                    <th style="width:75px;border:none;">ลำดับ</th>
                                                    <th style="min-width:100px;border:none;">หัวข้อไฟล์</th>
                                                    <th style="min-width:300px;border:none;">ไฟล์แนบ</th>
                                                    <th style="width:125px;border:none;">ตัวเลือก</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr class="bg-transparent">
                                                    <td colspan="4" align="left" class="bg-transparent border-0 text-secondary">ไม่มีข้อมูลไฟล์
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <div class="col text-center">
                    <button type="button" class="btn" style="color:white;background :  #BFACE2;;text-shadow:2px 2px 4px #000000;" data-dismiss="modal">ปิด</button>
                    <button type="submit" id="btnEditSo" form="frmEditPO" class="btn" style="color:white;background :  #7e57c2;;text-shadow:2px 2px 4px #000000;">แก้ไข</button>
                </div>
            </div>

        </div>
    </div>
</div>