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

<label data-toggle data-target="#country-list-wrap" data-action="hide">
	<input type="radio" name="_login_ip_country_restriction_settings[allow_country_all]" id="_login_ip_country_restriction_settings_allow_country_all" value="all" <?php checked( false, self::$rules->restrict->co ); ?>/>
	<span>
		<h2><?php esc_html_e( 'No country restriction', 'slicr' ); ?></h2>
		<?php esc_html_e( 'No country restriction', 'slicr' ); ?>
	</span>
</label>

<hr>

<label data-toggle data-target="#country-list-wrap" data-action="show">
	<input type="radio" name="_login_ip_country_restriction_settings[allow_country_all]" id="_login_ip_country_restriction_settings_allow_country_restrict" value="restrict" <?php checked( true, self::$rules->restrict->co ); ?>/>
	<span>
		<h2><?php esc_html_e( 'Setup country restriction', 'slicr' ); ?></h2>
		<?php esc_html_e( 'Allow or block only the selected countries', 'slicr' ); ?>
	</span>
</label>

<div id="country-list-wrap"
	class="contents <?php echo esc_attr( ( false === self::$rules->restrict->co ) ? 'is-hidden' : '' ); ?>">
	<?php
	$allow = [];
	$block = [];
	$reset = [];
	foreach ( $all_countries as $key => $name ) {
		if ( in_array( $key, self::$allowed_countries, true ) ) {
			$allow[ $key ] = $name;
		} elseif ( in_array( $key, self::$blocked_countries, true ) ) {
			$block[ $key ] = $name;
		} else {
			$reset[ $key ] = $name;
		}
	}
	?>

	<div class="cols grow-last">
		<div class="filter-selected box">
			<hr>
			<h3>
				<?php echo esc_attr( self::CHAR_ALLOW ); ?>
				<?php esc_html_e( 'Allowed countries', 'slicr' ); ?>
			</h3>

			<p>
				<?php esc_html_e( 'This is the list of countries from where the login is allowed.', 'slicr' ); ?>
				<br>
				<?php
				// Translators: %1$s - count selected.
				echo wp_kses_post( sprintf( __( '%1$s selected', 'slicr' ), '<b>' . count( $allow ) . '</b>' ) );
				?>
			</p>
			<ul class="cols tiny">
				<?php if ( ! empty( $allow ) ) : ?>
					<?php foreach ( $allow as $key => $value ) : ?>
						<li class="as-pill allowed">
							<label class="fake-checkbox allowed">
								<input type="checkbox"
									name="_login_ip_country_restriction_settings[allow_country_restrict][]"
									id="_login_ip_country_restriction_settings_allow_country_all"
									value="<?php echo esc_attr( $key ); ?>"
									checked="checked" />
								<?php echo esc_html( $value ); ?>
								(<?php echo esc_html( $key ); ?>)
							</label>
						</li>
					<?php endforeach; ?>
				<?php else : ?>
					<li>(<?php esc_html_e( 'you did not select any country yet', 'slicr' ); ?>)</li>
				<?php endif; ?>
			</ul>

			<hr>
			<h3>
				<?php echo esc_attr( self::CHAR_BLOCK ); ?>
				<?php esc_html_e( 'Blocked countries', 'slicr' ); ?>
			</h3>
			<p>
				<?php esc_html_e( 'This is the list of countries from where the login is blocked.', 'slicr' ); ?>
				<?php
				// Translators: %1$s - count selected.
				echo wp_kses_post( sprintf( __( '%1$s selected', 'slicr' ), '<b>' . count( $block ) . '</b>' ) );
				?>
			</p>
			<ul class="cols tiny">
				<?php if ( ! empty( $block ) ) : ?>
					<?php foreach ( $block as $key => $value ) : ?>
						<li class="as-pill blocked">
							<label class="fake-checkbox blocked">
								<input type="checkbox"
									name="_login_ip_country_restriction_settings[allow_country_block][]"
									id="_login_ip_country_restriction_settings_allow_country_block"
									value="<?php echo esc_attr( $key ); ?>"
									checked="checked"/>

								<?php echo esc_html( $value ); ?>
								(<?php echo esc_html( $key ); ?>)
							</label>
						</li>
					<?php endforeach; ?>
				<?php else : ?>
					<li>(<?php esc_html_e( 'you did not select any country yet', 'slicr' ); ?>)</li>
				<?php endif; ?>
			</ul>
		</div>

		<div class="filter-unfiltered box">
			<hr>
			<h3><?php esc_html_e( 'Countries list', 'slicr' ); ?></h3>

			<div class="letters">
				<?php foreach ( range( 'A', 'Z' ) as $letter ) { ?>
					<a href="#letter<?php echo esc_attr( $letter ); ?>" class="button" tabindex="0"><?php echo esc_html( $letter ); ?></a>
				<?php } ?>
				<a href="#start" class="button" tabindex="0">↑</a>
			</div>

			<div class="list">
				<?php
				$letter = '';
				foreach ( $reset as $key => $value ) :
					$code_letter = remove_accents( str_replace( '"', '', $value )[0] );
					if ( $code_letter !== $letter ) :
						$letter = $code_letter;
						?>
						<?php if ( 'A' !== $letter ) : ?>
							</ul>
						<?php endif; ?>

					<hr name="letter<?php echo esc_attr( $letter ); ?>" id="letter<?php echo esc_attr( $letter ); ?>">

					<div>
						<a class="button button-primary"><?php echo esc_attr( $letter ); ?></a>
						<?php submit_button( '', 'letter' . esc_attr( $letter ), 'submit-tab2', false ); ?>
					</div>

					<ul class="cols tiny">
					<?php endif; ?>

					<li class="as-pill">
						<label class="fake-checkbox allowed">
							<input type="radio" tabindex="0" name="_login_ip_country_restriction_settings[countries_filter][<?php echo esc_attr( $key ); ?>]" value="allow" title="<?php esc_html_e( 'Allowed countries', 'slicr' ); ?>" data-letter="<?php echo esc_attr( $letter ); ?>" />
						</label>
						<label class="fake-checkbox blocked">
							<input type="radio" tabindex="0" name="_login_ip_country_restriction_settings[countries_filter][<?php echo esc_attr( $key ); ?>]" value="block" title="<?php esc_html_e( 'Blocked countries', 'slicr' ); ?>" data-letter="<?php echo esc_attr( $letter ); ?>" />
						</label>
						<label class="fake-checkbox clear">
							<input type="radio" tabindex="0" name="_login_ip_country_restriction_settings[countries_filter][<?php echo esc_attr( $key ); ?>]" value="" checked="checked" data-letter="<?php echo esc_attr( $letter ); ?>" />
							<?php echo esc_html( $value ); ?>
							(<?php echo esc_html( $key ); ?>)
						</label>
					</li>
				<?php endforeach; ?>
				</ul>
			</div>
		</div>
	</div>
</div>

<hr>
<div class="box">
	<?php submit_button( '', 'primary', 'submit-tab2', false ); ?>
</div>
