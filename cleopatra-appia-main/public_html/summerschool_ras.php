<!DOCTYPE html>
<html>
<!--
Esempio di istanziazione di Mirador con apertura diretta su di un'immagine.
Si tratta di un manoscritto di e-codices, e il dato relativo a canvasID è preso dal suo
manifest.json; le altre opzioni di windowObjects sono in:
https://github.com/IIIF/mirador/wiki/Complete-Configuration-API#loaded-objects

-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>Mirador Viewer</title>
    <style type="text/css">
     #viewer {  width: 100%; height: 100%; }
    </style>
    
    <script src="mirador3/mirador.min.js"></script>
    
  
    
    <link rel="stylesheet" type="text/css" href="mirador3/manifestButton.css" />
    
    <!--  Bot Libs-->
    <!--
	<script type='text/javascript' src='strophe.umd.js'></script>
	
	<script type='text/javascript' src='echobot.js'></script>
	-->
	
<!--	
	<script type="text/javascript" src="chung/mytemplates.js"></script>
	<script type="text/javascript" src="chung/mypatterns.js"></script>
	<script type="text/javascript" src="chung/mywords.js"></script>
	<script type="text/javascript" src="chung/mywordspatt.js"></script>
	<script type="text/javascript" src="chung/mystarpatt.js"></script>
	<script type="text/javascript" src="chung/mystarpatt2.js"></script>
	<script type="text/javascript" src="chung/mystartemp.js"></script>
	<script type="text/javascript" src="chung/mythats.js"></script>
	<script type="text/javascript" src="chung/mytopics.js"></script>-->
	
	<!--  please put here your own yandex-translate free key -->  
	<script type="text/javascript" src="chung/myyandexkey.js"></script>
	<script type='text/javascript' src='chung/chatbot_chung_prog_s.js'></script>
	<script type="text/javascript">
	var crlf = "\r\n";
 	var myvbuff=new Array(100000);
	var mynvert=0;var auxvar="",auxtext="";
	var test=112;var mymesh=null;var dataobj="";var myscene=null,mytexture=null;
	var imagesrc="";var mymesh1=null,mymesh2=null,mymesh3=null,mymesh4=null,bodytext=null;
    </script>
	<script type="text/javascript" src="chung/anne4_obj.js"></script>
	<script type="text/javascript" src="chung/anne4eye_obj.js"></script>
	<script type="text/javascript" src="chung/anne4mouth_obj.js"></script>
	<script type="text/javascript" src="chung/anne4moutho_obj.js"></script>
	<script type="text/javascript" src="chung/anne4smile_obj.js"></script>
	<!--script type="text/javascript" src="anne4_jpg.js"></script-->
	<!--script type="text/javascript" src="alexiabody2_obj.js"></script>
	<script type="text/javascript" src="alexiabody2_jpg.js"></script-->
	<script type="text/javascript" src="chung/myjsc3d.js"></script>
	
	<script type="text/javascript" src="chung/ciel_jpg.js"></script>

  <script type="text/javascript" src="chung/chatbot_chung_say.js"></script>
  <script type="text/javascript" src="mira_controls.js"></script>


</head>
<body>

</head>
<body>
<script>

!(function () {
	
  let e = document.createElement("script"),
    t = document.head || document.getElementsByTagName("head")[0];
  (e.src =
    "https://cdn.jsdelivr.net/npm/rasa-webchat@1.0.1/lib/index.js"),
    // Replace 1.x.x with the version that you want
    (e.async = !0),
    (e.onload = () => {
      window.WebChat.default(
        {
          customData: { language: "en" , mirador: true},
          //socketUrl: "https://parsec2.unicampania.it",
          socketUrl: "http://localhost:5005",
          //socketPath: "/socketintent.io/",
		  socketPath: "/socket.io/",
          embedded: false,
          onSocketEvent: onsocketevent,
          // add other props here
        },
        null
      );
    }),
    t.insertBefore(e, t.firstChild);
})();

	onsocketevent = {
	'bot_uttered': function(e) {
		 if(e){
			 
			 if(e.text){
		     text = e.text; 
	         say222();
		       }
		     else if(e.action)
		       {
				   exec_mirador_actions("http://localhost/~milo/appia/mir_actions.php",e.action, miradorInstance);

	         }
	      }
    }
 }
    
</script>

    <div id="viewer"/>


	  <script type="text/javascript">	
		  
    		  
	var miradorInstance = Mirador.viewer({
       id: 'viewer',
       language: 'it',
      selectedTheme: 'dark',
       openManifestsPage: true,
      window: {
		  panels: {
			layers: true
		 },
		  defaultView:'single',
				views: [
						{ key: 'single'},
						{ key: 'book' },
						{ key: 'scroll'},
						{ key: 'gallery' }
						]
				
			},
	  windows: [{
		 id: 'main_window',
      //   manifestId: 'http://143.225.20.99/alba/msprova/manifest.json',
      manifestId: 'summerschool/index.json',
      //   canvasId: 'http://www.dante.unina.it/iiif/ms_jp2/CNMD0000249997/CNMD0000249997_0001.jp1',
        thumbnailNavigationPosition: 'far-bottom',
       }],
       /*
       workspace: {

    isWorkspaceAddVisible: true, 
},*/
       manifestButton: {
		iconClass: 'fa-file' // Define the icon class of the button
		},
		
     });


	//At each transmission, if I don't know the socket, I save it:
	const originalSend = WebSocket.prototype.send;
	window.sockets = [];
	WebSocket.prototype.send = function(...args) {
	  if (window.sockets.indexOf(this) === -1)
		window.sockets.push(this);
	  return originalSend.call(this, ...args);
	};

	//I save the sessionId:
	let sessionId = JSON.parse(window.localStorage.chat_session).session_id;
	
	//Function to send a direct message to Rasa on the socket:
	function transmit(action, message) {
		if (sockets.length > 0) {
				sockets[0].send('42["' + action + '",{"message":"' + message + '","customData":{"language":"en","mirador":true},"session_id":"' + sessionId + '"}]');
		}
	}
	
	miradorInstance.store.subscribe( () => {
		//console.log(miradorInstance.store.getState());
		var state = miradorInstance.store.getState();
		
		
		//INTERCEPTION OF PAGE CHANGE EVENT:
		if( typeof this.oldId === 'undefined' )
		{
			this.oldId = "";
		}
		
		var id = state.windows.main_window.canvasId;
		
		if( typeof id !== 'undefined' && id !== this.oldId )
		{
			console.log("--------- Page changed ------------");
			console.log("Previous URL: " + this.oldId);
			console.log("New URL: " + id);
			
			let canvas = id.substring(id.lastIndexOf("/") + 1);
			console.log("Canvas: " + canvas);
			
			this.oldId = id;
			
			transmit("user_uttered", "page change " + id);
		}
		
		
		//INTERCEPTION OF ZOOM/PAN EVENT:
		if( typeof this.oldMainWindow === 'undefined' )
		{
			this.oldMainWindow = { zoom: 0, x: 0, y: 0 };
		}
		
		var viewer = state.viewers.main_window;
		
		if( viewer != null ) 
		{
			//If it is a zoom:
			if( viewer.zoom != this.oldMainWindow.zoom )
			{
				console.log("--------- Zoom occurred ------------");
				console.log("Previous zoom: " + this.oldMainWindow.zoom + ". x = " + this.oldMainWindow.x + ". y = " + this.oldMainWindow.y);
				console.log("New zoom: " + viewer.zoom + ". x = " + viewer.x + ". y = " + viewer.y);
				
				transmit("user_uttered", "zoom " + viewer.zoom + " x " + viewer.x + " y " + viewer.y);
			}
			//If it is a pan:
			else if( viewer.x != this.oldMainWindow.x || viewer.y != this.oldMainWindow.y )
			{
				console.log("--------- Pan occurred ------------");
				console.log("Previous center: x = " + this.oldMainWindow.x + ". y = " + this.oldMainWindow.y);
				console.log("New center: x = " + viewer.x + ". y = " + viewer.y);
				
				transmit("user_uttered", "panning x " + viewer.x + " y " + viewer.y);
			}
			
			this.oldMainWindow = viewer;
		}


		//INTERCEPTION OF ANNOTATION SELECTION EVENT:
		if( typeof this.oldAnnotation === 'undefined' )
		{
			this.oldAnnotation = "";
		}
		
		var annotation = state.windows.main_window.selectedAnnotationId;
		
		if(typeof annotation !== 'undefined' && annotation !== this.oldAnnotation )
		{
			console.log("--------- Annotation selected ------------");
			console.log("Previous annotation: " + this.oldAnnotation);
			console.log("New annotation: " + annotation);
			
			let annotationId = annotation.substring(annotation.lastIndexOf("/") + 1);
			console.log("Annotation id: " + annotationId);
			
			this.oldAnnotation = annotation;
			
			transmit("user_uttered", "annotation " + annotation);
		}
	} )

    </script>

</body>
  
<script>    
    window.document.body.insertAdjacentHTML( 'afterbegin', '<div id="chunghead" style="display:block;box-sizing: border-box;z-index:1031;bottom:5px;margin:0;right:10px;left:0;height:3em;position:fixed;padding-left: env(safe-area-inset-left);padding-right:env(safe-area-inset-right);"><div style="z-index: 1031;position: fixed;top: 5em;right: 260px;display: flex;flex-wrap: wrap;"><div  class="flyout box-flyout" style="width:250px;display: flex;flex-direction: column; justify-content: space-between;box-shadow: 1px 3px 5px 3px rgb(0 0 0 / 40%);z-index: 2;overflow: hidden; border-radius: 0;position:absolute;flex-direction: column;"><canvas id="cv" style="border: 1px solid;" width="250" height="250" ></canvas></div></div></div>' );
    var canvas;
	var viewer;
    var vbuff0=[];var vbuff1=[];
	var vbuff2=[];var vbuff3=[];var vbuff4=[];var nvbuff=0;
	var myimage=new Image;
	myimage.width=512;myimage.height=512;
	myimage.src="chung/anne4.jpg";
    function printmsg(txt){
	   console.log(txt+crlf+auxtext);}
		function init() {
		canvas = document.getElementById('cv');
		var wx= parseInt(window.innerWidth*0.98);
        var wy= parseInt(window.innerHeight*0.89);
		canvas.width=Math.min(wx,wy);  
		canvas.height=Math.min(wx,wy); 
        //document.getElementById("msg").setAttribute("style", "top:0px;left:0px;width:250px;height:"+(Math.min(wx,wy)-4)+"px;");
		viewer = new JSC3D.Viewer(canvas);
	    //viewer.setParameter('SceneUrl', '../demos/models/anne4.obj');
		viewer.setParameter('SceneUrl', '');
		viewer.setParameter('InitRotationX', -90);
		viewer.setParameter('InitRotationY', -5);
		viewer.setParameter('InitRotationZ', 0);
		viewer.setParameter('ModelColor', '#FFFFFF');
		//viewer.setParameter('BackgroundImageUrl',cieljpg);
		//viewer.setParameter('BackgroundColor1', '#AFAFFF');
		//viewer.setParameter('BackgroundColor2', '#8FAFAF');
		viewer.setParameter('BackgroundColor1', '#000000');
		viewer.setParameter('BackgroundColor2', '#000000');
		viewer.setParameter('RenderMode', 'texturesmooth');
		viewer.setParameter('MipMapping', 'on');
		viewer.setParameter('Definiton', 'standard');
		viewer.setParameter('Renderer', '');
		viewer.init();
		viewer.update();
		//alert(anne4mouthobj.length);
		mymesh=new JSC3D.Mesh;
		mymesh.name='mymesh';
		mymesh.vertexBuffer=[];
		mymesh.indexBuffer=[];
		mymesh.texCoordBuffer=[];
		mymesh.texCoordIndexBuffer=[];
		mymesh.isDoubleSided=true;
		var mtllibs=viewer.parseObj(mymesh,anne4obj);
		mymesh.init();
		//alert("mtl="+mtllibs.length);
		/*mymesh4=new JSC3D.Mesh;
		mymesh4.name='mymesh';
		mymesh4.vertexBuffer=[];
		mymesh4.indexBuffer=[];
		mymesh4.texCoordBuffer=[];
		mymesh4.texCoordIndexBuffer=[];
		var mtllibs4=viewer.parseObj(mymesh4,alexiabody2obj);
		mymesh4.init();*/
		myscene=new JSC3D.Scene;
	    myscene.addChild(mymesh);
	    //myscene.addChild(mymesh4);
		viewer.replaceScene(myscene);
		viewer.update();
        //alert("addmesh");
		
		mymesh1=new JSC3D.Mesh;
		mymesh1.name='mymesh1';
		mymesh1.vertexBuffer=[];
		mymesh1.indexBuffer=[];
		mymesh1.texCoordBuffer=[];
		mymesh1.texCoordIndexBuffer=[];
		var mtllibs1=viewer.parseObj(mymesh1,anne4eyeobj);
		mymesh1.init();

		mymesh2=new JSC3D.Mesh;
		mymesh2.name='mymesh2';
		mymesh2.vertexBuffer=[];
		mymesh2.indexBuffer=[];
		mymesh2.texCoordBuffer=[];
		mymesh2.texCoordIndexBuffer=[];
		var mtllibs2=viewer.parseObj(mymesh2,anne4mouthobj);
		mymesh2.init();

		mymesh3=new JSC3D.Mesh;
		mymesh3.name='mymesh3';
		mymesh3.vertexBuffer=[];
		mymesh3.indexBuffer=[];
		mymesh3.texCoordBuffer=[];
		mymesh3.texCoordIndexBuffer=[];
		var mtllibs3=viewer.parseObj(mymesh3,anne4mouthoobj);
		mymesh3.init();
		
		mymesh4=new JSC3D.Mesh;
		mymesh4.name='mymesh4';
		mymesh4.vertexBuffer=[];
		mymesh4.indexBuffer=[];
		mymesh4.texCoordBuffer=[];
		mymesh4.texCoordIndexBuffer=[];
		var mtllibs4=viewer.parseObj(mymesh4,anne4smileobj);
		mymesh4.init();
		
		setTimeout("init0();",50);
	}
	function init0(){
		//mymesh=myscene.children[0];
		mytexture=new JSC3D.Texture;
	    mytexture.onready = function() {
		 mymesh.setTexture(this);
		 viewer.update();
		};
	    //mytexture.createFromUrl('https://sites.google.com/site/chungkn1400/myjava/anne4.jpg?attredirects=0');
		//alert(document.images.img.src);
		mytexture.createFromImage(myimage);
		//mymesh.setTexture(mytexture);
	    mymesh.setRenderMode('texturesmooth');
		//if(mymesh.hasTexture()){alert("mytexture");}
		//canvas.width=canvas.height=512;
		//var ctx = document.getElementById('cv').getContext('2d');
		//var image=document.images.img;
		//ctx.drawImage(myimage, 0, 0,400,400);
		//alert("testcanvas");
		/*bodytext=new JSC3D.Texture;
	    bodytext.onready = function() {
		 mymesh4.setTexture(this);
		 viewer.update();
		};
		bodytext.createFromImage(myimage2);
		//mymesh4.setTexture(bodytext);
	    mymesh4.setRenderMode('texturesmooth');
		for(var i=0;i<(mymesh4.vertexBuffer.length-2);i+=3){
		   mymesh4.vertexBuffer[i]*=18.0;
		   mymesh4.vertexBuffer[i+1]*=18.0;
		   mymesh4.vertexBuffer[i+2]*=18.0;
		   mymesh4.vertexBuffer[i]+=-1.2;
		   mymesh4.vertexBuffer[i+1]+=22.0;
		   mymesh4.vertexBuffer[i+2]+=13.0;
		}*/
	    mynvert=mymesh.vertexBuffer.length;
		//viewer.update(); 
		if (mynvert>mymesh1.vertexBuffer.length){mynvert=mesh1.vertexBuffer.length;}
		if (mynvert>mymesh2.vertexBuffer.length){mynvert=mesh2.vertexBuffer.length;}
		if (mynvert>mymesh3.vertexBuffer.length){mynvert=mesh3.vertexBuffer.length;}
		if (mynvert>mymesh4.vertexBuffer.length){mynvert=mesh4.vertexBuffer.length;}
		if (mynvert>100000){mynvert=100000;}
		//alert("init0 nvert="+mynvert);
		setTimeout("init2();",50);
    }
    function init2(){
		nvbuff=mynvert;
		var sc=1.06;
		var scale=[],scalex=0.95*sc,scaley=0.965*sc,scalez=1.04*sc,dz=[];
		var scale2=[];
		for(var i=0; i<nvbuff; i+=3){
		    scale[i]=scalex;scale[i+1]=scaley;scale[i+2]=scalez;
			dz[i]=0;dz[i+1]=0;dz[i+2]=-14*sc;
			var y=mymesh.vertexBuffer[i+1];
			if(y>0){scale2[i]=0;scale2[i+1]=0;scale2[i+2]=0;}
			else{scale2[i]=scalex;scale2[i+1]=scaley;scale2[i+2]=scalez;}
			}
		for(var i=0; i<nvbuff; i++){
		   vbuff0.push(mymesh.vertexBuffer[i]*scale[i]+dz[i]);
		   vbuff1.push((mymesh1.vertexBuffer[i]-mymesh.vertexBuffer[i])*scale2[i]);
		   vbuff2.push((mymesh2.vertexBuffer[i]-mymesh.vertexBuffer[i])*scale2[i]);
		   vbuff3.push((mymesh3.vertexBuffer[i]-mymesh.vertexBuffer[i])*scale2[i]);
		   vbuff4.push((mymesh4.vertexBuffer[i]-mymesh.vertexBuffer[i])*scale2[i]);
		}
		mymesh1.vertexBuffer=null;
		mymesh1.indexBuffer=null;
		mymesh1.texCoordBuffer=null;
		mymesh1.texCoordIndexBuffer=null;
		mymesh2.vertexBuffer=null;
		mymesh2.indexBuffer=null;
		mymesh2.texCoordBuffer=null;
		mymesh2.texCoordIndexBuffer=null;
		mymesh3.vertexBuffer=null;
		mymesh3.indexBuffer=null;
		mymesh3.texCoordBuffer=null;
		mymesh3.texCoordIndexBuffer=null;
		mymesh4.vertexBuffer=null;
		mymesh4.indexBuffer=null;
		mymesh4.texCoordBuffer=null;
		mymesh4.texCoordIndexBuffer=null;
    	anne4eyeobj=null;
	    anne4mouthobj=null;
		anne4mouthoobj=null;
		anne4smileobj=null;
	    anne4obj=null;
		anne4jpg=null;
		//document.getElementById('intext').focus();
		//initelizabot();
		//printmsg("patterns loaded:"+iaiml+crlf+"allwords:"+iallword+crlf+"stars loaded:"+istar+crlf+"enter a text or *"+crlf+crlf+crlf+"enter => repeat"+crlf+"star* => autochat");
		setTimeout("loop();",50);
}
	var mousex0=0;
	function mousemove(e){
    if ((e.clientX - mousex0)>2){
	mousex0=e.clientX;viewer.rotMatrix.rotateAboutYAxis(5);
	viewer.update();};
	if ((mousex0 - e.clientX)>2){
	mousex0=e.clientX;viewer.rotMatrix.rotateAboutYAxis(-5);
	viewer.update();};
	}
    
	function gettimer(){
    return Date.now();//(new Date()).getTime();
    }
	var iloop=0,tloop=0,quit=0,tkeye=0;
	var keye=0,kmouth=0,kmoutho=0,ksmile=0;
	function loop(){
    testspeak();
	iloop +=1;if(iloop>70){iloop=1;};
	if (iloop<=35){viewer.rotMatrix.rotateAboutYAxis(0.2);}
	if (iloop>35){viewer.rotMatrix.rotateAboutYAxis(-0.2);}
    var Timer=gettimer()/1000.0;
	var ktime=1.5;
    keye=(Math.sin(Timer*ktime-tkeye)*1.3+0.7)*0.32;
    ksmile=(Math.cos(Timer*ktime*0.3)*1.3+0.7)*0.42;
    drawphonemes();
    var kmouth2=kmoutho;//'(Cos(Timer*ktime*0.75)+1)*0.64
    var kmouth1=kmouth+(Math.cos(Timer*ktime*0.85)+0.7)*0.15+kmoutho*0.3;
    var kfps=2.4;
	if ((Math.random()<0.03*kfps) && (keye>1.45*0.32)){keye=0;tkeye=Timer*ktime;}
	var vbuf = mymesh.vertexBuffer;
	var nvbuf=vbuf.length;
	if (nvbuf>nvbuff){nvbuf=nvbuff;};
    var sc=0.895;kmouth1*=sc;kmouth2*=sc;
    for (var i=0;i<nvbuf;i++){
   	  vbuf[i]=(vbuff0[i]+keye*vbuff1[i]+(kmouth1*vbuff2[i])+(kmouth2*vbuff3[i])+(ksmile*vbuff4[i]));
   	} 
	viewer.update();
	//subfocus();
	if (quit==0){tloop=setTimeout("loop();",40);}
	}
	function reset(){
	viewer.resetScene();
	viewer.update();
	}
	function reset2(){
	reset();
    intext0="";
	//document.getElementById('intext').focus();
	}
	var tsubfocus=0,tfocus=1;
	function subfocus(){
		/*
	 var timer=gettimer();
	 if(timer>tsubfocus+3000){tsubfocus=timer;
	  var text=document.getElementById('intext').value;
	  if(tfocus){document.getElementById('intext').value="";}
	  if(tfocus){document.getElementById('intext').value=text;}
	  if(tfocus){document.getElementById('intext').focus();}
	 } 
	 */
	 ;
	}  
	function resetvars(){};
var phoneme="",phoneme0="",inword="",inword0="";
var nphoneme=7,iphoneme=0;
var phonemes=new Array(nphoneme);
var tphoneme=new Array(nphoneme);

function addphoneme(iphon){
var Timer=gettimer()/1000.0;
iphoneme+=1;if(iphoneme>nphoneme){iphoneme=1;};
phonemes[iphoneme]=iphon;
tphoneme[iphoneme]=Timer;
} 
function drawphoneme(i){
var ktime,dt,dtt,d1;
var Timer=gettimer()/1000.0;
ktime=4.5;//'2.80
dt=tphoneme[i]-Timer;
if(dt>999){tphoneme[i]=0;}
dtt=dt*ktime*0.75;
if(dtt>3.1416){return;}
d1=0.82;
switch(phonemes[i]){
	case 'o':
   kmoutho+=(Math.sin(dtt)+d1)*0.64;
   kmouth+=kmoutho*0.3;break;
	case 'u':
   kmoutho+=(Math.sin(dtt)+d1)*0.64;
   kmouth+=kmoutho*0.3;break;
	case 'i':
   kmoutho+=(Math.sin(dtt)+d1)*0.24;
   kmouth+=kmoutho*0.3;
   kmouth+=(Math.sin(dtt)+0.7)*0.3;break;
   ksmile+=kmoutho*0.3;
	case 'e':
   kmoutho+=(Math.sin(dtt)+d1)*0.24;
   kmouth+=kmoutho*0.3;
   kmouth+=(Math.sin(dtt)+0.7)*0.25;break;
	case 'w':
   kmoutho+=(Math.sin(dtt)+d1)*0.2;
   kmouth+=kmoutho*0.3;
   kmouth+=(Math.sin(dtt)+0.7)*0.3;break;
	case 'x':
   kmoutho+=(Math.sin(dtt)+d1)*0.15;
   kmouth+=kmoutho*0.2;
   kmouth+=(Math.sin(dtt)+0.7)*0.2;break;
	case 'r':
   kmoutho+=(Math.sin(dtt)+d1)*0.18;
   kmouth+=kmoutho*0.3;
   kmouth+=(Math.sin(dtt)+0.7)*0.24;break;
	case 'm':
   kmoutho+=(Math.sin(dtt)+d1)*0.18;
   kmouth+=kmoutho*0.3;
   kmouth+=(Math.sin(dtt)+0.7)*0.27;break;
	case 't':
   kmoutho+=(Math.sin(dtt)+d1)*0.18;
   kmouth+=kmoutho*0.2;
   kmouth+=(Math.sin(dtt)+0.7)*0.27;break;
	case 'ch':
   kmoutho+=(Math.sin(dtt)+d1)*0.18;
   kmouth+=kmoutho*0.25;
   kmouth+=(Math.sin(dtt)+0.7)*0.3;break;
	
	default: 
   kmouth+=(Math.sin(dtt)+0.7)*0.4;break;
		
   }
}

function drawphonemes(){
if (phoneme!=phoneme0){
	phoneme0=phoneme;
 	if (phoneme==" "){
 		//inword0=inword;
 		for( var i=1;i<=nphoneme;i++){
 			tphoneme[i]=0;
        }
	}
 	if (phoneme!=" "){addphoneme(phoneme);}
}
kmoutho=0;
kmouth=0;
var Timer=gettimer()/1000.0;
for (var i=1;i<=nphoneme;i++){
	if (Timer<(tphoneme[i]+1)){
		drawphoneme(i);
	}
}
}
var audiotime0=0,audiotime1=0,textspeak="",text="",audiosrc="",words=[];
var textspeakall="";
var abc="abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890+-*/()[]=.'";
var audio = null;//new Audio();
var tsay=0,vsay=14.0;
var speechstart=0,speechend=0;
function speakhtml(){
tsay=1;
//alert(textspeak);
if(textspeak.length<1){return;}
var u=null;
try{
u = new SpeechSynthesisUtterance(textspeak);
}
catch(err){tsay=0;};if(tsay==0){return;}
textspeak=textspeak+" ";
u.lang = lang;//'en';
u.rate = 0.65;
//var voices = window.speechSynthesis.getVoices();
//u.voice=voices[0];alert(voices[0].name);
u.onstart = function(event) { 
  var Timer=gettimer()/1000.0;
  //speechstart=Timer;//alert("speechstart="+speechstart);
  audiotime0=Timer;//speechstart;
  audiotime1=Timer+(textspeak.length/(vsay+1.0));  
  };
u.onend = function(event) { 
  var Timer=gettimer()/1000.0;
  //speechend=Timer;alert("speechend="+speechend);
  var len=textspeak.length;
  if(len>2){vsay+=(len/(Timer-audiotime0+0.01)-vsay)*0.35;};
  audiotime1=audiotime0;  
  //alert(vsay);
  };
window.speechSynthesis.speak(u);
//document.getElementById('intext').value="";
//document.getElementById('intext').focus();

}
function subsearch(txt2){
//var url=document.location.href;
//var i=url.indexOf("?");
//if(i>0){url=url.substr(0,i);}
var url="https://chungswebsite.blogspot.fr/";//set this to your blog url
document.location.href=(url+"search?q="+encodeURIComponent(txt2));
}
var intext0="";var vars=[];var icookie=0;
function say(){
//alert("/"+formateval("okeval(elizawords.length) eval(v['y'];v['y']+=1)")+"/");
//icookie+=1;if(icookie>11){icookie=0;savecookie();}
//reset();
var intext=document.getElementById('intext').value;
var intext2=intext.trim(),txt2="";
if(intext2.indexOf("s ")==0){txt2=(intext2.substr(2,20));}
if(intext2.indexOf("se ")==0){txt2=(intext2.substr(3,20));}
if(intext2.indexOf("sea ")==0){txt2=(intext2.substr(4,20));}
if(intext2.indexOf("sear ")==0){txt2=(intext2.substr(5,20));}
if(intext2.indexOf("searc ")==0){txt2=(intext2.substr(6,20));}
if(intext2.indexOf("search ")==0){txt2=(intext2.substr(7,20));}
//if(txt2!=""){subsearch(txt2);return;}
if(intext==""){intext=intext0;}//+" .";};
intext=replaceall(intext,"&"," ");
if(intext==""){intext=" ";}
intext0=intext;
nextsub='say1("'+intext+'");';
if(intext!="*"){detectlang(intext+"+"+intext);}
else{say2(intext);}
}
function say1(intext){//alert(lang+"/"+intext);
//if((langs.indexOf(lang+"-en")<0) || (langs.indexOf("en-"+lang)<0)){lang="en";}
nextsub="say2(translatext);";
translate(intext,lang,"en");
}
function say2(intext){
if(intext=="*"){intext=oldmsg;}
intext=formatinput(intext);
//alert("intext:"+intext);
text="";
text=processinput(intext);//eliza.transform(intext);
nextsub="say3(translatext);";
translate(text,"en",lang);
//alert(text);
//text=formateval(text);
//text=text.toLowerCase();
//alert(text);
}
function say3(text){
var msg=text;//intext+crlf+text+crlf+crlf;
if(lang!="en" && msg.indexOf(">")>1){
  msg=replaceall(msg,"> >",">");
  msg=replaceall(msg,"> ",">§");
  msg=replaceall(msg,">§",crlf+"> ");
}
//printmsg(">>"+intext0.substr(0,40)+crlf+msg);
var outmsg=msg;//.substr(msg.indexOf(">")+2,999);
/*var patt=msg.substr(0,msg.indexOf(">"));
if(outmsg.length<0.65*patt.length){
		outmsg=patt+" "+outmsg; 
	}	
	*/
if(auxvar!=""){msg+=crlf+"auxvar="+auxvar;};
if(auxvar!=""){printmsg(msg);}
//alert(outmsg);
if(intext0.trim()=="exit"){setTimeout("subquit();",7000);}
words = formatoutput(outmsg).split("");
var words0="";
textspeak="";
for(var i=0; i<words.length; i++){
  if (words[i].length>0){
  if (abc.indexOf(words[i])>=0-999){
  textspeak=textspeak+words[i];};
  if(words0!=" " && words[i]==" "){textspeak=textspeak+" ";};
  words0=words[i];
  ;};};
textspeakall=textspeak;
audiotime1=Math.min(audiotime1,0.2+gettimer()/1000.0);
speak();
}
</script>
<script src="chung/chatbot_chung_speak.js" >
</script>
<script>
function subquit(){document.location.href="http://chung.blogvie.com/links/";//https://www.google.fr/search?q=nguyen+chung&ie=utf-8&oe=utf-8";
}
function testspeak(){
var Timer=gettimer()/1000.0;
if((Timer>audiotime0) && (Timer<audiotime1) && (textspeak.length>0)){
  var i=parseInt(textspeak.length*(Timer-audiotime0)/(audiotime1-audiotime0+0.01));
  phoneme=textspeak.substr(i,1);
  if((i>0) && (phoneme=="h")){if(textspeak.substr(i-1,1)=="c"){phoneme="ch";};};
  if ((i<(textspeak.length-1)) && (phoneme=="c")){if(textspeak.substr(i+1,1)=="h"){phoneme="ch";};};
}else{phoneme=" ";
      if(textspeakall.length>1 && Timer>(audiotime1+0.02) && 
	     Timer>(audiotime0+0.02)){
	     if(audiotime1<(Timer-0.01)){audiotime1=Timer-0.01;}
	     if(audiotime0<(Timer-0.01)){audiotime0=Timer-0.01;}
		 speak();};}
}
function mykeypress(e) {
    if (e.which == 13 || e.keyCode == 13) {
        var Timer=gettimer()/1000.0;
        //if(Timer>audiotime1 && Timer>(3.1+ttranslate/1000)){say();}
        if(Timer>audiotime0+1 && Timer>(3.1+ttranslate/1000)){say();}
		//return false;
    }
    //left = 37,up = 38,right = 39,down = 40,esc=27
    if (e.which == 37 || e.keyCode == 37) {viewer.rotMatrix.rotateAboutYAxis(2);}
    if (e.which == 39 || e.keyCode == 39) {viewer.rotMatrix.rotateAboutYAxis(-2);}
    if (e.which == 38 || e.keyCode == 38) {viewer.rotMatrix.rotateAboutXAxis(2);}
    if (e.which == 40 || e.keyCode == 40) {viewer.rotMatrix.rotateAboutXAxis(-2);}
    //if (e.which == 27 || e.keyCode == 27) {subquit();}
	//return true;
}

function readcookie(){
var mycookie=document.cookie+";";
//alert("mycookie="+mycookie);
var pref="html5elizabotchung=";
//pref="__utma=";
var i=mycookie.indexOf(pref,0);
if(i<0){return;}
i+=pref.length;
var j=mycookie.indexOf(";",i);
if(j<i){return;}
var mycookie=mycookie.substring(i,j);
//alert(mycookie);
var wcookie=mycookie.split("//");
for(var i=0;i<(wcookie.length-1);i+=2){
    //alert(wcookie[i]+"="+wcookie[i+1]);
    v[wcookie[i]]=wcookie[i+1];
	}
}
function savecookie(){
var mycookie="";
var cookie0=document.cookie;
for(var x in v){
  if((x.indexOf('"',0)<0)&&(x.indexOf("/",0)<0)&&(v[x].indexOf('"',0)<0)&&(v[x].indexOf("/",0)<0)){
  if((x.indexOf('=',0)<0)&&(x.indexOf(";",0)<0)&&(v[x].indexOf('=',0)<0)&&(v[x].indexOf(";",0)<0)){
    mycookie+=x+"//"+v[x]+"//";
    if(mycookie.length>1900){break;}	
  }}
}
//alert(mycookie);  
var pref="html5elizabotchung=";
mycookie =pref+mycookie+"; expires=Fri, 3 Aug 2100 20:47:11 UTC; path=/";
if(mycookie.length>(3900-cookie0.length)){alert("could not save, cookie too long");return;}
document.cookie=mycookie;
}
function deletecookie(){
var pref="html5elizabotchung=";
document.cookie =pref+";expires=Thu, 01 Jan 1970 00:00:01 GMT; path=/";
}
var head = document.getElementsByTagName('head')[0];
var myjson=null,lang="en",translatetext="",ttranslate=0;
var myjson2=null,myjson3=null,nextsub="alert(translatext);";
var langs=["ru-en","ru-pl","ru-uk","ru-de","ru-fr","ru-es","ru-it","ru-bg","ru-cs","ru-tr","ru-ro","ru-sr","en-ru","en-uk","en-de","en-fr","en-es","en-it","en-cs","en-tr","pl-ru","pl-uk","uk-ru","uk-en","uk-pl","uk-de","uk-fr","uk-es","uk-it","uk-bg","uk-cs","uk-tr","uk-ro","uk-sr","de-ru","de-en","de-uk","fr-ru","fr-en","fr-uk","es-ru","es-en","es-uk","it-ru","it-en","it-uk","bg-ru","bg-uk","cs-ru","cs-en","cs-uk","tr-ru","tr-en","tr-uk","ro-ru","ro-uk","sr-ru","sr-uk"];
function myapiCallback(response){//"de","fr","es","it"
	translatext=response.text[0];
	ttranslate=gettimer()-2990;
	setTimeout(nextsub,30);
}
function translate(text,langue,langue2){
translatext=text;
    	ttranslate=gettimer()-2990;
        setTimeout(nextsub,30);return 1;
   
}
</script>

</html>
