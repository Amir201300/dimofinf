<script>
    function addFunction() {
        save_method = 'add';
        $('#save').text('save');
        $('#titleOfModel').text($('#titleOfText').text());
        $('#formSubmit')[0].reset();
        $('#formModel').modal();
    }
</script>

<script>
    function saveOrUpdate(url) {
        $("#save").attr("disabled", true);
        Toset('wait', 'info', 'your request in progress', false);
        var formData = new FormData($('#formSubmit')[0]);
        $.ajax({
            url: url,
            type: "post",
            data: formData,
            contentType: false,
            processData: false,
            success: function (data) {
                $.toast().reset('all');
                $("#save").attr("disabled", false);
                if (data.status == 1) {
                    swal(data.message, {
                        icon: "success",
                    });
                    table.ajax.reload();
                    $("#formModel").modal('toggle');
                    $("#save").attr("disabled", false);
                }else{
                    swal(data.message, {
                        icon: "error",
                    });
                }
            },
            error: function (error) {
                $.toast().reset('all');
                $("#save").attr("disabled", false);
                $.toast().reset('all');
                swal(error.responseJSON.message, {
                    icon: "error",
                });            }
        });
    }
</script>

<script>
    function deleteProcess(url) {
        swal({
            title: "are you sure ?",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }).then((willDelete) => {
            if (willDelete) {
                Toset('wait', 'info', 'your request in progress', false);
                $.ajax({
                    url: url,
                    type: "get",
                    success: function (data) {
                        table.ajax.reload();
                        var msg = data.message ? data.message : 'Deleted Successfully';
                        swal(msg, {
                            icon: "success",
                        });
                        $.toast().reset('all');
                    },
                    error: function (error) {
                        $.toast().reset('all');
                        swal(error.responseJSON.message, {
                            icon: "error",
                        });
                    }
                });

            } else {
                swal("The operation did not take place !");
            }
        });
    }

</script>

