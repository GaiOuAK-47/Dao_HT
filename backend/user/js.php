<script type="text/javascript">
$(function() {

    $.ajax({
        type: "POST",
        url: "ajax/get_user.php",
        //    data: $("#frmMain").serialize(),
        success: function(result) {
            var type;
            for (count = 0; count < result.username.length; count++) {


                $('#tableUser').append(
                    '<tr data-toggle="modal" data-target="#modelUserEdit" id="' + result
                    .username[
                        count] + '" data-whatever="' + result.username[
                        count] + '"><td>' + result.username[count] + '</td><td>' +
                    result.firstname[count] + '</td><td>' +
                    result.lastname[count] + '</td><td>' + result.type[count] + '</td></tr>');
            }

            var table = $('#tableUser').DataTable({
                "dom": '<"pull-right"f>rt<"bottom"p><"clear">',
                "ordering": false
            });

            $(".dataTables_filter input[type='search']").css({
                'width': '80%'
            });

        }
    });


})
$('#modelUserEdit').on('show.bs.modal', function(event) {
    var button = $(event.relatedTarget);
    var recipient = button.data('whatever');
    var modal = $(this);

    $.ajax({
        type: "POST",
        url: "ajax/getsup_user.php",
        data: "idcode=" + recipient,
        success: function(result) {
            modal.find('.modal-body #editusername').val(result.username);
            modal.find('.modal-body #password').val(result.password);
            modal.find('.modal-body #editfirstname').val(result.firstname);
            modal.find('.modal-body #editlastname').val(result.lastname);
            modal.find('.modal-body #editstatus').val(result.status);
            modal.find('.modal-body #edittype').val(result.type);
            modal.find('.modal-body #editemail').val(result.email);
            modal.find('.modal-body #code').val(result.code);

            $('#perresetcode').val(result.code);
            $('#resetfirstname').val(result.firstname);
            $('#resetlastname').val(result.lastname);
        }
    });
});

$("#frmReset").submit(function(e) {
    e.preventDefault();

    $.ajax({
        type: "POST",
        url: "ajax/reset_password.php",
        data: $("#frmReset").serialize(),
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

$("#btnRefresh").click(function() {
    window.location.reload();
});

//ส่งใบแจ้ง
$("#frmAddUser").submit(function(e) {
    e.preventDefault();
    $.ajax({
        type: "POST",
        url: "ajax/add_user.php",
        data: $("#frmAddUser").serialize(),
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

$("#frmEditUser").submit(function(e) {
    e.preventDefault();

    $.ajax({
        type: "POST",
        url: "ajax/edit_user.php",
        data: $("#frmEditUser").serialize(),
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