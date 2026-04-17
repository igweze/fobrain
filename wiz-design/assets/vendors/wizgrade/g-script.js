	/* foBrain School App Global Function */

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

	$(".picture-file").change(function(){ alert("I'm alive");
		previewPicture(this);
	}); 

	$('body').on('click','.demoDisenable-remove',function(event){
														
		event.stopImmediatePropagation();
		
		alert("Please, this button was disenable in this demo. Thanks");
													
		return false;
	
	});

	$('body').on('click','#password-icon',function(event){ 
		event.stopImmediatePropagation();
		$(this).toggleClass("active");
		if ($(this).hasClass("active")) {
			$(this).html("<i class='fas fa-eye-slash fs-12'></i>").prev("input").attr("type", "text");
		} else {
			$(this).html("<i class='fas fa-eye fs-12'></i>").prev("input").attr("type", "password");
		}
	});

	$('body').on('click','#password-field',function(event){ 
		event.stopImmediatePropagation();
		$(this).toggleClass("active");
		if ($(this).hasClass("active")) {
			$(this).html("<i class='fas fa-eye-slash fs-12'></i>");
			$('.pass-field').each(function() {  
				$('#'+this.id).attr("type", "text"); 
			});
		} else {
			$(this).html("<i class='fas fa-eye fs-12'></i>");
			$('.pass-field').each(function() {  
				$('#'+this.id).attr("type", "password"); 
			});
		}
	});

	function openSearch() {
		document.getElementById("search-overlay").style.display = "block";
	}
	
	function closeSearch() {
		document.getElementById("search-overlay").style.display = "none";
	} 
	
	$('body').on('click', '.full-screen',function(event){  /* product check out */
				
		event.stopImmediatePropagation();					
		
		$('#full-screen').trigger('click'); 
		
		return false;  
	
	});

	$('body').on('click','.view-tree',function(event){  /* view info div */
		
		event.stopImmediatePropagation();	
		
		$('.view-tree, .view-table-div').fadeOut(1000); 
		$('.view-table, .view-tree-div').fadeIn(1000);   
		
		return false;  

	}); 

	$('body').on('click','.view-table',function(event){  /* view add new div*/

		event.stopImmediatePropagation();	 

		$('.view-tree, .view-table-div').fadeIn(1000);
		$('.view-table,  .view-tree-div').fadeOut(1000); 
		
		return false;  

	});
	
	$(document).ready(function() {
		
		$("#filter-div").on("keyup", function() {
			var value = $(this).val().toLowerCase();
			$(".rollcall-timeline li").filter(function() {
				$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
			});
		});

		$('#home-pg').trigger('click');  

		$(function(){  /* dynamic include jquery scripts */
		
			var post_val = 'wiz-script';
	
			$('#wizg-script-loader').load('load-script', {'script': post_val});
				
		}); 

	});  