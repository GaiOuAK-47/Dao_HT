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
$(function() {


    $.ajax({
        type: "POST",
        url: "ajax/get_po.php",
        //    data: $("#frmMain").serialize(),
        success: function(result) {

            for (count = 0; count < result.pocode.length; count++) {

                $('#tablePO').append(
                    '<tr id="' + result.pocode[
                        count] +
                    '" data-toggle="modal" data-target="#modal_edit" data-whatever="' + result
                    .pocode[
                        count] + '" ><td>' + result.pocode[
                        count] +
                    '</td><td>' + result
                    .podate[count] + '</td><td>' + result
                    .stcode[count] + '</td><td>' + result.stname1[count] + '</td><td>' + result
                    .supname[count] + '</td><td style="text-align:center"><span title="' +
                    result.supstatus[count] + '">' + result.supstatus[count] +
                    '</span></td></tr>');
            }

            $('#tablePO').DataTable({
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

    $.ajax({
        type: "POST",
        url: "ajax/get_supplier.php",

        success: function(result) {

            for (count = 0; count < result.id.length; count++) {

                $('#table_supplier tbody').append(
                    '<tr data-toggle="modal" data-dismiss="modal"  id="' + result
                    .supcode[count] + '" onClick="onClick_supplier(this.id,\'' + result.supname[
                        count] + '\',\'' + result.address[count] + '\');"><td>' +
                    result.supcode[count] + '</td><td>' +
                    result.supname[count] + '</td></tr>');


            }

            $('#table_supplier').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": true,
                "ordering": true,
                "info": false,
                "autoWidth": false,
                "responsive": false
            });


            $(".dataTables_filter input[type='search']").css({
                'width': '80%'
            });
        }
    });

    $.ajax({
        type: "POST",
        url: "ajax/get_stock.php",

        success: function(result) {

            for (count = 0; count < result.id.length; count++) {

                $('#table_stock tbody').append(
                    '<tr data-toggle="modal" data-dismiss="modal"  id="' + result
                    .stcode[count] + '" "><td>' + (count + 1) + '</td><td>' +
                    result.stcode[count] + '</td><td>' +
                    result.stname1[count] + '</td></tr>');


            }

            $('#table_stock').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": true,
                "ordering": true,
                "info": false,
                "autoWidth": false,
                "responsive": false
            });


            $(".dataTables_filter input[type='search']").css({
                'width': '80%'
            });
        }
    });
})

$('#modal_unit').on('show.bs.modal', function(event) {
    var button = $(event.relatedTarget)
    var recipient = button.data('whatever')
    var modal = $(this);

    $.ajax({
        type: "POST",
        url: "ajax/get_unit.php",

        success: function(result) {
            $('#table_unit tbody').empty();
            for (count = 0; count < result.unitcode.length; count++) {

                $('#table_unit tbody').append(
                    '<tr data-toggle="modal" data-dismiss="modal" onClick="onClick_unit(\'' +
                    result.unit[count] + '\',\'' + recipient + '\');"  id="' +
                    result
                    .unitcode[count] + '" );"><td>' + (count + 1) +
                    '</td><td>' +
                    result.unit[count] + '</td></tr>');


            }


        }
    });
})

function getTotal(row) {
    $('#total' + row).val(formatMoney(($('#amount' + row).val() *
        $('#price' +
            row).val()) - ((($('#amount' + row).val() *
        $(
            '#price' + row).val()) * $(
        '#discount' +
        row).val()) / 100), 2));

}

$('#btnPrintPO').click(function() {
    // <a href='ajax/view.php?s=${m.socode}' target='ajax/view.php?s=${m.socode}' >${m.socode}</a>
    window.open('form/view.php?pocode=' + $('#pocode').val(), '_blank');
});

$('#btnCanclePO').click(function() {
    Swal.fire({
        title: 'ต้องการยกเลิกใบสั่งซื้อสินค้าใช่ไหม',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'ยกเลิกใบสั่งซื้อสินค้า'
    }).then((result) => {
        if (result.isConfirmed) {

            let id = $('#pocode').val()
            $.ajax({
                type: "POST",
                url: "ajax/cancle_po.php",
                data: "idcode=" + id,
                success: async function(result) {

                    await Swal.fire('สำเร็จ', result.message, 'success');
                    window.location.reload();

                }
            });
        }
    })
});

$('#add_supcode').change(function() {
    let id = $('#add_supcode').val()

    $.ajax({
        type: "POST",
        url: "ajax/getsup_supplier.php",
        data: "idcode=" + id,
        success: async function(result) {

            if (result.supcode.length != 0) {
                $('#add_supcode').val(result.supcode);
                $('#add_supname').val(result.supname);
                $('#add_address').val(result.address);
            } else {
                Swal.fire('เกิดข้อผิดพลาด', "ไม่พบผู้ขายรหัส " + id, 'error');
                $('#add_supcode').val('');
                $('#add_supname').val('');
                $('#add_address').val('');
            }

        }
    });
});

// เพิ่ม po detail เมื่อเลือกสต๊อก
$("#table_stock").delegate('tr', 'click', function() {
    let id = $(this).attr("id");

    $('#btnClearPOdetail').show();
    $.ajax({
        type: "POST",
        url: "ajax/getsup_stock.php",
        data: "idcode=" + id,
        success: function(result) {
            // alert(result)
            var today = new Date();
            var dd = today.getDate() + 7;

            var mm = today.getMonth() + 1;
            var yyyy = today.getFullYear();
            if (dd < 10) {
                dd = '0' + dd;
            }

            if (mm < 10) {
                mm = '0' + mm;
            }
            today = yyyy + '-' + mm + '-' + dd;
            // console.log(today);
            let all_row = []
            // $('#tablePoDetail tbody tr').each(function() {
            //     row.push($(this).find("td #stcode" + (++key)).text());
            // });
            $('#tablePoDetail tbody tr').each(function() {
                all_row.push($(this).attr("id"));
            });


            if (all_row.length == 0)
                all_row = 1;
            else {
                all_row = parseInt(all_row[(all_row.length - 1)].substring(3, 4)) + 1
            }

            onCreate_detail($('#tablePoDetail tr').length, result.stcode, result.stname1, 1, result
                .unit, result.price, 0)

        }
    });


});

function onCreate_detail(row, stcode, stname1, amount, unit, price, discount) {

    $('#tablePoDetail tbody').append(
        '<tr id="new' + row +
        '" ><td name="pono" id="pono" ><p class="form-check-label" style="text-align:center">' +
        row +
        '</p></td><td><p class="form-check-label" name="stcode"  id="stcode' +
        row +
        '" style="text-align:left">' +
        stcode +
        '</p></td><td><p class="form-check-label" name="stname1"  id="stname1' +
        row +
        '" style="text-align:left">' +
        stname1 +
        '</p></td><td><input type="text" class="form-control" name="amount"  id="amount' +
        row +
        '"  onChange="getTotal(' +
        row +
        ');" value="' +
        amount +
        '"></td><td><div class="input-group"><input type="text" class="form-control" name="unit" id="unit' +
        row + '" value="' +
        unit +
        '" disabled><span class="input-group-btn"><button class="btn btn-default" data-toggle="modal" data-target="#modal_unit" data-whatever="' +
        row +
        ',tablePoDetail,' +
        stcode +
        '" type="button"><span class="fa fa-search"></span></button></span></div></td><td><input type="text" class="form-control" name="price" id="price' +
        row +
        '" onChange="getTotal(' +
        row +
        ');" value="' +
        price +
        '"></td><td><div class="input-group"><input type="text" class="form-control" name="discount" id="discount' +
        row +
        '" onChange="getTotal(' +
        row +
        ');" value="' +
        discount +
        '"><div class="input-group-append"><span class="input-group-text">%</span></div></td><td><input type="text" class="form-control" name="total" id="total' +
        row +
        '" value="0.00" disabled></td><td><button type="button" onClick="onDelete_MainTable(' +
        row +
        ',\'add\')"; class="btn btn-danger form-control" ><i class="fa fa fa-times" aria-hidden="true"></i class=> </button></td></tr>'
    );

    getTotal(row);


}

function onDelete_MainTable(row) {
    var tmpstcode = [];
    var tmpstname1 = [];
    var tmpunit = [];
    var tmpamount = [];
    var tmpsellprice = [];
    var tmpdiscount = [];
    var all_row = $('#tablePoDetail tbody tr').length;

    for (var i = row + 1; i <= all_row; i++) {
        tmpstcode.push($('#stcode' + i).text());
        tmpstname1.push($('#stname1' + i).text());
        tmpamount.push($('#amount' + i).val());
        tmpunit.push($('#unit' + i).val());
        tmpsellprice.push($('#price' + i).val());
        tmpdiscount.push($('#discount' + i).val());
    }

    for (var d = row; d <= all_row; d++)
        $("#new" + d).remove();

    for (var j = 0; j < tmpstcode.length; j++)
        onCreate_detail($('#tablePoDetail tr').length, tmpstcode[j], tmpstname1[j], tmpamount[j], tmpunit[j],
            tmpsellprice[j], tmpdiscount[j])

    // onCreate_detail(tmpstcode[j], tmpstname1[j], tmpunit[j], tmpsellprice[j]);

}

$('#modal_add').on('show.bs.modal', function(event) {

    $("#add_podate").val(new Date().toISOString().substring(0, 10));
    $("#add_deldate").val(new Date().toISOString().substring(0, 10));
    $.ajax({
        type: "POST",
        url: "ajax/get_pocode.php",
        success: function(result) {

            $("#add_pocode").val(result.pocode);

        }
    });
});

$('#modal_edit').on('show.bs.modal', function(event) {
    var button = $(event.relatedTarget);
    var pocode = button.data('whatever');
    var modal = $(this);
    modal.attr("ref-code", pocode);
    $("#tablePoDetail tbody").empty();

    $.ajax({
        type: "POST",
        url: "ajax/getsup_po.php",
        data: "idcode=" + pocode,
        success: function(result) {

            $("#pocode").val(result.pocode);
            $("#supcode").val(result.supcode);
            $("#supname").val(result.supname);
            $("#address").val(result.address);
            $("#podate").val(result.podate);
            $("#deldate").val(result.deldate);
            $("#payment").val(result.payment);
            $("#poqua").val(result.poqua);
            $("#currency").val(result.currency);
            modal.find("input[name=vat][value=" + result.vat + "]").prop('checked', true);
            $("#remark").val(result.remark);


            $.ajax({
                type: "POST",
                url: "ajax/getsup_podetail.php",
                data: "idcode=" + pocode,
                success: function(result) {
                    for (count = 0; count < result.stcode.length; count++) {

                        $('#tableEditPoDetail tbody').append(
                            '<tr id="' + result.pono[count] +
                            '" ><td name="pono" id="pono" ><p class="form-check-label" style="text-align:center">' +
                            result.pono[count] +
                            '</p></td><td><p  id="stcode' + result.pono[count] +
                            '" class="form-check-label" style="text-align:center">' +
                            result
                            .stcode[count] +
                            '</p></td><td> <p class="form-check-label" style="text-align:left">' +
                            result.stname1[count] +
                            '</p></td><td><input type="text" class="form-control" onChange="getTotal(' +
                            result
                            .pono[count] + ');" name="amount"  id="amount' +
                            result.pono[count] +
                            '"  value="' +
                            result.amount[count] +
                            '"></td><td><input type="text" class="form-control" name="recamount"  id="recamount' +
                            result.pono[count] +
                            '"  value="' +
                            result.recamount[count] +
                            '" disabled></td><td ><div class="input-group"><input type="text" class="form-control" name="unit" id="unit' +
                            result.pono[count] + '" value="' +
                            result.unit[count] +
                            '" disabled><div class="input-group-append"><button class="btn btn-default" data-toggle="modal" data-target="#modal_unit" data-whatever="' +
                            result.pono[count] +
                            ',tableEditPoDetail,' +
                            result
                            .stcode[count] +
                            '" type="button"><span class="fa fa-search"></span></button></div></div></td><td><input type="text" class="form-control" onChange="getTotal(' +
                            result.pono[count] + ');" name="price" id="price' +
                            result.pono[count] + '" value="' +
                            result.price[count] +
                            '"></td><td><div class="input-group"><input type="text" class="form-control" name="discount" id="discount' +
                            result.pono[count] +
                            '" onChange="getTotal(' +
                            result.pono[count] +
                            ');" value="' +
                            result.discount[count] +
                            '"><div class="input-group-append"><span class="input-group-text">%</span></div></td><td><input type="text" style="min-width: 100px;text-align:right" class="form-control" name="total" id="total' +
                            result.pono[count] +
                            '" value="0.00" disabled></td></tr>'
                        );
                        getTotal(result.pono[count]);

                        // $disable = '';
                        if (result.supstatus[count] == 'รับครบแล้ว') {
                            $('#podate').prop("readonly", true);
                            $('#deldate').prop("readonly", true);
                            $('#payment').prop("disabled", true);
                            $('#poqua').prop("readonly", true);
                            $('#currency').prop("disabled", true);
                            $("#tableEditPoDetail tbody input").prop("readonly",
                                true
                            );                      
                            $("#btnCanclePO").hide()
                            $("#btnEditSo").hide()
                            $("#btnPrintPO").show()
                        } else if (result
                            .supstatus[
                                count] == 'ยกเลิก') {
                                    $('#podate').prop("readonly", true);
                            $('#deldate').prop("readonly", true);
                            $('#payment').prop("disabled", true);
                            $('#poqua').prop("readonly", true);
                            $('#currency').prop("disabled", true);
                            $("#tableEditPoDetail tbody input").prop("readonly",
                                true
                            );                      
                            $("#btnCanclePO").hide()
                            $("#btnEditSo").hide()
                            $("#btnPrintPO").hide()

                        } else {
                            $("#btnCanclePO").show()
                            $("#btnPrintPO").show()
                            $("#btnEditSo").show()

                            $('#podate').prop("readonly", false);
                            $('#deldate').prop("readonly", false);
                            $('#payment').prop("disabled", false);
                            $('#poqua').prop("readonly", false);
                            $('#currency').prop("disabled", false);
                            $("#tableEditPoDetail tbody input[name*='unit']").prop(
                                "readonly",
                                true);
                        }

                    }

                }
            });
        }
    });
    getAttachmentList(pocode)
    $("#divfrmEditPO").show();

    $("#tableEditPoDetail tbody").empty();
});

function onClick_unit(unit, target) {

    var row = target.split(',')[0];
    var id = target.split(',')[1];
    var stcode = target.split(',')[2];

    // alert(target + ' ' + stcode);
    $('#unit' + row).val(unit);

}

function onClick_supplier(id, supname, address) {
    $('#add_supcode').val(id);
    $('#add_supname').val(supname);
    $('#add_address').val(address);
}

$("#btnRefresh").click(function() {
    window.location.reload();
});

// กดยืนยันเพิ่ม PO
$("#frmAddPO").submit(function(event) {
    event.preventDefault();

    let amount = [];
    let stcode = [];
    let unit = [];
    let price = [];
    let discount = [];


    // $('#tablePoDetail tbody tr').each(function(key) {
    //     stcode.push($(this).find("td #stcode" + (++key)).text());
    // });

    $('#tablePoDetail tbody tr').each(function(key) {
        stcode.push($(this).find("td #stcode" + (++key)).text());
    });
    $('#tablePoDetail tbody tr').each(function(key) {
        amount.push($(this).find("td #amount" + (++key)).val());
    });
    $('#tablePoDetail tbody tr').each(function(key) {
        unit.push($(this).find("td #unit" + (++key)).val());
    });
    $('#tablePoDetail tbody tr').each(function(key) {
        price.push($(this).find("td #price" + (++key)).val());
    });
    $('#tablePoDetail tbody tr').each(function(key) {
        discount.push($(this).find("td #discount" + (++key)).val());
    });
    // alert(stcode)

    if (stcode != 0) {

        $.ajax({
            type: "POST",
            url: "ajax/add_po.php",
            data: $("#frmAddPO").serialize() + "&amount=" + amount + "&stcode=" + stcode +
                "&unit=" + unit +
                "&price=" + price +
                "&discount=" + discount,
            success: async function(result) {
                if (result.status == 1) {
                    toast(result.message, 'success');
                    $(event.target).closest("div.modal").modal("hide");

                    poAttachment(result.response_code);
                    //window.location.reload();
                    //console.log(event,  $(this).closest("div.modal"));
                } else {
                    Swal.fire('เกิดข้อผิดพลาด', "รหัสซ้ำ", 'error');
                    console.log(result.message);
                }
            }
        });
    } else {
        Swal.fire('เกิดข้อผิดพลาด', "กรุณาเพิ่มรายการสินค้า", 'error');
    }
});

// กดยืนยันแก้ไข PO
$("#frmEditPO").submit(function(event) {
    event.preventDefault();
    let pocode = $(this).find("[name=pocode]").val();
    var amount = [];
    var stcode = [];
    var unit = [];
    var price = [];
    var discount = [];

    // $('#tableEditPoDetail tbody tr').each(function() {
    //     stcode.push($(this).attr("id"));
    // });
    $('#tableEditPoDetail tbody tr').each(function(key) {
        stcode.push($(this).find("td #stcode" + (++key)).text());
    });
    $('#tableEditPoDetail tbody tr').each(function(key) {
        amount.push($(this).find("td #amount" + (++key)).val());
    });
    $('#tableEditPoDetail tbody tr').each(function(key) {
        unit.push($(this).find("td #unit" + (++key)).val());
    });
    $('#tableEditPoDetail tbody tr').each(function(key) {
        price.push($(this).find("td #price" + (++key)).val());
    });
    $('#tableEditPoDetail tbody tr').each(function(key) {
        discount.push($(this).find("td #discount" + (++key)).val());
    });

    // alert(stcode)



    $.ajax({
        type: "POST",
        url: "ajax/edit_po.php",
        data: $("#frmEditPO").serialize() + "&amount=" + amount + "&stcode=" + stcode +
            "&unit=" + unit +
            "&price=" + price +
            "&discount=" + discount,
        success: async function(result) {
            if (result.status == 1) {
                Swal.fire('', result.message, 'success').then(() => {
                    uploadFiles(pocode, "upd").then(r => {
                        setTimeout(() => {
                            window.location.reload();
                        }, !!r ? 800 : 200);
                    });
                });
            } else {
                Swal.fire('เกิดข้อผิดพลาด', "รหัสซ้ำ", 'error');
                console.log(result.message);
            }
        }
    });

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

$(document).on("shown.bs.modal", "#modal-attach-list", function() {
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

    if (acction == "add") {
        toast(`สร้าง PO ${pocode} เสร็จสิ้น`);
        setTimeout(() => {
            window.location.reload();
        }, 1200);
    }
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

$(document).on("hidden.bs.modal", "#modal_edit", function() {
    const modal = $(this);
    modal.find('.nav-link').removeClass("active");
    modal.find('.tab-pane').removeClass("active").removeClass("show");
    // modal.find('.tab-pane').removeClass("show");

    $("#modal_edit .nav-tabs .nav-item").eq(0).find("a").addClass("active");
    $("#modal_edit .tab-content .tab-pane").eq(0).addClass("active").addClass("show");
    // $("#modal_edit .tab-content .tab-pane").eq(0).addClass("show");
});

function openEditFile(e) {
    let elm = $(e.target);
    let modal = elm.parents("div.modal");
    const pocode = modal.attr("ref-code");
    getAttachmentList(pocode).then(r => {
        poAttachment(pocode, "upd");
    });
} 

function poAttachment(pocode = null, acction = "add") {
    const modal = $("#modal-attach-list");
    modal.attr("ref-code", pocode);
    modal.attr("ref-actn", acction);

    modal.modal("show");
}

async function getAttachmentList(pocode) {
    return await $.get("ajax/upload_attachment.php", {
        c: pocode
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

async function uploadFiles(pocode, acction = "add") {
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
        formData.append("pocode", pocode);
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
                console.log(error.responseText);
                toast(error.responseText, 'error');

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