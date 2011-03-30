$(function() {
    $( "#login_dialog" ).dialog({
        autoOpen: false,
        modal: true,
        open: function ()
        {
            $(this).load('/demofony/loginAjax');
        },
        height: 400,
        width: 600,
        title: 'Login'
    });
     
    $(".login_opener").click(function() {
       $("#login_dialog").dialog("open");
       return false;
    });
});
