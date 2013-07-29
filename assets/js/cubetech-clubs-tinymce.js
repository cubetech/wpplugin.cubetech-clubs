tinymce.create( 
	'tinymce.plugins.cubetech_clubs', 
	{
	    /**
	     * @param tinymce.Editor editor
	     * @param string url
	     */
	    init : function( editor, url ) {
			/**
			*  register a new button
			*/
			editor.addButton(
				'cubetech_clubs_button', 
				{
					cmd   : 'cubetech_clubs_button_cmd',
					title : editor.getLang( 'cubetech_clubs.buttonTitle', 'cubetech Vereinsliste' ),
					image : url + '/../img/toolbar-icon.png'
				}
			);
			/**
			* and a new command
			*/
			editor.addCommand(
				'cubetech_clubs_button_cmd',
				function() {
					/**
					* @param Object Popup settings
					* @param Object Arguments to pass to the Popup
					*/
					editor.windowManager.open(
						{
							// this is the ID of the popups parent element
							id       : 'cubetech_clubs_dialog',
							width    : 480,
							title    : editor.getLang( 'cubetech_clubs.popupTitle', 'cubetech Vereinsliste' ),
							height   : 'auto',
							wpDialog : true,
							display  : 'block',
						},
						{
							plugin_url : url
						}
					);
				}
			);
		}
	}
);

// register plugin
tinymce.PluginManager.add( 'cubetech_clubs', tinymce.plugins.cubetech_clubs );