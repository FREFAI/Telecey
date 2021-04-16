
<script type="text/javascript">
	$(document).ready(function(){
		// Home section one Image resizer script
		var image = $('#image_show').val();
		var reader = new FileReader();
		var resize = $('#upload-demo').croppie({
			url:image,
			enableExif: true,
			enableOrientation: true,    
			viewport: { // Default { width: 100, height: 100, type: 'square' } 
				width: 280,
				height: 280,
				type: 'square' //square
			},
			boundary: {
				width: 300,
				height: 300
			}
		});
		function readURLHome(input,size) {
			if(size){
				size = size;
				var maxSize = size*1024;
			}else{
				size = 10;
				var maxSize = 10240;
			}
			var file = input.files[0];//get file 
			var img = new Image();
			var sizeKB = file.size / 1024;
			if(sizeKB > maxSize){
				toastr.error('Image size', 'Image size should be less then '+size+'Mb.' , {displayDuration:100000,position: 'top-right'});
				return false;
			}
			reader.onload = function (e) {
				resize.croppie('bind',{
					url: e.target.result,
				}).then(function(){
					console.log('jQuery bind complete');
				});
			}
			reader.readAsDataURL(input.files[0]);
		}
		$('#useimg').on('click', function () {
			var imageSize = {
					width: 524,
					height: 524,
					type: 'square'
			};
			resize.croppie('result', {
				type: 'canvas',
				size: imageSize,
				format: "png", 
  				quality: 1
			}).then(function (img) {
				$('#sectiononeImage').val(img);
				$('.profile-img').attr('src', img);
				$('.profile-img').show();
				$('#sectiononeImage').val(img);
				$('.modal-close').click();
			});
        });
		$('#imageUploadSectionOne').on('change', function () {
			readURLHome(this,$(this).attr('data-size'));
			$('.addHomeImageModal').click();
		});
		// $('.sectionOnebtn').on('click',function(event){
		// 	event.preventDefault();
		// 	resize.croppie('result', {
		// 		type: 'canvas',
		// 		size: 'viewport'
		// 	}).then(function (img) {
		// 		$('#sectiononeImage').val(img);
		// 		$('#sectionformOne').submit();
		// 	});
		// });
		
		// Home section one Image resizer script
		$(".colorpicker").asColorPicker();
		$('.is_global').on('change',function(){
			if($(this).prop("checked") == true){
				$(".country_select_section").hide();
				$('.country_field').prop('required',false);
			}else{
				$(".country_select_section").show();
				$('.country_field').prop('required',true);
			}
		});
    	$('#userTable').DataTable({
			searching: false,
			paging: false,
			info: false,
			"columns": [
				{ "orderable": false },
				null,
				null,
				null,
				null,
				null,
				null,
				null,
				null,
				null,
				null,
				null,
				null,
				null,
				null,
				null,
				{ "orderable": false }
			]
		});
		// sessionStorage.removeItem('ids');
		var allEmailIds = sessionStorage.getItem('ids');
		id = sessionStorage.getItem('ids');
		allEmailIds = allEmailIds ? allEmailIds.split(',') : [];
		var totalEmails = $('.default_check_user').length;
		
		jQuery.each( allEmailIds, function( i, val ) {
			$("input[value='" + val + "']").prop('checked', true);
			
		});
		var totalEmailsChecked = $('.default_check_user:checked').length;
		if(totalEmails <= totalEmailsChecked){
			$("#customCheck0").prop('checked', true);
		}
		// console.log(allEmailIds);
		
		tinymce.init({ 
			selector:'.text_editor' ,
			height: 300,
			plugins: [
			      'advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker',
			      'searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking',
			      'save table contextmenu directionality emoticons template paste textcolor'
			    ],
			content_css: ['css/content.css','https://fonts.googleapis.com/css?family=Playfair+Display:400,400i,700,700i,900,900i&display=swap','https://fonts.googleapis.com/css?family=Montserrat&display=swap'],
			font_formats: "Arial Black=arial black,avant garde;Indie Flower=indie flower, cursive;Times New Roman=times new roman,times;Arial=arial,helvetica,sans-serif;Courier New=courier new,courier,monospace;AkrutiKndPadmini=Akpdmi-n;Playfair Display=Playfair Display;Montserrat=Montserrat",
			fontsize_formats:"8pt 10pt 12pt 14pt 16pt 18pt 20pt 22pt 24pt 26pt 28pt 30pt 32pt 34pt 36pt 38pt 40pt 42pt 44pt 46pt 48pt 50pt",
			toolbar: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link | preview fullpage | forecolor backcolor emoticons | image'
		});
		$('.select2').select2();
		$('.select2Category').select2({
			placeholder: {
				id: '-1', // the value of the option
				text: 'Select Filter'
			}
		});
		$('.select2color').select2({
			placeholder: {
				id: '-1', // the value of the option
				text: 'Color'
			}
		});
		$('.datepicker').datepicker();
		$('.datepicker-one').datepicker();
		$('.datepicker-two').datepicker();
		$(".rating_disable").rate({
		  readonly:true
		});
		// CKEDITOR.replace( 'text_editor' );
		var _URL = window.URL;
		function readURLinde(input,size) {
			
			if(size){
				size = size;
				var maxSize = size*1024;
			}else{
				size = 10;
				var maxSize = 10240;
			}
			
			var file = input.files[0];//get file   
			var img = new Image();
			var sizeKB = file.size / 1024;
			if(sizeKB > maxSize){
				toastr.error('Image size', 'Image size should be less then '+size+'Mb.' , {displayDuration:100000,position: 'top-right'});
				return false;
			}
			
		    if (input.files && input.files[0]) {
		        var reader = new FileReader();
		        reader.onload = function(e) {
		            $(input).closest('.avatar-upload').find('#imagePreview').css('background-image', 'url('+e.target.result +')');
		            $(input).closest('.avatar-upload').find('#imagePreview').hide();
		            $(input).closest('.avatar-upload').find('#imagePreview').fadeIn(650);
		        }
		        reader.readAsDataURL(input.files[0]);
		    }
		}
		$(".imageUpload").change(function() {
		    readURLinde(this,$(this).attr('data-size'));
		});
		// function readURLFour(input,size) {
			
		// 	if(size){
		// 		size = size;
		// 		var maxSize = size*1024;
		// 	}else{
		// 		size = 10;
		// 		var maxSize = 10240;
		// 	}
			
		// 	var file = input.files[0];//get file   
		// 	var img = new Image();
		// 	var sizeKB = file.size / 1024;

		// 	console.log(sizeKB);
		// 	if(sizeKB > maxSize){
		// 		toastr.error('Image size', 'Image size should be less then '+size+'Mb.' , {displayDuration:100000,position: 'top-right'});
		// 		return false;
		// 	}
		//     if (input.files && input.files[0]) {
		//         var reader = new FileReader();
		//         reader.onload = function(e) {
		//             $('#imagePreviewFour').css('background-image', 'url('+e.target.result +')');
		//             $('#imagePreviewFour').hide();
		//             $('#imagePreviewFour').fadeIn(650);
		//         }
		//         reader.readAsDataURL(input.files[0]);
		//     }
		// }
		// $("#imageUploadFoursection").change(function() {
		//     readURLFour(this,$(this).attr('data-size'));
		// });

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
				        	toastr.success('Success', 'Setting update successfully' , {displayDuration:3000,position: 'top-right'});
				        }else{
				        	toastr.error('Error', 'Somthing went wrong' , {displayDuration:3000,position: 'top-right'});
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
				        	toastr.success('Success', 'Setting update successfully' , {displayDuration:3000,position: 'top-right'});
				        }else{
				        	toastr.error('Error', 'Somthing went wrong' , {displayDuration:3000,position: 'top-right'});
				        	settingbutton.prop("checked", true);
				        }
				    }         
				});
			}
		});
		// Settings section
			$('.filtersettings').on('change',function(e){
				e.preventDefault();
				var filterbutton = $(this);
				if($(this).prop("checked") == true){
					var type = $(this).attr("data-setting_key");
					var value = 0;
					if($(this).attr("data-setting_key") == 'display_price'){
						value = $(this).val();
					}
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
							'status':value
						},
						success: function (data) {
							if(data.success){
								toastr.success('Success', 'Setting update successfully' , {displayDuration:3000,position: 'top-right'});
							}else{
								toastr.error('Error', 'Somthing went wrong' , {displayDuration:3000,position: 'top-right'});
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
								toastr.success('Success', 'Setting update successfully' , {displayDuration:3000,position: 'top-right'});
							}else{
								toastr.error('Error', 'Somthing went wrong' , {displayDuration:3000,position: 'top-right'});
								filterbutton.prop("checked", true);
							}
							
						}         
					});
				}
			});
			$('.save_btn_record').on('click',function(){
				var search_number = $('.search_number').val();
				if(window.location.protocol == "http:"){
				    resuesturl = "{{url('/admin/addSearchRecordLimit')}}"
				}else if(window.location.protocol == "https:"){
				    resuesturl = "{{secure_url('/admin/addSearchRecordLimit')}}"
				}
				$.ajax({
				    type: "post",
				    url: resuesturl,
				    headers: {
				        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				    },
				    dataType:'json',
				    data: {
				        'search_number':search_number
				    },
				    success: function (data) {
				        if(data.success){
				        	toastr.success('Success', 'Setting update successfully' , {displayDuration:3000,position: 'top-right'});
				        }else{
				        	toastr.error('Error', 'Somthing went wrong' , {displayDuration:3000,position: 'top-right'});
				        	settingbutton.prop("checked", true);
				        }
				    }         
				});
			});
			$('.blog_image_limit_btn_record').on('click',function(){
				var blog_image_limit = $('#blog_image_limit').val();
				var _this = $(this);
				_this.html('<i class="fa fa-spinner fa-spin"></i>');
				if(window.location.protocol == "http:"){
				    resuesturl = "{{url('/admin/addBlogImageLimit')}}"
				}else if(window.location.protocol == "https:"){
				    resuesturl = "{{secure_url('/admin/addBlogImageLimit')}}"
				}
				$.ajax({
				    type: "post",
				    url: resuesturl,
				    headers: {
				        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				    },
				    dataType:'json',
				    data: {
				        'blog_image_limit':blog_image_limit
				    },
				    success: function (data) {
						_this.html('<i class="ni ni-check-bold"></i>');
				        if(data.success){
				        	toastr.success('Success', 'Setting update successfully' , {displayDuration:3000,position: 'top-right'});
				        }else{
				        	toastr.error('Error', 'Somthing went wrong' , {displayDuration:3000,position: 'top-right'});
				        }
				    }         
				});
			});
			$('.homepage_images_limit_btn_record').on('click',function(){
				var homepage_images_limit = $('#homepage_images_limit').val();
				var _this = $(this);
				_this.html('<i class="fa fa-spinner fa-spin"></i>');
				if(window.location.protocol == "http:"){
				    resuesturl = "{{url('/admin/addHomeImageLimit')}}"
				}else if(window.location.protocol == "https:"){
				    resuesturl = "{{secure_url('/admin/addHomeImageLimit')}}"
				}
				$.ajax({
				    type: "post",
				    url: resuesturl,
				    headers: {
				        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				    },
				    dataType:'json',
				    data: {
				        'homepage_images_limit':homepage_images_limit
				    },
				    success: function (data) {
						_this.html('<i class="ni ni-check-bold"></i>');
				        if(data.success){
				        	toastr.success('Success', 'Setting update successfully' , {displayDuration:3000,position: 'top-right'});
				        }else{
				        	toastr.error('Error', 'Somthing went wrong' , {displayDuration:3000,position: 'top-right'});
				        }
				    }         
				});
			});
			$('.feedback_title_btn_record').on('click',function(){
				var feedback_title = $('#feedback_title').val();
				var _this = $(this);
				_this.html('<i class="fa fa-spinner fa-spin"></i>');
				if(window.location.protocol == "http:"){
				    resuesturl = "{{url('/admin/addFeedBackTitle')}}"
				}else if(window.location.protocol == "https:"){
				    resuesturl = "{{secure_url('/admin/addFeedBackTitle')}}"
				}
				$.ajax({
				    type: "post",
				    url: resuesturl,
				    headers: {
				        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				    },
				    dataType:'json',
				    data: {
				        'feedback_title':feedback_title
				    },
				    success: function (data) {
						_this.html('<i class="ni ni-check-bold"></i>');
				        if(data.success){
				        	toastr.success('Success', 'Setting update successfully' , {displayDuration:3000,position: 'top-right'});
				        }else{
				        	toastr.error('Error', 'Somthing went wrong' , {displayDuration:3000,position: 'top-right'});
				        }
				    }         
				});
			});
		// End Settings section

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
						        	toastr.success('Success', 'Setting update successfully' , {displayDuration:3000,position: 'top-right'});
						        }else{
						        	toastr.error('Error', 'Somthing went wrong' , {displayDuration:3000,position: 'top-right'});
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
						        	toastr.success('Success', 'Setting update successfully' , {displayDuration:3000,position: 'top-right'});
						        }else{
						        	toastr.error('Error', 'Somthing went wrong' , {displayDuration:3000,position: 'top-right'});
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
			        .then(function(name) {
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
							        	toastr.success('Success', data.message , {displayDuration:3000,position: 'top-right'});
							        }else{
							        	toastr.error('Error', data.message , {displayDuration:3000,position: 'top-right'});
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
	        .then(function(name) {
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
    			        	toastr.success('Success', data.message , {displayDuration:3000,position: 'top-right'});
    			        }else{
    			        	toastr.error('Error', data.message , {displayDuration:3000,position: 'top-right'});
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
	        .then(function(name) {
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
					        	toastr.success('Success', data.message , {displayDuration:3000,position: 'top-right'});
					        }else{
					        	toastr.error('Error', data.message , {displayDuration:3000,position: 'top-right'});
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
	        .then(function(name) {
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
					        		toastr.success('Success', data.message , {displayDuration:3000,position: 'top-right'});
					        	}else{
					        		current_row.closest('tr').find('.approved_ms').addClass('d-none');
					        		current_row.closest('tr').find('.not_ap_ms').removeClass('d-none');
					        		current_row.removeClass('btn-danger');
					        		current_row.addClass('btn-success');
					        		current_row.attr('data-original-title','Approve');
					        		current_row.attr('data-status',1);
					        		current_row.find('i').removeClass('ni ni-fat-remove');
					        		current_row.find('i').addClass('ni ni-check-bold');
					        		toastr.success('Success', data.message , {displayDuration:3000,position: 'top-right'});
					        	}
					        }else{
					        	toastr.error('Error', data.message , {displayDuration:3000,position: 'top-right'});
					        }
					    }         
					});
				}
			});
		});

		// Approve or Not approved Blogs

		$(document).on('click','.approved_btn_blog',function(){
			var blog_id = $(this).attr('data-blog_id');
			var status = $(this).attr('data-status');
			status = $.trim(status);
			var current_row = $(this);
			if(window.location.protocol == "http:"){
			    resuesturl = "{{url('/admin/approveBlog')}}"
			}else if(window.location.protocol == "https:"){
			    resuesturl = "{{secure_url('/admin/approveBlog')}}"
			}
			if(status == 1){
				var mesages = 'Are you sure you want to approved this blog?';
			}else{
				var mesages = 'Are you sure you want to not approved this blog?';
			}
			swal(mesages, {
	          buttons: ["No", "Yes"],
	        })
	        .then(function(name) {
	          	if(name){
					$.ajax({
					    type: "post",
					    url: resuesturl,
					    headers: {
					        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					    },
					    dataType:'json',
					    data: {
					        'id':blog_id,
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
					        		toastr.success('Success', data.message , {displayDuration:3000,position: 'top-right'});
					        	}else{
					        		current_row.closest('tr').find('.approved_ms').addClass('d-none');
					        		current_row.closest('tr').find('.not_ap_ms').removeClass('d-none');
					        		current_row.removeClass('btn-danger');
					        		current_row.addClass('btn-success');
					        		current_row.attr('data-original-title','Approve');
					        		current_row.attr('data-status',1);
					        		current_row.find('i').removeClass('ni ni-fat-remove');
					        		current_row.find('i').addClass('ni ni-check-bold');
					        		toastr.success('Success', data.message , {displayDuration:3000,position: 'top-right'});
					        	}
					        }else{
					        	toastr.error('Error', data.message , {displayDuration:3000,position: 'top-right'});
					        }
					    }         
					});
				}
			});
		});
		// Active or In Active Ads

		$(document).on('click','.active_btn_ads',function(){
			var ads_id = $(this).attr('data-ads_id');
			var is_active = $(this).attr('data-is_active');
			is_active = $.trim(is_active);
			var current_row = $(this);
			if(window.location.protocol == "http:"){
			    resuesturl = "{{url('/admin/approveAds')}}"
			}else if(window.location.protocol == "https:"){
			    resuesturl = "{{secure_url('/admin/approveAds')}}"
			}
			if(is_active == 1){
				var mesages = 'Are you sure you want to active this ads?';
			}else{
				var mesages = 'Are you sure you want to in-active this ads?';
			}
			swal(mesages, {
	          buttons: ["No", "Yes"],
	        })
	        .then(function(name) {
	          	if(name){
					$.ajax({
					    type: "post",
					    url: resuesturl,
					    headers: {
					        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					    },
					    dataType:'json',
					    data: {
					        'id':ads_id,
					        'is_active':is_active
					    },
					    success: function (data) {
					        if(data.success){
					        	if(is_active == 1){
					        		current_row.closest('tr').find('.not_ap_ms').addClass('d-none');
					        		current_row.closest('tr').find('.approved_ms').removeClass('d-none');
					        		current_row.removeClass('btn-success');
					        		current_row.attr('data-original-title','Not approve');
					        		current_row.attr('data-is_active',0);
					        		current_row.addClass('btn-danger');
					        		current_row.find('i').removeClass('ni ni-check-bold');
					        		current_row.find('i').addClass('ni ni-fat-remove');
					        		toastr.success('Success', data.message , {displayDuration:3000,position: 'top-right'});
					        	}else{
					        		current_row.closest('tr').find('.approved_ms').addClass('d-none');
					        		current_row.closest('tr').find('.not_ap_ms').removeClass('d-none');
					        		current_row.removeClass('btn-danger');
					        		current_row.addClass('btn-success');
					        		current_row.attr('data-original-title','Approve');
					        		current_row.attr('data-is_active',1);
					        		current_row.find('i').removeClass('ni ni-fat-remove');
					        		current_row.find('i').addClass('ni ni-check-bold');
					        		toastr.success('Success', data.message , {displayDuration:3000,position: 'top-right'});
					        	}
					        }else{
					        	toastr.error('Error', data.message , {displayDuration:3000,position: 'top-right'});
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
	        .then(function(name) {
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
					        	toastr.success('Success', data.message , {displayDuration:3000,position: 'top-right'});
					        }else{
					        	toastr.error('Error', data.message , {displayDuration:3000,position: 'top-right'});
					        }
					    }         
					});
				}
			});
		});

		$('.delete_category').on('click',function(e){
			var delete_row = $(this);
			var id = $(this).attr("data-category_id");

			if(window.location.protocol == "http:"){
				resuesturl = "{{url('/admin/deleteCategories')}}"
			}else if(window.location.protocol == "https:"){
				resuesturl = "{{secure_url('/admin/deleteCategories')}}"
			}
			swal("Are you sure you want to delete this Category?", {
				buttons: ["No", "Yes"],
			})
			.then(function(name) {
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
								toastr.success('Success', data.message , {displayDuration:3000,position: 'top-right'});
							}else{
								toastr.error('Error', data.message , {displayDuration:3000,position: 'top-right'});
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
	        .then(function(name) {
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
					        	toastr.success('Success', data.message , {displayDuration:3000,position: 'top-right'});
					        }else{
					        	toastr.error('Error', data.message , {displayDuration:3000,position: 'top-right'});
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
	        .then(function(name) {
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
					        	delete_row.closest('td').prev(".deleted_at").text(data.deleted_at);
					        	toastr.success('Success', data.message , {displayDuration:3000,position: 'top-right'});
								delete_row.remove();
					        }else{
					        	toastr.error('Error', data.message , {displayDuration:3000,position: 'top-right'});
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
		        .then(function(name) {
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
						        	toastr.success('Success', data.message , {displayDuration:3000,position: 'top-right'});
						        }else{
						        	toastr.error('Error', data.message , {displayDuration:3000,position: 'top-right'});
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
		        .then(function(name) {
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
						        	toastr.success('Success', data.message , {displayDuration:3000,position: 'top-right'});
						        }else{
						        	toastr.error('Error', data.message , {displayDuration:3000,position: 'top-right'});
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
			          		        	toastr.success('Success', data.message , {displayDuration:3000,position: 'top-right'});
			          		        }else{
			          		        	toastr.error('Error', data.message , {displayDuration:3000,position: 'top-right'});
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
    		          		        	toastr.success('Success', data.message , {displayDuration:3000,position: 'top-right'});
    		          		        }else{
    		          		        	toastr.error('Error', data.message , {displayDuration:3000,position: 'top-right'});
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
		        .then(function(name) {
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
						        		toastr.success('Success', data.message , {displayDuration:3000,position: 'top-right'});
						        	}else{
						        		current_row.closest('tr').find('.approved_ms').addClass('d-none');
						        		current_row.closest('tr').find('.not_ap_ms').removeClass('d-none');
						        		current_row.removeClass('btn-danger');
						        		current_row.addClass('btn-success');
						        		current_row.attr('data-original-title','Approve');
						        		current_row.attr('data-status',1);
						        		current_row.find('i').removeClass('ni ni-fat-remove');
						        		current_row.find('i').addClass('ni ni-check-bold');
						        		toastr.success('Success', data.message , {displayDuration:3000,position: 'top-right'});
						        	}
						        }else{
						        	toastr.error('Error', data.message , {displayDuration:3000,position: 'top-right'});
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
		        .then(function(name) {
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
						        	toastr.success('Success', data.message , {displayDuration:3000,position: 'top-right'});
						        }else{
						        	toastr.error('Error', data.message , {displayDuration:3000,position: 'top-right'});
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
		        .then(function(name) {
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
						        		toastr.success('Success', data.message , {displayDuration:3000,position: 'top-right'});
						        	}else{
						        		current_row.closest('tr').find('.approved_ms').addClass('d-none');
						        		current_row.closest('tr').find('.not_ap_ms').removeClass('d-none');
						        		current_row.removeClass('btn-danger');
						        		current_row.addClass('btn-success');
						        		current_row.attr('data-original-title','Approve');
						        		current_row.attr('data-status',1);
						        		current_row.find('i').removeClass('ni ni-fat-remove');
						        		current_row.find('i').addClass('ni ni-check-bold');
						        		toastr.success('Success', data.message , {displayDuration:3000,position: 'top-right'});
						        	}
						        }else{
						        	toastr.error('Error', data.message , {displayDuration:3000,position: 'top-right'});
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
		        .then(function(name) {
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
						        	toastr.success('Success', data.message , {displayDuration:3000,position: 'top-right'});
						        }else{
						        	toastr.error('Error', data.message , {displayDuration:3000,position: 'top-right'});
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
			        .then(function(name) {
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
			        .then(function(name) {
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
							        		toastr.success('Success', data.message , {displayDuration:3000,position: 'top-right'});
							        	}else{
							        		current_row.closest('tr').find('.approved_ms').addClass('d-none');
							        		current_row.closest('tr').find('.not_ap_ms').removeClass('d-none');
							        		current_row.removeClass('btn-danger');
							        		current_row.addClass('btn-success');
							        		current_row.attr('data-original-title','Approve');
							        		current_row.attr('data-status',1);
							        		current_row.find('i').removeClass('ni ni-fat-remove');
							        		current_row.find('i').addClass('ni ni-check-bold');
							        		toastr.success('Success', data.message , {displayDuration:3000,position: 'top-right'});
							        	}
							        }else{
							        	toastr.error('Error', data.message , {displayDuration:3000,position: 'top-right'});
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
		        .then(function(name) {
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
						        		toastr.success('Success', data.message , {displayDuration:3000,position: 'top-right'});
						        }else{
						        	toastr.error('Error', data.message , {displayDuration:3000,position: 'top-right'});
						        }
						    }         
						});
					}
				});
			});
			$(document).on('click','.close_case_btn_inner',function(){
				var case_id = $(this).attr('data-case_id');
				var status = $(this).attr('data-status');
				var backurl = $(this).attr('data-backurl');
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
		        .then(function(name) {
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
						        		toastr.success('Success', data.message , {displayDuration:3000,position: 'top-right'});
										window.location.href = backurl;
						        }else{
						        	toastr.error('Error', data.message , {displayDuration:3000,position: 'top-right'});
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
		        .then(function(name) {
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
						        	toastr.success('Success', data.message , {displayDuration:3000,position: 'top-right'});
						        }else{
						        	toastr.error('Error', data.message , {displayDuration:3000,position: 'top-right'});
						        }
						    }         
						});
					}
				});
			});
			// Color Delete

			$('.delete_color').on('click',function(){
				var supplier_id = $(this).attr('data-color_id');
				var delete_row = $(this);
				if(window.location.protocol == "http:"){
				    resuesturl = "{{url('/admin/delete-color')}}"
				}else if(window.location.protocol == "https:"){
				    resuesturl = "{{secure_url('/admin/delete-color')}}"
				}
				swal("Are you sure you want to delete this color?", {
		          buttons: ["No", "Yes"],
		        })
		        .then(function(name) {
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
						        	toastr.success('Success', data.message , {displayDuration:3000,position: 'top-right'});
						        }else{
						        	toastr.error('Error', data.message , {displayDuration:3000,position: 'top-right'});
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
		        .then(function(name) {
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
						        		toastr.success('Success', data.message , {displayDuration:3000,position: 'top-right'});
						        	}else{
						        		current_row.closest('tr').find('.approved_ms').addClass('d-none');
						        		current_row.closest('tr').find('.not_ap_ms').removeClass('d-none');
						        		current_row.removeClass('btn-danger');
						        		current_row.addClass('btn-success');
						        		current_row.attr('data-original-title','Approve');
						        		current_row.attr('data-status',1);
						        		current_row.find('i').removeClass('ni ni-fat-remove');
						        		current_row.find('i').addClass('ni ni-check-bold');
						        		toastr.success('Success', data.message , {displayDuration:3000,position: 'top-right'});
						        	}
						        }else{
						        	toastr.error('Error', data.message , {displayDuration:3000,position: 'top-right'});
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
		          		        	toastr.success('Success', data.message , {displayDuration:3000,position: 'top-right'});
		          		        }else{
		          		        	toastr.error('Error', data.message , {displayDuration:3000,position: 'top-right'});
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
		          		        	toastr.success('Success', data.message , {displayDuration:3000,position: 'top-right'});
		          		        }else{
		          		        	toastr.error('Error', data.message , {displayDuration:3000,position: 'top-right'});
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
		          		        	toastr.success('Success', data.message , {displayDuration:3000,position: 'top-right'});
		          		        }else{
		          		        	toastr.error('Error', data.message , {displayDuration:3000,position: 'top-right'});
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
		          		        	toastr.success('Success', data.message , {displayDuration:3000,position: 'top-right'});
		          		        }else{
		          		        	toastr.error('Error', data.message , {displayDuration:3000,position: 'top-right'});
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

		var id = [];
		$(".default_check_user").change(function() {
			id = sessionStorage.getItem('ids') ? sessionStorage.getItem('ids').split(',') : [];
			var removeItem = $(this).val();
			
			if(this.checked) {
				id.push($(this).val());
				sessionStorage.setItem('ids',id);
			}else{
				// // id = id.split(',')
				// console.log($.inArray(removeItem, id));
				id.splice($.inArray(removeItem, id), 1);
				sessionStorage.setItem('ids',id);
			}
		});
		$('#customCheck0').change(function(){
			id = [];
			if(this.checked) {
				if(window.location.protocol == "http:"){
					resuesturl = "{{url('/admin/getAllEmailsOfUsers')}}"
				}else if(window.location.protocol == "https:"){
					resuesturl = "{{secure_url('/admin/getAllEmailsOfUsers')}}"
				}

				$.ajax({
					url: resuesturl,
					data: {
						'status':1
					},
					headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					},
					dataType:'json',
					type: 'POST',
					success: function(data){
						if(data.success){
							id = data.ids;
							sessionStorage.setItem('ids',id);
							$(".default_check_user").prop('checked',true);
						}
					}
				});
				// $('.default_check_user').each(function(){
				// 	id.push($(this).val());
				// });
				
			}else{
				$(".default_check_user").prop('checked',false);
				$('.default_check_user').each(function(){
					id.splice($.inArray($(this).val(), id), 1);
				});
				sessionStorage.setItem('ids',id);
			}
		});
		$('.sendEmailToUser').on('click',function(){
			id = sessionStorage.getItem('ids') ? sessionStorage.getItem('ids') : [];
			// console.log('HElo',id);
			
			if(id.length == 0){
				swal({
					title: "Please select user.",
					icon: "warning",
					button: "ok",
				});
				return false;
			}else{
				$('.sendEmailModal').show();
				$('.sendEmailModalOverLay').show();
			}
		});
		$('.sendEmailClose').on('click',function(){
			$('.sendEmailModal').hide();
			$('.sendEmailModalOverLay').hide();
		});
		// Send Email To User Section
		$('#send_email_to_user_form').on('submit',function(e){
			e.preventDefault();
			if(window.location.protocol == "http:"){
			    resuesturl = "{{url('/admin/sendEmailToUsers')}}"
			}else if(window.location.protocol == "https:"){
			    resuesturl = "{{secure_url('/admin/sendEmailToUsers')}}"
			}
			var fd = new FormData(); 
			fd.append( 'ids', sessionStorage.getItem('ids') );
			fd.append( 'subject', $('#subject').val() );
			fd.append( 'text_editor', $('#text_editor').val() );
			fd.append( 'attached_file', $('#attached_file')[0].files[0] );   

			$.ajax({
				url: resuesturl,
				data: fd,
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
				processData: false,
				contentType: false,
				dataType:'json',
				type: 'POST',
				success: function(data){
					$('#send_email_to_user_form')[0].reset();
					$('.sendEmailModal').hide();
					$('.sendEmailModalOverLay').hide();
					sessionStorage.removeItem('ids')
					$(".default_check_user").prop('checked',false);
					if(data.success){
						toastr.success('Email Send to user.', data.message , {displayDuration:3000,position: 'top-right'});
					}else{
						toastr.error('Email Send to user.', __('index.Somthing went wrong') , {displayDuration:3000,position: 'top-right'});
					}
				}
			});

		});
		// End Send Email To User Section
	});
</script>