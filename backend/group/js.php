<script type="text/javascript">
$(function() {

    $.ajax({
        type: "POST",
        url: "ajax/get_group.php",
        //    data: $("#frmMain").serialize(),
        success: function(result) {

            for (count = 0; count < result.grcode.length; count++) {

                var status = '';
                if (result.status[count] == 'Y')
                    status = 'เปิดใช้งาน'
                else
                    status = 'ปิดใช้งาน'

                $('#tableGroup').append(
                    '<tr data-toggle="modal" data-target="#modal_edit" id="' + result
                    .grcode[
                        count] + '" data-whatever="' + result.grcode[
                        count] + '"><td>' + result.grname[count] + '</td><td>' + result.grprecode[count] + '</td><td>' +
                    status + '</td></tr>');

                    
            }

            var table = $('#tableGroup').DataTable({
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
        url: "ajax/getsup_group.php",
        data: "idcode=" + recipient,
        success: function(result) {
            modal.find('.modal-body #grcode').val(result.grcode);
            modal.find('.modal-body #grname').val(result.grname);
            modal.find('.modal-body #grprecode').val(result.grprecode);            
            modal.find('.modal-body #status').val(result.status);

        }
    });
});

$("#btnRefresh").click(function() {
    window.location.reload();
});

//เพิ่มประเภท
$("#frmAddGroup").submit(function(e) {
    e.preventDefault();

    $.ajax({
        type: "POST",
        url: "ajax/add_group.php",
        data: $("#frmAddGroup").serialize() +
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

$("#frmEditGroup").submit(function() {

    $.ajax({
        type: "POST",
        url: "ajax/edit_group.php",
        data: $("#frmEditGroup").serialize() +
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