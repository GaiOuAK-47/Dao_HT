<script type="text/javascript">
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
        url: "ajax/get_so.php",
        //    data: $("#frmMain").serialize(),
        success: function(result) {

            for (count = 0; count < result.socode.length; count++) {

                $('#tableSO').append(
                    '<tr id="' + result.socode[
                        count] +
                    '" data-toggle="modal" data-target="#modal_edit" data-whatever="' + result
                    .socode[
                        count] + '" ><td>' + result.socode[
                        count] +
                    '</td><td>' + result
                    .sodate[count] + '</td><td>' + result
                    .sotype[count] + '</td><td>' + result
                    .stcode[count] + ' ' + result.stname1[count] + '</td><td>' + result
                    .cusname[count] + '</td><td style="text-align:center">' + result
                    .delstatus[count] + '</td><td style="text-align:center"><span title="' +
                    result.supstatus[count] + '">' + result.supstatus[count] +
                    '</span></td></tr>');
            }

            $('#tableSO').DataTable({
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
        url: "ajax/get_customer.php",

        success: function(result) {

            for (count = 0; count < result.id.length; count++) {

                $('#table_customer tbody').append(
                    '<tr data-toggle="modal" data-dismiss="modal"  id="' + result
                    .cuscode[count] + '" onClick="onClick_customer(this.id,\'' + result.cusname[
                        count] + '\',\'' + result.address[count] + '\');"><td>' +
                    result.cuscode[count] + '</td><td>' +
                    result.cusname[count] + '</td></tr>');


            }

            $('#table_customer').DataTable({
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
                    '<tr id="' + result
                    .stcode[count] + ',' + result
                    .amount[count] + '" "><td>' + (count + 1) + '</td><td>' +
                    result.stcode[count] + '</td><td>' +
                    result.stname1[count] + '</td><td>' +
                    result.amount[count] + '</td><td>' +
                    result.unit[count] + '</td></tr>');

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

function getTotalPrice(type) {
    let total = 0;
    if (type == 'add') {
        total = (parseFloat($('#add_installment').val() * $('#add_netinstallment').val()) + parseFloat($('#add_downpay')
            .val()))
        $('#add_totalprice').val(total)
    } else {
        total = ((parseFloat($('#installment').val() * $('#netinstallment').val())) + parseFloat($('#downpay').val()))
        $('#totalprice').val(total)
    }

}

function getTotal(row) {
    $('#total' + row).val(formatMoney(($('#amount' + row).val() *
        $('#price' +
            row).val()) - ((($('#amount' + row).val() *
        $(
            '#price' + row).val()) * $(
        '#discount' +
        row).val()) / 100), 2));

}


$('#btnConfirmDel').click(function() {
    Swal.fire({
        title: 'ต้องการยืนยันการส่งสินค้าใช่ไหม',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'ยืนยันส่งสินค้า'
    }).then((result) => {
        if (result.isConfirmed) {

            let id = $('#socode').val()
            $.ajax({
                type: "POST",
                url: "ajax/approve_del.php",
                data: "idcode=" + id + "&flg=1",
                success: async function(result) {

                    await Swal.fire('สำเร็จ', result.message, 'success');
                    window.location.reload();

                }
            });
        }
    })
});

$('#btnCanclDel').click(function() {
    Swal.fire({
        title: 'ต้องการยกเลิกการส่งสินค้าใช่ไหม',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'ยกเลิกส่งสินค้า'
    }).then((result) => {
        if (result.isConfirmed) {

            let id = $('#socode').val()
            $.ajax({
                type: "POST",
                url: "ajax/approve_del.php",
                data: "idcode=" + id + "&flg=0",
                success: async function(result) {

                    await Swal.fire('สำเร็จ', result.message, 'success');
                    window.location.reload();

                }
            });
        }
    })
});

$('#btnCancleSOdetail').click(function() {
    Swal.fire({
        title: 'ต้องการยกเลิกใบขายสินค้าใช่ไหม',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'ยกเลิกใบขายสินค้า'
    }).then((result) => {
        if (result.isConfirmed) {

            let id = $('#socode').val()
            $.ajax({
                type: "POST",
                url: "ajax/cancle_so.php",
                data: "idcode=" + id,
                success: async function(result) {

                    await Swal.fire('สำเร็จ', result.message, 'success');
                    window.location.reload();

                }
            });
        }
    })
});


$('#btnPrintSO').click(function() {
    // alert($('#socode').val())
    window.open('form/view.php?socode=' + $('#socode').val(), '_blank');
});

// เพิ่ม po detail เมื่อเลือกสต๊อก
$("#table_stock").delegate('tr', 'click', function() {
    let target = $(this).attr("id");
    let id = target.split(',')[0];
    let amount = target.split(',')[1];

    let stcode = [];
    $('#tableSODetail tbody tr').each(function(key) {
        stcode.push($(this).find("td #stcode" + (++key)).text());
    });

    if (jQuery.inArray(id, stcode) == -1) {
        if (amount != 0) {
            $('#modal_stock').modal('hide');
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
                    $('#tableSODetail tbody tr').each(function() {
                        all_row.push($(this).attr("id"));
                    });


                    if (all_row.length == 0)
                        all_row = 1;
                    else {
                        all_row = parseInt(all_row[(all_row.length - 1)].substring(3, 4)) + 1
                    }

                    onCreate_detail($('#tableSODetail tr').length, result.stcode, result.stname1, 1,
                        result
                        .unit, result
                        .price, 0, result
                        .cost)

                }
            });
        } else {
            Swal.fire('เกิดข้อผิดพลาด', "สต๊อก " + id + " ไม่เพียงพอ", 'error');
        }
    } else {
        Swal.fire('เกิดข้อผิดพลาด', "รหัสสินค้าซ้ำ", 'error');
    }

});

function onCreate_detail(row, stcode, stname1, amount, unit, price, discount, cost) {

    $('#tableSODetail tbody').append(
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
        ',\'add\')"; class="btn btn-danger form-control" ><i class="fa fa fa-times" aria-hidden="true"></i class=></button><input type="hidden" class="form-control" name="cost" id="cost' +
        row +
        '"  value="' +
        cost +
        '"></td></tr>'
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
    var tmpcost = [];
    var all_row = $('#tableSODetail tbody tr').length;

    for (var i = row + 1; i <= all_row; i++) {
        tmpstcode.push($('#stcode' + i).text());
        tmpstname1.push($('#stname1' + i).text());
        tmpamount.push($('#amount' + i).val());
        tmpunit.push($('#unit' + i).val());
        tmpsellprice.push($('#price' + i).val());
        tmpdiscount.push($('#discount' + i).val());
        tmpcost.push($('#cost' + i).val());
    }

    for (var d = row; d <= all_row; d++)
        $("#new" + d).remove();

    for (var j = 0; j < tmpstcode.length; j++)
        onCreate_detail($('#tableSODetail tr').length, tmpstcode[j], tmpstname1[j], tmpamount[j], tmpunit[j],
            tmpsellprice[j], tmpdiscount[j], tmpcost[j])

    // onCreate_detail(tmpstcode[j], tmpstname1[j], tmpunit[j], tmpsellprice[j]);

}

$('#modal_add').on('show.bs.modal', function(event) {

    $("#add_sodate").val(new Date().toISOString().substring(0, 10));
    $("#add_deldate").val(new Date().toISOString().substring(0, 10));
    $("#add_downpaydate").val(new Date().toISOString().substring(0, 10));
    $("#add_firstpaydate").val(new Date().toISOString().substring(0, 10));

});

$("#btnTypeNormal").click(function() {
    $.ajax({
        type: "POST",
        url: "ajax/get_socode.php",
        success: function(result) {

            $("#add_socode").val(result.socode);
            $("#add_sotype").val('ผ่อนสินค้า');
            stepper.next();
        }
    });
});

$("#btnTypeGold").click(function() {
    $.ajax({
        type: "POST",
        url: "ajax/get_sogoldcode.php",
        success: function(result) {

            $("#add_socode").val(result.socode);
            $("#add_sotype").val('ผ่อนทอง');
            stepper.next();
        }
    });
});

// $('#add_sodate').change(function() {
//     let sodate = $('#add_sodate').val()

//     $.ajax({
//         type: "POST",
//         url: "ajax/get_socode.php",
//         data: "sodate=" + sodate,
//         success: function(result) {

//             $("#add_socode").val(result.socode);

//         }
//     });
// });

$('#modal_edit').on('show.bs.modal', function(event) {
    let button = $(event.relatedTarget);
    let socode = button.data('whatever');
    let modal = $(this);

    $("#tableEditSODetail tbody").empty();

    $.ajax({
        type: "POST",
        url: "ajax/getsup_so.php",
        data: "idcode=" + socode,
        success: function(result) {
            // alert(result)
            $("#socode").val(result.socode);
            $("#cuscode").val(result.cuscode);
            $("#cusname").val(result.cusname);
            $("#address").val(result.address);
            $("#sodate").val(result.sodate);
            $("#deldate").val(result.deldate);
            $("#downpaydate").val(result.downpaydate);
            $("#firstpaydate").val(result.firstpaydate);
            $("#payment").val(result.payment);
            $("#downpay").val(result.downpay);
            $("#installment").val(result.installment);
            $("#netinstallment").val(result.netinstallment);
            $("#round").val(result.round);
            $("#remark").val(result.remark);

            if (result.delstatus == 'ยังไม่ส่งของ') {
                $("#btnConfirmDel").show();
                $("#btnCanclDel").hide();
            } else {
                $("#btnConfirmDel").hide();
                $("#btnCanclDel").show();
            }



            $.ajax({
                type: "POST",
                url: "ajax/getsup_sodetail.php",
                data: "idcode=" + socode,
                success: function(result) {
                    let cost = 0
                    for (count = 0; count < result.stcode.length; count++) {

                        $('#tableEditSODetail tbody').append(
                            '<tr id="' + result.sono[count] +
                            '" ><td name="sono" id="sono' + result.sono[count] +
                            '" ><p class="form-check-label" style="text-align:center">' +
                            result.sono[count] +
                            '</p></td><td><p  id="stcode' + result.sono[count] +
                            '" class="form-check-label" style="text-align:center">' +
                            result
                            .stcode[count] +
                            '</p></td><td> <p class="form-check-label" style="text-align:left">' +
                            result.stname1[count] +
                            '</p></td><td><input type="text" class="form-control" onChange="getTotal(' +
                            result
                            .sono[count] + ');" name="amount"  id="amount' +
                            result.sono[count] +
                            '"  value="' +
                            result.amount[count] +
                            '"></td><td ><div class="input-group"><input type="text" class="form-control" name="unit" id="unit' +
                            result.sono[count] + '" value="' +
                            result.unit[count] +
                            '" readonly><div class="input-group-append"><button class="btn btn-default" data-toggle="modal" data-target="#modal_unit" data-whatever="' +
                            result.sono[count] +
                            ',tableEditSODetail,' +
                            result
                            .stcode[count] +
                            '" type="button"><span class="fa fa-search"></span></button></div></div></td><td><input type="text" class="form-control" name="cost"  id="cost' +
                            result.sono[count] +
                            '"  value="' +
                            result.cost[count] +
                            '" readonly></td><td><input type="text" class="form-control" onChange="getTotal(' +
                            result.sono[count] + ');" name="price" id="price' +
                            result.sono[count] + '" value="' +
                            result.price[count] +
                            '"></td><td><div class="input-group"><input type="text" class="form-control" name="discount" id="discount' +
                            result.sono[count] +
                            '" onChange="getTotal(' +
                            result.sono[count] +
                            ');" value="' +
                            result.discount[count] +
                            '"><div class="input-group-append"><span class="input-group-text">%</span></div></td><td><input type="text" style="min-width: 100px;text-align:right" class="form-control" name="total" id="total' +
                            result.sono[count] +
                            '" value="0.00" readonly></td></tr>'
                        );
                        getTotal(result.sono[count]);

                        cost += parseFloat(result.cost[count])

                        if (result
                            .supstatus[
                                count] == 'ยกเลิก') {
                            $('#sodate').prop("readonly", true);
                            $('#deldate').prop("readonly", true);
                            $('#downpaydate').prop("readonly", true);
                            $('#firstpaydate').prop("readonly", true);
                            $('#payment').attr("disabled", true);
                            $('#downpay').prop("readonly", true);
                            $('#installment').prop("readonly", true);
                            $('#netinstallment').prop("readonly", true);
                            $('#round').prop("readonly", true);
                            $("#tableEditSODetail tbody input").prop("readonly",
                                true
                            );
                            $('#btnPrintSO').hide();
                            $('#btnPrintInvoice').hide();
                            $('#btnConfirmDel').hide();
                            $('#btnCanclDel').hide();
                            $('#btnCancleSOdetail').hide();

                        } else if (result.supstatus[count] == 'ชำระเงินครบแล้ว') {
                            $('#sodate').prop("readonly", true);
                            $('#deldate').prop("readonly", true);
                            $('#downpaydate').prop("readonly", true);
                            $('#firstpaydate').prop("readonly", true);
                            $('#payment').attr("disabled", true);
                            $('#downpay').prop("readonly", true);
                            $('#installment').prop("readonly", true);
                            $('#netinstallment').prop("readonly", true);
                            $('#round').prop("readonly", true);
                            $("#tableEditSODetail tbody input").prop("readonly",
                                true
                            );
                            $('#btnPrintSO').show();
                            $('#btnPrintInvoice').show();
                            $('#btnCancleSOdetail').hide();
                        } else {

                            $('#sodate').prop("readonly", false);
                            $('#deldate').prop("readonly", false);
                            $('#downpaydate').prop("readonly", false);
                            $('#firstpaydate').prop("readonly", false);
                            $('#payment').prop("disabled", false);
                            $('#downpay').prop("readonly", false);
                            $('#installment').prop("readonly", false);
                            $('#netinstallment').prop("readonly", false);
                            $('#round').prop("readonly", false);
                            $("#tableEditSODetail tbody input[name*='unit']").prop(
                                "readonly",
                                true);
                            $('#btnPrintSO').show();
                            $('#btnPrintInvoice').show();
                            // $('#btnConfirmDel').show(); 
                            // $('#btnCanclDel').show(); 
                            $('#btnCancleSOdetail').show();
                        }

                    }
                    $('#cost').val(cost);
                }
            });

            getTotalPrice('edit')

            $.ajax({
                type: "POST",
                url: "ajax/get_tablepayment.php",
                data: "idcode=" + socode,
                success: function(result) {

                    // alert(result.price)
                    CreatePaymentTable(result.date, result.status)


                }
            });


        }
    });

    let totalre = 0;
    let totalsumpay = 1;

    $.ajax({
        type: "POST",
        url: "ajax/getsup_totalre.php",
        data: "idcode=" + socode,
        success: function(result) {
            // console.log(result)
            $("#receipt-list-table tbody").empty();
            if (result.recode.length != 0) {
                // alert(result.recode.length)
                for (count = 0; count < result.recode.length; count++) {

                    $('#receipt-list-table tbody').append('<tr id="re' + result
                        .payround[
                            count] +
                        '" ><td name="re" id="re' + result.payround[count] +
                        '" ><p class="form-check-label" style="text-align:center">' +
                        result.payround[count] +
                        '</p></td><td><p  id="recode' + result.payround[
                            count] +
                        '" class="form-check-label" style="text-align:center">' +
                        result
                        .recode[count] +
                        '</p></td><td> <p class="form-check-label" style="text-align:center">' +
                        result.stylepayment[count] +
                        '</p></td><td> <p class="form-check-label" style="text-align:center">' +
                        result.status[count] +
                        '</p></td><td><p  id="remark' + result.payround[
                            count] +
                        '" class="form-check-label" style="text-align:center">' +
                        result
                        .remark[count] +
                        '</p></td><td><p  id="price' + result.payround[
                            count] +
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
        }
    });

    $("#divfrmEditSO").show();

    $("#tableEditSODetail tbody").empty();
});

function onClick_unit(unit, target) {

    var row = target.split(',')[0];
    var id = target.split(',')[1];
    var stcode = target.split(',')[2];

    // alert(target + ' ' + stcode);
    $('#unit' + row).val(unit);

}

function onClick_customer(id, cusname, address) {
    $('#add_cuscode').val(id);
    $('#add_cusname').val(cusname);
    $('#add_address').val(address);
}

$("#btnRefresh").click(function() {
    window.location.reload();
});

// เปลี่ยนไปหน้า เพิ่ม frmAddSOdetail
$("#frmAddSO").submit(function(event) {

    let stcode = [];
    let cost = 0;
    $('#tableSODetail tbody tr').each(function(key) {
        stcode.push($(this).find("td #stcode" + (++key)).text());
    });
    $('#tableSODetail tbody tr').each(function(key) {
        cost += parseFloat($(this).find("td #cost" + (++key)).val());
    });

    if (stcode != 0) {
        stepper.next();
        $('#add_cost').val(cost);
    } else {
        Swal.fire('เกิดข้อผิดพลาด', "กรุณาเพิ่มรายการสินค้า", 'error');
    }
});

// กดยืนยันเพิ่ม SO
$("#frmAddSOdetail").submit(function(event) {
    event.preventDefault();

    let amount = [];
    let stcode = [];
    let unit = [];
    let price = [];
    let discount = [];
    let cost = [];

    // $('#tablePoDetail tbody tr').each(function(key) {
    //     stcode.push($(this).find("td #stcode" + (++key)).text());
    // });

    $('#tableSODetail tbody tr').each(function(key) {
        stcode.push($(this).find("td #stcode" + (++key)).text());
    });
    $('#tableSODetail tbody tr').each(function(key) {
        amount.push($(this).find("td #amount" + (++key)).val());
    });
    $('#tableSODetail tbody tr').each(function(key) {
        unit.push($(this).find("td #unit" + (++key)).val());
    });
    $('#tableSODetail tbody tr').each(function(key) {
        price.push($(this).find("td #price" + (++key)).val());
    });
    $('#tableSODetail tbody tr').each(function(key) {
        discount.push($(this).find("td #discount" + (++key)).val());
    });
    $('#tableSODetail tbody tr').each(function(key) {
        cost.push($(this).find("td #cost" + (++key)).val());
    });
    // alert(add_sotype)
    // alert($("#frmAddSO").serialize())

    if (stcode != 0) {

        $('#add_sotype').prop("disabled", false);

        $.ajax({
            type: "POST",
            url: "ajax/add_so.php",
            data: $("#frmAddSO").serialize() + $("#frmAddSOdetail").serialize() + "&amount=" + amount +
                "&stcode=" + stcode +
                "&unit=" + unit +
                "&price=" + price +
                "&discount=" + discount +
                "&cost=" + cost +
                "&id=" + '<?php echo $_SESSION['id'];?>',
            success: async function(result) {
                if (result.status == 1) {
                    await Swal.fire('สำเร็จ', result.message, 'success');
                    window.location.reload();
                    // console.log(result.sql);
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

// กดยืนยันแก้ไข SO
$("#frmEditSO").submit(function(event) {
    event.preventDefault();

    var amount = [];
    var stcode = [];
    var unit = [];
    var price = [];
    var discount = [];


    // $('#tableEditPoDetail tbody tr').each(function() {
    //     stcode.push($(this).attr("id"));
    // });
    $('#tableEditSODetail tbody tr').each(function(key) {
        stcode.push($(this).find("td #stcode" + (++key)).text());
    });
    $('#tableEditSODetail tbody tr').each(function(key) {
        amount.push($(this).find("td #amount" + (++key)).val());
    });
    $('#tableEditSODetail tbody tr').each(function(key) {
        unit.push($(this).find("td #unit" + (++key)).val());
    });
    $('#tableEditSODetail tbody tr').each(function(key) {
        price.push($(this).find("td #price" + (++key)).val());
    });
    $('#tableEditSODetail tbody tr').each(function(key) {
        discount.push($(this).find("td #discount" + (++key)).val());
    });

    // alert(stcode)

    $.ajax({
        type: "POST",
        url: "ajax/edit_so.php",
        data: $("#frmEditSO").serialize() + "&amount=" + amount + "&stcode=" + stcode +
            "&unit=" + unit +
            "&price=" + price +
            "&discount=" + discount +
            "&id=" + '<?php echo $_SESSION['id'];?>',
        success: async function(result) {
            if (result.status == 1) {
                await Swal.fire('สำเร็จ', result.message, 'success');
                window.location.reload();
                // console.log(result.sql);
            } else {
                Swal.fire('เกิดข้อผิดพลาด', "รหัสซ้ำ", 'error');
                console.log(result.message);
            }
        }
    });

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
</script>