    /* foBrain School App Script */

    !(function (fobrain) {
        "use strict";
        
        var e, t, n;  /* global varible declaration */
                    
        var amountScrolled = 170;

        $(window).scroll(function() { /* toggle back to top buton */ 
            if ( $(window).scrollTop() > amountScrolled ) {
                $('a.back-to-top').fadeIn('slow');
            } else {
                $('a.back-to-top').fadeOut('slow');
            }
        });
        
        $('a.back-to-top').click(function() {   /* back to top */ 				 
            $('html, body').animate({ scrollTop:  $('#layout-wrapper').offset().top - 50 }, 'slow');
            return false;
        });  
    
        function i() {  /* value counter */
            var t = document.querySelectorAll(".counter-value");
            t.forEach(function (o) {
                !(function t() {
                    var e = +o.getAttribute("data-target"),
                        a = +o.innerText,
                        n = e / 250;
                    n < 1 && (n = 1), a < e ? ((o.innerText = (a + n).toFixed(0)), setTimeout(t, 1)) : (o.innerText = e);
                })();
            });
        }

        /* menu & navigations */

        function l() {
            for (var t = document.getElementById("topnav-menu-content").getElementsByTagName("a"), e = 0, a = t.length; e < a; e++)
                t[e] &&
                    t[e].parentElement &&
                    "nav-item dropdown active" === t[e].parentElement.getAttribute("class") &&
                    (t[e].parentElement.classList.remove("active"), t[e].nextElementSibling && t[e].nextElementSibling.classList.remove("show"));
        }

        function s(t) {
            document.getElementById(t).checked = !0;
        }
        
        function responsivePager(){ /* page responsive */
            windowWidth = $(window).width();
            if (windowWidth < 992){ 				 
                $("body").toggleClass("sidebar-enable");  
            }else{
                document.body.setAttribute('data-sidebar-size', 'lg');
            }	
        }
        
        fobrain("#side-menu").metisMenu(),
        i(),
        (e = document.body.getAttribute("data-sidebar-size")),
        fobrain(window).on("load", function () {
            fobrain(".switch").on("switch-change", function () {
                toggleWeather();
            }),
            
            1024 <= window.innerWidth && window.innerWidth <= 1366 && (document.body.setAttribute("data-sidebar-size", "lg"), s("sidebar-size-small"));
            
        }),
        fobrain("#vertical-menu-btn").on("click", function (t) {
            t.preventDefault(),
                fobrain("body").toggleClass("sidebar-enable"),
                992 <= fobrain(window).width() &&
                    (null == e
                        ? null == document.body.getAttribute("data-sidebar-size") || "lg" == document.body.getAttribute("data-sidebar-size")
                            ? document.body.setAttribute("data-sidebar-size", "sm")
                            : document.body.setAttribute("data-sidebar-size", "lg")
                        : "md" == e
                        ? "md" == document.body.getAttribute("data-sidebar-size")
                            ? document.body.setAttribute("data-sidebar-size", "sm")
                            : document.body.setAttribute("data-sidebar-size", "md")
                        : "sm" == document.body.getAttribute("data-sidebar-size")
                        ? document.body.setAttribute("data-sidebar-size", "lg")
                        : document.body.setAttribute("data-sidebar-size", "sm"));
        }),
        fobrain("#sidebar-menu a").each(function () {
            var t = window.location.href.split(/[?#]/)[0];
            this.href == t &&
                (fobrain(this).addClass("active"),
                fobrain(this).parent().addClass("mm-active"),
                fobrain(this).parent().parent().addClass("mm-show"),
                fobrain(this).parent().parent().prev().addClass("mm-active"),
                fobrain(this).parent().parent().parent().addClass("mm-active"),
                fobrain(this).parent().parent().parent().parent().addClass("mm-show"),
                fobrain(this).parent().parent().parent().parent().parent().addClass("mm-active"));
        }),
        fobrain(document).ready(function () {
            var t;
            0 < fobrain("#sidebar-menu").length &&
                0 < fobrain("#sidebar-menu .mm-active .active").length &&
                300 < (t = fobrain("#sidebar-menu .mm-active .active").offset().top) &&
                ((t -= 300), fobrain(".vertical-menu .simplebar-content-wrapper").animate({ scrollTop: t }, "slow"));
        }),
        fobrain(".navbar-nav a").each(function () {
            var t = window.location.href.split(/[?#]/)[0];
            this.href == t &&
                (fobrain(this).addClass("active"),
                fobrain(this).parent().addClass("active"),
                fobrain(this).parent().parent().addClass("active"),
                fobrain(this).parent().parent().parent().addClass("active"),
                fobrain(this).parent().parent().parent().parent().addClass("active"),
                fobrain(this).parent().parent().parent().parent().parent().addClass("active"),
                fobrain(this).parent().parent().parent().parent().parent().parent().addClass("active"));
        }),
        fobrain('body').on('click','.wiz-qmenu a',function(){  /* page menu loading */	            
            var varID = this.id;
            $('#fobrain-content').html("");        
            showPageLoader(); 
            $('#fobrain-content').load('navigator', {'iemj': varID}); 
            responsivePager(); 
            $('html, body').animate({ scrollTop:  $('#wizg-wrapper').offset().top - 150 }, 'slow');  
            return false;
        }),
        fobrain('body').on('click','.wiz-qmenu-1 a',function(){  /* page menu loading */ 
            var varID = this.id;
            $('#fobrain-content').html("");        
            showPageLoader();  
            $('#fobrain-content').load('navigator-s', {'iemj': varID});
            responsivePager();  
            $('html, body').animate({ scrollTop:  $('#wizg-wrapper').offset().top - 150 }, 'slow');            
            return false;
        }),
        fobrain('body').on('click','.wiz-qmenu-2 a',function(event){  /* page menu loading */					                                         
            event.stopImmediatePropagation(); 
            var varID = this.id;
            $('#fobrain-content').html("");        
            showPageLoader();
            $("#fobrain-content").load(varID);
            responsivePager();
            $('html, body').animate({ scrollTop:  $('#fobrain-content').offset().top - 150 }, 'slow');             
            hidePageLoader();        
            return false;
        }),
        fobrain('body').on('click','.navigate',function(){  /* page menu loading */	  
			var varID = this.id;
			$('#fobrain-content').html("");			
			showPageLoader(); 			
			$('#fobrain-content').load('navigator', {'iemj': varID}); 		 
			$('html, body').animate({ scrollTop:  $('#wizg-wrapper').offset().top - 150 }, 'slow');  
			return false;
		}),
        fobrain('body').on('click','.slide-page',function(event){  /* hide page menus */                
            event.stopImmediatePropagation();	            
            showPageLoader(); 
            $('#wiz-slider').slideUp(2000);
            $('.fobrain-section-div').slideDown(2000);
            $('.fobrain-page-icons, .printer-icon, .show-rsconfig-div, .show-rs-div').fadeOut(200);
            $('#slide-page').fadeOut(200);
            document.body.setAttribute('data-sidebar-size', 'lg');            
            hidePageLoader();        
            return false;                        
        }),
        fobrain('body').on('click','.view-tree',function(event){  /* view info div */            
            event.stopImmediatePropagation();	            
            $('.view-tree, .view-table-div').fadeOut(1000); 
            $('.view-table, .view-tree-div').fadeIn(1000);               
            return false;  
        }),
        fobrain('body').on('click','.view-table',function(event){  /* view add new div*/
            event.stopImmediatePropagation();	 
            $('.view-tree, .view-table-div').fadeIn(1000);
            $('.view-table,  .view-tree-div').fadeOut(1000);             
            return false;  
        }),
        fobrain('body').on('click', '.full-screen',function(event){  /* page full screen */                    
            event.stopImmediatePropagation();	
            $('#full-screen').click();             
            return false;          
        }),        
        (function () {
            if (document.getElementById("topnav-menu-content")) {
                for (var t = document.getElementById("topnav-menu-content").getElementsByTagName("a"), e = 0, a = t.length; e < a; e++)
                    t[e].onclick = function (t) {
                        t && t.target && "#" === t.target.getAttribute("href") && (t.target.parentElement.classList.toggle("active"), t.target.nextElementSibling && t.target.nextElementSibling.classList.toggle("show"));
                    };
                window.addEventListener("resize", l);
            }
        })(),        
        fobrain(window).on("load", function () {
            fobrain("#status").fadeOut(), fobrain("#preload-wrapper").delay(350).fadeOut("slow");
            AOS.init({ });
        }),
        (n = document.getElementsByTagName("body")[0]),
        fobrain(".right-bar-toggle").on("click", function (t) {
            fobrain("body").toggleClass("right-bar-enabled");
        }),        
        fobrain(document).on("click", "body", function (t) {
            0 < fobrain(t.target).closest(".right-bar-toggle, .right-bar").length || fobrain("body").removeClass("right-bar-enabled");
        }) 
        
    })(jQuery); 
