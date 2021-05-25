/*
Name: 			eCommerce / eCommerce Form - Examples
Written by: 	Okler Themes - (http://www.okler.net)
Theme Version: 	3.1.0
*/

(function($) {

	'use strict';

	/*
	 * Form Image - Dropzone
	 * "upload.php" is not included with the template. You should create your own server side file to upload the files. 
	 * See https://www.dropzonejs.com/#server-side-implementation for more information
	 *
	 */

	
	var initializeDropzone = function() {		
		$('#dropzone-form-image').dropzone({
			url: '/upload.php',
			maxFilesize: 2,
			maxFiles: 4,
			addRemoveLinks: true,
			acceptedFiles: ".png,.jpg,.jpeg",
			init: function() {
			
				if( $('#dropzone-form-image').hasClass('dz-filled') ) {
					var dropzoneObj = Dropzone.forElement("#dropzone-form-image"),
						mockFile = { name: "Image Name", size: 12345 };

						dropzoneObj.displayExistingFile(mockFile, 'img/products/product-1.jpg');
				}

	
			}
		}).addClass('dropzone initialized');

		

	}

	// First Load
	$(document).ready(function(){
		if( $('#dropzone-form-image').get(0) ) {
			initializeDropzone();
		}
	});

	// Sidebar Overlay Form Show
	$(window).on('ecommerce.sidebar.overlay.show', function(){
		if( $('#dropzone-form-image').get(0) ) {
			initializeDropzone();
		}
	});

	/*
	 * eCommerce Attribues - Add New
	 *
	 */
	$(document).on('click', '.ecommerce-attribute-add-new', function(e){
		e.preventDefault();

		var html = '' +
			'<div class="form-group row justify-content-center ecommerce-attribute-row">' +
				'<div class="col-xl-3">' +
					'<label class="control-label">Name</label>' +
					'<input type="text" class="form-control form-control-modern" name="attName" value="" />' +
					'<div class="checkbox mt-3 mb-3 mb-lg-0">' +
						'<label class="my-2">' +
							'<input type="checkbox" name="attVisible" value="">' +
							'Visible on the item page' +
						'</label>' +
					'</div>' +
				'</div>' +
				'<div class="col-xl-6">' +
					'<a href="#" class="ecommerce-attribute-remove text-color-danger float-right">Remove</a>' +
					'<label class="control-label">Value(s)</label>' +
					'<textarea class="form-control form-control-modern" name="attValue" rows="4" placeholder="Enter some text, or some attributes by | separating values"></textarea>' +
				'</div>' +
			'</div>' +
		'';

		$('.ecommerce-attributes-wrapper').append( html );
	});

	/*
	 * eCommerce Attribues - Remove
	 *
	 */
	$(document).on('click', '.ecommerce-attribute-remove', function(e){
		e.preventDefault();

		$(this).closest('.ecommerce-attribute-row').remove();
	});

	/*
	 * eCommerce Form - Validation and Submit the form data
	 *
	 */
	var ecommerceFormValidate = function() {
		var $form = $('.ecommerce-form');

		$form.validate({
			ignore: '',
			invalidHandler: function(form, validator) {
		        var errors = validator.numberOfInvalids();

		        if (errors) {
					$('.form-control.error').each(function(){
						var tab_id = $(this).closest('.tab-pane').attr('id');

						$('.nav-link[href="#'+ tab_id +'"]').trigger('click');
						return false;
					});            
		        }
		    },
			submitHandler: function(form) {
				
				// Fields Data
				var formData = $form.serializeArray(),
					formFieldsData = {};

				$(formData).each(function(index, obj){
					if( obj.name != 'attName' && obj.name != 'attVisible' && obj.name != 'attValue' ) {
						formFieldsData[obj.name] = obj.value;
					}
				});

				// Mount Attributes
				var attsArray = [];

				$('.ecommerce-attribute-row').each(function(){
					var $row = $(this);

					attsArray.push({
						attName: $row.find('input[name="attName"]').val(),
						attVisible: $row.find('input[name="attVisible"]').is(':checked') ? true : false,
						attValue: $row.find('textarea[name="attValue"]').val()
					});
				});

				// Add "atts" param with attributes array to formFieldsData object
				if( attsArray.length > 0 ) {
					formFieldsData.atts = attsArray;
				}

				// Form Images - Dropzone
				if( $('#dropzone-form-image').get(0) ) {
					var dropzoneObj = Dropzone.forElement("#dropzone-form-image");
					if( typeof dropzoneObj != 'undefined' && dropzoneObj.files.length > 0 ) {
						var imagesArr = [];

						for(var i = 0; i < dropzoneObj.files.length; i++) {
							imagesArr.push({
								dataURL: dropzoneObj.files[i].dataURL,
								upload: dropzoneObj.files[i].upload	
							});
						}

						formFieldsData.images = imagesArr;
					}
				}

				// Submit Button
				var $submitButton = $('.submit-button'),
					submitText    = $submitButton.html();

				$submitButton.html( '<i class="bx bx-save text-4 mr-2"></i>' + $submitButton.data('loading-text') );

				// Important: "register.php" is not included with the template. We add this just for example purpose.
				// You should create your own server side code to connect with a database and register the data. 
				$.ajax({
					url: '/dashboard/publicar-anuncio',
					type: 'post',
					data: formFieldsData,
				})
				.done(function(result) {
					new PNotify({
						title: 'Serviço Publicado',
						text: result['message'],
						type: 'success',
						shadow: true,
						addclass: 'notification-success',
						icon: 'fas fa-check'
					});							

					$('.action-buttons').remove();

					if( $form.closest('.ecommerce-form-sidebar-overlay-wrapper').get(0) ) {
						$('.ecommerce-form-sidebar-overlay-wrapper').removeClass('show');
					} else {
						setTimeout(function(){
							location.reload();
						}, 1500);
					}
				})
				.fail(function(response) {
					$submitButton.html( submitText );
		
					console.log(response);

					new PNotify({
						title: 'Ocorreu um Erro',
						text: response['responseJSON']['message'],
						type: 'error',
						shadow: true,
						addclass: 'notification-error',
						icon: 'fas fa-times'
					});
					// console.clear();
				});
			}
		});
	}

	// First Load
	ecommerceFormValidate();

	// Sidebar Overlay Form Show
	$(window).on('ecommerce.sidebar.overlay.show', function(){
		ecommerceFormValidate();
	});
	

}(jQuery));