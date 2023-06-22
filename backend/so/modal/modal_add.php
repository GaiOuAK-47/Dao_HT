<div class="modal fade bd-example-modal-xl pl-0" tabindex="-1" id="modal_add" role="dialog" data-backdrop="static"
    aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-xl">
        <div class="modal-content w3-flat-turquoise" style="overflow-y: auto;">
            <div class="modal-header"
                style="color:white;background : linear-gradient(to right, #61398F, #8B5FBF);font-size:20px;text-shadow:2px 2px 4px #000000;">
                <h5 class="modal-title">เพิ่มใบขายสินค้า</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <div class="bs-stepper" id="stp">
                    <div class="bs-stepper-header overflow-auto mb-3" role="tablist">
                        <!-- your steps here -->
                        <div class="step" data-target="#select-type-part">
                            <button type="button" class="step-trigger" role="tab" aria-controls="select-type-part"
                                id="select-type-part-trigger">
                                <span class="bs-stepper-circle">
                                    <i class="fas fa-tasks"></i>
                                </span>
                                <span class="bs-stepper-label">เลือกประเภทใบขายสินค้า</span>
                            </button>
                        </div>
                        <div class="line"></div>
                        <div class="step" data-target="#select-order-part">
                            <button type="button" class="step-trigger" role="tab" aria-controls="select-order-part"
                                id="select-order-part-trigger">
                                <span class="bs-stepper-circle">
                                    <i class="fas fa-tasks"></i>
                                </span>
                                <span class="bs-stepper-label">รายละเอียดใบขายสินค้า</span>
                            </button>
                        </div>
                        <div class="line"></div>
                        <div class="step" data-target="#add-payment-part">
                            <button type="button" class="step-trigger" role="tab" aria-controls="add-payment-part"
                                id="add-payment-part-trigger">
                                <span class="bs-stepper-circle">
                                    <i class="fas fa-receipt"></i>
                                </span>
                                <span class="bs-stepper-label">เงื่อนไขการชำระเงิน</span>
                            </button>
                        </div>
                    </div>
                    <div class="bs-stepper-content">
                        <div id="select-type-part" class="content" role="tabpanel"
                            aria-labelledby="select-type-trigger">

                            <div class="row">
                                <div class="col-lg-6 col-6">
                                    <button type="button" id="btnTypeNormal"
                                        style="color:white;background-color: #7e57c2; width:100%; font-size:22px;text-shadow:2px 2px 4px #000000;"
                                        class="btn btn-lg btn-block " >ทั่วไป</button>
                                </div>
                                <div class="col-lg-6 col-6">
                                    <button type="button" id="btnTypeGold"
                                        style="color:white;background-color: #7e57c2 ;width:100%; font-size:22px;text-shadow:2px 2px 4px #000000;"
                                        class="btn btn-lg btn-block" >ซื้อทอง</button>
                                </div>
                            </div>
                        </div>
                        <div id="select-order-part" class="content" role="tabpanel"
                            aria-labelledby="select-order-trigger">
                            <form name="frmAddSO" id="frmAddSO" method="POST" style="padding:10px;"
                                action="javascript:void(0);">
                                <div class="row">
                                    <div class="form-group col-lg-2 col-12">
                                        <label for="recipient-name" class="col-form-label">เลขที่ SO</label>
                                        <input type="text" class="form-control" name="add_socode" id="add_socode"
                                            maxlength="50" >
                                    </div>
                                    <div class="form-group col-lg-4 col-12">
                                        <label class="col-form-label">รหัสลูกค้า</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="add_cuscode" id="add_cuscode"
                                                required>
                                            <span class="input-group-btn">
                                                <button class="btn btn-default" data-toggle="modal"
                                                    data-target="#modal_customer" type="button"><span
                                                        class="fa fa-search"></span></button>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="form-group col-lg-6 col-12">
                                        <label for="recipient-name" class="col-form-label">ชื่อลูกค้า</label>
                                        <input type="text" class="form-control" name="add_cusname" id="add_cusname"
                                            readonly>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-lg-9 col-12">
                                        <label for="recipient-name" class="col-form-label">ที่อยู่ลูกค้า</label>
                                        <input type="text" class="form-control" name="add_address" id="add_address"
                                            readonly>
                                    </div>
                                    <div class="form-group col-lg-3 col-12">
                                            <label for="recipient-name" class="col-form-label">ประเภทลูกค้า</label>
                                            <select class="form-control" name="add_sotype" id="add_sotype" disabled>
                                                <option value="ผ่อนสินค้า">ผ่อนสินค้า</option>
                                                <option value="ผ่อนทอง">ผ่อนทอง</option>
                                            </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-lg-3 col-12">
                                        <label for="recipient-name" class="col-form-label">วันที่ขาย</label>
                                        <input type="date" class="form-control" name="add_sodate" id="add_sodate"
                                            required>
                                    </div>
                                    <div class="form-group col-lg-3 col-12">
                                        <label for="recipient-name" class="col-form-label">วันที่นัดส่งของ</label>
                                        <input type="date" class="form-control" name="add_deldate" id="add_deldate"
                                            required>
                                    </div>
                                    <div class="form-group col-lg-3 col-12">
                                        <label for="recipient-name" class="col-form-label">วันที่จ่ายเงินดาวน์</label>
                                        <input type="date" class="form-control" name="add_downpaydate"
                                            id="add_downpaydate" required>
                                    </div>
                                    <div class="form-group col-lg-3 col-12">
                                        <label for="recipient-name" class="col-form-label">วันที่ชำระเงินงวดแรก</label>
                                        <input type="date" class="form-control" name="add_firstpaydate"
                                            id="add_firstpaydate" required>
                                    </div>
                                </div>
                                <div class="pb-4 bt-3">
                                    <div class="form-group col-md-12">
                                        <button type="button" class="btn btn-success" data-toggle="modal"
                                            data-target="#modal_stock"><i class="fas fa-cart-plus"
                                                aria-hidden="true"></i>
                                            เพิ่มสินค้า</button>


                                    </div>
                                    <div class="table-responsives overflow-auto ">
                                        <table name="tableSODetail" id="tableSODetail"
                                            class="table table-striped table-valign-middle table-bordered table-hovers text-nowarp">
                                            <thead class="sticky-top table-defalut bg-gray">
                                                <tr>
                                                    <th style="text-align:center">ลำดับ</th>
                                                    <th style="text-align:left">รหัสสินค้า</th>
                                                    <th style="text-align:left">รายการสินค้า</th>
                                                    <th style="text-align:center">จำนวน</th>
                                                    <th style="text-align:center">หน่วย</th>
                                                    <th style="text-align:center">ราคาขาย</th>
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
                                <div class="form-row d-flex justify-content-between">
                                    <div class="btn-left">
                                        <button type="button" class="btn btn-steper"
                                            style="color:white;background : #BFACE2;text-shadow:2px 2px 4px #000000;"
                                            onclick="stepper.previous()">
                                            <i class="fas fa-angle-left"></i>
                                            ย้อนกลับ
                                        </button>
                                    </div>
                                    <div class="btn-rigth">
                                        <button type="submit" class="btn btn-steper"
                                            style="color:white;background :  #7e57c2;text-shadow:2px 2px 4px #000000;"
                                            form="frmAddSO">
                                            ต่อไป
                                            <i class="fas fa-angle-right"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <div id="add-payment-part" class="content" role="tabpanel"
                            aria-labelledby="add-payment-part-trigger">
                            <form name="frmAddSOdetail" id="frmAddSOdetail" method="POST" style="padding:10px;"
                                action="javascript:void(0);">
                                <div class="content-group" title="รูปแบบการชำระ">
                                    <div class="row">
                                        <div class="form-group col-lg-3 col-12">
                                            <label for="recipient-name" class="col-form-label">ราคาต้นทุน</label>
                                            <div class="input-group">
                                                <input type="number" class="form-control" name="add_cost" id="add_cost"
                                                    step="0.0001" readonly>
                                                <div class="input-group-append">
                                                    <span class="input-group-text">บาท</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group col-lg-3 col-12">
                                            <label for="recipient-name" class="col-form-label">การชำระเงิน</label>
                                            <select class="form-control" name="add_payment" id="add_payment" required>
                                                <option value="ผ่อนชำระ" selected>ผ่อนชำระ</option>
                                                <option value="เงินสด">เงินสด</option>
                                            </select>
                                        </div>


                                    </div>
                                    <div class="row">
                                        <div class="form-group col-lg-3 col-12">
                                            <label for="recipient-name" class="col-form-label">เงินดาวน์</label>
                                            <div class="input-group">
                                                <input type="number" class="form-control" name="add_downpay"
                                                    id="add_downpay" onchange="getTotalPrice('add')" value="0">
                                                <div class="input-group-append">
                                                    <span class="input-group-text">บาท</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group col-lg-3 col-12">
                                            <label for="recipient-name" class="col-form-label">จำนวนงวด</label>

                                            <div class="input-group">
                                                <input type="number" class="form-control" name="add_installment"
                                                    id="add_installment" onchange="getTotalPrice('add')" value="1"
                                                    max="40">
                                                <div class="input-group-append">
                                                    <span class="input-group-text">งวด</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group col-lg-3 col-12">
                                            <label for="recipient-name" class="col-form-label">ผ่อนสุทธิงวดละ</label>
                                            <div class="input-group">
                                                <input type="number" class="form-control" name="add_netinstallment"
                                                    id="add_netinstallment" onchange="getTotalPrice('add')" value="0">
                                                <div class="input-group-append">
                                                    <span class="input-group-text">บาท</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group col-lg-3 col-12">
                                            <label for="recipient-name" class="col-form-label">รอบผ่อน (ราย)</label>
                                            <div class="input-group">
                                                <input type="number" class="form-control" name="add_round"
                                                    id="add_round" value="0">
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
                                                <input type="number" class="form-control" name="add_totalprice"
                                                    id="add_totalprice" value="0" readonly>
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
                                            <textarea class="form-control" value="" name="add_remark" id="add_remark"
                                                style="height: 10vh; max-height: 10vh; min-height: 10vh;"
                                                placeholder="กรอกหมายเหตุ"></textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-row d-flex justify-content-between">
                                    <div class="btn-left">
                                        <button type="button" class="btn btn-steper"
                                            style="color:white;background : #BFACE2;text-shadow:2px 2px 4px #000000;"
                                            onclick="stepper.previous()">
                                            <i class="fas fa-angle-left"></i>
                                            ย้อนกลับ
                                        </button>
                                    </div>
                                    <div class="btn-rigth">
                                        <button type="submit" class="btn btn-steper"
                                            style="color:white;background :  #7e57c2;text-shadow:2px 2px 4px #000000;"
                                            form="frmAddSOdetail">

                                            <i class="fas fa-print"> เพิ่ม</i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>