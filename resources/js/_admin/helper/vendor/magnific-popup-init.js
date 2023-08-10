
//FILE

$('.image-container').magnificPopup({
    gallery: {enabled: true},
    delegate: '.image-item', // child items selector, by clicking on it popup will open
    type: 'image',
    mainClass: 'mfp-img-mobile',
});

/*$('.content-wrapper>.content').magnificPopup({
    delegate: '.image-item',
    type: 'image',
});*/

$('.content-wrapper>.content').magnificPopup({
    delegate: '.popup-link',
    type: 'ajax'
});

$('.main-header').magnificPopup({
    delegate: '.popup-link',
    type: 'ajax'
});

/*$('.popup-link').magnificPopup({
    type: 'ajax'
});*/

$(document).magnificPopup({
    delegate: '.popup-link-not-close',
    type: 'ajax',
    closeBtnInside: true,
    closeOnBgClick: false,
    enableEscapeKey: false,
    focus: 'input.form-control',
});

/*$('.popup-link-not-close').magnificPopup({
    type: 'ajax',
    closeBtnInside: true,
    closeOnBgClick: false,
    enableEscapeKey: false,
    focus: 'input.form-control',
});*/
