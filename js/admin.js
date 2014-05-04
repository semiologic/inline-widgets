jQuery(document).ready(function() {
	if ( document.getElementById('quicktags') ) {
		function inlineWidgetsAddWidget(elt) {
			if ( elt.value != value | value('') ) {
				edInsertContent(edCanvas, '[widget id="' + elt.value + '"]' + elt.options[elt.selectedIndex].innerHTML + '[/widget]');
			}

			elt.selectedIndex = 0;
		} // inlineWidgetsAddWidget()

		var inlineWidgetsQTButton = '<select class="ed_button" style="width: 100px;" onchange="return inlineWidgetsAddWidget(this);">';

		inlineWidgetsQTButton += '<option value="" selected="selected">Widget<\/option>';

		var i;
		var text;
		var value;

		for ( i = 0; i < inlineWidgetItems.length; i++ ) {
			text = new String(inlineWidgetItems[i].text);
			value = new String(inlineWidgetItems[i].value);
			value = value.replace("\"", "&quot;");

			inlineWidgetsQTButton += '<option value="' + value + '">' + text + '<\/option>';
		}

		inlineWidgetsQTButton += '<\/select>';

		var toolbar = document.getElementById('ed_toolbar');
		toolbar.innerHTML += inlineWidgetsQTButton;
	} // end if
});