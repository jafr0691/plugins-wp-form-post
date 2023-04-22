(function($) {
    let touchEvent = 'ontouchstart' in window ? 'touchstart' : 'click';
    if (document.getElementById("btnformpostclick")) {
        document.getElementById("btnformpostclick").addEventListener(touchEvent, function(e) {
            var dataformpost = jQuery("#acction-form-post").serialize();
            console.log(dataformpost);
            $.ajax({
                url: sendformpost.ajaxurl,
                type: "post",
                data: dataformpost + '&action=sendformpost',
                beforeSend: function() {
                    document.getElementById("formpostcargar").style.display = "block";
                },
                success: function(d) {
                    da = JSON.parse(d);
                    if (da['result']) {
                        jQuery("#msgformpost").html(da['msgs']);
                    } else {
                        jQuery("#msgformpost").html(da['msgs']);
                    }
                    setTimeout(function() {
                        jQuery("#msgformpost").empty();
                    }, 10000);
                    document.getElementById("formpostcargar").style.display = "none";
                }
            });
            e.preventDefault();
        });
    }
})(jQuery);