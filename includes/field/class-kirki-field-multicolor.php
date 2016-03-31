<?php

if ( ! class_exists( 'Kirki_Field_Color_Alpha' ) ) {

	class Kirki_Field_Color_Alpha extends Kirki_Field {

		/**
		 * Sets the control type.
		 *
		 * @access protected
		 */
		protected function set_type() {

			$this->type = 'multicolor';

		}

		/**
		 * Sets the $choices
		 *
		 * @access protected
		 */
		protected function set_choices() {

			// Make sure choices are defined as an array
			! is_array( $this->choices ) && $this->choices = array();

			// Properly format the 'alpha' choice as a boolean
			! isset( $this->choices['alpha'] ) && $this->choices['alpha'] = true;

			$this->choices['alpha'] = (bool) $this->choices['alpha'];

		}

		/**
		 * Sets the $sanitize_callback
		 *
		 * @access protected
		 */
		protected function set_sanitize_callback() {

			// If a custom sanitize_callback has been defined,
			// then we don't need to proceed any further.
			if ( ! empty( $this->sanitize_callback ) ) {
				return;
			}
			$this->sanitize_callback = array( $this, 'sanitize' );

		}

		public function sanitize( $value ) {

			foreach ( $value as $key => $color ) {

				$color_obj = ariColor::newColor( $value );
				$value[ $key ] = $color_obj->toCSS( $color_obj->mode );

			}

			return $value;

		}

	}

}