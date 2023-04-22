<?php 
global $wpdb;
if($_POST['acti']=='delet'){
	$delet = $wpdb->delete($wpdb->prefix . 'fp_contacformpost', array('id_cfp' => $_POST['id']));

	exit(true);
}else if($_POST['acti']=='phpmailer'){

try {
	$regemail = '/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/';
	if(!preg_match($regemail, $_POST['setfrom'])){
	    exit(false);
	}
		$wpdb->update($wpdb->prefix . "fp_phpmailer",
			array('setfrom'=>$_POST['setfrom']),
            array(
                'id' => 1,
            )
            
        );
	exit(true);

} catch (Exception $e) {
	exit(false);
}
	
	
}else if($_POST['acti']=='styleform'){
	if (empty($_POST['fptipoletra']) or empty($_POST['fpposition'])) {
		exit(false);
	}

try {
	$wpdb->update($wpdb->prefix . "fp_styleform",
		array('colorfondo' => $_POST['fpcolorfondo'],
			'colorfondoinput' => $_POST['fpcolorfondoinput'],
        	'colortext'=>$_POST['fpcolortext'],
        	'colorbtn'=>$_POST['fpcolorbtn'],
		'tipoletra'=>$_POST['fptipoletra'],
		'position'=>$_POST['fpposition']),
        array(
            'id' => 1,
        )
        
    );

	exit(true);

} catch (Exception $e) {
	exit(false);
}
	
	
}


 ?>