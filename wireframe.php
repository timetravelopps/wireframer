<!DOCTYPE html>
<html lang="en">
	<head>
		<title>TTO*UX - Wireframer</title>

		<link rel='stylesheet'
			href='http://fonts.googleapis.com/css?family=Lato:400,700' />
		<link rel="stylesheet" href="css/main.css" />

		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="viewport"
			content="width=device-width, initial-scale=1, user-scalable=0" />

<script>

// Device Image Switcher

function SwapDivsWithClick(div1,div2,div3)
{
   d1 = document.getElementById(div1);
   d2 = document.getElementById(div2);
   d3 = document.getElementById(div3);
   if( d2.style.display == "none" )
   {
      d1.style.display = "none";
      d2.style.display = "block";
      d3.style.display = "none";
   }
   else
   {
   }
}

// css file switcher

function createjscssfile(filename, filetype){
    if (filetype=="js"){ //if filename is a external JavaScript file
        var fileref=document.createElement('script')
        fileref.setAttribute("type","text/javascript")
        fileref.setAttribute("src", filename)
    }
    else if (filetype=="css"){ //if filename is an external CSS file
        var fileref=document.createElement("link")
        fileref.setAttribute("rel", "stylesheet")
        fileref.setAttribute("type", "text/css")
        fileref.setAttribute("href", filename)
    }
    return fileref
}

function replacejscssfile(oldfilename, otherfilename, newfilename, filetype){
    var targetelement=(filetype=="js")? "script" : (filetype=="css")? "link" : "none" //determine element type to create nodelist using
    var targetattr=(filetype=="js")? "src" : (filetype=="css")? "href" : "none" //determine corresponding attribute to test for
    var allsuspects=document.getElementsByTagName(targetelement)
    for (var i=allsuspects.length; i>=0; i--){ //search backwards within nodelist for matching elements to remove
        if (allsuspects[i] && allsuspects[i].getAttribute(targetattr)!=null && (allsuspects[i].getAttribute(targetattr).indexOf(oldfilename)!=-1 || allsuspects[i].getAttribute(targetattr).indexOf(otherfilename)!=-1)){
            var newelement=createjscssfile(newfilename, filetype)
            allsuspects[i].parentNode.replaceChild(newelement, allsuspects[i])
        }
    }
}
</script>
	</head>
		<body>
			<div class="content">

				<div id="phone" id="phone" style="display:block;"></div>
				<div class="tablet" id="tablet" style="display:none;"></div>
				<div class="desktop" id="desktop" style="display:none;"></div>

				<div id="screencontainer">

				<!-- WIREFRAME CONTENTS -->

					<div class="screen">

					<iframe src="wireframe_page.php" />

					</div>
				</div>

				<div class="devices">
					<div class="device"><a href="javascript:replacejscssfile('css/desktop.css', 'css/tablet.css', 'css/main.css', 'css')"><img src="img/device-phone.png"></a></div>
					<div class="device"><a href="javascript:replacejscssfile('css/desktop.css', 'css/main.css', 'css/tablet.css', 'css')"><img src="img/device-tablet.png"></a></div>
					<div class="device"><!-- <a href="javascript:SwapDivsWithClick('phone','desktop', 'tablet')" onClick="changeCSS('css/desktop.css', 0);"> --><a href="javascript:replacejscssfile('css/main.css', 'css/tablet.css', 'css/desktop.css', 'css')"><img src="img/device-desktop.png"></a></div>
				</div>

			</div>
	</body>
</html>