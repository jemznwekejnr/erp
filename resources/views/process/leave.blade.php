<script>
	
	//Adding bank into the system
	$("#submitleave").on('submit', function(event){
	      event.preventDefault();
	      
	      $.ajax({
	        type: 'POST',
	        url: 'submitleave',
	        data: new FormData(this),
	        contentType: false,
	        cache: false,
	        processData: false,
	        beforeSend:function(){
	                $("#button").hide();
	                $("#processing").show();
	            },
	        success: function(data){

	        if(data.message == 'success'){
	        	Swal.fire('Success!', data.info, 'success');
	        	setTimeout(function() {
				    window.location = '/myleaveapplications';
				}, 3000);
	        }else{
	        	Swal.fire("Error!", data.info, "error");
	        }
	          
              $("#button").show();
              $("#processing").hide();
	        }
	      });
	    });



	//edit basic pay
	$(".editleave").click(function(event){
		event.preventDefault();
		var leavetype = $(this).attr("id");
		var id = $(this).attr("href");
		var days = $(this).attr("title");
		const leavedays = days.split("|");
		$("#daysallowed").val(leavedays[0]);
		$("#maxdays").val(leavedays[1]);
		$("#leaveid").val(id);
		$("#leavetype").val(leavetype);
	});


	//delete basic pay
	$(".deleteleave").click(function(event){

		event.preventDefault();
		
		var id = $(this).attr("href");

		Swal.fire({
		  title: 'Are you sure?',
		  text: "Are you sure you want to delete this record? This action can not be reversed!",
		  icon: 'warning',
		  showCancelButton: true,
		  confirmButtonColor: '#3085d6',
		  cancelButtonColor: '#d33',
		  confirmButtonText: 'Yes, delete it!'
		}).then((result) => {
		  if (result.isConfirmed) {

		  	$.ajax({
	        type: 'GET',
	        url: 'deleteleave?id='+id,
	        beforeSend:function(){
	                $("#button").hide();
	                $("#processing").show();
	            },
	        success: function(data){

	        if(data.message == 'success'){
	        	Swal.fire('Deleted!', data.info, 'success');
	        	setTimeout(function() {
				    location.reload();
				}, 3000);
	        }else{
	        	Swal.fire("Error!", data.info, "error");
	        }
	          
              $("#button").show();
              $("#processing").hide();
	        }
	      });
		  }
		})

	});


	$("#leavetype").change(function(){
		var id = $(this).val();
		$.ajax({
        type: 'GET',
        url: 'leaveduration?id='+id,
        success: function(data){

        	$("#leaveduration").html("");
        	$("#leaveduration").html(data);
        }
      });

	});

	
	$("#submitleaveapplication").on('submit', function(event){
	      event.preventDefault();
	      
	      $.ajax({
	        type: 'POST',
	        url: 'submitleaveapplication',
	        data: new FormData(this),
	        contentType: false,
	        cache: false,
	        processData: false,
	        beforeSend:function(){
	                $("#button").hide();
	                $("#processing").show();
	            },
	        success: function(data){

	        if(data.message == 'success'){
	        	Swal.fire('Success!', data.info, 'success');
	        	setTimeout(function() {
				    location.reload();
				}, 3000);
	        }else{
	        	Swal.fire("Error!", data.info, "error");
	        }
	          
              $("#button").show();
              $("#processing").hide();
	        }
	      });
	    });


	$("#leavereaction").on('submit', function(event){
	      event.preventDefault();
	      
	      $.ajax({
	        type: 'POST',
	        url: 'leavereaction',
	        data: new FormData(this),
	        contentType: false,
	        cache: false,
	        processData: false,
	        beforeSend:function(){
	                $("#button").hide();
	                $("#processing").show();
	            },
	        success: function(data){

	        if(data.message == 'success'){
	        	Swal.fire('Success!', data.info, 'success');
	        	setTimeout(function() {
				    location.reload();
				}, 3000);
	        }else{
	        	Swal.fire("Error!", data.info, "error");
	        }
	          
              $("#button").show();
              $("#processing").hide();
	        }
	      });
	    });



	$("#submitleaveedit").on('submit', function(event){
	      event.preventDefault();
	      
	      $.ajax({
	        type: 'POST',
	        url: 'submitleaveedit',
	        data: new FormData(this),
	        contentType: false,
	        cache: false,
	        processData: false,
	        beforeSend:function(){
	                $("#button").hide();
	                $("#processing").show();
	            },
	        success: function(data){

	        if(data.message == 'success'){
	        	Swal.fire('Success!', data.info, 'success');
	        	setTimeout(function() {
				     window.location = '/myleaveapplications';
				}, 3000);
	        }else{
	        	Swal.fire("Error!", data.info, "error");
	        }
	          
              $("#button").show();
              $("#processing").hide();
	        }
	      });
	    });


	$("#showattachment").click(function(){
		$("#hideattachment").toggle();
	});

</script>