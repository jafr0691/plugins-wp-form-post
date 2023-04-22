(function($) {
    let touchEvent = 'ontouchstart' in window ? 'touchstart' : 'click';
    for (var i = 0; i <= document.querySelectorAll('#listfp').length - 1; i++) {
        document.querySelectorAll(".deletfp")[i].addEventListener(touchEvent, msjdeletfp);
    }

    function msjdeletfp(e) {
        var nombre = e.target.getAttribute('data-namefp');
        var id = e.target.getAttribute('data-idfp');
        document.getElementById('titlemsjdeletfp').innerHTML = '<strong>' + nombre + '</strong>';
        document.getElementById('mensajedeletfp').innerHTML = 'Desea eliminar Contacto <strong>' + nombre + '</strong>?';
        document.getElementById('btnmodaldeletfp').innerHTML = '<button class="btn btn-default rounded" style="position: absolute; left:30px; bottom: 10px;" id="btndeletfp" data-dismiss="modal" data-idfp="' + id + '">Eliminar <span class="text-danger glyphicon glyphicon-trash"></span></button>';
        document.getElementById('btndeletfp').addEventListener(touchEvent, deletfp);
    }

    function deletfp() {
        var id = document.getElementById('btndeletfp').getAttribute('data-idfp');
        jQuery.ajax({
            url: sqlformpost.sqlajaxurl,
            type: "post",
            data: {
                action: 'sqlformpost',
                acti: 'delet',
                id: id
            },
            success: function(d) {
                if (d) {
                    document.getElementById('deletfp' + id).parentElement.parentElement.remove();
                }
            }
        });
    }
    jQuery("#fpsqlphpmailer").on(touchEvent, function(e) {
        var dataphpmailer = jQuery("#formphpmailerfp").serialize();
        jQuery.ajax({
            url: sqlformpost.sqlajaxurl,
            type: "post",
            data: dataphpmailer + '&action=sqlformpost&acti=phpmailer',
            beforeSend: function() {
                jQuery('#fpcargarmailer').css('display', 'inline-block');
            },
            success: function(dato) {
                if (dato) {
                    alert("Se guardaron los cambios.");
                    jQuery("#Modalfpmailer").modal("hide");
                    jQuery("#btnfpmailer").text("Ajustar Email: " + jQuery("#fpsetfrom").val());
                } else {
                    alert("Error: no se logro guardar los cambios");
                }
                jQuery('#fpcargarmailer').css('display', 'none');
            }
        });
        e.preventDefault();
    });
    jQuery("#fpsqlstyle").on(touchEvent, function(e) {
        var datastyle = jQuery("#formstylefp").serialize();
        jQuery.ajax({
            url: sqlformpost.sqlajaxurl,
            type: "post",
            data: datastyle + '&action=sqlformpost&acti=styleform',
            beforeSend: function() {
                jQuery('#fpcargarstyle').css('display', 'inline-block');
            },
            success: function(dato) {
                if (dato) {
                    alert("Se guardaron los cambios.");
                    jQuery("#Modalfpstyle").modal("hide");
                } else {
                    alert("Error: no se logro guardar los cambios");
                }
                jQuery('#fpcargarstyle').css('display', 'none');
            }
        });
        e.preventDefault();
    });
})(jQuery);