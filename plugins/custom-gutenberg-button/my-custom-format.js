// inline code
( function( wp ) {
	var inlineCodeButton = function( props ) {
		return wp.element.createElement(
			wp.editor.RichTextToolbarButton, {
				icon: 'editor-code',
				title: 'Inline code',
				onClick: function() {
					props.onChange( wp.richText.toggleFormat(
						props.value,
						{ type: 'my-custom-format/inline-code-button' }
					) );
				},
				isActive: props.isActive,
			}
		);
	}
	wp.richText.registerFormatType(
		'my-custom-format/inline-code-button', {
			title: 'Insert an inline code',
			tagName: 'code',
			className: null,
			edit: inlineCodeButton,
		}
	);
} )( window.wp );

// kbd button
( function( wp ) {
	var keyboardButton = function( props ) {
		return wp.element.createElement(
			wp.editor.RichTextToolbarButton, {
				icon: 'editor-removeformatting',
				title: 'Keyboard button',
				onClick: function() {
					props.onChange( wp.richText.toggleFormat(
						props.value,
						{ type: 'my-custom-format/keyboard-button' }
					) );
				},
				isActive: props.isActive,
			}
		);
	}
	wp.richText.registerFormatType(
		'my-custom-format/keyboard-button', {
			title: 'Keyboard button',
			tagName: 'kbd',
			className: null,
			edit: keyboardButton,
		}
	);
} )( window.wp );

// mark button
( function( wp ) {
	var markButton = function( props ) {
		return wp.element.createElement(
			wp.editor.RichTextToolbarButton, {
				icon: 'flag',
				title: 'Highlight button',
				onClick: function() {
					props.onChange( wp.richText.toggleFormat(
						props.value,
						{ type: 'my-custom-format/mark-button' }
					) );
				},
				isActive: props.isActive,
			}
		);
	}
	wp.richText.registerFormatType(
		'my-custom-format/mark-button', {
			title: 'Highlight button',
			tagName: 'mark',
			className: null,
			edit: markButton,
		}
	);
} )( window.wp );

// big number button
( function( wp ) {
	var bbtButton = function( props ) {
		return wp.element.createElement(
			wp.editor.RichTextToolbarButton, {
				icon: 'awards',
				title: 'Big number button',
				onClick: function() {
					props.onChange( wp.richText.toggleFormat(
						props.value,
						{ type: 'my-custom-format/bbt-button' }
					) );
				},
				isActive: props.isActive,
			}
		);
	}
	wp.richText.registerFormatType(
		'my-custom-format/bbt-button', {
			title: 'Big number button',
			tagName: 'bbt',
			className: null,
			edit: bbtButton,
		}
	);
} )( window.wp );


// pink text
( function( wp ) {
	var pinkButton = function( props ) {
		return wp.element.createElement(
			wp.editor.RichTextToolbarButton, {
				icon: 'admin-customizer',
				title: 'Pink text',
				onClick: function() {
					props.onChange( wp.richText.toggleFormat(
						props.value,
						{ type: 'my-custom-format/pink-button' }
					) );
				},
				isActive: props.isActive,
			}
		);
	}
	wp.richText.registerFormatType(
		'my-custom-format/pink-button', {
			title: 'Pink text',
			tagName: 'tpink',
			className: null,
			edit: pinkButton,
		}
	);
} )( window.wp );


// green text
( function( wp ) {
	var greenButton = function( props ) {
		return wp.element.createElement(
			wp.editor.RichTextToolbarButton, {
				icon: 'admin-appearance',
				title: 'Green text',
				onClick: function() {
					props.onChange( wp.richText.toggleFormat(
						props.value,
						{ type: 'my-custom-format/green-button' }
					) );
				},
				isActive: props.isActive,
			}
		);
	}
	wp.richText.registerFormatType(
		'my-custom-format/green-button', {
			title: 'Green text',
			tagName: 'tgreen',
			className: null,
			edit: greenButton,
		}
	);
} )( window.wp );