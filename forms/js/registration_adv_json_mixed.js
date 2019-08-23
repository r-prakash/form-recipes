jQuery(document).ready(function() {
    jQuery("body .contents").on("click", "#register_button", function() {
        var f_data = {};
        jQuery(":input").each(function() {
            var type = jQuery(this).attr("type");
            var name = jQuery(this).attr("name");
            var value;
            if (type === "radio") {
                var checked = jQuery(this).attr("checked");
                if (checked === "checked") {
                    value = jQuery(this).val();
                    f_data[name] = value;
                }
            }
            else if (type === "button") {
                return;
            }
            else {
                value = jQuery(this).val();
                f_data[name] = value;
            }
        }); 
        var form_data = {};
        form_data["register"] = "Register";
        form_data["user_details"] = JSON.stringify(f_data);

        // Ajax Request to post this data
        var url = "/forms/php_scripts/form_processing_ajax_json_mixed.php";
        jQuery.ajax({
            "url": url,
            "type": "POST",
            "dataType" : "json",
            //"contentType": "application/json",
            "cache" : false,
            "data": form_data,
            "timeout": 60000,
            "success": function(data, textStatus, jqXHR) {
               console.log(data); 
               console.log(textStatus); 
               //alert("Psosted Successfully.");
               if (data.success === true) {
                   window.location = "/forms/thank-you.html";
               }
               else {
                   window.location = "/forms/error.html";
               }
            },
            "error": function(jqXHR, textStatus, errorThrown) {
                alert("There was a problem registering, refresh the page and try again.");
            }
        });
    });
});

