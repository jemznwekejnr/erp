<script>
	
	//create basic pay

	$("#submitbasicpay").on('submit', function(event){
	      event.preventDefault();
	      
	      $.ajax({
	        type: 'POST',
	        url: 'submitbasicpay',
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


	//edit basic pay
	$(".editbasic").click(function(event){
		event.preventDefault();
		var level = $(this).attr("title");
		var amount = $(this).attr("id");
		var id = $(this).attr("href");
		$("#level").val(level);
		$("#amount").val(amount);
		$("#basicid").val(id);
	});


	//delete basic pay
	$(".deletebasic").click(function(event){

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
	        url: 'deletebasicpay?id='+id,
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

/********************* Basic Ends Here ***********************/

/********************* Begin Allowances **********************/


	$("#submitallowances").on('submit', function(event){
	      event.preventDefault();
	      
	      $.ajax({
	        type: 'POST',
	        url: 'submitallowances',
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


	//edit basic pay
	$(".editallowance").click(function(event){
		event.preventDefault();
		var allowance = $(this).attr("title");
		var percentage = $(this).attr("id");
		var id = $(this).attr("href");
		$("#allowances").val(allowance);
		$("#percentage").val(percentage);
		$("#allowanceid").val(id);
	});


	//delete basic pay
	$(".deleteallowance").click(function(event){

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
	        url: 'deleteallowance?id='+id,
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

	/************************ Allowances Ends Here ****************************************************/


	/*********************** Bonuses Begins Here *****************************************************/

	$("#submitbonus").on('submit', function(event){
	      event.preventDefault();
	      
	      $.ajax({
	        type: 'POST',
	        url: 'submitbonus',
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




	//edit basic pay
	$(".editbonus").click(function(event){
		event.preventDefault();
		var amount_month = $(this).attr("title");
		const am = amount_month.split("|");
		var staff_bonus = $(this).attr("id");
		const sb = staff_bonus.split("|");
		var id = $(this).attr("href");
		$("#staff").val(sb[0]);
		$("#staff").val(sb[0]);
		$("#description").val(sb[1]);
		$("#amount").val(am[0]);
		$("#month").val(am[1]);
		$("#bonusid").val(id);
	});




	//delete basic pay
	$(".deletebonus").click(function(event){

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
	        url: 'deletebonus?id='+id,
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

	

/********************************************* Bonuses Ends Here *************************************************/

/******************************************** Staff Deduction Begins Here ****************************************/


	$("#submitdeduction").on('submit', function(event){
	      event.preventDefault();
	      
	      $.ajax({
	        type: 'POST',
	        url: 'submitdeduction',
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




	//edit basic pay
	$(".editdeduction").click(function(event){
		event.preventDefault();
		var amount_month = $(this).attr("title");
		const am = amount_month.split("|");
		var staff_bonus = $(this).attr("id");
		const sb = staff_bonus.split("|");
		var id = $(this).attr("href");
		$("#staff").val(sb[0]);
		$("#description").val(sb[1]);
		$("#amount").val(am[0]);
		$("#month").val(am[1]);
		$("#deductionid").val(id);
	});




	//delete basic pay
	$(".deletededuction").click(function(event){

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
	        url: 'deletededuction?id='+id,
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


	/*********************************************** Deduction Ends Here ******************************************/

	/*********************************************** PAYE TAble Begins Here ***************************************/

	$("#submitpaye").on('submit', function(event){
	      event.preventDefault();
	      
	      $.ajax({
	        type: 'POST',
	        url: 'submitpaye',
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




	//edit basic pay
	$(".editpaye").click(function(event){
		event.preventDefault();
		var percentage = $(this).attr("title");
		var level_amount = $(this).attr("id");
		const la = level_amount.split("|");
		var id = $(this).attr("href");
		$("#level").val(la[0]);
		$("#amount").val(la[1]);
		$("#percenatage").val(percentage);
		$("#payeid").val(id);
	});




	//delete basic pay
	$(".deletepaye").click(function(event){

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
	        url: 'deletepaye?id='+id,
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


	/*********************************************** PAYE TAble Begins Here ***************************************/

	$("#submitadeduction").on('submit', function(event){
	      event.preventDefault();
	      
	      $.ajax({
	        type: 'POST',
	        url: 'submitadeduction',
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




	//edit basic pay
	$(".editadeductionid").click(function(event){
		event.preventDefault();
		var deduction = $(this).attr("title");
		var description = $(this).attr("id");
		var id = $(this).attr("href");
		$("#deduction").val(deduction);
		$("#description").val(description);
		$("#deductionid").val(id);
	});




	//delete basic pay
	$(".deleteadeduction").click(function(event){

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
	        url: 'deleteadeduction?id='+id,
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


	$("#generatepayslip").on('submit', function(event){
	      event.preventDefault();
	      
	      $.ajax({
	        type: 'POST',
	        url: 'generatepayslip',
	        data: new FormData(this),
	        contentType: false,
	        cache: false,
	        processData: false,
	        beforeSend:function(){
	                $("#button").hide();
	                $("#processing").show();
	            },
	        success: function(data){

	        
	        	$("#payslipview").html("");
	        	$("#payslipview").html(data);
	        
	          
              $("#button").show();
              $("#processing").hide();
	        }
	      });
	    });

/************************ Filter Payroll ******************************************/

	$("#month").change(function(){

		var month = $("#month").val();
		var year = '';
		var status = '';
		$.ajax({
	        url: 'querypayroll?month='+month+'&year='+year+'&status='+status,
	        success: function(data){
	        	$("#payslipview").html("");
	        	$("#payslipview").html(data);
	        }
		});

	});


	$("#year").change(function(){

		var month = '';
		var year = $("#year").val();
		var status = '';
		$.ajax({
	        url: 'querypayroll?month='+month+'&year='+year+'&status='+status,
	        success: function(data){
	        	$("#payslipview").html("");
	        	$("#payslipview").html(data);
	        }
		})

	})



	$("#status").change(function(){

		var month = '';
		var year = '';
		var status = $("#status").val();
		$.ajax({
	        url: 'querypayroll?month='+month+'&year='+year+'&status='+status,
	        success: function(data){
	        	$("#payslipview").html("");
	        	$("#payslipview").html(data);
	        }
		})

	});



	$("#updatepayroll").on('submit', function(event){
	      event.preventDefault();
	      
	      $.ajax({
	        type: 'POST',
	        url: 'updatepayroll',
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



	$("#compare1").change(function(){

		var month = $("#compare1").val();;
		var year = '';
		var status = '';
		$.ajax({
	        url: 'querypayroll?month='+month+'&year='+year+'&status='+status,
	        success: function(data){
	        	$("#compare1div").html("");
	        	$("#compare1div").html(data);
	        }
		})

	});


	$("#compare2").change(function(){

		var month = $("#compare2").val();;
		var year = '';
		var status = '';
		$.ajax({
	        url: 'querypayroll?month='+month+'&year='+year+'&status='+status,
	        success: function(data){
	        	$("#compare2div").html("");
	        	$("#compare2div").html(data);
	        }
		})

	});
	

</script>