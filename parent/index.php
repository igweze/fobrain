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
	
	
	-------- Script Description --------
	This script handle school student module
	------------------------------------------------------------------------*/

ob_start(); 

if(!session_id()){
    session_start();
} 

		define('fobrain', 'igweze');  /* define a check for wrong access of file */	  
        
		require 'fobrain-config.php';  /* load fobrain configuration files */	 

        $show_comp_wall = false;  
        $can_use_search = false;
        $nav_render = 1;
        $sibling_render = 1; 

		require_once ($wizTemplate.'fobrain-header.php');  /* include template head */  
		
?>	

    <body id="wizg-wrapper">   
        <div id="fob-wrapper">
        <!----pre loader----->
		<div id="preload-wrapper">
			<div class="preloader" 
				style="background-image:url(<?php echo $fobrainTemplate; ?>/images/preloader.gif)">
			</div> 
		</div>
		<!----pre loader end-----> 
		
        <?php

        if ($_SESSION['screen_lock'] == 1111) {  /* check if screen lock is activated */  
             
            $screen_name = $student_name.'<br/> ('.$regNum.')';
            $screen_img = $student_img;
            $screen_link = "wiz-menu";
            require_once $lock_screen_temp;

        }else{ 
            
        ?> 

        <!-- layout-wrapper -->
        <div id="layout-wrapper">            
            <header id="page-topbar">			
                <div class="navbar-header">				
                    <div class="d-flex  align-items-center">
                         <!-- logo -->
                         <div class="navbar-brand-box animate__animated animate__shakeX">
                            <a href="javascript:;" class="logo logo-dark">
                                <span class="logo-sm">
                                    <img src="<?php echo $fobrainTemplate; ?>images/logo-2.png"  class="logo-s" alt="fobrain logo">
                                </span>
                                <span class="logo-lg">
                                    <img src="<?php echo $fobrainTemplate; ?>images/logo.png" class="logo-l" alt="fobrain logo">
                                </span>
                            </a>  
                        </div>						
                        <div> 
                            <button type="button" class="btn px-3 header-item"  id="vertical-menu-btn">
                                <i class="mdi mdi-menu" data-title="FoBrain Page Tour" data-intro="This App Menu Navigation 👋"></i>
                            </button> 
                        </div> 
                        <div> 
                            <!-- page search -->
                            <button type="button" class="btn px-3 header-item" onclick="openSearch()">
                                <i class="mdi mdi-text-box-search-outline"></i>
                            </button> 
                            <!-- / page search -->  
						</div> 
                        <div> 
                            <img class="rounded-circle header-profile-user" src="<?php echo $sch_logo; ?>" alt="School Logo">  
                        </div>
                        <div> 
                            <h4 class="navbar-title-box animate__animated animate__shakeX"> <?php echo $schoolNameTop; ?> </h4>	 
                        </div>
                    </div> 
                   
                    <div class="d-flex">  
                        <div class="dropdown d-none d-sm-inline-block">
                            <button type="button" class="btn header-item" >                                
                                <span id="full-screen" data-toggle-fullscreen=""><i class="mdi mdi-fullscreen"></i></span>
                            </button> 
                        </div>
                        <div id="google_translate_element"></div>
                        <div class="dropdown-center">
                            <button type="button" class="btn header-item noti-icon position-relative" id="page-header-notifications-dropdown"
                            data-bs-toggle="dropdown" aria-haspopup="true" data-bs-auto-close="true" aria-expanded="false"> 
                                <i class="mdi mdi-flag-checkered" data-title="FoBrain Page Tour" data-intro="Change to your prefered language here 👋"></i> 
                            </button>
                            <div class="dropdown-menu  dropdown-menu-drop dropdown-shadow end-0 animate__animated animate__zoomIn"
                                aria-labelledby="page-header-notifications-dropdown">
                                <div class="border-size-1 border-fade bb-double">
                                    <div class="row align-items-center dropdown-menu-drop-wrap">
                                        <div class="col">
                                            <h6 class="m-0"> Default Language -  <?php echo $lang_upp; ?></h6>
                                        </div>
                                        <div class="col-auto">
                                            <a href="javascript:;" class="text-decoration-underline"> </a>
                                        </div>
                                    </div>
                                </div>
								
								<div class="col-12 px-15 pb-50">										
									<!-- field wrapper start -->
									<div class="field-wrapper"> 
										<select class="form-control fob-select-cm"  id="fob-lang" name="fob-lang" required>
                                              
											<option value = "">Select Language</option>							
											<?php

												foreach($translatorArr as $trans_key => $trans_value){  /* loop array */

													if ($lang_2 == $trans_key){
														$selected = "SELECTED";
													} else {
														$selected = "";
													}

													echo '<option value="'.$trans_key.'"'.$selected.'>'.$trans_value.'</option>' ."\r\n";

												}
											?>
										</select>
										  
									</div>
									<!-- field wrapper end -->
								</div>  
                                 
                            </div>
                        </div>
						
						<div class="dropdown-center">
                            <button type="button" class="btn header-item noti-icon position-relative cart-box" id="page-header-notifications-dropdown"
                            data-bs-toggle="dropdown" aria-haspopup="true"  data-bs-auto-close="true" aria-expanded="false">
                                	
                                <i class="mdi mdi-cart-variant"></i>							
                                <span class="badge rounded-pill" id="cart-info">
									<?php 
										if(isset($_SESSION["ecart_session"])){										
											echo count($_SESSION["ecart_session"]); 											
										}else{											
											echo 0;
										} 						
									?>
								</span>								
                            </button>
                            <div class="dropdown-menu  dropdown-menu-drop  dropdown-shadow end-0 animate__animated animate__zoomIn"
                                aria-labelledby="page-header-notifications-dropdown">
                                <div class="border-size-1 border-fade bb-double">
                                    <div class="row align-items-center dropdown-menu-drop-wrap">
                                        <div class="col">
                                            <h6 class="m-0"> Shopping Cart </h6>
                                        </div>
                                        <div class="col-auto">
                                            <a href="javascript:;" class="small text-reset text-decoration-underline check-out">
											<i class="mdi mdi-arrow-right-circle me-1"></i> Check Out</a>
                                        </div>
                                    </div>
                                </div>
                                <div data-simplebar style="max-height: 230px;" class="p-10">                                    
									<div id="shopping-cart-results"></div>                                       
                                </div>
                                 
                            </div>
                        </div>  
						 
                        <div class="dropdown d-none d-sm-inline-block">
                            <button type="button" class="btn header-item right-bar-toggle me-2">
                                <i class="mdi mdi-account-cog-outline"></i>
                            </button>
                        </div>

                        <div class="dropdown d-inline-block mobile-hide-component">
                            <button type="button" class="btn header-item bg-soft-light" id="page-header-user-dropdown"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img class="preview-picture-1 rounded-circle header-profile-user" src="<?php echo $student_img; ?>"
                                    alt="Header Avatar"> 
                            </button>
                            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end wiz-menu profile-card-bg profile-card-drop-down p-0 m-0 animate__animated animate__zoomIn"> 
                                <div class="profile-card   m-0">
                                    <span class="user"><i class="mdi mdi-dots-hexagon"></i> Active</span>
                                    <img
                                        class="preview-picture-1 round img-h-150"
                                        src="<?php echo $student_img; ?>"
                                        alt="user" />
                                    <h3 class="font-head-1-q">
                                        <span class="student-name-rp"><?php echo "$student_name </span> <br>($regNum)"?>
                                    </h3>
                                    <h6>STUDENT</h6>   
                                    <div class="row  justify-content-center mt-40 profile-link"> 
                                        <div class="col wiz-menu">                                            
											<a href="javascript:;" id="profile">
												<i class="mdi mdi-account-circle-outline"></i>
											</a>
                                        </div>
                                        <div class="col wiz-menu">                                            
											<a href="javascript:;" id="support">
												<i class="mdi mdi-message-question-outline"></i>
											</a>
                                        </div>	
                                        <div class="col wiz-menu">  
											<a href="javascript:;" id="reload-page">
												<i class="mdi mdi-refresh-circle"></i>
											</a>
                                        </div>	
										<div class="col wiz-menu">  
											<a href="javascript:;" id="lock-screen">
												<i class="mdi mdi-account-lock"></i>
											</a>
                                        </div>	
                                        <div class="col wiz-menu"> 
											<a href="javascript:;" id="log-out">
                                            	<i class="mdi mdi-logout"></i>
											</a>
                                        </div>	
                                    </div>	 
                                </div>  
                            </div>
                        </div>   
                              
                        
                    </div>
                </div>
            </header>

            <!-- ========== left sidebar start ========== -->
            <div class="vertical-menu"> 
                <div data-simplebar class="h-100"> 
                    <!--- sidemenu -->
                    <div id="sidebar-menu"> 
                        <div class="side-menu-header mt-10">
                            <img src="<?php echo $student_img; ?>" class="preview-picture-1 rounded-circle"> 
                            <h4 class="font-head-1a mt-5 student-name-rp"><?php echo $student_name; ?></h4>
                            <div class="wiz-menu"> 
                                <a href="javascript:;" id="profile">
                                    <i class="mdi mdi-account-tie"></i>
                                </a>
                                <span id="full-screen" data-toggle-fullscreen=""><i class="mdi mdi-fullscreen"></i></span> 
                                <i class="mdi mdi-text-box-search-outline" onclick="openSearch()"></i> 
                                <i class="mdi mdi-account-cog-outline right-bar-toggle"></i>
                                <a href="javascript:;" id="log-out">
                                    <i class="mdi mdi-logout"></i>
                                </a> 
                            </div>
                        </div>   
                              

                        <!-- left menu start -->
                        <ul class="metismenu list-unstyled" id="side-menu">  
                            <li class="menu-title" data-key="t-menu">Menu</li> 
                            <li class="wiz-menu">
							    <a href="javascript:;" id="home">
                                    <i class="mdi mdi-view-dashboard mdi-spin" id="home-pg"></i>
								    <span>My Dashboard</span>
							    </a>
							</li>
                            <li>
                                <a href="javascript: void(0);" class="has-arrow">
                                    <i class="mdi mdi-account-child-outline"></i>
                                    <span>Multi-Child Selector</span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false"> 
                                    <li class="wiz-menu-non">
                                        <div class="row gutters m-5">
                                            <div class="col-12">			 
                                                <select class="form-control" id="child-selector" name="child-selector" placeholder="Multi Child Selector">
                                                    <option value = "">Search . . .</option>
                                                    <?php
                                                        if(is_array($sibling)){  /* check is student is empty */ 

                                                            $sibling[] = $regNum;
                                            
                                                            foreach($sibling as $child){
                                            
                                                                $student_info = studentData($conn, $child); 
                                            
                                                                list ($lname, $fname, $mname, $pic, $gender, $i_dob, $height, $weight, $session_fi, $name_full) = explode ("@+@", $student_info);
                                                                
                                                                if($mname != ""){
                                                                    $mname = substr($mname, 0, 1). ".";
                                                                }

                                                                $session_se = $session_fi + $fiVal; 
                                            
                                                                $student_img = picture($school_pic_dir.$session_fi.'_'.$session_se.'/', $pic, "student");

                                                                if ($regNum == $child){

                                                                    $selected = "SELECTED";
                                                
                                                                }else{
                                                
                                                                    $selected = "";
                                                                    
                                                                }

                                                                echo $options .= '<option value="'.$child.'"'.$selected.' data-src="'.$student_img.'"> '.$fname.' '.$mname.'</option>' ."\r\n";     
                                            
                                                            }
                                                        }    
                                                    ?>
                                                    
                                                </select>	 
                                            </div>  
                                        </div>  
                                    </li> 
                                </ul>
                            </li>  
							
							<li class="wiz-menu">
							    <a href="javascript:;" id="profile" >
								    <i class="mdi mdi-account-tie"></i>
								    <span>My Profile</span>
							    </a>

							</li> 
							
							<li>
                                <a href="javascript: void(0);" class="has-arrow">
                                    <i class="mdi mdi-account-cash-outline"></i>
                                    <span>School Fees</span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                     
                                    <li class="wiz-menu">
                                        <a href="javascript:;" id="e-payment">
											<i class="mdi mdi-chevron-right"></i>
                                            <span>Pay Fees</span>
                                        </a>
                                    </li>
									
									<li class="wiz-menu">
                                        <a  href="javascript:;" id="fees-history">
											<i class="mdi mdi-chevron-right"></i>
                                            <span>My Fees History</span>
                                        </a>
                                    </li> 
                                     
                                </ul>
                            </li>

							  
							<?php  //if(trim($ewalletCheck) != trim($i_false)) {?>
							
							<li>
                                <a href="javascript: void(0);" class="has-arrow">
                                    <i class="mdi mdi-card-bulleted-outline"></i>
                                    <span>My E-Wallet</span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                     
                                    <li class="wiz-menu">
                                        <a  href="javascript:;" id="recharge">
											<i class="mdi mdi-chevron-right"></i>
                                            <span>Recharge </span>
                                        </a>
                                    </li>
									
									<li class="wiz-menu">
                                        <a  href="javascript:;" id="e-wallet">
											<i class="mdi mdi-chevron-right"></i>
                                            <span>E-Wallet History</span>
                                        </a>
                                    </li> 
                                     
                                </ul>
                            </li>
							   
							<?php  //} ?>
							<li class="wiz-menu">
							  <a href="javascript:;" id="result" >
								  <i class="mdi mdi-book-education"></i>
								  <span>View Results</span>
							  </a>
							  
							</li>
							<?php  //if($rsType == $fiVal){ ?>
							<li class="wiz-menu">
							  <a href="javascript:;" id="best-student" >
								  <i class="mdi mdi-trophy-award"></i>
								  <span>Best Student/s Result</span>
							  </a>
							  
							</li>
							<?php // } ?>


                            <li class="wiz-menu">
							  <a href="javascript:;" id="roll-call" >
								  <i class="mdi mdi-format-list-checks"></i>
								  <span>Attendance</span>
							  </a>
							  
							</li>  

                            <li class="wiz-menu">
                                <a href="javascript:;" id="meeting" >
                                    <i class="mdi mdi-google-classroom"></i>
                                    <span>Live Meeting</span>
                                </a>
                            </li>

							<li class="wiz-menu">
							  <a href="javascript:;" id="e-cart" >
									<i class="mdi mdi-cart-variant"></i>
									<span>e Shop </span>
									<span class="w-badge cart-info">
									<?php									
										if(isset($_SESSION["ecart_session"])){
										
											echo count($_SESSION["ecart_session"]); 
											
										}else{
											
											echo 0; 									
											
										}																		
									?>
									</span>
							  </a>

							</li>
							
							<li>
                                <a href="javascript: void(0);" class="has-arrow">
                                    <i class="mdi mdi-library-shelves"></i>
                                    <span>e Library</span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                     
                                    <li class="wiz-menu">
                                        <a  href="javascript:;" id="library-book">
											<i class="mdi mdi-chevron-right"></i>
                                            <span>View  Books</span>
                                        </a>
                                    </li>
									
									<li class="wiz-menu">
                                        <a  href="javascript:;" id="library-history">
											<i class="mdi mdi-chevron-right"></i>
                                            <span>My Lib. History</span>
                                        </a>
                                    </li> 
                                     
                                </ul>
                            </li>

							<li class="wiz-menu">
								<a href="javascript:;" id="broadcast">
                                    <i class="mdi mdi-account-tie-voice"></i>
									<span>Broadcast </span>
								</a>
							</li> 
							 
			   
							<li class="wiz-menu">
								<a href="javascript:;" id="time-table" >
									<i class="mdi mdi-calendar-text"></i>
									<span>Timetable</span>
								</a>							 
							</li>
                           

							<li class="wiz-menu">
								<a href="javascript:;" id="events" >
									<i class="mdi mdi-calendar-clock"></i>
									<span>School Events</span>
								</a>
							</li> 

							<li class="wiz-menu">
								<a href="javascript:;" id="support">
									<i class="mdi mdi-timeline-help"></i>
									<span>Help Desks</span>
								</a>
							</li>

							<li class="wiz-menu">
								<a href="javascript:;" id="lock-screen">
                                    <i class="mdi mdi-account-lock"></i>
									<span>Lock Screen</span>
								</a>
							</li>

                            <li class="wiz-menu">
								<a href="javascript:;" id="change-pass">
                                    <i class="mdi mdi-account-key-outline"></i>
									<span>Change Password</span>
								</a>
							</li>

							<li class="wiz-menu">
								<a href="javascript:;" id="log-out">
                                    <i class="mdi mdi-logout"></i>
									<span>Sign Out</span>
								</a>
							</li>							
                        </ul>
                        <div class="side-menu-footer mt-30">
                            <img src="<?php echo $fobrainTemplate; ?>images/logo.png"> 
                            <h6 class="font-head-1a mt-40"> &copy fobrain 2024</h6> 
                        </div>   
                    </div>
                    <!-- / sidebar -->
                </div>
            </div>
            <!-- / left sidebar -->
            

            <!-- ============================================================== -->
            <!-- start right content here -->
            <!-- ============================================================== -->
            <div class="main-content">
                <div class="page-content">
					<noscript> <?php echo $infMsg.$noscriptMsg.$msgEnd; ?> </noscript> 
                    <div class="container-fluid site-min-height wizg-scroller" id="fobrain-content" >
                    </div>
                    <!-- container-fluid -->				 					
                </div>
                <!-- / page-content --> 
		<?php }	?>		
		<div id="wizg-activity"></div>
		<!-- footer start -->
		<?php require_once ($wizTemplate.'fobrain-footer.php');   /* include template footer */ ?>
		<!-- footer end -->		
		