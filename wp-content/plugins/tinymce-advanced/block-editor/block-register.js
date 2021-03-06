( function( wp, _ ) {
	if ( ! wp ) {
		return;
	}

	/**
	 * WordPress dependencies
	 */
	const { RawHTML, Component, createElement } = wp.element;
	const { __, _x } = wp.i18n;
	const { Path, Rect, SVG } = wp.components;
	const { BACKSPACE, DELETE, F10 } = wp.keycodes;
	const { addFilter } = wp.hooks;
	const { registerBlockType, setDefaultBlockName } = wp.blocks;

	addFilter( 'blocks.registerBlockType', 'tadv-reregister-block', function ( settings, name ) {
		if ( name === 'core/paragraph' ) {
			settings = settingsParagraph;
		} else if ( name === 'core/freeform' ) {
			settings = settingsClassic;
		} else if ( name === 'core/video' ) {
			// Ughhhhh :-(
			setTimeout( function() {
				setDefaultBlockName( 'core/freeform' );
			}, 0 );
		}

		return settings;
	} );

	function isTmceEmpty( editor ) {
		const body = editor.getBody();
		
		if ( body.childNodes.length > 1 ) {
			return false;
		} else if ( body.childNodes.length === 0 ) {
			return true;
		}
		
		if ( body.childNodes[ 0 ].childNodes.length > 1 ) {
			return false;
		}
		
		return /^\n?$/.test( body.innerText || body.textContent );
	}

	class ClassicEdit extends Component {
		constructor( props ) {
			super( props );
			this.initialize = this.initialize.bind( this );
			this.onSetup = this.onSetup.bind( this );
			this.focus = this.focus.bind( this );
		}

		componentDidMount() {
			const { baseURL, suffix } = window.wpEditorL10n.tinymce;

			window.tinymce.EditorManager.overrideDefaults( {
				base_url: baseURL,
				suffix,
			} );

			if ( document.readyState === 'complete' ) {
				this.initialize();
			} else {
				window.addEventListener( 'DOMContentLoaded', this.initialize );
			}
		}

		componentWillUnmount() {
			window.addEventListener( 'DOMContentLoaded', this.initialize );
			wp.oldEditor.remove( `editor-${ this.props.clientId }` );
		}

		componentDidUpdate( prevProps ) {
			const { clientId, attributes: { content } } = this.props;

			const editor = window.tinymce.get( `editor-${ clientId }` );

			if ( prevProps.attributes.content !== content && this.content !== content ) {
				editor.setContent( content || '' );
			}
		}

		initialize() {
			const { clientId, setAttributes } = this.props;
			const { settings } = window.wpEditorL10n.tinymce;
			wp.oldEditor.initialize( `editor-${ clientId }`, {
				tinymce: {
					...settings,
					inline: true,
					content_css: false,
					fixed_toolbar_container: `#toolbar-${ clientId }`,
					setup: this.onSetup,
				},
			} );

			setAttributes( {
				tadvType: 'classic',
			} );
		}

		onSetup( editor ) {
			const { attributes: { content }, setAttributes } = this.props;
			const { ref } = this;
			let bookmark;

			this.editor = editor;

			if ( content ) {
				editor.on( 'loadContent', () => editor.setContent( content ) );
			}

			editor.on( 'blur', () => {
				bookmark = editor.selection.getBookmark( 2, true );
				this.content = editor.getContent();

				setAttributes( {
					content: this.content,
				} );

				editor.once( 'focus', () => {
					if ( bookmark ) {
						editor.selection.moveToBookmark( bookmark );
					}
				} );

				return false;
			} );

			editor.on( 'mousedown touchstart', () => {
				bookmark = null;
			} );

			editor.on( 'keydown', ( event ) => {
				if ( ( event.keyCode === BACKSPACE || event.keyCode === DELETE ) && isTmceEmpty( editor ) ) {
					// delete the block
					this.props.onReplace( [] );
					event.preventDefault();
					event.stopImmediatePropagation();
				}

				const { altKey } = event;
				/*
				 * Prevent Mousetrap from kicking in: TinyMCE already uses its own
				 * `alt+f10` shortcut to focus its toolbar.
				 */
				if ( altKey && event.keyCode === F10 ) {
					event.stopPropagation();
				}
			} );

			editor.on( 'init', () => {
				const rootNode = this.editor.getBody();

				// Create the toolbar by refocussing the editor.
				if ( document.activeElement === rootNode ) {
					rootNode.blur();
					this.editor.focus();
				}
			} );
		}

		focus() {
			if ( this.editor ) {
				this.editor.focus();
			}
		}

		onToolbarKeyDown( event ) {
			// Prevent WritingFlow from kicking in and allow arrows navigation on the toolbar.
			event.stopPropagation();
			// Prevent Mousetrap from moving focus to the top toolbar when pressing `alt+f10` on this block toolbar.
			event.nativeEvent.stopImmediatePropagation();
		}

		render() {
			const { clientId } = this.props;

			return [
				createElement( 'div', {
					key: "toolbar",
					id: `toolbar-${ clientId }`,
					ref: ( ref ) => this.ref = ref,
					className: "block-library-classic__toolbar",
					onClick: this.focus,
					'data-placeholder': __( 'Classic' ),
					onKeyDown: this.onToolbarKeyDown,
				} ),
				createElement( 'div', {
					key: "editor",
					id: `editor-${ clientId }`,
					className: "wp-block-freeform block-library-rich-text__tinymce",
				} ),
			];
		}
	}

	const settings = {
		keywords: [ __( 'text' ) ],

		description: __( 'Use the classic WordPress editor.' ),

		icon: createElement( SVG, { viewBox: "0 0 24 24", xmlns: "http://www.w3.org/2000/svg" },
			createElement( Path, { d: "M0,0h24v24H0V0z M0,0h24v24H0V0z", fill: "none" } ),
			createElement( Path, { d: "m20 7v10h-16v-10h16m0-2h-16c-1.1 0-1.99 0.9-1.99 2l-0.01 10c0 1.1 0.9 2 2 2h16c1.1 0 2-0.9 2-2v-10c0-1.1-0.9-2-2-2z" } ),
			createElement( Rect, { x: "11", y: "8", width: "2", height: "2" } ),
			createElement( Rect, { x: "11", y: "11", width: "2", height: "2" } ),
			createElement( Rect, { x: "8", y: "8", width: "2", height: "2" } ),
			createElement( Rect, { x: "8", y: "11", width: "2", height: "2" } ),
			createElement( Rect, { x: "5", y: "11", width: "2", height: "2" } ),
			createElement( Rect, { x: "5", y: "8", width: "2", height: "2" } ),
			createElement( Rect, { x: "8", y: "14", width: "8", height: "2" } ),
			createElement( Rect, { x: "14", y: "11", width: "2", height: "2" } ),
			createElement( Rect, { x: "14", y: "8", width: "2", height: "2" } ),
			createElement( Rect, { x: "17", y: "11", width: "2", height: "2" } ),
			createElement( Rect, { x: "17", y: "8", width: "2", height: "2" } )
		),

		attributes: {
			content: {
				type: 'string',
				source: 'html',
			},
			tadvType: {
				type: 'string',
				default: '',
			},
		},

		supports: {
			className: false,
			customClassName: false,
			reusable: false,
		},

		merge( attributes, attributesToMerge ) {
			return {
				content: attributes.content + attributesToMerge.content,
			};
		},

		transforms: {
			from: [
				{
					type: 'raw',
					priority: 15,
					selector: '*',
				},
			],
			to: [
				{
					type: 'raw',
					blocks: [ 'core/freeform' ],
					transform: ( { content } ) => {
						return createBlock( 'core/freeform', {
							content,
						} );
					},
				},
			],
		},

		edit: ClassicEdit,

		save( { attributes } ) {
			const { content } = attributes;

			return createElement( RawHTML, null, content );
		},
	};

	const settingsClassic = _.assign( {}, settings, {
		title: _x( 'Classic', 'block title' ),
		name: 'core/freeform',
		category: 'formatting',
	} );

	const settingsParagraph = _.assign( {}, settings, {
		title: __( 'Classic Paragraph' ),
		name: 'core/paragraph',
		category: 'common',
	} );

//	registerBlockType( 'core/paragraph', settingsParagraph );
//	registerBlockType( 'core/freeform', settingsClassic );

} )( window.wp, window.lodash );
