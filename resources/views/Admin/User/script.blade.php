@include('Admin.includes.scripts.dataTableHelper')

<script type="text/javascript">

    var table = $('#datatable').DataTable({
        bLengthChange: false,
        searching: true,
        responsive: true,
        'processing': true,
        'language': {
            'loadingRecords': '&nbsp;',
            'processing': '<div class="spinner"></div>',
        },
        serverSide: true,

        order: [[0, 'desc']],

        buttons: ['copy', 'excel', 'pdf'],

        ajax: "{{ route('User.allData')}}",

        columns: [
            {data: 'id', name: 'id'},
            {data: 'username', name: 'username'},
            {data: 'email', name: 'email'},
            {data: 'phone', name: 'phone'},
            {data: 'status', name: 'status'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });

    $('#formSubmit').submit(function (e) {
        e.preventDefault();
        saveOrUpdate( save_method == 'add' ?"{{ route('User.create') }}" : "{{ route('User.update') }}");
    });


    function editFunction(id) {

        save_method = 'edit';

        $('#err').slideUp(200);

        $('#loadEdit_' + id).css({'display': ''});

        $.ajax({
            url: "/Admin/User/single?id="+id,
            type: "GET",
            dataType: "JSON",

            success: function (data) {

                $('#loadEdit_' + id).css({'display': 'none'});
                $('#save').text('Edit');
                $('#titleOfModel').text('Edit User');
                $('#formSubmit')[0].reset();
                $('#formModel').modal();
                $('#username').val(data.data.username);
                $('#email').val(data.data.email);
                $('#phone').val(data.data.phone);
                $('#status').val(data.data.status);
                $('#id').val(data.data.id);
            },
            error : function (error) {
                $('#loadEdit_' + id).css({'display': 'none'});
                $.toast().reset('all');
                swal(error.responseJSON.message, {
                    icon: "error",
                });
            }
        });
    }


    function deleteFunction(id) {
            deleteProcess("/Admin/User/delete?id=" + id);
    }



</script>
{{-- Search Form --}}
<script>
    $('#searchForm').submit(function (e) {
        e.preventDefault();
        var formData = $('#searchForm').serialize();
        table.ajax.url('{{get_baseUrl()}}/Admin/User/allData?' + formData);
        table.ajax.reload();
        TosetV2('success', '', '', 5000);

    })
</script>

