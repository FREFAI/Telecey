<script type="text/javascript">
	$(document).ready(function(){
		$('.settings').on('change',function(e){
			var settingbutton = $(this);
			e.preventDefault();
			if($(this).prop("checked") == true){
				var type = $(this).attr("data-setting_key");

				if(window.location.protocol == "http:"){
				    resuesturl = "{{url('/admin/settings')}}"
				}else if(window.location.protocol == "https:"){
				    resuesturl = "{{secure_url('/admin/settings')}}"
				}
				$.ajax({
				    type: "post",
				    url: resuesturl,
				    headers: {
				        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				    },
				    dataType:'json',
				    data: {
				        'type':type,
				        'status':0
				    },
				    success: function (data) {
				        if(data.success){
				        	toastr.success('Settings', 'Setting update successfully' , {displayDuration:3000,position: 'top-right'});
				        }else{
				        	toastr.error('Settings', 'Somthing went wrong' , {displayDuration:3000,position: 'top-right'});
				        	settingbutton.prop("checked", false);
				        }
				    }         
				});
			}else{
				var type = $(this).attr("data-setting_key");
				if(window.location.protocol == "http:"){
				    resuesturl = "{{url('/admin/settings')}}"
				}else if(window.location.protocol == "https:"){
				    resuesturl = "{{secure_url('/admin/settings')}}"
				}
				$.ajax({
				    type: "post",
				    url: resuesturl,
				    headers: {
				        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				    },
				    dataType:'json',
				    data: {
				        'type':type,
				        'status':1
				    },
				    success: function (data) {
				        if(data.success){
				        	toastr.success('Settings', 'Setting update successfully' , {displayDuration:3000,position: 'top-right'});
				        }else{
				        	toastr.error('Settings', 'Somthing went wrong' , {displayDuration:3000,position: 'top-right'});
				        	settingbutton.prop("checked", true);
				        }
				    }         
				});
			}
		});
		$('.filtersettings').on('change',function(e){
			e.preventDefault();
			var filterbutton = $(this);
			if($(this).prop("checked") == true){
				var type = $(this).attr("data-setting_key");

				if(window.location.protocol == "http:"){
				    resuesturl = "{{url('/admin/filetrsettings')}}"
				}else if(window.location.protocol == "https:"){
				    resuesturl = "{{secure_url('/admin/filetrsettings')}}"
				}
				$.ajax({
				    type: "post",
				    url: resuesturl,
				    headers: {
				        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				    },
				    dataType:'json',
				    data: {
				        'type':type,
				        'status':0
				    },
				    success: function (data) {
				        if(data.success){
				        	toastr.success('Settings', 'Setting update successfully' , {displayDuration:3000,position: 'top-right'});
				        }else{
				        	toastr.error('Settings', 'Somthing went wrong' , {displayDuration:3000,position: 'top-right'});
				        	filterbutton.prop("checked", false);
				        }
				    }         
				});
			}else{
				var type = $(this).attr("data-setting_key");
				if(window.location.protocol == "http:"){
				    resuesturl = "{{url('/admin/filetrsettings')}}"
				}else if(window.location.protocol == "https:"){
				    resuesturl = "{{secure_url('/admin/filetrsettings')}}"
				}
				$.ajax({
				    type: "post",
				    url: resuesturl,
				    headers: {
				        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				    },
				    dataType:'json',
				    data: {
				        'type':type,
				        'status':1
				    },
				    success: function (data) {
				        if(data.success){
				        	toastr.success('Settings', 'Setting update successfully' , {displayDuration:3000,position: 'top-right'});
				        }else{
				        	toastr.error('Settings', 'Somthing went wrong' , {displayDuration:3000,position: 'top-right'});
				        	filterbutton.prop("checked", true);
				        }
				        
				    }         
				});
			}
		});
		// Ads Section
			// Ads Setting ajax
				$('#add_setting').on('change',function(e){
					var settingbutton = $(this);
					e.preventDefault();
					if($(this).prop("checked") == true){
						var type = $(this).attr("data-setting_key");

						if(window.location.protocol == "http:"){
						    resuesturl = "{{url('/admin/settings')}}"
						}else if(window.location.protocol == "https:"){
						    resuesturl = "{{secure_url('/admin/settings')}}"
						}
						$.ajax({
						    type: "post",
						    url: resuesturl,
						    headers: {
						        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
						    },
						    dataType:'json',
						    data: {
						        'type':type,
						        'status':1
						    },
						    success: function (data) {
						        if(data.success){
						        	toastr.success('Settings', 'Setting update successfully' , {displayDuration:3000,position: 'top-right'});
						        }else{
						        	toastr.error('Settings', 'Somthing went wrong' , {displayDuration:3000,position: 'top-right'});
						        	settingbutton.prop("checked", false);
						        }
						    }         
						});
					}else{
						var type = $(this).attr("data-setting_key");
						if(window.location.protocol == "http:"){
						    resuesturl = "{{url('/admin/settings')}}"
						}else if(window.location.protocol == "https:"){
						    resuesturl = "{{secure_url('/admin/settings')}}"
						}
						$.ajax({
						    type: "post",
						    url: resuesturl,
						    headers: {
						        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
						    },
						    dataType:'json',
						    data: {
						        'type':type,
						        'status':0
						    },
						    success: function (data) {
						        if(data.success){
						        	toastr.success('Settings', 'Setting update successfully' , {displayDuration:3000,position: 'top-right'});
						        }else{
						        	toastr.error('Settings', 'Somthing went wrong' , {displayDuration:3000,position: 'top-right'});
						        	settingbutton.prop("checked", true);
						        }
						    }         
						});
					}
				});
			// End Ads Setting ajax

			// Delete Ads

				$('.delete_ad').on('click',function(e){
					var delete_row = $(this);
					var id = $(this).attr("data-ad_id");

					if(window.location.protocol == "http:"){
					    resuesturl = "{{url('/admin/delete_ads')}}"
					}else if(window.location.protocol == "https:"){
					    resuesturl = "{{secure_url('/admin/delete_ads')}}"
					}
					swal("Are you sure you want to delete this add?", {
			          buttons: ["No", "Yes"],
			        })
			        .then(name => {
			          	if(name){
							$.ajax({
							    type: "post",
							    url: resuesturl,
							    headers: {
							        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
							    },
							    dataType:'json',
							    data: {
							        'id':id
							    },
							    success: function (data) {
							        if(data.success){
							        	delete_row.closest('tr').remove();
							        	toastr.success('Delete', data.message , {displayDuration:3000,position: 'top-right'});
							        }else{
							        	toastr.error('Delete', data.message , {displayDuration:3000,position: 'top-right'});
							        }
							    }         
							});
						}
					});
					
				});
			// End Delete Ads
		// End Ads Section
		// Delete Service Type
		$('.delete_servicetype').on('click',function(){
			var servicetype_id = $(this).attr('data-type_id');
			var delete_row = $(this);
			if(window.location.protocol == "http:"){
			    resuesturl = "{{url('/admin/deleteServicetype')}}"
			}else if(window.location.protocol == "https:"){
			    resuesturl = "{{secure_url('/admin/deleteServicetype')}}"
			}
			swal("Are you sure you want to delete this service type?", {
	          buttons: ["No", "Yes"],
	        })
	        .then(name => {
	          if(name){
	            $.ajax({
    			    type: "post",
    			    url: resuesturl,
    			    headers: {
    			        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    			    },
    			    dataType:'json',
    			    data: {
    			        'id':servicetype_id
    			    },
    			    success: function (data) {
    			        if(data.success){
    			        	delete_row.closest('tr').remove();
    			        	toastr.success('Delete', data.message , {displayDuration:3000,position: 'top-right'});
    			        }else{
    			        	toastr.error('Delete', data.message , {displayDuration:3000,position: 'top-right'});
    			        }
    			    }         
    			});
	          }
	        })
		});

		// Delete Provider

		$('.delete_provider').on('click',function(){
			var provider_id = $(this).attr('data-provider_id');
			var delete_row = $(this);
			if(window.location.protocol == "http:"){
			    resuesturl = "{{url('/admin/deleteProvider')}}"
			}else if(window.location.protocol == "https:"){
			    resuesturl = "{{secure_url('/admin/deleteProvider')}}"
			}
			swal("Are you sure you want to delete this provider?", {
	          buttons: ["No", "Yes"],
	        })
	        .then(name => {
	          	if(name){
					$.ajax({
					    type: "post",
					    url: resuesturl,
					    headers: {
					        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					    },
					    dataType:'json',
					    data: {
					        'id':provider_id
					    },
					    success: function (data) {
					        if(data.success){
					        	delete_row.closest('tr').remove();
					        	toastr.success('Delete', data.message , {displayDuration:3000,position: 'top-right'});
					        }else{
					        	toastr.error('Delete', data.message , {displayDuration:3000,position: 'top-right'});
					        }
					    }         
					});
				}
			});
		});

		// Approve or Not approved Provider

		$(document).on('click','.approved_btn',function(){
			var provider_id = $(this).attr('data-provider_id');
			var status = $(this).attr('data-status');
			status = $.trim(status);
			var current_row = $(this);
			if(window.location.protocol == "http:"){
			    resuesturl = "{{url('/admin/approveProvider')}}"
			}else if(window.location.protocol == "https:"){
			    resuesturl = "{{secure_url('/admin/approveProvider')}}"
			}
			if(status == 1){
				var mesages = 'Are you sure you want to approved this provider?';
			}else{
				var mesages = 'Are you sure you want to not approved this provider?';
			}
			swal(mesages, {
	          buttons: ["No", "Yes"],
	        })
	        .then(name => {
	          	if(name){
					$.ajax({
					    type: "post",
					    url: resuesturl,
					    headers: {
					        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					    },
					    dataType:'json',
					    data: {
					        'id':provider_id,
					        'status':status
					    },
					    success: function (data) {
					        if(data.success){
					        	if(status == 1){
					        		current_row.closest('tr').find('.not_ap_ms').addClass('d-none');
					        		current_row.closest('tr').find('.approved_ms').removeClass('d-none');
					        		current_row.removeClass('btn-success');
					        		current_row.attr('data-original-title','Not approve');
					        		current_row.attr('data-status',0);
					        		current_row.addClass('btn-danger');
					        		current_row.find('i').removeClass('ni ni-check-bold');
					        		current_row.find('i').addClass('ni ni-fat-remove');
					        		toastr.success('Approved', data.message , {displayDuration:3000,position: 'top-right'});
					        	}else{
					        		current_row.closest('tr').find('.approved_ms').addClass('d-none');
					        		current_row.closest('tr').find('.not_ap_ms').removeClass('d-none');
					        		current_row.removeClass('btn-danger');
					        		current_row.addClass('btn-success');
					        		current_row.attr('data-original-title','Approve');
					        		current_row.attr('data-status',1);
					        		current_row.find('i').removeClass('ni ni-fat-remove');
					        		current_row.find('i').addClass('ni ni-check-bold');
					        		toastr.success('Not approved', data.message , {displayDuration:3000,position: 'top-right'});
					        	}
					        }else{
					        	toastr.error('Not approved', data.message , {displayDuration:3000,position: 'top-right'});
					        }
					    }         
					});
				}
			});
		});
	});
</script>