
<script type="text/javascript">
	$(document).ready(function(){
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
	});
</script>