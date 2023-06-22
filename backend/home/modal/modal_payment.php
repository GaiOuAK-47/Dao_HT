<div class="modal fade" id="modal-pay" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header" style="color:white;background:linear-gradient(to right, #61398F, #8B5FBF);text-shadow:2px 2px 4px #000000;">
                <h4 class="modal-title" style="font-size: clamp(1.1rem, 1vw, 1.5rem);">
                    <i class="fas fa-receipt mr-2"></i>
                    <span class="t-title">ชำระเงิน</span>
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <div class="content-group px-3" title="ประเภทการชำระ">
                            <div class="from-group d-flex justify-content-start align-items-end flex-wrap" style="gap:2rem;">
                                <div class="icheck-primary d-inline">
                                    <input type="radio" id="paayment1" name="payment" value="เงินสด" required>
                                    <label for="paayment1" class="d-flex align-items-center">
                                        <span class="label badge label-white middle">เงินสด</span>
                                    </label>
                                </div>
                                <div class="icheck-primary d-inline">
                                    <input type="radio" id="paayment2" name="payment" value="โอนชำระ">
                                    <label for="paayment2" class="d-flex align-items-center">
                                        <span class="label badge label-white middle">โอนชำระ</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- <div class="col-12">
                        <div class="content-group px-3" title="รายการที่ชำระ">
 
                        </div>
                    </div> -->
                </div>
            </div>
            <div class="modal-footer justify-content-center">
                <button type="button" class="btn" style="color:white;background : #BFACE2;" data-dismiss="modal" >ยกเลิก</button>
                <button type="button" class="btn" style="color:white;background : #7e57c2;" id="summit-payment" >ชำระเงิน</button>
            </div>
        </div>
    </div>
</div>