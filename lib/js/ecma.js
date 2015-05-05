var clickcount = 0;
var WIDTH;
var HEIGHT;
var sliderCount = 1;

function openHome(){
			$('#contentPrev').css("display","none");
			$('#boardMembers').css("display","none");
			$('#contentUp').css("display","none");
			$('#newsBar').fadeIn('slow', function() {});
			$('#homeContent').fadeIn('slow', function() {});
		}

function openAbout(){
			$('#contentPrev').css("display","none");
			$('#homeContent').css("display","none");
			$('#contentUp').css("display","none");
			$('#newsBar').css("display","none");
			$('#boardMembers').fadeIn('slow', function() {});
			
		}

function openPrev () {
			$('#contentUp').css("display","none");
			$('#boardMembers').css("display","none");
			$('#homeContent').css("display","none");
			$('#newsBar').css("display","none");
			$('#contentPrev').fadeIn('slow', function() {});
		}

function openUp () {
			$('#contentPrev').css("display","none");
			$('#boardMembers').css("display","none");
			$('#homeContent').css("display","none");
			$('#newsBar').css("display","none");
			$('#contentUp').fadeIn('fast', function() {});
				window.setTimeout(epicCSI, 300);
				sliderMaster();
		}

function enLarge () {
			if (clickcount%2 === 0){
				$('#memberlogin1').css("height","10em").css('border', '1px solid #0267AB');
				$('#loginform').delay(150).fadeIn('slow', function() {});
                $('#logoutform').delay(150).fadeIn('slow', function() {});
			}
			else
			{	
				$('#loginform').fadeOut('fast', function() {});
                $('#logoutform').fadeOut('fast', function() {});
				$('#memberlogin1').delay(150).css("height","1.2em").css('border', '0px solid #FFB547');	
			}
			++clickcount;
		}

function resize(){
			var h = window.innerHeight
			var w = window.innerWidth
			$('#homeCanvas').css("height",h-70).css("width",w-17);
            $('#footer').css("width",w-19);
			$('#footer').css("width",w-17);
			$('#newsBar').css("width",w-17);
			$('#homeLogo').css("top",(h/2)-140).css("left",(w/2)-70);

            if (w > 735 && w < 852) { $('#prevevt').css("display", 'inline');}
			else if (w < 735) { $('#prevevt').css("display", "none"); $('#upevt').css("display", "none"); }
			else if (w < 952) { $('#upevt').css("display", "none"); }
			else { $('#prevevt').css("display", 'inline'); $('#upevt').css("display", 'inline'); } 

		}

function sliderMaster () {
    switch (sliderCount){
        case 1: window.setTimeout(showPic1, 400); break;
        case 2: window.setTimeout(showPic2, 400); break;
        case 3: window.setTimeout(showPic3, 400);
        }
}

 function showPic1() {   
                $('#pic3').fadeOut('slow', function () { });
                $('#pic2').css('display', 'none');
                $('#pic1').fadeIn(1000, function () { });
                $('#eventInfo3').css('background-color', '#000');
                $('#eventInfo1').css('background-color', '#FF9900');
                sliderCount = 1;
                var timeoutID1 = window.setTimeout(showPic2, 4000);
              
            }

function showPic2() {
                $('#pic2').fadeIn(1000, function () { });
                $('#eventInfo2').css('background-color', '#FF9900');
                $('#eventInfo1').css('background-color', '#000');
                sliderCount = 2;
                var timeoutID2 = window.setTimeout(showPic3, 4000); 
        
            }

function showPic3() {
        $('#pic3').fadeIn(1000, function () { });
        $('#eventInfo3').css('background-color', '#FF9900');
        $('#eventInfo2').css('background-color', '#000');
        sliderCount = 3;
        var timeoutID3 = window.setTimeout(showPic1, 4000);
    
            }
		
function epicCSI(){
			var c=document.getElementById("abtCanvas"); 
			var ctx=c.getContext("2d");
			var endAngle = 1.5;
			var startAngle = 1.5;
			var crdntX = 41;
			var crdntY = 80;
			var clr2, clr3, clr4, clr5, clr6, clr7, clr8, clr9, clr10;

  			//var timeoutID1 = window.setTimeout(slowAlert, 2000);
  			
  			function stop (){clearInterval(clr8);}
			
 				function drawC(){
 					if (endAngle >= 0.5){
 					ctx.beginPath(); 
 					ctx.lineWidth=7;
 					ctx.strokeStyle="orange";
 					ctx.lineCap="round";
 					endAngle -= 0.01;
 					ctx.arc(40,50,30,startAngle*Math.PI, endAngle*Math.PI, true); 
 					ctx.stroke();  
 					startAngle -= 0.01;}
 					else{ctx.beginPath(); 
 						ctx.lineWidth=7;
 						ctx.strokeStyle="orange";
 						ctx.arc(40,50,30,1.5*Math.PI, 0.5*Math.PI, true); 
 						ctx.stroke(); 
 						clearInterval(clr1);
 						crdntX = 41;
 						clr2 = setInterval(drawCS, 50);
 						}
				}var clr1 = setInterval(drawC, 20);
 			
 			//C to S drawing
 			function drawCS () {
 				
 			if (crdntX < 66){
 				ctx.beginPath();
 				ctx.lineWidth="7";
 				ctx.lineCap="butt";
 				ctx.strokeStyle="rgb(0,46,138)";
 				ctx.moveTo((crdntX-1),80);
 				ctx.lineTo(crdntX,80);
 				crdntX++;
 				ctx.stroke();}
 			else if (crdntX >= 65 & crdntX<=80){
 				ctx.beginPath();
 				ctx.lineWidth="7";
 				ctx.lineCap="butt";
 				ctx.strokeStyle="orange";
 				ctx.moveTo((crdntX-1),80);
 				ctx.lineTo(crdntX,80);
 				crdntX++;
 				ctx.stroke();}
 			else{
 				startAngle = 0.5; endAngle = 0.5; 
 				clearInterval(clr2);
 				clr3 = setInterval(drawFirstS, 30);  }
 			}
 			

 			function drawFirstS () {
 			if (endAngle > 1 & endAngle <= 1.5){
 				clearInterval(clr3);
 				endAngle = startAngle = 0.5;
 				clr4 = setInterval(drawSecondS, 25);}
 					else
 			if (endAngle<=0.5) {
 			ctx.beginPath();
 			ctx.lineWidth=7;
 			ctx.strokeStyle="orange";
 			endAngle -= 0.02;
 			ctx.arc(80,65,15,startAngle*Math.PI,endAngle*Math.PI, true);
 			startAngle = endAngle;
 			ctx.stroke();
			if(endAngle<0.03){
				ctx.beginPath();
 				ctx.lineWidth=7;
 				ctx.strokeStyle="orange";
				ctx.arc(80,65,15,0.5*Math.PI,0, true); 
				ctx.stroke(); endAngle = 1.99; startAngle = 0;}} 

 					else
 			if (endAngle > 1.5){
 			ctx.beginPath();
 			ctx.lineWidth=7;
 			ctx.strokeStyle="orange";
 			endAngle -= 0.01;
 			ctx.arc(80,65,15,startAngle*Math.PI,endAngle*Math.PI, true);
 			startAngle = endAngle;
 			ctx.stroke();}
 			 
 		}
 			function drawSecondS(){
 			
 			if(endAngle < 1.5){
 			ctx.beginPath();
 			ctx.lineWidth=7;
 			ctx.strokeStyle="orange";
 			endAngle += 0.01;
 			ctx.arc(80,35,15,startAngle*Math.PI,endAngle*Math.PI, false);
 			startAngle = endAngle; 
 			ctx.stroke();}
 			else {
 				ctx.beginPath();
 				ctx.lineWidth=7;
 				ctx.strokeStyle="orange"
 				ctx.arc(80,65,15,0,1.5*Math.PI, true); 
 				ctx.arc(80,35,15,0.5*Math.PI,1.5*Math.PI, false);
 				ctx.stroke();
 				clearInterval(clr4);
 				crdntX = 80;
 				clr4 = setInterval(drawSI, 55);
 			}}

 			function drawSI(){
 				if (crdntX <= 95) {
 			ctx.beginPath();
 			ctx.lineWidth="7";
 			ctx.strokeStyle="orange";
 			ctx.moveTo(80,20);
 			ctx.lineTo(crdntX,20);
 			ctx.stroke();
 			crdntX++;
 			} else if (crdntX <= 123){
 			//S to I drawing
 			ctx.beginPath();
 			ctx.lineWidth="7";
 			ctx.strokeStyle="rgb(0, 46, 138)";
 			ctx.moveTo(95,20);
 			ctx.lineTo(crdntX,20);
 			ctx.stroke();
 			crdntX++;}
 			else {clearInterval(clr4); 
 				crdntY = 20;
 				clr5 = setInterval(drawI, 25);
 			}
 		}

 		function drawI(){
 			//Line Drawing

 			if(crdntY <= 80){
 			ctx.beginPath();
 			ctx.lineWidth=7;
 			ctx.lineCap="round";
 			ctx.strokeStyle="orange";
 			ctx.moveTo(123,20);
 			ctx.lineTo(123,crdntY);
 			crdntY++;
 			ctx.stroke(); 
 			}else{clearInterval(clr5); crdntX = crdntY = 0; window.setTimeout(drawV, 800);}
			}
 			
//drawing V
 			function drawV(){
 			ctx.beginPath();
 			ctx.lineWidth=4;
 			ctx.lineCap="round";
 			ctx.strokeStyle="#002E8A";
 			ctx.moveTo(30, 95);
 			ctx.lineTo(40, 124);
 			ctx.stroke();
 			ctx.beginPath();
 			ctx.lineWidth=4;
 			ctx.lineCap="round";
 			ctx.strokeStyle="#002E8A";
 			ctx.moveTo(40, 124);
 			ctx.lineTo(50, 95);
 			ctx.stroke();
 			crdntX = 50; crdntY = 95; 
 			clr6 = setInterval(drawDash, 50);}


 			function drawDash(){
 			//Dash on top
 			if (crdntX <= 90){
 			ctx.beginPath();
 			ctx.lineWidth=4;
 			ctx.lineCap="round";
 			ctx.strokeStyle="#002E8A";
 			ctx.moveTo(51, 95);
 			ctx.lineTo(crdntX, 95);
 			crdntX++;
 			ctx.stroke();}
 			else {clearInterval(clr6); crdntY = 95; clr7 = setInterval(drawVerticals, 50); }
 			}

 			function drawVerticals(){
 			
 			if(crdntY <= 125){

 			//T vertical
 			ctx.beginPath();
 			ctx.lineWidth=4;
 			ctx.lineCap="square";
 			ctx.strokeStyle="#002E8A";
 			ctx.moveTo(80, 95);
 			ctx.lineTo(80, crdntY);
 			ctx.stroke();

 			//I vertical
 			ctx.beginPath();
 			ctx.lineWidth=4;
 			ctx.lineCap="square";
 			ctx.strokeStyle="orange";
 			ctx.moveTo(64, 95);
 			ctx.lineTo(64, crdntY);
 			ctx.stroke();
 			crdntY++;}

 			else {clearInterval(clr7); crdntX = 65; crdntY = 65;
 					clr8 = setInterval(drawIleft, 50);
 					clr9 = setInterval(drawIright, 50);
                    } //crdntY being used as x coordinate for drawIright()
 		}

 		function drawIleft(){
 			
 			if (crdntX >= (57)){
 			//I horizontal left
 			ctx.beginPath();
 			ctx.lineWidth=4;
 			ctx.lineCap="round";
 			ctx.strokeStyle="orange";
 			ctx.moveTo(65, 125);
 			ctx.lineTo((crdntX), 125);
 			ctx.stroke();

 			//I horizontal top left
 			ctx.beginPath();
 			ctx.lineWidth=4;
 			ctx.lineCap="round";
 			ctx.strokeStyle="#orange";
 			ctx.moveTo(65, 95);
 			ctx.lineTo((crdntX), 95);
 			ctx.stroke();
 			crdntX--;}  else {clearInterval(clr8);}}

 		function drawIright() {	

 			if (crdntY <= (71)){
 			//I horizontal right
 			ctx.beginPath();
 			ctx.lineWidth=4;
 			ctx.lineCap="round";
 			ctx.strokeStyle="#orange";
 			ctx.moveTo(65, 125);
 			ctx.lineTo(crdntY, 125);
 			ctx.stroke();

 			//I horizontal top right
 			ctx.beginPath();
 			ctx.lineWidth=4;
 			ctx.lineCap="round";
 			ctx.strokeStyle="#orange";
 			ctx.moveTo(65, 95);
 			ctx.lineTo(crdntY, 95);
 			ctx.stroke();
 			crdntY++;} else {clearInterval(clr9);}}
}