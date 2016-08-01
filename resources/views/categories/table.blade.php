<table class="table table-responsive" id="foods-table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Action</th>
        </tr>
    </thead>
    <tfoot>
        <tr>
            <th>ID</th>
            <th>Category</th>
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
        $('#foods-table').DataTable({
            "dom": 'lrtip',
            processing: true,
            serverSide: true,
            ajax: {
                url: '{!! route('category.getIndex') !!}'
            },
            columns: [
                {data: 'id', name: 'id'},
                {data: 'name', name: 'name'},
                {data: 'action', name: 'action', orderable: false, searchable: false}
            ],
            initComplete: function () {
                this.api().columns().every(function () {
                    var column = this;
                    var input = "";
                    if (column.index() === 1) {
                        input = document.createElement("input");
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