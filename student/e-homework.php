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
	This script handle student online homework
	------------------------------------------------------------------------*/

if(!session_id()){
    session_start();
}
 
    	define('fobrain', 'igweze');  /* define a check for wrong access of file */

        require 'fobrain-config.php';  /* load fobrain configuration files */ 
		
		/* script validation */
				
		if ($_REQUEST['query'] == 'load') {  /* load homework module */
			
			$eID =   cleanInt($_REQUEST['eID']);
			
			/* script validation */
			
			if ($eID == ""){
         			
					$msg_e = "* Ooops, an error has occur to retrieve homework information. Please try again";
					echo $errorMsg.$msg_e.$eEnd; 
					echo "<script type='text/javascript'>   hidePageLoader(); </script>";exit;
					
	   		}else{ 
				
				try {
						$onlineHomeWorkInfoArr = onlineHomeWorkInfo($conn, $eID);  /* online student homework information */
						$sessionID = $onlineHomeWorkInfoArr[$fiVal]["session"];
						$level = $onlineHomeWorkInfoArr[$fiVal]["level"];
						$eTerm = $onlineHomeWorkInfoArr[$fiVal]["eTerm"];
						$class = $onlineHomeWorkInfoArr[$fiVal]["class"];
						$eTitle = $onlineHomeWorkInfoArr[$fiVal]["eTitle"];
						$eSubject = $onlineHomeWorkInfoArr[$fiVal]["eSubject"];
						$eDetail = htmlspecialchars_decode($onlineHomeWorkInfoArr[$fiVal]["eDetail"]);
						$eTime = $onlineHomeWorkInfoArr[$fiVal]["eTime"];
						$eTerm = $term_list[$eTerm]; 

						$session = fobrainSession($conn, $sessionID);  /* school session  */
						$sessionS = ($session + $fiVal);
						$eDetail = nl2br($eDetail);	
						
						$homeworkQuestionsArr = homeworkQuestions($conn, $eID);  /* online homework question array */
						shuffle($homeworkQuestionsArr);
						array_unshift($homeworkQuestionsArr,"");
						unset($homeworkQuestionsArr[0]);
						$countQuestion = count($homeworkQuestionsArr);
						
						$levelArray = studentLevelsArray($conn); /* student level array */	
				
						array_unshift($levelArray,"");
						unset($levelArray[0]); 
						
						$homeworkLevel = $levelArray[$level]['level']; 
						
$quest_div =<<<IGWEZE
        

						<div class="row gutters">
							<div class="col-12"> 
								<h3 class="fs-14 mb-1 text-center text-info"><strong> COURSE: $eSubject  </strong></h3>
								<div class="mx-auto mb-20 mt-10 text-center">
									 <img src="$student_img" alt="" class="img-h-100 rounded-circle img-thumbnail">
								</div>
								<h3 class="fs-14 mb-1 text-center text-warning"><strong> EXAM TITLE: $eTitle  </strong></h3>
								<h4 class="fs-14 my-10 text-danger"><strong><u> EXAM INSTRUCTIONS </u></strong></h4>
								<ul class="wiz-list text-justify fs-14">
									<li>You are expected to select only one option as your answer to each question.</li>
									<li>You have <span class="text-danger fw-700">$countQuestion questions and $eTime minutes,</span> which will be counting down at the top right corner of the test page to take this test.</li>
									<li>If you are unable to complete the test in time, it will automatically save and submit what you were able to attempt for assessment.</li>
									<li>If you do not have an instant idea of a question you can skip it by clicking on the next button, you can re-attempt the skipped question when you have attempted others. Meanwhile at the end of the test, you will have access to the various answers for the different questions.</li>
								</ul>	 
								<a class="btn btn-outline-success waves-effect waves-light  my-30">Wishes you best of LUCK !</a> 
							</div>
						</div>
						
						<div class="row gutters text-center">
							<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-6 mb-20">
								<button type="button" class="btn btn-outline-primary waves-effect waves-light w-sm">
									<i class="mdi mdi-calendar d-block font-size-20"></i> $eTerm 
								</button>
							</div>
							<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-6 mb-20">
								<button type="button" class="btn btn-outline-danger waves-effect waves-light w-sm">
									<i class="mdi mdi-book-education-outline d-block font-size-20"></i> $homeworkLevel 
								</button>
							</div> 						 
							<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-6 mb-20">
								<button type="button" class="btn btn-outline-dark waves-effect waves-light w-sm">
									<i class="mdi mdi-progress-clock d-block font-size-20"></i> $eTime Mins
								</button>
							</div>
							<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-6 mb-20">
								<button type="button" class="btn btn-outline-danger waves-effect waves-light w-sm">
									<i class="mdi mdi-message-question-outline d-block font-size-20"></i> $countQuestion <span class="hide-res">Question/s</span>
								</button>
							</div>
							<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-6 mb-20">
								<button type="button" class="assignPage btn btn-outline-primary waves-effect waves-light w-sm">
									<i class="mdi mdi-step-backward d-block font-size-20"></i> Go Back
								</button>
							</div>
							<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-6 mb-20">
								<button type="button" id="fobrain-$eID" class="start-hwork btn btn-outline-success waves-effect waves-light w-sm">
									<i class="mdi mdi-play-speed d-block font-size-20"></i> Start
								</button>
							</div>
						</div> 
						
		
IGWEZE;
                               
		                echo $quest_div;
								
						
					}catch(PDOException $e) {
					
						fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
					 
					}	
				
				echo "<script type='text/javascript'>   hidePageLoader(); </script>";exit;
			}	
			
		}elseif ($_REQUEST['query'] == 'start') {  /* start homework question */			
			
			$eID =   cleanInt($_REQUEST['eID']);
			
			/* script validation */
			
			if ($eID == ""){
         			
				$msg_e = "* Ooops, an error has occur to retrieve homework information. Please try again";
				echo $errorMsg.$msg_e.$eEnd; 
				echo "<script type='text/javascript'>   hidePageLoader(); </script>";exit;
					
	   		}else{

				try {

					$onlineHomeWorkInfoArr = onlineHomeWorkInfo($conn, $eID);  /* online student homework information */
					$sessionID = $onlineHomeWorkInfoArr[$fiVal]["session"];
					$level = $onlineHomeWorkInfoArr[$fiVal]["level"];
					$eTerm = $onlineHomeWorkInfoArr[$fiVal]["eTerm"];
					$class = $onlineHomeWorkInfoArr[$fiVal]["class"];
					$eTitle = $onlineHomeWorkInfoArr[$fiVal]["eTitle"];
					$eSubject = $onlineHomeWorkInfoArr[$fiVal]["eSubject"];
					$eDetail = htmlspecialchars_decode($onlineHomeWorkInfoArr[$fiVal]["eDetail"]);
					$eTime = $onlineHomeWorkInfoArr[$fiVal]["eTime"];
					$eTerm = $term_list[$eTerm];

					$session = fobrainSession($conn, $sessionID);  /* school session  */
					$sessionS = ($session + $fiVal);
					$eDetail = nl2br($eDetail);	
					
					$homeworkQuestionsArr = homeworkQuestions($conn, $eID);  /* online homework question array */
					shuffle($homeworkQuestionsArr);
					array_unshift($homeworkQuestionsArr,"");
					unset($homeworkQuestionsArr[0]);
					$homeworkQuestionsCount = count($homeworkQuestionsArr);
					
				}catch(PDOException $e) {
				
					fobrainDie( 'Ooops Database Error: ' . $e->getMessage());
					
				}	 
			
				if($homeworkQuestionsCount >= $fiVal){  /* check array is empty */			
					
					$homeworkSeconds =	($eTime * 60); $qNo = 0; $optNo = 0; $questionDiv = "";
					
					$optionLists = ""; $questionNum = ""; 
					
					for($i = $fiVal; $i <= $homeworkQuestionsCount; $i++){  /* loop array */	
					
						$qID = $homeworkQuestionsArr[$i]["qID"];
						$eID = $homeworkQuestionsArr[$i]["eID"];
						$question = htmlspecialchars_decode($homeworkQuestionsArr[$i]["question"]);
						$qPicture = $homeworkQuestionsArr[$i]["qPicture"]; 

						$q1 = htmlspecialchars_decode($homeworkQuestionsArr[$i]["q1"]);
						$q2 = htmlspecialchars_decode($homeworkQuestionsArr[$i]["q2"]);
						$q3 = htmlspecialchars_decode($homeworkQuestionsArr[$i]["q3"]);
						$q4 = htmlspecialchars_decode($homeworkQuestionsArr[$i]["q4"]);
						$ans = htmlspecialchars_decode($homeworkQuestionsArr[$i]["ans"]); 

						$qMark = $homeworkQuestionsArr[$i]["qMark"];									
						$question = nl2br($question);
						$qNo++;	 
						 

						$qOptionsArr = array(); 
						$qOptionsArr[1] = $q1.quesTags(1, $ans);
						$qOptionsArr[2] = $q2.quesTags(2, $ans);
						$qOptionsArr[3] = $q3.quesTags(3, $ans);
						$qOptionsArr[4] = $q4.quesTags(4, $ans); 
						
						shuffle($qOptionsArr);
						
						foreach($qOptionsArr as $optKey => $options){  /* loop array */
								
							$optNo++;

							list ($options, $ans_tag) = explode ("<!-fob-!>", $options); 
							 
							if(trim($ans_tag) == 1){												
								$optVal = $fiVal;
								$ansQClass = "radio-button";//correctAns	
							}else{
								$optVal = $i_false;
								$ansQClass = "radio-button";
							}	 

							$optionLists .= '<p class='.$ansQClass.'  id="p-'.$optNo.'-'.$qMark.'-'.$qNo.'-'.$optVal.'">
									
								<input type="radio" id="qOpt-'.$optNo.'-'.$qMark.'-'.$qNo.'-'.$optVal.'" 
									name="qOpt-'.$qNo.'" value="'.$optVal.'" class="radio-btn"/>
								<label for="qOpt-'.$optNo.'-'.$qMark.'-'.$qNo.'-'.$optVal.'">'.$options.'</label>
									
								</p>';//
							$ansQClass = '';		
						
						}
						
						$optNo = "";
						
						if($qMark != ""){
							
							if($qMark > $fiVal){
								
								$qMarkV = "Marks";
								
							}else{ $qMarkV = "Mark"; }	
							
							$qMarkDiv = "$qMark $qMarkV";
							
						}

						if($qPicture != ""){

							//$eQpic = $fobrainQuestionDir.$qPicture;
							$eQpic = picture($fobrainQuestionDir, $qPicture, "exam");

							$eQpicDiv = "<img src='$eQpic' class='img-fluid card-shadow mb-10' alt='Question $qNo Image' />";
									
						}else{ $eQpicDiv = ""; }				


$questNum =<<<IGWEZE
        							  
									 
                        	<button class="eBtn btn btn-light homeworkQuestNum" id="eQNo-$qNo" type="button">$qNo</button>
                                     
		
IGWEZE;
                               
							$questionNum .= $questNum;
									

$questDiv =<<<IGWEZE
						<div class="question-$qNo" id="question-$qNo">	  
						
							<h4> <i class="fa fa-question-circle"></i> Question <b><i>$qNo</i></b> of $homeworkQuestionsCount  <b><i>($qMarkDiv)</i></b>  </h4>
								
							<section class="questionStyle my-10">
								<b>$qNo</b> : $question 
							</section>
								
							<section class="radios optionsQDiv rounded10"> 
								$eQpicDiv 
								$optionLists 
							</section> 
							
						</div>
						
		
IGWEZE;
								
						$questionDiv .= $questDiv;
								
						$optionLists = "";
						$qOptionsArr = ""; 
								
					}

					
				}	 
?>
                 	  
                    
			<!-- row -->		
			<div class="row card-shadow-none">
                <div class="col-lg-4">
					<!-- card start -->
					<div class="card card-homework">
						<div class="card-header-wiz">
							<h4>
							<i class="mdi mdi-account-arrow-right-outline 
							font-size-30 align-middle me-1"></i> 
							 Question Status
							</h4>
						</div>   
						<div class="card-body card-body-homework"> 
                              <div class="task-thumb-details homeworkQuestionDiv">  
								  <div class="btn-toolbar">		 
                                      <?php echo $questionNum; ?> 
                                  </div>
                              </div>
							<hr/>  
                          
							<!-- table -->
							<table class="table table-hover table-borderless style-table"  id="questDescTB">
                              <tbody>
                                <tr>
                                    <td>
                                        <button class="btn btn-info eBtnDesc" type="button"></button>
                                    </td>
                                    <td class="text-left">Answered</td> 
                                </tr>
                                <tr>
                                    <td>
                                        <button class="btn btn-dark eBtnDesc" type="button"></button>
                                    </td>
                                    <td class="text-left"> Not Answered</td> 
                                </tr>
                                <tr>
                                    <td>
                                        <button class="btn btn-danger eBtnDesc" type="button"></button> 
                                    </td>
                                    <td class="text-left">Review Later (If not answer)</td> 
                                </tr>
								<tr>
                                    <td>
                                        <button class="btn btn-success eBtnDesc" type="button"></button>
                                    </td>
                                    <td class="text-left">Review Later (If answer)</td> 
                                </tr>
                                <tr>
                                    <td> 
                                        <button class="btn btn-light eBtnDesc" type="button"></button> 
                                    </td>
                                    <td class="text-left">Not Visited</td> 
                                </tr>
                              </tbody>
                          </table>
						  <!-- / table --> 
						  
						  <!-- table -->
						  <table class="table table-hover style-table display-none" id="ansDescTB">
                              <tbody>
                                <tr>
                                    <td>
                                        <button class="btn btn-success eBtnDesc" type="button"></button>
                                    </td>
                                    <td class="text-left">Correct Answer</td>
                                    
                                </tr>
                                <tr>
                                    <td>
                                        <button class="btn btn-info eBtnDesc" type="button"></button>
                                    </td>
                                    <td class="text-left"> Not Answered (Correct)</td>
                                    
                                </tr>
                                <tr>
                                    <td>
                                        <button style="background-color:#ee0000 !important" 
										class="btn  eBtnDesc" type="button"></button>
                                    </td>
                                    <td class="text-left">Wrong Answer</td>
                                   
                                </tr>
                               
								
								
                              </tbody>
                          </table>
						  <!-- / table -->

<?php


$homeworkSummary =<<<IGWEZE

						
						
						<!-- table -->
						<table class="table table-hover style-table display-none" id="homeworkSummary">
                              <tbody>
							  
								<tr>
                                    <td class="text-left text-danger" style="padding-left:5% !important"><strong>Your time has elapsed!</strong></td>
                                </tr>
								
								 <tr>
                                    <td class="text-left" style="padding-left:5% !important"><strong>Time Spent:</strong> $eTime Minutes</td>                                    
                                </tr>
								
								<tr>								
                                    <td class="text-left" style="padding-left:5% !important"> <strong>Course Subject </strong>: $eSubject </td>  
                                </tr>
								
								<tr>								
                                    <td class="text-left text-info" style="padding-left:5% !important"> <strong>HomeWork Performance</strong> </td>                                    
                                </tr> 
                                
                                <tr>
                                    <td class="text-left" style="padding-left:5% !important"> You answered
									<strong><span id="correctAnswer" class="text-info"></span></strong> out of 
									<span class="text-success"><strong>$homeworkQuestionsCount</strong></span> questions correctly! </td>                                    
                                </tr> 
								
								<tr>
                                    <td class="text-left text-info" style="padding-left:5% !important">You  
									score <strong><span id="studentScore" class="text-info"></span></strong> out of 
									<strong><span id="homeworkScore" class="text-success"></span></strong> Marks 
									(<strong><span class="scorePercent"></span>%</strong>)</td>                                    
                                </tr>
								
								<tr>
                                    <td class="text-left text-danger fw-600 fs-16" style="padding-left:5% !important">
									
										<div class="pull-left">Your Score Average :<strong> <span class="scorePercent text-info"></span><span class="text-info">%</span></strong></div>
										<br clear="all"/>
										
										<div class="progress mt-10">
											<div class="progress-bar progress-bar-striped progress-bar-animated styleProgress" 
											role="progressbar" aria-valuenow="" aria-valuemin="0" aria-valuemax=""></div>
										</div>
											
										<!-- 
											<div class="progress progress-striped active progress-sm">
												<div class="progress-bar progress-bar-success styleProgressa"  role="progressbar" 
												aria-valuenow="" 
												aria-valuemin="0" aria-valuemax=""> </div>
											</div> 
										 -->							  
									</td>
                                </tr> 							  
                              </tbody>
                          </table>	
						<!-- / table -->
						<div id="msg-box-e"></div>
							<input type="hidden" name = "homeworkID" id = "homeworkID" value= "$eID">
							<input type="hidden" name = "quesno" id = "quesno" value= "$homeworkQuestionsCount">
						


						  
IGWEZE;

						echo $homeworkSummary;

?>							

					   </div>
					</div>
				</div>
				<div class="col-lg-8">
					<!-- card start -->
					<div class="card card-homework">
						<div class="card-header-wiz">
							<h4>
							<i class="mdi mdi-account-arrow-right-outline 
							font-size-30 align-middle me-1"></i> 
							 HomeWork Questions
							</h4>
						</div>  
						
						<div class="card-body card-body-homework"> 
							<div class="topQuestDiv mb-20">
								<div id="homeworkProgressDiv">
									<div class="percent pull-left"></div>
									<div class="elapsed pull-right"></div><br clear="all"/>
									<div class="pbar progress-bar mt-10"></div>
								</div> 
							</div>
							
							<div class="display-none reviewHomeWork pull-right my-10">
								<button type="button" class="btn btn-primary waves-effect btn-label waves-light btn-d-" id="reviewHomeWork">
								<i class="mdi mdi-list-status label-icon"></i> Review </button>
							</div>
						
							<div class="homeworkQuestionDiv" id="homeworkQuestionDiv">
								<div class="homeworkQuestDiv card-shadow py-20 px-15">
									<?php echo $questionDiv; ?>								
								</div>	  
								<div class="row my-20" style="clear:both;"> 
									<!-- question navigation button --> 
									<div class="col-4 text-left">   
										<button type="button" class="btn btn-sm btn-exam btn-primary mb-15" 
											id="prev"><i class="mdi mdi-page-previous-outline label-icon"></i> 
											Prev<span class="hide-res">ious</span>
										</button> 
									</div>
									<div class="col-4 text-center"> 
										<button type="button" class="btn  btn-sm btn-exam btn-danger mb-15" 
										id="reviewQuest"><i class="mdi mdi-list-status label-icon"></i>  
										Rev<span class="hide-res">iew  Later</span>
									</button>
										<!--<button type="button" class="btn btn-info" id="clearQuest">
											<i class="fa fa-refresh"></i> Clear 
										</button>-->
									</div>
									<div class="col-4 text-right"> 
										<button type="button" class="btn btn-sm btn-exam btn-primary  mb-15" id="next">
											Next <i class="mdi mdi-page-next-outline label-icon"></i> 
										</button> 
									</div> 
									<!-- / question navigation button -->
								</div>								
							</div>	 							
						</div>								  
                    </div>                  
                 </div>
            </div>
			<!-- / row -->
			
 
		<script type="text/javascript"> 
			  
			$(document).ready(function(){
					
				var homeworkSeconds = <?php echo $homeworkSeconds; ?>;
				var scorePercenta = 30;
				$('.styleProgress').css('width', scorePercenta+'%');
				
				jQuery.fn.homeworkProgress = function (aOptions) {
					/* define values */
					var iCms = 1000;
					var iMms = 60 * iCms;
					var iHms = 3600 * iCms;
					var iDms = 24 * 3600 * iCms;
					/* define options */
					var aDefOpts = {
						start: new Date(), // now
						finish: new Date().setTime(new Date().getTime() + homeworkSeconds * iCms), // now + 60 sec
						interval: 100
					}
					var aOpts = jQuery.extend(aDefOpts, aOptions);
					var vPb = this;
					/* each progress bar */ 
					return this.each(
						function() {
						var iDuration = aOpts.finish - aOpts.start;
						/* calling original progressbar */
						$(vPb).children('.pbar').progressbar();
						/* loop array */
							var vInterval = setInterval(
								function(){
									var iLeftMs = aOpts.finish - new Date(); // left time in MS
									var iElapsedMs = new Date() - aOpts.start, // elapsed time in MS
									iDays = parseInt(iLeftMs / iDms), // elapsed days
									iHours = parseInt((iLeftMs - (iDays * iDms)) / iHms), // elapsed hours
									iMin = parseInt((iLeftMs - (iDays * iDms) - (iHours * iHms)) / iMms), // elapsed minutes
									iSec = parseInt((iLeftMs - (iDays * iDms) - (iMin * iMms) - (iHours * iHms)) / iCms), // elapsed seconds
									iPerc = (iElapsedMs > 0) ? iElapsedMs / iDuration * 100 : 0; // percentages
									/* display current positions and progress */
									$(vPb).children('.percent').html('<b>'+iPerc.toFixed(1)+'%</b>');
									//$(vPb).children('.elapsed').html(iDays+' Days '+iHours+'H : '+iMin+'M : '+iSec+'S</b>');
									$(vPb).children('.elapsed').html(iHours+'H : '+iMin+'M : '+iSec+'S</b>'); //Removing Day
									$(vPb).children('.pbar').children('.ui-progressbar-value').css('width', iPerc+'%');
									/* in case of finish */
									if (iPerc >= 100) {
										clearInterval(vInterval);
										$(vPb).children('.percent').html('<b>100%</b>');
										$(vPb).children('.elapsed').html('<span class="text-danger">Time Elapsed!</span>');
										homeworkFinished();													
									}
								} ,aOpts.interval
							);
						}
					);
				}
				
				/* default mode */
				$('#homeworkProgressDiv').homeworkProgress();
			
				$(".homeworkQuestDiv div").each(function(e) {
					if (e != 0)
						$(this).hide();
				});
				
				$("#next").click(function(){ /* navigate to next question */
					
					var vQuest = $('.homeworkQuestDiv div:visible'),
					vQuestID = vQuest.attr('id'); 
					
					var sQuestID = vQuestID.split('-');
					var qID = sQuestID[1];
					var qName = 'qOpt-'+qID;
					
					var ansQuest = $('input:radio[name='+qName+']:checked').val();					
					
					if (ansQuest === undefined || ansQuest === null) {							
						
						$('#eQNo-'+qID).removeClass("btn-light");	
						$('#eQNo-'+qID).addClass('btn-dark');
						
					}else{
						
						//if(ansQuest == 1){ , btn-info, btn-dark
						$('#eQNo-'+qID).removeClass("btn-light");
						$('#eQNo-'+qID).addClass('btn-info');

					} 
					
					if ($(".homeworkQuestDiv div:visible").next().length != 0)
						$(".homeworkQuestDiv div:visible").next().show().prev().hide();
					else {
						$(".homeworkQuestDiv div:visible").hide();
						$(".homeworkQuestDiv div:first").show();
					}
					return false;
					
				});

				$("#prev").click(function(){ /* navigate to previous question */					
					
					var vQuest = $('.homeworkQuestDiv div:visible'),
					vQuestID = vQuest.attr('id');
					
					var sQuestID = vQuestID.split('-');
					var qID = sQuestID[1];
					var qName = 'qOpt-'+qID;
					
					var ansQuest = $('input:radio[name='+qName+']:checked').val();					
					
					if (ansQuest === undefined || ansQuest === null) {							
						
						$('#eQNo-'+qID).removeClass("btn-light");	
						$('#eQNo-'+qID).addClass('btn-dark');
						
					}else{
						
						$('#eQNo-'+qID).removeClass("btn-light");
						$('#eQNo-'+qID).addClass('btn-info');

					}	
					
					if ($(".homeworkQuestDiv div:visible").prev().length != 0)
						$(".homeworkQuestDiv div:visible").prev().show().next().hide();
					else {
						$(".homeworkQuestDiv div:visible").hide();
						$(".homeworkQuestDiv div:last").show();
					}
					return false;
				});
				
				$("#reviewQuest").click(function(){ /* revisit a question */
					
					var vQuest = $('.homeworkQuestDiv div:visible'),
					vQuestID = vQuest.attr('id'); 
					
					var sQuestID = vQuestID.split('-');
					var qID = sQuestID[1];
					var qName = 'qOpt-'+qID;
					
					var ansQuest = $('input:radio[name='+qName+']:checked').val();					
					
					if (ansQuest === undefined || ansQuest === null) {							
						
						$('#eQNo-'+qID).removeClass("btn-light");	
						$('#eQNo-'+qID).addClass('btn-danger');
						
					}else{
						
						//if(ansQuest == 1){ , btn-info, btn-dark
						$('#eQNo-'+qID).removeClass("btn-light");
						$('#eQNo-'+qID).addClass('btn-success');

					}	 	
					
					if ($(".homeworkQuestDiv div:visible").next().length != 0)
						$(".homeworkQuestDiv div:visible").next().show().prev().hide();
					else {
						$(".homeworkQuestDiv div:visible").hide();
						$(".homeworkQuestDiv div:first").show();
					}

					return false;
					
				});
				
				$(".homeworkQuestNum").click(function(){ /* navigate to a question using homework number */
					
					var eQBtn = this.id;
					var eQBtnID = eQBtn.split('-');
					var eQID = eQBtnID[1];

					$(".homeworkQuestDiv div:visible").hide();
					$("#question-"+eQID).show();
					$('html, body').animate({ scrollTop:  $('#homeworkQuestionDiv').offset().top - 150 }, 'slow');	
					
					return false;

				});
				
				$("#reviewHomeWork").click(function(){ /* review homework question */

					$("#homeworkQuestionDiv").slideDown(1800); //, #ansDescTB
					$("#reviewQuest, .reviewHomeWork").hide();
					
					return false;
					
				});
				
					
				function homeworkFinished(){  /* execute this function when homework elapsed */
					
					$(".homeworkQuestionDiv, #questDescTB").slideUp(1800);						

					var groups = [];
					
					/* distinct groups */
					
					$('.homeworkQuestDiv input:radio').each(function (index, value) {
						var name = $(this).attr('name');
						if ($.inArray(name, groups) == -1 ) {
							groups.push(name);
						}
						//groups.sort().reverse();
					}); 
					
					var homeworkScore = 0;
					var eQuesMark = 1;
					var studentScore = 0;
					var correctAnswer = 0;
					
					/* loop groups */
					
					$.each(groups, function (index, value) { 
						
						if ($('.homeworkQuestDiv input[name="' + value + '"]').is(':checked')) {  /* check question value is check */
							
							var eQuestAns = parseInt($('.homeworkQuestDiv input[name="' + value + '"]:checked').val());
							var vQuestData = $('.homeworkQuestDiv input[name="' + value + '"]:checked');
							
						}else{
							
							var eQuestAns = null;
							var vQuestData = $('.homeworkQuestDiv input[name="' + value + '"]');
							
						} 
							
						var eQuestAnsID = $(this).attr('id'); 							
						var vQuID = vQuestData.attr('id');
						var eQuestSplit = vQuID.split('-');
						var optNo = eQuestSplit[1];
						var eQMark = eQuestSplit[2];
						var qNo = eQuestSplit[3];
						var eQAns = eQuestSplit[4]; 
								
						homeworkScore += (eQuesMark * eQMark);
						
						$('input:radio[name="' + value + '"]').each(function(i) {  /* loop question array */
																
							var optionsID = $(this).attr('id');
							var optionSplit = optionsID.split('-');
							var eQOptNo = optionSplit[1];
							var eQOptMark = optionSplit[2];
							var eQOptqNo = optionSplit[3];
							var eQOptAns = optionSplit[4];	 

							if ((eQuestAns === null) && (eQOptAns == 1)){
								
								//$('#p-'+eQOptNo+'-'+eQOptMark+'-'+eQOptqNo+'-1').addClass('notAns');
								$('#p-'+eQOptNo+'-'+eQOptMark+'-'+eQOptqNo+'-1').append(' <i class="fas fa-check text-success fs-20"></i>  <span class="text-danger fw-600">Not. Ans.</span>');
								
							}else if((eQuestAns == 1) && (eQOptAns == 1)){
								
								//$('#p-'+eQOptNo+'-'+eQOptMark+'-'+eQOptqNo+'-'+eQOptAns).addClass('correctAns');
								$('#p-'+eQOptNo+'-'+eQOptMark+'-'+eQOptqNo+'-'+eQOptAns).append(' <i class="fas fa-check text-success fs-20"></i> <span class="text-success fw-600">correct</span>');
								
							}else if((eQuestAns == 0) && (eQOptAns == 1)){
									
								//$('#p-'+eQOptNo+'-'+eQOptMark+'-'+eQOptqNo+'-'+eQOptAns).addClass('correctAns');
								$('#p-'+eQOptNo+'-'+eQOptMark+'-'+eQOptqNo+'-'+eQOptAns).append(' <i class="fas fa-check text-success fs-20"></i>');//  <span class="text-success fw-600">correct</span>
									
							}else if((eQuestAns == 0) && (eQOptAns == 0)){
									
								//$('#p-'+optNo+'-'+eQMark+'-'+qNo+'-'+eQAns).addClass('wrongAns');
								//$('#p-'+optNo+'-'+eQMark+'-'+qNo+'-'+eQAns).append(' <i class="fas fa-times-circle text-danger fs-20"></i> wrong'); for single
								$('#p-'+eQOptNo+'-'+eQOptMark+'-'+eQOptqNo+'-'+eQOptAns).append(' <i class="fas fa-times-circle text-danger fs-20"></i>'); // <span class="text-danger fw-600">wrong</span>
								
							}else{
							
								$('#p-'+eQOptNo+'-'+eQOptMark+'-'+eQOptqNo+'-'+eQOptAns).append(' ');
								
							}	 
							
						}); 
						
						if(($.isNumeric(eQuestAns)) && ($.isNumeric(eQMark))){  /* check if value is numeric */

							if(eQuestAns == 1){
										
								studentScore += (eQuestAns * eQMark);
								correctAnswer++
							}	
										
						}	 
						
					}); 
					
					if(($.isNumeric(studentScore)) && ($.isNumeric(homeworkScore))){  /* check if value is numeric */
						
						var scorePercent = (studentScore * 100 / homeworkScore).toFixed(2);
					
					}else{
						
						var scorePercent = 0;
						
					}	 
					
					$("#correctAnswer").html(correctAnswer);
					$("#studentScore").html(studentScore);
					$("#homeworkScore").html(homeworkScore);
					$(".scorePercent").html(scorePercent);
					$('.styleProgress').css('width', scorePercent+'%');

					var postVal = 'save';
					
					var eid = $('#homeworkID').val();
					var quesno = $('#quesno').val();
					
					$('#msg-box-e').load('e-homework-review.php', {'homework': postVal, 'eid': eid, 'correct': correctAnswer, 'quesno': quesno,
															'yscore': studentScore, 'tscore': homeworkScore, 'aver': scorePercent });	

					$(".reviewHomeWork").show();
					$("#homeworkSummary").slideDown(1500); 
					
				} 
				
				/*
				$("#clearQuest").click(function(){					
					
					var vQuest = $('.homeworkQuestDiv div:visible'),
					vQuestID = vQuest.attr('id');
					
					var sQuestID = vQuestID.split('-');
					var qID = sQuestID[1];
					var qName = 'qOpt-'+qID;
					//$('input:radio[name="correctAnswer"]').prop('checked', false);
					$('input:radio[name='+qName+']').prop('checked', false);
					
					return false;
				});
				*/
			
			
			});
		
			hidePageLoader();

		</script>

<?php 
			
			} 
			
			
		}else{  /* display error */ 
			
			$msg_e = "* Ooops, an error has occur to retrieve homework information. Please try again";
			echo $errorMsg.$msg_e.$eEnd; 
			echo "<script type='text/javascript'>   hidePageLoader(); </script>";exit;
						
		}	
		
exit;
?>	