<span class="mwform-tel-field">
	<input type="tel"
		name="<?php echo esc_attr( $name ); ?>"
		<?php echo MWF_Functions::generate_input_attribute( 'class', $class ); ?>
		<?php echo MWF_Functions::generate_input_attribute( 'size', $size ); ?>
		<?php echo MWF_Functions::generate_input_attribute( 'maxlength', $maxlength['maxlength'] ); ?>
		<?php echo MWF_Functions::generate_input_attribute( 'value', $value ); ?>
		<?php echo MWF_Functions::generate_input_attribute( 'placeholder', $placeholder ); ?>
		<?php echo MWF_Functions::generate_input_attribute( 'pattern', $pattern ); ?>
		<?php echo MWF_Functions::generate_input_attribute( 'required', $required ); ?>
		<?php echo MWF_Functions::generate_input_attribute( 'data-conv-half-alphanumeric', $conv_half_alphanumeric ); ?>
	/>
</span>
