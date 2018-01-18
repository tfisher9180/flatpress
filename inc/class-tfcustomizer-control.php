<?php

if ( class_exists( 'WP_Customize_Control' ) ) {

	class WP_Customize_tfcustomizer_Control extends WP_Customize_Control {

		/**
		 * Render the data link attributes for the control's input element.
		 *
		 * @since 3.4.0
		 * @uses WP_Customize_Control::get_link()
		 *
		 * @param string $setting_key
		 */
		public function link( $setting_key = 'default' ) {
			echo $this->get_link( $setting_key );
			echo $this->get_tfcustomizer_link();
		}

		/**
		 * Render the custom data link for jQuery tfcustomizer plugin.
		 * @return string
		 */
		protected function get_tfcustomizer_link() {
			return ' data-customize="tfcustomizer" data-name="' . $this->id . '"'; 
		}

	}

}