<table class="table table-responsive" id="foods-table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Category</th>
            <th>Author</th>
            <th>Action</th>
        </tr>
    </thead>
    <tfoot>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Category</th>
            <th>Author</th>
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
        var table = $('#foods-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: '{!! route('food.getIndex') !!}'
            },
            columns: [
                {data: 'id_food', name: 'id_food'},
                {data: 'name_food', name: 'name_food'},
                {data: 'category_id', name: 'category_id'},
                {data: 'author_name', name: 'author_name'},
                {data: 'action', name: 'action', orderable: false, searchable: false}
            ],
            initComplete: function () {
                this.api().columns().every(function () {
                    var column = this;
                    var input = document.createElement("input");
                    if (column.index() === 2) {
                        input = $('{{Form::select("category", $categories, "")}}');
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