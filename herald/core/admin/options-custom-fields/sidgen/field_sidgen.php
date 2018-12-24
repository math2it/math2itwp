<?php

/**
 * Sidebar generator custom field created for Redux Framework
 *
 * @since 1.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Don't duplicate me!
if ( ! class_exists( 'ReduxFramework_sidgen' ) ) {

    /**
     * Main ReduxFramework_sidgen class
     *
     * @since       1.0
     */
    class ReduxFramework_sidgen {

        /**
         * Field Constructor.
         * Required - must call the parent constructor, then assign field and value to vars, and obviously call the render field function
         *
         * @return      void
         */
        function __construct( $field = array(), $value = '', $parent ) {
            $this->parent = $parent;
            $this->field  = $field;
            $this->value  = $value;
        }

        /**
         * Field Render Function.
         * Takes the vars and outputs the HTML for the field in the settings
         *
         * @since       1.0
         * @return      void
         */
        public function render() {

            $this->add_text   = ( isset( $this->field['add_text'] ) ) ? $this->field['add_text'] : esc_html__( 'Add Sidebar', 'herald' );

            echo '<ul id="' . $this->field['id'] . '-ul" class="redux-multi-text">';

            if ( isset( $this->value ) && is_array( $this->value ) ) {
                foreach ( $this->value as $k => $value ) {
                    if ( $k != 'lastkey') {
                        echo '<li><input type="text" id="' . $this->field['id'] . '-' . $k . '" name="' . $this->field['name'] . $this->field['name_suffix'] . '['.$k.']' . '" value="' . esc_attr( $value ) . '" class="regular-text ' . $this->field['class'] . '" /> <a href="javascript:void(0);" class="deletion redux-multi-text-remove">X</a></li>';
            
                    } else {
                        $lastkey = $value;
                    }
                }
    
            } else {
                $lastkey = 0;
            }

            echo '<li style="display:none;"><input type="text" id="' . $this->field['id'] . '" name="" value="" class="regular-text" /> <a href="javascript:void(0);" class="deletion redux-multi-text-remove">X</a></li>';

            echo '</ul>';
            echo '<span style="clear:both;display:block;height:0;" /></span>';
           
            echo '<a href="javascript:void(0);" class="button button-secondary redux-multi-text-add" data-id="' . $this->field['id'] . '-ul" data-name="' . $this->field['name'] . $this->field['name_suffix'] . '">' . $this->add_text . '</a>';
            echo '<input type="hidden" class="lastkey" name="' . $this->field['name'] . $this->field['name_suffix'] . '[lastkey]'.'" value="' . esc_attr( $lastkey ) . '">';
        }

        /**
         * Enqueue Function.
         * If this field requires any scripts, or css define this function and register/enqueue the scripts/css
         *
         * @since       1.0
         * @return      void
         */
        public function enqueue() {

            wp_enqueue_script(
                'redux-field-sidgen-js',
               get_template_directory_uri().'/core/admin/options-custom-fields/sidgen/field_sidgen.js',
                array( 'jquery', 'redux-js' ),
                time(),
                true
            );
        }
    }
}