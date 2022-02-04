/*
 * jQuery File Upload Demo
 * https://github.com/blueimp/jQuery-File-Upload
 *
 * Copyright 2010, Sebastian Tschan
 * https://blueimp.net
 *
 * Licensed under the MIT license:
 * https://opensource.org/licenses/MIT
 */

/* global $ */

$(function () {
  'use strict';

  // Initialize the jQuery File Upload widget:
  $('#form-upload-videos-roteiro').fileupload({
    // Uncomment the following to send cross-domain cookies:
    //xhrFields: {withCredentials: true},
    url: rotaUploadVideo,
    // acceptFileTypes: /(\.|\/)(m4a|wmv|mp4|mkv)$/i
  });

  // Enable iframe cross-domain access via redirect option:
  // $('#form-upload-videos-roteiro').fileupload(
  //   'option',
  //   'redirect',
  //   window.location.href.replace(/\/[^/]*$/, '/cors/result.html?%s')
  // );

  if (window.location.hostname === 'blueimp.github.io') {
    // Demo settings:
    $('#form-upload-videos-roteiro').fileupload('option', {
      url: '//jquery-file-upload.appspot.com/',
      // Enable image resizing, except for Android and Opera,
      // which actually support image resizing, but fail to
      // send Blob objects via XHR requests:
      disableImageResize: /Android(?!.*Chrome)|Opera/.test(
        window.navigator.userAgent
      ),
      maxFileSize: 999999000,
      acceptFileTypes: /(\.|\/)(gif|jpe?g|png)$/i
    });
    // Upload server status check for browsers with CORS support:
    if ($.support.cors) {
      $.ajax({
        url: '//jquery-file-upload.appspot.com/',
        type: 'HEAD'
      }).fail(function () {
        $('<div class="alert alert-danger"></div>')
          .text('Upload server currently unavailable - ' + new Date())
          .appendTo('#form-upload-videos-roteiro');
      });
    }
  } else {

    // Load existing files:
    // $('#form-upload-videos-roteiro').addClass('fileupload-processing');
    // $.ajax({
    //   // Uncomment the following to send cross-domain cookies:
    //   //xhrFields: {withCredentials: true},
    //   url: $('#form-upload-videos-roteiro').fileupload('option', 'url'),
    //   dataType: 'json',
    //   context: $('#form-upload-videos-roteiro')[0]
    // })
    //   .always(function () {

    //     // console.log($('#form-upload-videos-roteiro')[0])
    //     $(this).removeClass('fileupload-processing');
    //   })
    //   .done(function (result) {
    //     // console.log($('#form-upload-videos-roteiro')[0])
    //     $(this)
    //       .fileupload('option', 'done')
    //       // eslint-disable-next-line new-cap
    //       .call(this, $.Event('done'), { result: result });
    //   });
  }
});
function ajax01(){
  $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
  $.ajax({
    method: 'POST',
    // Uncomment the following to send cross-domain cookies:
    //xhrFields: {withCredentials: true},
    url: $('#form-upload-videos-roteiro').fileupload('option', 'url'),
    dataType: 'json',
    context: $('#form-upload-videos-roteiro').serialize()
  })
    .always(function () {

      // console.log($('#form-upload-videos-roteiro')[0])
      $(this).removeClass('fileupload-processing');
    })
    .done(function (result) {
      // console.log($('#form-upload-videos-roteiro')[0])
      $(this)
        .fileupload('option', 'done')
        // eslint-disable-next-line new-cap
        .call(this, $.Event('done'), { result: result });
    });
}