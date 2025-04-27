<?php // phpcs:ignore Generic.Files.LineEndings.InvalidEOLChar
/**
 * Login IP & Country Restriction.
 * Text Domain: slicr
 *
 * @package ic-devops
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

$true_pro = self::$is_pro && function_exists( '\RCIL\Pro\key_is_active' ) && true === \RCIL\Pro\key_is_active();
?>

<div class="box">
	<h2><?php esc_html_e( 'Login Restriction Rules', 'slicr' ); ?></h2>
	<p><?php esc_html_e( 'The login filter can be configured to work in a different way, depending on what type of rules to be assessed and in which order.', 'slicr' ); ?></p>
	<ol>
		<?php
		$count = 0;
		foreach ( $rules as $key => $value ) {
			++$count;

			$class = '';
			if ( true === $value['is_pro'] ) {
				$class = ( ! $true_pro ) ? 'pro-item-after disabled' : 'pro-item-after';
				if ( ! $true_pro ) {
					?>
					<li>
						<span><?php echo (int) $count; ?>.</span>
						<label class="pro-item-after disabled">
							<span><?php echo esc_html( $value['title'] ); ?></span>
						</label>
					</li>
					<?php
				} else {
					?>
					<li>
						<span><?php echo (int) $count; ?>.</span>
						<label class="pro-item-after">
							<input type="radio" name="rule_type" value="<?php echo (int) $key; ?>" <?php checked( self::$rules->type, $key ); ?>>
							<span><?php echo esc_html( $value['title'] ); ?></span>
						</label>
					</li>
					<?php
				}
			} else {
				?>
				<li>
					<span><?php echo (int) $count; ?>.</span>
					<label>
						<input type="radio" name="rule_type" value="<?php echo (int) $key; ?>" <?php checked( self::$rules->type, $key ); ?>>
						<span><?php echo esc_html( $value['title'] ); ?></span>
					</label>
				</li>
				<?php
			}
		}
		?>
	</ol>
</div>

<hr>

<div class="box">
	<h2><?php esc_html_e( 'Filter XML-RPC Authenticated Methods', 'slicr' ); ?></h2>
	<p><?php esc_html_e( 'The option controls whether XML-RPC methods requiring authentication (such as for publishing purposes) are enabled and do not interfere with pingbacks or other custom endpoints that don\'t require authentication.', 'slicr' ); ?></p>
	<ul>
		<li>
			<label>
				<input type="radio" name="xmlrpc_auth_filter" id="xmlrpc_auth_filter" value="" <?php checked( '', self::$settings['xmlrpc_auth_filter'] ); ?>/>
				<span><?php esc_html_e( 'Default', 'slicr' ); ?></span>
			</label>
		</li>
		<li>
			<label>
				<input type="radio" name="xmlrpc_auth_filter" id="xmlrpc_auth_filter_all" value="all" <?php checked( 'all', self::$settings['xmlrpc_auth_filter'] ); ?>/>
				<span><?php esc_html_e( 'Disable all', 'slicr' ); ?></span>
			</label>
		</li>
		<li>
			<label>
				<input type="radio" name="xmlrpc_auth_filter" id="xmlrpc_auth_filter_restriction" value="restriction" <?php checked( 'restriction', self::$settings['xmlrpc_auth_filter'] ); ?>/>
				<span><?php esc_html_e( 'Disable only when matching a restriction rule', 'slicr' ); ?></span>
			</label>
		</li>
	</ul>
</div>

<hr>

<div class="box">
	<?php submit_button( '', 'primary', '', false ); ?>
</div>
