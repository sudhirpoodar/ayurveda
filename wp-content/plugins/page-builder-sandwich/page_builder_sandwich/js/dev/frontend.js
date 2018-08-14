/* globals pbsFrontendParams */

/**
 * IE 10 & IE 11 doesn't support SVG.innerHTML. This polyfill adds it.
 *
 * @see https://github.com/phaistonian/SVGInnerHTML
 */

/* jshint ignore:start */
( function( view ) {

	var constructors, dummy, innerHTMLPropDesc;

if ( ( !! window.MSInputMethodContext && !! document.documentMode ) ||
	 ( navigator.appVersion.indexOf( 'MSIE 10' ) !== -1 ) ) {

	constructors = ['SVGSVGElement', 'SVGGElement'];
	dummy = document.createElement( 'dummy' );

	if ( ! constructors[0] in view ) {
	    return false;
	}

	if ( Object.defineProperty ) {

	    innerHTMLPropDesc = {

	        get: function() {

	            dummy.innerHTML = '';

	            Array.prototype.slice.call( this.childNodes )
	            .forEach( function( node, index ) {
	                dummy.appendChild( node.cloneNode( true ) );
	            } );

	            return dummy.innerHTML;
	        },

	        set: function( content ) {
	            var self = this;
				var parent = this;
				var allNodes = Array.prototype.slice.call( self.childNodes );
				var fn = function( to, node ) {
					var newNode;

	                    if ( 1 !== node.nodeType ) {
	                        return false;
	                    }

	                    newNode = document.createElementNS( 'http://www.w3.org/2000/svg', node.nodeName );

	                    Array.prototype.slice.call( node.attributes )
	                    .forEach( function( attribute ) {
	                        newNode.setAttribute( attribute.name, attribute.value );
	                    } );

	                    if ( 'TEXT' === node.nodeName ) {
	                        newNode.textContent = node.innerHTML;
	                    }

	                    to.appendChild( newNode );

	                    if ( node.childNodes.length ) {

	                        Array.prototype.slice.call( node.childNodes )
	                        .forEach( function( node, index ) {
	                            fn( newNode, node );
	                        } );

	                    }
	                };

	            // /> to </tag>
	            content = content.replace( /<(\w+)([^<]+?)\/>/, '<$1$2></$1>' );

	            // Remove existing nodes
	            allNodes.forEach( function( node, index ) {
	                node.parentNode.removeChild( node );
	            } );

	            dummy.innerHTML = content;

	            Array.prototype.slice.call( dummy.childNodes )
	            .forEach( function( node ) {
	                fn( self, node );
	            } );

	        }, enumerable: true, configurable: true
	    };

	    try {
	        constructors.forEach( function(constructor, index ) {
	            Object.defineProperty( window[constructor].prototype, 'innerHTML', innerHTMLPropDesc );
	        } );
	    } catch ( ex ) {

	        // TODO: Do something meaningful here
	    }

	} else if ( Object.prototype.__defineGetter__ ) {

	    constructors.forEach( function(constructor, index ) {
	        window[constructor].prototype.__defineSetter__( 'innerHTML', innerHTMLPropDesc.set );
	        window[constructor].prototype.__defineGetter__( 'innerHTML', innerHTMLPropDesc.get );
	    } );

	}
}

}( window ) );
/* jshint ignore:end */

/**
 * Custom events cause errors in in IE 11. This polyfill fixes it.
 *
 * @see http://stackoverflow.com/a/31783177/174172
 */
( function() {

	function CustomEvent ( event, params ) {
		var evt;
		params = params || { bubbles: false, cancelable: false, detail: undefined };
		evt = document.createEvent( 'CustomEvent' );
		evt.initCustomEvent( event, params.bubbles, params.cancelable, params.detail );
		return evt;
	}

	// Only do this for IE11 & IE10
	if ( ( !! window.MSInputMethodContext && !! document.documentMode ) ||
		 ( navigator.appVersion.indexOf( 'MSIE 10' ) !== -1 ) ) {

		CustomEvent.prototype = window.Event.prototype;

		window.CustomEvent = CustomEvent;
	}
} )();


window.pbsIsRTL = function() {
	var html = document.querySelector( 'html' );
	return 'rtl' === html.getAttribute( 'dir' );
};

/**
 * Checks if the browser is mobile (and tablet).
 */
window.pbsIsMobile = function() {
	return navigator.userAgent.match( /(Mobi|Android)/ );
};

// From http://davidwalsh.name/element-matches-selector
window.pbsSelectorMatches = function( el, selector ) {
	var p = Element.prototype;
	var f = p.matches || p.webkitMatchesSelector || p.mozMatchesSelector || p.msMatchesSelector || function( s ) {
		return [].indexOf.call( document.querySelectorAll( s ), this ) !== -1;
	};
	if ( 1 !== el.nodeType && el.parentNode ) {
		el = el.parentNode;
	}
	if ( 1 !== el.nodeType ) {
		return false;
	}
	return f.call( el, selector );
};

window.pbsParent = function( el, selector ) {
	while ( ! window.pbsSelectorMatches( el, selector ) && 'BODY' !== el.tagName ) {
		el = el.parentNode;
	}
	return window.pbsSelectorMatches( el, selector ) ? el : null;
};

window.pbsIndex = function( el ) {
	return el ? Array.prototype.indexOf.call( el.parentNode.children, el ) : 0;
};

( function() {
	var ready = function() {

		// Check if IE11 then add class to html tag.
		var isIE11 = !! navigator.userAgent.match( /Trident.*rv[ :]*11\./ );
		if ( isIE11 ) {
			document.querySelector( 'html' ).classList.add( 'pbs-ie11' );
		}

		// Add the theme name in the HTML tag for compatibility scripts and styles.
		document.querySelector( 'html' ).classList.add( 'theme-' + pbsFrontendParams.theme_name );
	};
	if ( 'loading' !== document.readyState ) {
		ready();
	} else {
		document.addEventListener( 'DOMContentLoaded', ready );
	}
} )();

window._pbsFixRowWidth = function( element ) {

	var dataWidth = element.getAttribute( 'data-width' );

	if ( ! dataWidth ) {
		window._pbsRowReset( element );
		return;
	}

	// Nested rows cannot be full width
	if ( element.parentNode.classList.contains( 'pbs-col' ) ) {
		window._pbsRowReset( element );
	} else if ( 'undefined' === typeof dataWidth || ! dataWidth ) {
		window._pbsRowReset( element );
	} else if ( 'full-width' === dataWidth ) {
		window._pbsFullWidthRow( element );
	} else {
		window._pbsFullWidthRow( element, true );
	}

	clearTimeout( window._pbsFixRowWidthsResizeTrigger );
	window._pbsFixRowWidthsResizeTrigger = setTimeout( function() {
		window._pbsFixRowWidthsResizeNoReTrigger = true;
		window.dispatchEvent( new CustomEvent( 'resize' ) );
	}, 1 );
};

window._pbsRowReset = function( element ) {
	element.style.width = '';
	element.style.position = '';
	element.style.maxWidth = '';
	if ( ! window.pbsIsRTL() ) {
		element.style.left = '';
	} else {
		element.style.right = '';
	}
	element.style.webkitTransform = '';
	element.style.mozTransform = '';
	element.style.msTransform = '';
	element.style.transform = '';

	// Element.style.marginLeft = '';
	// element.style.marginRight = '';
	// element.style.paddingLeft = '';
	// element.style.paddingRight = '';
};

window._pbsFullWidthRow = function( element, fitToContentWidth ) {

	var origWebkitTransform = element.style.webkitTransform;
	var origMozTransform = element.style.mozTransform;
	var origMSTransform = element.style.msTransform;
	var origTransform = element.style.transform;

	var bodyWidth, rect, bodyRect, actualWidth, paddingLeft, paddingRight;

    // Reset changed parameters for contentWidth so that width recalculation on resize will work
	element.style.width = 'auto';
	element.style.position = 'relative';
	element.style.maxWidth = 'none';
	element.style.webkitTransform = '';
	element.style.mozTransform = '';
	element.style.msTransform = '';
	element.style.transform = '';
	element.style.marginLeft = '0px';
	element.style.marginRight = '0px';

	if ( 'undefined' !== typeof fitToContentWidth && fitToContentWidth ) {
		element.style.paddingLeft = '';
		element.style.paddingRight = '';
	}

	// Make sure our parent won't hide our content
	element.parentNode.style.overflowX = 'visible';

	// Reset the left parameter
	if ( ! window.pbsIsRTL() ) {
		element.style.left = '0px';
	} else {
		element.style.right = '0px';
	}

	// Assign the new full-width styles
	bodyWidth = document.body.clientWidth;
	rect = element.getBoundingClientRect();
	bodyRect = document.body.getBoundingClientRect();

	element.style.width = bodyWidth + 'px';
	element.style.position = 'relative';
	element.style.maxWidth = bodyWidth + 'px';
	if ( ! window.pbsIsRTL() ) {
		element.style.left = ( -rect.left + bodyRect.left ) + 'px';
	} else {
		element.style.right = ( rect.right - bodyRect.right ) + 'px';
	}
	element.style.webkitTransform = origWebkitTransform;
	element.style.mozTransform = origMozTransform;
	element.style.msTransform = origMSTransform;
	element.style.transform = origTransform;

	if ( 'undefined' === typeof fitToContentWidth ) {
		return;
	}
	if ( ! fitToContentWidth ) {
		return;
	}

	// Calculate the required left/right padding to ensure that the content width is being followed
	actualWidth = rect.width;

	if ( ! window.pbsIsRTL() ) {
		paddingLeft = rect.left - bodyRect.left;
		paddingRight = bodyWidth - actualWidth - rect.left + bodyRect.left;
	} else {
		paddingLeft = bodyWidth - actualWidth + rect.right - bodyRect.right;
		paddingRight = -rect.right + bodyRect.right;
	}

	// If the width is too large, don't pad
	if ( actualWidth > bodyWidth ) {
		paddingLeft = 0;
		paddingRight = 0;
	}

	element.style.paddingLeft = paddingLeft + 'px';
	element.style.paddingRight = paddingRight + 'px';
};

window.pbsFixRowWidths = function() {
	var fullRows = document.querySelectorAll( '.pbs-row' );
	Array.prototype.forEach.call( fullRows, function( el ) {
		window._pbsFixRowWidth( el );
	} );
};

window.addEventListener( 'resize', function() {
	if ( window._pbsFixRowWidthsResizeNoReTrigger ) {
		delete window._pbsFixRowWidthsResizeNoReTrigger;
		return;
	}
	window.pbsFixRowWidths();
} );
window.pbsFixRowWidths();

( function() {
	var ready = function() {
		setTimeout( function() {
			window.pbsFixRowWidths();
		}, 1 );
	};

	if ( 'loading' !== document.readyState ) {
		ready();
	} else {
		document.addEventListener( 'DOMContentLoaded', ready );
	}
} )();

/* globals hljs */

window.pbsInitAllPretext = function() {

	var codes;
	if ( 'undefined' === typeof hljs ) {
		return;
	}

	codes = document.querySelectorAll( '.pbs-main-wrapper pre' );
	Array.prototype.forEach.call( codes, function( el ) {
		hljs.highlightBlock( el );
	} );
};

( function() {
	var ready = function() {
		window.pbsInitAllPretext();
	};

	if ( 'loading' !== document.readyState ) {
		ready();
	} else {
		document.addEventListener( 'DOMContentLoaded', ready );
	}
} )();


window.pbsTabsRefreshActiveTab = function( tabsElement ) {
	var id, tabs, activeTab;
	var radio = tabsElement.querySelector( '.pbs-tab-state:checked' );
	if ( ! radio ) {
		radio = tabsElement.querySelector( '.pbs-tab-state' );
	}
	id = radio.getAttribute( 'id' );
	tabs = tabsElement.querySelector( '.pbs-tab-tabs ' );
	if ( tabs ) {
		activeTab = tabs.querySelector( '.pbs-tab-active' );
		if ( activeTab ) {
			activeTab.classList.remove( 'pbs-tab-active' );
		}
		activeTab = tabs.querySelector( '[for="' + id + '"]' );
		if ( activeTab ) {
			activeTab.classList.add( 'pbs-tab-active' );
		}
	}
};

( function() {
	var ready = function() {

		var elements;

		// Initialize.
		document.addEventListener( 'change', function( ev ) {
			if ( ev.target ) {
				if ( ev.target.classList.contains( 'pbs-tab-state' ) ) {
					window.pbsTabsRefreshActiveTab( ev.target.parentNode );
				}
			}
		} );

		// On first load, the first tab is active.
		elements = document.querySelectorAll( '[data-ce-tag="tabs"]' );
		Array.prototype.forEach.call( elements, function( el ) {
			el = el.querySelector( '[data-ce-tag="tab"]' );
			if ( el ) {
				el.classList.add( 'pbs-tab-active' );
			}
		} );
	};

	if ( 'loading' !== document.readyState ) {
		ready();
	} else {
		document.addEventListener( 'DOMContentLoaded', ready );
	}
} )();

/*! fluidvids.js v2.4.1 | (c) 2014 @toddmotto | https://github.com/toddmotto/fluidvids */

/* globals define, module */

( function( root, factory ) {
  if ( 'function' === typeof define && define.amd ) {
    define( factory );
} else if ( 'object' === typeof exports ) {
    module.exports = factory;
  } else {
    root.fluidvids = factory();
  }
} )( this, function() {

  'use strict';

  var fluidvids = {
    selector: ['iframe', 'object'],
    players: ['www.youtube.com', 'player.vimeo.com']
  };

  var css = [
    '.fluidvids {',
      'width: 100%; max-width: 100%; position: relative;',
    '}',
    '.fluidvids-item {',
      'position: absolute; top: 0px; left: 0px; width: 100%; height: 100%;',
    '}'
  ].join( '' );

  var head = document.head || document.getElementsByTagName( 'head' )[0];

  function matches ( src ) {
    return new RegExp( '^(https?:)?\/\/(?:' + fluidvids.players.join( '|' ) + ').*$', 'i' ).test( src );
  }

  function getRatio ( height, width ) {
    return ( ( parseInt( height, 10 ) / parseInt( width, 10 ) ) * 100 ) + '%';
  }

  function fluid ( elem ) {
	  var wrap;
    if ( ! matches( elem.src ) && ! matches( elem.data ) || !! elem.getAttribute( 'data-fluidvids' ) ) {
		return;
	}
	wrap = document.createElement( 'div' );
    elem.parentNode.insertBefore( wrap, elem );
    elem.className += ( elem.className ? ' ' : '' ) + 'fluidvids-item';
    elem.setAttribute( 'data-fluidvids', 'loaded' );
    wrap.className += 'fluidvids';
    wrap.style.paddingTop = getRatio( elem.height, elem.width );
    wrap.appendChild( elem );
  }

  function addStyles () {
    var div = document.createElement( 'div' );
    div.innerHTML = '<p>x</p><style>' + css + '</style>';
    head.appendChild( div.childNodes[1] );
  }

  fluidvids.render = function() {
    var nodes = document.querySelectorAll( fluidvids.selector.join() );
    var i = nodes.length;
    while ( i-- ) {
      fluid( nodes[i] );
    }
  };

  fluidvids.init = function( obj ) {
	  var key;
    for ( key in obj ) {
      fluidvids[key] = obj[key];
    }
    fluidvids.render();
    addStyles();
  };

  return fluidvids;

} );

/* globals pbsFrontendParams */
( function() {
	var ready = function() {

		var mainContainer, style, columns;

		// Columns can contain spaces, we remove those so that the
		// CSS :empty rules can apply to columns.
		columns = document.querySelectorAll( '.pbs-col' );
		Array.prototype.forEach.call( columns, function( el ) {
			if ( el.innerHTML.match( /^\s*$/gi ) ) {
				el.innerHTML = '';
			}
		} );

		// Forced overflow.
		if ( pbsFrontendParams.force_overflow ) {
			mainContainer = document.querySelector( '.pbs-main-wrapper' );
			while ( mainContainer && 'BODY' !== mainContainer.tagName ) {
				style = getComputedStyle( mainContainer );
				if ( 'hidden' === style.overflow ) {
					mainContainer.style.overflow = 'visible';
				}
				mainContainer = mainContainer.parentNode;
			}
		}
	};

	if ( 'loading' !== document.readyState ) {
		ready();
	} else {
		document.addEventListener( 'DOMContentLoaded', ready );
	}
} )();

window.pbsSwitchResponsiveStylesFrontend = function( screenSize, oldScreenSize ) {

	var styles, sizes, style, selector, i, elements;

	// Only do this if we have PBS in the page.
	if ( ! document.querySelector( '.pbs-main-wrapper' ) ) {
		return;
	}

	// Don't do anything if we're still in the same screen size.
	if ( screenSize === oldScreenSize ) {
		return;
	}

	// Don't do this while editing, because we have our own switcher there
	// that's specific for the editor.
	if ( typeof PBS !== 'undefined' && PBS.isEditing ) {
		return;
	}

	// All our styles.
	styles = {
		'margin-top': '.pbs-main-wrapper [style*="margin:"], .pbs-main-wrapper [style*="margin-top:"]',
		'margin-bottom': '.pbs-main-wrapper [style*="margin:"], .pbs-main-wrapper [style*="margin-bottom:"]'
	};

	// The different non-desktop screen sizes.
	sizes = ['tablet', 'phone'];

	for ( style in styles ) {
		if ( ! styles.hasOwnProperty( style ) ) {
			continue;
		}

		// Selector for all the different styles we need to switch out.
		selector = styles[ style ];
		for ( i = 0; i < sizes.length; i++ ) {
			selector += ', [data-pbs-' + sizes[ i ] + '-' + style + ']';
		}

		// Loop through all the affected elements and switch out the styles.
		elements = document.querySelectorAll( selector );
		Array.prototype.forEach.call( elements, function( element ) { // jshint ignore:line
			if ( element.style[ style ] ) {
				element.setAttribute( 'data-pbs-' + oldScreenSize + '-' + style, element.style[ style ] );
			}
			if ( element.getAttribute( 'data-pbs-' + screenSize + '-' + style ) ) {
				element.style[ style ] = element.getAttribute( 'data-pbs-' + screenSize + '-' + style );
			} else if ( 'phone' === screenSize && element.getAttribute( 'data-pbs-tablet-' + style ) ) {
				element.style[ style ] = element.getAttribute( 'data-pbs-tablet-' + style );
			} else if ( element.getAttribute( 'data-pbs-desktop-' + style ) ) {
				element.style[ style ] = element.getAttribute( 'data-pbs-desktop-' + style );
			} else {
				element.style[ style ] = '';
			}

		} );

		// After switching and we end up in the desktop view, remove the desktop attribute
		// because we don't need to keep it.
		if ( 'desktop' === screenSize ) {
			elements = document.querySelectorAll( '[data-pbs-' + screenSize + '-' + style + ']' );
			Array.prototype.forEach.call( elements, function( element ) { // jshint ignore:line
				element.removeAttribute( 'data-pbs-' + screenSize + '-' + style );
			} );
		}
	}
};

// Initialize style switching for the frontend.
( function() {
	var pbsGetWindowSize = function() {
		if ( window.innerWidth > 800 ) {
			return 'desktop';
		}
		if ( window.innerWidth < 400 ) {
			return 'phone';
		}
		return 'tablet';
	};

	var ready = function() {
		var view = pbsGetWindowSize();
		if ( 'desktop' !== view ) {
			window.pbsSwitchResponsiveStylesFrontend( pbsGetWindowSize(), 'desktop' );
		}
		window.addEventListener( 'resize', function() {
			var newView = pbsGetWindowSize();
			window.pbsSwitchResponsiveStylesFrontend( pbsGetWindowSize(), view );
			view = newView;
		} );
	};

	if ( 'loading' !== document.readyState ) {
		ready();
	} else {
		document.addEventListener( 'DOMContentLoaded', ready );
	}
} )();

