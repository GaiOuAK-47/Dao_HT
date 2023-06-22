<script type="text/javascript">
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
        url: "ajax/get_gr.php",
        //    data: $("#frmMain").serialize(),
        success: function(result) {

            for (count = 0; count < result.grcode.length; count++) {

                $('#tableGR').append(
                    '<tr id="' + result.grcode[
                        count] +
                    '" data-toggle="modal" data-target="#modal_edit" data-whatever="' + result
                    .grcode[
                        count] + '" ><td>' + result.grcode[
                        count] +
                    '</td><td>' + result
                    .grdate[count] + '</td><td>' + result
                    .pocode[count] + '</td><td>' + result
                    .stcode[count] + '</td><td>' + result.stname1[count] + '</td><td>' + result
                    .supname[count] + '</td><td ><span "title="' + result.grstatus[count] + '">' +
                    result.grstatus[count] +
                    '</span></td></tr>');

            }

            $('#tableGR').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": true,
                "ordering": true,
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

})


$('#btnGetPO').click(function() {
    let supcode = $('#add_supcode').val()
    var table = $('#table_po').DataTable();

    table.clear().draw().destroy();
    if (supcode != '') {
        $.ajax({
            type: "POST",
            url: "ajax/get_po.php",
            data: "supcode=" + supcode,
            success: function(result) {
                for (count = 0; count < result.pocode.length; count++) {

                    $('#table_po tbody').append(
                        '<tr id="' +
                        result.pocode[count] + ',' +
                        result.pono[count] +
                        '" );"><td><input type="checkbox" id="' + 'chk' +
                        count + '" name="' + 'chk' +
                        count + '" value="' + count + '" ></td><td>' + [count + 1] +
                        '</td><td>' +
                        result.pocode[count] + '</td><td>' +
                        result.stcode[count] + '</td><td>' + result.stname1[count] +
                        '</td><td>' +
                        result.unit[count] + '</td><td style="text-align:right">' +
                        result.amount[count] +
                        '</td><td style="text-align:right">' + result.recamount[
                            count] +
                        '</td><td><p style="text-align:center" class="form-control-static" title="' +
                        result.supstatus[count] + '" >' + result.supstatus[count] +
                        '</p></td></tr>');


                }
            }
        });

        $('#modal_po').modal('show');

    } else {
        Swal.fire('แจ้งเตือน', "กรุณาเลือกผู้ขายก่อนเลือกรายการ", 'info');
    }

})

$("#btnSubmitPO").click(function() {
    // $('#tableRRDetail').val()
    var table = $("#table_po tbody");
    var rows = $('#table_po tbody tr').length;
    $("#tableGRDetail tbody").empty();
    // alert(row);
    var option = '';
    for (var i = 0; i < rows; i++) {

        if ($('#chk' + i).is(':checked')) {

            var target = $('#chk' + i).closest('tr').attr('id');
            var id = [];
            id[i] = target.split(',')[0];
            var row = [];
            row[i] = target.split(',')[1];
            $('#btnClearRRdetail').show();


            $.ajax({
                type: "POST",
                url: "ajax/getsup_podetail.php",
                data: "idcode=" + id[i] +
                    "&row=" + row[i],
                success: function(result) {
                    // console.log(result);

                    $('#tableGRDetail tbody').append(
                        '<tr id="' + result.stcode +
                        '" ><td name="pono" id="pono" ><p class="form-control-static" style="text-align:center">' +
                        $('#tableGRDetail tr').length +
                        '</p></td><td><p class="form-control-static" name="pocode1" id="pocode1' +
                        $('#tableGRDetail tr').length +
                        '" style="text-align:left">' +
                        result
                        .pocode +
                        '</p></td><td><p class="form-control-static" style="text-align:center">' +
                        result
                        .stcode +
                        '</p></td><td> <p class="form-control-static" style="text-align:left">' +
                        result.stname1 +
                        '</p></td><td><div class="input-group"><input type="text" class="form-control" style="text-align:center" name="unit1" id="unit1' +
                        $('#tableGRDetail tr').length +
                        '" value="' +
                        result.unit +
                        '" disabled><span class="input-group-btn"><button class="btn btn-default" data-toggle="modal" data-target="#modal_unit" data-whatever="' +
                        $('#tableGRDetail tr').length +
                        ',tablePoDetail," type="button"><span class="fa fa-search"></span></button></span></div></td><td><input type="number" style="text-align:right" class="form-control" name="recamount1"  id="recamount1' +
                        $('#tableGRDetail tr').length +
                        '" max="' +
                        result.amount +
                        '" value="' +
                        result.recamount +
                        '" disabled></td><td><input type="number" class="form-control" style="text-align:right" name="amount1" id="amount1' +
                        $('#tableGRDetail tr').length +
                        '"  min="1" max="' +
                        (result.amount - result.recamount) +
                        '" value="' +
                        (result.amount - result.recamount) +
                        '"></td><td><p style="text-align:center" class="form-control-static" title="' +
                        result.supstatus + '" >' + result.supstatus +
                        '</p> <input type="hidden" id="price1' +
                        $('#tableGRDetail tr').length +
                        '" name="price1" value="' +
                        result.price +
                        '"><input type="hidden" id="discount1' +
                        $('#tableGRDetail tr').length +
                        '" name="discount1" value="' +
                        result.discount +
                        '"></td></tr>'
                    );


                    $('#modal_po').modal('hide');
                }
            });


        }
    }


});

function onDeleteDetail(table, id) {
    $("#" + table + " tbody").empty();
    $("#" + id).hide();

    if (table == "tableRRGiveaway")
        $('#tableRRGiveaway').hide();
}

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

$('#btnPrintGR').click(function() {
    alert('อยู่ระหว่างการพัฒนา')
});

$('#btnCancleGR').click(function() {
    alert('อยู่ระหว่างการพัฒนา')
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
                .unit, 0, 0)

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

$('#modal_add').on('show.bs.modal', function(event) {

    $("#add_grdate").val(new Date().toISOString().substring(0, 10));
    $("#add_invdate").val(new Date().toISOString().substring(0, 10));
    $.ajax({
        type: "POST",
        url: "ajax/get_grcode.php",
        success: function(result) {

            $("#add_grcode").val(result.grcode);

        }
    });
});

$('#modal_edit').on('show.bs.modal', function(event) {
    var button = $(event.relatedTarget);
    var grcode = button.data('whatever');
    var modal = $(this);

    $("#tableGRDetail tbody").empty();

    $.ajax({
        type: "POST",
        url: "ajax/getsup_gr.php",
        data: "idcode=" + grcode,
        success: function(result) {

            $("#grcode").val(result.grcode);
            $("#supcode").val(result.supcode);
            $("#supname").val(result.supname);
            $("#address").val(result.address);
            $("#grdate").val(result.grdate);
            $("#invcode").val(result.invcode);
            $("#invdate").val(result.invdate);
            $("#payment").val(result.payment);



            $.ajax({
                type: "POST",
                url: "ajax/getsup_grdetail.php",
                data: "idcode=" + grcode,
                success: function(result) {
                    for (count = 0; count < result.stcode.length; count++) {

                        $('#tableEditGRDetail tbody').append(
                            '<tr id="' + result.stcode[count] +
                            '" ><td name="rrno" id="rrno" ><p class="form-control-static" style="text-align:center">' +
                            result.grno[count] +
                            '</p></td><td><p class="form-control-static" style="text-align:center">' +
                            result
                            .pocode[count] +
                            '</p></td><td><p class="form-control-static" style="text-align:center">' +
                            result
                            .stcode[count] +
                            '</p></td><td> <p class="form-control-static" style="text-align:left">' +
                            result.stname1[count] +
                            '</p></td><td><div class="input-group"><input type="text" class="form-control" name="unit1" id="unit1' +
                            result.grno[count] + '" value="' +
                            result.unit[count] +
                            '" disabled><span class="input-group-btn"><button class="btn btn-default" data-toggle="modal" data-target="#modal_unit" data-whatever="' +
                            result.grno[count] +
                            ',tableEditGRDetail," type="button"><span class="fa fa-search"></span></button></span></div></td><td><input type="text" class="form-control" name="amount1"  id="amount1' +
                            result.grno[count] +
                            '"  value="' +
                            result.amount[count] +
                            '" disabled></td><td><input type="text" class="form-control" name="recamount1" id="recamount1' +
                            result.grno[count] + '" value="' +
                            result.recamount[count] +
                            '" disabled></td><td><p style="text-align:center" class="form-control-static" title="' +
                            result.grstatus[count] + '" >' + result.grstatus[
                            count] +
                            '</p></td></tr>'
                        );

                        // $disable = '';
                        // if (result.supstatus[count] == 'รับของครบแล้ว' || result
                        //     .supstatus[
                        //         count] == 'ยกเลิก') {
                        //     $('#podate').prop("readonly", true);
                        //     $('#deldate').prop("readonly", true);
                        //     $('#payment').prop("readonly", true);
                        //     $('#poqua').prop("readonly", true);
                        //     $('#currency').prop("readonly", true);
                        //     $('#vat').prop("readonly", true);
                        //     $("#tableEditPoDetail tbody input").prop("readonly",
                        //         true
                        //     ); // $disable = 'readonly';                            
                        //     $("#btnCanclePOdetail").hide()
                        //     $("#btnEditSo").hide()
                        //     $("#btnEditPOdetail").hide()
                        // } else {
                        //     $("#btnCanclePOdetail").show()
                        //     $("#btnEditPOdetail").show()
                        //     $("#btnEditSo").show()

                        //     $('#podate').prop("readonly", false);
                        //     $('#deldate').prop("readonly", false);
                        //     $('#payment').prop("readonly", false);
                        //     $('#poqua').prop("readonly", false);
                        //     $('#currency').prop("readonly", false);
                        //     $('#vat').prop("readonly", false);
                        //     $("#tableEditPoDetail tbody input[name*='unit']").prop(
                        //         "readonly",
                        //         true);
                        // }

                    }

                }
            });
        }
    });

    $("#divfrmEditGR").show();

    $("#tableEditGRDetail tbody").empty();
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

// กดยืนยันเพิ่ม GR
$("#frmAddGR").submit(function(event) {
    event.preventDefault();

    var amount = [];
    var stcode = [];
    var unit = [];
    var recamount = [];
    var pocode = [];
    var price = [];
    var discount = [];


    $('#tableGRDetail tbody tr').each(function() {
        stcode.push($(this).attr("id"));
    });
    $('#tableGRDetail tbody tr').each(function(key) {
        amount.push($(this).find("td #amount1" + (++key)).val());
    });
    $('#tableGRDetail tbody tr').each(function(key) {
        unit.push($(this).find("td #unit1" + (++key)).val());
    });
    $('#tableGRDetail tbody tr').each(function(key) {
        price.push($(this).find("td #price1" + (++key)).val());
    });
    $('#tableGRDetail tbody tr').each(function(key) {
        discount.push($(this).find("td #discount1" + (++key)).val());
    });
    $('#tableGRDetail tbody tr').each(function(key) {
        recamount.push($(this).find("td #recamount1" + (++key)).val());
    });
    $('#tableGRDetail tbody tr').each(function(key) {
        pocode.push($(this).find("td #pocode1" + (++key)).text());
    });

    // alert(pocode);

    if (stcode != 0) {

        $.ajax({
            type: "POST",
            url: "ajax/add_gr.php",
            data: $("#frmAddGR").serialize() + "&amount=" + amount + "&stcode=" + stcode +
                "&unit=" + unit +
                "&recamount=" + recamount +
                "&price=" + price +
                "&discount=" + discount +
                "&pocode=" + pocode,
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

// กดยืนยันแก้ไข GR
$("#frmEditGR").submit(function(event) {
    event.preventDefault();

    // alert(stcode)

    $.ajax({
        type: "POST",
        url: "ajax/edit_gr.php",
        data: $("#frmEditGR").serialize(),
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
</script>