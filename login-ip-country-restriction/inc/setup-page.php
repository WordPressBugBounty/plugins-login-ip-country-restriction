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

$all_countries = self::get_countries_list();

// phpcs:disable
$tab = filter_input( INPUT_GET, 'tab', FILTER_DEFAULT );
$tab = empty( $tab ) ? 0 : (int) $tab;
$tab = $tab < 0 || $tab > 6 ? 0 : $tab;
// phpcs:enable

$rules = [
	6 => [
		'is_pro' => false,
		'title'  => __( 'Allow login only for allowed IPs', 'slicr' ),
	],
	7 => [
		'is_pro' => false,
		'title'  => __( 'Allow login only for allowed countries', 'slicr' ),
	],
	0 => [
		'is_pro' => false,
		'title'  => __( 'Allow login only for allowed countries or allowed IPs', 'slicr' ),
	],
	8 => [
		'is_pro' => false,
		'title'  => __( 'Block login only for blocked IPs', 'slicr' ),
	],
	9 => [
		'is_pro' => false,
		'title'  => __( 'Block login only for blocked countries', 'slicr' ),
	],
	1 => [
		'is_pro' => false,
		'title'  => __( 'Block login only for blocked countries or blocked IPs', 'slicr' ),
	],
	2 => [
		'is_pro' => true,
		'title'  => __( 'Allow login only for allowed countries or allowed IPs, but not from blocked IPs', 'slicr' ),
	],
	3 => [
		'is_pro' => true,
		'title'  => __( 'Allow login only for allowed countries or allowed IPs, but not from blocked IPs or blocked countries', 'slicr' ),
	],
	4 => [
		'is_pro' => true,
		'title'  => __( 'Block login only for blocked countries or blocked IPs, but not for allowed IPs', 'slicr' ),
	],
	5 => [
		'is_pro' => true,
		'title'  => __( 'Block login only for blocked countries or blocked IPs, but not for allowed IPs or allowed countries', 'slicr' ),
	],
];

$url = admin_url( 'options-general.php?page=login-ip-country-restriction-settings' );

$menu_items = apply_filters( 'sislrc_display_pro_tabs', [
	0 => [
		'title' => __( 'Rule Type', 'slicr' ),
	],
	1 => [
		'title' => __( 'IP Restriction', 'slicr' ),
	],
	2 => [
		'title' => __( 'Country Restriction', 'slicr' ),
	],
	3 => [
		'title' => __( 'Redirects', 'slicr' ),
	],
	4 => [
		'title' => __( 'Other Settings', 'slicr' ),
		'class' => 'button inactive pro-item',
	],
	5 => [
		'title' => __( 'Debug', 'slicr' ),
	],
	6 => [
		'title' => __( 'Integration', 'slicr' ),
	],
] );
?>

<div class="wrap licr-feature" id="start" name="start">
	<h1 class="plugin-title">
		<span class="dashicons dashicons-admin-site"></span>
		<?php esc_html_e( 'Login IP & Country Restriction Settings', 'slicr' ); ?>
	</h1>

	<div>
		<?php self::current_restriction_notice_card(); ?>
	</div>

	<?php
	if ( ! empty( $menu_items ) ) {
		?>
		<nav class="licr-menu" id="licr-menu" aria-label="<?php esc_html_e( 'Login IP & Country Restriction Settings Menu', 'slicr' ); ?>">
			<?php
			$options = [];
			foreach ( $menu_items as $idx => $item ) {
				$href = $idx > 0 ? $url . '&tab=' . $idx : $url;
				$cls  = ! empty( $item['class'] ) ? $item['class'] : 'button';
				$cls .= $idx === $tab ? ' button-primary' : '';

				$options[] = '<option value="' . esc_url( $href ) . '"' . ( $idx === $tab ? ' selected="selected"' : '' ) . '>' . esc_html( $item['title'] ) . '</option>';
				?>
				<a href="<?php echo esc_url( $href ); ?>"
					<?php echo esc_attr( $idx === $tab ? ' aria-current="page"' : '' ); ?>
					class="<?php echo esc_attr( $cls ); ?>">
					<?php echo esc_html( $item['title'] ); ?>
				</a>
				<?php
			}
			?>
		</nav>
		<?php
	}
	?>

	<div class="tabpanel panel-<?php echo (int) $tab; ?>" role="tabpanel" aria-label="<?php esc_html_e( 'Settings form', 'slicr' ); ?>" aria-description="<?php esc_html_e( 'Settings form elements', 'slicr' ); ?>">
		<form action="<?php echo esc_url( self::$plugin_url ); ?>" method="POST">
			<?php wp_nonce_field( '_login_ip_country_restriction_settings_save', '_login_ip_country_restriction_settings_nonce' ); ?>
			<input type="hidden" name="tab" id="tab" value="<?php echo (int) $tab; ?>">

			<?php
			switch ( $tab ) {
				case 1:
					// IP restriction.
					self::tab1_content( $rules );
					break;

				case 2:
					// Country restriction.
					self::tab2_content( $all_countries );
					break;

				case 3:
					// Redirects.
					self::tab3_content();
					break;

				case 4:
					// Other Settings.
					self::tab4_content( $rules );
					break;

				case 5:
					// Debug.
					self::setup_debug_output();
					break;

				case 6:
					// Integration.
					self::setup_integration_output();
					break;

				case 0:
				default:
					// Rule type.
					self::tab0_content( $rules );
					break;
			}
			?>
		</form>

		<?php self::show_donate_text(); ?>
	</div>
</div>
