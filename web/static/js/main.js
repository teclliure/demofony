$(document).ready(function(){

	var map = function(div){
		div = $(div);
		if(div.length){
	    	var myLatlng = new google.maps.LatLng(38.909469,1.433458);
			var myOptions = {
					zoom: 14,
					center: myLatlng,
					mapTypeId: google.maps.MapTypeId.SATELLITE
			};
	    	var map = new google.maps.Map(div[0], myOptions);
	    }
	}
	
	map("#map_canvas");
	map("#profile-map");
	map("body.ficha div.map");
    map("body.ficha div.comments-by-area div.map");
    
    $("input.date").datepicker();
    
    $("div.box:has(ul.tabs)").tabs();
    
    $("div.box ul.tabs li").each(function(){
		var b = $(this).find("b")
			b.css("marginTop", ($(this).find("a").height() / 2) - (b.height() / 2) - 7);
	});
	
	$("#perfil form.add-comment").find("a.add").click(function(){
		$(this).next().show().find("textarea").focus();
		return false;
	}).end().find("a.cancel").click(function(){
		$(this).parent().hide();
		return false;
	})

	/*$("#container li.user a").modal({
		load: "signup.php",
		finish: function(div){
		}
	}).click();*/

	/*var tabs = $("div.box ul.tabs")
	if(tabs.length){
		tabs.each(function(){
			var li = $("li", this);
			li.click(function(){
				if($(this).hasClass("on")) return false;
				var index = li.removeClass("on").index($(this).addClass("on"));
				$(this).parents("div.box").find("div.box-content").hide().eq(index).fadeIn();
				return false;
			}).each(function(){
				var b = $(this).find("b")
					b.css("marginTop", ($(this).find("a").height() / 2) - (b.height() / 2) - 7);
			}).eq(0).click();
		});
	}*/

    
       
}); 