<div class="modal fade" id="modal-attach" data-backdrop="static" tabindex="-1" role="dialog"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header"
                style="color:white;background:linear-gradient(to right, #61398F, #8B5FBF);text-shadow:2px 2px 4px #000000;">
                <h4 class="modal-title"> <i class="fas fa-paperclip"></i>
                    <span>แนบไฟล์เอกสาร</span>
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="col-sm-12 col-12">
                    <div class="form-row">
                        <div class="form-group col-md-12 col-sm-12">
                            <label class="col-form-label">หัวข้อไฟล์ :
                                <strong class="text-danger">*</strong>
                                <small></small>
                            </label>
                            <input type="text" accept="image/*,.pdf" class="form-control" name="attname" id="attname"
                                placeholder="กรุณากรอก หัวข้อไฟล์" req>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-12 col-sm-12 mt-4 mb-2">
                            <label class="col-form-label">ไฟล์เอกสาร :</label>
                            <a href="#" class="btn btns-tool btn-sm btn-success"
                                onclick="$(this).next('input[type=file]').click()">
                                <i class="fas fa-paperclip mr-2"></i>
                                <span>คลิกแนบแนบไฟล์เอกสาร</span>
                            </a>
                            <input type="file" accept="image/*,.pdf" class="custom-file-input d-none" name="atthFile"
                                onchange="attached(event, '#attachFileList')">
                            <p class="text-danger m-0 mt-2" style="font-size: 0.8rem;">
                                <i class="fas fa-info mr-2"></i>
                                <span>ต้องแนบไฟล์ที่นามสกุล .pdf, .png, .jpg, .jpeg เท่านั้น</span>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="file-result">
                    <div class="d-flex attach-result f-empty border rounded-sm align-items-center justify-content-center px-3"
                        style="min-height:clamp(60px, 10vh, 300px);">
                        <span class="mi d-flex align-items-center p-2 h1 m-0">
                            <i class="fas fa-file text-black-50"></i>
                        </span>
                        <span class="ms text-black-50">ไม่มีไฟล์แนบ...</span>
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-center">
                <button type="button" class="btn" style="color:white;background : #BFACE2;" id="cancel-file">ยกเลิก</button>
                <button type="button" class="btn" style="color:white;background : #7e57c2;" id="summit-file">ตกลง</button>
            </div>
        </div>
    </div>
</div>