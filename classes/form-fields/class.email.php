<?php
/**
 * Name       : MW WP Form Field Email
 * Version    : 2.0.0
 * Author     : Takashi Kitajima
 * Author URI : https://2inc.org
 * Created    : July 20, 2015
 * Modified   : May 30, 2017
 * License    : GPLv2 or later
 * License URI: http://www.gnu.org/licenses/gpl-2.0.html
 */
class MW_WP_Form_Field_Email extends MW_WP_Form_Abstract_Form_Field {

	/**
	 * Types of form type.
	 * input|select|button|input_button|error|other
	 * @var string
	 */
	public $type = 'input';

	/**
	 * Set shortcode_name and display_name
	 * Overwrite required for each child class
	 *
	 * @return array(shortcode_name, display_name)
	 */
	protected function set_names() {
		return array(
			'shortcode_name' => 'mwform_email',
			'display_name'   => __( 'Email', 'mw-wp-form' ),
		);
	}

	/**
	 * Set default attributes
	 *
	 * @return array defaults
	 */
	protected function set_defaults() {
		return array(
			'name'        => '',
			'id'          => null,
			'class'       => null,
			'size'        => 60,
			'maxlength'   => null,
			'value'       => '',
			'placeholder' => null,
			'pattern'     => null,
			'show_error'  => 'true',
			'conv_half_alphanumeric' => 'true',
		);
	}

	/**
	 * Callback of add shortcode for input page
	 *
	 * @param array $atts
	 * @param string $element_content
	 * @return string HTML
	 */
	protected function input_page() {
		$conv_half_alphanumeric = 'true';
		if ( 'true' !== $this->atts['conv_half_alphanumeric'] ) {
			$conv_half_alphanumeric = null;
		}
		$value = $this->Data->get_raw( $this->atts['name'] );
		if ( is_null( $value ) ) {
			$value = $this->atts['value'];
		}

		$_ret = $this->Form->email( $this->atts['name'], array(
			'id'          => $this->atts['id'],
			'class'       => $this->atts['class'],
			'size'        => $this->atts['size'],
			'maxlength'   => $this->atts['maxlength'],
			'value'       => $value,
			'placeholder' => $this->atts['placeholder'],
			'pattern'     => $this->atts['pattern'],
			'conv-half-alphanumeric' => $conv_half_alphanumeric,
		) );
		if ( 'false' !== $this->atts['show_error'] ) {
			$_ret .= $this->get_error( $this->atts['name'] );
		}
		return $_ret;
	}

	/**
	 * Callback of add shortcode for confirm page
	 *
	 * @param array $atts
	 * @param string $element_content
	 * @return string HTML
	 */
	protected function confirm_page() {
		$value = $this->Data->get_raw( $this->atts['name'] );
		$_ret  = esc_html( $value );
		$_ret .= $this->Form->hidden( $this->atts['name'], $value );
		return $_ret;
	}

	/**
	 * Display tag generator dialog
	 * Overwrite required for each child class
	 *
	 * @param array $options
	 * @return void
	 */
	public function mwform_tag_generator_dialog( array $options = array() ) {
		?>
		<p>
			<strong>name<span class="mwf_require">*</span></strong>
			<?php $name = $this->get_value_for_generator( 'name', $options ); ?>
			<input type="text" name="name" value="<?php echo esc_attr( $name ); ?>" />
		</p>
		<p>
			<strong>id</strong>
			<?php $id = $this->get_value_for_generator( 'id', $options ); ?>
			<input type="text" name="id" value="<?php echo esc_attr( $id ); ?>" />
		</p>
		<p>
			<strong>class</strong>
			<?php $class = $this->get_value_for_generator( 'class', $options ); ?>
			<input type="text" name="class" value="<?php echo esc_attr( $class ); ?>" />
		</p>
		<p>
			<strong>size</strong>
			<?php $size = $this->get_value_for_generator( 'size', $options ); ?>
			<input type="text" name="size" value="<?php echo esc_attr( $size ); ?>" />
		</p>
		<p>
			<strong>maxlength</strong>
			<?php $maxlength = $this->get_value_for_generator( 'maxlength', $options ); ?>
			<input type="text" name="maxlength" value="<?php echo esc_attr( $maxlength ); ?>" />
		</p>
		<p>
			<strong><?php esc_html_e( 'Default value', 'mw-wp-form' ); ?></strong>
			<?php $value = $this->get_value_for_generator( 'value', $options ); ?>
			<input type="text" name="value" value="<?php echo esc_attr( $value ); ?>" />
		</p>
		<p>
			<strong>placeholder</strong>
			<?php $placeholder = $this->get_value_for_generator( 'placeholder', $options ); ?>
			<input type="text" name="placeholder" value="<?php echo esc_attr( $placeholder ); ?>" />
		</p>
		<p>
			<strong>pattern</strong>
			<?php $pattern = $this->get_value_for_generator( 'pattern', $options ); ?>
			<input type="text" name="pattern" value="<?php echo esc_attr( $pattern ); ?>" />
		</p>
		<p>
			<strong><?php esc_html_e( 'Display error', 'mw-wp-form' ); ?></strong>
			<?php $show_error = $this->get_value_for_generator( 'show_error', $options ); ?>
			<label><input type="checkbox" name="show_error" value="false" <?php checked( 'false', $show_error ); ?> /> <?php esc_html_e( 'Don\'t display error.', 'mw-wp-form' ); ?></label>
		</p>
		<p>
			<strong><?php esc_html_e( 'Convert half alphanumeric', 'mw-wp-form' ); ?></strong>
			<?php $conv_half_alphanumeric = $this->get_value_for_generator( 'conv_half_alphanumeric', $options ); ?>
			<label><input type="checkbox" name="conv_half_alphanumeric" value="false" <?php checked( 'false', $conv_half_alphanumeric ); ?> /> <?php esc_html_e( 'Don\'t Convert.', 'mw-wp-form' ); ?></label>
		</p>
		<?php
	}
}
