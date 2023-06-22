<script type="text/javascript">
$(function() {

    $.ajax({
        type: "POST",
        url: "ajax/get_brand.php",
        //    data: $("#frmMain").serialize(),
        success: function(result) {

            for (count = 0; count < result.bdcode.length; count++) {

                var status = '';
                if (result.status[count] == 'Y')
                    status = 'เปิดใช้งาน'
                else
                    status = 'ปิดใช้งาน'

                $('#tableBrand').append(
                    '<tr data-toggle="modal" data-target="#modal_edit" id="' + result
                    .bdcode[
                        count] + '" data-whatever="' + result.bdcode[
                        count] + '"><td>' + result.bdname[count] + '</td><td>' + result.grname[
                        count] + '</td><td>' +
                    status + '</td></tr>');
            }

            var table = $('#tableBrand').DataTable({
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
        url: "ajax/getsup_brand.php",
        data: "idcode=" + recipient,
        success: function(result) {
            modal.find('.modal-body #bdcode').val(result.bdcode);
            modal.find('.modal-body #bdname').val(result.bdname);
            modal.find('.modal-body #grcode').val(result.grcode);
            modal.find('.modal-body #status').val(result.status);

        }
    });
});

$("#btnRefresh").click(function() {
    window.location.reload();
});

$("#frmAddBrand").submit(function(e) {
    e.preventDefault();

    $.ajax({
        type: "POST",
        url: "ajax/add_brand.php",
        data: $("#frmAddBrand").serialize() +
            "&id=" + '<?php echo $_SESSION['id'];?>',
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

$("#frmEditBrand").submit(function() {

    $.ajax({
        type: "POST",
        url: "ajax/edit_brand.php",
        data: $("#frmEditBrand").serialize() +
            "&id=" + '<?php echo $_SESSION['id'];?>',
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