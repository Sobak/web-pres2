<script type="text/javascript" language="javascript" src="1k.js"></script>
<script type="text/javascript" language="javascript" src="slide.js"></script>
<script type="text/javascript" language="JavaScript1.2">
<!--
if(!document.all) {
	window.captureEvents(Event.KEYUP);
} else {
	document.onkeypress = keypressHandler;
}
function keypressHandler(e) {
	var e;
	if(document.all) { //it's IE
		e = window.event.keyCode;
	} else {
		e = e.which;
	}
	if (e == 39) { /* right arrow */
		if (effects.length > 0 && currentEffect < effects.length) {
			switch(effects[currentEffect].getAttribute('effect')) {
				case 'slide':
					try {
						slide(effects[currentEffect], effects[currentEffect].getAttribute('gotox')-120, effects[currentEffect].getAttribute('gotoy'), 0) ;
					} catch (e) { alert(e); }
					break;
				case 'hide':
					oldstyle = effects[currentEffect].getAttribute('oldstyle');
					effects[currentEffect].setAttribute('style',oldstyle+'visibility:visible;');	
					break;
			}
			currentEffect = currentEffect+1;
		} else if (<?php echo $this->nextSlideNum; ?>) {
			top.location='<?php echo "http://$_SERVER[HTTP_HOST]$this->baseDir$this->showScript/{$_SESSION['currentPres']}/$this->nextSlideNum"; ?>';
		}
	}
	if (e == 37 && <?php echo $this->prevSlideNum+1; ?>) /* left arrow */
		top.location='<?php echo "http://$_SERVER[HTTP_HOST]$this->baseDir$this->showScript/{$_SESSION['currentPres']}/$this->prevSlideNum"; ?>';
}
window.onkeyup = keypressHandler;

var effects = [];
var currentEffect = 0;

onload = function() {
	<?php if(!isset($_COOKIE['dims'])) {?>
	get_dims();
	<?php } ?>

	// make banner sticky on old Windows IEs
	<?php 
	if (!$GLOBALS['css_supports_fixed']) {
		echo('window.setInterval("fixNavigation()", 250);');
	}	
	?>
	
<?php if (!isset($_GET['effects']) || ($_GET['effects'] != 'no')) { ?>
	// find any div objects with an effect attribute 
	var divs = document.getElementsByTagName('div');
	for (var i=0; i < divs.length; i++) {
		if (divs[1].hasAttribute && divs[i].hasAttribute('effect')) {
			// ok, add this to our slider array
			//alert("slide "+divs[i].id+" at "+divs[i].offsetLeft+","+divs[i].offsetTop+"\n");
			if(divs[i].getAttribute('effect') == 'slide') {
				divs[i].setAttribute('gotox',divs[i].offsetLeft);
				divs[i].setAttribute('gotoy',0);
				divs[i].setAttribute('style','position:relative;left:-<?php echo $this->winW+10?>;top:0;');
			} else if(divs[i].getAttribute('effect') == 'hide') {
				style = divs[i].getAttribute('style');
				divs[i].setAttribute('style',style+'visibility:hidden;');
				divs[i].setAttribute('oldstyle',style);
			}
			effects[effects.length] = divs[i];
	    }
	}
<?php } ?>
}

function fixNavigation() {  //helper function for making navbar sticky
	 if (document.layers) {
		document.layers["stickyBar"].left = window.pageXOffset;
		document.layers["stickyBar"].top = window.pageYOffset;
	} else if (document.all) {
		document.all("stickyBar").style.posLeft = document.body.scrollLeft;
		document.all("stickyBar").style.posTop = document.body.scrollTop;
 	} else if (document.getElementById) {
		document.getElementById("stickyBar").style.left = window.pageXOffset;
		document.getElementById("stickyBar").style.top = window.pageYOffset;
	}
}

//-->
</script>
