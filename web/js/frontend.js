$(function() {
  if ($(".login_opener").length){
    $("#login_dialog").dialog({
        autoOpen: false,
        modal: true,
        open: function ()
        {
            $(this).load(login_url);
            $(this).find("input:first").focus();
        },
        draggable: false,
        width: 450,
        dialogClass: 'dialog-modal',       
        title: login_title
    });
     
    $(".login_opener").click(function() {
       $("#login_dialog").dialog("open");
       return false;
    });
  }  
  
  /*
  $("#home div.crear a.button1").click(function(){
		var dialog = $("#modal-accio").dialog({
			autoOpen: false,
			modal: true,
			width: 200,
			dialogClass: 'dialog-modal',
			draggable: false,
			open: function(){
			}
		}).dialog("open");
	})
  */
    
  if ($(".select_content").length){
    $("#select_content").dialog({
      autoOpen: false,
      modal: true,
      open: function ()
      {
          $(this).load(select_content_url);
      },
      draggable: false,
      width: 200,
      dialogClass: 'dialog-modal',
      title: select_content_title
    });
     
    $(".select_content").click(function() {
       $("#select_content").dialog("open");
       return false;
    });
  }
  
  jQuery('form').uniform();
});
//Author: Ilija Studen for the purposes of Uni–Form

jQuery.fn.uniform = function(settings) {
  settings = jQuery.extend({
    focused_class  : 'focused',
    holder_class   : 'ctrlHolder',
    field_selector : 'input, select, textarea'
  }, settings);
  
  return this.each(function() {
    var form = jQuery(this);
    
    // Focus specific control holder
    var focusControlHolder = function(element) {
      var parent = element.parent();
      
      while(typeof(parent) == 'object') {
        if(parent) {
          if(parent[0] && (parent[0].className.indexOf(settings.holder_class) >= 0)) {
            parent.addClass(settings.focused_class);
            return;
          } // if
        } // if
        parent = jQuery(parent.parent());
      } // while
    };
    
    // Select form fields and attach them higlighter functionality
    form.find(settings.field_selector).focus(function() {
      form.find('.' + settings.focused_class).removeClass(settings.focused_class);
      focusControlHolder(jQuery(this));
    }).blur(function() {
      form.find('.' + settings.focused_class).removeClass(settings.focused_class);
    });
  });
};