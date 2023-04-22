<?php
/****************** Crear tabla con la clase wpdb *****************/
global $wpdb;

// Con esto creamos el nombre de la tabla y nos aseguramos que se cree con el mismo prefijo que ya tienen las otras tablas creadas (wp_form).
$table_contacformpost    = $wpdb->prefix . 'fp_contacformpost';
$table_fpphpmailer    = $wpdb->prefix . 'fp_phpmailer';
$table_fpstyleform    = $wpdb->prefix . 'fp_styleform';

$sql = "CREATE TABLE $table_contacformpost (
`id_cfp` int(11) NOT NULL AUTO_INCREMENT,
`nombre` varchar(100) NOT NULL,
`email` varchar(100) NOT NULL,
`pregunta` text NULL NULL,
`numero` varchar(20) NOT NULL,
`fecha` varchar(20) NOT NULL,
`hora` varchar(11) NOT NULL,
`url` varchar(200) NOT NULL,
UNIQUE KEY id_cfp (id_cfp)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE $table_fpphpmailer (
`id` int(11) NOT NULL,
`setfrom` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
UNIQUE KEY id (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE $table_fpstyleform (
`id` int(11) NOT NULL,
`colorfondo` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
`colorfondoinput` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
`colortext` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
`colorbtn` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
`tipoletra` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
`position` int(11) NOT NULL,
UNIQUE KEY id (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


INSERT INTO $table_fpphpmailer (`id`, `setfrom`) VALUES
(1, 'contacto@lexum.cl');

INSERT INTO $table_fpstyleform (`id`, `colorfondo`, `colorfondoinput`, `colortext`, `colorbtn`, `tipoletra`,`position`) VALUES
(1, '#1d22c4', '#0b10ac', '#ffffff', '#ff9d00', 'apple-system,BlinkMacSystemFont,Segoe UI,Roboto,Helvetica Neue,Arial,Noto Sans,sans-serif',2);";

// upgrade contiene la función dbDelta la cuál revisará si existe la tabla.
require_once ABSPATH . 'wp-admin/includes/upgrade.php';
// Creamos la tabla
dbDelta($sql);