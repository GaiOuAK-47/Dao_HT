<div class="modal fade bd-example-modal-xl" tabindex="-1" id="modal-attach-list" role="dialog" data-backdrop="static"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content w3-flat-turquoise">
            <div class="modal-header">
                <h5 class="modal-title">แนบไฟล์เอกสาร ใบสั่งซื้อสินค้า</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="section-attach-file">
                    <div class="card">
                        <div class="card-header border-0 w-100 d-flex align-items-center justify-content-between">
                            <h4 class="card-title col-6" style="font-size: 0.9rem; font-weight: 600;">รายการ ไฟล์แนบ
                            </h4>
                            <div class="card-tools col-6 text-right">
                                <a href="#" class="btn btns-tool btn-sm btn-secondary"
                                    onclick="openMgnFile('#attachFileList')"
                                    style="background: linear-gradient(to right, #61398F, #8B5FBF);">
                                    <i class="fas fa-paperclip mr-2"></i>
                                    <span>แนบไฟล์เอกสาร</span>
                                </a>
                            </div>
                        </div>
                        <div class="card-body table-responsives overflow-auto pt-0" style="max-height:36vh;">
                            <table class="table table-striped table-valign-middle table-hovers" id="attachFileList">
                                <thead class="table-white">
                                    <tr class="position-sticky sticky-top bg-white"
                                        style="background: linear-gradient(to right, #61398F, #8B5FBF); color: white !important;">
                                        <th style="width:75px;border:none;">ลำดับ</th>
                                        <th style="min-width:100px;border:none;">หัวข้อไฟล์</th>
                                        <th style="min-width:300px;border:none;">ไฟล์แนบ</th>
                                        <th style="width:125px;border:none;">ตัวเลือก</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="bg-transparent">
                                        <td colspan="4" align="left" class="bg-transparent border-0 text-secondary">
                                            ไม่มีข้อมูลไฟล์</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="col text-center">
                    <button type="button" class="btn" style="color:white;background:#BFACE2;text-shadow:2px 2px 4px #000000;"
                        data-dismiss="modal">ปิด</button>
                    <button type="button" style="color:white;background:#7e57c2;text-shadow:2px 2px 4px #000000;" class="btn"
                        onclick="uploadAttachment(event)">ยืนยันการแนบไฟล์เอกสาร</button>
                </div>
            </div>
        </div>
    </div>
</div>