$(function(){


	$('.cnic').mask('00000-0000000-0');
	
	var delay = (function(){
	  var timer = 0;
	  return function(callback, ms){
	    clearTimeout (timer);
	    timer = setTimeout(callback, ms);
	  };
	})();
	$('.plot_size').keyup(function() {
	    delay(function(){
	      $('.plot_size').val($(this).val()+ 'SQ Yrd');
	    }, 1000 );
	});
	$('.numbersOnly').keyup(function (e) {
        var max = $(this).attr('maxlength');
        this.value = this.value.replace(/[^0-9-,]/g,'');
        if (this.value.length == max) {
            e.preventDefault();
        } else if (this.value.length > max) {
            // Maximum exceeded
            this.value = this.value.substring(0, max);
        }
    });

    $('.calender').datepicker({
    	format:'yyyy-mm-dd',
    	autoclose: true,
    	todayHighlight: true
    });

    
    $('body').on('click', '#transactionBtn', function (e) {
    	var plotid = $('#plot_id').val();
    	var url = baseUrl+'/booking/printinvoice/'+plotid;
    	window.open(url, '_blank'); 
    });


	function displayAlert(msg,type,redirect = ''){//success, danger, warning, info
		var html = '<div class="alert alert-'+type+' alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>'+msg+'</div>';
		$('.alertMsgBox').html(html);
		$('.alertMsgBox').show();
		setTimeout(function(){
			$('.alertMsgBox').hide();
			if(redirect!=''){
				window.location = redirect;
			}
		},2000);
	}

	$(document).bind('keypress', function(e) {
            if(e.keyCode==13){
                 $('#loginBtn').trigger('click');
             }
        });
	$('#loginBtn').click(function(){
		var postObject = new Object();
		postObject.email = $('#email').val();
		postObject.password = $('#password').val();
		var error = [];
		if(!postObject.email){
			error.push('Please enter valid email address.');
		}
		if(!postObject.password){
			error.push('Please enter your password.');
		}

		// var postObject = new Object();
		// postObject.key = '9h34zjc6h937y8fpm5ybu5u2';
		// postObject.secret = 'W6ywNPJPJD';
		// postObject.status = 'Active';
		// postObject.api_key = 'ndw7rvg5qndvdycey5k6efhz';
		if(error.length == 0){
			url = baseUrl+'/api/authenticate';
			//url = 'https://api.test.hotelbeds.com/hotel-api/1.0/status';
	        $.ajax({
	            url: url,
	            type: 'POST',
	            data: postObject,
	            success: function (response) {
	            	var data = JSON.parse(response);
	            	console.log(data)
	            	 if(typeof data.error == 'undefined'){

	            		displayAlert(data.message,'success',baseUrl+'/dashboard');	
	            	} else{
	            		displayAlert(data.message,'danger');
	            	}
	            	
	            },
	            error: function (response) {
	            	var data = JSON.parse(response);
	            	displayAlert(data.message,'danger');
	            }
	        });
		} else{
			var errors = '';
			$(error).each(function(i,e){
				errors +=e+'<br/>';
			});
			displayAlert(errors,'danger');
		}

	});
	
	$(document).on('click', '#searchPlot', function (e) {
		var postObject = new Object();
		postObject.keyword = $('#searchPlotText').val();
		if($('#searchPlotText').val() !=''){
			url = baseUrl+'/api/getplots';
			//url = 'https://api.test.hotelbeds.com/hotel-api/1.0/status';
	        $.ajax({
	            url: url,
	            type: 'POST',
	            data: postObject,
	            success: function (response) {
	            	var d = JSON.parse(response);
	            	if(typeof d.error == 'undefined'){
	            		$('#dataTabless').dataTable().fnDestroy();
	            		$('#searchListData').html(d.data.table);	
	            		$('#searchList').modal('show');
	            		$('.blockText').text($('#searchPlotText').val());
	            		$('#dataTabless').DataTable({
				            iDisplayLength : 10,
				            aaSorting: [],
				            lengthChange: false,
				            language: {
						        searchPlaceholder: "Search plots in block "+$('#searchPlotText').val()
						    },
				            aoColumnDefs: [
				                { "bSearchable": false, "aTargets": [ 2,3,4 ] }
				            ],
				        });
	            	} else{
	            		
	            	}
	            	
	            },
	            error: function (response) {
	            	var d = JSON.parse(response);
	            	displayAlert(d.message,'danger');
	            }
	        });
		} else{

		}
	});

	//delete
	
	$(document).on('click', '.deleteBooking', function (e) {
		var c = confirm('Are you sure you want to delete this booking.?');
		if(c){
			var id = $(this).data('rel');
			console.log(id);
			if(id!=''){
				var url = baseUrl+'/api/delete/type/booking/id/'+id;
				$.ajax({
		            url: url,
		            type: 'GET',
		            success: function (response) {
		            	displayAlert('Booking deleted successfully.','success');
		            	setTimeout(function(){
		            		window.location.reload();	
		            	}, 1000);
		            	
		            },
				});
			} else{
				displayAlert('Something went wrong','danger');
			}	
		}
	});

	$(document).on('click', '.deletePlot', function (e) {
		var c = confirm('Are you sure you want to delete this plot.?');
		if(c){
			var id = $(this).data('rel');
			if(id!=''){
				var url = baseUrl+'/api/delete/type/plot/id/'+id;
				$.ajax({
		            url: url,
		            type: 'GET',
		            success: function (response) {
		            	displayAlert('Plot deleted successfully.','success');
		            	setTimeout(function(){
		            		window.location.reload();	
		            	}, 1000);
		            },
				});
			} else{
				displayAlert('Something went wrong','danger');
			}	
		}
	});
	//end of delete

	$(document).on('click', '#addNewPayment', function (e) {
		var htmll = $('#paymentModeBoxHidden').html();
		$('#paymentModeBox').append(htmll);s
	});

	$(document).on('change', '#plot_number', function (e) {
		var plot_number = $(this).val();
		if(plot_number!=''){
			var url = baseUrl+'/api/getplotdetail/type/plot/id/'+plot_number;
			$.ajax({
	            url: url,
	            type: 'GET',
	            success: function (response) {
	            	var d = JSON.parse(response);
	            	//$('#block_number').val(d.data.block_number);
	            	$('#category_id').val(d.data.category_id);
	            	$('#size_id').val(d.data.size_id);
	            },
			});

		} else{
			//$('#block_number').val('');
			$('#category_id').val(0);
			$('#size_id').val(0);
		}
	});

	$(document).on('change', '#block_number', function (e) {
		var block_number = $(this).val();
		if(block_number!=''){
			var url = baseUrl+'/api/getplotdetail/type/block/id/'+block_number;
			$.ajax({
	            url: url,
	            type: 'GET',
	            success: function (response) {
	            	var d = JSON.parse(response);
	            	$('#plot_number').html(d.data);
	            	// $('#category_id').val(d.data.category_id);
	            	// $('#size_id').val(d.data.size_id);
	            },
			});

		} else{
			$('#plot_number').val('');
			$('#category_id').val(0);
			$('#size_id').val(0);
		}
	});

	$(document).on('change', '#size_id', function (e) {
		var size_id = $(this).val();
		if(size_id !=''){
			var url = baseUrl+'/api/getsizepaymentdetail/id/'+size_id;
			$.ajax({
	            url: url,
	            type: 'GET',
	            success: function (response) {
	            	var d = JSON.parse(response);
	            	$('#amount').val(d.data.amount);
	            	
	            },
			});
		}
	});
});