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

$integration = get_option( SISANU_RCIL_DB_OPTION . '_integration', [] );
$geolocated  = $integration['geolocated'] ?? [];
?>

<div class="box">
	<h2 class="as-title" id="export_settings_title"><?php esc_html_e( 'geolocated.io', 'slicr' ); ?></h2>
	<p>
		<?php esc_html_e( 'Create a free account at https://app.geolocated.io/', 'slicr' ); ?>
	</p>
	<div class="cols tiny">
		<div>
			<input type="text"
				aria-labelledby="geolocated_apikey"
				name="integration[geolocated][apikey]"
				value="<?php echo esc_html( $geolocated['apikey'] ?? '' ); ?>">
			<b id="geolocated_apikey"><?php esc_html_e( 'API Key', 'slicr' ); ?></b>
		</div>

		<div>
			<input type="text"
				aria-labelledby="geolocated_endpoint"
				name="integration[geolocated][endpoint]"
				value="<?php echo esc_html( $geolocated['endpoint'] ?? '' ); ?>">
			<b id="geolocated_endpoint"><?php esc_html_e( 'API Endpoint', 'slicr' ); ?></b>
		</div>

		<div>
			<?php submit_button( '', 'primary', 'submit-tab6', false ); ?>
		</div>
	</div>
</div>

<hr>
