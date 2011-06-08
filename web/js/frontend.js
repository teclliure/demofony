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
  
  $(".toggler-next").live("click", function(){
  	$(this).next().toggle().find("textarea,input").first().focus();
  	return false;
  })
  
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
  
	$("div.box-title a.toggler").click(function(){
		var $t = $(this);
		$t.html($t.text() == "-" ? "+" : "-").parents("div.box-title:first").next().toggle();
		return false;
	}).filter(".show").click();
    
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
  
  $('.qtip_launch').qtip({
    metadata: {
       type: 'html5', // Use HTML5 data-* attributes
       name: 'qtipopts' // Grab the metadata from the data-qtipOpts HTML5 attribute
    },
    content: {
      text: function(api) {
         // Retrieve content from custom attribute of the $('.selector') elements.
         return $(this).attr('qtip-content');
      }
    }
    // content: 'I\'m using HTML5 to set my style... so so trendy.'
  });
  
	var interviewsDivs = $("#home div.entrevistas div.box-content");
		interviewsDivs.eq(0).show();
	var interviewsNavStatus = $("#home div.entrevistas div.nav span").html("1/" + interviewsDivs.length);
	$("#home div.entrevistas div.nav a").click(function(){
		var prev = $(this).hasClass("prev");
		var curr = interviewsDivs.index(interviewsDivs.filter(":visible"));
		if(prev){
			if(curr == 0)
				return false;
			curr--;
		}else{
			if(curr == (interviewsDivs.length - 1))
				return false;
			curr++;
		}	
		interviewsNavStatus.html((curr + 1) + "/" + interviewsDivs.length);
		interviewsDivs.hide().eq(curr).show();
		return false;
	})
  
});



