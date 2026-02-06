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

$lookups     = self::get_available_lookups();
$integration = get_option( SISANU_RCIL_DB_OPTION . '_integration', [] );
?>

<div class="box">
	<p>
		<?php esc_html_e( 'Note: the preferred method is PHP Geo IP Location. If that library is not available on your server, an integration is required. The plugin comes out of the box with a primary integration, which is using a free limited plan.', 'slicr' ); ?>
	</p>

	<hr>

	<h2 class="as-title with-accent">ipapi.co</h2>
	<div class="contents">
		<div class="box">
			<?php
			echo wp_kses_post( sprintf(
				// Translators:  %1$s - account, %2$s - service URL.
				__( 'Create %1$s at <a href="%2$s?recommended-by=login-ip-country-restriction-plugin" target="_blank" rel="noopener noreferrer nofollow">%2$s</a>', 'slicr' ),
				__( 'your account', 'slicr' ),
				'https://ipapi.co/'
			) );
			?>

			<p>
				<?php esc_html_e( 'This is the primary API integrated with the plugin. For the free plan, this is limited to 30,000 requests per month (up to 1,000/day).', 'slicr' ); ?>

				<?php esc_html_e( 'If the default integration limit is reached, you can setup a plan.', 'slicr' ); ?>
			</p>
		</div>
	</div>

	<hr>

	<h3>
		<?php esc_html_e( 'The integrations you set up below will be use as fallbacks.', 'slicr' ); ?>
	</h3>

	<br>

	<h2 class="as-title<?php echo esc_attr( ! empty( $lookups['geolocated'] ) ? ' with-accent' : '' ); ?>">geolocated.io</h2>
	<div class="contents">
		<div class="box">
			<?php
			echo wp_kses_post( sprintf(
				// Translators:  %1$s - account, %2$s - service URL.
				__( 'Create %1$s at <a href="%2$s?recommended-by=login-ip-country-restriction-plugin" target="_blank" rel="noopener noreferrer nofollow">%2$s</a>', 'slicr' ),
				__( 'your free account', 'slicr' ),
				'https://app.geolocated.io/'
			) );
			?>

			<p>
				<b id="geolocated_apikey"><?php esc_html_e( 'API Key', 'slicr' ); ?></b>
				<input type="text" aria-labelledby="geolocated_apikey" class="wide"
					name="integration[geolocated][apikey]"
					value="<?php echo esc_html( $integration['geolocated']['apikey'] ?? '' ); ?>">
			</p>

			<p>
				<b id="geolocated_endpoint"><?php esc_html_e( 'API Endpoint', 'slicr' ); ?></b>
				<input type="text" aria-labelledby="geolocated_endpoint" class="wide"
					name="integration[geolocated][endpoint]"
					value="<?php echo esc_html( $integration['geolocated']['endpoint'] ?? '' ); ?>">
			</p>
		</div>
	</div>

	<hr>

	<h2 class="as-title<?php echo esc_attr( ! empty( $lookups['ip2location'] ) ? ' with-accent' : '' ); ?>">ip2location.io</h2>
	<div class="contents">
		<div class="box">
			<?php
			echo wp_kses_post( sprintf(
				// Translators:  %1$s - account, %2$s - service URL.
				__( 'Create %1$s at <a href="%2$s?recommended-by=login-ip-country-restriction-plugin" target="_blank" rel="noopener noreferrer nofollow">%2$s</a>', 'slicr' ),
				__( 'your free account', 'slicr' ),
				'https://www.ip2location.io/'
			) );
			?>

			<p>
				<b id="ip2location_apikey"><?php esc_html_e( 'API Key', 'slicr' ); ?></b>
				<input type="text" aria-labelledby="ip2location_apikey" class="wide"
					name="integration[ip2location][apikey]"
					value="<?php echo esc_html( $integration['ip2location']['apikey'] ?? '' ); ?>">
			</p>
		</div>
	</div>

	<hr>

	<h2 class="as-title<?php echo esc_attr( ! empty( $lookups['geoplugin'] ) ? ' with-accent' : '' ); ?>">geoplugin.com</h2>
	<div class="contents">
		<div class="box">
			<?php
			echo wp_kses_post( sprintf(
				// Translators:  %1$s - account, %2$s - service URL.
				__( 'Create %1$s at <a href="%2$s?recommended-by=login-ip-country-restriction-plugin" target="_blank" rel="noopener noreferrer nofollow">%2$s</a>', 'slicr' ),
				__( 'your account', 'slicr' ),
				'https://www.geoplugin.com/'
			) );
			?>

			<p>
				<b id="geoplugin_apikey"><?php esc_html_e( 'API Key', 'slicr' ); ?></b>
				<input type="text" aria-labelledby="geoplugin_apikey" class="wide"
					name="integration[geoplugin][apikey]"
					value="<?php echo esc_html( $integration['geoplugin']['apikey'] ?? '' ); ?>">
			</p>
		</div>
	</div>

	<hr>

	<?php submit_button( '', 'primary', 'submit-tab6', false ); ?>
</div>

<hr>
