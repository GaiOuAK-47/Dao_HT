<div class="modal fade bd-example-modal-xl" id="modal_po" tabindex="-1" role="dialog" data-backdrop="static"
    aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-xl">
        <div class="modal-content w3-flat-turquoise">
            <div class="modal-header"
                style="color:white;background : linear-gradient(to right, #61398F, #8B5FBF);text-shadow:2px 2px 4px #000000;">
                <h5 class="modal-title">เลือกใบสั่งซื้อจากผู้ขาย ....</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12 col-12">
                        <div class="table-responsives overflow-auto ">
                            <table id="table_po" name="table_po"
                                class="table table-striped table-valign-middle table-bordered table-hovers text-nowarp">
                                <thead class="sticky-top table-defalut bg-gray">
                                    <tr>
                                        <th></th>
                                        <th style="text-align:left">ลำดับ</th>
                                        <th style="text-align:left">เลขที่ใบสั่งซื้อ</th>
                                        <th style="text-align:left">รหัสพัสดุ</th>
                                        <th style="text-align:left">รายการ</th>
                                        <th style="text-align:left">หน่วย</th>
                                        <th style="text-align:right">จำนวนสั่งซื้อ</th>
                                        <th style="text-align:right">จำนวนที่รับแล้ว</th>
                                        <th style="text-align:center">สถานะ</th>
                                    </tr>
                                </thead>
                                <tbody class="text-nowrap">

                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
            <div class="modal-footer">
                <div class="col text-center">
                    <button type="button" class="btn" data-dismiss="modal"
                        style="color:white;background : #BFACE2; text-shadow:2px 2px 4px #000000;">ปิด</button>
                    <button type="submit" id="btnSubmitPO" class="btn"
                        style="color:white;background :  #645CBB; text-shadow:2px 2px 4px #000000;">ตกลง</button>
                </div>
            </div>
        </div>
    </div>
</div>