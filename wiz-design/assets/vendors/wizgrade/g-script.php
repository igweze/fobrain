<?php

/*  ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ 	
	wizGrade V 1.2 (Formerly SDOSMS) is Designed & Developed by Igweze Ebele Mark | https://www.iem.wizgrade.com
	https://www.wizgrade.com
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ 	
	Copyright 2014 - 2020 c wizGrade | IGWEZE EBELE MARK 
	
	Licensed under the Apache License, Version 2.0 (the "License");
	you may not use this file except in compliance with the License.
	You may obtain a copy of the License at

		http://www.apache.org/licenses/LICENSE-2.0

	Unless required by applicable law or agreed to in writing, software
	distributed under the License is distributed on an "AS IS" BASIS,
	WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
	See the License for the specific language governing permissions and
	limitations under the License	
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ 
	wizGrade School App is Dedicated To Almighty God, My Amazing Parents ENGR Mr & Mrs Igweze Okwudili Godwin, 
	To My Fabulous and Supporting Wife Mrs Igweze Nkiruka Jennifer
	and To My Inestimable Sons Osinachi Michael, Ifechukwu Othniel and Naetochukwu Ryan.  
	
	WEBSITE 					PHONES												EMAILS
	https://www.wizgrade.com	+234 - 80 - 30 716 751, +234 - 80 - 22 000 490 		info@wizgrade.com	
	
	
	-------- Script Description --------
	This script load global script
	------------------------------------------------------------------------*/
	?>		
			
			function showPageLoader(){  /* show loading image */
				$('.loader-background').fadeIn(100);
				$('.loader-background').css("z-index", "999999999999");				
			}

			function hidePageLoader(){  /* hide loading image */
				$('.loader-background').fadeOut(3000);				
			}; 

			/* wizard form */

			var navListItems = $('div.setup-panel div a'),
				allWells = $('.setup-content'),
				allNextBtn = $('.nextBtn');

			allWells.hide();

			navListItems.click(function (e) {
				e.preventDefault();
				var $target = $($(this).attr('href')),
					$item = $(this);

				if (!$item.hasClass('disabled')) {
					navListItems.removeClass('btn-success').addClass('btn-primary');
					$item.addClass('btn-success');
					allWells.hide();
					$target.show();
					$target.find('input:eq(0)').focus();
				}
			});

			allNextBtn.click(function () {
				var curStep = $(this).closest(".setup-content"),
					curStepBtn = curStep.attr("id"),
					nextStepWizard = $('div.setup-panel div a[href="#' + curStepBtn + '"]').parent().next().children("a"),
					curInputs = curStep.find("input[type='text'],input[type='url']"),
					isValid = true;

				$(".form-group").removeClass("is-invalid");
				for (var i = 0; i < curInputs.length; i++) {
					if (!curInputs[i].validity.valid) {
						isValid = false;
						$(curInputs[i]).closest(".form-group").addClass("is-invalid");
					}
				}

				if (isValid) nextStepWizard.removeAttr('disabled').trigger('click');
			});

			$('div.setup-panel div a.btn-success').trigger('click');

			
			/* upload picture preview */

			

			/* upload picture preview */
			function previewPicture(input) {
				if (input.files && input.files[0]) {
					var reader = new FileReader();

					reader.onload = function (e) {
						$('#picture-preview').attr('src', e.target.result).fadeIn('slow');
					}
					reader.readAsDataURL(input.files[0]);
				}
			}

			$(".picture-file").change(function(){
				previewPicture(this);
			});


			$(function(){  /* dynamic include jquery scripts */
				
				var postVal = 'wiz-script';
		
				$('#wizg-script-loader').load('load-script', {'script': postVal});
						
			}); 
			
	

 