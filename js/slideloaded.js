$(document).ready(function() {
	function slideLoaded(img){
    var $img = $(img),
        $slideWrapper = $img.parent(),
        total = $slideWrapper.find('img').length,
        percentLoaded = null;
 
    $img.addClass('loaded');
 
    var loaded = $slideWrapper.find('.loaded').length;
 
    if(loaded == total){
        percentLoaded = 100;
        $slideWrapper.easyFader();
    } else {
        percentLoaded = loaded/total * 100;
    };
};
  });