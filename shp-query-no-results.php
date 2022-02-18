<?php

/**
 * Plugin Name:       Query No Results
 * Description:       Provides a block wrapper for elements which should be displayed when there are no resutls found in a query loop block.
 * Requires at least: 5.8
 * Requires PHP:      7.0
 * Version:           0.1.0
 * Author:            Say Hello GmbH
 * License:           GPL-2.0-or-later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       shb-query-no-results
 *
 * @package           shb
 */

/**
 * Registers the block using the metadata loaded from the `block.json` file.
 * Behind the scenes, it registers also all assets so they can be enqueued
 * through the block editor in the corresponding context.
 *
 * @see https://developer.wordpress.org/reference/functions/register_block_type/
 */
function create_block_shb_query_no_results_block_init()
{
	register_block_type(__DIR__ . '/build');
}
add_action('init', 'create_block_shb_query_no_results_block_init');
