<div class="modal fade bd-example-modal-xl" tabindex="-1" id="modal_edit" role="dialog" 
    aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">

        <div class="modal-content w3-flat-turquoise">
            <div class="modal-header"style="color:white;background : linear-gradient(to right, #61398F, #8B5FBF);font-size:20px;text-shadow:2px 2px 4px #000000;">
                <h5 class="modal-title">รายละเอียดสินค้า</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form name="frmEditStock" id="frmEditStock" method="POST" style="padding:10px;"
                action="javascript:void(0);">
                <div class="modal-body">
                <div class="row">
                        <div class="form-group col-lg-3 col-12">
                            <label for="recipient-name" class="col-form-label">รหัสสินค้า</label>
                            <input type="text" class="form-control" name="stcode" id="stcode" readonly>
                        </div>
                        <div class="form-group col-lg-6 col-12">
                            <label class="col-form-label">ชื่อสินค้า</label>
                            <input type="text" class="form-control" name="stname1" id="stname1" readonly>
                        </div>
                        <div class="form-group col-lg-3 col-12">
                            <label for="recipient-name" class="col-form-label">หน่วย</label>
                            <input class="form-control" name="unit" id="unit" readonly>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="form-group col-lg-4 col-12">
                            <label for="recipient-name" class="col-form-label">จำนวนคงเหลือ</label>
                            <input class="form-control" name="amount" id="amount" readonly>    
                        </div>
                        <div class="form-group col-lg-4 col-12">
                            <label for="recipient-name" class="col-form-label">ราคาเฉลี่ย</label>
                            <input class="form-control" name="amtprice" id="amtprice" readonly>      
                        </div>
                        <div class="form-group col-lg-4 col-12">
                            <label for="recipient-name" class="col-form-label">มูลค่ารวมทั้งหมด</label>
                            <input class="form-control" name="price" id="price" readonly>      
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-lg-3 col-12">
                            <label for="recipient-name" class="col-form-label">หมวดสินค้า</label>
                            <input class="form-control" name="grname" id="grname" readonly>    
                        </div>
                        <div class="form-group col-lg-3 col-12">
                            <label for="recipient-name" class="col-form-label">ประเภทสินค้า</label>
                            <input class="form-control" name="typename" id="typename" readonly>      
                        </div>
                        <div class="form-group col-lg-3 col-12">
                            <label for="recipient-name" class="col-form-label">แบรนด์สินค้า</label>
                            <input class="form-control" name="bdname" id="bdname" readonly>      
                        </div>
                        <div class="form-group col-lg-3 col-12">
                            <label for="recipient-name" class="col-form-label">สีสินค้า</label>
                            <input class="form-control" name="clname" id="clname" readonly>
                        </div>
                    </div>
                    <input type="hidden" id="id" name="id">


                </div>
                <div class="modal-footer">
                    <div class="col text-center">
                        <button type="button" class="btn"style="color:white;background : #BFACE2;text-shadow:2px 2px 4px #000000;" data-dismiss="modal">ปิด</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>