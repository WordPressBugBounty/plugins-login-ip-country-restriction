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
?>

<label data-toggle data-target="#ip-list-wrap" data-action="hide">
	<input type="radio" value="all"
		name="_login_ip_country_restriction_settings[allow_ip_all]"
		id="_login_ip_country_restriction_settings_allow_ip_all"
		<?php checked( false, self::$rules->restrict->ip ); ?>/>
	<span>
		<h2><?php esc_html_e( 'No IP restriction', 'slicr' ); ?></h2>
		<?php esc_html_e( 'No IP restriction', 'slicr' ); ?>
	</span>
</label>

<hr>

<label data-toggle data-target="#ip-list-wrap" data-action="show">
	<input type="radio" value="restrict"
		name="_login_ip_country_restriction_settings[allow_ip_all]"
		id="_login_ip_country_restriction_settings_allow_ip_restrict"
		<?php checked( true, self::$rules->restrict->ip ); ?>/>
	<span>
		<h2><?php esc_html_e( 'Setup IP restriction', 'slicr' ); ?></h2>
		<?php esc_html_e( 'Allow or block only specific IPs', 'slicr' ); ?>
	</span>
</label>

<div id="ip-list-wrap"
	class="contents <?php echo esc_attr( false === self::$rules->restrict->ip ? 'is-hidden' : '' ); ?>">

	<div class="box">
		<hr>
		<h3 id="_title_allow_ip_restrict">
			<?php echo esc_attr( self::CHAR_ALLOW ); ?>
			<?php esc_html_e( 'Allow specific IPs', 'slicr' ); ?>
		</h3>

		<p>
			<?php esc_html_e( 'Separate the IPs with comma if there are more.', 'slicr' ); ?>
			<?php esc_html_e( 'For IP ranges, use ~ (ex: 192.168.0.~).', 'slicr' ); ?>
		</p>
		<?php
		$list_ip   = self::$allowed_ips;
		$list_ip[] = self::get_current_ip();
		$list_ip   = array_unique( $list_ip );
		if ( ! empty( self::$settings['force_remove_local'] ) ) {
			$list_ip = array_diff( $list_ip, [ '127.0.0.1', '::1' ] );
		}
		?>
		<textarea
			aria-labelledby="_title_allow_ip_restrict"
			name="_login_ip_country_restriction_settings[allow_ip_restrict]"
			placeholder="11.11.11.11,22.22.22.~,33.33.33.33"
			class="wide" rows="2"><?php echo esc_html( implode( ', ', $list_ip ) ); ?></textarea>

		<p>
			<?php esc_html_e( '* means any IP, you must remove it from the list if you want to apply a restriction.', 'slicr' ); ?>
		</p>
	</div>

	<div class="box">
		<hr>
		<h3 id="_title_block_ip_restrict">
			<?php echo esc_attr( self::CHAR_BLOCK ); ?>
			<?php esc_html_e( 'Block specific IPs', 'slicr' ); ?>
		</h3>
		<p>
			<?php esc_html_e( 'Separate the IPs with comma if there are more.', 'slicr' ); ?>
			<?php esc_html_e( 'For IP ranges, use ~ (ex: 192.168.0.~).', 'slicr' ); ?>
		</p>
		<textarea
			aria-labelledby="_title_block_ip_restrict"
			name="_login_ip_country_restriction_settings[allow_ip_block]"
			placeholder="11.11.11.11,22.22.22.~,33.33.33.33"
			class="wide" rows="2"><?php echo esc_html( implode( ', ', self::$blocked_ips ) ); ?></textarea>
	</div>

	<div class="box">
		<hr>
		<h3 class="has-warning">
			<span class="dashicons dashicons-warning"></span>
			<?php esc_html_e( 'Danger zone', 'slicr' ); ?>
		</h3>
		<p><?php esc_html_e( 'These settings are not recommended and are risky to enable, as these will block your access when you are using this on your local environment. The options are intended only for use with hosts like Cloudflare, or when the server IP is masked as 127.0.0.1 or ::1 (using HTTP proxy or a load balancer).', 'slicr' ); ?></p>
		<ul>
			<li>
				<label>
					<input type="checkbox" value="1" name="_login_ip_country_restriction_settings[force_remove_local]" id="_login_ip_country_restriction_settings_force_remove_local" <?php checked( true, ! empty( self::$settings['force_remove_local'] ) ); ?>/>
					<span>
						<?php esc_html_e( 'remove the 127.0.0.1 and ::1 from the allowed IPs', 'slicr' ); ?>
					</span>
				</label>
			</li>

			<li>
				<label>
					<input type="checkbox" value="1" name="_login_ip_country_restriction_settings[include_forward_ip]" id="_login_ip_country_restriction_settings_include_forward_ip" <?php checked( true, ! empty( self::$settings['include_forward_ip'] ) ); ?>/>
					<span>
						<?php esc_html_e( 'include the server forward IP (HTTP_X_FORWARDED_FOR)', 'slicr' ); ?>
					</span>
				</label>
			</li>
		</ul>
	</div>
</div>

<hr>

<div class="box">
	<?php submit_button( '', 'primary', 'submit-tab1', false ); ?>
</div>
