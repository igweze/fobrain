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
	This page load student profile form
	------------------------------------------------------------------------*/  

if(!session_id()){
    session_start();
}

		if (!defined('fobrain')) /* This checks if this page was wrongly access by users */

		die('Hahahaha, Hacking attempt . . . . Be Careful . . . . You Are Been Warned !!!!');
				
		require_once $fobrainIconPage; /* This include top middle global icon page eg go back, print buttons etcs */ 

$profile =<<<IGWEZE
            
        <div class="row"  id="fobrain-print">
            <div class="col-lg-12">
                <div class="profile-wrapper">		
                    <div class="picture">
                        <img src="$student_img" alt="Profile Picture">
                    </div>

                    <div class="info">
                        <h2 class="main-title">$fname $mname $lname</h2>
                        <span class="sub-title">($regNum)</span>
                    </div> 

                    <div class="row mt-10">
                        <div class="col-lg-3 col-md-3 col-sm-12 col-12 profile-info profile-info-nb profile-info-n1st">
                            <div class="title">
                                <i class="fas fa-user-tag"></i> Reg
                            </div>
                            <div class="detail font-head-1 fs-14">
                                $regNum
                            </div>
                        </div>
                    
                        <div class="col-lg-6 col-md-6 col-sm-12 col-12 profile-info profile-info-n1st">
                            <div class="title">
                                <i class="fas fa-user-shield"></i> Name
                            </div>
                            <div class="detail font-head-1 fs-14">
                                $lname $fname $mname
                            </div>
                        </div>
                        
                        <div class="col-lg-3 col-md-3 col-sm-12 col-12 profile-info profile-info-nb">
                            <div class="title">
                                <i class="mdi mdi-human-male-female fs-14"></i> Gender
                            </div>
                            <div class="detail font-head-1 fs-14">
                                $genderM
                            </div>
                        </div> 
                        
                        <div class="col-lg-3 col-md-3 col-sm-12 col-12 profile-info">
                            <div class="title">
                                <i class="fas fa-calendar-day"></i> Date Of Birth
                            </div>
                            <div class="detail font-head-1 fs-14">
                                $date
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-3 col-sm-12 col-12 profile-info">
                            <div class="title">
                                <i class="mdi mdi-human-male-height fs-14"></i> Height
                            </div>
                            <div class="detail font-head-1 fs-14">
                                $height
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-3 col-sm-12 col-12 profile-info">
                            <div class="title">
                                <i class="mdi mdi-weight-kilogram fs-14"></i> Weight
                            </div>
                            <div class="detail font-head-1 fs-14">
                                $weight
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-3 col-sm-12 col-12 profile-info profile-info-nb">
                            <div class="title">
                                <i class="mdi mdi-human fs-14"></i> Religion
                            </div>
                            <div class="detail font-head-1 fs-14">
                                $religion
                            </div>
                        </div> 
                    
                        <div class="col-lg-4 col-md-4 col-sm-12 col-12 profile-info profile-info-nb">
                            <div class="title">
                                    <i class="fas fa-flag-checkered"></i> Country
                            </div>
                            <div class="detail font-head-1 fs-14">
                                $country
                            </div>
                        </div>
                        
                        <div class="col-lg-4 col-md-4 col-sm-12 col-12 profile-info">
                            <div class="title">
                                <i class="fas fa-map-marker-alt"></i> State<span class="hide-res">/Province<span> 
                            </div>
                            <div class="detail font-head-1 fs-14">
                                $state
                            </div>
                        </div>
                        
                        <div class="col-lg-4 col-md-4 col-sm-12 col-12 profile-info">
                            <div class="title">
                                <i class="fas fa-map-marker-alt"></i> City
                            </div>
                            <div class="detail font-head-1 fs-14">
                                $city
                            </div>
                        </div>
                        
                        <div class="col-lg-6 col-md-6 col-sm-12 col-12 profile-info profile-info-nb">
                            <div class="title">
                                <i class="fas fa-map-marker-alt"></i> Temporary Address
                            </div>
                            <div class="detail font-head-1 fs-14">
                                $add1 
                            </div>
                        </div>

                        <div class="col-lg-6 col-md-6 col-sm-12 col-12 profile-info profile-info-nb">
                            <div class="title">
                                <i class="fas fa-map-marker-alt"></i> Parmanent Address
                            </div>
                            <div class="detail font-head-1 fs-14">
                                $add2
                            </div>
                        </div>
                        
                        
                        <div class="col-lg-3 col-md-3 col-sm-12 col-12 profile-info">
                            <div class="title">
                                <i class="fas fa-phone-volume"></i> Phone Number
                            </div>
                            <div class="detail font-head-1 fs-14">
                                $phone										
                            </div>
                        </div>
                        
                        <div class="col-lg-3 col-md-3 col-sm-12 col-12 profile-info profile-info-nb">
                            <div class="title">
                                <i class="fas fa-envelope-open-text"></i> Email
                            </div>
                            <div class="detail font-head-1 fs-14">
                                $email
                            </div>
                        </div>								 
                        
                        <div class="col-lg-3 col-md-3 col-sm-12 col-12 profile-info">
                            <div class="title">
                                <i class="fas fa-user-md"></i> Blood Group
                            </div>
                            <div class="detail font-head-1 fs-14">
                                $bloodGroup
                            </div>
                        </div>
                        
                        <div class="col-lg-3 col-md-3 col-sm-12 col-12 profile-info">
                            <div class="title">
                                <i class="fas fa-user-md"></i> Genotype
                            </div>
                            <div class="detail font-head-1 fs-14">
                                $genoType
                            </div>
                        </div> 
                        
                        $classInfo
                        <div class="col-lg-6 col-md-6 col-sm-12 col-12 profile-info  profile-info-nb">
                            <div class="title">
                                <i class="far fa-building"></i> Hostel Name
                            </div>
                            <div class="detail font-head-1 fs-14">
                                $hostel
                            </div>
                        </div>
                        
                        <div class="col-lg-6 col-md-6 col-sm-12 col-12 profile-info">
                            <div class="title">
                                <i class="fas fa-road"></i> Transport Route
                            </div>
                            <div class="detail font-head-1 fs-14">
                                $route
                            </div>
                        </div>
                        
                        <div class="col-lg-6 col-md-6 col-sm-12 col-12 profile-info profile-info-nb">
                            <div class="title">
                                <i class="fas fa-user-tie"></i> Father Name
                            </div>
                            <div class="detail font-head-1 fs-14">
                                $spon
                            </div>
                        </div> 
                        
                        <div class="col-lg-6 col-md-6 col-sm-12 col-12 profile-info">
                            <div class="title">
                                <i class="fas fa-phone-volume"></i> Phone
                            </div>
                            <div class="detail font-head-1 fs-14">
                                $sphone
                            </div>
                        </div>
                        
                        <div class="col-lg-4 col-md-4 col-sm-12 col-12 profile-info">
                            <div class="title">
                                <i class="mdi mdi-doctor fs-14"></i> Occupation
                            </div>
                            <div class="detail font-head-1 fs-14">
                                $soccup
                            </div>
                        </div>

                        <div class="col-lg-8 col-md-8 col-sm-12 col-12 profile-info">
                            <div class="title">
                                <i class="fas fa-map-marker-alt"></i> Address
                            </div>
                            <div class="detail font-head-1 fs-14">
                                $adds
                            </div>
                        </div>

                         <div class="col-lg-6 col-md-6 col-sm-12 col-12 profile-info profile-info-nb">
                            <div class="title">
                                <i class="fas fa-user-tie"></i> Mother Name
                            </div>
                            <div class="detail font-head-1 fs-14">
                                $sponsor2
                            </div>
                        </div> 
                        
                        <div class="col-lg-6 col-md-6 col-sm-12 col-12 profile-info">
                            <div class="title">
                                <i class="fas fa-phone-volume"></i> Phone
                            </div>
                            <div class="detail font-head-1 fs-14">
                                $sponphone2
                            </div>
                        </div>
                        
                        <div class="col-lg-4 col-md-4 col-sm-12 col-12 profile-info">
                            <div class="title">
                                <i class="mdi mdi-doctor fs-14"></i> Occupation
                            </div>
                            <div class="detail font-head-1 fs-14">
                                $soccup2
                            </div>
                        </div>

                        <div class="col-lg-8 col-md-8 col-sm-12 col-12 profile-info">
                            <div class="title">
                                <i class="fas fa-map-marker-alt"></i> Address
                            </div>
                            <div class="detail font-head-1 fs-14">
                                $sponadd2
                            </div>
                        </div>
                    
                    </div>	

                    $sibling_tree
                    
                    <div class="info my-30"> 
                        <span class="sub-title">Student Documents</span>
                    </div> 

                    <div class="row mt-10 profile-top-border">

                        <div class="my-20"> </div>
                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 col-6 text-center mb-30">
                            <div class="picture-div mb-10">
                                <img src="$bcert_img" alt="Birth Certificate" class="img-h-150 rounded img-thumbnail" />
                            </div>
                            <div class="text-danger">Birth Certificate</div>
                        </div>

                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 col-6 text-center mb-30">
                            <div class="picture-div mb-10">
                                <img src="$guardid_img" alt="Gurdian ID" class="img-h-150 rounded img-thumbnail" />
                            </div>
                            <div class="text-danger">Gurdian ID</div>
                        </div> 

                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 col-6 text-center mb-30">
                            <div class="picture-div mb-10">
                                <img src="$prevcert_img" alt="Prev. School Result" class="img-h-150 rounded img-thumbnail" />
                            </div>
                            <div class="text-danger">Prev. School Result</div>
                        </div> 
                         
                    </div>
                        
                </div>

                </div>
            </div>
        </div>
                            
        
IGWEZE;

        echo $profile;
?>	 