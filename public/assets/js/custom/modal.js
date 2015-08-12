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
     var myTable = $(this).data('table');
     var myDescription = $(this).data('description');
     //console.log(myId+' - '+myColumn);

     //$(".modal-body #bookId").val( myId+'='+myColumn  );

  	//var dataURL =  "http://charlotteresearch.info/admin/datatables/partner/"+myId+"/column/"+myColumn;
  	var dataURL =  "http://charlotteresearch.info/admin/datatables/partner/"+myId+"/column/"+myColumn+"/table/"+myTable;
  	//console.log(dataURL);

		//So we can have a new version
		table = $('#detailTable').DataTable();
		table.destroy();

    $('#DetailModalLabel').text(myColumn);
    $('#DetailModalDescription').text(myDescription);

		table = $('#detailTable').DataTable({
		    "language": {"emptyTable": "No data available for column:"+myColumn+" in table "+myTable},
		    "processing": false,
		    "paging": true,
		    "searching": false,
		    "bStateSave": true,
		    "ajax": dataURL,
		    "columns": [
          { "title": "Value" },
          { "title": "Notes" }
		     ]
		});

});