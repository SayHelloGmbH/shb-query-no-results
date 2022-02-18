<?php

/**
 * Plugin Name:       Block: Query No Results
 * Description:       Provides a block wrapper for elements which should be displayed when there are no results found in a query loop block.
 * Requires at least: 5.8
 * Requires PHP:      7.0
 * Version:           0.2.0
 * Author:            Say Hello GmbH
 * License:           GPL-2.0-or-later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       shb-query-no-results
 *
 * @package           shb
 */

/**
 * Renders the `sht/query-no-results` block on the server.
 *
 * @param array  $attributes Block attributes.
 * @param string $content    Block default content.
 *
 * @return string Returns the wrapper for the no results block.
 */
function render_block_shb_query_no_results($attributes, $content, $block)
{

	if (empty(trim($content))) {
		return '';
	}

	$page_key   = isset($block->context['queryId']) ? 'query-' . $block->context['queryId'] . '-page' : 'query-page';
	$page       = empty($_GET[$page_key]) ? 1 : (int) $_GET[$page_key];
	$query_args = build_query_vars_from_query_block($block, $page);

	// Override the custom query with the global query if needed.
	$use_global_query = (isset($block->context['query']['inherit']) && $block->context['query']['inherit']);
	if ($use_global_query) {
		global $wp_query;
		if ($wp_query && isset($wp_query->query_vars) && is_array($wp_query->query_vars)) {
			$query_args = wp_parse_args($wp_query->query_vars, $query_args);
		}
	}

	$query = new WP_Query($query_args);

	if ($query->have_posts()) {
		return '';
	}

	wp_reset_postdata();

	return sprintf(
		'<div %1$s>%2$s</div>',
		get_block_wrapper_attributes(),
		$content
	);
}

/**
 * Registers the block using the metadata loaded from the `block.json` file.
 * Behind the scenes, it registers also all assets so they can be enqueued
 * through the block editor in the corresponding context.
 *
 * @see https://developer.wordpress.org/reference/functions/register_block_type/
 */
function create_block_shb_query_no_results_block_init()
{
	register_block_type_from_metadata(
		__DIR__ . '/build',
		array(
			'render_callback' => 'render_block_shb_query_no_results',
		)
	);
}
add_action('init', 'create_block_shb_query_no_results_block_init');
