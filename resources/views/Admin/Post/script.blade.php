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

        ajax: "{{ route('Post.allData')}}",

        columns: [
            {data: 'id', name: 'id'},
            {data: 'title', name: 'title'},
            {data: 'phone', name: 'phone'},
            {data: 'user_id', name: 'user_id'},
            {data: 'description', name: 'description'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });

    $('#formSubmit').submit(function (e) {
        e.preventDefault();
        saveOrUpdate( save_method == 'add' ?"{{ route('Post.create') }}" : "{{ route('Post.update') }}");
    });


    function editFunction(id) {

        save_method = 'edit';

        $('#err').slideUp(200);

        $('#loadEdit_' + id).css({'display': ''});

        $.ajax({
            url: "/Admin/Post/single?id="+id,
            type: "GET",
            dataType: "JSON",

            success: function (data) {

                $('#loadEdit_' + id).css({'display': 'none'});
                $('#save').text('Edit');
                $('#titleOfModel').text('Edit Post');
                $('#formSubmit')[0].reset();
                $('#formModel').modal();
                $('#title').val(data.data.title);
                $('#phone').val(data.data.phone);
                $('#user_id').val(data.data.user_id);
                $('#description').val(data.data.description);
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
            deleteProcess("/Admin/Post/delete?id=" + id);
    }
</script>
