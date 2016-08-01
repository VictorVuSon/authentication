<table class="table table-responsive" id="users-table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Role</th>
            <th>Action</th>
        </tr>
    </thead>
    <tfoot>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Role</th>
        </tr>
    </tfoot>
</table>
<style>
    tfoot input {
        width: 100%;
        padding: 3px;
        box-sizing: border-box;
    }
    tfoot {
        display: table-header-group;
    }
    
</style>
<script>
    $(function () {
        $('#users-table').DataTable({
            "dom": 'lrtip',
            processing: true,
            serverSide: true,
            ajax: {
                url: '{!! route('user.getIndex') !!}'
            },
            columns: [
                {data: 'id', name: 'id'},
                {data: 'name', name: 'name'},
                {data: 'email', name: 'email'},
                {data: 'is_admin', name: 'is_admin'},
                {data: 'action', name: 'action', orderable: false, searchable: false}
            ],
            initComplete: function () {
                this.api().columns().every(function () {
                    var column = this;
                    var input = document.createElement("input");
                    if (column.index() == 3) {
                        input = $('<select name = "is_admin"><option value=""></option><option value="0">User</option><option value="1">Admin</option></select>');
                    }
                    $(input).appendTo($(column.footer()).empty())
                            .on('change', function () {
                                column.search($(this).val()).draw();
                            });
                });
            }
        });
    });
</script>