<div class="modal fade bd-example-modal-xl" tabindex="-1" id="modal_edit" role="dialog" data-backdrop="static"
    aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-xl">
        <div class="modal-content w3-flat-turquoise">
            <div class="modal-header"
                style="color:white;background : linear-gradient(to right, #34495E,#34495E);font-size:20px;text-shadow:2px 2px 4px #000000;">
                <h5 class="modal-title">รายละเอียดใบเสร็จรับเงิน</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body overflow-hidden py-1">
                <br>
                <div class="form-group col-md-12">
                    <button type="button" id="btnPrintRE" class="btn btn-primary"><i class="fa fa-print"
                            aria-hidden="true"></i> ปริ้นเสร็จรับเงิน</button>
                    <button type="button" id="btnCancleREdetail" class="btn btn-danger"><i class="fa fa fa-tags"
                            aria-hidden="true"></i> ยกเลิกใบเสร็จ</button>
                </div>

                <ul class="nav nav-tabs" id="custom-content-below-tab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="custom-content-below-home-tab" data-toggle="pill"
                            href="#custom-content-below-home" role="tab" aria-controls="custom-content-below-home"
                            aria-selected="false">ใบสั่งซื้อสินค้า</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="custom-content-below-profile-tab" data-toggle="pill"
                            href="#custom-content-below-profile" role="tab" aria-controls="custom-content-below-profile"
                            aria-selected="true">ไฟล์เอกสาร</a>
                    </li>
                </ul>
                <div class="tab-content" style="max-height: calc(60vh - 0.9rem); overflow-y: auto;">
                    <div class="tab-pane fade p-3  active show" id="custom-content-below-home" role="tabpanel"
                        aria-labelledby="custom-content-below-home-tab">
                        <form name="frmEditSO" id="frmEditSO" method="POST" style="padding:10px;"
                            action="javascript:void(0);">
                            <div class="">
                                <div class="content-group" title="ข้อมูลใบเสร็จ">
                                    <div class="form-row align-items-center">
                                        <div class="col-md-12 col-sm-12">
                                            <div class="row">
                                                <table width="100%">
                                                    <tr>
                                                        <td for="recipient-name" style="padding: 10px;">
                                                            <label for="recipient-name"
                                                                class="col-form-label">เลขที่ใบเสร็จ</label>

                                                            <input name="recode" id="recode" class="form-control"
                                                                maxlength="50" readonly>
                                                        </td>
                                                        <td style="padding: 10px;">
                                                            <label for="recipient-name" class="col-form-label">เลขที่
                                                                SO</label>
                                                            <input type="text" class="form-control" name="socode"
                                                                id="socode" maxlength="50" readonly>
                                                        </td>
                                                        <td style="padding: 10px;">
                                                            <label for="recipient-name"
                                                                class="col-form-label">วันที่ใบเสร็จรับเงิน</label>
                                                            <input type="date" class="form-control" name="redate"
                                                                id="redate" readonly>
                                                        </td>
                                                    </tr>
                                                    <tr>

                                                    </tr>
                                                    <tr>
                                                        <td style="padding: 10px;">
                                                            <label for="recipient-name"
                                                                class="col-form-label">รหัสลูกค้า</label>
                                                            <input type="text" class="form-control" name="cuscode"
                                                                id="cuscode" readonly>
                                                        </td>
                                                        <td style="padding: 10px;">
                                                            <label for="recipient-name"
                                                                class="col-form-label">ชื่อลูกค้า</label>
                                                            <input type="text" class="form-control" name="cusname"
                                                                id="cusname" readonly>
                                                        </td>

                                                        <td colspan="2" style="padding: 10px;">
                                                            <label for="recipient-name"
                                                                class="col-form-label">ที่อยู่ลูกค้า</label>
                                                            <input type="text" class="form-control" name="address"
                                                                id="address" readonly>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style="padding: 10px;">
                                                            <label for="recipient-name"
                                                                class="col-form-label">รูปแบบการชำระเงิน</label>
                                                            <select class="form-control" name="stylepayment"
                                                                id="stylepayment" readonly>
                                                                <option value="ชำระเงินทั้งหมด">ชำระเงินทั้งหมด</option>
                                                                <option value="ชำระเงินดาวน์">ชำระเงินดาวน์</option>
                                                                <option value="แบ่งชำระ">แบ่งชำระ</option>
                                                            </select>
                                                        </td>
                                                        <td style="padding: 10px;">
                                                            <label for="recipient-name"
                                                                class="col-form-label">ประเภทการชำระเงิน</label>
                                                            <select class="form-control" name="payment" id="payment"
                                                                readonly>
                                                                <option value="เงินสด" selected>เงินสด</option>
                                                                <option value="โอนชำระ">โอนชำระ</option>
                                                            </select>
                                                        </td>
                                                        <td style="padding: 10px;">
                                                            <label for="recipient-name"
                                                                class="col-form-label">งวดที่</label>
                                                            <input type="text" class="form-control" name="payround"
                                                                id="payround" readonly>
                                                        </td>
                                                        <td style="padding: 10px;">
                                                            <label for="recipient-name"
                                                                class="col-form-label">ยอดชำระเงิน</label>
                                                            <input type="text" class="form-control" name="suppayprice"
                                                                id="suppayprice" readonly>
                                                        </td>
                                                    </tr>
                                                    <tr>

                                                    </tr>
                                                    <tr>
                                                        <td colspan="4" style="padding: 10px;">
                                                            <div>
                                                                <div class="form">
                                                                    <div class="form">
                                                                        <label class="col-form-label">หมายเหตุ
                                                                            :</label>
                                                                        <textarea class="form-control" value=""
                                                                            name="supremark" id="supremark"
                                                                            style="height: 10vh; max-height: 10vh; min-height: 10vh;"
                                                                            placeholder="กรอกหมายเหตุ"></textarea>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </table>

                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="tab-pane fade p-3" id="custom-content-below-profile" role="tabpanel"
                        aria-labelledby="custom-content-below-profile-tab">
                        <div class="section-attach-file">
                            <div class="card">
                                <div
                                    class="card-header border-0 w-100 d-flex align-items-center justify-content-between">
                                    <h4 class="card-title col-6" style="font-size: 0.9rem; font-weight: 600;">รายการ
                                        ไฟล์แนบ</h4>
                                    <div class="card-tools col-6 text-right">
                                        <a href="#" class="btn btns-tool btn-sm btn-success"
                                            onclick="openMgnFile('#attachFileList')">
                                            <i class="fas fa-paperclip mr-2"></i>
                                            <span>แนบไฟล์</span>
                                        </a>
                                    </div>
                                </div>
                                <div class="card-body table-responsives overflow-auto pt-0 pr-1"
                                    style="max-height:36vh; scrollbar-gutter: stable;">
                                    <table class="table table-striped table-valign-middle table-hovers"
                                        id="attachFileList">
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
                                                <td colspan="4" align="left"
                                                    class="bg-transparent border-0 text-secondary">ไม่มีข้อมูลไฟล์</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="card-footer">
                                    <div class="row">
                                        <div class="col-md-6"></div>
                                        <div class="col-md-6 text-right">
                                            <button id="attachFile" type="button"
                                                class="btn btn-primary">บันทึกการแนบไฟล์</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <div class="col text-center">
                    <button type="button" class="btn"
                        style=" border: solid 1.5px #2E4053;color:white;background : #EC7063;text-shadow:2px 2px 4px #000000;"
                        data-dismiss="modal">ปิด</button>
                    <!-- <button type="submit" id="btnEditSo" form="frmEditPO" class="btn"
                            style="color:white;background :  #7e57c2;text-shadow:2px 2px 4px #000000;">แก้ไข</button> -->
                </div>
            </div>
        </div>
    </div>
</div>