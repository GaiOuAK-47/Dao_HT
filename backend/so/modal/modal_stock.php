<div class="modal fade bd-example-modal-lg" id="modal_stock" tabindex="-1" role="dialog"  data-backdrop="static" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg">
        <div class="modal-content w3-flat-turquoise">
            <div class="modal-header"style="color:white;background : linear-gradient(to right, #61398F, #8B5FBF);font-size:20px;text-shadow:2px 2px 4px #000000;">
                <h5 class="modal-title">เลือกสินค้า</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12 col-12">
                        <table id="table_stock" name="table_stock"
                            class="table table-striped table-valign-middle table-bordered table-hovers text-nowarp">
                            <thead class="sticky-top table-defalut bg-gray">
                                <tr>
                                    <th style="text-align:left">ลำดับ</th>
                                    <th style="text-align:left">รหัสสินค้า</th>
                                    <th style="text-align:left">ชื่อสินค้า</th>
                                    <th style="text-align:left">จำนวน</th>
                                    <th style="text-align:left">หน่วยสินค้า</th>
                                </tr>
                            </thead>
                            <tbody class="text-nowrap">

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="col text-center">
                    <button type="button" class="btn" data-dismiss="modal" style="color:white;background : #BFACE2;">ปิด</button>
                </div>
            </div>
        </div>
    </div>
</div>