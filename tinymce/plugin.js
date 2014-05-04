/**
 * Created by michaelkoepke on 5/3/14.
 */


tinymce.PluginManager.add('inline_widgets', function(editor) {

	function getValues() {
        return document.inlineWidgetItems;
    }

	editor.addButton('inline_widgets', {
     type: 'listbox',
     text: 'Widgets',
     icon: false,
	 classes: 'fixed-width btn widget',
     onselect: function(e) {

		if ( this.value() != 'inline_widget_help' ) {
			var widget = '[widget id="' + this.value() + '"]' + this.value() + '[/widget]';

			editor.insertContent(widget);
		}
		// reset selected value
	     this.value(null);
     },
     values: getValues()
    });
});
