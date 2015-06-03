//$(function() {
//
//     jQuery('#DetailModal').on('show.bs.modal', function (e) {
//
//        var myId = $('#DetailModal').data('id');
//        var myColumn = $('#DetailModal').data('column');
//        alert(myId+'-'+myColumn);
//
//     });
//
// });



$(document).on("click", ".open-DetailDialog", function () {
     var myId = $(this).data('id');
     var myColumn = $(this).data('column');
     //console.log(myId+' - '+myColumn);

     //$(".modal-body #bookId").val( myId+'='+myColumn  );

  	var dataURL =  "http://charlotteresearch.info/admin/datatables/partner/"+myId+"/column/"+myColumn;
  	//console.log(dataURL);

		//So we can have a new version
		table = $('#detailTable').DataTable();
		table.destroy();

    $('#DetailModalLabel').text(myColumn);

		table = $('#detailTable').DataTable({
		    "language": {"emptyTable": "No data available for column:"+myColumn},
		    "processing": false,
		    "paging": false,
		    "searching": false,
		    "bStateSave": true,
		    "ajax": dataURL,
		    "columns": [
          { "title": "Value" },
          { "title": "Type" },
          { "title": "Data Label" }
		     ]
		});

});