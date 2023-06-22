<script type="text/javascript">
$(function() {

    $.ajax({
        type: "POST",
        url: "ajax/get_unit.php",
        //    data: $("#frmMain").serialize(),
        success: function(result) {

            for (count = 0; count < result.unit.length; count++) {

                var status = '';
                if (result.status[count] == 'Y')
                    status = 'เปิดใช้งาน'
                else
                    status = 'ปิดใช้งาน'

                $('#tableUnit').append(
                    '<tr data-toggle="modal" data-target="#modal_edit" id="' + result
                    .unit[
                        count] + '" data-whatever="' + result.unitcode[
                        count] + '">.<td>' + result.unit[count] + '</td><td>' +
                    status + '</td></tr>');
            }

            var table = $('#tableUnit').DataTable({
                "dom": '<"pull-right"f>rt<"bottom"p><"clear">',
                "ordering": false
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
        url: "ajax/getsup_unit.php",
        data: "idcode=" + recipient,
        success: function(result) {
            modal.find('.modal-body #unitcode').val(result.unitcode);
            modal.find('.modal-body #unit').val(result.unit);
            modal.find('.modal-body #status').val(result.status);

        }
    });
});

$("#btnRefresh").click(function() {
    window.location.reload();
});

//ส่งใบแจ้ง
$("#frmAddUnit").submit(function(e) {
    e.preventDefault();
    $.ajax({
        type: "POST",
        url: "ajax/add_unit.php",
        data: $("#frmAddUnit").serialize(),
        success: async function(result) {

            if (result.status == 1) // Success
            {
                await Swal.fire('สำเร็จ', result.message, 'success');
                window.location.reload();
                // console.log(result.message);
            }
        }
    });


});

$("#frmEditUnit").submit(function() {

    $.ajax({
        type: "POST",
        url: "ajax/edit_unit.php",
        data: $("#frmEditUnit").serialize(),
        success: async function(result) {

            if (result.status == 1) // Success
            {
                await Swal.fire('สำเร็จ', result.message, 'success');
                window.location.reload();
                // console.log(result.message);
            }
        }
    });

});
</script>