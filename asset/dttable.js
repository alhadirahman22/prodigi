$(function () {
  //$("#example1").DataTable();
  $("#example1").DataTable();
  $(".table1").DataTable( {
                "lengthMenu": [[5], [5]],  
                 responsive: true,
            });
  var t = $('#example3').DataTable( {
        "columnDefs": [ {
            "searchable": false,
            "orderable": false,
            //"targets": 0
        } ],
        //"order": [[ 1, 'asc' ]]
    } );
 
    t.on( 'order.dt search.dt', function () {
        t.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
            cell.innerHTML = i+1;
        } );
    } ).draw();
  $('#example2').DataTable({
    "paging": true,
    "lengthChange": false,
    //"searching": false,
    "ordering": true,
    "info": true,
    "autoWidth": false,
  });

  $('#example5').dataTable( {
      "lengthMenu": [[10, 25], [10, 25]],  
       responsive: true,
       "order": [[ 1, "asc" ]]
  });
});