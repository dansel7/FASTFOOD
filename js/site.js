$(function() {
	var sw = document.body.clientWidth, breakpoint = 500, mobile = true;
	var checkMobile = function() {
		mobile = (sw > breakpoint) ? false : true;
	};
	
	checkMobile();
	var backgroundycoord = 0;
	var ypos = new Array();
	ypos[0] = 58;
	ypos[1] = 538;
	ypos[2] = 1049;
	ypos[3] = 1542;
	ypos[4] = 2030;
	ypos[5] = 2975;
	
	// Slideshow 1
    $(window).load(function(){
      $('.flexslider').flexslider({
        animation: "slide",
		direction: "horizontal",
		easing: "easeInOutCirc",
		reverse:"false",
		touch: true
      });
    });

	if (mobile) {
		$("#navitems").addClass("mobile");
	}
	
	$(window).on("scroll", function(){
		var windowScroll = $(window).scrollTop();
		var windowHeight = $(window).height();
		
		if (!mobile) {
			if (windowScroll > (windowHeight - 600)) {
				$('#navitems').css("marginTop","-15px");
				$('#navitems').css("paddingBottom","5px");
			} else {
				$('#navitems').css("marginTop","0px");
				$('#navitems').css("paddingBottom","20px");
			}
		}
		
		// Custom Scrollspy
		mount();
		// Beer anchor
		beermount();
		
	});
	
	function mount() {
        var e, n, i, a,b,c;
		$("#navitems ul a").each(function(){	
			a = $($(this).attr("href")).offset().top + $($(this).attr("href")).outerHeight() -500, 
			b = $(this), 
			c = $(window).scrollTop();
			
			if (a <= c) {
				$("#navitems ul a").removeClass("active");
				$(this).addClass("active");
			} else {
				$(this).removeClass("active");
			}
		});
    }

	function beermount() {
		x = $($("#beer").parent().parent()).offset().top + $($("#beer").parent().parent()).outerHeight() -900;
		z = $(window).scrollTop();
		acdifference = x-z;
		if (x <= z) {
			console.log(acdifference);
			if (acdifference < 0 && acdifference > -69) {
				$("#beer").css({backgroundPosition: "-"+ypos[0]+"px 0px"});
			} else if (acdifference < -69 && acdifference > -126) {
				$("#beer").css({backgroundPosition: "-"+ypos[1]+"px 0px"});
			} else if (acdifference < -126 && acdifference > -174) {
				$("#beer").css({backgroundPosition: "-"+ypos[2]+"px 0px"});
			} else if (acdifference < -174 && acdifference > -229) {
				$("#beer").css({backgroundPosition: "-"+ypos[3]+"px 0px"});
			} else if (acdifference < -229 && acdifference > -290) {
				$("#beer").css({backgroundPosition: "-"+ypos[4]+"px 0px"});
			} else if (acdifference < -290 && acdifference > -330) {
				$("#beer").css({backgroundPosition: "-"+ypos[5]+"px 0px"});
			} else if (acdifference > -330) {
				$("#beer").css({backgroundPosition: "-"+ypos[6]+"px 0px"});
			}
		} else {
			$("#beer").css({backgroundPosition: "-"+ypos[0]+"px 0px"});
		}
	}

	$('#nav a, .arrow a, .button, .anchor').click(function(){
	    $('html, body').stop().animate({
	        scrollTop: $( $(this).attr('href') ).offset().top
	    }, 1000, "easeInOutCirc");
	    return false;
	});
	
	var intID;
	intID = setInterval ( RepeatCall, 700 );
		
	function RepeatCall() {
		$("#floater").toggleClass('down');
	}
	

	var marker;
	var map;
	

	
	$(window).on("scroll", function(){
		var windowScroll = $(window).scrollTop();
		var windowHeight = $(window).height();
		$('#wheel img').css({'left':windowScroll - 4400,'-webkit-transform':'rotate('+windowScroll+'deg)','-moz-transform':'rotate('+windowScroll+'deg)','-o-transform':'rotate('+windowScroll+'deg)','-ms-transform':'rotate('+windowScroll+'deg)','transform':'rotate('+windowScroll+'deg)'});
	});
	
	// Polaroid Generate
	$("#slideshow img").each(function(){
		$(this).clone().appendTo(".polaroid");
	});
	
	// Image Gallery
	$(".polaroid img").eq(0).addClass("one");
	$(".polaroid img").eq(1).addClass("two");
	$(".polaroid img").eq(2).addClass("three");
	$(".polaroid img").eq(3).addClass("four");
	
	$("body").addClass($("#colorpicker select").val());
	$("#colorpicker select").change(function(event){
		$("body").removeClass();
		$("body").addClass($(this).val());
	});
	
}); 
