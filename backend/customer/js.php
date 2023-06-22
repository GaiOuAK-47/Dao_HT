<script type="text/javascript">
document.addEventListener('DOMContentLoaded', function() {
    window.stepper = new Stepper(document.querySelector('.bs-stepper'))
})


$(function() {

    // $("#sidePurchase").show()

    $.ajax({
        type: "POST",
        url: "ajax/get_customer.php",
        //    data: $("#frmMain").serialize(),
        success: function(result) {

            for (count = 0; count < result.cuscode.length; count++) {

                let status
                if (result.status[count] == 'Y')
                    status = 'เปิดใช้งาน'
                else
                    status = 'ปิดใช้งาน'
                $('#tableCustomer tbody').append(
                    '<tr data-toggle="modal" data-target="#modal_edit" id="' + result
                    .cuscode[
                        count] + '" data-whatever="' + result.cuscode[
                        count] + '"><td>' + result.cuscode[count] + '</td><td>' + result
                    .cusname[count] + '</td><td>' + result.province[count] + '</td><td>' +
                    result.address[count] + '</td><td  style="text-align:center">' + status +
                    '</td></tr>');
            }

            var table = $('#tableCustomer').DataTable({
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

$('#modal_add').on('show.bs.modal', function(event) {


    $.ajax({
        type: "POST",
        url: "ajax/get_cuscode.php",
        success: function(result) {

            $("#add_cuscode").val(result.cuscode);

        }
    });
});


$('#modal_edit').on('show.bs.modal', function(event) {
    var button = $(event.relatedTarget);
    var recipient = button.data('whatever');
    var modal = $(this);

    $.ajax({
        type: "POST",
        url: "ajax/getsup_customer.php",
        data: "idcode=" + recipient,
        success: function(result) {
            modal.find('.modal-body #id').val(result.id);
            modal.find('.modal-body #cuscode').val(result.cuscode);
            modal.find('.modal-body #cusname').val(result.cusname);
            modal.find('.modal-body #custype').val(result.custype);
            modal.find('.modal-body #idno').val(result.idno);
            modal.find('.modal-body #road').val(result.road);
            modal.find('.modal-body #subdistrict').val(result.subdistrict);
            modal.find('.modal-body #district').val(result.district);
            modal.find('.modal-body #province').val(result.province);
            modal.find('.modal-body #zipcode').val(result.zipcode);
            modal.find('.modal-body #tel').val(result.tel);
            modal.find('.modal-body #fax').val(result.fax);
            modal.find('.modal-body #taxnumber').val(result.taxnumber);
            modal.find('.modal-body #status').val(result.status);
            modal.find('.modal-body #email').val(result.email);


        }
    });
});

$("#btnRefresh").click(function() {
    window.location.reload();
});

//เพิ่มผู้ขาย
$("#frmAddCustomer").submit(function(e) {
    e.preventDefault();

    $.ajax({
        type: "POST",
        url: "ajax/add_customer.php",
        data: $("#frmAddCustomer").serialize() +
            "&id=" + '<?php echo $_SESSION['id'];?>',
        success: async function(result) {

            if (result.status == 1) // Success
            {
                await Swal.fire('สำเร็จ', result.message, 'success');
                window.location.reload();
                // console.log(result.message);
            } else {
                Swal.fire('เกิดข้อผิดพลาด', "รหัสซ้ำ", 'error');
            }
        }
    });


});


$("#frmEditCustomer").submit(function(e) {
    e.preventDefault();

    $.ajax({
        type: "POST",
        url: "ajax/edit_customer.php",
        data: $("#frmEditCustomer").serialize(),
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