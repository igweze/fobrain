<?php

/* 
	------------------------------------------------------------------------	  
	Copyright (C) foBrain Tech LTD (Igweze Ebele Mark) 2010 - 2026.

	Licensed under the Apache License, Version 2.0 (the 'License');
	you may not use this file except in compliance with the License.
	You may obtain a copy of the License at

	http://www.apache.org/licenses/LICENSE-2.0

	Unless required by applicable law or agreed to in writing, software
	distributed under the License is distributed on an 'AS IS' BASIS,
	WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
	See the License for the specific language governing permissions and
	limitations under the License		 
	------------------------------------------------------------------------ 
	foBrain Open Source & wizGrade Open Source App is designed & developed 
	by Igweze Ebele Mark for foBrain Tech LTD

	foBrain School App is Dedicated To Almighty God, My Amazing Parents, 
	To My Fabulous and Supporting Wife Nkiruka J.
	To My Inestimable Kids Osinachi, Ifechukwu, Naetochukwu & Chimamanda.  
	------------------------------------------------------------------------
	WEBSITE 					PHONES/WHATSAPP			EMAILS
	https://www.fobrain.com		+234 - 80 30 716 751  	igweze@fobrain.com	 
	https://www.fobrain.ng		+234 - 80 22 000 490	support@fobrain.com 
	------------------------------------------------------------------------	
		
*/ 

if(!session_id()){
    session_start();
}

        define('fobrain', 'igweze');  /* define a check for wrong access of file */

        require 'fobrain-config.php';  /* load fobrain configuration files */	 
		 
		 try { 

            $levelArray = studentLevelsArray($conn); /* student level array */
            $clArray_fi = studentClassArray($conn, $fiVal); /* retrieve student class array */
            $clArray_se = studentClassArray($conn, $seVal); /* retrieve student class array */
            $clArray_th = studentClassArray($conn, $thVal); /* retrieve student class array */
            $clArray_fo = studentClassArray($conn, $foVal); /* retrieve student class array */
            $clArray_fif = studentClassArray($conn, $fifVal); /* retrieve student class array */
            $clArray_six = studentClassArray($conn, $sixVal); /* retrieve student class array */
            $classArray_fi = unserialize($clArray_fi);
            $classArray_se = unserialize($clArray_se);
            $classArray_th = unserialize($clArray_th);
            $classArray_fo = unserialize($clArray_fo);
            $classArray_fif = unserialize($clArray_fif);
            $classArray_six = unserialize($clArray_six); 
								
		}catch(PDOException $e) {
  			
			fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
			 
		} 
?>		
					
		<!-- row -->
		<div <?php echo $fob_view; ?> class="row gutters row-section fobrain-section-div justify-content-center">
			<div class="col-12">	
				<!-- card start -->
				<div class="card card-shadow"> 
					<?php 
						$page_title = '<i class="mdi mdi-google-classroom fs-18"></i> 
							Customise Class Names';
						pageTitle($page_title, 0);	 
					?>  
					<div id="msg-box"></div> 					
					<div class="card-body">
                        <div class="row gutters mb-15">
                            <div class="hints">[<i class="mdi mdi-help-circle-outline"></i>] Customise Class name below E.g Eagle, Diamond, Amanda</div>
                        </div>
						<!-- form -->
						<form class="form-horizontal" id="frmclassSettings" role="form">


							<!-- row -->
							<div class="row gutters mt-30"> 
                                <h4><?php echo $levelArray[0]['level']; ?> Classes </h4>
                                
								<div class="col-xl-2 col-lg-2 col-md-6 col-sm-6 col-6">										
									<!-- field wrapper start -->
									<div class="field-wrapper">
                                        <input type="text"  name="class_1[]" 
                                        value ="<?php echo $classArray_fi[0]; ?>"
                                        class="form-control" placeholder="A, Amanda, Eagle" > 
									</div>
									<!-- field wrapper end -->
								</div>	
                                <div class="col-xl-2 col-lg-2 col-md-6 col-sm-6 col-6">										
									<!-- field wrapper start -->
									<div class="field-wrapper">
                                        <input type="text"  name="class_1[]" 
                                        value ="<?php echo $classArray_fi[1]; ?>"
                                        class="form-control" placeholder="A, Amanda, Eagle" > 
									</div>
									<!-- field wrapper end -->
								</div>
                                <div class="col-xl-2 col-lg-2 col-md-6 col-sm-6 col-6">										
									<!-- field wrapper start -->
									<div class="field-wrapper">
                                        <input type="text"  name="class_1[]" 
                                        value ="<?php echo $classArray_fi[2]; ?>"
                                        class="form-control" placeholder="A, Amanda, Eagle" > 
									</div>
									<!-- field wrapper end -->
								</div>
                                <div class="col-xl-2 col-lg-2 col-md-6 col-sm-6 col-6">										
									<!-- field wrapper start -->
									<div class="field-wrapper">
                                        <input type="text"  name="class_1[]" 
                                        value ="<?php echo $classArray_fi[3]; ?>"
                                        class="form-control" placeholder="A, Amanda, Eagle" > 
									</div>
									<!-- field wrapper end -->
								</div>
                                <div class="col-xl-2 col-lg-2 col-md-6 col-sm-6 col-6">										
									<!-- field wrapper start -->
									<div class="field-wrapper">
                                        <input type="text"  name="class_1[]" 
                                        value ="<?php echo $classArray_fi[4]; ?>"
                                        class="form-control" placeholder="A, Amanda, Eagle" > 
									</div>
									<!-- field wrapper end -->
								</div>
                                <div class="col-xl-2 col-lg-2 col-md-6 col-sm-6 col-6">										
									<!-- field wrapper start -->
									<div class="field-wrapper">
                                        <input type="text"  name="class_1[]" 
                                        value ="<?php echo $classArray_fi[5]; ?>"
                                        class="form-control" placeholder="A, Amanda, Eagle" > 
									</div>
									<!-- field wrapper end -->
								</div>
                                <div class="col-xl-2 col-lg-2 col-md-6 col-sm-6 col-6">										
									<!-- field wrapper start -->
									<div class="field-wrapper">
                                        <input type="text"  name="class_1[]" 
                                        value ="<?php echo $classArray_fi[6]; ?>"
                                        class="form-control" placeholder="A, Amanda, Eagle" > 
									</div>
									<!-- field wrapper end -->
								</div>
                                <div class="col-xl-2 col-lg-2 col-md-6 col-sm-6 col-6">										
									<!-- field wrapper start -->
									<div class="field-wrapper">
                                        <input type="text"  name="class_1[]" 
                                        value ="<?php echo $classArray_fi[7]; ?>"
                                        class="form-control" placeholder="A, Amanda, Eagle" > 
									</div>
									<!-- field wrapper end -->
								</div>
                                <div class="col-xl-2 col-lg-2 col-md-6 col-sm-6 col-6">										
									<!-- field wrapper start -->
									<div class="field-wrapper">
                                        <input type="text"  name="class_1[]" 
                                        value ="<?php echo $classArray_fi[8]; ?>"
                                        class="form-control" placeholder="A, Amanda, Eagle" > 
									</div>
									<!-- field wrapper end -->
								</div>
                                <div class="col-xl-2 col-lg-2 col-md-6 col-sm-6 col-6">										
									<!-- field wrapper start -->
									<div class="field-wrapper">
                                        <input type="text"  name="class_1[]" 
                                        value ="<?php echo $classArray_fi[9]; ?>"
                                        class="form-control" placeholder="A, Amanda, Eagle" > 
									</div>
									<!-- field wrapper end -->
								</div>
                                <div class="col-xl-2 col-lg-2 col-md-6 col-sm-6 col-6">										
									<!-- field wrapper start -->
									<div class="field-wrapper">
                                        <input type="text"  name="class_1[]" 
                                        value ="<?php echo $classArray_fi[10]; ?>"
                                        class="form-control" placeholder="A, Amanda, Eagle" > 
									</div>
									<!-- field wrapper end -->
								</div>
                                <div class="col-xl-2 col-lg-2 col-md-6 col-sm-6 col-6">										
									<!-- field wrapper start -->
									<div class="field-wrapper">
                                        <input type="text"  name="class_1[]" 
                                        value ="<?php echo $classArray_fi[11]; ?>"
                                        class="form-control" placeholder="A, Amanda, Eagle" > 
									</div>
									<!-- field wrapper end -->
								</div>									 
							</div>	
							<!-- /row -->



							<!-- row -->
							<div class="row gutters mt-30">
                                <h4> <?php echo $levelArray[1]['level']; ?> Classes </h4>                               
								<div class="col-xl-2 col-lg-2 col-md-6 col-sm-6 col-6">										
									<!-- field wrapper start -->
									<div class="field-wrapper">
                                        <input type="text"  name="class_2[]" 
                                        value ="<?php echo $classArray_se[0]; ?>"
                                        class="form-control" placeholder="A, Amanda, Eagle" > 
									</div>
									<!-- field wrapper end -->
								</div>	
                                <div class="col-xl-2 col-lg-2 col-md-6 col-sm-6 col-6">										
									<!-- field wrapper start -->
									<div class="field-wrapper">
                                        <input type="text"  name="class_2[]" 
                                        value ="<?php echo $classArray_se[1]; ?>"
                                        class="form-control" placeholder="A, Amanda, Eagle" > 
									</div>
									<!-- field wrapper end -->
								</div>
                                <div class="col-xl-2 col-lg-2 col-md-6 col-sm-6 col-6">										
									<!-- field wrapper start -->
									<div class="field-wrapper">
                                        <input type="text"  name="class_2[]" 
                                        value ="<?php echo $classArray_se[2]; ?>"
                                        class="form-control" placeholder="A, Amanda, Eagle" > 
									</div>
									<!-- field wrapper end -->
								</div>
                                <div class="col-xl-2 col-lg-2 col-md-6 col-sm-6 col-6">										
									<!-- field wrapper start -->
									<div class="field-wrapper">
                                        <input type="text"  name="class_2[]" 
                                        value ="<?php echo $classArray_se[3]; ?>"
                                        class="form-control" placeholder="A, Amanda, Eagle" > 
									</div>
									<!-- field wrapper end -->
								</div>
                                <div class="col-xl-2 col-lg-2 col-md-6 col-sm-6 col-6">										
									<!-- field wrapper start -->
									<div class="field-wrapper">
                                        <input type="text"  name="class_2[]" 
                                        value ="<?php echo $classArray_se[4]; ?>"
                                        class="form-control" placeholder="A, Amanda, Eagle" > 
									</div>
									<!-- field wrapper end -->
								</div>
                                <div class="col-xl-2 col-lg-2 col-md-6 col-sm-6 col-6">										
									<!-- field wrapper start -->
									<div class="field-wrapper">
                                        <input type="text"  name="class_2[]" 
                                        value ="<?php echo $classArray_se[5]; ?>"
                                        class="form-control" placeholder="A, Amanda, Eagle" > 
									</div> 
									<!-- field wrapper end -->
								</div>
                                <div class="col-xl-2 col-lg-2 col-md-6 col-sm-6 col-6">										
									<!-- field wrapper start -->
									<div class="field-wrapper">
                                        <input type="text"  name="class_2[]" 
                                        value ="<?php echo $classArray_se[6]; ?>"
                                        class="form-control" placeholder="A, Amanda, Eagle" > 
									</div>
									<!-- field wrapper end -->
								</div>
                                <div class="col-xl-2 col-lg-2 col-md-6 col-sm-6 col-6">										
									<!-- field wrapper start -->
									<div class="field-wrapper">
                                        <input type="text"  name="class_2[]" 
                                        value ="<?php echo $classArray_se[7]; ?>"
                                        class="form-control" placeholder="A, Amanda, Eagle" > 
									</div>
									<!-- field wrapper end -->
								</div>
                                <div class="col-xl-2 col-lg-2 col-md-6 col-sm-6 col-6">										
									<!-- field wrapper start -->
									<div class="field-wrapper">
                                        <input type="text"  name="class_2[]" 
                                        value ="<?php echo $classArray_se[8]; ?>"
                                        class="form-control" placeholder="A, Amanda, Eagle" > 
									</div>
									<!-- field wrapper end -->
								</div>
                                <div class="col-xl-2 col-lg-2 col-md-6 col-sm-6 col-6">										
									<!-- field wrapper start -->
									<div class="field-wrapper">
                                        <input type="text"  name="class_2[]" 
                                        value ="<?php echo $classArray_se[9]; ?>"
                                        class="form-control" placeholder="A, Amanda, Eagle" > 
									</div>
									<!-- field wrapper end -->
								</div>
                                <div class="col-xl-2 col-lg-2 col-md-6 col-sm-6 col-6">										
									<!-- field wrapper start -->
									<div class="field-wrapper">
                                        <input type="text"  name="class_2[]" 
                                        value ="<?php echo $classArray_se[10]; ?>"
                                        class="form-control" placeholder="A, Amanda, Eagle" > 
									</div>
									<!-- field wrapper end -->
								</div>
                                <div class="col-xl-2 col-lg-2 col-md-6 col-sm-6 col-6">										
									<!-- field wrapper start -->
									<div class="field-wrapper">
                                        <input type="text"  name="class_2[]" 
                                        value ="<?php echo $classArray_se[11]; ?>"
                                        class="form-control" placeholder="A, Amanda, Eagle" > 
									</div>
									<!-- field wrapper end -->
								</div>									 
							</div>	
							<!-- /row -->



							<!-- row -->
							<div class="row gutters mt-30">
                                <h4><?php echo $levelArray[2]['level']; ?> Classes </h4>
								<div class="col-xl-2 col-lg-2 col-md-6 col-sm-6 col-6">										
									<!-- field wrapper start -->
									<div class="field-wrapper">
                                        <input type="text"  name="class_3[]" 
                                        value ="<?php echo $classArray_th[0]; ?>"
                                        class="form-control" placeholder="A, Amanda, Eagle" > 
									</div>
									<!-- field wrapper end -->
								</div>	
                                <div class="col-xl-2 col-lg-2 col-md-6 col-sm-6 col-6">										
									<!-- field wrapper start -->
									<div class="field-wrapper">
                                        <input type="text"  name="class_3[]" 
                                        value ="<?php echo $classArray_th[1]; ?>"
                                        class="form-control" placeholder="A, Amanda, Eagle" > 
									</div>
									<!-- field wrapper end -->
								</div>
                                <div class="col-xl-2 col-lg-2 col-md-6 col-sm-6 col-6">										
									<!-- field wrapper start -->
									<div class="field-wrapper">
                                        <input type="text"  name="class_3[]" 
                                        value ="<?php echo $classArray_th[2]; ?>"
                                        class="form-control" placeholder="A, Amanda, Eagle" > 
									</div>
									<!-- field wrapper end -->
								</div>
                                <div class="col-xl-2 col-lg-2 col-md-6 col-sm-6 col-6">										
									<!-- field wrapper start -->
									<div class="field-wrapper">
                                        <input type="text"  name="class_3[]" 
                                        value ="<?php echo $classArray_th[3]; ?>"
                                        class="form-control" placeholder="A, Amanda, Eagle" > 
									</div>
									<!-- field wrapper end -->
								</div>
                                <div class="col-xl-2 col-lg-2 col-md-6 col-sm-6 col-6">										
									<!-- field wrapper start -->
									<div class="field-wrapper">
                                        <input type="text"  name="class_3[]" 
                                        value ="<?php echo $classArray_th[4]; ?>"
                                        class="form-control" placeholder="A, Amanda, Eagle" > 
									</div>
									<!-- field wrapper end -->
								</div>
                                <div class="col-xl-2 col-lg-2 col-md-6 col-sm-6 col-6">										
									<!-- field wrapper start -->
									<div class="field-wrapper">
                                        <input type="text"  name="class_3[]" 
                                        value ="<?php echo $classArray_th[5]; ?>"
                                        class="form-control" placeholder="A, Amanda, Eagle" > 
									</div>
									<!-- field wrapper end -->
								</div>
                                <div class="col-xl-2 col-lg-2 col-md-6 col-sm-6 col-6">										
									<!-- field wrapper start -->
									<div class="field-wrapper">
                                        <input type="text"  name="class_3[]" 
                                        value ="<?php echo $classArray_th[6]; ?>"
                                        class="form-control" placeholder="A, Amanda, Eagle" > 
									</div>
									<!-- field wrapper end -->
								</div>
                                <div class="col-xl-2 col-lg-2 col-md-6 col-sm-6 col-6">										
									<!-- field wrapper start -->
									<div class="field-wrapper">
                                        <input type="text"  name="class_3[]" 
                                        value ="<?php echo $classArray_th[7]; ?>"
                                        class="form-control" placeholder="A, Amanda, Eagle" > 
									</div>
									<!-- field wrapper end -->
								</div>
                                <div class="col-xl-2 col-lg-2 col-md-6 col-sm-6 col-6">										
									<!-- field wrapper start -->
									<div class="field-wrapper">
                                        <input type="text"  name="class_3[]" 
                                        value ="<?php echo $classArray_th[8]; ?>"
                                        class="form-control" placeholder="A, Amanda, Eagle" > 
									</div>
									<!-- field wrapper end -->
								</div>
                                <div class="col-xl-2 col-lg-2 col-md-6 col-sm-6 col-6">										
									<!-- field wrapper start -->
									<div class="field-wrapper">
                                        <input type="text"  name="class_3[]" 
                                        value ="<?php echo $classArray_th[9]; ?>"
                                        class="form-control" placeholder="A, Amanda, Eagle" > 
									</div>
									<!-- field wrapper end -->
								</div>
                                <div class="col-xl-2 col-lg-2 col-md-6 col-sm-6 col-6">										
									<!-- field wrapper start -->
									<div class="field-wrapper">
                                        <input type="text"  name="class_3[]" 
                                        value ="<?php echo $classArray_th[10]; ?>"
                                        class="form-control" placeholder="A, Amanda, Eagle" > 
									</div>
									<!-- field wrapper end -->
								</div>
                                <div class="col-xl-2 col-lg-2 col-md-6 col-sm-6 col-6">										
									<!-- field wrapper start -->
									<div class="field-wrapper">
                                        <input type="text"  name="class_3[]" 
                                        value ="<?php echo $classArray_th[11]; ?>"
                                        class="form-control" placeholder="A, Amanda, Eagle" > 
									</div>
									<!-- field wrapper end -->
								</div>									 
							</div>	
							<!-- /row -->
							<input type="hidden" name="query" value="class-nur" /> 


							<?php 	if($schoolExt != $fobrainNurAbr){  /* check school type */  ?>

							<!-- row -->
							<div class="row gutters mt-30">
                                <h4><?php echo $levelArray[3]['level']; ?> Classes </h4>
								<div class="col-xl-2 col-lg-2 col-md-6 col-sm-6 col-6">										
									<!-- field wrapper start -->
									<div class="field-wrapper">
                                        <input type="text"  name="class_4[]" 
                                        value ="<?php echo $classArray_fo[0]; ?>"
                                        class="form-control" placeholder="A, Amanda, Eagle" > 
									</div>
									<!-- field wrapper end -->
								</div>	
                                <div class="col-xl-2 col-lg-2 col-md-6 col-sm-6 col-6">										
									<!-- field wrapper start -->
									<div class="field-wrapper">
                                        <input type="text"  name="class_4[]" 
                                        value ="<?php echo $classArray_fo[1]; ?>"
                                        class="form-control" placeholder="A, Amanda, Eagle" > 
									</div>
									<!-- field wrapper end -->
								</div>
                                <div class="col-xl-2 col-lg-2 col-md-6 col-sm-6 col-6">										
									<!-- field wrapper start -->
									<div class="field-wrapper">
                                        <input type="text"  name="class_4[]" 
                                        value ="<?php echo $classArray_fo[2]; ?>"
                                        class="form-control" placeholder="A, Amanda, Eagle" > 
									</div>
									<!-- field wrapper end -->
								</div>
                                <div class="col-xl-2 col-lg-2 col-md-6 col-sm-6 col-6">										
									<!-- field wrapper start -->
									<div class="field-wrapper">
                                        <input type="text"  name="class_4[]" 
                                        value ="<?php echo $classArray_fo[3]; ?>"
                                        class="form-control" placeholder="A, Amanda, Eagle" > 
									</div>
									<!-- field wrapper end -->
								</div>
                                <div class="col-xl-2 col-lg-2 col-md-6 col-sm-6 col-6">										
									<!-- field wrapper start -->
									<div class="field-wrapper">
                                        <input type="text"  name="class_4[]" 
                                        value ="<?php echo $classArray_fo[4]; ?>"
                                        class="form-control" placeholder="A, Amanda, Eagle" > 
									</div>
									<!-- field wrapper end -->
								</div>
                                <div class="col-xl-2 col-lg-2 col-md-6 col-sm-6 col-6">										
									<!-- field wrapper start -->
									<div class="field-wrapper">
                                        <input type="text"  name="class_4[]" 
                                        value ="<?php echo $classArray_fo[5]; ?>"
                                        class="form-control" placeholder="A, Amanda, Eagle" > 
									</div>
									<!-- field wrapper end -->
								</div>
                                <div class="col-xl-2 col-lg-2 col-md-6 col-sm-6 col-6">										
									<!-- field wrapper start -->
									<div class="field-wrapper">
                                        <input type="text"  name="class_4[]" 
                                        value ="<?php echo $classArray_fo[6]; ?>"
                                        class="form-control" placeholder="A, Amanda, Eagle" > 
									</div>
									<!-- field wrapper end -->
								</div>
                                <div class="col-xl-2 col-lg-2 col-md-6 col-sm-6 col-6">										
									<!-- field wrapper start -->
									<div class="field-wrapper">
                                        <input type="text"  name="class_4[]" 
                                        value ="<?php echo $classArray_fo[7]; ?>"
                                        class="form-control" placeholder="A, Amanda, Eagle" > 
									</div>
									<!-- field wrapper end -->
								</div>
                                <div class="col-xl-2 col-lg-2 col-md-6 col-sm-6 col-6">										
									<!-- field wrapper start -->
									<div class="field-wrapper">
                                        <input type="text"  name="class_4[]" 
                                        value ="<?php echo $classArray_fo[8]; ?>"
                                        class="form-control" placeholder="A, Amanda, Eagle" > 
									</div>
									<!-- field wrapper end -->
								</div>
                                <div class="col-xl-2 col-lg-2 col-md-6 col-sm-6 col-6">										
									<!-- field wrapper start -->
									<div class="field-wrapper">
                                        <input type="text"  name="class_4[]" 
                                        value ="<?php echo $classArray_fo[9]; ?>"
                                        class="form-control" placeholder="A, Amanda, Eagle" > 
									</div>
									<!-- field wrapper end -->
								</div>
                                <div class="col-xl-2 col-lg-2 col-md-6 col-sm-6 col-6">										
									<!-- field wrapper start -->
									<div class="field-wrapper">
                                        <input type="text"  name="class_4[]" 
                                        value ="<?php echo $classArray_fo[10]; ?>"
                                        class="form-control" placeholder="A, Amanda, Eagle" > 
									</div>
									<!-- field wrapper end -->
								</div>
                                <div class="col-xl-2 col-lg-2 col-md-6 col-sm-6 col-6">										
									<!-- field wrapper start -->
									<div class="field-wrapper">
                                        <input type="text"  name="class_4[]" 
                                        value ="<?php echo $classArray_fo[11]; ?>"
                                        class="form-control" placeholder="A, Amanda, Eagle" > 
									</div>
									<!-- field wrapper end -->
								</div>									 
							</div>	
							<!-- /row -->



							<!-- row -->
							<div class="row gutters mt-30">
                                <h4><?php echo $levelArray[4]['level']; ?> Classes </h4>
								<div class="col-xl-2 col-lg-2 col-md-6 col-sm-6 col-6">										
									<!-- field wrapper start -->
									<div class="field-wrapper">
                                        <input type="text"  name="class_5[]" 
                                        value ="<?php echo $classArray_fif[0]; ?>"
                                        class="form-control" placeholder="A, Amanda, Eagle" > 
									</div>
									<!-- field wrapper end -->
								</div>	
                                <div class="col-xl-2 col-lg-2 col-md-6 col-sm-6 col-6">										
									<!-- field wrapper start -->
									<div class="field-wrapper">
                                        <input type="text"  name="class_5[]" 
                                        value ="<?php echo $classArray_fif[1]; ?>"
                                        class="form-control" placeholder="A, Amanda, Eagle" > 
									</div>
									<!-- field wrapper end -->
								</div>
                                <div class="col-xl-2 col-lg-2 col-md-6 col-sm-6 col-6">										
									<!-- field wrapper start -->
									<div class="field-wrapper">
                                        <input type="text"  name="class_5[]" 
                                        value ="<?php echo $classArray_fif[2]; ?>"
                                        class="form-control" placeholder="A, Amanda, Eagle" > 
									</div>
									<!-- field wrapper end -->
								</div>
                                <div class="col-xl-2 col-lg-2 col-md-6 col-sm-6 col-6">										
									<!-- field wrapper start -->
									<div class="field-wrapper">
                                        <input type="text"  name="class_5[]" 
                                        value ="<?php echo $classArray_fif[3]; ?>"
                                        class="form-control" placeholder="A, Amanda, Eagle" > 
									</div>
									<!-- field wrapper end -->
								</div>
                                <div class="col-xl-2 col-lg-2 col-md-6 col-sm-6 col-6">										
									<!-- field wrapper start -->
									<div class="field-wrapper">
                                        <input type="text"  name="class_5[]" 
                                        value ="<?php echo $classArray_fif[4]; ?>"
                                        class="form-control" placeholder="A, Amanda, Eagle" > 
									</div>
									<!-- field wrapper end -->
								</div>
                                <div class="col-xl-2 col-lg-2 col-md-6 col-sm-6 col-6">										
									<!-- field wrapper start -->
									<div class="field-wrapper">
                                        <input type="text"  name="class_5[]" 
                                        value ="<?php echo $classArray_fif[5]; ?>"
                                        class="form-control" placeholder="A, Amanda, Eagle" > 
									</div>
									<!-- field wrapper end -->
								</div>
                                <div class="col-xl-2 col-lg-2 col-md-6 col-sm-6 col-6">										
									<!-- field wrapper start -->
									<div class="field-wrapper">
                                        <input type="text"  name="class_5[]" 
                                        value ="<?php echo $classArray_fif[6]; ?>"
                                        class="form-control" placeholder="A, Amanda, Eagle" > 
									</div>
									<!-- field wrapper end -->
								</div>
                                <div class="col-xl-2 col-lg-2 col-md-6 col-sm-6 col-6">										
									<!-- field wrapper start -->
									<div class="field-wrapper">
                                        <input type="text"  name="class_5[]" 
                                        value ="<?php echo $classArray_fif[7]; ?>"
                                        class="form-control" placeholder="A, Amanda, Eagle" > 
									</div>
									<!-- field wrapper end -->
								</div>
                                <div class="col-xl-2 col-lg-2 col-md-6 col-sm-6 col-6">										
									<!-- field wrapper start -->
									<div class="field-wrapper">
                                        <input type="text"  name="class_5[]" 
                                        value ="<?php echo $classArray_fif[8]; ?>"
                                        class="form-control" placeholder="A, Amanda, Eagle" > 
									</div>
									<!-- field wrapper end -->
								</div>
                                <div class="col-xl-2 col-lg-2 col-md-6 col-sm-6 col-6">										
									<!-- field wrapper start -->
									<div class="field-wrapper">
                                        <input type="text"  name="class_5[]" 
                                        value ="<?php echo $classArray_fif[9]; ?>"
                                        class="form-control" placeholder="A, Amanda, Eagle" > 
									</div>
									<!-- field wrapper end -->
								</div>
                                <div class="col-xl-2 col-lg-2 col-md-6 col-sm-6 col-6">										
									<!-- field wrapper start -->
									<div class="field-wrapper">
                                        <input type="text"  name="class_5[]" 
                                        value ="<?php echo $classArray_fif[10]; ?>"
                                        class="form-control" placeholder="A, Amanda, Eagle" > 
									</div>
									<!-- field wrapper end -->
								</div>
                                <div class="col-xl-2 col-lg-2 col-md-6 col-sm-6 col-6">										
									<!-- field wrapper start -->
									<div class="field-wrapper">
                                        <input type="text"  name="class_5[]" 
                                        value ="<?php echo $classArray_fif[11]; ?>"
                                        class="form-control" placeholder="A, Amanda, Eagle" > 
									</div>
									<!-- field wrapper end -->
								</div>									 
							</div>	
							<!-- /row -->



							<!-- row -->
							<div class="row gutters mt-30">
                                <h4><?php echo $levelArray[5]['level']; ?> Classes </h4>
								<div class="col-xl-2 col-lg-2 col-md-6 col-sm-6 col-6">										
									<!-- field wrapper start -->
									<div class="field-wrapper">
                                        <input type="text"  name="class_6[]" 
                                        value ="<?php echo $classArray_six[0]; ?>"
                                        class="form-control" placeholder="A, Amanda, Eagle" > 
									</div>
									<!-- field wrapper end -->
								</div>	
                                <div class="col-xl-2 col-lg-2 col-md-6 col-sm-6 col-6">										
									<!-- field wrapper start -->
									<div class="field-wrapper">
                                        <input type="text"  name="class_6[]" 
                                        value ="<?php echo $classArray_six[1]; ?>"
                                        class="form-control" placeholder="A, Amanda, Eagle" > 
									</div>
									<!-- field wrapper end -->
								</div>
                                <div class="col-xl-2 col-lg-2 col-md-6 col-sm-6 col-6">										
									<!-- field wrapper start -->
									<div class="field-wrapper">
                                        <input type="text"  name="class_6[]" 
                                        value ="<?php echo $classArray_six[2]; ?>"
                                        class="form-control" placeholder="A, Amanda, Eagle" > 
									</div>
									<!-- field wrapper end -->
								</div>
                                <div class="col-xl-2 col-lg-2 col-md-6 col-sm-6 col-6">										
									<!-- field wrapper start -->
									<div class="field-wrapper">
                                        <input type="text"  name="class_6[]" 
                                        value ="<?php echo $classArray_six[3]; ?>"
                                        class="form-control" placeholder="A, Amanda, Eagle" > 
									</div>
									<!-- field wrapper end -->
								</div>
                                <div class="col-xl-2 col-lg-2 col-md-6 col-sm-6 col-6">										
									<!-- field wrapper start -->
									<div class="field-wrapper">
                                        <input type="text"  name="class_6[]" 
                                        value ="<?php echo $classArray_six[4]; ?>"
                                        class="form-control" placeholder="A, Amanda, Eagle" > 
									</div>
									<!-- field wrapper end -->
								</div>
                                <div class="col-xl-2 col-lg-2 col-md-6 col-sm-6 col-6">										
									<!-- field wrapper start -->
									<div class="field-wrapper">
                                        <input type="text"  name="class_6[]" 
                                        value ="<?php echo $classArray_six[5]; ?>"
                                        class="form-control" placeholder="A, Amanda, Eagle" > 
									</div>
									<!-- field wrapper end -->
								</div>
                                <div class="col-xl-2 col-lg-2 col-md-6 col-sm-6 col-6">										
									<!-- field wrapper start -->
									<div class="field-wrapper">
                                        <input type="text"  name="class_6[]" 
                                        value ="<?php echo $classArray_six[6]; ?>"
                                        class="form-control" placeholder="A, Amanda, Eagle" > 
									</div>
									<!-- field wrapper end -->
								</div>
                                <div class="col-xl-2 col-lg-2 col-md-6 col-sm-6 col-6">										
									<!-- field wrapper start -->
									<div class="field-wrapper">
                                        <input type="text"  name="class_6[]" 
                                        value ="<?php echo $classArray_six[7]; ?>"
                                        class="form-control" placeholder="A, Amanda, Eagle" > 
									</div>
									<!-- field wrapper end -->
								</div>
                                <div class="col-xl-2 col-lg-2 col-md-6 col-sm-6 col-6">										
									<!-- field wrapper start -->
									<div class="field-wrapper">
                                        <input type="text"  name="class_6[]" 
                                        value ="<?php echo $classArray_six[8]; ?>"
                                        class="form-control" placeholder="A, Amanda, Eagle" > 
									</div>
									<!-- field wrapper end -->
								</div>
                                <div class="col-xl-2 col-lg-2 col-md-6 col-sm-6 col-6">										
									<!-- field wrapper start -->
									<div class="field-wrapper">
                                        <input type="text"  name="class_6[]" 
                                        value ="<?php echo $classArray_six[9]; ?>"
                                        class="form-control" placeholder="A, Amanda, Eagle" > 
									</div>
									<!-- field wrapper end -->
								</div>
                                <div class="col-xl-2 col-lg-2 col-md-6 col-sm-6 col-6">										
									<!-- field wrapper start -->
									<div class="field-wrapper">
                                        <input type="text"  name="class_6[]" 
                                        value ="<?php echo $classArray_six[10]; ?>"
                                        class="form-control" placeholder="A, Amanda, Eagle" > 
									</div>
									<!-- field wrapper end -->
								</div>
                                <div class="col-xl-2 col-lg-2 col-md-6 col-sm-6 col-6">										
									<!-- field wrapper start -->
									<div class="field-wrapper">
                                        <input type="text"  name="class_6[]" 
                                        value ="<?php echo $classArray_six[11]; ?>"
                                        class="form-control" placeholder="A, Amanda, Eagle" > 
									</div>
									<!-- field wrapper end -->
								</div>									 
							</div>	
							<!-- /row --> 
							<input type="hidden" name="query" value="class-ps" /> 

							<?php 	}  /* check school type */  ?>
							
							<!-- row -->
							<div class="row gutters mt-30">
								<div class="col-12 text-end">
                                    
									<button type="submit" class="btn btn-primary waves-effect   
									btn-label waves-light demo-disenable" id="classSettings">
										<i class="mdi mdi-content-save label-icon"></i>  Save
									</button>
								</div>
							</div>	
							<!-- /row -->									
						</form>
						<!-- / form -->		
					</div>
				</div>
				<!-- card end -->	
			</div>
		</div>
		<!-- / row -->	  	