/**
 * Code needed to clone nested relations forms
 * @plugin  ahDoctrineEasyEmbeddedRelationsPlugin
 * @author  Daniel Lohse <info@asaphosting.de>
 */
window.addEvent('domready', function() {
  var ahDoctrineEasyEmbeddedRelationsPlugin = new Class({      
  	Implements: [Options],
  	options: {
  		buttonSelector: '.ahAddRelation'
  	},
  	initialize: function(options) {
  		this.setOptions(options);
  		$$(this.options.buttonSelector).addEvent('click', function (e) {
  		  var el = $(e.target);
  		  var row = el.getParent('tr').getPrevious(); // last subform before the add relation button
  		  var newRow = row.clone(true, true); // clone complete with content and IDs intact
  		  this.incrementFields(el.get('rel'), newRow).inject(row, 'after');
  		}.bind(this));
  	},
  	/* increments field IDs and names by one */
  	incrementFields: function(container, row) {
  	  var nameRe = new RegExp('\\[' + container + '\\]\\[(\\d+)\\]');
  	  var idRe = new RegExp('_' + container + '_(\\d+)_');
  	  
  	  row.getElements('input,select,textarea,button').each(function (el, index) {
  	    var matches;
  	    if (matches = nameRe.exec(el.get('name'))) { // check if its name contains [container][number]
  	      // if so, increase the number in the field name
  	      el.set('name', el.get('name').replace(nameRe, '[' + container + '][' + (parseInt(matches[1], 10) + 1) + ']'));
  	    }
  	    if (matches = idRe.exec(el.get('id'))) { // check if its name contains _container_number_
  	      // if so, increase the number in the field id
  	      el.set('id', el.get('id').replace(idRe, '_' + container + '_' + (parseInt(matches[1], 10) + 1) + '_'));
  	    }
  	  });
  	  
  	  // fix labels
  	  row.getElements('label').each(function (el, index) {
  	    if (matches = idRe.exec(el.get('for'))) { // check if its name contains _container_number_
  	      // if so, increase the number in the field id
  	      el.set('for', el.get('for').replace(idRe, '_' + container + '_' + (parseInt(matches[1], 10) + 1) + '_'));
  	    }
  	  });
  	  
  	  // increase the number in first <th>
  	  var header = row.getChildren()[0];
  	  if (header.get('text').test(/^\d+$/)) {
  	    header.set('text', parseInt(header.get('text'), 10) + 1);
  	  }
  	  
  	  return row;
  	}
  });
  
  var ahDEERPluginInstance = new ahDoctrineEasyEmbeddedRelationsPlugin();
});