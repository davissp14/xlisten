<?php

?>
<html>
<head>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>

<script type="text/javascript" src="slide.js">

/***********************************************
* Ultimate Fade In Slideshow v2.0- (c) Dynamic Drive DHTML code library (www.dynamicdrive.com)
* This notice MUST stay intact for legal use
* Visit Dynamic Drive at http://www.dynamicdrive.com/ for this script and 100s more
***********************************************/

</script>

<script type="text/javascript">

var mygallery=new fadeSlideShow({
	wrapperid: "fadeshow1", //ID of blank DIV on page to house Slideshow
	dimensions: [250, 180], //width/height of gallery in pixels. Should reflect dimensions of largest image
	imagearray: [
		["slideImages/01.jpg"],
		["slideImages/02.jpg"],
		["slideImages/03.jpg"],
		["slideImages/04.jpg"] //<--no trailing comma after very last image element!
	],
	displaymode: {type:'auto', pause:4500, cycles:0, wraparound:false},
	persist: false, //remember last viewed slide and recall within same session?
	fadeduration: 500, //transition duration (milliseconds)
	descreveal: "ondemand",
	togglerid: ""
})


var mygallery2=new fadeSlideShow({
	wrapperid: "fadeshow2", //ID of blank DIV on page to house Slideshow
	dimensions: [250, 180], //width/height of gallery in pixels. Should reflect dimensions of largest image
	imagearray: [
		["slideImages/01.jpg", "", "", "This is the color Red!"],
		["slideImages/02.jpg", "", "","Greeeeeeeeeeeen"],
		["slideImages/03.jpg"],
		["slideImages/04.jpg", "", "", "Annnnd This is something else..... "] //<--no trailing comma after very last image element!
	],
	displaymode: {type:'auto', pause:2500, cycles:0, wraparound:false},
	persist: false, //remember last viewed slide and recall within same session?
	fadeduration: 500, //transition duration (milliseconds)
	descreveal: "always",
	togglerid: "fadeshow2toggler"
})

</script>
</head>
   <body>

<div id="fadeshow1"></div>

<br />

<div id="fadeshow2"></div>

<div id="fadeshow2toggler" style="width:250px; text-align:center; margin-top:10px">
<a href="#" class="prev"><img src="http://i31.tinypic.com/302rn5v.png" style="border-width:0" /></a>  <span class="status" style="margin:0 50px; font-weight:bold"></span> <a href="#" class="next"><img src="http://i30.tinypic.com/lzkux.png" style="border-width:0" /></a>
</div>
</body>
</html>
