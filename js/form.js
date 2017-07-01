$(document).ready(function(){
    $("input[type=text]").focusin(function() {
        $(this).css("border","1px solid #63A9FF");
    });
     $("input[type=date]").focusin(function() {
        $(this).css("border","1px solid #63A9FF");
    });
     $("input[type=email]").focusin(function() {
        $(this).css("border","1px solid #63A9FF");
    });
    $("input[type=text]").focusout(function() {
        $(this).css("border","1px solid #a0a0a0");
    });
     $("input[type=date]").focusout(function() {
        $(this).css("border","1px solid #a0a0a0");
    });
     $("input[type=email]").focusout(function() {
        $(this).css("border","1px solid #a0a0a0");
    });
});