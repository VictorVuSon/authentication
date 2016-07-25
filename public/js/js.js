$(document).ready(function () {
    $('#example').DataTable({
//        "dom": '<"panelCustom"i><"clear">tp',
        "dom":"l,f,t,p",
        "pageLength": 10,
        "ordering": true,
        "stateSave": false,
        "pagingType": "full_numbers",
        "language": {
            "info": "_START_-_END_/_TOTAL_"
        },
        "columnDefs": [
            {"orderable": false, "targets": 0},
            {"orderable": false, "targets": 4}
//            {"orderable": false, "targets": 3}
        ],
//        "order": [[7, "desc"]]
    });
});
$("#checkAll").click(function(){
    $('.itemCheck').not(this).prop('checked', this.checked);
});

//var timer;
//function up(){
//    timer = setTimeout(function(){
//        var keywords = $("#search-input").val();
//        if(keywords.length>0)
//        {
//            $.post('http://localhost/authentication/public/foods/executeSearch',[keywords: keywords],function(markup){
//                $('#search-results').html(markup);
//            });
////            alert("asdf");
//        }
//        
//    },500);
////alert("asfd");
//}
//function down(){
//    clearTimeout(timer);
//}
