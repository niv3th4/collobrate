	// pre-submit callback 
	function showRequest(formData, jqForm, options) { 
	    // formData is an array; here we use $.param to convert it to a string to display it 
	    // but the form plugin does this for you automatically when it submits the data 
	    var queryString = $.param(formData); 
	 
	    // jqForm is a jQuery object encapsulating the form element.  To access the 
	    // DOM element for the form do this: 
	    // var formElement = jqForm[0]; 
	 
	    console.log('About to submit: \n\n' + queryString); 
	 
	    // here we could return false to prevent the form from being submitted; 
	    // returning anything other than false will allow the form submit to continue 
	    return true; 
	}
	// post-submit callback 
	function showResponse(responseText, statusText, xhr, $form)  { 
	    // for normal html responses, the first argument to the success callback 
	    // is the XMLHttpRequest object's responseText property 
	 
	    // if the ajaxForm method was passed an Options Object with the dataType 
	    // property set to 'xml' then the first argument to the success callback 
	    // is the XMLHttpRequest object's responseXML property 
	 
	    // if the ajaxForm method was passed an Options Object with the dataType 
	    // property set to 'json' then the first argument to the success callback 
	    // is the json data object returned by the server 
	 
	    console.log('status: ' + statusText + '\n\nresponseText: \n' + responseText + 
	        '\n\nThe output div should have already been updated with the responseText.'); 
	}  
	//edit profile
	$(".edit-click").click(function(e) {
        var $div = $(this).next('.post-edit-pnl');
		$(".post-edit-pnl").not($div).hide();
		$div.show();
		var div2=$(this).prev('.old-data').hide();
		$(".old-data").not($(this).prev('.old-data')).show();
		 $(this).closest(".main-bx").find('.edit-pnl').hide();
	});
	$(".cnl-btn").click(function(e) {
		 $(this).closest(".educ-tbl").find('.old-data').show();
        $(this).parents('.post-edit-pnl').hide();
		
	});
	
	
	$(".add-pos").click(function(e) {
        var $div = $(this).next('.edit-pnl');
		$(".edit-pnl").not($div).hide();
		$div.show();
		
		$(this).closest(".main-bx").find('.old-data').show();
        $(this).closest(".main-bx").find('.post-edit-pnl').hide();
		
	});
	$(".cnl-edit").click(function(e) {
      $(this).closest(".main-bx").find('.edit-pnl').hide();
		
	});
	
	
	//follow in like popup
	$(".pep-follow").hover(
        function() // on mouseover
        {
            $(this).text("Unfollow");
        }, 

        function() // on mouseout
        {
            $(this).text("Following");

        });

	//to do list check
	$('.todo-chk input[type="checkbox"]').change(function(){
        if(this.checked){
            $(this).parents('.todochecklist li').addClass('clearfix greybg');
		}
        else{
            $(this).parents('.todochecklist li').removeClass('greybg');
		}

    });
	
		
	//announcment
	$(".more").click(function(e) {
		
	if ($(this).hasClass("open")){
	   $(this).addClass('close')
	   $('.close').animate({top:83}, "slow");
	   $(this).removeClass('open')
	  var el = $( $(this).parent(".listbox")),
      curHeight = el.height(),
      autoHeight = el.css('height', '100px').height(); //temporarily change to auto and get the height.
      el.height(curHeight).animate({ height: autoHeight }, 600, function() {
           el.css('height', '100px'); 
      });
	  }
	 else{
	  $(this).addClass('open')
	  $(this).removeClass('close')
	  $('.open').css({top:''})
	  $('.open').animate({bottom:0}, "slow");
	  var el = $( $(this).parent(".listbox")),
      curHeight = el.height(),
      autoHeight = el.css('height', 'auto').height(); //temporarily change to auto and get the height.
      el.height(curHeight).animate({ height: autoHeight }, 600, function() {
           el.css('height', 'auto'); 
      });
	  }
	  
	  $(this).text(function(i,v) {
           return v === 'More' ? 'Less' : 'More';
     	});
    });
	
	
	//student submission step 3  submit-answer
	$(".open-answer").click(function () {
		var $div = $(this).nextAll('.submit-answer').toggle();
	 });
		
	
	
	//My classroom newjoin
	$(".code-class").click(function(e) {
        $(".newjoin").remove();
		$(".accessclass").show();
    });

	//dropdown
	$(".arr-dd").hide();
	$("#discussions").on('click', '.dd-click' , function () {
		var $div = $(this).next('.arr-dd');
		$(".arr-dd").not($div).hide();
		$div.toggle();
	 });
	 
	// Select Topic
	 $(".sel-topic").click(function () {
		 var $div = $(this).next('.seltop-dd');
		$(".seltop-dd").not($div).hide();
		$div.toggle();
	 });

	//Toggle for creating new topic	 
	//Add a comment to this line
	$("#enter-topic").show();
	    $("#upload-dialog").on('change', '#topic-dd' ,function(){
	    	var option = $("#topic-dd option:selected").text().localeCompare("Create new topic");
	    	if( option == 0){
                //apppend a new form element input
                $("#enter-topic").show();
            } else {
                //remove the newly created form element
                $("#enter-topic").hide();
            }
	    });

	//test
	$('.show-test').hide();
	$(".slider-acc li").click(function () {
		 var $div = $(this).children('.show-test');
		$(".show-test").not($div).hide();
		$(this).toggleClass('active').siblings().removeClass('active');
		$div.toggle('slow');
	 });
	 
	 //search interaction
	 $(".nav-search").click(function () {
		 $(".search-input").toggle();
		 $(this).toggleClass('active');
	});
	
	//Universal search interaction
	 $(".search-bx").click(function () {
		 $(".uni-searchinput").toggle();
		 $('.uni-search').toggleClass('active');
	});
	
	//redirect on search 
	 $('.uni-searchinput').on('keypress', function (e) {
		var code = (e.keyCode ? e.keyCode : e.which);
		if(e.which == 13) {
				$(location).attr('href','universal-searchresult.htm');
			}
		});
		
		
	 //new topic
	 $(".new-topic").click(function () {
		$(".seltop-dd").toggle();
		$(".pop-input").show();
	 });

	 //Logout div
	 $(".logout").click(function () {
		$(".logout-lst").toggle();
		$(this).toggleClass('active');
	 });
	 
	 
	$(".seltop-dd li a").click(function () {
		var sel_topic = $(this).text();
		$(".sel-topic").text(sel_topic);
		$(".seltop-dd").toggle();
	});


	//file size test
	$('.chk-file').click( function() {
    //check whether browser fully supports all File API
    if (window.File && window.FileReader && window.FileList && window.Blob)
    {
        //get the file size and file type from file input field
        var fsize = $('.i_file')[0].files[0].size;
        var ftype = $('.i_file')[0].files[0].type;
        var fname = $('.i_file')[0].files[0].name;
        
       switch(ftype)
        {
            case 'image/png':
            case 'image/gif':
            case 'image/jpeg':
            case 'image/pjpeg':
                alert("Acceptable image file!");
                break;
            default:
                alert('Unsupported File!');
        }

    }else{
        alert("Please upgrade your browser, because your current browser lacks some new features we need!");
    }
});



	 //close dropdown
	$(document).click(function (e) {
		var q = $(e.target).closest('.dd-block').length
		var r = $(e.target).closest('.prs-sp').length
		var s = $(e.target).closest('.logout').length
		var u = $(e.target).closest('.select-topic').length
		if (!q) {
			$(".arr-dd").css("display", "none");
		}
		if (!r) {
			$(".clk-tt").css("display", "none");
		}
		if (!s) {
			$(".logout-lst").css("display", "none");
			$(".logout").removeClass('active');
		}	
		if (!u) {
			$(".seltop-dd").css("display", "none");
		}
		
	});
	 //My classroom acordian	
		$(".contentblock").hide();	
		$("#Classrooms .click-icon").click(function () {
		var $div = $(this).parents().next(".contentblock");
		$(".contentblock").not($div).hide();
		$(this).toggleClass("active");
		$('.click-icon').not($(this)).removeClass('active');
		$div.slideToggle(300);
		});
		
		$(".head-click").click(function () {
		var $div = $(this).next(".contentblock");
		$(".contentblock").not($div).hide();
		$(this).toggleClass("active");
		$('.click-lib').not($(this)).removeClass('active');
		$div.slideToggle(300);
		});
		
		
	//Top right sliders
	$("#sharediv").hide();
	$(".share").click(function(){
	  $(".shareeditsec").animate({top:"150px"}, "slow");
	  $("#sharediv").show("slide", {direction: "up" }, "slow");
	});
	$(".close-share").click(function(){
	  $(".shareeditsec").animate({top:0}, "slow");
	  $("#sharediv").hide("slide", {direction: "up" }, "slow");
	});
	 
	
	
	//Right Side Layout
	$(".notification_details").hide();
	$(".dock-bk").hide();
	$(".toprightsection a").click(function () {
		$(".notification_details").show('slide', { direction: 'right' }, 500);
		$(".dock-bk").show('slow');
		$(".toprightsection").addClass("ractive");
	});
	$(".dock-bk").click(function () {
		$(".notification_details").hide('slide', { direction: 'right' }, 500);
		$(".dock-bk").hide('slow');
		$(".toprightsection").removeClass("ractive");
	});
	

	
	//Dialog
	$("#dialog, #view-dialog, #clone-dialog,#upload-dialog,#assign-dialog,#rest-dialog,.doc-popup,#quizdialog,#msg-dialog,#rec-dialog,#create-assign,#quizdialog").dialog({
		autoOpen: false,
		modal: true,

		
	});
	// Link to Close the dialog
	$(".ui-dialog").on('click', '.close-link', function (event) {
		$("#dialog,#signup-popup,#view-dialog,#clone-dialog,#upload-dialog,#assign-dialog,#rest-dialog,.doc-popup,#quizdialog,#msg-dialog,#rec-dialog").dialog("close");
	});
	//message dialog
	$(".msg-link").click(function (event) {
		$("#msg-dialog").dialog("open");
		$('.ui-widget-overlay').addClass('custom-overlay');
	});
	
	//recommend dialog
	$(".rec-link").click(function (event) {
		$("#rec-dialog").dialog("open");
		$('.ui-widget-overlay').addClass('custom-overlay');
	});
	
	
	//quiz dialog
	$("#quiz-link").click(function (event) {
		$("#create-assign").dialog("close");
		$("#quizdialog").dialog("open");
		$('.ui-widget-overlay').addClass('custom-overlay');
	});
	
	 
	//multiple dialog
	// Link to open the dialog
	
	$(".dialogbox").click(function (event) {
		var title_dialog=$(this).attr('title');
		var var1="#"+title_dialog;
		$(var1).dialog("open");
		$('.ui-widget-overlay').addClass('custom-overlay');
	});
	
	// Link to open the dialog
	$("#dialog-link").click(function (event) {
		$("#dialog").dialog("open");
		$('.ui-widget-overlay').addClass('custom-overlay');
	});
	// Assign moderators Dialod
	$("#assign-link").click(function (event) {
		$("#assign-dialog").dialog("open");
		$('.ui-widget-overlay').addClass('custom-overlay');
	});
	// Restrict Access Dialod
	$("#rest-link").click(function (event) {
		$("#rest-dialog").dialog("open");
		$('.ui-widget-overlay').addClass('custom-overlay');
	});
	
	//View info Dialog
	$("#view-dlink").click(function (event) {
		$("#view-dialog").dialog("open");
		$('.ui-widget-overlay').addClass('custom-overlay');
	});
	//Clone Dialog
	$("#clone-dlink").click(function (event) {
		$("#clone-dialog").dialog("open");
	});
	//upload Dialog
	$("#upload-dlink").click(function (event) {
		$("#upload-dialog").dialog("open");
		$('.ui-widget-overlay').addClass('custom-overlay');
	});
	
	
	//sub menu   
	$('.hassub').hover(
		function() {
			$(".container").addClass("show-sub");
			$(this).addClass("hover");
			
		},
		function() {
			$(".container").removeClass("show-sub");
			$(this).removeClass("hover");
			
		});

	// Link to open the dialog
	$(".ques").click(function (event) {
		$(".ques-box").css("display", "block");
		$(".poll-box, .note-box").css("display", "none");
		$(".ques").addClass("active");
		$(".poll,.note-icon").removeClass("active");
		
	});
	$(".poll").click(function (event) {
		$(".ques-box,.note-box").css("display", "none");
		$(".poll-box").css("display", "block");
		$(".poll").addClass("active");
		$(".ques,.note-icon").removeClass("active");
	});
	$(".note-icon").click(function (event) {
		$(".ques-box, .poll-box").css("display", "none");
		$(".note-box").css("display", "block");
		$(".note-icon").addClass("active");
		$(".ques,.poll").removeClass("active");
	});
	$(".cnl-btn").click(function (event) {
		$(".ques-box, .poll-box, .note-box").css("display", "none");
		$(".ques-icon").removeClass("active");
	});

	
	//fold interaction
	// $('a.fold-icon').click(function() {
 //            $(this).toggleClass('folded-icon')
 //     });
	 
	 // $('a.folded-icon').click(function() {
  //           $(this).addClass('fold-icon');
		// 	$(this).attr('title','Fold Discussion')
		// 	$(this).removeClass('folded-icon')
		// 	$('a.fold-icon').click(function() {
  //           $(this).toggleClass('folded-icon')
  //    });
  //    });
	
	//praise tooltip
	$(".clk-tt").hide();
	$(".icon-title.addPraise").click(function () {
		var $div = $(this).next('.clk-tt');
		$(".clk-tt").not($div).hide();
		$div.toggle();
	 });
	 
	 //submission topic
	$(".assign-hide").hide();
	$(".assign-head").click(function () {
		var $div = $(this).next('.assign-hide');
		$(".assign-hide").not($div).hide();
		$div.slideToggle('slow');
		$('.open-dd').toggleClass('active');
	 });
	 
	 
	 //comment accordion
	$(".comm-hide").hide();
	$(".comm-link").click(function () {
		var $div = $(this).parents().next('.comm-hide');
		$(".comm-hide").not($div).hide();
		$div.toggle();
	 });
		
	//student subbmission
	$(".stud-comm-link").click(function () {
		var $div = $(this).parents().next('.comm-hide');
		$(".comm-hide").not($div).hide();
		$(this).parents('.stud-submission tr').toggleClass('active').siblings().removeClass('active');
		$div.toggle();
	 });	 
	 //student-report
	 $(".comm-link1").click(function () {
		var $div = $(this).parents().next('.comm-hide');
		$(".comm-hide").not($div).hide();
		$(this).parents('.enga-tbl tr').toggleClass('active');
		$('.enga-tbl tr').not($(this).parents('.enga-tbl tr')).removeClass('active');

		$div.toggle();
		$(this).text(function(i,v) {
           return v === 'View' ? 'Hide' : 'View';
     	});
		
		$('.comm-link1').not($(this)).text(function(i,v) {
           return v = 'View';
     	});
	 });
	 
	 // Engagement accordion
	$(".enga-hide").hide();
	$(".enga-link").click(function () {
		var $div = $(this).parents().next('.enga-hide');
		$(".enga-hide").not($div).hide();
		$div.slideToggle('slow');
		$(this).toggleClass('active');
		$('.enga-link').not($(this)).removeClass('active');
		$(this).find('p').text(function(i,v) {
           return v === 'View All' ? 'Back' : 'View All';
     	});
		
		$('.enga-link p').not($(this).find('p')).text(function(i,v) {
           return v = 'View All';
     	});
	 });
	 
	 
	 //editable txtbx
	 $(".assign-txtbx").dblclick(function(){
		$(this).removeAttr("readonly");
	});
	 $('.assign-txtbx').on('blur',function() {
       $(this).attr('readonly', 'readonly');
    });
	 
	// Tooltip
	$('.tooltip').tooltipster();
	
	//Discussion tooltip
	$(".gamification").on('mouseover', '.point-icon', function () {
		var $div = $(this).next('.enga-tooltip');
		$(".enga-tooltip").not($div).hide();
		$div.show();
	 });

	$(".gamification").on('mouseout', '.point-icon', function () {
		$(".enga-tooltip").hide();
	 });
	 

	//Top right section
	$('.tabpages').each(function(){
		var $active, $content, $links = $(this).find('li a.tab');
		$active = $links.first();
		$content = $($active.attr('href'));
		$links.not(':first').each(function () {
		$($(this).attr('href')).hide();
	});
	$(this).on('click', 'li a.tab', function(e){
		$active.removeClass('active');
		$content.hide();
		$active = $(this);
		$content = $($(this).attr('href'));
		$active.addClass('active');
		$content.show();
		e.preventDefault();
		});
	});
	
	//upload Wizard
	$('#form2,#form3').hide();
	$('.goto2').click(function() {
		$('#form1').hide();	
		$('#form2').show();	
		$('.wizard-steps li:nth-child(1)').removeClass( "active" );
		$('.wizard-steps li:nth-child(2)').addClass( "active" );
	});
	$('.backto1').click(function() {
		$('#form2').hide();	
		$('#form1').show();	
		$('.wizard-steps li:nth-child(2)').removeClass( "active" );
		$('.wizard-steps li:nth-child(1)').addClass( "active" );
	});
	
	//editable span
	$(".add-choice input").click(function(){
		$(this).removeAttr("readonly");
	});
	
	//announcement edit topic
	$("#library").on('click', '.lib-edit', function(){
		$(this).parent().prev('.doc-input').removeAttr("readonly");
		$(this).parents().prev('.doc-input').focus();
	});

	$("#library .contentblock").hide();
	$("#library").on('click', '.click-icon', function (e) {
		var $div = $(this).parents().next(".contentblock");
		$(".contentblock").not($div).hide();
		$(this).toggleClass("active");
		$('#library .click-icon').not($(this)).removeClass('active');
		$div.slideToggle(300);
	});

	$(".doc-input").blur(function(){
		 $(this).attr('readonly', 'readonly');
    });
	
	//custom upload
	$('.custom-upload input[type=file]').change(function(){
    	$(this).next().find('input').val($(this).val());
	});
	
	//add new div
	var pollCount = 0;
	$(".add-div").click(function(){
		var count = $('.add-choice').length;
		if(pollCount < 5) { 
			pollCount++;
			$(".add-here").append('<div class="add-choice"><input name="data[Pollchoice]['+pollCount+'][choice]" class="ans-txtbx" placeholder="add a choice for your poll" maxlength="450" type="text" ></div>');
    	}
	});
	
	//upload more
	var count = 0;
	$(".add-more").click(function(){
		var count = $('.custom-upload').length;
		if(count < 6) {
			$(".add-upload").append('<div class="custom-upload" id="file'+count+'"><input type="file" name="data[Pyoopilfile]['+ count +'][file_path]"><div class="file-upload"><span class="file-txt">Select file</span><input disabled="disabled" value="No File Chosen"></div><div class="size-txt">(Max. 00 mb)</div></div>');
			$('.custom-upload input[type=file]').change(function(){
    	$(this).next().find('input').val($(this).val());
	});
	        count++;
    	}
	});
	
	
	//Add Questions
	var count = 0;
	$(".add-ques").click(function(){
		var count = $('.ques-num').length;
		if(count < 500) {
			$(".addques-here").append('<div class="ques-num"><div class="quest-title clearfix"><p class="left-title">Question '+ (count+1) +'</p><div class="ryt-title">Max. Marks <input class="pop-dura" type="text" value=""></div></div><div class="quest-lst-box"><label>Question type</label><div class="quest-select"><select class="chosen-select select_option"><option>Multiple choice single select</option><option>Multiple choice multi select</option><option>True /False</option><option selected>Match the following</option></select></div></div></div>');
			$(".chosen-select").chosen({allow_single_deselect:true});$('select.chosen-select').customSelect();
			count++;
    	}
	});
	
	//Add answer :: Single
	var count = 0;
	$(".add-single-link").click(function(){
		var count = $('.ans-lst').length;
		if(count < 5) {
			$(".add-ans-single").append('<div class="ans-lst clearfix"><input type="text" class="pop-input" placeholder="Answer choice '+ (count+1) +'"><div class="ans-radio"><input id="ans'+ (count+1) +'" type="radio" name="answer" value="ans'+ (count+1) +'"><label for="ans'+ (count+1) +'" class="radio-lbl"></label></div></div>');
			count++;
    	}
	});
	
	//Add answer :: Multiple
	var count = 0;
	$(".add-multiple-link").click(function(){
		var count = $('.ans-mlst').length;
		if(count < 5) {
			$(".add-ans-multiple").append('<div class="ans-mlst clearfix"><input type="text" class="pop-input" placeholder="Answer choice '+ (count+1) +'"><div class="ans-radio"><input id="mul'+ (count+1) +'" type="checkbox" name="mulple" value="mul'+ (count+1) +'"><label for="mul'+ (count+1) +'" class="check-lbl"></label></div></div>');
			count++;
    	}
	});
	
	//Add answer :: Match following
	var count = 0;
	$(".add-match").click(function(){
		var count = $('.m-opt1').length;
		if(count < 20) {
			$(".match-opt").append('<div class="m-opt1  clearfix"><input class="pop-input" type="text" placeholder="Question"><input class="pop-match" type="text" placeholder=""><input class="pop-match" type="text" placeholder=""><input class="pop-input" type="text" placeholder="Answer choice"></div>');
			count++;
    	}
	});
	
	//upload more links
	var count = 0;
	$(".add-link").click(function(){
		var count = $('.add-links').length;
		if(count < 8) {
			$(".upload-links").append('<div class="add-links"><input type="text" class="pop-input" placeholder="Upload links" name="data[Link]['+ count +'][linktext]"></div>');
	        count++;
    	}
	});
	
	// remove div on close
	$('.add-here').on('click','a.close-btn',function(){
		$(this).closest('.add-choice').remove();
	});
	
	$(".as1tabdec,.as2tabdec,.as3tabdec").hide();

	//Accordion 1 Lavel
	$(".as1tab").click(function(e) {
		$(this).next(".as1tabdec").slideToggle(200).siblings(".as1tabdec:visible").slideUp(200);
		$(this).toggleClass("active");
	  	$(this).siblings(".as1tab").removeClass("active");
    });
	
	
	//Accordion 2 Lavel
	$(".as2tab").click(function(e) {
		$(this).next(".as2tabdec").slideToggle(200).siblings(".as2tabdec:visible").slideUp(200);
		$(this).toggleClass("active");
	  	$(this).siblings(".as1tab").removeClass("active");
		
    });
	
	//Accordion 3 Lavel
	$(".as3tab").click(function(e) {
		$(this).next(".as3tabdec").slideToggle(200).siblings(".as3tabdec:visible").slideUp(200);
    });	
	
	
	  
	  //password tooltip
	$(".tooltip-pass").focus(function(){
		$(".pass-tooltip").show();
    });
	$(".tooltip-pass").blur(function(){
		$(".pass-tooltip").hide();
    });
	  
	// words limit 
	$( ".add-topic" ).keyup(function() {
		var len = this.value.length;
           if (len >= 200) {
              this.value = this.value.substring(0, 200);
           }
          $('#rem_count').text(200 - len);
	});
	//feedback word count
	$( ".count-1" ).keyup(function() {
		var len = this.value.length;
           if (len >= 1000) {
              this.value = this.value.substring(0, 1000);
           }
          $('#rem_count1').text(1000 - len);
	});	
	$( ".count-2" ).keyup(function() {
		var len = this.value.length;
           if (len >= 1000) {
              this.value = this.value.substring(0, 1000);
           }
          $('#rem_count2').text(1000 - len);
	});	
	$( ".count-3" ).keyup(function() {
		var len = this.value.length;
           if (len >= 1000) {
              this.value = this.value.substring(0, 1000);
           }
          $('#rem_count3').text(1000 - len);
	});	
	$( ".count-4" ).keyup(function() {
		var len = this.value.length;
           if (len >= 1000) {
              this.value = this.value.substring(0, 1000);
           }
          $('#rem_count4').text(1000 - len);
	});	
		
	//recurring check
	$('.recurr-chk input[type="checkbox"]').change(function(){
        if(this.checked)
            $('.reoccurencepattern').slideDown('slow');
        else
            $('.reoccurencepattern').slideUp('slow');

    });
	
	//recurr patern radio
   $('.recurr-radio input[type="radio"]').click(function(){
        if($(this).attr("value")=="Daily")
          {
				$('.recurr-daily').show();
				$('.recurr-weekly,.recurr-monthly,.recurr-yearly').hide();
		  }
		  if($(this).attr("value")=="Weekly")
          {
				$('.recurr-weekly').show();
				$('.recurr-daily,.recurr-monthly,.recurr-yearly').hide();
		  }
		  if($(this).attr("value")=="Monthly")
          {
				$('.recurr-monthly').show();
				$('.recurr-weekly,.recurr-daily,.recurr-yearly').hide();
		  }
		  if($(this).attr("value")=="Yearly")
          {
				$('.recurr-yearly').show();
				$('.recurr-weekly,.recurr-monthly,.recurr-daily').hide();
		  }

    });
	
	//create new submission radio
	$('.marks-input').hide();
	$('.grades-input').hide();
	$('.radio-btn input[type="radio"]').click(function(){
        if($(this).attr("value")=="Marks")
          {
				$('.marks-input').show();
				$('.grades-input').hide();
		  }
		  if($(this).attr("value")=="Grades")
          {
				$('.grades-input').show();
				$('.marks-input').hide();
		  }
    });
	
	//test
	$('.txt-area,.pro-txtarea').autoResize();
	
	//quiz tabs
	$('.pcacs-tabs').click(function () {
        var pastep ="."+ $(this).attr('title')
        $(this).parents('.pacs').hide();
        $(pastep).show();
    });


	// draggable  invite 
    $( "#catalog div" ).draggable({
      appendTo: "body",
	  containment: 'DOM',
      helper: "clone"
    });
    $( "#cart ol" ).droppable({
      activeClass: "ui-state-default",
      hoverClass: "ui-state-hover",
      accept: ":not(.ui-sortable-helper)",
      drop: function( event, ui ) {
        $( this ).find( ".placeholder" ).remove();
		var test= ui.draggable.text();
        $( "<li></li>" ).text( test ).append('<a href="#" class="remove-li"></a>').appendTo( this );
		
		$(".remove-li").click(function(e) {
		$(this).parent().remove();
		
    });
      }
    }).sortable({
      items: "li:not(.placeholder)",
      sort: function() {
        // gets added unintentionally by droppable interacting with sortable
        // using connectWithSortable fixes this, but doesn't allow you to customize active/hoverClass options
        $( this ).removeClass( "ui-state-default" );
      }
    });

	//notification panel height
	var a3 = $(window).height();
	var w1 = $(window).width();
	var w2=w1-575;
	var w3=w2-20;
	var s1=a3-200;
	var msg=a3-149;
	$(".noti-lst,.recom-lst").css({'height':+s1+'px','overflow':'hidden'});
	$(".msg-pnl").css({'height':+msg+'px','overflow':'hidden'});
	$(".rmsg-scroll").slimScroll({'height':+msg+'px',color: '#575757'});
	$(".noti-scroll").slimScroll({'height':+s1+'px',color: '#575757'});
	 $(".notification_details").css({'height':+a3+'px'});
	$(".mainmsg-right").css({'width':+w2+'px'});
	
		//slim scroll
	$(".cus-scroll").slimScroll({height: '145px'});	
	//$(".noti-scroll").slimScroll({height: '500px',color: '#575757'});
	$(".msg-scroll").slimScroll({height: '420px',color: '#575757'});
	$(".msgleft-scroll").slimScroll({height: '500px',color: '#575757'});	
	$(".stud-scroll").slimScroll({height: '255px',color: '#575757'});	
	$(".ans-scroll").slimScroll({height: '280px',color: '#575757',alwaysVisible: true});		

	
	
	
	
// Right panel Calender 
	$( "#req-datepicker" ).datepicker({
		inline: true
	});
$( ".duration" ).datepicker();
$( ".date_popup" ).datepicker({
	showOn: "both",
	buttonImage: "images/classroom/pop-cal.png",
	buttonImageOnly: true
});

//left menu scroll
$('.scroll-pane').each(function(){
	setSlider($(this));
});

var bh = $(window).height();
var al = bh-260;
 $(".scroll-pane").css({'height':+al+'px'});	
 
$(window).resize(function(){
	var bh = $(window).height();
	var al = bh-260;
	$(".scroll-pane").css({'height':+al+'px'});	
});	


$('.arrow_up').mousedown(function(event) {
	if(event.preventDefault) event.preventDefault();
    intervalId = setInterval('scrollUp()', 30);
	$(this).bind('mouseup mouseleave', function() {
		clearInterval(intervalId);
	});
});
$('.arrow_down').mousedown(function(event) {
	if(event.preventDefault) event.preventDefault();
    intervalId = setInterval('scrollDown()', 30);
	$(this).bind('mouseup mouseleave', function() {
		clearInterval(intervalId);
	});
});

function scrollUp(){
	if ($(".slider-vertical").slider("value")<100){
		$(".slider-vertical").slider("value",$(".slider-vertical").slider("value")+1);
	}
}
function scrollDown(){
	if ($(".slider-vertical").slider("value")>0){
		$(".slider-vertical").slider("value",$(".slider-vertical").slider("value")-1);
	}
}

	//1000chatercters show
	$(".commentsend p").hide();
	$(".commentwrite textarea").click(function( event ) {
		$(".commentsend p").show();
	});
	//Report View
		$(".closelink").hide();
	$(".comm-link").click(function( event ) {
	$(".closelink").show();
	$(".viewbtn").hide();
	
	});
	 $( ".viewingremaining" ).hide();
	 $(".bor-rep").click(function() {
		$(this).parents().siblings(".viewingremaining").toggle();
		
	});
   
   $(window).scroll(function () {
        if ($(this).scrollTop() > 490) {
            $('body').addClass("fixedheader");
            
        } else {
            $('body').removeClass("fixedheader");
            //$('.header').removeClass("headerfixed");
        }
    });
//Landing page image change	
$(".slider-acc a").click(function () {
		var simg = $(this).attr( "rel" );
		$(".screenimg img").attr('src', simg);
		$(".enlar-txt").prop("href", simg)
	 });
//$(".enlar-txt").click(function () {
//	
//		$(this).toggleClass('active');
//		
//		if($(this).text()=='Enlarge Image'){
//			$(".big-img").show();
//		$(".screenimg").hide();
//		$(this).text(function(i,v) {
//           return v === 'Enlarge Image' ? 'Close' : 'Enlarge Image';
//     	});
//			}
//		else if($(this).text()=='Close'){
//			$(".big-img").hide();
//		$(".screenimg").show();
//		$(this).text(function(i,v) {
//           return v === 'Enlarge Image' ? 'Close' : 'Enlarge Image';
//     	});
//			}
//	 });

//progress bar
$( "#progressbar" ).progressbar({
      value: 50
    });


//Custom select
$(".chosen-select").chosen({allow_single_deselect:true});
//$('select.chosen-select').customSelect();






