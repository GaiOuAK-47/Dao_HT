<div class="modal fade bd-example-modal-xl" tabindex="-1" id="modal_edit" role="dialog" data-backdrop="static"
    aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-xl">
        <div class="modal-content w3-flat-turquoise" style="overflow-y: auto;">
            <div class="modal-header"
                style="color:white;background : linear-gradient(to right, #61398F, #8B5FBF);font-size:20px;text-shadow:2px 2px 4px #000000;">
                <h5 class="modal-title">แก้ไขใบขายสินค้า</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form name="frmEditSO" id="frmEditSO" method="POST" style="padding:10px;" action="javascript:void(0);">
                <div class="modal-body">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="tabdetail-tab" data-toggle="tab" href="#tabdetail" role="tab"
                                aria-controls="tabdetail" aria-selected="true">รายละเอียดใบขายสินค้า</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="tabpayment-tab" data-toggle="tab" href="#tabpayment" role="tab"
                                aria-controls="tabpayment" aria-selected="false">เงื่อนไขการชำระเงิน</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="tabinstallment-tab" data-toggle="tab" href="#tabinstallment"
                                role="tab" aria-controls="tabinstallment" aria-selected="false">งวดการผ่อนชำระ</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="tabtotalre-tab" data-toggle="tab" href="#tabtotalre"
                                role="tab" aria-controls="tabtotalre" aria-selected="false">ใบเสร็จรับเงินทั้งหมด</a>
                        </li>                        
                    </ul>
                    <br>
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="tabdetail" role="tabpanel"
                            aria-labelledby="tabdetail-tab">
                            <div class="form-group col-md-12">
                                <button type="button" id="btnPrintSO" class="btn btn-primary"><i class="fa fa-print"
                                        aria-hidden="true"></i> ปริ้นใบขายสินค้า</button>
                                <button type="button" id="btnPrintInvoice" class="btn btn-primary"><i
                                        class="fa fa-print" aria-hidden="true"></i> ปริ้นใบกำกับภาษี</button>
                                <button type="button" id="btnConfirmDel" class="btn btn-success"><i
                                        class="fa fa fa-tags" aria-hidden="true"></i> ยืนยันส่งสินค้า</button>
                                <button type="button" id="btnCanclDel" class="btn btn-danger"><i class="fa fa fa-tags"
                                        aria-hidden="true"></i> ยกเลิกการส่งสินค้า</button>
                                <button type="button" id="btnCancleSOdetail" class="btn btn-danger"><i
                                        class="fa fa fa-tags" aria-hidden="true"></i> ยกเลิกการใบขายสินค้า</button>


                            </div>
                            <div class="row">
                                <div class="form-group col-lg-2 col-12">
                                    <label for="recipient-name" class="col-form-label">เลขที่ SO</label>
                                    <input type="text" class="form-control" name="socode" id="socode" maxlength="50"
                                        readonly>
                                </div>
                                <div class="form-group col-lg-4 col-12">
                                    <label class="col-form-label">รหัสลูกค้า</label>
                                    <input type="text" class="form-control" name="cuscode" id="cuscode" readonly>
                                </div>
                                <div class="form-group col-lg-6 col-12">
                                    <label for="recipient-name" class="col-form-label">ชื่อลูกค้า</label>
                                    <input type="text" class="form-control" name="cusname" id="cusname" readonly>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-lg-9 col-12">
                                    <label for="recipient-name" class="col-form-label">ที่อยู่ลูกค้า</label>
                                    <input type="text" class="form-control" name="address" id="address" readonly>
                                </div>
                                <div class="form-group col-lg-3 col-12">
                                    <label for="recipient-name" class="col-form-label">ประเภทลูกค้า</label>
                                    <select class="form-control" name="custype" id="custype" disabled>
                                        <option value="ผ่อนสินค้า">ผ่อนสินค้า</option>
                                        <option value="ผ่อนทอง">ผ่อนทอง</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-lg-3 col-12">
                                    <label for="recipient-name" class="col-form-label">วันที่ขาย</label>
                                    <input type="date" class="form-control" name="sodate" id="sodate" required>
                                </div>
                                <div class="form-group col-lg-3 col-12">
                                    <label for="recipient-name" class="col-form-label">วันที่นัดส่งของ</label>
                                    <input type="date" class="form-control" name="deldate" id="deldate" required>
                                </div>
                                <div class="form-group col-lg-3 col-12">
                                    <label for="recipient-name" class="col-form-label">วันที่จ่ายเงินดาวน์</label>
                                    <input type="date" class="form-control" name="downpaydate" id="downpaydate"
                                        required>
                                </div>
                                <div class="form-group col-lg-3 col-12">
                                    <label for="recipient-name" class="col-form-label">วันที่ชำระเงินงวดแรก</label>
                                    <input type="date" class="form-control" name="firstpaydate" id="firstpaydate"
                                        required>
                                </div>
                            </div>
                            <div class="pb-4 bt-3">
                                <br>
                                <div class="table-responsives overflow-auto ">
                                    <table name="tableEditSODetail" id="tableEditSODetail"
                                        class="table table-striped table-valign-middle table-bordered table-hovers text-nowarp">
                                        <thead class="sticky-top table-defalut bg-gray">
                                            <tr>
                                                <th style="text-align:center">ลำดับ</th>
                                                <th style="text-align:left">รหัสสินค้า</th>
                                                <th style="text-align:left">รายการสินค้า</th>
                                                <th style="text-align:center">จำนวน</th>
                                                <th style="text-align:center">หน่วย</th>
                                                <th style="text-align:center">ต้นทุน</th>
                                                <th style="text-align:center">ราคาขาย</th>
                                                <th style="text-align:center">ส่วนลด</th>
                                                <th style="text-align:center">จำนวนเงิน</th>
                                            </tr>
                                        </thead>
                                        <tbody>


                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="tabpayment" role="tabpanel" aria-labelledby="tabpayment-tab">
                            <div class="content-group" title="รูปแบบการชำระ">
                                <div class="row">
                                    <div class="form-group col-lg-3 col-12">
                                        <label for="recipient-name" class="col-form-label">ราคาต้นทุน</label>
                                        <div class="input-group">
                                            <input type="number" class="form-control" name="cost" id="cost"
                                                step="0.0001" readonly>
                                            <div class="input-group-append">
                                                <span class="input-group-text">บาท</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-lg-3 col-12">
                                        <label for="recipient-name" class="col-form-label">การชำระเงิน</label>
                                        <select class="form-control" name="payment" id="payment" required>
                                            <option value="ผ่อนชำระ" selected>ผ่อนชำระ</option>
                                            <option value="เงินสด">เงินสด</option>
                                        </select>
                                    </div>


                                </div>
                                <div class="row">
                                    <div class="form-group col-lg-3 col-12">
                                        <label for="recipient-name" class="col-form-label">เงินดาวน์</label>
                                        <div class="input-group">
                                            <input type="number" class="form-control" name="downpay" id="downpay"
                                                onchange="getTotalPrice('edit')" value="0">
                                            <div class="input-group-append">
                                                <span class="input-group-text">บาท</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-lg-3 col-12">
                                        <label for="recipient-name" class="col-form-label">จำนวนงวด</label>

                                        <div class="input-group">
                                            <input type="number" class="form-control" name="installment"
                                                id="installment" onchange="getTotalPrice('edit')" value="0" max="40">
                                            <div class="input-group-append">
                                                <span class="input-group-text">งวด</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-lg-3 col-12">
                                        <label for="recipient-name" class="col-form-label">ผ่อนสุทธิงวดละ</label>
                                        <div class="input-group">
                                            <input type="number" class="form-control" name="netinstallment"
                                                id="netinstallment" onchange="getTotalPrice('edit')" value="0">
                                            <div class="input-group-append">
                                                <span class="input-group-text">บาท</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-lg-3 col-12">
                                        <label for="recipient-name" class="col-form-label">รอบผ่อน (ราย)</label>
                                        <div class="input-group">
                                            <input type="number" class="form-control" name="round" id="round" value="0">
                                            <div class="input-group-append">
                                                <span class="input-group-text">วัน</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-lg-3 col-12">
                                        <label for="recipient-name" class="col-form-label">ราคารวม</label>
                                        <div class="input-group">
                                            <input type="number" class="form-control" name="totalprice" id="totalprice"
                                                readonly>
                                            <div class="input-group-append">
                                                <span class="input-group-text">บาท</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="col-md-12 col-sm-12">
                                    <div class="form-group">
                                        <label class="col-form-label">หมายเหตุ :</label>
                                        <textarea class="form-control" value="" name="remark" id="remark"
                                            style="height: 10vh; max-height: 10vh; min-height: 10vh;"
                                            placeholder="กรอกหมายเหตุ"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="tabinstallment" role="tabpanel"
                            aria-labelledby="tabinstallment-tab">
                            <div class="pb-4 bt-3">
                                <div class="table-responsives overflow-auto ">
                                    <table name="tablePayment" id="tablePayment"
                                        class="table table-striped table-valign-middle table-bordered table-hovers text-nowarp">
                                        <thead class="sticky-top table-defalut bg-dark">
                                            <tr>
                                                <th style="text-align:center">ลำดับ</th>
                                                <th style="text-align:center">วันที่ต้องชำระ</th>
                                                <th style="text-align:center">สถานะ</th>
                                            </tr>
                                        </thead>
                                        <tbody class="text-nowrap" style="background:#ECF2FF;">

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="tabtotalre" role="tabpanel"
                            aria-labelledby="tabtotalre-tab">
                            <div class="table-responsives overflow-auto ">
                                <table name="receipt-list-table" id="receipt-list-table"
                                    class="table table-striped table-valign-middle table-bordered table-hovers text-nowarp">
                                    <thead class="sticky-top table-defalut bg-gray">
                                        <tr>
                                            <th style="text-align:center">งวด</th>
                                            <th style="text-align:center">เลขที่ RE</th>
                                            <th style="text-align:center">รูปแบบ</th>
                                            <th style="text-align:center">สถานะ</th>
                                            <th style="text-align:center">หมายเหตุ</th>
                                            <th style="text-align:right">จำนวนเงิน</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td colspan="6" class="text-center">ไม่มีรายการ</td>
                                        </tr>
                                    </tbody>
                                    <tfoot class="table-defalut bg-secondarys">
                                        <tr>
                                            <td colspan="4" class="border-left-0 border-right-0"
                                                style="vertical-align: middle;">รวมเงิน (Total)</td>
                                            <td colspan="2"
                                                class="border-left-0 border-right-0 text-right text-success"><span
                                                    id="spanTotalRE">-</span> บาท</td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="col text-center">
                        <button type="button" class="btn" data-dismiss="modal"
                            style="color:white;background : #BFACE2;">ปิด</button>
                        <button type="submit" id="btnEditSo" form="frmEditSO" class="btn"
                            style="color:white;background :  #7e57c2;" s>แก้ไข</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>