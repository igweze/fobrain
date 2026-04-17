<?php  
	$fobrainDir = '../';		 		
	require_once '../fobrain-box.php';
	//$not_install_script = $fobrainPortalRoot.'101'; 

	if(($fobrainPortalRoot == "") || ($fobrainDB == "")) { 
		//echo "<script type='text/javascript'> window.location.href = '$not_install_script';</script>"; exit;
  
$installScript =<<<IGWEZE
        
		<meta http-equiv="refresh" content="0;URL='./install/'" />
	
IGWEZE;
	
		echo $installScript;			 
		exit;	 
		 
	}
?>
