/*global redux_change, redux*/

(function( $ ) {
    "use strict";
    
    redux.field_objects = redux.field_objects || {};
    redux.field_objects.sidgen = redux.field_objects.sidgen || {};

    $( document ).ready(
        function() {
            //redux.field_objects.multi_text.init();
        }
    );

    redux.field_objects.sidgen.init = function( selector ) {

        if ( !selector ) {
            selector = $( document ).find( '.redux-container-sidgen:visible' );
        }

        $( selector ).each(

            function() {
                var el = $( this );
                var parent = el;
                if ( !el.hasClass( 'redux-field-container' ) ) {
                    parent = el.parents( '.redux-field-container:first' );
                }
                if ( parent.is( ":hidden" ) ) { // Skip hidden fields
                    return;
                }
                if ( parent.hasClass( 'redux-field-init' ) ) {
                    parent.removeClass( 'redux-field-init' );
                } else {
                    return;
                }
                el.find( '.redux-multi-text-remove' ).live(
                    'click', function() {
                        redux_change( $( this ) );
                        $( this ).prev( 'input[type="text"]' ).val( '' );
                        $( this ).parent().slideUp(
                            'medium', function() {
                                $( this ).remove();
                            }
                        );
                    }
                );

                el.find( '.redux-multi-text-add' ).click(
                    function() {                        
                        var id = $( this ).attr( 'data-id' );
                        var last_key = parseInt($( this ).next().val());
                        var name = $( this ).attr( 'data-name' ) + '[' + parseInt(last_key + 1) + ']';
                        $( this ).next().val(parseInt(last_key + 1));
                        var new_input = $( '#' + id + ' li:last-child' ).clone();
                        el.find( '#' + id ).append( new_input );
                        el.find( '#' + id + ' li:last-child' ).removeAttr( 'style' );
                        el.find( '#' + id + ' li:last-child input[type="text"]' ).val( '' );
                        el.find( '#' + id + ' li:last-child input[type="text"]' ).attr( 'name', name);

                    }
                );
            }
        );
    };
})( jQuery );