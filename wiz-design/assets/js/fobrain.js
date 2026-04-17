    /* foBrain School App Script */
    
    $('#reload-page, .reload-page').click(function() {  /* refresh a page */

        location.reload();

    });  

    function responsivePage(){ /* page responsive */
        windowWidth = $(window).width();
        if (windowWidth < 992){ 				 
            $("body").toggleClass("sidebar-enable");  
        }else{
            document.body.setAttribute('data-sidebar-size', 'lg');
        }	
    }
    
    function renderSelect(render_id) { /* render select using tom select plugin */  

        new TomSelect(render_id,{
            plugins: ['dropdown_input'],
            create: true,
            sortField: {
                field: "text",
                direction: "asc"
            }
        }); 
        
    }

    function renderInput(render_id, limit) { /* render input using tom select plugin */    

        new TomSelect(render_id,{
            plugins: ['remove_button'],
            persist: false,
            createOnBlur: true,
            create: true,
            maxItems: limit,
            createFilter: function(input) {
                input = input.toLowerCase();
                return !(input in this.options);
            },
            onDelete: function(values) {
                return confirm(values.length > 1 ? "Are you sure you want to remove these " + values.length + " items?" : "Are you sure you want to remove " + values[0] + "?");
            }
        }); 
        
    }
    
    function renderSelectImg(render_id, limit) { /* render select using tom select plugin */   

        new TomSelect(render_id,{ 
            maxItems: limit,
            plugins: ['dropdown_input'],
            render: {
                option: function (data, escape) {
                    return `<div><img class="img-h-35 img-circle img-thumbnai" src="${data.src}">${data.text}</div>`;
                },
                item: function (item, escape) {
                    return `<div><img class="img-h-35 img-circle img-thumbnai" src="${item.src}">${item.text}</div>`;
                }
            },
            sortField: {
                field: "text",
                direction: "asc"
            }
        });

        
    }

    function renderSelectCheck(render_id) { /* render select using tom select plugin */  

        new TomSelect(render_id,{
            plugins: {
                'checkbox_options': {
                    'checkedClassNames':   ['ts-checked'],
                    'uncheckedClassNames': ['ts-unchecked'],
                }
            },
            create: true,
            sortField: {
                field: "text",
                direction: "asc"
            }
        }); 
        
    }

    function renderTable() { /* paginate table using jquery dataTable plugin */ 
        
        $(".wiz-table").DataTable( {
            responsive: true, 
            paging: {
                buttons: 3
            },
            layout: {
                topStart: { 
                    buttons: [

                        { extend: 'copy', text:'<i class="mdi mdi-content-copy"></i>', className: 'btn btn-sm btn-dark btn-dataTable-q' },
                        { extend: 'excel', text:'<i class="mdi mdi-microsoft-excel"></i>', className: 'btn btn-sm btn-danger btn-dataTable-q' },	
                        { extend: 'pdf', text:'<i class="mdi mdi-file-pdf-outline"></i>', className: 'btn btn-sm btn-dark btn-dataTable-q' },
                        { extend: 'print', text:'<i class="mdi mdi-printer"></i>', className: 'btn btn-sm btn-danger btn-dataTable-q' },
                        { extend: 'colvis', text:'<i class="mdi mdi-light-switch"></i>', className: 'btn btn-sm btn-dark btn-dataTable-q' }							
                            
                    ] 
                }
            }
                
        } );
        
    }
    
    function renderTable2() { /* paginate table using jquery dataTable plugin */ 
        
        $("#wiz-table").DataTable( {
            responsive: true, 
            paging: {
                buttons: 3
            },
            layout: {
                topStart: { 
                    buttons: [

                        { extend: 'copy', text:'<i class="mdi mdi-content-copy"></i>', className: 'btn btn-sm btn-dark btn-dataTable-q' },
                        { extend: 'excel', text:'<i class="mdi mdi-microsoft-excel"></i>', className: 'btn btn-sm btn-danger btn-dataTable-q' },	
                        { extend: 'pdf', text:'<i class="mdi mdi-file-pdf-outline"></i>', className: 'btn btn-sm btn-dark btn-dataTable-q' },
                        { extend: 'print', text:'<i class="mdi mdi-printer"></i>', className: 'btn btn-sm btn-danger btn-dataTable-q' },
                        { extend: 'colvis', text:'<i class="mdi mdi-light-switch"></i>', className: 'btn btn-sm btn-dark btn-dataTable-q' }							
                            
                    ] 
                }
            }
                
        } );
        
    }

    function renderTable3() { /* paginate table using jquery dataTable plugin */ 
        
        $(".wiz-table-3").DataTable( {
            responsive: true, 
            paging: {
                buttons: 3
            },
            layout: {
                topStart: { 
                    buttons: [

                        { extend: 'copy', text:'<i class="mdi mdi-content-copy"></i>', className: 'btn btn-sm btn-dark btn-dataTable-q' },
                        { extend: 'excel', text:'<i class="mdi mdi-microsoft-excel"></i>', className: 'btn btn-sm btn-danger btn-dataTable-q' },	
                        { extend: 'pdf', text:'<i class="mdi mdi-file-pdf-outline"></i>', className: 'btn btn-sm btn-dark btn-dataTable-q' },
                        { extend: 'print', text:'<i class="mdi mdi-printer"></i>', className: 'btn btn-sm btn-danger btn-dataTable-q' },
                        { extend: 'colvis', text:'<i class="mdi mdi-light-switch"></i>', className: 'btn btn-sm btn-dark btn-dataTable-q' }							
                            
                    ] 
                }
            }
                
        } );
        
    }

    function renderTableFull() { /* paginate table using jquery dataTable plugin */ 
        
        $(".wiz-table").DataTable( {
            responsive: true, 
            pageLength: 1000,
            paging: false,
            layout: {
                topStart: { 
                    buttons: [

                        { extend: 'copy', text:'<i class="mdi mdi-content-copy"></i>', className: 'btn btn-sm btn-dark btn-dataTable-q' },
                        { extend: 'excel', text:'<i class="mdi mdi-microsoft-excel"></i>', className: 'btn btn-sm btn-danger btn-dataTable-q' },	
                        { extend: 'pdf', text:'<i class="mdi mdi-file-pdf-outline"></i>', className: 'btn btn-sm btn-dark btn-dataTable-q' },
                        { extend: 'print', text:'<i class="mdi mdi-printer"></i>', className: 'btn btn-sm btn-danger btn-dataTable-q' },
                        { extend: 'colvis', text:'<i class="mdi mdi-light-switch"></i>', className: 'btn btn-sm btn-dark btn-dataTable-q' }							
                            
                    ] 
                }
            }
                
        } );
        
    } 
    
    function openSearch() {  /* load overlay div */
        document.getElementById("search-overlay").style.display = "block";
    }
    
    function closeSearch() {  /* close overlay div */
        document.getElementById("search-overlay").style.display = "none";
    }  

    function loadOverlay() {  /* load overlay div */
        document.getElementById("wiz-overlay").style.display = "block";
    }
    
    function closeOverlay() {  /* close overlay div */
        document.getElementById("wiz-overlay").style.display = "none";
    }
    
    $('body').on('click','.plusMinus',function(event){  /* increase or decrease a page */
    
        event.stopImmediatePropagation();	
                                
        var $speech = $('#fobrain-page-div');
        var currentSize = $speech.css('fontSize');
        var num = parseFloat( currentSize, 10 );
        var unit = currentSize.slice(-2);
        if (this.id == 'plusIcon') {
            num *= 1.1;
        } else if (this.id == 'minusIcon') {
            num /= 1.1;
        }
        
        $speech.css('fontSize', num + unit);

        return false;

    });

    function showPageLoader(){  /* show loading image */

        $('#preload-wrapper').fadeIn(100); 

    } 

    function hidePageLoader(){  /* hide loading image */

        $('#preload-wrapper').fadeOut(2000);
        
    };	 

    /*      
    setInterval(function(){  

        var ifConnected = window.navigator.onLine;
        if (ifConnected) {
            //alert('Connection available');
        } else {
            Swal.fire(
                'Internet Connection!',
                'Ooops, you don\'t an internet connection.',
                'info'
                )
        }
    }, 10000); 
    
    */ 
    
    function previewPicture(input) {    /* upload picture preview */
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#picture-preview').attr('src', e.target.result).fadeIn('slow');
            }
            reader.readAsDataURL(input.files[0]);
        }
    } 
        
    $('body').on('change','.picture-file',function(event){    /* upload picture preview */	
        event.stopImmediatePropagation(); 
        previewPicture(this);
    });  

    $('body').on('click','#password-icon',function(event){    /* password field toggle */
        event.stopImmediatePropagation();
        $(this).toggleClass("active");
        if ($(this).hasClass("active")) {
            $(this).html("<i class='fas fa-eye-slash fs-12'></i>").prev("input").attr("type", "text");
        } else {
            $(this).html("<i class='fas fa-eye fs-12'></i>").prev("input").attr("type", "password");
        }
    });

    $('body').on('click','#password-field',function(event){    /* password field toggle */ 
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
    
    $(function() {
        
        $("#filter-div").on("keyup", function() {    /* filter attendance timeline */
            var value = $(this).val().toLowerCase();
            $(".rollcall-timeline li").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        }); 
        
        $('body').on('click','.wiz-menu a',function(){  /* page menu loading */	            
            var varID = this.id;
            $('#fobrain-content').html("");        
            showPageLoader(); 
            $('#fobrain-content').load('navigator', {'iemj': varID}); 
            responsivePage(); 
            $('html, body').animate({ scrollTop:  $('#wizg-wrapper').offset().top - 150 }, 'slow');  
            return false;
        });

        $('body').on('click','.wiz-menu-1 a',function(){  /* page menu loading */ 
            var varID = this.id;
            $('#fobrain-content').html("");        
            showPageLoader();  
            $('#fobrain-content').load('navigator-s', {'iemj': varID});
            responsivePage();  
            $('html, body').animate({ scrollTop:  $('#wizg-wrapper').offset().top - 150 }, 'slow');            
            return false;
        });

        $('body').on('click','.wiz-menu-2 a',function(event){  /* page menu loading */					                                         
            event.stopImmediatePropagation(); 
            var varID = this.id;
            $('#fobrain-content').html("");        
            showPageLoader();
            $("#fobrain-content").load(varID);
            responsivePage();
            $('html, body').animate({ scrollTop:  $('#fobrain-content').offset().top - 150 }, 'slow');             
            hidePageLoader();        
            return false;
        });

        if($(".app_settings").length > 0) {    /* toggle app settings */

            var switchs = true;
            
            $('body').on('click','.switch-btn',function(e){
                e.preventDefault();
                if(switchs){
                    $(this).addClass('active');
                    $(".app_settings").animate({'left' : '0px'}, 400);
                    switchs = false;
                }else{
                    $(this).removeClass('active');
                    $(".app_settings").animate({'left' : '-240px'}, 400);
                    switchs = true;
                }
            });
             
        }; 

        $(function(){  /* dynamic include jquery scripts */
        
            var post_val = 'amanda.29.21'; 
            $('#fobrain-base').load('cells', {'script': post_val});
            
             
        });   

        $('body').on('click','.fobrain-frm-wizard',function(event){ 

            event.stopImmediatePropagation();

            let $this = $(this);
            let $originalText = $this.find('.button-text').html();

            // Show spinner and disable button
            $this.find('.button-text').hide();
            $this.find('.spinner-icon').show();
            $this.find('.spinner-text').show();
            $this.prop('disabled', true); 
            
            let $qfrm = $(this).attr("data-frm");
            let $qserver = $(this).attr("data-server");
            let $qtarget = $(this).attr("data-target");
            let $qscroll = $(this).attr("data-scroll");
            let $qsctarget = $(this).attr("data-scroll-target"); 
                
            let $frmField = $('#'+$qfrm); 

            $.ajax($qserver, {
                type: 'POST',   
                data: $frmField.serializeArray(),
                success: function (data, status, xhr) { 
                    $('#'+$qtarget).html(data);  									
                    setTimeout(function() {  
                        $this.find('.spinner-text').hide();
                        $this.find('.spinner-icon').hide();
                        $this.find('.button-text').html($originalText).show();
                        $this.prop('disabled', false);
                    }, 5000); 
                    if($qscroll == 1){
                        $('html, body').animate({ scrollTop:  $('#'+$qsctarget).offset().top - 50 }, 'slow');			
                    }
                },
                error: function (jqXhr, textStatus, errorMessage) {
                    $('#'+$qtarget).html('Error: ' + errorMessage);
                    setTimeout(function() {  
                        $this.find('.spinner-icon').hide();
                        $this.find('.button-text').html($originalText).show();
                        $this.prop('disabled', false);
                    }, 5000);  
                }
            }); 
        
            return false;
            
        }); 

    }); 

    