/*
jQuery Hover3d
*/
(function($) {
	if ($.isFunction($.fn['hover3d']) && $('.hover-effect-3d').length) {

		theme.fn.execOnceTroughEvent( '.hover-effect-3d', 'mouseover.trigger.hover3d', function(){
			$(this).each(function() {
				var $this = $(this);

				$this.hover3d({
					selector: ".thumb-info"
				});
			});
		});


	}
}).apply(this, [jQuery]);

/*
* Title Border
*/
if($('[data-title-border]').length) {

	var $pageHeaderTitleBorder = $('<span class="page-header-title-border"></span>'),
		$pageHeaderTitle = $('[data-title-border]'),
		$window = $(window);

	$pageHeaderTitle.before($pageHeaderTitleBorder);

	var setPageHeaderTitleBorderWidth = function() {
		$pageHeaderTitleBorder.width($pageHeaderTitle.width());
	}

	$window.afterResize(function(){
		setPageHeaderTitleBorderWidth();
	});

	setPageHeaderTitleBorderWidth();

	$pageHeaderTitleBorder.addClass('visible');
}

/*
* Footer Reveal
*/
(function($) {
	var $footerReveal = {
		$wrapper: $('.footer-reveal'),
		init: function() {
			var self = this;

			self.build();
			self.events();
		},
		build: function() {
			var self = this, 
				footer_height = self.$wrapper.outerHeight(true),
				window_height = ( $(window).height() - $('.header-body').height() );

			if( footer_height > window_height ) {
				$('#footer').removeClass('footer-reveal');
				$('body').css('margin-bottom', 0);
			} else {
				$('#footer').addClass('footer-reveal');
				$('body').css('margin-bottom', footer_height);
			}

		},
		events: function() {
			var self = this,
				$window = $(window);

			$window.on('load', function(){
				$window.afterResize(function(){
					self.build();
				});
			});
		}
	}

	if( $('.footer-reveal').length ) {
		$footerReveal.init();
	}
})(jQuery);

/* Re-Init Plugin */
if( $('[data-reinit-plugin]').length ) {
	$('[data-reinit-plugin]').on('click', function(e) {
		e.preventDefault();

		var pluginInstance = $(this).data('reinit-plugin'),
			pluginFunction = $(this).data('reinit-plugin-function'),
			pluginElement  = $(this).data('reinit-plugin-element'),
			pluginOptions  = theme.fn.getOptions($(this).data('reinit-plugin-options'));

		$( pluginElement ).data( pluginInstance ).destroy();

		setTimeout(function(){
			theme.fn.execPluginFunction(pluginFunction, $( pluginElement ), pluginOptions);	
		}, 1000);

	});
}

/* Simple Copy To Clipboard */
if( $('[data-copy-to-clipboard]').length ) {
	theme.fn.intObs( '[data-copy-to-clipboard]', function(){
		var $this = $(this);

		$this.wrap( '<div class="copy-to-clipboard-wrapper position-relative"></div>' );

		var $copyButton = $('<a href="#" class="btn btn-primary btn-px-2 py-1 text-0 position-absolute top-8 right-8">COPY</a>');
		$this.parent().prepend( $copyButton );

		$copyButton.on('click', function(e){
			e.preventDefault();

			var $btn       = $(this),
				$temp = $('<textarea class="d-block opacity-0" style="height: 0;">');

			$btn.parent().append( $temp );

			$temp.val( $this.text() );
				
			$temp[0].select();
			$temp[0].setSelectionRange(0, 99999);

			document.execCommand("copy");

			$btn.addClass('copied');
			setTimeout(function(){
				$btn.removeClass('copied');
			}, 1000);

			$temp.remove();
		});
	}, {
		rootMargin: '0px 0px 0px 0px'
	} );
}