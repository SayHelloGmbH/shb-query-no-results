import { registerBlockType } from "@wordpress/blocks";

/**
 * Internal dependencies
 */
import edit from "./edit";
import save from "./save";

registerBlockType("shb/shb-query-no-results", {
	edit,
	save,
});
