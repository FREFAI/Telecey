
<script type="text/javascript">
	$(document).ready(function(){
		
		$('.datepicker').datepicker();
		$('.datepicker-one').datepicker();
		$('.datepicker-two').datepicker();
		$(".rating_disable").rate({
		  readonly:true
		});
		tinymce.init({ 
			selector:'.text_editor' ,
			height: 300,
			plugins: [
			      'advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker',
			      'searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking',
			      'save table contextmenu directionality emoticons template paste textcolor'
			    ],
			    content_css: 'css/content.css',
			    toolbar: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link | preview fullpage | forecolor backcolor emoticons'
		});
		function readURL(input) {
		    if (input.files && input.files[0]) {
		        var reader = new FileReader();
		        reader.onload = function(e) {
		            $('#imagePreview').css('background-image', 'url('+e.target.result +')');
		            $('#imagePreview').hide();
		            $('#imagePreview').fadeIn(650);
		        }
		        reader.readAsDataURL(input.files[0]);
		    }
		}
		$("#imageUpload").change(function() {
		    readURL(this);
		});

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



		// Delete Blog

		$('.delete_blog').on('click',function(){
			var blog_id = $(this).attr('data-blog_id');
			var delete_row = $(this);
			if(window.location.protocol == "http:"){
			    resuesturl = "{{url('/admin/deleteBlog')}}"
			}else if(window.location.protocol == "https:"){
			    resuesturl = "{{secure_url('/admin/deleteBlog')}}"
			}
			swal("Are you sure you want to delete this post?", {
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
					        'id':blog_id
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

		// Delete Class

		$('.delete_class').on('click',function(){
			var class_id = $(this).attr('data-class_id');
			var delete_row = $(this);
			if(window.location.protocol == "http:"){
			    resuesturl = "{{url('/admin/deleteClass')}}"
			}else if(window.location.protocol == "https:"){
			    resuesturl = "{{secure_url('/admin/deleteClass')}}"
			}
			swal("Are you sure you want to delete this class?", {
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
					        'id':class_id
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

		// Delete Question

		$('.delete_question').on('click',function(){
			var question_id = $(this).attr('data-question_id');
			var delete_row = $(this);
			if(window.location.protocol == "http:"){
			    resuesturl = "{{url('/admin/delete-question')}}"
			}else if(window.location.protocol == "https:"){
			    resuesturl = "{{secure_url('/admin/delete-question')}}"
			}
			swal("Are you sure you want to delete this question?", {
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
					        'id':question_id
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


		// Device Delete 
			$('.delete_device').on('click',function(){
				var device_id = $(this).attr('data-device_id');
				var delete_row = $(this);
				if(window.location.protocol == "http:"){
				    resuesturl = "{{url('/admin/delete-device')}}"
				}else if(window.location.protocol == "https:"){
				    resuesturl = "{{secure_url('/admin/delete-device')}}"
				}
				swal("Are you sure you want to delete this device?", {
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
						        'id':device_id
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
		// End Device Delete 
		// Brand Delete 
			$('.delete_brand').on('click',function(){
				var brand_id = $(this).attr('data-brand_id');
				var delete_row = $(this);
				if(window.location.protocol == "http:"){
				    resuesturl = "{{url('/admin/delete-brand')}}"
				}else if(window.location.protocol == "https:"){
				    resuesturl = "{{secure_url('/admin/delete-brand')}}"
				}
				swal("Are you sure you want to delete this brand?", {
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
						        'id':brand_id
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
			$('.default_check_brand').on('change',function(){
				var brand_id = $(this).attr('data-brand_id');
				var delete_row = $(this);
				if(window.location.protocol == "http:"){
				    resuesturl = "{{url('/admin/set-default-model')}}"
				}else if(window.location.protocol == "https:"){
				    resuesturl = "{{secure_url('/admin/set-default-model')}}"
				}
				if($(this).prop("checked") == true){
					swal("Are you sure you want to choose as default this model?", {
			          buttons: ["No", "Yes"],
			        })
			        .then(res => {
			          	if(res){
			          		$.ajax({
			          		    type: "post",
			          		    url: resuesturl,
			          		    headers: {
			          		        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			          		    },
			          		    dataType:'json',
			          		    data: {
			          		        'id':brand_id,
			          		        'status':1
			          		    },
			          		    success: function (data) {
			          		        if(data.success){
			          		        	$('.default_check_brand').prop("checked", false); 
			          		        	$('#customCheck'+brand_id).prop("checked", true); 
			          		        	toastr.success('Default Status', data.message , {displayDuration:3000,position: 'top-right'});
			          		        }else{
			          		        	toastr.error('Default Status', data.message , {displayDuration:3000,position: 'top-right'});
			          		        }
			          		    }         
			          		});
			          	}else{
			          		$(this).prop("checked", false); 
			          	}
		          	});
			    }else if($(this).prop("checked") == false){
    				swal("Are you sure you want to remove as default this model?", {
    		          buttons: ["No", "Yes"],
    		        })
    		        .then(res => {
    		          	if(res){
    		          		$.ajax({
    		          		    type: "post",
    		          		    url: resuesturl,
    		          		    headers: {
    		          		        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    		          		    },
    		          		    dataType:'json',
    		          		    data: {
    		          		        'id':brand_id,
    		          		        'status':0
    		          		    },
    		          		    success: function (data) {
    		          		        if(data.success){
    		          		        	if(data.status == 1){
    		          		        		$('.default_check_brand').prop("checked", false); 
    		          		        		$('#customCheck'+brand_id).prop("checked", true);
    		          		        	}
    		          		        	toastr.success('Default Status', data.message , {displayDuration:3000,position: 'top-right'});
    		          		        }else{
    		          		        	toastr.error('Default Status', data.message , {displayDuration:3000,position: 'top-right'});
    		          		        }
    		          		    }         
    		          		});
    		          	}else{
    		          		$(this).prop("checked", false); 
    		          	}
    	          	});
			    }
			});
			$(document).on('click','.approved_brand_btn',function(){
				var brand_id = $(this).attr('data-brand_id');
				var status = $(this).attr('data-status');
				status = $.trim(status);
				var current_row = $(this);
				if(window.location.protocol == "http:"){
				    resuesturl = "{{url('/admin/approveBrand')}}"
				}else if(window.location.protocol == "https:"){
				    resuesturl = "{{secure_url('/admin/approveBrand')}}"
				}
				if(status == 1){
					var mesages = 'Are you sure you want to approved this supplier?';
				}else{
					var mesages = 'Are you sure you want to not approved this supplier?';
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
						        'id':brand_id,
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
		// End Brand Delete 
		// Model Delete 
			$('.delete_model').on('click',function(){
				var model_id = $(this).attr('data-model_id');
				var delete_row = $(this);
				if(window.location.protocol == "http:"){
				    resuesturl = "{{url('/admin/delete-model')}}"
				}else if(window.location.protocol == "https:"){
				    resuesturl = "{{secure_url('/admin/delete-model')}}"
				}
				swal("Are you sure you want to delete this model?", {
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
						        'id':model_id
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
		// End Model Delete

		// User approved or not  
			$(document).on('click','.approved_user_btn',function(){
				var provider_id = $(this).attr('data-provider_id');
				var status = $(this).attr('data-status');
				status = $.trim(status);
				var current_row = $(this);
				if(window.location.protocol == "http:"){
				    resuesturl = "{{url('/admin/approveUser')}}"
				}else if(window.location.protocol == "https:"){
				    resuesturl = "{{secure_url('/admin/approveUser')}}"
				}
				if(status == 1){
					var mesages = 'Are you sure you want to approved this user?';
				}else{
					var mesages = 'Are you sure you want to not approved this user?';
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
						        		// current_row.closest('tr').find('.not_ap_ms').addClass('d-none');
						        		// current_row.closest('tr').find('.approved_ms').removeClass('d-none');
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
		// End User approved or not  

		// Sub Admin Section 

			// Delete Provider
			$('.delete_admin').on('click',function(){
				var admin_id = $(this).attr('data-admin_id');
				var delete_row = $(this);
				if(window.location.protocol == "http:"){
				    resuesturl = "{{url('/admin/delete-admin')}}"
				}else if(window.location.protocol == "https:"){
				    resuesturl = "{{secure_url('/admin/delete-admin')}}"
				}
				swal("Are you sure you want to delete this admin?", {
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
						        'id':admin_id
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

			// User approved or not  

				$(document).on('click','.forgot_email',function(e){
					e.preventDefault();
					var url = $(this).attr('data-url');
					swal('Are you sure you want to sent forgot password email?', {
			          buttons: ["No", "Yes"],
			        })
			        .then(name => {
			        	if(name){
			        		window.location = url;
			        	}
			        });
				});
				$(document).on('click','.approved_admin_btn',function(){
					var admin_id = $(this).attr('data-admin_id');
					var status = $(this).attr('data-status');
					status = $.trim(status);
					var current_row = $(this);
					if(window.location.protocol == "http:"){
					    resuesturl = "{{url('/admin/approveOrUnapproveAdmin')}}"
					}else if(window.location.protocol == "https:"){
					    resuesturl = "{{secure_url('/admin/approveOrUnapproveAdmin')}}"
					}
					if(status == 1){
						var mesages = 'Are you sure you want to approved this admin?';
					}else{
						var mesages = 'Are you sure you want to not approved this admin?';
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
							        'id':admin_id,
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
			// End User approved or not  
		// End Sub Admin Section 

		// Chat Section
			$(document).on('click','.close_case_btn',function(){
				var case_id = $(this).attr('data-case_id');
				var status = $(this).attr('data-status');
				status = $.trim(status);
				var current_row = $(this);
				if(window.location.protocol == "http:"){
				    resuesturl = "{{url('/admin/closeCaseRequest')}}"
				}else if(window.location.protocol == "https:"){
				    resuesturl = "{{secure_url('/admin/closeCaseRequest')}}"
				}
				swal('Are you sure you want to close this case?', {
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
						        'case_id':case_id,
						        'status':status
						    },
						    success: function (data) {
						        if(data.success){
						        		current_row.closest('tr').find('.status-td').text('Closed');
						        		current_row.removeClass('close_case_btn');
						        		toastr.success('Approved', data.message , {displayDuration:3000,position: 'top-right'});
						        }else{
						        	toastr.error('Not approved', data.message , {displayDuration:3000,position: 'top-right'});
						        }
						    }         
						});
					}
				});
			});
		
		// End Chat Section

		// Supplier Section
			$('.delete_supplier').on('click',function(){
				var supplier_id = $(this).attr('data-supplier_id');
				var delete_row = $(this);
				if(window.location.protocol == "http:"){
				    resuesturl = "{{url('/admin/delete-supplier')}}"
				}else if(window.location.protocol == "https:"){
				    resuesturl = "{{secure_url('/admin/delete-supplier')}}"
				}
				swal("Are you sure you want to delete this Supplier?", {
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
						        'id':supplier_id
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

			$(document).on('click','.approved_supplier_btn',function(){
				var supplier_id = $(this).attr('data-supplier_id');
				var status = $(this).attr('data-status');
				status = $.trim(status);
				var current_row = $(this);
				if(window.location.protocol == "http:"){
				    resuesturl = "{{url('/admin/approveSupplier')}}"
				}else if(window.location.protocol == "https:"){
				    resuesturl = "{{secure_url('/admin/approveSupplier')}}"
				}
				if(status == 1){
					var mesages = 'Are you sure you want to approved this supplier?';
				}else{
					var mesages = 'Are you sure you want to not approved this supplier?';
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
						        'id':supplier_id,
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

		// End Supplier Section

		$('.default_check_suppliers').on('change',function(){
			var supplier_id = $(this).attr('data-supplier_id');
			var delete_row = $(this);
			if(window.location.protocol == "http:"){
			    resuesturl = "{{url('/admin/set-default-supplies')}}"
			}else if(window.location.protocol == "https:"){
			    resuesturl = "{{secure_url('/admin/set-default-supplies')}}"
			}
			if($(this).prop("checked") == true){
				swal("Are you sure you want to choose as default this supplies?", {
		          buttons: ["No", "Yes"],
		        })
		        .then(res => {
		          	if(res){
		          		$.ajax({
		          		    type: "post",
		          		    url: resuesturl,
		          		    headers: {
		          		        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		          		    },
		          		    dataType:'json',
		          		    data: {
		          		        'id':supplier_id,
		          		        'status':1
		          		    },
		          		    success: function (data) {
		          		        if(data.success){
		          		        	if(data.status == 1){
		          		        		$('.default_check_brand').prop("checked", false); 
		          		        		$('#customCheck'+supplier_id).prop("checked", true);
		          		        	} 
		          		        	toastr.success('Default Status', data.message , {displayDuration:3000,position: 'top-right'});
		          		        }else{
		          		        	toastr.error('Default Status', data.message , {displayDuration:3000,position: 'top-right'});
		          		        }
		          		    }         
		          		});
		          	}else{
		          		$(this).prop("checked", false); 
		          	}
	          	});
		    }else if($(this).prop("checked") == false){
				swal("Are you sure you want to remove as default this supplies?", {
		          buttons: ["No", "Yes"],
		        })
		        .then(res => {
		          	if(res){
		          		$.ajax({
		          		    type: "post",
		          		    url: resuesturl,
		          		    headers: {
		          		        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		          		    },
		          		    dataType:'json',
		          		    data: {
		          		        'id':supplier_id,
		          		        'status':0
		          		    },
		          		    success: function (data) {
		          		        if(data.success){
		          		        	if(data.status == 1){
		          		        		$('.default_check_brand').prop("checked", false); 
		          		        		$('#customCheck'+supplier_id).prop("checked", true);
		          		        	}
		          		        	toastr.success('Default Status', data.message , {displayDuration:3000,position: 'top-right'});
		          		        }else{
		          		        	toastr.error('Default Status', data.message , {displayDuration:3000,position: 'top-right'});
		          		        }
		          		    }         
		          		});
		          	}else{
		          		$(this).prop("checked", false); 
		          	}
	          	});
		    }
		});
		$('.default_check_device').on('change',function(){
			var device_id = $(this).attr('data-device_id');
			var delete_row = $(this);
			if(window.location.protocol == "http:"){
			    resuesturl = "{{url('/admin/set-default-device')}}"
			}else if(window.location.protocol == "https:"){
			    resuesturl = "{{secure_url('/admin/set-default-device')}}"
			}
			if($(this).prop("checked") == true){
				swal("Are you sure you want to choose as default this device?", {
		          buttons: ["No", "Yes"],
		        })
		        .then(res => {
		          	if(res){
		          		$.ajax({
		          		    type: "post",
		          		    url: resuesturl,
		          		    headers: {
		          		        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		          		    },
		          		    dataType:'json',
		          		    data: {
		          		        'id':device_id,
		          		        'status':1
		          		    },
		          		    success: function (data) {
		          		        if(data.success){
		          		        	if(data.status == 1){
		          		        		$('.default_check_brand').prop("checked", false); 
		          		        		$('#customCheck'+device_id).prop("checked", true);
		          		        	}
		          		        	toastr.success('Default Status', data.message , {displayDuration:3000,position: 'top-right'});
		          		        }else{
		          		        	toastr.error('Default Status', data.message , {displayDuration:3000,position: 'top-right'});
		          		        }
		          		    }         
		          		});
		          	}else{
		          		$(this).prop("checked", false); 
		          	}
	          	});
		    }else if($(this).prop("checked") == false){
				swal("Are you sure you want to remove as default this device?", {
		          buttons: ["No", "Yes"],
		        })
		        .then(res => {
		          	if(res){
		          		$.ajax({
		          		    type: "post",
		          		    url: resuesturl,
		          		    headers: {
		          		        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		          		    },
		          		    dataType:'json',
		          		    data: {
		          		        'id':device_id,
		          		        'status':0
		          		    },
		          		    success: function (data) {
		          		        if(data.success){
		          		        	if(data.status == 1){
		          		        		$('.default_check_brand').prop("checked", false); 
		          		        		$('#customCheck'+device_id).prop("checked", true);
		          		        	}
		          		        	toastr.success('Default Status', data.message , {displayDuration:3000,position: 'top-right'});
		          		        }else{
		          		        	toastr.error('Default Status', data.message , {displayDuration:3000,position: 'top-right'});
		          		        }
		          		    }         
		          		});
		          	}else{
		          		$(this).prop("checked", false); 
		          	}
	          	});
		    }
		});
		// AutoHide alert boxes
		setTimeout(function(){
        	$('.autoHide').fadeOut();
		}, 2000);
	});
</script>