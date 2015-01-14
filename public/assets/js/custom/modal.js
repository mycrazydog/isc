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
     console.log(myId);

     //$(".modal-body #bookId").val( myId+'='+myColumn  );

  	var dataURL =  "/admin/datatables/partner/"+myId+"/column/"+myColumn;

		//So we can have a new version
		table = $('#exampleTable').DataTable();
		table.destroy();


		table = $('#exampleTable').DataTable({
		    "language": {"emptyTable": "No data available for column:"+myColumn},
		    "processing": true,
		    "paging": false,
		    "searching": false,
		    "ajax": dataURL,
		    "columns": [
		       { "title": "Table name" },
		       { "title": "Fields" },
            { "title": "Value" },
          { "title": "Type" }
		     ]
		});

});
