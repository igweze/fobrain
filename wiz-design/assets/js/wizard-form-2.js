	/* form wizard script */
	
	var currentStep = 1;
	var updateProgressBar;

	function displayStep(stepNumber) {
		if (stepNumber >= 1 && stepNumber <= 4) {
			$(".step-" + currentStep).hide();
			$(".step-" + stepNumber).show();
			currentStep = stepNumber;
			updateProgressBar();
		}
	}

	$(function() {

		$('.stepper-frm').find('.step').slice(1).hide();
	
		$(".next-step").click(function() {
		if (currentStep < 5) {
			$(".step-" + currentStep).addClass("animate__animated animate__fadeOutLeft");
			currentStep++;
			setTimeout(function() {
			$(".step").removeClass("animate__animated animate__fadeOutLeft").hide();
			$(".step-" + currentStep).show().addClass("animate__animated animate__fadeInRight");
			updateProgressBar();
			}, 500);
		}
		});

		$(".prev-step").click(function() {
		if (currentStep > 1) {
			$(".step-" + currentStep).addClass("animate__animated animate__fadeOutRight");
			currentStep--;
			setTimeout(function() {
				$(".step").removeClass("animate__animated animate__fadeOutRight").hide();
				$(".step-" + currentStep).show().addClass("animate__animated animate__fadeInLeft");
				updateProgressBar();
			}, 500);
		}
		});

		updateProgressBar = function() {
			var progressPercentage = ((currentStep - 1) / 2) * 100;
			$(".progress-bar").css("width", progressPercentage + "%");
		}
		
	});