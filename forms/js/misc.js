jQuery(document).ready(function() {
var page = window.location.pathname;
var splits = page.split("/");
var length = splits.length;
var res = splits[length-1];

jQuery("a.active").removeClass("active");

jQuery("a").each(function(){
    //do something with the element here.
    var href = jQuery(this).attr("href");
    if (href === page) {
        jQuery(this).addClass("active");
    }
});
});
