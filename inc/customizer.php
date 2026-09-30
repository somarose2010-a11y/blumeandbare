<?php
/**
 * BlumeAndBare Theme Customizer
 *
 * @package BlumeAndBare
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function blumeandbare_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	$wp_customize->add_section(
		'blumeandbare_hero',
		array(
			'title'    => __( 'Hero banner', 'blumeandbare' ),
			'priority' => 30,
		)
	);

	$hero_settings = array(
		'blumeandbare_hero_eyebrow'         => array(
			'label'   => __( 'Eyebrow', 'blumeandbare' ),
			'default' => __( 'Organic skincare, wellness', 'blumeandbare' ),
		),
		'blumeandbare_hero_title'           => array(
			'label'   => __( 'Heading', 'blumeandbare' ),
			'default' => __( 'Nurture your skin with raw, botanical purity', 'blumeandbare' ),
		),
		'blumeandbare_hero_text'            => array(
			'label'   => __( 'Supporting text', 'blumeandbare' ),
			'default' => __( 'Clean, biodegradable formulations crafted to respect your skin’s natural barrier. No fillers, no harsh synthetics—just honest, plant-powered nourishment.', 'blumeandbare' ),
		),
		'blumeandbare_hero_primary_label'   => array(
			'label'   => __( 'Primary button label', 'blumeandbare' ),
			'default' => __( 'Shop the collection', 'blumeandbare' ),
		),
		'blumeandbare_hero_primary_url'     => array(
			'label'   => __( 'Primary button URL', 'blumeandbare' ),
			'default' => '',
		),
		'blumeandbare_hero_secondary_label' => array(
			'label'   => __( 'Secondary button label', 'blumeandbare' ),
			'default' => __( 'Our philosophy', 'blumeandbare' ),
		),
		'blumeandbare_hero_secondary_url'   => array(
			'label'   => __( 'Secondary button URL', 'blumeandbare' ),
			'default' => '',
		),
	);

	foreach ( $hero_settings as $id => $setting ) {
		$sanitize = false !== strpos( $id, '_url' ) ? 'esc_url_raw' : 'sanitize_text_field';

		$wp_customize->add_setting(
			$id,
			array(
				'default'           => $setting['default'],
				'sanitize_callback' => $sanitize,
				'transport'         => 'refresh',
			)
		);

		$wp_customize->add_control(
			$id,
			array(
				'label'   => $setting['label'],
				'section' => 'blumeandbare_hero',
				'type'    => false !== strpos( $id, '_text' ) ? 'textarea' : 'text',
			)
		);
	}

	$wp_customize->add_setting(
		'blumeandbare_hero_image',
		array(
			'default'           => '',
			'sanitize_callback' => 'esc_url_raw',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize,
			'blumeandbare_hero_image',
			array(
				'label'   => __( 'Hero image', 'blumeandbare' ),
				'section' => 'blumeandbare_hero',
			)
		)
	);

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial(
			'blogname',
			array(
				'selector'        => '.site-title a',
				'render_callback' => 'blumeandbare_customize_partial_blogname',
			)
		);
		$wp_customize->selective_refresh->add_partial(
			'blogdescription',
			array(
				'selector'        => '.site-description',
				'render_callback' => 'blumeandbare_customize_partial_blogdescription',
			)
		);
	}
}
add_action( 'customize_register', 'blumeandbare_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function blumeandbare_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function blumeandbare_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function blumeandbare_customize_preview_js() {
	wp_enqueue_script( 'blumeandbare-customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), _S_VERSION, true );
}
add_action( 'customize_preview_init', 'blumeandbare_customize_preview_js' );
