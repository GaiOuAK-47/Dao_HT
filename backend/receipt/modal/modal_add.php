<div class="modal fade bd-example-modal-xl pl-0" tabindex="-1" id="modal_add" role="dialog" data-backdrop="static"
    aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-xl">
        <div class="modal-content w3-flat-turquoise" style="overflow-y: auto;">
            <div class="modal-header bg-gradient-secondary">
                <h5 class="modal-title">สร้างใบเสร็จ</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="bs-stepper" id="stp">
                    <div class="bs-stepper-header overflow-auto mb-3" role="tablist">
                        <!-- your steps here -->
                        <div class="step" data-target="#select-order-part">
                            <button type="button" class="step-trigger" role="tab" aria-controls="select-order-part"
                                id="select-order-part-trigger">
                                <span class="bs-stepper-circle">
                                    <i class="fas fa-tasks"></i>
                                </span>
                                <span class="bs-stepper-label">เลือก SO</span>
                            </button>
                        </div>
                        <div class="line"></div>
                        <div class="step" data-target="#add-lists-part">
                            <button type="button" class="step-trigger" role="tab" aria-controls="add-lists-part"
                                id="add-lists-part-trigger">
                                <span class="bs-stepper-circle">
                                    <i class="fas fa-receipt"></i>
                                </span>
                                <span class="bs-stepper-label">สร้างใบเสร็จ</span>
                            </button>
                        </div>
                        <div class="line"></div>
                        <div class="step" data-target="#add-payment-part">
                            <button type="button" class="step-trigger" role="tab" aria-controls="add-payment-part"
                                id="add-payment-part-trigger">
                                <span class="bs-stepper-circle">
                                    <i class="fas fa-print"></i>
                                </span>
                                <span class="bs-stepper-label">การชำระเงิน/พิมพ์ใบเสร็จ</span>
                            </button>
                        </div>
                    </div>
                    <div class="bs-stepper-content">
                        <!-- your steps content here -->
                        <div id="select-order-part" class="content" role="tabpanel"
                            aria-labelledby="select-order-trigger">
                            <form name="frmAddRE" id="frmAddRE" method="POST" style="padding:10px;"
                                action="javascript:void(0);">
                                <div>
                                    <div class="card card-default">
                                        <div class="card-header">
                                            <h3 class="card-title">
                                                <i class="fas fa-file-invoice mr-2"></i>
                                                SO ที่เลือก
                                            </h3>
                                        </div>

                                        <div class="card-body">
                                            <div id="selectso" class="callout callout-success p-3 so-seleted">
                                                <div class="d-flex" style="gap:12px; flex-wrap: wrap;">
                                                    <div class="">
                                                        <i class="fas fa-file-invoice-dollar"
                                                            style="font-size: 5.1rem;color: darkseagreen;"></i>
                                                    </div>
                                                    <div>
                                                        <div class="list-box">
                                                            <h5 id="list-title" class="m-0 ">หมายเลขใบขาย <span
                                                                    id="spansocode"></span></h5>
                                                            <p id="list-total" class="m-0" style="font-size:11px;">
                                                                &nbsp;
                                                            </p>
                                                            <p id="list-price" class="m-0" style="font-size:11px;">
                                                                &nbsp;
                                                            </p>
                                                            <p id="list-sdate" class="m-0" style="font-size:11px;">
                                                                &nbsp;
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <div class="pay-success"
                                                        style="flex: 1 1 auto; text-align: center; display:none;">
                                                        <span
                                                            style="font-size: 2.5rem; font-weight: 600; color: #aeccae;">
                                                            ชำระครบแล้ว</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="unselectso" class="callout callout-secondary p-3 so-empty">
                                                <div class="d-flex align-items-center"
                                                    style="gap:12px;letter-spacing: 2px;">
                                                    <div class="">
                                                        <i class="fas fa-file-invoice-dollar text-secondary"
                                                            style="font-size: 5.1rem;"></i>
                                                    </div>
                                                    <div class="list-box">
                                                        <h3 class="m-0 text-secondary">ไม่มี SO ที่เลือก</h3>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="table-responsives overflow-auto ">
                                    <table name="tb-order" id="tb-order"
                                        class="table table-striped table-valign-middle table-bordered table-hovers text-nowarp">
                                        <thead class="sticky-top table-defalut bg-gray">
                                            <tr>
                                                <th>ลำดับ</th>
                                                <th>เลขที่SO</th>
                                                <th>วันที่SO</th>
                                                <th>ลูกค้า</th>
                                                <th>จำนวนเงินทั้งหมด</th>
                                                <th>จำนวนเงินที่ชำระแล้ว</th>
                                                <th>จำนวนเงินคงเหลือ</th>
                                                <th>ออกโดย</th>
                                            </tr>
                                        </thead>
                                        <tbody>


                                        </tbody>
                                    </table>
                                </div>
                                <div class="form-row d-flex justify-content-between">
                                    <div class="btn-left">

                                    </div>
                                    <div class="btn-rigth">
                                        <button type="submit" class="btn btn-steper"
                                            style="color:white;background :  #7e57c2;text-shadow:2px 2px 4px #000000;"
                                            form="frmAddRE">
                                            ต่อไป
                                            <i class="fas fa-angle-right"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <div id="add-lists-part" class="content" role="tabpanel"
                            aria-labelledby="add-lists-part-trigger">
                            <div class="content-group" title="รายการ - ใบเสร็จ">
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

                            <div class="content-group" title="รายการ - ใบขายสินค้า">
                                <div class="table-responsives overflow-auto ">
                                    <table name="order-list-table" id="order-list-table"
                                        class="table table-striped table-valign-middle table-bordered table-hovers text-nowarp">
                                        <thead class="sticky-top table-defalut bg-gray">
                                            <tr>
                                                <th style="text-align:center">รายการที่</th>
                                                <th style="text-align:center">เลขที่ SO</th>
                                                <th style="text-align:center">รหัสสินค้า</th>
                                                <th>รายการ</th>
                                                <th style="text-align:center">จำนวน</th>
                                                <th style="text-align:center">ราคา</th>
                                                <th style="text-align:center">หน่วย</th>
                                                <th style="text-align:center">ส่วนลด (%)</th>
                                                <th style="text-align:center">ยอดรวม</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <td colspan="9" class="text-center">ไม่มีรายการ</td>

                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="content-group" title="รายการ - ยอดผ่อนสินค้า">
                                <div class="table-responsives overflow-auto ">
                                    <table name="detail-list-table" id="detail-list-table"
                                        class="table table-striped table-valign-middle table-bordered table-hovers text-nowarp">
                                        <thead class="sticky-top table-defalut bg-gray">
                                            <tr>
                                                <th style="text-align:center">รายการที่</th>
                                                <th>รายการ</th>
                                                <th style="text-align:center">จำนวน</th>
                                                <th style="text-align:center">ราคา</th>
                                                <th style="text-align:right">ยอดรวม</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <td colspan="9" class="text-center">ไม่มีรายการ</td>

                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td rowspan="3" colspan="2" class="border-left-0 border-right-0"
                                                    style="vertical-align: middle;">รวมเงิน (Total)</td>
                                                <td colspan="1" class="border-left-0 border-right-0 text-left">ราคารวม
                                                </td>
                                                <td colspan="2"
                                                    class="border-left-0 border-right-0 text-right text-info"><span
                                                        id="spanTotalSO">-</span> บาท</td>
                                            </tr>
                                            <tr>
                                                <td colspan="1" class="border-left-0 border-right-0 text-left">ชำระแล้ว
                                                </td>
                                                <td colspan="2"
                                                    class="border-left-0 border-right-0 text-right text-info"><span
                                                        id="spanPaidSO">-</span> บาท</td>
                                            </tr>
                                            <tr>
                                                <td colspan="1" class="border-left-0 border-right-0 text-left">
                                                    ยอดคงเหลือ</td>
                                                <td colspan="2"
                                                    class="border-left-0 border-right-0 text-right text-info"><span
                                                        id="spanBalanceSO">-</span> บาท</td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>

                            <div class="form-row d-flex justify-content-between">
                                <div class="btn-left">
                                    <button type="button" class="btn btn-primary btn-steper"
                                        onclick="stepper.previous()">
                                        <i class="fas fa-angle-left"></i>
                                        ย้อนกลับ
                                    </button>
                                </div>
                                <div class="btn-rigth">
                                    <button type="button" class="btn btn-primary btn-steper" id="btncreatereceipt">
                                        สร้างใบเสร็จ
                                        <i class="fas fa-receipt"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div id="add-payment-part" class="content" role="tabpanel"
                            aria-labelledby="add-payment-part-trigger">
                            <form name="frmAddREDetail" id="frmAddREDetail" method="POST" style="padding:10px;"
                                action="javascript:void(0);">
                                <ul class="nav nav-tabs" id="myTab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="tabpayment-tab" data-toggle="tab"
                                            href="#tabpayment" role="tab" aria-controls="tabpayment"
                                            aria-selected="true">การชำระเงิน</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="tabtable-tab" data-toggle="tab" href="#tabtable"
                                            role="tab" aria-controls="tabtable"
                                            aria-selected="false">ตารางการชำระเงิน</a>
                                    </li>
                                </ul>
                                <br>
                                <div class="tab-content">
                                    <div class="tab-pane fade show active" id="tabpayment" role="tabpanel"
                                        aria-labelledby="tabpayment-tab">
                                        <div class="content-group" title="วันที่ชำระเงิน">
                                            <div class="form-row align-items-center">
                                                <div class="col-md-6 col-sm-12">
                                                    <input type="date" class="form-control" id="add_redate" require>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="content-group" title="รูปแบบการชำระ">
                                            <div class="form-row align-items-center">
                                                <div class="col-md-6 col-sm-12">
                                                    <div class="from-group d-flex justify-content-start align-items-end flex-wrap"
                                                        style="gap:2rem;">
                                                        <div class="icheck-primary d-inline">
                                                            <input type="radio" id="style-payment2" name="style-payment"
                                                                value="ชำระทั้งหมด" checked>
                                                            <label for="style-payment2"
                                                                class="d-flex align-items-center">
                                                                <span
                                                                    class="label badge label-white middle">ชำระทั้งหมด</span>
                                                            </label>
                                                        </div>
                                                        <div class="icheck-primary d-inline">
                                                            <input type="radio" id="style-downpay" name="style-payment"
                                                                value="ชำระเงินดาวน์">
                                                            <label for="style-downpay"
                                                                class="d-flex align-items-center">
                                                                <span
                                                                    class="label badge label-white middle">ชำระเงินดาวน์</span>
                                                            </label>
                                                        </div>
                                                        <div class="icheck-primary d-inline">
                                                            <input type="radio" id="style-payment1" name="style-payment"
                                                                value="แบ่งชำระ">
                                                            <label for="style-payment1"
                                                                class="d-flex align-items-center">
                                                                <span
                                                                    class="label badge label-white middle">แบ่งชำระ</span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-sm-12">
                                                    <span id="spanremain"
                                                        class="label badge label-white middle remain-price"></span>
                                                        <span style="display:none;" id="totalremain"></span>
                                                    <div class="paymnt-set d-flex flex-column"
                                                        style="gap: 10px; max-height:350px; overflow: auto; overflow-x: hidden;">
                                                        <div id="divamountpayment" class="input-group">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text">&nbsp;</span>
                                                            </div>
                                                            <input type="number" id="payprice" min="1" step="any"
                                                                class="form-control"
                                                                placeholder="กรอกจำนวนเงินที่ต้องการ">
                                                        </div>
                                                    </div>
                                                    <input type="hidden" id="tmpdownpay">
                                                    <input type="hidden" id="tmpsumpay">
                                                    <input type="hidden" id="tmpnetinstallment">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="content-group" title="ประเภทการชำระ">
                                            <div class="form-row">
                                                <div class="col-md-6 col-sm-12">
                                                    <div class="from-group d-flex justify-content-start align-items-end flex-wrap"
                                                        style="gap:2rem;">
                                                        <div class="icheck-primary d-inline">
                                                            <input type="radio" id="paayment1" name="payment"
                                                                value="เงินสด" required>
                                                            <label for="paayment1" class="d-flex align-items-center">
                                                                <span
                                                                    class="label badge label-white middle">เงินสด</span>
                                                            </label>
                                                        </div>
                                                        <div class="icheck-primary d-inline">
                                                            <input type="radio" id="paayment2" name="payment"
                                                                value="โอนชำระ">
                                                            <label for="paayment2" class="d-flex align-items-center">
                                                                <span
                                                                    class="label badge label-white middle">โอนชำระ</span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-md-12 col-sm-12">
                                                <div class="form-group">
                                                    <label class="col-form-label">หมายเหตุ :</label>
                                                    <textarea class="form-control" value="" id="remark" name="remark"
                                                        style="height: 10vh; max-height: 10vh; min-height: 10vh;"
                                                        placeholder="กรอกหมายเหตุ"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="tabtable" role="tabpanel"
                                        aria-labelledby="tabtable-tab">
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
                            </form>
                            <div class="form-row d-flex justify-content-between">
                                <div class="btn-left">
                                    <button type="button" class="btn btn-primary btn-steper"
                                        onclick="stepper.previous()">
                                        <i class="fas fa-angle-left"></i>
                                        ย้อนกลับ
                                    </button>
                                </div>
                                <div class="btn-rigth">
                                    <button type="submit" class="btn btn-success btn-steper" id="btnPrintReceipt"
                                        form="frmAddREDetail">
                                        พิมพ์ใบเสร็จ
                                        <i class="fas fa-print"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>