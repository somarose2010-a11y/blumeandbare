/**
 * Header search panel for Blume & Bare.
 */
( function() {
	const toggle = document.querySelector( '.header-search-toggle' );
	const panel = document.querySelector( '.header-search-panel' );

	if ( ! toggle || ! panel ) {
		return;
	}

	const input = panel.querySelector( 'input[type="search"]' );

	function setOpen( open ) {
		panel.classList.toggle( 'is-open', open );
		toggle.setAttribute( 'aria-expanded', open ? 'true' : 'false' );
		if ( open && input ) {
			input.focus();
		}
	}

	toggle.addEventListener( 'click', function( event ) {
		event.preventDefault();
		setOpen( ! panel.classList.contains( 'is-open' ) );
	} );

	document.addEventListener( 'click', function( event ) {
		if ( ! panel.classList.contains( 'is-open' ) ) {
			return;
		}
		if ( panel.contains( event.target ) || toggle.contains( event.target ) ) {
			return;
		}
		setOpen( false );
	} );

	document.addEventListener( 'keydown', function( event ) {
		if ( 'Escape' === event.key ) {
			setOpen( false );
		}
	} );
}() );
