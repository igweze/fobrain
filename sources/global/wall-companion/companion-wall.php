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
	This script handle companion wall module

	------------------------------------------------------------------------*/

if(!session_id()){
    session_start();
}

		if (!defined('fobrain')) /* This checks if this page was wrongly access by users */

		die('Hahahaha, Hacking attempt . . . . Be Careful . . . . You Are Been Warned !!!!');

		if(isset($_SESSION['wallComRank'])){	

			require 'fobrain-config-s.php';  /* load fobrain configuration files */	 

			$userInfo = staffData($conn, $_SESSION['adminID']);  /* school staffs/teachers information */             
			list ($title, $userName, $userSex, $userRank, $user_picture, $userLName) = 
			explode ("#@s@#", $userInfo);	
			
			$titleVal = wizSelectArray($title, $title_list);                
			$staff_t_name = $titleVal.' '.$userLName;
			$staff_img = picture($staff_pic_ext, $user_picture, "staff"); 
			$userTag = wizSelectArray($_SESSION['accessLevel'], $adminRankingArr);

			$wall_name = "$staff_t_name";
			$comp_name = "$staff_t_name"; //  - $userTag
			$gender_gl =  $userSex;

		}else{ 
			
			require 'fobrain-config.php';  /* load fobrain configuration files */	 
			$wall_name = $student_name;

		}

		require_once ($fobrainCWallFunctionDir); /* load companion functions */	 

		try {

			//checkWallRegistration($conn, $wall_name, $gender_gl);	/* check if student is registered */	 

			$memberInfo = companionWallUserDetails($conn, $_SESSION['regNo'], $seVal);  /* retrieve student companion details */

			list ($member_id, $faRegNum, $m_name, $m_sex, $prof_pic, $m_dept, $m_faculty, $userMail, 
			$wallPic, $load_page) = explode ("##", $memberInfo);				

			$status = 'deleteTempPic';

			removeTempUpload($conn, $member_id, $status); /* remove temporary companion pictures information */


		}catch(PDOException $e) {

			fobrainDie( 'Ooops Database Error: ' . $e->getMessage());

		}

		if($userMail == '-'){

			$myMail = '
				<button type="button" class="btn btn-danger modal-mail-div"  
					data-bs-toggle="modal" data-bs-target="#modal-mail-div"> 
					Get Email
				</button>';

		}else{

			$myMail = $userMail.'@fobrain.com';

		}

		$profile_img = picture($forumPicExt, $prof_pic, "student");  
		$wall_wrapper_img = picture($forumPicExt, $prof_pic, "student");  
?>	
 		

		<!-- row -->
		<div <?php echo $fob_view; ?> class="row gutters row-section">
			<div class="col-lg-8 wall-card mb-50">	
				<!-- card start -->
				<div class="card mb-30">		
					<div class="card-body card-body-wall card-shadow pb-15 m-0">
						<!-- row start -->
						<div class="row gutters">
							<div class="col-12">
								<div class="profile-header pb-0">
									<h1 class="font-head-1">Welcome, <?php echo $comp_name; ?></h1>
									<div class="profile-header-content" style="background:url(<?php echo $wall_wrapper_img; ?>);
										background-position: center; background-size: cover; background-repeat: no-repeat;">
										<div class="profile-header-tiles">
											<div class="row gutters">
												<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
													<div class="profile-tile">
														<span class="icon">
															<i class="fas fa-user"></i>
														</span>
														<h6><span><?php echo $comp_name; ?></span></h6>
													</div>
												</div>
												<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
													<div class="profile-tile">
														<span class="icon">
															<i class="far fa-comment-alt"></i>
														</span>
														<h6> <span><?php echo $myMail; ?></span></h6>
													</div>
												</div>
												 
											</div>
										</div>
										<div class="profile-avatar-tile">
											<img src="<?php echo $profile_img; ?>" class="img-fluid" alt="User Profile" />
										</div>
									</div>
								</div> 
							</div>
						</div>
						<!-- row end --> 

						<!-- row start -->
						<div class="row gutters">
							<div class="col-12"> 
								<!-- card start -->
								<div class="card"> 
									<div class="card-body pb-0 my-0 py-0">
									<div class="text-primary font-head-1 text-left my-10">Share your feelings !</div>
										<div class="c-wall-container"> 									
											<div id="wallMsgDiv">
												<!-- form -->
												<form method="POST" id="frmPost" class="highlight-textarea">
													<input type="hidden" name="postFData" value="sendpostFData" />                         
													<textarea class="form-control input-lg p-text-area" style="border: 1px solid #999999 !important;" 
													rows="3" name="fPostField" onclick="highlight();"
													id="fPostField" placeholder="What&#039;s on your mind?"></textarea>
													<button class="btn btn-white pull-right hide" id='postStatus'>Post</button>
												</form>
												<!-- / form -->
											</div>

											<div id="wallPictureDiv" class="display-none row">
												 
												<!-- form -->
												<form id="frmuploadPic" method="post">												 
													<div id="StatusImgHolder" class="c-wall-img-holder"> 
														<div class="col-lg-12">											 
															<input type="text" class="form-control py-10" placeholder="Your Picture or ALbum Caption" 
															name="uploadPicTitle" id="uploadPicTitle" style="border:0px; border-bottom:1px solid #ccc;" />										 
														</div>								 
														<div id="previewPic" class="col-lg-12"></div>												 
														<input type="hidden" name="postFData" value="senduploadPicData" />
														<button id='uploadPic' style="display:none;"></button>											
													</div>
												</form>
												<!-- / form -->  
												 
												<div class=" row c-wall-upload-div"> 
													<div class="col-lg-12 text-danger fs-10">* Maximum of 4 image per upload, picture size of 2 MB &amp; only
													<?php echo $allowedPicExt; ?> are allowed.</div>   
													 
												</div> 	 
											</div> 							
											
											<div class="share-thoughts-footer row my-10">										
												<div class="share-icons col-6">										
													<!-- form -->
													<form id="frmWallUploader" method="post" enctype="multipart/form-data"> 
														<input type="hidden" name="postFData" value="senduploadPicData" /> 
														<input type="hidden" name="postFData2" value="uploadPicData" />
														<label class="upload component-free">
															<i class="fas fa-camera fs-16 text-danger mt-5 me-10"></i> 															
															<input type="file" name="photoimg" id="wallPics" class="form-control hide"/>
														</label>   
													</form>
													<!-- / form -->
													<a href="javascript:;" class="coming_soon">
														<i class="fas fa-link"></i>
													</a>
													<a href="javascript:;" class="coming_soon">
														<i class="fas fa-map-marker-alt"></i>
													</a>
													<a href="javascript:;" class="coming_soon">
														<i class="fas fa-user"></i>
													</a>
												</div> 
												<div class="text-end  col-6">
													<button class="btn btn-primary btn-sm mt-5 component-free" id='postStatusSE'>Post</button>
													<button class="btn btn-danger btn-sm me-10 display-none" id="exitUploadDiv">Cancel</button>
													<button class="btn btn-primary btn-sm display-none" id='uploadPicSE'>Upload</button>
													 
													<div class="display-none text-danger" id='postLoader'> 
														<strong role="status">Processing...</strong>
														<div class="spinner-border ms-auto" aria-hidden="true"></div>
													</div>
												</div>
												
												 
											</div>
										</div>
									</div>
								</div>
								<!-- card end --> 
							</div>
						</div>
						<!-- row end -->	
						
		

					</div>
				</div>
				<!-- card end -->	
					
				<!-- card start -->
				<div class="card">		 
					<div class="card-body card-body-wall card-shadow"> 
						<div class="comp-head-menu"> 
							<div class="btn-group no-hide-res mt-10">
								<button type="button" class="btn btn-primary"><i class="fas fa-bars label-icon"></i> Menu</button>
								<button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-expanded="false">
									<i class="mdi mdi-chevron-down"></i>
								</button>
								<div class="dropdown-menu">
									<a class="dropdown-item companionWallPosts" href="javascript:;"><i class="bx  bx-home label-icon"></i> Home </a>
									<a class="dropdown-item showcompanionWallUser" href="javascript:;" <?php echo 'id="companionWallUser-'.$member_id.'"'; ?> ><i class="bx  bx-user-voice label-icon"></i> My Wall</a>
									<a class="dropdown-item modal-filter-div" data-bs-toggle="modal" data-bs-target="#modal-filter-div"
									href="javascript:;"><i class="bx bx-customize label-icon"></i> Customize</a>
								</div>
							</div><!-- /btn-group --> 
							<a href="javascript:;" id="" 
								class ="btn btn-primary waves-effect btn-label waves-light me-15 mt-10
								companionWallPosts fb-top-btn current hide-res">									
								<i class="bx  bx-home label-icon"></i> Home 
							</a> 
							<a href="javascript:;" <?php echo 'id="companionWallUser-'.$member_id.'"'; ?> 
								class ="showcompanionWallUser btn btn-primary waves-effect btn-label waves-light me-15 mt-10 hide-res">									
								<i class="bx  bx-user-voice label-icon"></i> My Wall
							</a> 
							<a data-bs-toggle="modal" data-bs-target="#modal-filter-div"
								class ="btn btn-primary waves-effect btn-label waves-light me-15 mt-10  modal-filter-div hide-res">									
								<i class="bx bx-customize label-icon"></i> Customize
							</a> 
						</div>

						<div class="comments-container"> 
							<ul id="comments-list" class="comments-list"> 
								<div id="fmsgBox"> </div> <div id="newPostDiv"></div> 
								<div id="chisomLoadDiv"> 
								<?php 
									
									try {

										if (isset($_REQUEST["notificPostID"])){

											$postID = $_REQUEST['notificPostID'];

											companionWallAlerts($conn, $postID); /* load companion posts*/

											echo "<script type='text/javascript'>

											$('html, body').animate({ scrollTop:  $('#chisomLoadDiv').offset().top - 100 }, 'slow'); 

											</script>";

										}else{

											loadCompanionWall($conn, $load_page, $m_dept, $m_faculty);  /* load companion posts*/
										}

									}catch(PDOException $e) {

										fobrainDie( 'Ooops Database Error: ' . $e->getMessage());

									} 
								?>							
								</div>	 
							</ul>
						</div>	
					</div>
				</div>
				<!-- card end -->	
			</div> 

			<div class="col-lg-4 mob-gap"> 
				<div class="card card-shadow">
					<div class="card-header-wiz">
						<h4>
						<i class="fas fa-user-check fs-16"></i> 
							Active Users
						</h4>
					</div> 
					<!-- card body -->
					<div class="card-body d-flex gap-2 flex-wrap">	 
						<?php

							try {

								activeCWallMembers($conn);  /* load active companion wall users */

							}catch(PDOException $e) {

								fobrainDie( 'Ooops Database Error: ' . $e->getMessage());

							}

						?> 
					</div>
					<!-- end card body -->						
				</div>
				<!-- end card --> 
			</div>		 
		</div>
		<!-- / row -->	


		<!-- companion email registration modal start -->			
		<button type="button" class="btn modal-mail-div display-none"  data-bs-toggle="modal" data-bs-target="#modal-mail-div"></button>
		<!-- Scrollable modal -->
		<div class="modal fade animate__animated animate__zoomInDown" id="modal-mail-div" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">			<div class="modal-dialog modal-fullscreen-sm-down modal-dialog-scrollable">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalScrollableTitle"> 
							<i class="mdi mdi-account-reactivate label-icon"></i>  
							Email Registation
						</h5>
						<div id="registMailMsg"> </div>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body slideUpFrmUDiv">

						<div class="row gutters my-30">
							<div class="col-12">	
								<!-- card start -->
								<div class="card fobrain-section-div">
									<div class="input-group mb-3">										
										<input type="text" class="form-control" name="cMailUser" id="cMailUser" placeholder="Enter your desire mail">
										<div class="input-group-append">
											<span class="input-group-text">@fobrain.com
												<i class="fas fa-check text-success availMail display-none mx-10"></i>
												<i class="fas fa-times text-danger mailAlready display-none mx-10"></i>
												<span class="spinner-border mail-spinner text-danger mx-10 display-none" role="status">
												  <span class="visually-hidden">Loading...</span>
												</span> 					 
											</span> 
										</div>										 
										<div class="form-text">
											* Only Alphabets &amp; Numbers are only  accepted and 
											you can only register once.
										</div>
									</div> 
								</div> 
							</div>
						</div> 
					</div>
					<div class="modal-footer">
						<button type="submit" class="btn btn-primary  btn-label waves-light demo-disenable registerCMail display-none" 
						id="registerCMail"><i class="fas fa-user-plus label-icon"></i> 
							Register
						</button>
						<button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
					</div>
				</div><!-- /.modal-content -->
			</div><!-- /.modal-dialog -->
		</div><!-- /.modal -->
		<!-- companion email registration modal end -->		
		


					
		<!-- companion email registration modal start -->			
		<button type="button" class="btn modal-filter-div display-none"  data-bs-toggle="modal" data-bs-target="#modal-filter-div"></button>
		<!-- Scrollable modal -->
		<div class="modal fade animate__animated animate__zoomInDown" id="modal-filter-div" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">			<div class="modal-dialog modal-fullscreen-sm-down modal-dialog-scrollable">
				<div class="modal-content">
					<div class="modal-header"> 
						<h5 class="modal-title" id="exampleModalScrollableTitle"> 
							<i class="mdi mdi-sort-bool-descending-variant label-icon"></i>  
							Filter Feeds  Manager
						</h5>
						<div id="registMailMsg"> </div>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body slideUpFrmUDiv">

						<div class="row gutters my-30">
							<div class="col-12">	
								<!-- card start -->
								<div class="card fobrain-section-div">

									<!-- form -->
									<form class="form-horizontal" id="frmRS2" role="form"> 
									
										<!-- field wrapper start -->
										<div class="field-wrapper text-left">
											<select class="form-control"  id="filterCWallSetting" name="filterCWallSetting" required>
												
												<option value = "">Please select one</option>

												<?php

													foreach($filterCWall as $filterCWallKey => $filterCWallVal){

														if ($load_page == $filterCWallKey){
															
															$selected = "SELECTED";
															
														} else {

															$selected = "";

														}

														echo '<option value="'.$filterCWallKey.'"'.$selected.'>
														'.$filterCWallVal.'</option>' ."\r\n";

													}

												?>							   
											</select>
											<div class="field-placeholder">* Filter Feeds <span class="text-danger">*</span></div>
											<div class="form-text text-danger">
												How to filter my Companion Wall feeds
											</div>
										</div>
										<!-- field wrapper end -->	 

									</form>
									<!-- / form -->
									 
								</div> 
							</div>
						</div> 
					</div>
					<div class="modal-footer">						 
						<button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
					</div>
				</div><!-- /.modal-content -->
			</div><!-- /.modal-dialog -->
		</div><!-- /.modal -->
		<!-- companion email registration modal end -->		

			

			<div class="refresh"> </div> <div id="status-overlay" style="display: none"></div>

			<script type='text/javascript'>

				$(document).ready(function(){
					$('textarea').on('click', function(e) {
						e.stopPropagation();
					});
					
					$(document).on('click', function (e) {
						
						$("#status-overlay").hide();
						$(".highlight-textarea").css('z-index','1');
						$(".highlight-textarea").css('position', '');
					
					});
				});

				function highlight() {

					$("#status-overlay").show();
					$(".highlight-textarea").css('z-index','9999999');
					$(".highlight-textarea").css('position', 'relative');
					
				}  
				
			</script>	

			<?php

				if($component_free == 1){

					$msg_i = "* Ooops, your account does not support this module. Please upgrade to access these features.";
					
					echo $infoMsg.$msg_i.$iEnd; 
					echo "<script type='text/javascript'>   
							$('.component-free').hide();
					</script>";

				}

			?>
