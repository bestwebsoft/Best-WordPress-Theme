( function ( $ ) {
	// Inside of this function, $() will work as an alias for jQuery()
	// and other libraries also using $ will not be accessible under this shortcut
	$( 'document' ).ready( function() {
		$( 'input:checked' ).removeAttr( 'checked' );
		$( 'input:file' ).val( '' );
		// $( this ).find( '.best-contents, .best-sidebar' ).wrapAll( "<div id='main'></div>" );
		//radiobuttons restyle
		$( "input[type='radio']" ).wrap( '<div class="best-radio"></div>' );
		//hover realization
		$( '.best-radio' ).mouseenter( function() {
			$( this ).addClass( 'best-hover' );
		});
		$( '.best-radio' ).mouseleave( function() {
			$( this ).removeClass( 'best-hover' );
		});
		//active realization
		$( '.best-radio' ).click( function() {
			var best_current_name = $( this ).find( 'input' ).attr( 'name' );
			if ( $( this ).find( 'input' ).is( ':checked' ) ) {
			} else {
				$( this ).closest( 'form' ).find( "input[type='radio']" ).each( function() {
					if ( $( this ).attr( 'name' )  == best_current_name ) {
						$( this ).removeAttr( 'checked' );
						$( this ).parent().removeClass( 'best-active' );
					}
				});
				$( this ).addClass( 'best-active' );
				$( this ).find( 'input' ).attr( 'checked', true );
			}
		});
		//select section restyle
		var best_test = $( 'select' ).size();
		for ( var best_k = 0; best_k < best_test; best_k++ ) {
			$( 'select' ).eq( best_k ).css( 'display', 'none' );
			$( 'select' ).eq( best_k ).after( CreateSelect( best_k ) );
		}
		//functional of new select
		$( '.best-select' ).click( function() {
			if ( $( this ).find( '.best-options' ).css( 'display' ) == 'none' ) {
				$( this ).css( 'z-index', '5' );
				$( this ).find( '.best-options' ).css( 'display', 'block' );
			} else {
				$( this ).css( 'z-index', '1' );
				$( this ).find( '.best-options' ).css( 'display', 'none' );
			}
		});
		$( '.best-select' ).find( '.best-option' ).click( function() {
			$( this ).closest( '.best-select' ).find( '.best-option' ).removeClass( 'best-option-selected' );
			$( this ).addClass( 'best-option-selected' );
			//write text to active opt
			$( this ).parent().parent().find( '.best-active-opt' ).find( 'div:first' ).text( $( this ).text() );
			//remove active option from init select
			$( this ).parent().parent().prev( 'select' ).find( 'option' ).removeAttr( 'selected' );
			//add atrr selected to select
			$( this ).parent().parent().prev( 'select' ).find( 'option' ).eq( ( $( this ).attr( 'name' ) ) ).attr( 'selected', 'selected' );
		});
		//checkboxes restyle
		$( "input[type='checkbox']" ).wrap( '<div class="best-check"></div>' );
		//hover realization
		$( '.best-check' ).mouseenter( function() {
			$( this ).addClass( 'best-hover' );
		});
		$( '.best-check' ).mouseleave( function() {
			$( this ).removeClass( 'best-hover' );
		});		
		//active Realization
		$( '.best-check' ).click( function() {
			if ( $( this ).find( 'input' ).is( ':checked' ) ) {
				$( this ).removeClass( 'best-active' );
				$( this ).find( 'input' ).attr( 'checked', false );
			}
			else {
				$( this ).addClass( 'best-active' );
				$( this ).find( 'input' ).attr( 'checked', true );
			}
		});
		//reset button restyle
		$( 'input:reset' ).click( function() {
			//reset checkboxes and radio
			$( this ).closest( 'form' ).find( 'input' ).each( function() {
				$( this ).removeAttr( 'checked' );
			});
			$( this ).closest( 'form' ).find( '.best-option' ).removeClass( 'best-option-selected' );
			$( this ).closest( 'form' ).find( '.best-radio' ).removeClass( 'best-active' );
			$( this ).closest( 'form' ).find( '.best-check' ).removeClass( 'best-active' );
			//reset input:file
			$( this ).closest( 'form' ).find( '.best-custom-file-text' ).text( script_loc.choose_file );
			$( this ).closest( 'form' ).find( '.best-custom-file-status' ).text( script_loc.file_is_not_selected );
		});
		//input:file restyle
		$( createInputAttr() );
		//functional of new input:file
		$( '.best-custom-file' ).click( function() {
			var best_file_input = document.getElementById( $( this ).find( '.best-custom-file-status' ).attr( 'name' ) )
			$( best_file_input ).click();
		});
		$( 'input:file' ).change( function() {
			var best_val=$( this ).attr( 'id' );
			$( "[name='" + best_val + "']" ).text( $( this ).best_val().split( '\\' ).pop() )
		});
		//Handles toggling the main navigation menu for small screens.	
		var best_head = $( '.best-head' ),
			timeout = false;
		$.fn.smallMenu = function() {
			best_head.find( '.best-nav' ).removeClass( 'best-main-navigation' ).addClass( 'best-main-small-navigation' );
			best_head.find( '.best-nav h1' ).removeClass( 'best-assistive-text' ).addClass( 'best-menu-toggle' );
			$( '.best-menu-toggle' ).unbind( 'click' ).click( function() {
				best_head.find( '.menu' ).toggle();
				$( this ).toggleClass( 'toggled-on' );
			} );
		};
		// Check viewport width on first load.
		if ( $( window ).width() <= 810 )
			$.fn.smallMenu();
		// Check viewport width when user resizes the browser window.
		$( window ).resize( function() {
			var best_browserWidth = $( window ).width();
			if ( false !== timeout )
				clearTimeout( timeout );
			timeout = setTimeout( function() {
				if ( best_browserWidth <= 810 ) {
					$.fn.smallMenu();
				} else {
					best_head.find( '.best-nav' ).removeClass( 'best-main-small-navigation' ).addClass( 'best-main-navigation' );
					best_head.find( '.best-nav h1' ).removeClass( 'best-menu-toggle' ).addClass( 'best-assistive-text' );
					best_head.find( '.menu' ).removeAttr( 'style' );
				}
			}, 200 );
		} );
		//archive-dropdown widget functional
		$( "select[name='archive-dropdown']" ).next( '.best-select' ).find( '.best-option' ).click( function() {
			if ( $( this ).attr( 'value' ) ) {
				location.href = $( this ).attr( 'value' );
			}
		});
		//category-dropdown widget functional
		$( "select[name='cat']" ).next( '.best-select' ).find( '.best-option' ).click( function() {
			if ( $( this ).attr( 'value' ) > 0 ) {
				location.href = script_loc['best_home_url'] + '?cat=' + $( this ).attr( 'value' );
			}
		});
		//Check of previous selected items
		$( 'select' ).each( function() {
			var best_index = $( this ).find( 'option[selected]' ).index();
			if ( best_index >= 0 ) {
				//add attr selected to select
				var best_selected_select = $( this ).find( 'option[selected]' ).parent().next().find( ".best-options .best-option[name='" + best_index + "']" );
				best_selected_select.addClass( 'best-option-selected' );
				//write text to active opt
				best_selected_select.parent().prev( '.best-active-opt' ).find( 'div:first' ).text( best_selected_select.text() );
			}
		});
		// Clear select elements
		$( 'input:reset' ).click( function() {
			//Clear original selects.
			$( 'select' ).each( function() {
				//set path
				var best_clear_select = $( this ).find( 'option:first' );
				var best_clear_selected_select = $( this ).find( 'option[selected]' );
				//clear active opt
				$( best_clear_selected_select ).removeAttr( 'selected' );
				$( best_clear_select ).attr( 'selected', 'selected' );
			});
			//Clear custom selects.
			$( '.best-select' ).each( function() {
				//set path
				var best_clear_select = $( this ).find( ".best-option[name='0']" );
				var best_clear_selected_select = $( this ).find( '.best-options' ).find( '.best-option-selected' );
				//clear active opt
				best_clear_select.parent().prev( '.best-active-opt' ).find( 'div:first' ).text( best_clear_select.text() );
				best_clear_selected_select.removeClass( 'best-option-selected' );
			});
		});
	});
})( jQuery );
//function for input:file
function CreateFileInput( best_k ) {
	var best_custom_file = document.createElement( 'div' );
	( function ( $ ) {
		$( best_custom_file ).addClass( 'best-custom-file' );
		$( best_custom_file ).append( '<div class="best-custom-file-content"></div>' );
		$( best_custom_file ).find( '.best-custom-file-content' ).append( '<div class="best-custom-file-text"></div>' );
		$( best_custom_file ).find( '.best-custom-file-content' ).append( '<div class="best-custom-file-button"></div>' );
		$( best_custom_file ).append( '<div class="best-custom-file-status"></div>' );
		$( best_custom_file ).find( '.best-custom-file-status' ).attr( 'name', $( 'input:file' ).eq( best_k ).attr( 'id' ))
		$( best_custom_file ).find( '.best-custom-file-text' ).text( script_loc.choose_file );
		$( best_custom_file ).find( '.best-custom-file-status' ).text( script_loc.file_is_not_selected );
		$( best_custom_file ).append( '<div class="best-clear"></div>' );
	} )( jQuery );
	return best_custom_file;
}
//function for hide init input:file and add after a new input:file
function createInputAttr() {
	( function ( $ ) {
		var best_size = $( 'input:file' ).size();
		for ( var best_i = 0; best_i < best_size; best_i++ ) {
			$( 'input:file' ).eq( best_i ).attr( 'id', 'file-' + best_i ).css( 'display', 'none' ).after( CreateFileInput( best_i ) );
		};
	} )( jQuery );
}
//function for custom select
function CreateSelect( best_k ) {
	//create select division
	var best_sel = document.createElement( 'div' );
	( function ( $ ) {
		$( best_sel ).addClass( 'best-select' );
		//create active-option division
		var best_active_opt = document.createElement( 'div' );
		$( best_active_opt ).addClass( 'best-active-opt' );
		$( best_active_opt ).append( '<div class="best-custom-select-text"></div>' );
		$( best_active_opt ).append( '<div class="best-select-button"></div>' );
		$( best_active_opt ).find( 'div:first' ).text( $( 'select' ).eq( best_k ).find( 'option' ).first().text() );
		//create options division
		var best_option_array = document.createElement( 'div' );
		$( best_option_array ).addClass( 'best-options' );
		//create array of optgroups
		var best_count = $( 'select' ).eq( best_k ).find( 'optgroup' ).size();
		var best_optgroups = [];
		//create options division
		if ( best_count ) {
			var best_z = 0;
			for ( var best_i = 0; best_i < best_count; best_i++ ) {
				best_optgroups[best_i] = document.createElement( 'div' );
				$( best_optgroups[best_i] ).addClass( 'best-optgroup' );
				$( best_optgroups[best_i] )
					.text( $( 'select' ).eq( best_k ).find( 'optgroup' ).eq( best_i ).attr( 'label' ) );
			};
			for ( var best_rov = 0; best_rov < best_count; best_rov++ ) {
				$( best_option_array ).append( best_optgroups[best_rov] );
				for ( var best_col = 0; best_col < $( 'select' ).eq( best_k ).find( 'optgroup' ).eq( best_rov ).children().size(); best_col++ ) {
					var best_opt = document.createElement( 'div' );
					$( best_opt ).addClass( 'best-option' );
					$( best_opt ).attr( 'value', $( 'select' ).eq( best_k ).find( 'optgroup' ).eq( best_rov ).children().eq( best_col ).attr( 'value' ) );
					$( best_opt ).text( $( 'select' ).eq( best_k ).find( 'optgroup' ).eq( best_rov ).children().eq( best_col ).text() );
					$( best_opt ).attr( 'name', best_z );
					best_z++;
					$( best_option_array ).append( best_opt );
				};
			};
		} else {
			for ( var best_i = 0; best_i < $( 'select' ).eq( best_k ).find( 'option' ).size(); best_i++ ) {
				var best_opt = document.createElement( 'div' );
				$( best_opt ).addClass( 'best-option' );
				$( best_opt ).attr( 'value', $( 'select' ).eq( best_k ).find( 'option' ).eq( best_i ).attr( 'value' ) );
				$( best_opt ).attr( 'name', best_i );
				$( best_opt ).text( $( 'select' ).eq( best_k ).find( 'option' ).eq( best_i ).text() );
				$( best_option_array ).append( best_opt );
			};
		};
		$( best_sel ).append( best_active_opt );
		$( best_sel ).append( best_option_array );
	} )( jQuery );
	return best_sel;
}