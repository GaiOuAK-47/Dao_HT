<script type="text/javascript">
let _fileList = [];
let _filesDelete = [];
let _fileFormData = [];
let _attachList = [];
//modal เปิดซ้อนกันได้
$(document).on('show.bs.modal', '.modal', function() {
    const zIndex = 1040 + 10 * $('.modal:visible').length;
    $(this).css('z-index', zIndex);
    setTimeout(() => $('.modal-backdrop').not('.modal-stack').css('z-index', zIndex - 1).addClass(
        'modal-stack'));
});

document.addEventListener('DOMContentLoaded', function() {
    window.stepper = new Stepper(document.querySelector('.bs-stepper'))
})

$(function() {


    $.ajax({
        type: "POST",
        url: "ajax/get_re.php",
        //    data: $("#frmMain").serialize(),
        success: function(result) {

            for (count = 0; count < result.recode.length; count++) {

                $('#tableRE').append(
                    '<tr id="' + result.recode[
                        count] +
                    '" data-toggle="modal" data-target="#modal_edit" data-whatever="' + result
                    .recode[
                        count] + '" ><td>' + result.recode[
                        count] +
                    '</td><td>' + result
                    .socode[count] + '</td><td>' + result
                    .redate[count] + '</td><td>' + result
                    .cuscode[count] + ' ' + result
                    .cusname[count] + '</td><td style="text-align:center">' + formatMoney(result
                        .price[count], 2) +
                    '</td><td style="text-align:center">' + formatMoney(result
                        .totalprice[count], 2) + '</td><td style="text-align:center">' +
                    formatMoney(result.balance[count], 2) + '</td><td>' + result
                    .stylepayment[count] + '</td><td>' + result
                    .status[count] + '</td></tr>');
            }

            $('#tableRE').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": true,
                "ordering": true,
                "order": [
                    [0, 'desc']
                ],
                "info": false,
                "autoWidth": false,
                "responsive": false,
                "scrollX": true
            });

            $(".dataTables_filter input[type='search']").css({
                'width': '80%'
            });


        }
    });

})


$('#btnPrintRE').click(function() {
    // alert($('#recode').val())
    window.open('form/view.php?recode=' + $('#recode').val(), '_blank');
});

$('#btnCancleREdetail').click(function() {
    Swal.fire({
        title: 'ต้องการยกเลิกใบเสร็จใช่ไหม',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'ยกเลิกใบเสร็จ'
    }).then((result) => {
        if (result.isConfirmed) {

            let id = $('#recode').val()
            let socode = $('#socode').val()

            $.ajax({
                type: "POST",
                url: "ajax/cancle_re.php",
                data: "idcode=" + id + "&socode=" + socode,
                success: async function(result) {

                    await Swal.fire('สำเร็จ', result.message, 'success');
                    window.location.reload();

                }
            });
        }
    })

});


$('#modal_add').on('show.bs.modal', function(event) {
    $('#selectso').hide("drop", {
        direction: "right"
    }, 300)
    $('#unselectso').show()

    $.ajax({
        type: "POST",
        url: "ajax/get_so.php",
        success: function(result) {
            $('#tb-order tbody').empty();
            // alert(result.socode.length)
            for (count = 0; count < result.socode.length; count++) {
                $('#tb-order tbody').append(
                    '<tr  onClick="onClick_SelectSO(\'' +
                    result.socode[count] + '\',\'' +
                    result.total[count] + '\',\'' +
                    result.pricetotal[count] + '\',\'' +
                    result.sodate[count] + '\');"  id="' +
                    result
                    .socode[count] + '" );"><td>' + (count + 1) +
                    '</td><td>' +
                    result.socode[count] + '</td><td>' +
                    result.sodate[count] + '</td><td>' +
                    result.cuscode[count] + result.cusname[count] + '</td><td>' +
                    formatMoney(result.pricetotal[count], 2) + '</td><td>' +
                    formatMoney(result.price[count], 2) + '</td><td>' +
                    formatMoney(result.pricetotal[count] - result.price[count], 2) +
                    '</td><td>' +
                    result.firstname[count] + ' ' +
                    result.lastname[count] + '</td></tr>');

            }

            if (!$.fn.DataTable.isDataTable('#tb-order')) {

                $('#tb-order').DataTable({
                    "paging": true,
                    "lengthChange": false,
                    "searching": true,
                    "ordering": true,
                    "info": false,
                    "autoWidth": false,
                    "responsive": false,
                    "scrollX": false
                });

                $(".dataTables_filter input[type='search']").css({
                    'width': '75%'
                });
            }
        }
    });
});


// เลือก SO เพื่อเพิม่
function onClick_SelectSO(socode, total, price, sodate) {

    $('#selectso').hide()
    $('#selectso').show("drop", {
        direction: "right"
    }, 300)
    $('#unselectso').hide()

    $('#spansocode').text(socode)
    $('#list-total').text('รายการทั้งหมด ' + total + ' รายการ')
    $('#list-price').text('จำนวนเงินทั้งหมด ' + formatMoney(price, 2) + ' บาท')
    $('#list-sdate').text('วันที่ใบขาย ' + sodate)

}

// เปลี่ยนไปหน้า เพิ่ม frmAddRE
$("#frmAddRE").submit(function(event) {
    let socode = $('#spansocode').text()
    let totalre = 0;
    let totalso = 0;
    let totalsumpay = 1;
    if (!$('#unselectso').is(':visible')) {

        $.ajax({
            type: "POST",
            url: "ajax/getsup_totalre.php",
            data: "idcode=" + socode,
            success: function(result) {

                $("#receipt-list-table tbody").empty();
                if (result.recode.length != 0) {

                    for (count = 0; count < result.payround.length; count++) {

                        $('#receipt-list-table tbody').append('<tr id="re' + result.payround[
                                count] +
                            '" ><td name="re" id="re' + result.payround[count] +
                            '" ><p class="form-check-label" style="text-align:center">' +
                            result.payround[count] +
                            '</p></td><td><p  id="recode' + result.payround[count] +
                            '" class="form-check-label" style="text-align:center">' +
                            result
                            .recode[count] +
                            '</p></td><td> <p class="form-check-label" style="text-align:center">' +
                            result.stylepayment[count] +
                            '</p></td><td> <p class="form-check-label" style="text-align:center">' +
                            result.status[count] +
                            '</p></td><td><p  id="remark' + result.payround[count] +
                            '" class="form-check-label" style="text-align:center">' +
                            result
                            .remark[count] +
                            '</p></td><td><p  id="price' + result.payround[count] +
                            '" class="form-check-label" style="text-align:right">' +
                            formatMoney(result
                                .price[count], 2) +
                            ' บาท</p></td></tr>');

                        totalsumpay += parseInt(result.sumpay[count])
                        totalre += parseFloat(result.price[count]);
                    }

                } else {
                    $('#receipt-list-table tbody').append(
                        '<td colspan="6" class="text-center">ไม่มีรายการ</td>');
                }

                $('#tmpsumpay').text(totalsumpay);
                $('#spanTotalRE').text(formatMoney(totalre, 2));
                $('#spanPaidSO').text(formatMoney(totalre, 2));




                $.ajax({
                    type: "POST",
                    url: "ajax/getsup_totalso.php",
                    data: "idcode=" + socode,
                    success: function(result) {



                        $("#order-list-table tbody").empty();
                        if (result.stcode.length != 0) {
                            for (count = 0; count < result.stcode.length; count++) {

                                $('#order-list-table tbody').append('<tr id="so' +
                                    result.sono[count] +
                                    '" ><td name="sono" id="sono' + result.sono[
                                        count] +
                                    '" ><p class="form-check-label" style="text-align:center">' +
                                    result.sono[count] +
                                    '</p></td><td><p  id="socodeso' + result.sono[
                                        count] +
                                    '" class="form-check-label" style="text-align:center">' +
                                    result
                                    .socode[count] +
                                    '</p></td><td><p  id="stcodeso' + result.sono[
                                        count] +
                                    '" class="form-check-label" style="text-align:center">' +
                                    result
                                    .stcode[count] +
                                    '</p></td><td> <p class="form-check-label" style="text-align:left">' +
                                    result.stname1[count] +
                                    '</p></td><td><p  id="amountso' + result.sono[
                                        count] +
                                    '" class="form-check-label" style="text-align:center">' +
                                    result
                                    .amount[count] +
                                    '</p></td><td><p  id="priceso' + result.sono[
                                        count] +
                                    '" class="form-check-label" style="text-align:center">' +
                                    formatMoney(result
                                        .price[count], 2) +
                                    '</p></td><td><p  id="unitso' + result.sono[
                                        count] +
                                    '" class="form-check-label" style="text-align:center">' +
                                    result
                                    .unit[count] +
                                    '</p></td><td><p  id="discountso' + result.sono[
                                        count] +
                                    '" class="form-check-label" style="text-align:center">' +
                                    result
                                    .discount[count] +
                                    ' %</p></td><td><p  id="totalso' + result.sono[
                                        count] +
                                    '" class="form-check-label" style="text-align:center">' +
                                    formatMoney(result
                                        .pricetotal[count], 2) +
                                    '</p></td></tr>'
                                );

                                // getTotalso(result.sono[count]);
                            }

                        } else {
                            $('#order-list-table tbody').append(
                                '<td colspan="9" class="text-center">ไม่มีรายการ</td>'
                            );
                        }

                        $('#tmpdownpay').val(result.downpay)
                        $('#tmpnetinstallment').val(result.netinstallment)

                    }
                });

                $.ajax({
                    type: "POST",
                    url: "ajax/getsup_totalsodetail.php",
                    data: "idcode=" + socode,
                    success: function(result) {


                        $("#detail-list-table tbody").empty();
                        if (result.socode.length != 0) {
                            for (count = 0; count < result.socode.length; count++) {

                                $('#detail-list-table tbody').append('<tr id="detail' +
                                    count +
                                    '" ><td name="sodetail" id="sodetail' + count +
                                    '" ><p class="form-check-label" style="text-align:center">' +
                                    (count + 1) +
                                    '</p></td><td> <p class="form-check-label" style="text-align:left">' +
                                    result.stname1[count] +
                                    '</p></td><td><p  id="amountdetail' + count +
                                    '" class="form-check-label" style="text-align:center">' +
                                    result
                                    .amount[count] +
                                    '</p></td><td><p  id="pricedetail' + count +
                                    '" class="form-check-label" style="text-align:center">' +
                                    formatMoney(result
                                        .price[count], 2) +
                                    '</p></td><td><p  id="totaldetail' + count +
                                    '" class="form-check-label" style="text-align:right">' +
                                    formatMoney(result
                                        .totalprice[count], 2) +
                                    ' บาท</p></td></tr>'
                                );
                                totalso += parseFloat(result.totalprice[count]);
                                // getTotalso(result.sono[count]);
                            }
                        } else {
                            $('detail-list-table tbody').append(
                                '<td colspan="9" class="text-center">ไม่มีรายการ</td>'
                            );
                        }

                        $('#spanTotalSO').text(formatMoney(totalso, 2));

                        $('#spanBalanceSO').text(formatMoney(totalso - totalre,
                            2));
                        // $("#payprice").attr({
                        //     "max": $('#spanBalanceSO').text()
                        // });                

                        $('#spanremain').text('( ยอดคงเหลือ ' + formatMoney(totalso -
                            totalre, 2) + ' )');

                        $('#totalremain').text(totalso - totalre);

                        stepper.next();
                    }
                });
            }
        });
        // $('#add_cost').val(cost);
    } else {
        Swal.fire('เกิดข้อผิดพลาด', "กรุณาเลือกใบขายสินค้า", 'error');
    }
});

$('#btncreatereceipt').click(function() {
    $('#divamountpayment').hide()
    $('#style-payment2').prop("checked", true);
    $("#add_redate").val(new Date().toISOString().substring(0, 10));

    let socode = $('#spansocode').text()

    $.ajax({
        type: "POST",
        url: "ajax/get_tablepayment.php",
        data: "idcode=" + socode,
        success: function(result) {

            // alert(result.price)
            CreatePaymentTable(result.date, result.status)


        }
    });

    stepper.next();
});

$("#frmAddREDetail").submit(function(event) {
    event.preventDefault();

    let socode = $('#spansocode').text()
    let stylepayment = $('input[name="style-payment"]:checked').val()
    let payment = $('input[name="payment"]:checked').val()
    let payprice;
    if (stylepayment == 'ชำระทั้งหมด')
        payprice = $('#totalremain').text()
    else
        payprice = $('#payprice').val()

    let remark = $('#remark').val()

    // alert(payprice)

    $.ajax({
        type: "POST",
        url: "ajax/add_re.php",
        data: "socode=" + socode +
            "&stylepayment=" + stylepayment +
            "&payment=" + payment +
            "&payprice=" + payprice +
            "&add_redate=" + $('#add_redate').val() +
            "&remark=" + remark +
            "&id=" + '<?php echo $_SESSION['id'];?>',
        success: async function(result) {
            if (result.status == 1) {
                // await Swal.fire('สำเร็จ', result.message, 'success');
                toast(result.message, 'success');
                $(event.target).closest("div.modal").modal("hide");
                // window.location.reload();
                // console.log(result.sql);
                onAttachment(result.response_code);
            } else {
                Swal.fire('เกิดข้อผิดพลาด', "รหัสซ้ำ", 'error');
                console.log(result.message);
            }
        }
    });


});

$('#modal_edit').on('show.bs.modal', function(event) {
    var button = $(event.relatedTarget);
    var recode = button.data('whatever');
    var modal = $(this);

    $.ajax({
        type: "POST",
        url: "ajax/getsup_re.php",
        data: "idcode=" + recode,
        success: function(result) {
            $("#recode").val(result.recode);
            $("#socode").val(result.socode);
            $("#cuscode").val(result.cuscode);
            $("#cusname").val(result.cusname);
            $("#redate").val(result.redate);
            $("#address").val(result.address);
            $("#payround").val(result.payround);
            $("#stylepayment").val(result.stylepayment);
            $("#suppayprice").val(formatMoney(result.payprice, 2));
            $("#payment").val(result.payment);
            $("#supremark").val(result.remark);

            if (result.status == 'ยกเลิก') {
                $("#btnCancleREdetail").hide();

            } else {
                $("#btnCancleREdetail").show();
            }
        }
    });

    $("#divfrmEditGR").show();

    $("#tableEditGRDetail tbody").empty();

    modal.find("button#attachFile").attr("recode", recode);
    getAttachmentList(recode);
});

$('input[type=radio][name=style-payment]').change(function() {

    switch ($(this).val()) {
        case 'ชำระทั้งหมด':
            $("#payprice").prop('required', false);
            $('#divamountpayment').hide();
            break;
        case 'ชำระเงินดาวน์':
            $('#divamountpayment').hide();
            $('#payprice').val($('#tmpdownpay').val())
            $("#payprice").prop('required', false);
            $('.input-group-text').text('ยอดชำระเงินดาวน์');
            $('#divamountpayment').show("drop", {
                direction: "right"
            }, 300);
            break;
        case 'แบ่งชำระ':
            $('#divamountpayment').hide();
            $('#payprice').val($('#tmpnetinstallment').val())
            $("#payprice").prop('required', true);
            $('.input-group-text').text('งวดที่ ' + $('#tmpsumpay').text());
            $('#divamountpayment').show("drop", {
                direction: "right"
            }, 300);
            break;
    }
});

function CreatePaymentTable(date, status) {
    $("#tablePayment tbody").empty();

    let txtstatus = ''

    for (count = 0; count < date.length; count++) {

        if (status[count])
            txtstatus = '<small class="badge badge-success">ชำระเงินแล้ว</small>';
        else
            txtstatus = '<small class="badge badge-warning">รอชำระ</small>';

        $('#tablePayment tbody').append('<tr id="paymenttable' + count +
            '" ><td name="sono" id="countpay' + count +
            '" ><p class="form-check-label" style="text-align:center">' +
            (count + 1) +
            '</p></td><td><p  id="date' + count +
            '" class="form-check-label" style="text-align:center">' +
            date[count] +
            '</p></td><td><p  id="status' + count +
            '" class="form-check-label" style="text-align:center">' +
            txtstatus +
            '</p></td></tr>'
        );
    }
}

$("#btnRefresh").click(function() {
    window.location.reload();
});


$(document).on("click", "#summit-file", function() {
    const modal = $(this).parents("div.modal");
    const n = modal.find(".modal-body input[name=atthFile]");
    const h = modal.find(".modal-body input[name=attname]");
    const e = modal.find(".f-empty");
    const a = modal.find("[attached]");
    const f = n[0].files[0];
    if (!f && a.length == 0) {
        e.addClass("border-danger");
        return;
    }
    if (!h.val()) {
        h.addClass("border-danger");
        const s = h.closest(".form-group").find("label small");
        s.html(
            "<strong class='text-danger font-italic'>กรุณากรอกข้อมูลให้ครบถ้วน</strong>"
        );
        s.removeClass("d-none");
        return;
    }
    const d = JSON.parse(modal.attr("data-attach") || null);
    if (d) {
        let i = _fileList.findIndex((c => c.code == d.code));
        let p = d.url.split("//");
        let r = p[p.length - 1];
        _fileList[i].attname = h.val();
        _fileList[i].file = f || {
            name: `<a class="font-weight-bold text-monospace" href="ajax/load_attachfile.php?path=${d.url}" target="_BLANK" style="text-decoration: underline; color: #007bff !important;">${r}</a>`
        };
        _fileList[i]["upd"] = true;
        _fileList[i]["udf"] = !!f;
        modal.modal("hide");
    } else {
        _fileList.push({
            attname: h.val(),
            file: f
        });
        modal.modal("hide");
    }

    //$("#attachFileList")

});

$(document).on("show.bs.modal", "#modal-attach-list", function() {
    document.body.style.overflow = "hidden"
});

$(document).on("shown.bs.modal", "#modal-attach-list", function() { 
    document.body.classList.add("modal-open"); 
    _fileList = [];
    _filesDelete = [];
    _fileFormData = [];
    _attachList = [];
    genarateRow("#attachFileList");
})

$(document).on("hidden.bs.modal", "#modal-attach-list", function() {
    const modal = $(this);
    const pocode = modal.attr("ref-code");
    const acction = modal.attr("ref-actn");
    modal.removeAttr("ref-code");
    modal.removeAttr("ref-actn");
    _fileList = [];
    _filesDelete = [];
    _fileFormData = [];
    _attachList = [];
    genarateRow("#attachFileList");
    document.body.style.overflow = "auto"
    if (acction == "add") {
        toast(`สร้าง PO ${pocode} เสร็จสิ้น`);
        setTimeout(() => {
            window.location.reload();
        }, 1200);
    };

});

$(document).on("hidden.bs.modal", "#modal-attach", function() {
    $("body").addClass("modal-open");
    const modal = $(this);
    const ac_table = modal.attr("actable");
    modal.removeAttr("data-attach");
    onClearmModal(modal);
    genarateRow(ac_table);
});

$(document).on("change", "[req]", function() {
    let h = $(this);
    if (h.val()) {
        h.removeClass("border-danger");
        const s = h.closest(".form-group").find("label small");
        s.html("");
        s.addClass("d-none");
    } else {
        h.addClass("border-danger");
        const s = h.closest(".form-group").find("label small");
        s.html(
            "<strong class='text-danger font-italic'>กรุณากรอกข้อมูลให้ครบถ้วน</strong>"
        );
        s.removeClass("d-none");
    }
});

$(document).on("click", "#cancel-file", function() {
    //const modal = $(this).parents("div.modal");
    onClearmModal($(this).parents("div.modal"));
});

$(document).on("click", "#attachFile", function() {
    const btn = $(this);
    const recode = btn.attr("recode");
    uploadFiles(recode, "upd")?.then(r => {
        _filesDelete = [];
        _fileFormData = [];

        getAttachmentList(recode);
    });
});

$(document).on("hidden.bs.modal", "#modal_edit", function() {
    const modal = $(this);
    modal.find('.nav-link').removeClass("active");
    modal.find('.tab-pane').removeClass("active").removeClass("show");
    // modal.find('.tab-pane').removeClass("show");

    $("#modal_edit .nav-tabs .nav-item").eq(0).find("a").addClass("active");
    $("#modal_edit .tab-content .tab-pane").eq(0).addClass("active").addClass("show");
    // $("#modal_edit .tab-content .tab-pane").eq(0).addClass("show");
}); 

function onAttachment(code = null, acction = "add") {
    const modal = $("#modal-attach-list");
    modal.attr("ref-code", code);
    modal.attr("ref-actn", acction);

    modal.modal("show");
}

function openEditFile(e) {
    let elm = $(e.target);
    let modal = elm.parents("div.modal");
    const recode = modal.attr("ref-code");
    getAttachmentList(recode).then(r => {
        receiptAttachment(recode, "upd");
    });
}

function receiptAttachment(recode = null, acction = "add") {
    const modal = $("#modal-attach-list");
    modal.attr("ref-code", recode);
    modal.attr("ref-actn", acction);

    modal.modal("show");
}

async function getAttachmentList(recode) {
    return await $.get("ajax/upload_attachment.php", {
        c: recode
    }, function(res) {
        _filesDelete = [];
        _fileList = [];
        let attach = _attachList = res;
        for (let i in attach) {
            let pth = attach[i].url.split("//");
            let _f = pth[pth.length - 1];
            _fileList.push({
                attname: attach[i].attname,
                file: {
                    name: `<a class="font-weight-bold text-monospace" href="ajax/load_attachfile.php?path=${attach[i].url}" target="_BLANK" style="text-decoration: underline; color: #007bff !important;">${_f}</a>`
                },
                attached: true,
                code: attach[i].code,
            })
        };
        genarateRow("#attachFileList");
        return res;
    });
}

function uploadAttachment(e) {
    let btn = $($(e)[0].target);
    let modal = btn.parents("div.modal");
    const pocode = modal.attr("ref-code");
    const acction = modal.attr("ref-actn");
    uploadFiles(pocode, acction).then(r => {
        if (acction == "add")
            modal.modal("hide");
    });
}

async function uploadFiles(recode, acction = "add") {
    let formData = new FormData();
    if (_fileList.length > 0 || _filesDelete.length > 0) {
        let _i = 0;
        let _f = _fileList;
        //let isUpdate =  !!(_f.filter(f => f.attached)[0]);
        let fileUpdate = _f.filter(f => !!f?.upd);
        let fileAttach = _f.filter(f => !!!f.attached);
        for (let f of fileUpdate) {
            if (f.udf) formData.append(`file${f.code}`, f.file);
            let a = (_attachList.filter(e => e.code == f.code))[0];
            let p = a.url.split("//");
            let r = p[p.length - 1];
            _fileFormData.push({
                attname: f.attname,
                file_name: !f.udf ? f.attname : null,
                code: f.code,
                url: a.url,
                percode: a.percode,
                fname: r.slice(0, r.lastIndexOf(".")),
            });
        }

        for (let f of fileAttach) {
            formData.append("file[]", f.file);
            formData.append("attname[]", f.attname);
        }

        formData.append("fileData", JSON.stringify(_fileFormData));
        formData.append("fileDelete", JSON.stringify(_filesDelete));
        formData.append("recode", recode);
        formData.append("action", acction);
        return await $.ajax({
            type: "POST",
            url: "ajax/upload_attachment.php",
            processData: false,
            contentType: false,
            data: formData,
            success: async function(result) {
                if (result.status == 1) // Success
                {
                    toast(result.message, 'success');
                    //modal.modal("hide");
                } else {
                    toast("เกิดปัญหาในหารเพิ่มข้อมูลกรุณาลองใหม่อีกครั้ง", 'error');
                }

                return result;
            },
            error: function(error) {
                let mes = JSON.parse(error?.responseText || "{}");
                toast(mes?.message, 'error');

                return error;
            }
        });
    } else return null;
}

async function attached(e, t) {
    const FILE_REQUIRED = ["application/pdf", "image/jpg", "image/png", "image/jpeg"];
    const modal = $(e.target).parents("div.modal");
    const n = $(e.target);
    const f = n[0].files[0];
    if (!FILE_REQUIRED.includes(f.type)) {
        await Swal.fire(`ไฟล์ชนิดนี้ไม่ได้รับอนุญาตให้แนบ`, `กรุณาแนบไฟล์นามสกุลที่อนุญาติเท่านั้น`, 'warning');
        n.val(null);
        return;
    }
    const f_result = modal.find(".file-result");
    const t_result = $(f_result.html());
    const e_result = f_result.find(".f-empty");
    f_result.find("[attached]").remove();
    if (f?.name) {
        t_result.find(".mi").html(`<i class="far fa-file-alt"></i>`);
        t_result.find(".ms").html(`<strong>${f.name}</strong>`);
        t_result.attr("attached", "");
        e_result.removeClass("d-flex").addClass("d-none");
        t_result.removeClass("border-danger");
        f_result.append(t_result);
    } else {
        e_result.removeClass("d-none").addClass("d-flex border-danger");
    }
}

function onClearmModal(modal) {
    const e = modal.find(".f-empty");
    const f = modal.find(".modal-body [attached]");
    const h = modal.find(".modal-body input[name=attname]");
    const a = modal.find(".modal-body input[name=atthFile]");
    const s = h.closest(".form-group").find("label small");
    f.remove();
    h.val("").removeClass("border-danger");
    a.val(null);
    s.find("strong").remove();
    e.removeClass("d-none border-danger").addClass("d-flex");
    modal.modal("hide");

}

function genarateRow(t) {
    let tr = [];
    let f = _fileList;
    if (_fileList.length == 0) {
        $(`${t} tbody`).html(
            `<tr class="bg-transparent">
                <td colspan="4" align="left" class="bg-transparent border-0 text-secondary">ไม่มีข้อมูลไฟล์</td>
            </tr>`
        );

        return;
    }
    for (let i in _fileList) {
        let ti = f[i]?.attname;
        let fi = f[i]?.file;
        tr.push(
            `<tr>
                <td class="bg-white">${parseInt(i) + 1}</td>
                <td class="bg-white">${ti}</td>
                <td class="bg-white text-nowrap text-truncate" style='max-width: 300px;'>${fi.name}</td>
                <td class="bg-white">
                    <button type="button" class="btn-dl btn btn-xs btn-danger rounded-sm" style="width: 30px;" onclick="removeRow(this, ${i})" >
                        <i class="fas fa-trash-alt"></i>
                    </button>
                    ${(!!f[i].attached ? `
                    <button type="button" class="btn-ed btn btn-xs btn-info rounded-sm" style="width: 30px;" onclick="editRow(this, ${f[i].code})" >
                        <i class="fas fa-pencil-alt"></i>
                    </button>`:""
                    )}
                </td>
            </tr>`
        );
    }
    setTimeout(() => {
        $(`${t} tbody`).html(tr.join(""));
    }, 20);

}

async function editRow(e, index) {
    let a = (_attachList.filter((f) => f.code == index))[0]
    if (!a) {
        await toast("ไม่พบข้อมูลไฟล์", 'error');
        return;
    }
    const path = a.url.split("//");
    const name = path[path.length - 1];
    const modal = $("#modal-attach");
    const f_result = modal.find(".file-result");
    const t_result = $(f_result.html());
    const e_result = f_result.find(".f-empty");

    f_result.find("[attached]").remove();
    t_result.find(".mi").html(`<i class="far fa-file-alt"></i>`);
    t_result.find(".ms").html(`<strong>${name}</strong>`);
    t_result.attr("attached", "");
    e_result.removeClass("d-flex").addClass("d-none");
    t_result.removeClass("border-danger");
    f_result.append(t_result);

    const h = modal.find(".modal-body input[name=attname]");
    h.val(a.attname);

    let t = $(e).closest("table");

    modal.attr("data-attach", JSON.stringify(a));
    modal.attr("actable", `#${t.attr("id")}`);

    modal.modal("show");
}

function removeRow(e, index) {
    let t = $(e).closest("table");
    let fil = _attachList?.filter((f, i) => i == index);
    if (Array.isArray(fil) && !!fil[0]) {
        let f = fil[0];
        let p = f.url.split("//");
        let r = p[p.length - 1];
        _filesDelete.push({
            code: f.code,
            url: f.url,
            name: r,
            pocode: f.pocode
        });
        _attachList.splice(index, 1);
    }
    _fileList.splice(index, 1);
    genarateRow(`#${t.attr("id")}`);
}

function openMgnFile(t) {
    let m = $("#modal-attach");
    m.attr("actable", t);
    m.modal("show");
}
</script>