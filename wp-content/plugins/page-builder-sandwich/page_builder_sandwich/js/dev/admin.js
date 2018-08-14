/* globals pbsParams, tinymce */

jQuery( document ).ready( function( $ ) {
	'use strict';

	var originalContent = '';
	var hasAutosave = false;
	var isDirty;

	if ( 'undefined' === typeof pbsParams ) {
		return;
	}
	if ( 'undefined' === typeof pbsParams.is_editing ) {
		return;
	}

	if ( 'undefined' !== typeof wp && 'undefined' !== typeof wp.autosave && 'undefined' !== typeof wp.autosave.getCompareString ) {
		originalContent = wp.autosave.getCompareString();
		hasAutosave = true;
	}

	isDirty = function() {
		if ( ! hasAutosave ) {
			return true;
		}
		if ( tinymce && tinymce.activeEditor ) {
			if ( tinymce.activeEditor.isDirty() ) {
				return true;
			} else if ( originalContent !== wp.autosave.getCompareString() ) {
				return true;
			} else if ( ! tinymce.activeEditor.isHidden() ) {
				return tinymce.activeEditor.isDirty();
			}
		}
		return originalContent !== wp.autosave.getCompareString();
	};

	$( 'body' ).on( 'click', '#pbs-admin-edit-with-pbs', function( ev ) {

		var title;

		ev.preventDefault();

		// Fill up title if it's blank.
		title = $( '#title' );
		if ( 'undefined' !== typeof title && '' === title.val() ) {
			title.val( 'Post #' + pbsParams.post_id );
		}

		// Prompt PBS to open when the page loads.
		if ( localStorage ) {
			localStorage.setItem( 'pbs-open-' + pbsParams.post_id, '1' );
		}

		$( window ).off( 'beforeunload' );

		// Redirect after saving.
		$( 'form#post' ).append( '<input type="hidden" name="pbs-save-redirect" value="' + pbsParams.meta_permalink + '" />' );
		$( 'form#post' ).submit();

		return false;
	} );

} );

/* globals pbsParams */

jQuery( document ).ready( function( $ ) {
	'use strict';

	if ( 'undefined' === typeof pbsParams ) {
		return;
	}
	if ( 'undefined' === typeof pbsParams.nonce ) {
		return;
	}

	$( 'body' ).on( 'click', '.pbs-rate-notice a.pbs-rate-hide', function() {
		$.post( pbsParams.ajax_url,
			{
				'action': 'pbs_hide_rating',
				'nonce': pbsParams.nonce
			}
		);

		// Trigger the dismissal of the notice.
		$( this ).parents( '.pbs-rate-notice' ).fadeOut();
	} );

} );

