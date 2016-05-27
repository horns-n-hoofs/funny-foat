( function() {
	var nav = document.getElementById( 'dropdown' ), button, menu, close;
	if ( ! nav )
		return;
	button = nav.getElementsByTagName( 'p' )[0];
	menu   = nav.getElementsByTagName( 'ul' )[0];
	if ( ! button )
		return;

	if ( ! menu || ! menu.childNodes.length ) {
		button.style.display = 'none';
		return;
	}

	button.onclick = function() {
		if ( -1 == menu.className.indexOf( 'dropdown-ul' ) )
			menu.className = 'dropdown-ul';

		if ( -1 != button.className.indexOf( 'dropdown-p-on' ) ) {
			button.className = button.className.replace( ' dropdown-p-on', '' );
			menu.className = menu.className.replace( ' dropdown-p-on', '' );
		} else {
			button.className += ' dropdown-p-on';
			menu.className += ' dropdown-p-on';
		}
	};
	
	/*close = nav.getElementsByClassName( 'close' );
		
	close.onclick = function() {
        button.onclick;
    };*/
	
} )();