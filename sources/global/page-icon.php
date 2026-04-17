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
	This script load common page middle menu bar
	------------------------------------------------------------------------*/

?>

		<!-- row -->
		<div class="row fobrain-page-icons display-none pt-0 mt-0 mb-10">		
			<div class="col-12"> 
				<ul class="ft-link  pt-0 mt-0">
					<button class="btn btn-primary waves-effect btn-label waves-light
					slide-page me-10 mb-10">
					<i class="far fa-arrow-alt-circle-left label-icon"></i> 
						Go Back 
					</button>
					
					<button class="btn btn-danger btn-label waves-light
					display-none printer-icon me-10 mb-10" onclick="printDiv('fobrain-print')">
					<i class="fas fa-print label-icon"></i> 
						Print 
					</button>
					
					<button class="btn btn-dark btn-label waves-light
					display-none excelExIcon me-10 mb-10"   
					onClick ="$('#wiz-table-exp').tableExport({type:'excel',escape:'false'});">
					<i class="fas fa-file-export label-icon"></i> 
						Export Table
					</button>
					
					<button class="btn btn-success btn-label waves-light
					display-none show-rsconfig-div me-10 mb-10" onclick="loadOverlay()"> 
					<i class="fas fa-check-double label-icon"></i> 
						Compute &amp; Publish Result
					</button>
					
					
					<button class="btn btn-dark btn-label waves-light
					display-none show-rs-div me-10 mb-10">
					<i class="far fa-arrow-alt-circle-left label-icon"></i> 
						Back To Result
					</button> 
				</ul> 
			</div> 	
		</div>
		<!-- / row -->	 
	
		<div id="ScrollTarget"> </div>	

		<script>
			function printDi2(divName) {
				
				var printContents = document.getElementById(divName).innerHTML;
				var originalContents = document.body.innerHTML;

				document.body.innerHTML = printContents; // Temporarily replace body content with div content
				window.print(); // Trigger the print dialog
				document.body.innerHTML = originalContents; // Restore original body content
			}

			function printDiv3(divID) {
				var divElements = document.getElementById(divID).innerHTML;
				var oldPage = document.body.innerHTML;    
				document.body.innerHTML = 
				"<html><head><title>Print</title></head><body>" + 
				divElements + "</body>";
				window.print();
				document.body.innerHTML = oldPage;
			} 

			function printDiv(divID) {
				let divContents = document.getElementById(divID).innerHTML;
				let printWindow = window.open();
				printWindow.document.open();
				printWindow.document.write(`
					<html>
					<head>
						<title><?php echo $schoolNameTop; ?> | FoBrain </title>
						<!-- vendor css -->
						<link href="<?php echo $fobrainTemplate; ?>css/vendor.css" rel="stylesheet" type="text/css" />   
						<!-- /vendor css -->
						<!-- fobrain style css -->
						<link href="<?php echo $fobrainTemplate; ?>css/fobrain-style.css" rel="stylesheet" type="text/css" /> 
						<!-- / stylesheet -->

						<!-- favicon -->	
						<link rel="apple-touch-icon" sizes="180x180" href="<?php echo $fobrainTemplate; ?>favicon/apple-touch-icon.png">
						<link rel="icon" type="image/png" sizes="32x32" href="<?php echo $fobrainTemplate; ?>favicon/favicon-32x32.png">
						<link rel="icon" type="image/png" sizes="16x16" href="<?php echo $fobrainTemplate; ?>favicon/favicon-16x16.png">
						<link rel="manifest" href="<?php echo $fobrainTemplate; ?>favicon/site.webmanifest">
						<link rel="mask-icon" href="<?php echo $fobrainTemplate; ?>favicon/safari-pinned-tab.svg" color="#5bbad5">
						<meta name="msapplication-TileColor" content="#bfb3d4">
						<meta name="theme-color" content="#ffffff">    

					</head>
					<body>
						<div class="mt-30">
							${divContents}
						</div">
					</body>
					</html>
				`);
				
				printWindow.document.close();
				printWindow.print();
				  
			}
				
		</script>
		