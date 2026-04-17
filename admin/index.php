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

        unset($_SESSION['schoolConfigs']); 
        unset($_SESSION['school-type']);					 
        $_SESSION['schoolConfigs'] = ""; 
        $_SESSION['school-type'] = ""; 

        require 'fobrain-config-s.php';  /* load fobrain configuration files */	  

        $_SESSION['fobrainPilot'] =  $headerComPage;

        if ( (!isset($_SESSION['commonPgrade']))
        || ($_SESSION['commonPgrade'] != $comGrade)
        || (!isset($_SESSION['commonPlevel']))
        || ($_SESSION['commonPlevel'] != $comGradeInt) 

        ) {  /* user validation */

            header("Location: $fobrainLogOutDir");exit;
            /*echo "<script type='text/javascript'> window.location.href = '$fobrainLogOutDir';</script>"; exit; */

        }  

        require_once ($wizTemplate.'fobrain-header.php');  /* include template head */  
        require_once ($fobrainCWallFunctionDir);  /* load companion functions */ 


        try { 
                
            $userInfo = staffData($conn, $_SESSION['adminID']);  /* school staffs/teachers information */ 
            
            list ($title, $userName, $userSex, $userRank, $user_picture, $userLName) = 
            explode ("#@s@#", $userInfo);	
            
            $titleVal = wizSelectArray($title, $title_list);                
            $staff_t_name = $titleVal.' '.$userName;
            $staff_img = picture($staff_pic_ext, $user_picture, "staff"); 
            $userTag = wizSelectArray($_SESSION['accessLevel'], $adminRankingMinArr);

            $wall_name = "$staff_t_name ($userTag)";
			$comp_name = "$staff_t_name  - $userTag";
			$gender_gl =  $userSex;

            checkWallRegistration($conn, $wall_name, $gender_gl);	/* check if student is registered */

            $memberInfo = companionWallUserDetails($conn, $_SESSION['regNo'], $seVal);  /* retrieve student companion details */
                
            list ($member_id, $faRegNum, $m_name, $m_sex, $prof_pic, $m_dept, $m_faculty, 
                    $userMail,  $wallPic, $load_page) = explode ("##", $memberInfo);
            
            $unreadMsg = numOfUnreadMsgAdmin($conn, $member_id);  /* number of admin unread message */ 

            $show_comp_wall = true;

        }catch(PDOException $e) {
            
            fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
                
        } 

        if(($admin_grade == $admin_fobrain_grd) && ($admin_level == $admin_tagged)){  /* check if user is admin */
            
            try {  

                $showBioID = 'showAdminBio';
                $changePassID = 'editAccess'; 

                $totalRegis = registrationCounter($conn);  /* student online registration counter */ 
                 

            }catch(PDOException $e) {
                
                fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
                    
            }

        }elseif(($admin_grade == $hm_fobrain_grd) && ($admin_level == $hm_fob_tagged)){  /* check if user is school head */

            try {

                $showBioID = 'showStaffBioH';
                $changePassID = 'editPass';  

                $totalRegis = registrationCounter($conn);  /* student online registration counter */ 

            }catch(PDOException $e) {
                
                fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
                    
            } 

        }elseif(($admin_grade == $cm_fobrain_grd) && ($admin_level == $cm_fob_tagged)){ /* check if user is school staff */

            try {

                $showBioID = 'showStaffBioH';
                $changePassID = 'editPass';  

            }catch(PDOException $e) {
                
                fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
                    
            } 

        }elseif(($admin_grade == $staff_fobrain_grd) && ($admin_level == $staff_fob_tagged)){ /* check if user is school staff */

            try {

                $showBioID = 'showStaffBioH';
                $changePassID = 'editPass';  

            }catch(PDOException $e) {
                
                fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
                    
            } 

        }else{  /* log this user out */
            
            header("Location: $fobrainLogOutDir");exit;
            
        }  

        $can_use_search = false;
        $nav_render = 0;
        $sibling_render = 0;

		require_once ($wizTemplate.'fobrain-header.php');  /* include template head */  
		
?>	

    <body id="wizg-wrapper"> 	
	
        <!----pre loader----->
		<div id="preload-wrapper">
			<div class="preloader" 
				style="background-image:url(<?php echo $fobrainTemplate; ?>/images/preloader.gif)">
			</div> 
		</div>
		<!----pre loader end-----> 
		
        <?php

        if ($_SESSION['screen_lock'] == 1111) {  /* check if screen lock is activated */ 
 
            $screen_name = $staff_t_name;
            $screen_img = $staff_img;
            $screen_link = "wiz-menu-1";
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
                                <i class="mdi mdi-text-box-search-outline" data-title="FoBrain Page Tour" data-intro="Student's Search Engine 👋"></i>
                            </button> 
                            <!-- / page search -->  
						</div> 
                        <div> 
                            <img class="rounded-circle header-profile-user" src="<?php echo $sch_logo; ?>" alt="School Logo"
                            data-title="FoBrain Page Tour" data-intro="Your School Logo 👋">  
                        </div>
                        <div> 
                            <h4 class="navbar-title-box animate__animated animate__shakeX"
                            data-title="FoBrain Page Tour" data-intro="Your School Name 👋"
                            > <?php echo $schoolNameTop; ?> </h4>	 
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

                         

						<?php //if(($admin_grade == $admin_fobrain_grd) && ($admin_level == $admin_tagged)){  /* check if user is admin */ ?>
                        <div class="dropdown-center">
                            <button type="button" class="btn header-item noti-icon position-relative" id="page-header-notifications-dropdown"
                            data-bs-toggle="dropdown" aria-haspopup="true" data-bs-auto-close="true" aria-expanded="false"> 
                                <i class="mdi mdi-comment-text-outline" data-title="FoBrain Page Tour" data-intro="Your inbox message notificaion 👋"></i>
                                <span class="badge inboxMsgNum"></span>
                            </button>
                            <div class="dropdown-menu  dropdown-menu-drop dropdown-shadow end-0 animate__animated animate__zoomIn"
                                aria-labelledby="page-header-notifications-dropdown">
                                <div class="border-size-1 border-fade bb-double">
                                    <div class="row align-items-center dropdown-menu-drop-wrap">
                                        <div class="col">
                                            <h6 class="m-0"> Message </h6>
                                        </div>
                                        <div class="col-auto">
                                            <a href="javascript:;" class="small text-reset text-decoration-underline"> Unread (<span class="inboxMsgNum"></span>)</a>
                                        </div>
                                    </div>
                                </div>
								
								<?php
							 
									try {

										njidekaCompanionInbox($conn, $member_id, $seVal);   /* companion mail notification */ 
							 
									}catch(PDOException $e) {
					
										fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
					 
									}

								?>
                                 
                            </div>
                        </div>
						
						<div class="dropdown-center">
                            <button type="button" class="btn header-item noti-icon position-relative" id="page-header-notifications-dropdown"
                            data-bs-toggle="dropdown" aria-haspopup="true" data-bs-auto-close="true" aria-expanded="false"> 
                                <i class="mdi mdi-bell-ring-outline"></i>
                                <span class="badge  notMsgNum"></span>
                            </button>
                            <div class="dropdown-menu  dropdown-menu-drop dropdown-shadow end-0 animate__animated animate__zoomIn"
                                aria-labelledby="page-header-notifications-dropdown">
                                <div class="border-size-1 border-fade bb-double">
                                    <div class="row align-items-center dropdown-menu-drop-wrap">
                                        <div class="col">
                                            <h6 class="m-0"> Notifications </h6>
                                        </div>
                                        <div class="col-auto">
                                            <a href="javascript:;" class="small text-reset text-decoration-underline"> Unread (<span class="notMsgNum"></span>)</a>
                                        </div>
                                    </div>
                                </div> 
									
								<?php
							 
									try {

										wallNotifications($conn, $member_id, $seVal);  /* companion mail notification */ 
							 
									}catch(PDOException $e) {
					
										fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
					 
									}

								?> 
                            </div>
                        </div> 
                        <?php //} ?>  

                        <div class="dropdown d-none d-sm-inline-block">
                            <button type="button" class="btn header-item right-bar-toggle me-2">
                                <i class="mdi mdi-account-cog-outline" data-title="FoBrain Page Tour" data-intro="Your School Settings 👋"></i>
                            </button>
                        </div>
                        
                        <div class="dropdown d-inline-block mobile-hide-component">
                            <button type="button" class="btn header-item bg-soft-light" id="page-header-user-dropdown"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img class="staff-picture-comp rounded-circle header-profile-user" src="<?php echo $staff_img; ?>"
                                    alt="Header Avatar"> 
                            </button>
                            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end profile-card-bg profile-card-drop-down p-0 m-0 animate__animated animate__zoomIn">      
                                <div class="profile-card   m-0">
                                    <span class="user"><i class="mdi mdi-dots-hexagon"></i> Active</span>
                                    <img
                                        class="staff-picture-comp round img-h-150"
                                        src="<?php echo $staff_img; ?>"
                                        alt="user" /> 
                                    <h3 class="staff-name-comp font-head-1q"><?php echo "$staff_t_name"?></h3>
                                    <h6><?php echo $userTag; ?></h6>
                                    <div class="row  justify-content-center mt-40 profile-link"> 
                                        <div class="col wiz-menu-1">                                            
											<a href="javascript:;" id="my-profile">
												<i class="mdi mdi-account-circle-outline"></i>
											</a>
                                        </div>
                                        <div class="col wiz-menu-1">                                            
											<a href="javascript:;" id="access">
												<i class="mdi mdi-account-key-outline"></i>
											</a>
                                        </div>	
                                        <div class="col wiz-menu-1">  
											<a href="javascript:;" id="reload-page">
												<i class="mdi mdi-refresh-circle"></i>
											</a>
                                        </div>	
										<div class="col wiz-menu-1">  
											<a href="javascript:;" id="lock-screen">
												<i class="mdi mdi-account-lock"></i>
											</a>
                                        </div>	
                                        <div class="col wiz-menu-1"> 
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
                            <img src="<?php echo $staff_img; ?>" class="staff-picture-comp rounded-circle"> 
                            <h4 class="staff-name-comp font-head-1a mt-5"><?php echo $staff_t_name; ?></h4>
                            <div class="wiz-menu-1"> 
                                <a href="javascript:;" id="my-profile">
                                    <i class="mdi mdi-account-tie"></i>
                                </a>
                                <span id="full-screen" data-toggle-fullscreen=""><i class="mdi mdi-fullscreen"></i></span> 
                                <i class="mdi mdi-text-box-search-outline" onclick="openSearch()"></i> 
                                <i class="mdi mdi-account-cog-outline right-bar-toggle"></i>                           
                                <a href="javascript:;" id="access">
                                    <i class="mdi mdi-account-key-outline"></i>
                                </a> 
                                <a href="javascript:;" id="log-out">
                                    <i class="mdi mdi-logout"></i>
                                </a> 
                            </div>
                        </div>   

                        <!-- left menu start -->
                        <ul class="metismenu list-unstyled" id="side-menu"> 

                            <li class="menu-title" data-key="t-menu">Menu</li>
                            
							<li class="wiz-menu-1">
							    <a href="javascript:;" id="home">
                                    <i class="mdi mdi-view-dashboard mdi-spin" id="home-pg"></i>
								    <span>My Dashboard</span>
							    </a>
							</li>

                            <li data-title="FoBrain Page Tour" data-intro="Switch between School sections here 👋">
                                <a href="javascript: void(0);" class="has-arrow">
                                    <i class="mdi mdi-login"></i>
                                    <span>Select School</span>
                                </a>
                                <ul class="sub-menu mm-show" aria-expanded="true">


                                    <?php 
									if(($admin_grade == $hm_fobrain_grd) && ($admin_level == $hm_fob_tagged)){ /* check if user is admin */   
                                        if(trim($nurseryHead) == trim($adminID)){
                                            echo '<li class="select-school">
                                                            <a href="javascript:;" id="log-nur">
                                                                <i class="mdi mdi-chevron-right"></i>
                                                                <span>Nursery (HM)</span>
                                                            </a>
                                                        </li>';
                                        }
                    
                                        if(trim($primaryHead) == trim($adminID)){
                                            echo  '<li class="select-school">
                                                            <a  href="javascript:;" id="log-pri">
                                                                <i class="mdi mdi-chevron-right"></i>
                                                                <span>Primary (HM)</span>
                                                            </a>
                                                        </li>';
                                        }
                    
                                        if(trim($secondaryHead) == trim($adminID)){
                                            echo  '<li class="select-school">
                                                            <a  href="javascript:;" id="log-sec">
                                                                <i class="mdi mdi-chevron-right"></i>
                                                                <span>Secondary (HM)</span>
                                                            </a>
                                                        </li>';
                                        } 
                                    }else{ 
									?>
                                     
                                        <li class="select-school">
                                            <a href="javascript:;" id="log-nur">
                                                <i class="mdi mdi-chevron-right"></i>
                                                <span>Nursery</span>
                                            </a>
                                        </li>
                                        
                                        <li class="select-school">
                                            <a  href="javascript:;" id="log-pri">
                                                <i class="mdi mdi-chevron-right"></i>
                                                <span>Primary</span>
                                            </a>
                                        </li> 

                                        <li class="select-school">
                                            <a  href="javascript:;" id="log-sec">
                                                <i class="mdi mdi-chevron-right"></i>
                                                <span>Secondary</span>
                                            </a>
                                        </li> 
                                    <?php } ?>
                                     
                                </ul>
                            </li>
                          
                            <?php if(($admin_grade == $admin_fobrain_grd) && ($admin_level == $admin_tagged)){  /* check if user is admin */  ?>
                                
                            <li data-title="FoBrain Page Tour" data-intro="Config all App Global settings here 👋">
                                <a href="javascript: void(0);" class="has-arrow">
                                    <i class="mdi mdi-content-save-cog-outline"></i>
                                    <span>Global Config.</span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                    <li class="wiz-menu-2"><a  href="javascript:;" id="school-configs">
                                        <i class="mdi mdi-chevron-right"></i> School Setup</a>
                                    </li>   
                                    <li class="wiz-menu-1"><a  href="javascript:;" id="burs-config">
                                        <i class="mdi mdi-chevron-right"></i> Bursary Config.</a>
                                    </li>
                                    <li class="wiz-menu-1"><a  href="javascript:;" id="library-config">
                                        <i class="mdi mdi-chevron-right"></i> Library Config.</a>
                                    </li> 	                                 
                                    <li class="wiz-menu-1"><a  href="javascript:;" id="session">
                                        <i class="mdi mdi-chevron-right"></i>  School Session </a>
                                    </li>
                                    <li class="wiz-menu-1"><a  href="javascript:;" id="score-grades">
                                        <i class="mdi mdi-chevron-right"></i> Grade Scores </a>
                                    </li>				  
                                    <li class="wiz-menu-1"><a  href="javascript:;" id="virtual-gateway">
                                        <i class="mdi mdi-chevron-right"></i> Virtual Gateway</a>
                                    </li>  
                                    <li class="wiz-menu-1"><a  href="javascript:;" id="payment-gateway">
                                        <i class="mdi mdi-chevron-right"></i> Payment Gateway</a>
                                    </li>    
                                    <li class="wiz-menu-1"><a  href="javascript:;" id="sms-config">
                                        <i class="mdi mdi-chevron-right"></i> SMS Config.</a>
                                    </li>	
                                    <li class="wiz-menu-1"><a  href="javascript:;" id="mail-config">
                                        <i class="mdi mdi-chevron-right"></i> Email Config.</a>
                                    </li> 				  
                                    <li class="wiz-menu-2"><a  href="javascript:;" id="teacher-remarks">
                                        <i class="mdi mdi-chevron-right"></i> Teacher's Remark</a>
                                    </li> 
                                    <li class="wiz-menu-2"><a  href="javascript:;" id="sports">
                                        <i class="mdi mdi-chevron-right"></i> Sports Lists</a>
                                    </li>   
                                </ul>
                            </li> 
                            <?php } ?>      

                            <?php 
                            //if(($admin_grade != $admin_fobrain_grd) && ($admin_level != $admin_tagged)){ /* check if user is admin */  
                            ?>
                            <li>
                                <a href="javascript: void(0);" class="has-arrow">
                                    <i class="mdi mdi-shield-account-outline"></i>
                                    <span>My HR</span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">     
                                    <li class="wiz-menu-1"><a  href="javascript:;" id="my-profile">
                                        <i class="mdi mdi-chevron-right"></i> My Profile</a>
                                    </li> 
                                    <li class="wiz-menu-1"><a  href="javascript:;" id="my-payroll">
                                        <i class="mdi mdi-chevron-right"></i>  My Payroll </a>
                                    </li> 
                                    <li class="wiz-menu-1"><a  href="javascript:;" id="my-leave">
                                        <i class="mdi mdi-chevron-right"></i>  My Leave</a>
                                    </li> 
                                    <li class="wiz-menu-1"><a  href="javascript:;" id="access">
                                        <i class="mdi mdi-chevron-right"></i>  Update Password</a>
                                    </li>                                            
                                </ul>
                            </li>

                            <?php //}  ?>

                            <?php if(($admin_grade == $admin_fobrain_grd) && ($admin_level == $admin_tagged) ||
                                    ($admin_grade == $hm_fobrain_grd) && ($admin_level == $hm_fob_tagged)){  /* check if user is admin or hm */  ?>       
                           
							
							<li>
                                <a href="javascript: void(0);" class="has-arrow">
                                    <i class="mdi mdi mdi-account-tie"></i>
                                    <span>Staffs HR</span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">     
                                    <li class="wiz-menu-1"><a  href="javascript:;" id="staff-records">
                                        <i class="mdi mdi-chevron-right"></i> Manage Staffs</a>
                                    </li>
                                     
                                    <li class="wiz-menu-1"><a  href="javascript:;" id="payroll">
                                        <i class="mdi mdi-chevron-right"></i>  Payroll </a>
                                    </li> 
                                    <li class="wiz-menu-1"><a  href="javascript:;" id="leave">
                                        <i class="mdi mdi-chevron-right"></i>  Staff Leave</a>
                                    </li> 
                                    <li class="wiz-menu-1"><a  href="javascript:;" id="staff-sms">
                                        <i class="mdi mdi-chevron-right"></i> Send SMS/Email</a>
                                    </li>                                      
                                </ul>
                            </li>

                            <li class="wiz-menu-1">
                                <a href="javascript:;" id="online-registration">
                                    <i class="mdi mdi-account-plus"></i>
                                    <span>New Registration
                                    <span class="w-badge" id="totalRegsCount">                                     
                                        <?php echo $totalRegis; ?>
                                    </span>
                                    </span>
                                </a>
                            </li>

                            <?php } ?>  

                            <li>
                                <a href="javascript: void(0);" class="has-arrow">
                                    <i class="mdi mdi-google-classroom"></i>
                                    <span> Live Meeting </span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">     
                                    <!--
                                    <li class="wiz-menu-1"><a  href="javascript:;" id="parent-meeting">
                                        <i class="mdi mdi-chevron-right"></i> Parent Meeting</a>
                                    </li>
                                    -->
                                    <li class="wiz-menu-1"><a  href="javascript:;" id="staff-meeting">
                                        <i class="mdi mdi-chevron-right"></i> Staff Meeting</a>
                                    </li>  
                                                                       
                                </ul>
                            </li>
                            
                            <?php if(($admin_grade == $admin_fobrain_grd) && ($admin_level == $admin_tagged)){  /* check if user is admin */  ?>

                            <li class="wiz-menu-1">
                                <a href="javascript:;" id="scratch-card" >
                                    <i class="mdi mdi-arrow-decision-auto"></i>
                                    <span>Scratch Card</span>
                                </a>
                            </li> 
                            <?php } ?>

							<li class="wiz-menu-1">
								<a href="javascript:;" id="wall-comp" >
									<i class="mdi mdi-hail"></i>
									<span id="CompanionWall">Companion Wall</span>
									<span class="w-badge notMsgNum"> </span>
								</a>
							</li> 

							<li class="wiz-menu-1">
								<a href="javascript:;" id="inbox">
									<i class="mdi mdi-email-box"></i>
									<span id="companionWallMailNav">Message Inbox</span>
									<span class="w-badge inboxMsgNum"> </span>
								</a>
							</li>  
                            
                            <li class="wiz-menu-1">
                                <a href="javascript:;" id="events" >
                                    <i class="mdi mdi-calendar-clock-outline"></i>
                                    <span>School Events </span>
                                </a>
                            </li>   

                            <li class="wiz-menu-1">
								<a href="javascript:;" id="broadcast">
									<i class="mdi mdi-account-tie-voice"></i>
									<span>Broadcast </span>
								</a>
							</li>

							<li class="wiz-menu-1">
								<a href="javascript:;" id="lock-screen">
									<i class="mdi mdi-account-lock"></i>
									<span>Lock Screen</span>
								</a>
							</li>
                                
							<li class="wiz-menu-1">
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