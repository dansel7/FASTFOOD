$(function() {
	function initialize() {
		var mapOptions = {
	    	zoom: 15,
		  	scrollwheel: false,
			mapTypeControl: false,
			disableDoubleClickZoom: true,
			disableDefaultUI: true,
			draggable: true,
			center: true,
		    center: new google.maps.LatLng($("#map").data("lat"), $("#map").data("long")),
		    mapTypeId: google.maps.MapTypeId.ROADMAP
	    };

	    map = new google.maps.Map(document.getElementById('map'), mapOptions);
	    marker = new google.maps.Marker({
	    	map:map,
	    	draggable:true,
	   		animation: google.maps.Animation.DROP,
	   		position: new google.maps.LatLng($("#map").data("lat"), $("#map").data("long"))
	    });

		$(".locationitem").each(function(){
			marker = new google.maps.Marker({
		    	map:map,
		    	draggable:true,
		   		animation: google.maps.Animation.DROP,
		   		position: new google.maps.LatLng($(this).data("lat"), $(this).data("long"))
		    });	
		});		
	}

	window.onload = function(){
		initialize();
	};
});