$(function(){

	$(function () {
       $('body').on('click', '#select-all', function (event) {
           var selected = this.checked;
           // Iterate each checkbox
           $(':checkbox').each(function () {    this.checked = selected; });

       });
    });


	$('.cnic').mask('00000-0000000-0');
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



	$('.calenderDev').datepicker({
		format:'MM-yy',
		autoclose: true,
	});

	$('body').on('click', '#sendRemiderMsg', function (e) {
    	e.preventDefault();
    	var yourArray = [];
		$("input:checkbox[name=bookingId]:checked").each(function(){
		    yourArray.push($(this).val());
		});
    	var r = confirm('Are you sure you want to send reminder messages('+yourArray.length+')?');
    	if(r){
    		
			$('#booking_id_reminder').val(yourArray);
			$('#reminder_date_value').val($('#reminder_date').val());
			$('#reminderMsgForm').submit();
    	}
    });

    $('body').on('click', '#sendWarningMsg', function (e) {
    	e.preventDefault();
    	var yourArray = [];
		$("input:checkbox[name=bookingId]:checked").each(function(){
		    yourArray.push($(this).val());
		});
    	var r = confirm('Are you sure you want to send warning messages('+yourArray.length+')?');
    	if(r){
    		
			$('#booking_warning_id_value').val(yourArray);
			$('#warning_msg_date_value').val($('#reminder_date').val());
			$('#warningMsgForm').submit();
    	}
    });

    $('body').on('click', '#getCsvReport', function (e) {
    	var yourArray = [];
		$("input:checkbox[name=bookingId]:checked").each(function(){
		    yourArray.push($(this).val());
		});
		$('#booking_id_csv').val(yourArray);
		$('#csvForm').submit();
    });

    $('body').on('click', '#getWarningLetter', function (e) {
    	e.preventDefault();
    	var yourArray = [];
		$("input:checkbox[name=bookingId]:checked").each(function(){
		    yourArray.push($(this).val());
		});
    	var r = confirm('Are you sure you want to send warning letters ('+yourArray.length+')?');
    	if(r){
	    	
			$('#booking_id_warning').val(yourArray);
			$('#warning_date_value').val($('#reminder_date').val());
			$('#warningLetterForm').submit();
		}
    });

    

	$('body').on('click', '.flagLink', function (e) {
    	e.preventDefault();
    	var r = confirm('Are you sure you want to change booking file flag?');
    	if(r){
    		window.location = $(this).parent().attr('href');
    	}
    });
    $('.performTask').click(function(e){
    	e.preventDefault();
    	var r = confirm('Are you sure you want to perform this task?');
    	if(r){
    		//window.location = $(this).attr('href');
    		window.open($(this).attr('href'),'_blank').focus();
    	}
    });

	$('body').on('change', '.modesS', function (e) {
		var vall = $(this).val();
		var $this = $(this);
		if($this.val() != 0){
	        $this.parent().next().find('input').val($this.find('option:selected').attr('rel'));
	    }
		// var htmlText = '<div class="tdBox form-group col-lg-2" style="padding-left: 0px;"><label>Created Date</label><input class="form-control calender" name="monthlyDate[]" placeholder="Created Date" autocomplete="off"></div>';
		// var htmlTextHid = '<div class="tdBox form-group col-lg-2 hide" style="padding-left: 0px;"><label>Created Date</label><input class="form-control calender" name="monthlyDate[]" placeholder="Created Date" autocomplete="off"></div>';

		// if(vall == 34 || vall == 'development'){
		// 	$this.parent().parent().append(htmlText);
		// 	$('.calender').datepicker({
		//     	format:'MM-yy',
		//     	autoclose: true,
		//     	todayHighlight: true
		//     });
		// } else{
		// 	$this.parent().parent().append(htmlTextHid);
		// 	$this.parent().parent().find('.tdBox').remove();
		// }
	});

    $('.calender').datepicker({
    	format:'yyyy-mm-dd',
    	autoclose: true,
    	todayHighlight: true
    });


    
    $(document).on('change', '#phase_id_dashboard', function (e) {
		var phase = $(this).val();
		window.location = baseUrl+'/phase/setphase/phase_id/'+phase;
	});

	var extraTransMode = ['development','penalty','others','lease_charges','transfer_fee'];
    $(document).on('change', '#mode', function (e) {
		var mode = $(this).val();
		var $that = $(this);
		
		//if(mode==='development'){
		if(extraTransMode.includes(mode)){
			//$('#addNewPayment').addClass('hide');
			//$('input[name="transaction[]"]').val($('#extraLastTrans').val());
			$that.parent().parent('.modeSBox').find('input[name="transaction[]"]').val($('#LastTrans').val());
		} else{
			$('#addNewPayment').removeClass('hide');
			//$('input[name="transaction[]"]').val($('#LastTrans').val());
			$that.parent().parent('.modeSBox').find('input[name="transaction[]"]').val($('#LastTrans').val());
		}
		
	});


    $('body').on('click', '.changeblockedstatus', function (e) {
    	e.preventDefault();
    	var r = confirm('Are you sure you want to change status of this booking?');
    	if(r){
    		window.location = $(this).parent().attr('href');
    	}
    });

    $('body').on('click', '.unblockBooking', function (e) {
    	e.preventDefault();
    	var r = confirm('Are you sure you want to change status of this booking?');
    	if(r){
    		window.location = $(this).parent().attr('href');
    	}
    });


    $('#transferBooking').click(function(e){
    	e.preventDefault();

    	var r = confirm('Are you sure you want to transfer this booking?');
    	if(r){
    		window.location = $(this).attr('href');
    	}
    });


    $('#cancelBooking').click(function(e){
    	e.preventDefault();
    	var r = confirm('Are you sure you want to cancel this booking?');
    	if(r){
    		window.location = $(this).attr('href');
    	}
    });

    $('#cancel_percentage').blur(function(){
    	var booking_id = $('#booking_id').val();
    	window.location = baseUrl+'/booking/cancel/'+booking_id+'?percentage='+$(this).val();
    });


    $('#transactionBtn').click(function(){
    	var plotid = $('#plot_id').val();
    	var lastId = $('#lastTransactionId').val();
    	//var url = baseUrl+'/booking/printinvoice/id/'+plotid+'/last/'+lastId+'?q=new_value';
    	//window.open(url, '_blank');
    	//newWindow = window.open(url, '_blank');
		  
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
		console.log(baseUrl);
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
	            		if(d.type=='plot'){
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
	            			$('#dataTabless-transaction').dataTable().fnDestroy();
		            		$('#searchListData-transaction').html(d.data.table);	
		            		$('#searchList-transaction').modal('show');
		            		$('.blockText').text($('#searchPlotText').val());
		            		$('#dataTabless-transaction').DataTable({
					            iDisplayLength : 10,
					            aaSorting: [],
					            lengthChange: false,
					            language: {
							        searchPlaceholder: "Search transaction "+$('#searchPlotText').val()
							    },
					            aoColumnDefs: [
					                { "bSearchable": false, "aTargets": [ 2,3,4 ] }
					            ],
					        });
	            		}
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
		var c = confirm('Are you sure you want to delete.?');
		if(c){
			var id = $(this).data('rel');
			if(id!=''){
				var url = baseUrl+'/api/delete/type/booking/id/'+id;
				$.ajax({
		            url: url,
		            type: 'GET',
		            success: function (response) {
		            	var d = JSON.parse(response);
		            },
				});
			} else{
				displayAlert('Something went wrong','danger');
			}	
		}
	});

	$(document).on('click', '.deletePlot', function (e) {
		var c = confirm('Are you sure you want to delete.?');
		if(c){
			var id = $(this).data('rel');
			if(id!=''){
				var url = baseUrl+'/api/delete/type/plot/id/'+id;
				$.ajax({
		            url: url,
		            type: 'GET',
		            success: function (response) {
		            	var d = JSON.parse(response);
		            },
				});
			} else{
				displayAlert('Something went wrong','danger');
			}	
		}
	});

	$(document).on('click', '.deleteLetter', function (e) {
		var c = confirm('Are you sure you want to delete.?');
		if(c){
			var id = $(this).data('rel');
			if(id!=''){
				var url = baseUrl+'/api/delete/type/letter/id/'+id;
				$.ajax({
		            url: url,
		            type: 'GET',
		            success: function (response) {
		            	window.location.reload();
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
		var  html2 = $('#paymentModeDevBoxHidden').html();

		if($('#mode').val() == 'development'){
			$('#paymentModeBox').append(html2);	
		} else{
			$('#paymentModeBox').append(htmll);
		}

		
	});



	$(document).on('change', 'select[name="destination_id"]', function (e) {
		var source_id = $('select[name="source_id"]').val();
		var url = baseUrl+'/booking/transferamount/id/'+source_id+'/to/'+$(this).val();
		window.location = url;
	});


	$(document).on('click', '.addtemp', function (e) {
		var that = $(this);
		var id = $(this).data('rel');
		var datee = $(this).data('datee');
		var htmll = $('#paymentModeBoxHiddenTransfer').html().replace(/\*/g, id);
		
		var trans = ($(this).data('trans')).replace('#','');
		//$('#tempBox_'+id).append(htmll);
		//console.log($(this).parent().parent())
		//$('#parentTr_'+id).append(htmll);
		$(htmll).insertAfter($('#parentTr_'+id));
		$('.childTrans_'+id).val(trans);
		$('.childTrans_'+id).attr('readonly',true);

		$('.childDatee_'+id).val(datee);
		$('.childDatee_'+id).attr('readonly',true);
	});

	// $(document).on('change', '#plot_number', function (e) {
	// 	var plot_number = $(this).val();
	// 	if(plot_number!=''){
	// 		var url = baseUrl+'/api/getplotdetail/type/plot/id/'+plot_number;
	// 		$.ajax({
	//             url: url,
	//             type: 'GET',
	//             success: function (response) {
	//             	var d = JSON.parse(response);
	//             	//$('#block_number').val(d.data.block_number);
	//             	$('#category_id').val(d.data.category_id);
	//             	$('#size_id').val(d.data.size_id);
	//             },
	// 		});

	// 	} else{
	// 		//$('#block_number').val('');
	// 		$('#category_id').val(0);
	// 		$('#size_id').val(0);
	// 	}
	// });

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
	            	// if(d.data.schedule){
	            	// 	$("#is_special").val(d.data.schedule.id);
		            // 	$("#is_special").attr('disabled',true);	
	            	// } else{
	            	// 	$("#is_special").val(0);
		            // 	$("#is_special").attr('disabled',false);
	            	// }
	            	
	            	if(d.data.agent){
	            		$("#agent_parent_id").val(d.data.agent.parent.id);
		            	getSubDealer(d.data.agent.parent.id,d.data.agent)
		            	$("#agent_percentage").val(d.data.agent.detail.percentage);
		            	//$('#agent_commission').val(d.data.agent.detail.percentage_value);
		            	$('#agent_commission').val(d.data.agent.commission);
		            	$("#agent_id").attr('readonly',true);	

		            	$("#is_special").val(d.data.schedule.id);
	            	} else{
	            		$("#agent_parent_id").val('');
	            		$('#sub_agent').val('');
	            		$("#agent_percentage").val('');
		            	$('#agent_commission').val('');
		            	$("#agent_percentage").val('');
		            	$("#agent_id").attr('readonly',false);	 

		            	$("#is_special").val('');
	            	}
	            	$('#discount').val(d.data.discount);

	            	
	            },
			});

		} else{
			//$('#block_number').val('');
			$('#category_id').val('');
			$('#size_id').val('');
			$('#agent_parent_id').val('');
			$("#agent_percentage").val('');
			$("#is_special").val('');
		}
	});

	function getSubDealer(id,agent){
		// var url = baseUrl+'/api/getagentdetail/id/'+id;
		// $.ajax({
  //           url: url,
  //           type: 'GET',
  //           success: function (response) {
  //           	var d = JSON.parse(response);
  //           	//$("#sub_agent").html(d.data);
  //           	if(agent.detail){
  //           		$("#sub_agent").val(agent.detail.id);	
  //           	}
            	
  //           },
		// });
		if(agent.detail){
    		$("#sub_agent").val(agent.detail.id);	
    	}
	}

	// $(document).on('change', '#agent_parent_id', function (e) {
	// 	var id = $(this).val();
	// 	if(id!=''){
	// 		var url = baseUrl+'/api/getagentdetail/id/'+id;
	// 		$.ajax({
	//             url: url,
	//             type: 'GET',
	//             success: function (response) {
	//             	var d = JSON.parse(response);
	//             	$("#sub_agent").html(d.data);
	//             },
	// 		});
	// 	}
	// });



	function check(input) {
        if (input.value != document.getElementById('password').value) {
            input.setCustomValidity('Password Must be Matching.');
        } else {
            // input is valid -- reset the error message
            input.setCustomValidity('');
        }
    }

	$(document).on('change', '#block_number', function (e) {
		var block_number = $(this).val();
		if(block_number!=''){
			var url = baseUrl+'/api/getplotdetail/type/plot_type/id/'+block_number;
			$.ajax({
	            url: url,
	            type: 'GET',
	            success: function (response) {
	            	var d = JSON.parse(response);
	            	$('#plot_type').html(d.data);
	            	//$('#plot_number').select2("val", 0);
	            	$('#plot_number').empty();
					$('#plot_type').val('');
					$('#category_id').val('');
					$('#size_id').val('');
	            	// $('#category_id').val(d.data.category_id);
	            	// $('#size_id').val(d.data.size_id);
	            },
			});

		} else{
			//$('#plot_number').select2("val", 0);
			$('#plot_number').empty();
			$('#plot_type').val('');
			$('#category_id').val('');
			$('#size_id').val('');
		}
	});

	$(document).on('change', '#plot_type', function (e) {
		var plot_type = $(this).val();
		var block_number = $('#block_number').val();
		if(block_number!=''){
			var url = baseUrl+'/api/getplotdetailUpdate/type/'+plot_type+'/block/'+block_number;
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


	
    $('input[name="is_special"]').click(function(){
        var $radio = $(this);
        // if this was previously checked
        if ($radio.data('waschecked') == true)
        {
            $radio.prop('checked', false);
            $radio.data('waschecked', false);
        }
        else
            $radio.data('waschecked', true);
        
        // remove was checked from other radios
        $radio.siblings('input[name="is_special"]').data('waschecked', false);
    });

    $(".paymentModeBox :input").prop("disabled", true);
    $('.paymentModeBox :input[type="checkbox"]').prop("disabled", false);

    $('.edit_payment_row').click(function(){
    	var id = $(this).val();
    	if($(this).is(':checked')){
    		$("#paymentModeBox_"+id+" :input").prop("disabled", false);
    		$('#paymentModeBox_'+id+' :input[type="checkbox"]').prop("disabled", false);
    	} else{
    		$("#paymentModeBox_"+id+" :input").prop("disabled", true);
    		$('#paymentModeBox_'+id+' :input[type="checkbox"]').prop("disabled", false);
    	}
    })
});