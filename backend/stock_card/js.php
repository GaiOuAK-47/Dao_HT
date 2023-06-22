<script type="text/javascript">
$(function() {

    // $("#sidePurchase").show()

    $.ajax({
        type: "POST",
        url: "ajax/get_stock.php",
        //    data: $("#frmMain").serialize(),
        success: function(result) {

            for (count = 0; count < result.stcode.length; count++) {

                let status
                if (result.status[count] == 'Y')
                    status = 'เปิดใช้งาน'
                else
                    status = 'ปิดใช้งาน'
                $('#tableStock tbody').append(
                    '<tr data-toggle="modal" data-target="#modal_edit" id="' + result
                    .stcode[
                        count] + '" data-whatever="' + result.stcode[
                        count] + '"><td>' + result.stcode[count] + '</td><td>' + result
                    .stname1[count] + '</td><td style="text-align:right">' +
                    result.amount1[count] + '</td><td style="text-align:right">' + result.unit[count] + '</td><td style="text-align:right">' +
                    formatMoney(result.amtprice[count], 3) + '</td><td style="text-align:center">' + status +
                    '</td></tr>');
            }

            var table = $('#tableStock').DataTable({
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


})

$('#modal_edit').on('show.bs.modal', function(event) {
    var button = $(event.relatedTarget);
    var recipient = button.data('whatever');
    var modal = $(this);

    $.ajax({
        type: "POST",
        url: "ajax/getsup_stock.php",
        data: "idcode=" + recipient,
        success: function(result) {

            modal.find('.modal-body #stcode').val(result.stcode);
            modal.find('.modal-body #stname1').val(result.stname1);
            modal.find('.modal-body #unit').val(result.unit);
            modal.find('.modal-body #amount').val(result.amount);
            modal.find('.modal-body #amtprice').val(result.amtprice);
            modal.find('.modal-body #price').val(result.price);
            modal.find('.modal-body #grname').val(result.grname);
            modal.find('.modal-body #typename').val(result.typename);
            modal.find('.modal-body #bdname').val(result.bdname);
            modal.find('.modal-body #clname').val(result.clname);            

        }
    });
});


$("#btnRefresh").click(function() {
    window.location.reload();
});
</script>