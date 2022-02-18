/**
 * WordPress dependencies
 */
import { useBlockProps, useInnerBlocksProps } from "@wordpress/block-editor";

const TEMPLATE = [
	[
		"core/paragraph",
		{
			placeholder:
				"Add blocks here, which will be displayed if there are no results found…",
		},
	],
];

export default function edit() {
	const blockProps = useBlockProps();
	const innerBlocksProps = useInnerBlocksProps(blockProps, {
		template: TEMPLATE,
	});
	return (
		<>
			<div {...innerBlocksProps} />
		</>
	);
}
