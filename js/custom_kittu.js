$(function(){
    $(".dropdown").hover(            
            function() {
                $('.dropdown-menu', this).stop( true, true ).fadeIn("fast");
                $(this).toggleClass('open');
                $('b', this).toggleClass("caret caret-up");                
            },
            function() {
                $('.dropdown-menu', this).stop( true, true ).fadeOut("fast");
                $(this).toggleClass('open');
                $('b', this).toggleClass("caret caret-up");                
            });
    });
    



(function( $ ) {
	function doAnimations( elems ) {
		var animEndEv = 'webkitAnimationEnd animationend';
		
		elems.each(function () {
			var $this = $(this),
				$animationType = $this.data('animation');
			$this.addClass($animationType).one(animEndEv, function () {
				$this.removeClass($animationType);
			});
		});
	}

	var $myCarousel = $('#carousel-example-generic'),
		$firstAnimatingElems = $myCarousel.find('.item:first').find("[data-animation ^= 'animated']");

	$myCarousel.carousel();

	doAnimations($firstAnimatingElems);

	$myCarousel.carousel('pause');

	$myCarousel.on('slide.bs.carousel', function (e) {
		var $animatingElems = $(e.relatedTarget).find("[data-animation ^= 'animated']");
		doAnimations($animatingElems);
	});  
	
})(jQuery);



var vid = document.getElementById("bgvid");
var pauseButton = document.querySelector("#polina button");

function vidFade() {
  vid.classList.add("stopfade");
}

vid.addEventListener('ended', function()
{
// only functional if "loop" is removed 
vid.pause();
// to capture IE10
vidFade();
}); 


pauseButton.addEventListener("click", function() {
  vid.classList.toggle("stopfade");
  if (vid.paused) {
    vid.play();
    pauseButton.innerHTML = "Pause";
  } else {
    vid.pause();
    pauseButton.innerHTML = "Paused";
  }
})



function initialize() {
    var mapOptions = {
        zoom: 9,
        center: new google.maps.LatLng(28.9285745, 77.09149350000007),
        mapTypeId: google.maps.MapTypeId.TERRAIN
     };
 
     var map = new google.maps.Map(document.getElementById('location-canvas'),
mapOptions);
 
    var marker = new google.maps.Marker({
        map: map,
        draggable: false,
        position: new google.maps.LatLng(28.9285745, 77.09149350000007)
    });
}
 
google.maps.event.addDomListener(window, 'resize', initialize);
google.maps.event.addDomListener(window, 'load', initialize)