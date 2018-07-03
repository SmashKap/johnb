/*! elementor - v2.1.0 - 03-07-2018 */
(function(){function r(e,n,t){function o(i,f){if(!n[i]){if(!e[i]){var c="function"==typeof require&&require;if(!f&&c)return c(i,!0);if(u)return u(i,!0);var a=new Error("Cannot find module '"+i+"'");throw a.code="MODULE_NOT_FOUND",a}var p=n[i]={exports:{}};e[i][0].call(p.exports,function(r){var n=e[i][1][r];return o(n||r)},p,p.exports,r,e,n,t)}return n[i].exports}for(var u="function"==typeof require&&require,i=0;i<t.length;i++)o(t[i]);return o}return r})()({1:[function(require,module,exports){
/* global jQuery, ElementorGutenbergSettings */
( function( $ ) {
	'use strict';

	var ElementorGutenbergApp = {

		cacheElements: function() {
			this.isElementorMode = '1' === ElementorGutenbergSettings.isElementorMode;

			this.cache = {};

			this.cache.$gutenberg = $( '#editor' );
			this.cache.$switchMode = $( $( '#elementor-gutenberg-button-switch-mode' ).html() );

			this.cache.$gutenberg.find( '.edit-post-header-toolbar' ).append( this.cache.$switchMode );
			this.cache.$switchModeButton = this.cache.$switchMode.find( '#elementor-switch-mode-button' );

			this.cache.$editorPanel = $( $( '#elementor-gutenberg-panel' ).html() );

			this.cache.$gurenbergBlockList = this.cache.$gutenberg.find( '.editor-block-list__layout' );
			this.cache.$gurenbergBlockList.after( this.cache.$editorPanel );

			this.cache.$editorPanelButton = this.cache.$editorPanel.find( '#elementor-go-to-edit-page-link' );

			this.toggleStatus();
		},

		bindEvents: function() {
			var self = this;

			self.cache.$switchModeButton.on( 'click', function() {
				self.isElementorMode = ! self.isElementorMode;

				self.toggleStatus();

				if ( self.isElementorMode ) {
					self.cache.$editorPanelButton.trigger( 'click' );
				} else {
					var wpEditor = wp.data.dispatch( 'core/editor' );

					wpEditor.editPost( { gutenberg_elementor_mode: false } );
					wpEditor.savePost();
				}
			} );

			self.cache.$editorPanelButton.on( 'click', function( event ) {
				event.preventDefault();

				self.animateLoader();

				var documentTitle = wp.data.select( 'core/editor' ).getEditedPostAttribute( 'title' );
				if ( ! documentTitle ) {
					wp.data.dispatch( 'core/editor' ).editPost( { title: 'Elementor #' + $( '#post_ID' ).val() } );
				}

				wp.data.dispatch( 'core/editor' ).savePost();
				self.redirectWhenSave();
			} );
		},

		redirectWhenSave: function() {
			var self = this;

			setTimeout( function() {
				if ( wp.data.select( 'core/editor' ).isSavingPost() ) {
					self.redirectWhenSave();
				} else {
					location.href = ElementorGutenbergSettings.editLink;
				}
			}, 300 );
		},

		animateLoader: function() {
			this.cache.$editorPanelButton.addClass( 'elementor-animate' );
		},

		toggleStatus: function() {
			jQuery( 'body' )
				.toggleClass( 'elementor-editor-active', this.isElementorMode )
				.toggleClass( 'elementor-editor-inactive', ! this.isElementorMode );
		},

		init: function() {
			var self = this;
			setTimeout( function() {
				self.cacheElements();
				self.bindEvents();
			}, 1 );
		}
	};

	$( function() {
		ElementorGutenbergApp.init();
	} );

}( jQuery ) );

},{}]},{},[1])
//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIm5vZGVfbW9kdWxlcy9icm93c2VyLXBhY2svX3ByZWx1ZGUuanMiLCJhc3NldHMvZGV2L2pzL2FkbWluL2d1dGVuYmVyZy5qcyJdLCJuYW1lcyI6W10sIm1hcHBpbmdzIjoiQUFBQTtBQ0FBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBIiwiZmlsZSI6ImdlbmVyYXRlZC5qcyIsInNvdXJjZVJvb3QiOiIiLCJzb3VyY2VzQ29udGVudCI6WyIoZnVuY3Rpb24oKXtmdW5jdGlvbiByKGUsbix0KXtmdW5jdGlvbiBvKGksZil7aWYoIW5baV0pe2lmKCFlW2ldKXt2YXIgYz1cImZ1bmN0aW9uXCI9PXR5cGVvZiByZXF1aXJlJiZyZXF1aXJlO2lmKCFmJiZjKXJldHVybiBjKGksITApO2lmKHUpcmV0dXJuIHUoaSwhMCk7dmFyIGE9bmV3IEVycm9yKFwiQ2Fubm90IGZpbmQgbW9kdWxlICdcIitpK1wiJ1wiKTt0aHJvdyBhLmNvZGU9XCJNT0RVTEVfTk9UX0ZPVU5EXCIsYX12YXIgcD1uW2ldPXtleHBvcnRzOnt9fTtlW2ldWzBdLmNhbGwocC5leHBvcnRzLGZ1bmN0aW9uKHIpe3ZhciBuPWVbaV1bMV1bcl07cmV0dXJuIG8obnx8cil9LHAscC5leHBvcnRzLHIsZSxuLHQpfXJldHVybiBuW2ldLmV4cG9ydHN9Zm9yKHZhciB1PVwiZnVuY3Rpb25cIj09dHlwZW9mIHJlcXVpcmUmJnJlcXVpcmUsaT0wO2k8dC5sZW5ndGg7aSsrKW8odFtpXSk7cmV0dXJuIG99cmV0dXJuIHJ9KSgpIiwiLyogZ2xvYmFsIGpRdWVyeSwgRWxlbWVudG9yR3V0ZW5iZXJnU2V0dGluZ3MgKi9cbiggZnVuY3Rpb24oICQgKSB7XG5cdCd1c2Ugc3RyaWN0JztcblxuXHR2YXIgRWxlbWVudG9yR3V0ZW5iZXJnQXBwID0ge1xuXG5cdFx0Y2FjaGVFbGVtZW50czogZnVuY3Rpb24oKSB7XG5cdFx0XHR0aGlzLmlzRWxlbWVudG9yTW9kZSA9ICcxJyA9PT0gRWxlbWVudG9yR3V0ZW5iZXJnU2V0dGluZ3MuaXNFbGVtZW50b3JNb2RlO1xuXG5cdFx0XHR0aGlzLmNhY2hlID0ge307XG5cblx0XHRcdHRoaXMuY2FjaGUuJGd1dGVuYmVyZyA9ICQoICcjZWRpdG9yJyApO1xuXHRcdFx0dGhpcy5jYWNoZS4kc3dpdGNoTW9kZSA9ICQoICQoICcjZWxlbWVudG9yLWd1dGVuYmVyZy1idXR0b24tc3dpdGNoLW1vZGUnICkuaHRtbCgpICk7XG5cblx0XHRcdHRoaXMuY2FjaGUuJGd1dGVuYmVyZy5maW5kKCAnLmVkaXQtcG9zdC1oZWFkZXItdG9vbGJhcicgKS5hcHBlbmQoIHRoaXMuY2FjaGUuJHN3aXRjaE1vZGUgKTtcblx0XHRcdHRoaXMuY2FjaGUuJHN3aXRjaE1vZGVCdXR0b24gPSB0aGlzLmNhY2hlLiRzd2l0Y2hNb2RlLmZpbmQoICcjZWxlbWVudG9yLXN3aXRjaC1tb2RlLWJ1dHRvbicgKTtcblxuXHRcdFx0dGhpcy5jYWNoZS4kZWRpdG9yUGFuZWwgPSAkKCAkKCAnI2VsZW1lbnRvci1ndXRlbmJlcmctcGFuZWwnICkuaHRtbCgpICk7XG5cblx0XHRcdHRoaXMuY2FjaGUuJGd1cmVuYmVyZ0Jsb2NrTGlzdCA9IHRoaXMuY2FjaGUuJGd1dGVuYmVyZy5maW5kKCAnLmVkaXRvci1ibG9jay1saXN0X19sYXlvdXQnICk7XG5cdFx0XHR0aGlzLmNhY2hlLiRndXJlbmJlcmdCbG9ja0xpc3QuYWZ0ZXIoIHRoaXMuY2FjaGUuJGVkaXRvclBhbmVsICk7XG5cblx0XHRcdHRoaXMuY2FjaGUuJGVkaXRvclBhbmVsQnV0dG9uID0gdGhpcy5jYWNoZS4kZWRpdG9yUGFuZWwuZmluZCggJyNlbGVtZW50b3ItZ28tdG8tZWRpdC1wYWdlLWxpbmsnICk7XG5cblx0XHRcdHRoaXMudG9nZ2xlU3RhdHVzKCk7XG5cdFx0fSxcblxuXHRcdGJpbmRFdmVudHM6IGZ1bmN0aW9uKCkge1xuXHRcdFx0dmFyIHNlbGYgPSB0aGlzO1xuXG5cdFx0XHRzZWxmLmNhY2hlLiRzd2l0Y2hNb2RlQnV0dG9uLm9uKCAnY2xpY2snLCBmdW5jdGlvbigpIHtcblx0XHRcdFx0c2VsZi5pc0VsZW1lbnRvck1vZGUgPSAhIHNlbGYuaXNFbGVtZW50b3JNb2RlO1xuXG5cdFx0XHRcdHNlbGYudG9nZ2xlU3RhdHVzKCk7XG5cblx0XHRcdFx0aWYgKCBzZWxmLmlzRWxlbWVudG9yTW9kZSApIHtcblx0XHRcdFx0XHRzZWxmLmNhY2hlLiRlZGl0b3JQYW5lbEJ1dHRvbi50cmlnZ2VyKCAnY2xpY2snICk7XG5cdFx0XHRcdH0gZWxzZSB7XG5cdFx0XHRcdFx0dmFyIHdwRWRpdG9yID0gd3AuZGF0YS5kaXNwYXRjaCggJ2NvcmUvZWRpdG9yJyApO1xuXG5cdFx0XHRcdFx0d3BFZGl0b3IuZWRpdFBvc3QoIHsgZ3V0ZW5iZXJnX2VsZW1lbnRvcl9tb2RlOiBmYWxzZSB9ICk7XG5cdFx0XHRcdFx0d3BFZGl0b3Iuc2F2ZVBvc3QoKTtcblx0XHRcdFx0fVxuXHRcdFx0fSApO1xuXG5cdFx0XHRzZWxmLmNhY2hlLiRlZGl0b3JQYW5lbEJ1dHRvbi5vbiggJ2NsaWNrJywgZnVuY3Rpb24oIGV2ZW50ICkge1xuXHRcdFx0XHRldmVudC5wcmV2ZW50RGVmYXVsdCgpO1xuXG5cdFx0XHRcdHNlbGYuYW5pbWF0ZUxvYWRlcigpO1xuXG5cdFx0XHRcdHZhciBkb2N1bWVudFRpdGxlID0gd3AuZGF0YS5zZWxlY3QoICdjb3JlL2VkaXRvcicgKS5nZXRFZGl0ZWRQb3N0QXR0cmlidXRlKCAndGl0bGUnICk7XG5cdFx0XHRcdGlmICggISBkb2N1bWVudFRpdGxlICkge1xuXHRcdFx0XHRcdHdwLmRhdGEuZGlzcGF0Y2goICdjb3JlL2VkaXRvcicgKS5lZGl0UG9zdCggeyB0aXRsZTogJ0VsZW1lbnRvciAjJyArICQoICcjcG9zdF9JRCcgKS52YWwoKSB9ICk7XG5cdFx0XHRcdH1cblxuXHRcdFx0XHR3cC5kYXRhLmRpc3BhdGNoKCAnY29yZS9lZGl0b3InICkuc2F2ZVBvc3QoKTtcblx0XHRcdFx0c2VsZi5yZWRpcmVjdFdoZW5TYXZlKCk7XG5cdFx0XHR9ICk7XG5cdFx0fSxcblxuXHRcdHJlZGlyZWN0V2hlblNhdmU6IGZ1bmN0aW9uKCkge1xuXHRcdFx0dmFyIHNlbGYgPSB0aGlzO1xuXG5cdFx0XHRzZXRUaW1lb3V0KCBmdW5jdGlvbigpIHtcblx0XHRcdFx0aWYgKCB3cC5kYXRhLnNlbGVjdCggJ2NvcmUvZWRpdG9yJyApLmlzU2F2aW5nUG9zdCgpICkge1xuXHRcdFx0XHRcdHNlbGYucmVkaXJlY3RXaGVuU2F2ZSgpO1xuXHRcdFx0XHR9IGVsc2Uge1xuXHRcdFx0XHRcdGxvY2F0aW9uLmhyZWYgPSBFbGVtZW50b3JHdXRlbmJlcmdTZXR0aW5ncy5lZGl0TGluaztcblx0XHRcdFx0fVxuXHRcdFx0fSwgMzAwICk7XG5cdFx0fSxcblxuXHRcdGFuaW1hdGVMb2FkZXI6IGZ1bmN0aW9uKCkge1xuXHRcdFx0dGhpcy5jYWNoZS4kZWRpdG9yUGFuZWxCdXR0b24uYWRkQ2xhc3MoICdlbGVtZW50b3ItYW5pbWF0ZScgKTtcblx0XHR9LFxuXG5cdFx0dG9nZ2xlU3RhdHVzOiBmdW5jdGlvbigpIHtcblx0XHRcdGpRdWVyeSggJ2JvZHknIClcblx0XHRcdFx0LnRvZ2dsZUNsYXNzKCAnZWxlbWVudG9yLWVkaXRvci1hY3RpdmUnLCB0aGlzLmlzRWxlbWVudG9yTW9kZSApXG5cdFx0XHRcdC50b2dnbGVDbGFzcyggJ2VsZW1lbnRvci1lZGl0b3ItaW5hY3RpdmUnLCAhIHRoaXMuaXNFbGVtZW50b3JNb2RlICk7XG5cdFx0fSxcblxuXHRcdGluaXQ6IGZ1bmN0aW9uKCkge1xuXHRcdFx0dmFyIHNlbGYgPSB0aGlzO1xuXHRcdFx0c2V0VGltZW91dCggZnVuY3Rpb24oKSB7XG5cdFx0XHRcdHNlbGYuY2FjaGVFbGVtZW50cygpO1xuXHRcdFx0XHRzZWxmLmJpbmRFdmVudHMoKTtcblx0XHRcdH0sIDEgKTtcblx0XHR9XG5cdH07XG5cblx0JCggZnVuY3Rpb24oKSB7XG5cdFx0RWxlbWVudG9yR3V0ZW5iZXJnQXBwLmluaXQoKTtcblx0fSApO1xuXG59KCBqUXVlcnkgKSApO1xuIl19
