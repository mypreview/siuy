<?php
/**
 * Customizer custom controls.
 *
 * @author  	Mahdi Yazdani
 * @package 	Siuy
 * @since 	    1.0.0
 */
if (!class_exists('WP_Customize_Control')):
	return NULL;
endif;
/**
 * Create a Radio-Image control
 * Inspired by Storefront class-storefront-customizer-control-radio-image.php
 *
 * @see 		https://github.com/woocommerce/storefront
 * @since 	    1.0.0
 */
if (!class_exists('Siuy_Radio_Image_Control')):
	class Siuy_Radio_Image_Control extends WP_Customize_Control

	{
		/**
		 * Control type.
		 *
		 * @since 1.0.0
		 */
		public $type = 'siuy-radio-image';
		/**
		 * Control setup.
		 *
		 * @since 1.0.0
		 */
		public function __construct($manager, $id, $args = array())

		{
        	parent::__construct($manager, $id, $args);
    	}
    	/**
         * Enqueue scripts and styles.
         *
         * @since 1.0.0
         */
		public function enqueue() 

		{
			wp_enqueue_script('jquery-ui-button');
		}
		/**
		 * Render the content of the "Radio-Image" field type.
		 *
		 * @since 1.0.0
		 */
		protected function render_content()
		
		{
			if (empty($this->choices)):
				return;
			endif;
			$name = '_customize-radio-' . $this->id;
			?>
			<div class="siuy-radio-image">
	            <span class="customize-control-title"><?php echo esc_html($this->label); ?></span>
	            <span class="description customize-control-description"><?php echo esc_html($this->description); ?></span>
	            <div id="input_<?php echo esc_attr($this->id); ?>" class="image ui-buttonset">
					<?php foreach ($this->choices as $value => $label ) : ?>
						<input class="image-select" type="radio" value="<?php echo esc_attr($value); ?>" id="<?php echo esc_attr($this->id . $value); ?>" name="<?php echo esc_attr($name); ?>" <?php $this->link(); checked($this->value(), $value); ?>>
							<label for="<?php echo esc_attr($this->id) . esc_attr($value); ?>">
								<img src="<?php echo esc_html($label); ?>" alt="<?php echo esc_attr($value); ?>" title="<?php echo esc_attr($value); ?>">
							</label>
						</input>
					<?php endforeach; ?>
				</div>
        	</div>
        	<script type="text/javascript">jQuery(document).ready(function($) { $('[id="input_<?php echo esc_attr($this->id); ?>"]' ).buttonset(); });</script>
        	<?php
		}
	}
endif;