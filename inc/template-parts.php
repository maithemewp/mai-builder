<?php

namespace Mai\Builder;

use Mai\Builder\Config;

defined( 'ABSPATH' ) || exit;

add_filter( 'default_wp_template_part_areas', __NAMESPACE__ . '\template_part_areas' );
/**
 * Add template part areas.
 *
 * @since 0.1.0
 *
 * @param array $areas The template part areas.
 *
 * @return array The modified template part areas.
 */
function template_part_areas( array $areas ): array {
	$config = (array) Config::get( 'template-part-areas' );

	// Bail if no config.
	if ( empty( $config ) ) {
		return $areas;
	}

	// Loop through the config and add the areas.
	foreach ( $config as $slug => $area ) {
		// Merge the area with the default values.
		$areas[] = wp_parse_args( $area, [
			'area'        => $slug,
			'area_tag'    => 'section',
			'label'       => '',
			'description' => '',
			'icon'        => '',
		] );
	}

	return $areas;
}