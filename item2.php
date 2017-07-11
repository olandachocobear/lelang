<?php
session_start();
require "./jwt.php";

// JWT start //
$token=array();
$token['uid'] = $_GET['id']; // for now, get from URL param
$token['IP'] = $_SERVER['REMOTE_ADDR'];

$JWT = JWT::encode($token, 'some secret');

setcookie('tknz_', $JWT, time()+60*60);

// JWT done... //

if (isset($_GET['id'])){
	$id = $_GET['id'];
	setcookie('id', $id, time()+15);
}
else
{
	echo "<script>console.log('" . $_COOKIE['id'] . "')</script>";
}
?>


<!DOCTYPE HTML>
<head>

<script>
function getSessionId(){
console.log(document.cookie);
  var jsId = document.cookie.match(/PHPSESSID=[^;]+/);
  if(jsId) {
	  console.log(jsId);
    if (jsId instanceof Array)
      jsId = jsId[0].substring(10);
    else
      jsId = jsId.substring(10);
  }
  return jsId;
}

getSessionId();

function getCookieValue(a) {
    var b = document.cookie.match('(^|;)\\s*' + a + '\\s*=\\s*([^;]+)');
    return b ? b.pop() : '';
}
function read_cookie(k,r){return(r=RegExp('(^|; )'+encodeURIComponent(k)+'=([^;]*)').exec(document.cookie))?r[2]:null;}

function clog(k){return(document.cookie.match('(^|; )'+k+'=([^;]*)')||0)[2]}


</script>

    <meta charset="utf-8" />
<!-- 	<meta id="Viewport" name="viewport" width="initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=yes">
	 -->	
<!-- <meta name="viewport" content="width=device-width, initial-scale=1"> -->

  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">

	 <title>Lelang Today</title>
    
    <link rel="stylesheet" type="text/css" href="dist/semantic.min.css"/>
    <link rel="stylesheet" type="text/css" href="dist/components/icon.min.css"/>
    <link rel="stylesheet" type="text/css" href="dist/components/dropdown.min.css"/>
    <link rel="stylesheet" type="text/css" href="dist/components/image.min.css"/>
    <link rel="stylesheet" type="text/css" href="dist/components/segment.min.css"/>
 
<link href="oswald.css" rel="stylesheet">
<link href="libs/zebra-dialog/zebra_dialog.min.css" rel="stylesheet">
 <link href="https://fonts.googleapis.com/css?family=Indie+Flower|Titillium+Web:700|Noto+Sans|Raleway:500|Athiti:700|Bubbler+One" rel="stylesheet"> 

  <script src="js/ads_redirect.js"></script> 

    <script src="js/jquery.min.js"></script> 

	<script src="js/jquery.touchSwipe.min.js"></script>

    <script src="js/countdown.js"></script> 

    <script src="libs/zebra-dialog/zebra_dialog.min.js"></script> 

	<script>

	$(document).ready( function(){

		$("#push_button").click(function(){
			$("#last_bid").transition('fly down','600ms').
					transition('bounce',300);
		});

	/*		
			$("body").swipe({
				  swipeStatus:function(event, phase, direction, distance, duration, fingers)
					  {
						  if (phase=="move" && direction =="right") {
							    
								alert ($('.right.demo.sidebar').sidebar('is visible'));
								$('.right.demo.sidebar').sidebar('toggle')
							   return false;
						  }
						  if (phase=="move" && direction =="left") {
								   $('.right.demo.sidebar').sidebar('toggle')
							   return false;
						  }
					  }
			  }); 
	*/

	});



	</script>


	<script src=js/item_socket.js> </script>

    <link href="libs/nouislider/nouislider.css" rel="stylesheet" type="text/css"/>

    <style type="text/css">
	.pusher {

   /* 50% left white */
   
   /*background: #00b928  url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAACvAAAAABAQAAAAAqT0YHAAAAAnRSTlMAAHaTzTgAAAAPSURBVHgBY/g/tADD0AIAIROuUgYu7kEAAAAASUVORK5CYII=) center top repeat-y;
	*/	
	background-image:url(//ssl.gstatic.com/pantheon/images/billing/freetrial_light_hexes_v1.svg);


/* background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='80' height='80' viewBox='0 0 80 80'%3E%3Cg fill='%239C92AC' fill-opacity='0.4'%3E%3Cpath fill-rule='evenodd' d='M11 0l5 20H6l5-20zm42 31a3 3 0 1 0 0-6 3 3 0 0 0 0 6zM0 72h40v4H0v-4zm0-8h31v4H0v-4zm20-16h20v4H20v-4zM0 56h40v4H0v-4zm63-25a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm10 0a3 3 0 1 0 0-6 3 3 0 0 0 0 6zM53 41a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm10 0a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm10 0a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm-30 0a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm-28-8a5 5 0 0 0-10 0h10zm10 0a5 5 0 0 1-10 0h10zM56 5a5 5 0 0 0-10 0h10zm10 0a5 5 0 0 1-10 0h10zm-3 46a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm10 0a3 3 0 1 0 0-6 3 3 0 0 0 0 6zM21 0l5 20H16l5-20zm43 64v-4h-4v4h-4v4h4v4h4v-4h4v-4h-4zM36 13h4v4h-4v-4zm4 4h4v4h-4v-4zm-4 4h4v4h-4v-4zm8-8h4v4h-4v-4z'/%3E%3C/g%3E%3C/svg%3E"); */
		background-repeat: repeat-x;
		background-position: 81% 100%;
		background-size: auto 230px /* 210px */;
		background-attachment: fixed;
	}

	.ZebraDialog {
		max-width: 510px;
	}
	.ZebraDialog .ZebraDialog_Buttons a {
		margin-right: 11px;
	}

	@media all and (max-width:450px) {
	
		.ZebraDialog .ZebraDialog_Body h3 {
			font-size:16px;
		}
	}

	.ZebraDialog .ZebraDialog_Buttons a.ZebraDialog_Button_1 {
		background: #224467;
	}

	.ZebraDialog .ZebraDialog_Body {
		padding-left: 29px;
		background-position: 95% 32px ;
		margin-bottom:-15px;
	}
	.ZebraDialog .ZebraDialog_Body .oxen_tips {
		margin-top: 26px;
		background-color: lemonchiffon;
		border: 2px solid burlywood;
	}
	.ZebraDialog .ZebraDialog_Body h5{
		width: 98.5%;
		height:20px;
		border-bottom: 3px solid brown;
		background: lightgray;
		padding: 6px 0px 6px 6px;
		margin-right: 6px;
	}
	.ZebraDialog .ZebraDialog_Body label {
		font-size: 12px;
		padding: 2px;
	}
	#check_quick {
		margin-top: -10px;
		margin-left: 7px;
		margin-bottom: 15px;
	}
	.ZebraDialog .ZebraDialog_Body .quickbid_text {
		color: green;
		padding: 6px;
	}
	.ZebraDialog .ZebraDialog_Body .zebra_countdown {
		margin-right:-17px;font-size:11px;
		margin-top:26px;color:red;font-style:oblique;float:right; text-decoration:underline;
		margin-bottom: -2px;
	}

	.err {
	  display: inline-block;
	  position: relative;
	}
	.err:before {
	  content: "~~~~~~~~~~~~~~~~~~~";
	  font-size: 0.8em;
	  font-weight: 1000;
	  font-family: Times New Roman, Serif;
	  width: 100%;
	  position: absolute;
	  top: 20px;
	  left: 3px;
	  overflow: hidden;
  	  color: #11117799;
	  text-shadow: 0px -1px 1px #000000aa;
	}

	#item_tabs {
		cursor:pointer
	}
		.content {
			color: #454545 !important;
			font-size: 14px;
		}
		.label {
			opacity: 0.8;
			color: navy !important;
			font-family:verdana !important;
			font-size:11px !important;
			font-weight: bold !important;
		}
		#submitBid {
			transition: background-color 0.3s ease;
		}
		a {
			color: rgba(0,0,0,0.85);
			/* font-size:12.5px; */

		}
		a:hover{
			color:blue;
		}
		.last_bid {
			font-size:20px;
		}
		.bidder-info {
			letter-spacing:1px;	
		}
		.card {
			height: 300px;
		}
		#last_bid{
			/* 
			margin-top:20px;
			margin-bottom:5px;
			 */
			font-weight:bold;
			
			/* font-size: 20px; */
		}
		.timer{
			font-weight:bold;
			font-size:26px;
			color:maroon;
		}

		.item_info {
			color: #666;
		}
/*
		.ui.menu .item{
			font-size:12px;
			margin-bottom: 6px;
		}
*/
		.logo
		{
		font-family: 'Oswald', sans-serif;
		width:140px;
		}


		.ui.menu  .big	{
			font-size: 16px;
		}

		.ui.menu .item.lead {
			background: green;
		}
		.ui.menu .item.outbid {
			background: maroon;
		}
		.ui.menu .item.unbid {
			background: #888;
		}

		.ui.menu .time-each{
			font-size:17px;	
		}

		.ui.menu .timer{
			font-size: 12px;
			float: right;
			margin-top:-34px;
		}

		.ui.menu .timer2{
			font-size: 12px;
			float: right;
			margin-top:-3px;
		}

		.ui.menu .small-price{
			margin-right:-5px;
			float: right;
			margin-top:-6px;
			font-size:10px;
			color: #ccc;
			font-style:oblique;
		}
		.ui.menu .iconfloat{
			position:absolute;
			left: -5px;
			margin-top: 2px;
	}

	#right_top {
		color: #0f4d09c3;
	}

	#endsin_text {
		margin-left:56px;
		padding-right:8px;
/* 		background: #fce78799;
		background: peachpuff;
		color: orangered;
		
		border: 3px outset orange;
		background: #ff7c0044;
		box-shadow: 0px 1px 0px 0px pink;
		*/
	}

	@media all and (max-width:991px) {
		#right_bottom {
			display:none;
		}

		#menu_tabs {
			margin-top:4px;
		}
	}

	@media all and (max-width:540px) {

		#watchBtn {
			padding-left:14px;
		}

		#watch_text:after{
			/* display: none; */
			content: 'Jejak';
			padding-left: 38px;
		}


		#place_text:after{
			/* display: none; */
			content: 'Bid';
		}

		#qbid_text:after{
			/* display: none; */
			content: 'Q. B.';
		}

	}

	@media all and (min-width:541px) {

		#watchBtn {
			padding-left: 20px;
		}
		#watch_text:after{
			/* display: none; */
			content: 'Tinggalin Jejak';
			padding-left: 42px;
		}

		#last_bid {
			margin-bottom:9px;
			margin-top:20px;
			font-size: 27px;
		}

		#place_text:after{
			/* display: none; */
			content: 'Place Bid';
		}
		
		#qbid_text:after{
			/* display: none; */
			content: 'Quick Bid';
		}
	}
	@media all and (orientation:portrait) {
		.nextBid:after{
		   font-size: 18px;
			line-height:115%;
	       content: 'Next\A Bid';
		   white-space: pre;
		}	
	}

	@media all and (max-device-width:419px) {
		.nextBid:after{
		   font-size: 18px;
			line-height:115%;
	       content: 'Next\A Bid';
		   white-space: pre;
		}	
	}
	
	@media all and (min-device-width: 420px) and (orientation: landscape) {
		.nextBid:after{
	       content: 'Next Bid';
		}
	}

	#stats_beside {
			margin-top: 19px;
			/* margin-top:32px; */
		}

	@media all and (max-width:390px) {
	
		#nextBtnOuter {
			width: 50%;
			padding-top: 14px;
			padding-left: 0px;
			padding-right: 0px;
		}

		#last_bid {
			margin-bottom:30px;
			margin-top: -2px;
			font-size: 25px;
		}
	}

	@media all and (min-width:391px) and (max-width:540px) {
		#last_bid {
			margin-bottom:30px;
			margin-top: -2px;
			font-size:26px;

		}
	}

	@media all and (max-width:419px) {

		#thumbs_below {
			display: none;
		}
		#bid_details {
			display: none;
		}
		#next_bid_phone {
			display: block;
		}
		#time_remaining {
			display:none;
		}
		#stats_beside {
			/* margin-top: 13px; */
			margin-top:32px;
		}

		#nextBid {
		   margin-top:3px;

		   /* margin-right:-15px; */
		   width:50%;
		   height:100%;
		   position:relative;

		}

		#submitBid {
			width:109%;
		}
		#watchBtn {
			width:100%;
			line-height:107%;
			font-size:18px
		}

		#left_buttons {
			display:block;
		}

		#right_buttons {
			display:;
		}

		#detail_item {
			display:none;
		}

		.label {
			font-size: 11px !important;
			font-weight:normal;
		}

		#tags {
			margin-top:-20px;
		}

		.stats_text {
			display:none
		}

	}

	@media all and (min-width:391px) and (max-width:419px) {
		#nextBid {
		   margin-top:3px;
		   margin-right:3px;
		   font-size:17px;
		   width:130;
		   height:100%;
		   position:relative;
		}
	}

	@media all and (min-width:420px) and (max-width:499px) {
		#nextBid {
		   margin-top:3px;
		   margin-right:3px;
		   font-size:17px;
		   width:130;
		   height:100%;
		   position:relative;
		}
	}

	@media all and (min-width:500px) and (max-width:991px) {
		#nextBid {
		   margin-right:10px;
		   margin-top:-1px;
		   width:170px;
		   font-size:18px;
		   height: 85px;
		   padding-top:13px;
		}
	}

	@media all and (max-width:660px) {
		#item_side {
			padding-left:0px;padding-right:2px;
		}
	}

	@media all and (min-width:661px) and (max-width:1199px) {
		#item_side {
			padding-left:0px;
			padding-right:33px;
		}

	}

	@media all and (min-width:992px) and (max-width:1199px) {
		.last_bid {
			font-size:26px !important;
			margin-top: -5px !important;
		}

		#left_side {
			
		}
		#item_side {
			width: 48.75% !important;
			margin-left:12px;
			padding-right:2px !important;
		}
		#nextBid {
		   margin-right:10px;
		   margin-top:-1px;
		   width:170px;
		   font-size:18px;
		   height: 85px;
		   padding-top:13px;
		}

		#right_bottom {
			/* margin-top:75px; */
			right: 7px;
			font-size:12px
		}
	}

	@media all and (min-width:1200px) {
		.last_bid {
			font-size:31px !important;
			margin-top:-6px !important;
		}

		#left_side {
			margin-left: -10px
		}

		#item_side {
			padding-left:16px;padding-right:2px;
			margin-left:-11px;
			width: 47% !important;
		}

		#nextBid {
		   margin-right:12px;
		   margin-top:1px;
		   width:170px;
		   font-size:19px;
		   height: 100%;
		}

		#right_bottom {
			/* margin-top:82px; */
			font-size:12px;
			right:10px;
			
		}
	}

	@media all and (min-width:420px) {
		#next_bid_phone {
			display: none;
		}
		.button_text {
			margin-left: 5px;
			margin-top:-10px;
		}
		#submitBid {
			width:75%;
		}

		#watchBtn {
			margin-left:-25%;
			width: 125%;
			padding-left: 17px;
		}
	
		#right_buttons  {
			display:;
		}

		#tags {
			line-height:29px;
		}
	}
	
	@media all and (max-width:660px) {
		#time_remaining, #bid_details { display: none }
		#next_bid_phone { display: block }

		#thumbs_side {
			display:none;
		}
		#social_sharing{
			margin-left:31%;
			margin-right:30%;
		}
	}


	@media all and (min-width:661px) {
		#time_remaining { display: block }
		#bid_details_small, #price_below, #currentBid_text, #time_remaining_phone { display: none }
	}

	@media all and (min-width:661px) and (max-width:991px) {
		#social_sharing{
			margin-left:40%;
			margin-right:40%;
		}

		#thumbs_below {
			display:none;
		}
	}

	@media all and (min-width:992px) {
		
		#menu_tabs {
			margin-top:-22px;
		}
		
		#social_sharing{
			margin-left:31%;
			margin-right:30%;
		}

		#thumbs_side {
			display:none;
		}
		
		#watchBtn {
			margin-left:0%;
			width: 75%;
		}
		
		#place_left {
			display: block;
		}
	}


	@media all and (min-width:722px) and (max-width:991px) {

		#right_top {
			display:block;
			margin-top:-74px;
			right:14.5%;
		}	

		#jejak_count {
			display:inline-block;
			margin-top:0px;
			margin-left:6px;
		}

		#stats_below {
			/* float:right; */
			margin-left:3%;
			margin-top:10px;

		}	
	}

@media all and (min-width:1084px) and (max-width:1480px) {
		#right_top {
			display:none;
			margin-top: -47px;
			right: 15.7%;
		}	
	}


@media all and (min-width:722px) and (max-width:881px) {
		#right_top {
			margin-top: -54px;
			right: 6.7%;
		}	
	}

@media all and (min-width:882px) and (max-width:991px) {
		#right_top {

			margin-top: -54px;
			right: 10.7%;
		}	
	}


@media all and (min-width:992px) and (max-width:1083px) {

		#right_top {
		
			display:none;
			margin-top:-47px;
			right:14.5%;
		}	
	}

	@media all and (min-width:0px) and (max-width:721px) {

		#right_top {
			margin-top:-44px;
			right:6%;
		}	


	

	@media all and (min-width:992px) {

		#watchBtn {
			margin-left:0%;
			width: 75%;
		}

	}

	@media all and (min-width:393px) and (max-width:520px) {
		.ui.mini.images img{
			width: 28px !important;
		}
	}

	@media all and (max-width:392px) {
		.ui.mini.images img{
			width: 23px !important;
		}
	}



	@media all and (min-width:1084px) {
		#right_top {
			margin-top:-44px;
			right:14.5%;
		}
	}


	@media all and (min-width:983px) {
		#place_left {
			display:none;
		}
		#watch_left {
			margin-top:-6px
		}
	}

	@media all and (max-width:982px) {
		#watch_left {
			margin-top: 0px;
		}
		#place_right {
			display:none;
		}
	}


	.noUi-value.noUi-value-horizontal.noUi-value-big {
		font-size:12.5px;
		margin-top:5px;
	}

	.bids_table {
		font-size:14px;
	}

    </style>

</head>
<body >

<div class=container>
<div class="ui big top fixed hidden menu">
    <div class="left menu">
      <div class="logo">
        <a class="item"><center><strong>Lelang Today</strong></center></a>
      </div>
    <a class="active item">Home</a>
    <a class="item">Product</a>
    <a class="item">Lelang Cart</a>
    <a class="item">How To Play</a>
    </div>
    <div class="right menu">
      <div class="item">
        <a class="ui button">Log in</a>
      </div>
      <div class="item">
        <a class="ui primary button">Sign Up</a>
      </div>
    </div>
  </div>

<div class="container marketing">


<!-- SIDEBAR STARTS -->	


	<div style="" class="ui right demo wide sidebar vertical inverted menu out">

			  <a style=margin-top:20px;margin-bottom:35px class="header item big">Search</a>

			  <a class="header item big" >Watched items</a>
			  
			  <div class="item lead">
					<a class=item><img class=iconfloat src=images/green_dot.png >Kishino Rika Bubka Maga..</a>
					<div class="timer right">
						<span class=time-each>
							<span id=minutes1>16</span>:<span id=seconds1>30</span>
						</span> 
						&nbsp;left
					</div>
					<!-- <div class="right small-price">Rp 15000</div> -->
			   </div>
			  <div class="item outbid">
					Saipul Jamil handker..
					<div class="timer2 right">
						<span class=time-each>
							<span id=hours2>01</span>:<span id=minutes2>27</span>:<span id=seconds2>30</span>
						</span> 
						&nbsp;left
					</div>
				</div>
			  <div class="item unbid">
					Cinta Laura socks
					<div class="timer2 right">
						<span class=time-each>
							<span id=hours3>04</span>:<span id=minutes3>39</span>:<span id=seconds3>30</span>
						</span> 
						&nbsp;left
					</div>
				</div>
	</div> 
<!-- END OF SIDEBAR -->



	<div class=pusher style=width:105%>
	<br><br><br>	



	<!-- ads here.. -->

<div id="google_image_div" style="left:22.5%;height: 90px; width: 728px; overflow:hidden; position:absolute"><a id="aw0" target="_top" href="https://www.googleadservices.com/pagead/aclk?sa=L&amp;ai=CUINTxyP4WLP7M9i-ugSfnI_oArXOiYVJ3vvmg5oFy9mupNgIEAEgyaukIGDpquKD5A2gAbu36cQDyAECqQJm4oOhiKPUPagDAcgDyQSqBJYBT9A5x7ZZztwsZIKnzrhF2nB8KwwOFSCPrZ5pYcRcBaAh33YgxT5U4NU02CBjBreHkvQjzJ5HBpqMbXY7bmzvKlEGINnBYIkRvdnsBndFPvI_ysznCOOJfNcQIP_i5qWA7o-u1n_VLidwOGNI8Ove9cNDyeKmBcnbjQGNDKg8fsrEnyVkKBM9QgM0UwUuhQ9Btf1ryDGToAYCgAetyJY7qAemvhvYBwHSCAUIgCEQAQ&amp;num=1&amp;cid=CAASEuRolsH7DkHo7pEBJFFXHg5m6Q&amp;sig=AOD64_1pYLutNrzBU3-lWs-PN6szfAXhfg&amp;client=ca-pub-9579993617424571&amp;nm=2&amp;nx=488&amp;ny=2&amp;mb=2&amp;bg=!w8ClwNhEgMx9Sfu1gHoCAAAAd1IAAABPCgAKztBSzBCcbSPCTZkBH9qUur5hFSUJM0Pqz3x2HzXpSJ8cmikc_SDoiQkgnsfXzkM4F7fPHCR81aPV2dIwyFP-QdXopJNzVaOZQ1huT0WmI0HB-RkIwp7BESCARvVHFTOJcs-jd07SuYohkQlXt8N5HHbLm2qllmw41R87XbewiVDjKts-A-YHar1yRG0ys96IQXbgc5MN-2cQcCu-OkEtrjYu2_Q00E_LTC9b68JVndwZjFPAHZIevaf4VkbaplwTXSHa5w8AnggXKI74Xk_aumYZos27nyUI2QpCYRsso02kPBv5m6r4mzTwTF0aNda0JCt3sDV5JQ-69Sx4LboMhiXZsiCthkkb5Li0mUk8Isr0X60QvfG-hs0y5zKXZftpd467t1w8eghMSNve&amp;adurl=http://www.airasia.com/id/id/home.page%3Fcid%3D1" data-original-click-url="https://www.googleadservices.com/pagead/aclk?sa=L&amp;ai=CUINTxyP4WLP7M9i-ugSfnI_oArXOiYVJ3vvmg5oFy9mupNgIEAEgyaukIGDpquKD5A2gAbu36cQDyAECqQJm4oOhiKPUPagDAcgDyQSqBJYBT9A5x7ZZztwsZIKnzrhF2nB8KwwOFSCPrZ5pYcRcBaAh33YgxT5U4NU02CBjBreHkvQjzJ5HBpqMbXY7bmzvKlEGINnBYIkRvdnsBndFPvI_ysznCOOJfNcQIP_i5qWA7o-u1n_VLidwOGNI8Ove9cNDyeKmBcnbjQGNDKg8fsrEnyVkKBM9QgM0UwUuhQ9Btf1ryDGToAYCgAetyJY7qAemvhvYBwHSCAUIgCEQAQ&amp;num=1&amp;cid=CAASEuRolsH7DkHo7pEBJFFXHg5m6Q&amp;sig=AOD64_1pYLutNrzBU3-lWs-PN6szfAXhfg&amp;client=ca-pub-9579993617424571&amp;adurl=http://www.airasia.com/id/id/home.page%3Fcid%3D1"><img src="https://tpc.googlesyndication.com/simgad/11270647371861041736" alt="" class="img_ad" border="0" width="728"></a><style>div,ul,li{margin:0;padding:0;}.abgc{display:block;height:15px;overflow:hidden;position:absolute;right:16px;top:0px;text-rendering:geometricPrecision;width:15px;z-index:9020;}.abgb{display:block;height:15px;width:15px;}.abgc{cursor:pointer;}.cbb{background-image: url('https://tpc.googlesyndication.com/pagead/images/x_button_blue2.svg');background-repeat: no-repeat;background-position: top right;cursor:pointer;height:15px;width:15px;z-index:9020;}.cbb:hover{background-image: url('https://tpc.googlesyndication.com/pagead/images/x_button_dark.svg');cursor:pointer;}.abgb{position:absolute;right:0px;top:0px;}.cbb{position:absolute;right:0;top:0;}.abgc img{display:block;}.abgc svg{display:block;}.abgs{display:none;height:100%;}.abgl{text-decoration:none;}.abgi{fill-opacity:1.0;fill:#00aecd;stroke:none;}.abgbg{fill-opacity:1.0;fill:#cdcccc;stroke:none;}.abgtxt{fill:black;font-family:'Arial';font-size:100px;overflow:visible;stroke:none;}</style><div id="abgc" class="abgc" dir="ltr"><div id="abgb" class="abgb"><svg width="100%" height="100%"><rect class="abgbg" width="100%" height="100%"></rect><svg class="abgi" x="0px"><path d="M7.5,1.5a6,6,0,1,0,0,12a6,6,0,1,0,0,-12m0,1a5,5,0,1,1,0,10a5,5,0,1,1,0,-10ZM6.625,11l1.75,0l0,-4.5l-1.75,0ZM7.5,3.75a1,1,0,1,0,0,2a1,1,0,1,0,0,-2Z"></path></svg></svg><svg width="100%" height="100%"><rect class="abgbg" width="100%" height="100%"></rect><svg class="abgi" x="0px"><path d="M7.5,1.5a6,6,0,1,0,0,12a6,6,0,1,0,0,-12m0,1a5,5,0,1,1,0,10a5,5,0,1,1,0,-10ZM6.625,11l1.75,0l0,-4.5l-1.75,0ZM7.5,3.75a1,1,0,1,0,0,2a1,1,0,1,0,0,-2Z"></path></svg></svg></div><div id="abgs" class="abgs"><a id="abgl" class="abgl" href="https://www.google.com/url?ct=abg&amp;q=https://www.google.com/adsense/support/bin/request.py%3Fcontact%3Dabg_afc%26url%3Dhttp://myfigurecollection.net/%26gl%3DID%26hl%3Den%26client%3Dca-pub-9579993617424571%26ai0%3DCUINTxyP4WLP7M9i-ugSfnI_oArXOiYVJ3vvmg5oFy9mupNgIEAEgyaukIGDpquKD5A2gAbu36cQDyAECqQJm4oOhiKPUPagDAcgDyQSqBJYBT9A5x7ZZztwsZIKnzrhF2nB8KwwOFSCPrZ5pYcRcBaAh33YgxT5U4NU02CBjBreHkvQjzJ5HBpqMbXY7bmzvKlEGINnBYIkRvdnsBndFPvI_ysznCOOJfNcQIP_i5qWA7o-u1n_VLidwOGNI8Ove9cNDyeKmBcnbjQGNDKg8fsrEnyVkKBM9QgM0UwUuhQ9Btf1ryDGToAYCgAetyJY7qAemvhvYBwHSCAUIgCEQAQ&amp;usg=AFQjCNHj1AIeyI-loWGRr2zZeN3NR_pVzA" target="_blank"><svg width="100%" height="100%"><path class="abgbg" d="M0,0L96,0L96,15L4,15s-4,0,-4,-4z"></path><svg class="abgtxt" x="5px" y="11px" width="34px"><text>Ads by</text></svg><svg class="abgtxt" x="41px" y="11px" width="38px"><text>Google</text></svg><svg class="abgi" x="81px"><path d="M7.5,1.5a6,6,0,1,0,0,12a6,6,0,1,0,0,-12m0,1a5,5,0,1,1,0,10a5,5,0,1,1,0,-10ZM6.625,11l1.75,0l0,-4.5l-1.75,0ZM7.5,3.75a1,1,0,1,0,0,2a1,1,0,1,0,0,-2Z"></path></svg></svg><svg width="100%" height="100%"><path class="abgbg" d="M0,0L96,0L96,15L4,15s-4,0,-4,-4z"></path><svg class="abgtxt" x="5px" y="11px" width="34px"><text>Ads by</text></svg><svg class="abgtxt" x="41px" y="11px" width="38px"><text>Google</text></svg><svg class="abgi" x="81px"><path d="M7.5,1.5a6,6,0,1,0,0,12a6,6,0,1,0,0,-12m0,1a5,5,0,1,1,0,10a5,5,0,1,1,0,-10ZM6.625,11l1.75,0l0,-4.5l-1.75,0ZM7.5,3.75a1,1,0,1,0,0,2a1,1,0,1,0,0,-2Z"></path></svg></svg></a></div></div><div id="cbb" class="cbb"></div><div id="mute_panel" class="survey-horiz survey-spaced jake-middle"><div id="panel_set"><div id="ad_closed_panel" class="panel" wp="1"><div class="panel-container"><div class="panel-content fade"><div class="panel-row" style="font-size: 16px;"><span id="closed_text"><span>Ad closed by </span><img src="https://www.gstatic.com/images/branding/googlelogo/2x/googlelogo_dark_color_84x28dp.png"><span></span></span></div><div class="panel-row" wp="0" style="font-size: 16px;"><a id="report_btn" class="btn responsive-btn shadow"><span id="report_text" class="btn-text" style="font-size: 16px;">Stop seeing this ad</span></a><a id="spacer"></a><a id="settings_btn" class="btn responsive-btn shadow" href="https://www.google.com/ads/preferences/whythisad/en-US/F6rgORqAxhmfFRqM/#/AB3afGEAAAIieyJpbWFnZV93aHlfdGhpc19hZCI6eyJsYW5kaW5nX3VybCI6Imh0dHA6Ly93d3cuYWlyYXNpYS5jb20vaWQvaWQvaG9tZS5wYWdlP2NpZD0xIiwiaW1hZ2VfdXJsIjoiaHR0cHM6Ly90cGMuZ29vZ2xlc3luZGljYXRpb24uY29tL3NpbWdhZC8xMTI3MDY0NzM3MTg2MTA0MTczNiIsImltYWdlX3dpZHRoIjo3MjgsImltYWdlX2hlaWdodCI6OTB9LCJ0YXJnZXRpbmdfcmVhc29ucyI6eyJhZF9yZWFzb24iOlsxLDldLCJleHBsYW5hdGlvbiI6eyJpbnRyb2R1Y3Rpb24iOiJUaGlzIGlzIGEgbGlzdCBvZiB0aGUgaW5mb3JtYXRpb24gc291cmNlcyB1c2VkIHRvIGRldGVybWluZSB0aGF0IHRoaXMgYWQgYmUgc2hvd24gdG8geW91OiIsIml0ZW0iOlt7ImRlc2NyaXB0aW9uIjoiWW91ciB2aXNpdCB0byB0aGUgYWR2ZXJ0aXNlcidzIHdlYnNpdGUuIn0seyJkZXNjcmlwdGlvbiI6IlRoZSB0aW1lIG9mIGRheSwgdGhlIHdlYnNpdGUgeW91IHdlcmUgdmlld2luZyBvciB5b3VyIGdlbmVyYWwgbG9jYXRpb24gKGZvciBleGFtcGxlIGNvdW50cnkgb3IgY2l0eSkuIn1dfX19JJh6K5Y7YNkKwMc1EmDQEJkWgIndcNWsmCRTDIdn_0iAHVNtjoD5r6NG0hk6_nh-oCA1GKXEFjSuLNjfusodQVsi5V5ZLjQe-QGxdf6bQJex0TJgL5p2KvwdiJ6yw4sRKq4O2Kdshzv79sinwsKITtF72CbiTyQo1FymqOtavsc3Ekq0_27XY-3jTTm8m41bGXBJdUBCzcZ_Eh1536ZQyLL4jhnMbgvxUjWP9U2vBjRd-Bl50E4eh6gfg9iXIxoaAGz1DWs08qrBzdJZwksRoi32bkxYxSP64V79iRFDNqBMVnbyjXaJ0iAhD7bQfAUeR0YY7uWOJLFIRFu6qINH8w,55sinmEhG-fogIFZHXkvqg&amp;y_9VOXEinQ4I3vvmg5oFEMKug4ADGOXloDwiD3d3dy5haXJhc2lhLmNvbTIICAUTGPDhLxRCF2NhLXB1Yi05NTc5OTkzNjE3NDI0NTcxSAVYAnAB&amp;https://googleads.g.doubleclick.net/pagead/conversion/?ai=CUINTxyP4WLP7M9i-ugSfnI_oArXOiYVJ3vvmg5oFy9mupNgIEAEgyaukIGDpquKD5A2gAbu36cQDyAECqQJm4oOhiKPUPagDAcgDyQSqBJYBT9A5x7ZZztwsZIKnzrhF2nB8KwwOFSCPrZ5pYcRcBaAh33YgxT5U4NU02CBjBreHkvQjzJ5HBpqMbXY7bmzvKlEGINnBYIkRvdnsBndFPvI_ysznCOOJfNcQIP_i5qWA7o-u1n_VLidwOGNI8Ove9cNDyeKmBcnbjQGNDKg8fsrEnyVkKBM9QgM0UwUuhQ9Btf1ryDGToAYCgAetyJY7qAemvhvYBwHSCAUIgCEQAQ&amp;sigh=ClFNXE-fLLQ" target="_blank" wp="0"><span id="settings_text" class="btn-text" style="font-size: 16px;">Why this ad?&nbsp;<img id="settings_icon" src="https://googleads.g.doubleclick.net/pagead/images/abg/iconx2-000000.png"></span></a></div></div></div></div><div id="survey_panel" class="panel">&nbsp;<style>#survey-container {position: absolute; top: 0px; left: 0px; z-index: 9100; width: 728px; height: 90px; overflow: hidden; background-color: #FAFAFA; font-size: 0; white-space: nowrap;}.survey-native-scroll #survey-container {overflow-x: scroll;}.survey-horiz, .survey-vert {text-align: center;}#survey-container * {box-sizing: border-box; -moz-box-sizing: border-box; -webkit-box-sizing: border-box;}.survey-block {height: 50px;}.survey-option {position: relative; z-index: 9110; overflow: hidden; display: inline-block; padding: 1px 5px; width: 96px; height: 50px; border: 1px solid #E0E0E0; background-color: #FFFFFF; cursor: pointer;}.survey-option:hover, .survey-scroll .survey-option:active {background-color: #F5F5F5;}.survey-option div {width: 100%; height: 100%; display: table; text-align: center;}.survey-option span {vertical-align: middle; display: table-cell; color: #4285F4; font-family: Arial, sans-serif; text-align: center; font-size: 12px; line-height: 14px; white-space: normal;}@media (min-height: 54px) {.survey-horiz.survey-spaced .survey-option, .survey-vert .survey-option {box-shadow: 0px 0px 2px rgba(0,0,0,0.12), 0px 1px 3px rgba(0,0,0,0.26) !important; border: none;}}#mute_panel.survey-horiz .survey-option {display: inline-block; margin-left: -1px; box-shadow: none;}#mute_panel.survey-horiz .survey-option:first-child {margin-left: 0;}#mute_panel.survey-horiz.survey-spaced .survey-option {margin-left: 8px;}#mute_panel.survey-horiz.survey-spaced .survey-option:first-child {margin-left: 0;}#mute_panel.survey-horiz.jake-middle .survey-block {margin-top: 20px;}#mute_panel.survey-horiz.jake-top .survey-block {margin-top: 8px;}#mute_panel.survey-vert .survey-option, #mute_panel.survey-horiz.survey-spaced .survey-option {border-radius: 2px;}#mute_panel.survey-vert .survey-option {margin: 8px auto 0 auto; display: block;}#mute_panel.survey-vert.jake-top .survey-option:first-child {margin-top: 8px;}#mute_panel.survey-vert.jake-middle .survey-option:first-child {margin-top: -67px;}#mute_panel.survey-grid #survey-container {width: initial; height: initial; white-space: normal; padding: 1px;}#mute_panel.survey-grid .survey-option {display: inline-block; width: 361px; height: 42px; margin: 1px;}.option-container {display: inline-block;}.scroll, .native-scroll {position: absolute; top: 0px; z-index: 9120; display: none;}.scroll {width: 30px; border: 1px solid transparent; background-color: #666; background-color: rgba(0,0,0,0.6); text-align: center; transition: visibility 150ms step-end; cursor: pointer;}.native-scroll {width: 10px;}.survey-scroll .scroll, .survey-native-scroll .native-scroll {display: block;}.scroll div {position: absolute; top: 50%; left: 50%; height: 36px; width: 36px; margin: -18px 0 0 -18px;}.scroll:hover, .scroll:active {background-color: #999; background-color: rgba(0,0,0,0.4);}.scroll-right {right: 0;}.native-scroll.scroll-right {-webkit-box-shadow: inset -10px 0px 10px -10px rgba(0,0,0,0.3); -moz-box-shadow: inset -10px 0px 10px -10px rgba(0,0,0,0.3); box-shadow: inset -10px 0px 10px -10px rgba(0,0,0,0.3);}.scroll-right {border-top-left-radius: 4px; border-bottom-left-radius: 4px;}.scroll-right div {background-image:url("https://www.gstatic.com/images/icons/material/system/1x/keyboard_arrow_right_white_36dp.png");}.scroll-left {left: 0;}.native-scroll.scroll-left {-webkit-box-shadow: inset 10px 0px 10px -10px rgba(0,0,0,0.3); -moz-box-shadow: inset 10px 0px 10px -10px rgba(0,0,0,0.3); box-shadow: inset 10px 0px 10px -10px rgba(0,0,0,0.3);}.scroll-left {border-top-right-radius: 4px; border-bottom-right-radius: 4px;}.scroll-left div {background-image:url("https://www.gstatic.com/images/icons/material/system/1x/keyboard_arrow_left_white_36dp.png");}.survey-option {transition: margin 150ms linear;}</style><div id="survey-container"><div id="option-container" class="option-container"><a wp="1" class="survey-block survey-option"><div wp="0"><span style="font-size: 12px;">Ad made me uneasy</span></div></a><a wp="1" class="survey-block survey-option"><div wp="0"><span style="font-size: 12px;">Already bought this</span></div></a><a wp="1" class="survey-block survey-option"><div wp="0"><span style="font-size: 12px;">Not interested in this ad</span></div></a><a wp="1" class="survey-block survey-option"><div wp="0"><span style="font-size: 12px;">Ad covered content</span></div></a><a id="scroll-left" class="survey-block scroll scroll-left" style="visibility:hidden"><div></div></a><a id="scroll-right" class="survey-block scroll scroll-right" style="visibility:visible"><div></div></a></div></div><a id="native-scroll-left" class="survey-block native-scroll scroll-left" style="visibility:hidden"><div></div></a><a id="native-scroll-right" class="survey-block native-scroll scroll-right" style="visibility:visible"><div></div></a></div><div id="post_survey_panel" class="panel" wp="1"><div class="panel-container"><div class="panel-content fade"><span id="confirmation_msg" class="conf-msg" style="font-size: 17px;">We'll try not to show that ad again</span><span id="contributor_msg" class="conf-msg" style="font-size: 17px;"></span></div></div></div><div id="final_closed_panel" class="panel" wp="1"><div class="panel-container"><div class="panel-content fade"><span id="final_closed_text" style="font-size: 17px;"><span>Ad closed by </span><img src="https://www.gstatic.com/images/branding/googlelogo/2x/googlelogo_dark_color_84x28dp.png"><span></span></span></div></div></div></div><style>#panel_set>.panel {position: fixed;top: -90px; left: -728px;z-index: 9100; display: block;width: 728px; height: 90px;}#panel_set img {border: 0;}#panel_set>.panel.visible, #panel_set .visible .panel {position: fixed; left: 0px; top: 0px;opacity: 1;}#panel_set .panel-container {display: table;width: 728px; height: 90px;margin: 0; padding: 0; background-color: #FAFAFA;}#panel_set .panel-row {display: block; padding: 0 0 0.3em 0;}#panel_set .panel-row:first-child {padding: 0.3em;}#panel_set .panel-content {vertical-align: top; display: table-cell; color: #999999; color: rgba(0,0,0,0.4); transition: opacity 150ms linear; text-align: center; font-family: 'Arial', sans-serif;}.collapsed #panel_set .fade {opacity: 0.4;}.jake-middle.survey-horiz #panel_set .panel-content {vertical-align: middle;}#ad_closed_panel .btn {display: inline-block; border-radius: 2px; box-sizing: border-box; -moz-box-sizing: border-box; -webkit-box-sizing: border-box; box-shadow: 0px 0px 2px rgba(0,0,0,0.12), 0px 1px 3px rgba(0,0,0,0.26) !important; text-decoration: none; white-space: nowrap; line-height: 1em; cursor: pointer;}#closed_text, #final_closed_text {display: inline-block; line-height: 1.28em; font-size: 1.2em;}#closed_text img, #final_closed_text img {margin-bottom: -0.34em; height: 1.25em; display: inline-block; width: auto; opacity: 0.4; -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=40)";}#spacer {display: inline-block; padding: 0; box-shadow: none; width: 3px;}.btn>span {display: inline-block; padding: 0.5em 0.6em; line-height: 1em;}#settings_btn {background-color: #FFFFFF; color: #9E9EA6;}#settings_btn:hover, #settings_btn:active {background-color: #F5F5F5;}#settings_text {white-space: nowrap;}#report_btn {background-color: #4285F5; color: white;}#report_btn:hover, #report_btn:active {background-color: #3275E5;}#settings_icon {position: relative; display: inline-block; margin-bottom: -0.15em; height: 1em; width: 1em; opacity: 0.4; -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=40)";}[dir="rtl"] #settings_icon {float: left;}#confirmation_msg {font-weight: bold; color: #333333;}#confirmation_msg, #final_closed_text {line-height: 1.1em; padding: 0.3em;}#post_survey_panel span {display: block; text-align: center; line-height: 1em;}#post_survey_panel a, #post_survey_panel a:active, #post_survey_panel a:hover {text-decoration: none; color: #4285F5;}#final_closed_panel, #final_closed_panel #final_closed_text {opacity: 0; transition: opacity 400ms linear;}#final_closed_panel span {white-space: normal;}#final_closed_panel #final_closed_text.visible {opacity: 1;}.fallback-wrap .btn{margin: 1px auto 1px auto; white-space: normal;}</style></div></div>

<br>	

	<!-- START BODY -->

		<div class="main ui container" style=""> <!-- border: 3px orange ridge;padding-left:20px -->
			<div class="ui " style=margin-top:94px>
				<h5 style=display:none id=auc_id>1</h5>
				<h1 style=margin-bottom:3px;color:#701122;font-size:27px><strong>Poster 2PM - "Hands Up" </strong></h1>
				&nbsp;by: <h5 style=display:inline-block;margin-top:1px>
					<img class="ui avatar image" src=images/angga.jpg> 
					<span style=font-size:13px;color:orange;text-decoration:underline>
						<b>Hottest_Khun</b> 
					</span>
				</h5>

					<!-- Views and Jejak Count.. -->
					<div id=right_top style="position:absolute;float:right;"> <!-- margin-top:-42px;right:14.5%; -->
						<div id=stats_below >
							<div id=view_count style=display:inline-block>
								<img width=29 src=images/eye1.png style=vertical-align:bottom> 58 <span class=stats_text>view</span>
							</div>
							<div id=jejak_count style=display:inline-block;margin-left:5px;margin-top:-2px>
								<img width=22 style=opacity:0.34 src=images/paw3.png> 3 <span class=stats_text>jejak</span>
							</div>

						</div>
					</div>



			<!-- Item-photo Card -->
			<div class="ui two column grid" style="padding:0;margin-top:-12px ">
				<div id="left-side" class="eight wide computer sixteen wide tablet sixteen wide mobile column center">
					
				<div class="ui two column grid">			

					<div id=thumbs_side class="one wide computer one wide tablet column center">
						<center>
							<div class="ui mini images" style=margin-top:10px;margin-bottom:-30px;>
								<img src="images/nendo haikyuu oblong.jpg">
								<img src="images/haikyuu nendos.jpg">
							</div>
						</center>
					</div>
					
					<div class="fifteen wide computer fourteen wide tablet fifteen wide mobile column center">

						<div class="ui centered" style=text-align:center>
							  <div class=" ui image ">
								<img id=preview src="images/2pm.jpg" class="visible content" style=max-height:450px>
								<!--
								<img src="images/9qpwxw766xccgrrcuigt.jpg" class="hidden content">
								 -->
							  </div>
						</div>

						<div class="ui center aligned " id=thumbs_below>
						<center>
							<div class="ui mini images" style=margin-top:10px;margin-bottom:-30px;>
								<img src="images/nendo haikyuu oblong.jpg">
								<img src="images/haikyuu nendos.jpg">
							</div>
						</center>
						</div>
					</div>
					</div>

					<!-- Below the image previews and thumbnails.. -->


				<!-- End of left stats -->


<br>

			<!-- Only on Mobile  -->
			<center>
			<p id=currentBid_text style=margin-top:20px;margin-bottom:12px;font-size:16px >Current Bid:</p>

			<div id=price_below style="padding:2px; width:270px;padding:0 3px 5px 10px;background-color: #f8f8fe;border:solid 2px #aaa;font-size:13px;margin-left:5px;margin-bottom:-1px;margin-right:10px;box-shadow:1px 1px 2px #77777733;line-height:19px;color:#2f2f2fc4; width: 60%; text-align:center">

			
				<h1 style="font-weight: 600;font-size:37px;font-family: 'Indie Flower';color:red;padding-top:4px;">Rp 70.000</h1>
			
			</div>

			<h5 id=time_remaining_phone style=margin-top:17px;margin-bottom:-15px>Time Remaining:<br>
				<div style="margin-top:6px;font-size:18px;font-family:arial;color:maroon;">	
					<span id=hours_phone>17</span>h:<span id=minutes_phone>45</span>m:<span id=seconds_phone>19</span>s
				</div>
				<br>
			</h5>
			</center>
			<!-- Only Mobile Ends -->



			<!-- Left Action Buttons  -->

			<div id=left_buttons class="ui two column grid center" style=text-align:center;margin-top:22px;margin-left:-17px;margin-right:-5px;>

				<div id=place_left class="sixteen wide computer nine wide tablet nine wide mobile column " style=margin-bottom:-10px;>

					<!-- button slide actions -->

					<button id=submitBid class="ui big teal button" style="font-family: 'noto sans';visibility:visible;"><i style=margin-top:-4px; class="big edit icon"></i><span id=place_text></span>
					</button>



					</div>			

				
				<div id=watch_left class="sixteen wide computer six wide tablet six wide mobile column" style=>
					
					<button id=watchBtn class="ui big button" style="font-family: 'noto sans';">
					<img width=28px src=images/paw3.png style=position:absolute;margin-top:-4px;opacity:0.45;vertical-align:bottom> <div id=watch_text style=display:inline-block;> <!-- Tinggalin Jejak --></div>
					</button>

						<div id=jejak_count_text style=position:absolute;float:right;right:14%;margin-top:1px;opacity:0.8><span style=font-size:11px>&nbsp;
							 3 orang ninggalin jejak.</span>
						</div>

				</div>
				
			<!-- End of Left Action Buttons -->







		</div>
		<br>
	</div>


			<!-- Item-info Card -->
			<div id=item_side class="eight wide computer sixteen wide mobile column center" style=margin-top:5px;>
	

<a class="ui button white" href="watchlist.html" data-slidepanel="panel">Show Watched Item</a>


	<!-- Countdown -->

	<div class="ui red segment">

		 <div class="ui right floated big red button" id=nextBtnOuter style=margin-right:-8px>

				<button id=nextBid onclick='' class="ui big red button" style="font-family: 'noto sans';margin-top:-14px;width:100%;height:40px">
					
					<center>
					<div style=display:inline-block>
						<i class="large arrow external icon"></i>
						<span id=qbid_text></span>
					</div>
					</center>		
				<!-- 
				<div style=display:inline-block; class=button_text id=qbid_text>
					
				</div>
				-->
				</button>
	
		</div>	

		
		<h5 id=time_remaining style=margin-top:0px>Time Remaining:<br>
		<div style="margin-top:2px;font-size:18px;font-family:arial;color:maroon;">	
					<span id=hours>17</span>h:<span id=minutes>45</span>m:<span id=seconds>19</span>s
					</div>
		<br>
		</h5>

		<h5 id=next_bid_phone style=margin-top:7px;margin-left:4px;margin-bottom:3px;>Next Bid: <br>
		<div style="margin-top:6px;font-size:18px;font-family:arial;color:maroon;">	
			Rp 75.000
		</div>
		<br>
		</h5>
	</div>
	<!-- Lower Card -->

			<div class="ui vertical menu" style=width:100%;margin-top:-21px>
					<div class="ui left aligned container" >

<div id=bid_details class="ui horizontal segments" style=font-size:12px;margin-top:0px;background:#f3f8ea; > <!-- #f6ffe4 -->
  <div class="ui segment" style=width:53%>

	<p class=bids_table>Current Bid:</p>
			
			<div id=last_bid style=height:20px;line-height:27px;color:red;margin-left:12px;letter-spacing:0.2pt;margin-top:-3px;font-size:31px>
				<h3 class=last_bid style=color:red;font-weight:bold><strong> Rp. 90.000</strong></h3>
			</div>

			<h5 style=display:inline-block;margin-left:12px;margin-bottom:6px class=bidder_info>
				by: &nbsp;<img class="ui avatar image" src=images/beni.jpg> <div style="margin-left:-3px;display:inline-block;padding:2px 4px 2px 2px; background-color:rgba(255,185,45,0.25);border:1px;border-radius:7px;cursor:pointer;font-size:11px;font-wbold;letter-spacing:0.3pt;color:orange;"><i><u>Pastelshonen</u></i> </div>
</h5>
<br>
  </div>  
  <div class="ui segment"  style=background:#f8f8fc;width:30%>
    <p class=bids_table>Kelipatan:</p>
	<h3 style=margin-top:-3px;font-size:23px;color:#777>Rp 5.000</h3>
  </div>
  <div class="ui segment" style=width:25%>
    <p class=bids_table>Number <br>of Bids:</p>
	<h3 style=margin-top:-4px;color:red;font-size:20px>0</h3>
  </div>

</div>
	




<div id=bid_details_small class="ui horizontal segments" style=font-size:12px;margin-top:0px>
  
  <div class="ui segment" style=width:20%>
    <p class=bids_table># Bids: </p>
	<h3 style=margin-top:-10px>0</h3>
  </div>
  <div class="ui segment">
    <p class=bids_table>Kelipatan:</p>
	<h3 style=margin-top:-10px>Rp 5.000</h3>
  </div>
  <div class="ui segment" style=background:#f8f8fc>

	<p class=bids_table>Highest Bidder:</p>
			
			<h5 style=margin-left:7%;margin-top:2px class=bidder_info>
				<img class="ui avatar image" style=width:34px;height:34px src=images/beni.jpg> <div style="margin-left:-3px;display:inline-block;padding:2px 4px 2px 2px; background-color:rgba(255,185,45,0.25);border:1px;border-radius:7px;cursor:pointer;font-size:12px;font-wbold;letter-spacing:0.3pt;color:orange;"><i><u>Pastelshonen</u></i> </div>
<br><br>
  </div>
</div>


	<button id=historyBid onclick=historyBid() class="ui big yellow button" style="background-color:#fa8e00;margin-top:-3px;padding-top:14px;width:100%;height:52px;opacity:0.81">

		<div style=display:inline-block;padding-top:3px;>
			<i style=margin-top:-4px; class="large document icon"></i>
		</div>
		<div style=line-height:85%;display:inline-block;vertical-align:middle;color:#fbfbfb class=button_text>
			Lihat Bid History
		</div>
	</button>



		<!-- 
		 <h3 stwyle="display:inline-block;margin-left:-3px;margin-bottom:5px;margin-right:-7px;font-size:18px;font-family:arial;color:maroon;text-shadow:1px 1px 1px rgba(77,77,77,0.4)"> 
								<span id=hours></span>h:<span id=minutes></span>m:<span id=seconds></span>s
								 &nbsp;
		</h3>
		 -->
					</div>

					
					<div class="item" style=background:#fafafb;padding-left:17px;padding-right:20px>


							<div class="ui right aligned" style=height:100px;float:right;position:absolute;right:0px;>


<br><br>


<center>
</center>
	

							</div>




<div class="sixteen wide computer sixteen wide tablet sixteen wide mobile column" style=margin-left:0px;margin-top:-23px;margin-bottom:-5px>


<div id=item_tabs style=margin-left:2px>

	<h4 style=font-size:16px;color:#004400;margin-top:45px;margin-bottom:-1px;margin-left:1px> <u>Listing Details:</u></h4>


		<div id=stats_beside style="width:270px;padding:0 3px 5px 10px;background-color:#fce787cc;border:double 2px #999;font-size:13px;margin-left:6px;margin-bottom:-8px;margin-right:10px;box-shadow:0 2px 1px #55555566;line-height:19px;color:#2f2f2fc4">
			<div id=view_count_side style=position:relative;width:54%;display:inline-block;margin-left:2px>
				<table >
					<tr><td >
						<img style=margin-top:9px width=28 src=images/truck.png> 
					</td>
					<td style=padding-top:11px;padding-left:10px;text-align:left;line-height:20px;>
						<b style=color:#2f2f2f>Shipped from:</b><br>Jakarta
					</td></tr>
				</table>
				<div > </div>
			</div>										


			<div style="position:absolute;display:inline-block;margin-top:3px;height:55px;border:outset rgba(180,180,180,0.3) 1px;width:1px"></div>

			<div id=jejak_count_beside style="display:inline-block;width:36%;inline-block;margin-top:0px;margin-left:13px">
				<table>
					<tr><td >
						<img style=opacity:0.5;margin-top:10px width=27 src=images/rp.png> 
					</td>
					<td style=padding-top:11px;padding-left:6px;text-align:left;line-height:20px>
						<b style=color:#3f3f3f>Ongkir:</b><br>9.000
					</td></tr>
				</table>

				
			</div>
		</div>



	</div>
</div>
<!-- 				

		<div id=item_tabs >				
						<div class=tab_container style=position:absolute;z-index:100;>
							<div style="display:inline-block;width:115px;font-size:14px;margin-left:0px;margin-bottom:-13px;padding:3px 4px 4px 6px; background-color:rgba(200,22,33,1);border:4p black solid;border-radius:2px 12px 0px 0px;color:white;"><b>&nbsp;&nbsp;Listing Info</div></b>
						</div>
				
						<div class=tab_container style=position:absolute;z-index:80>
							<div style="display:inline-block;width:65px;font-size:14px;margin-left:113px;margin-bottom:-13px;padding: 3px 4px 4px 5px; background-color:#aa44aa;border:1px ;border-radius:0px 3px 0px 0px;color:white"><b>&nbsp;&nbsp;Chat</div></b>
						</div>
					
				</div> -->

<br>
<hr style=opacity:0.2;margin-top:23px;margin-left:6px;>

							<table style="margin-top:-2px;margin-left:5px" class="ui definition table">
							  <tbody>
								<tr>
								  <td>
									<h4 class="ui image header">
									  <div class="content">
	Start Bid
										<div class="sub header">
									  </div>
									</div>
								  </h4></td>
								  <td class=item_info>
									Rp 200000
								  </td>
								</tr>

								<tr>
								  <td>
									<h4 class="ui image header">
									  <div class="content">
Condition
										<div class="sub header">
									  </div>
									</div>
								  </h4></td>
								  <td class=item_info>
									MIB 
										<div style=cursor:pointer;position:absolute;margin-top:0px;margin-left:3px;font-size:10.5px;color:#999;display:inline-block;color:blue>
											<b>(<u>?</u>)</b>
										</div>
								  </td>
								</tr>

								<tr>
								  <td>
									<h4 class="ui image header">
									  <div class="content">
Detail barang
										<div class="sub header">
									  </div>
									</div>
								  </h4></td>
								  <td class=item_info>
									Open for Check doang... Belum pernah display
								  </td>
								</tr>

								<tr>
								  <td>
									<h4 class="ui image header">
									  <div class="content">
Posted on
										<div class="sub header">
									  </div>
									</div>
								  </h4></td>
								  <td >
									Senin, 24 Mei 2017 22:30 WIB
								  </td>
								</tr>


								<tr>
								  <td>
									<h4 class="ui image header">
									  <div class="content">
Ends
										<div class="sub header">
									  </div>
									</div>
								  </h4></td>
								  <td style=color:red>
									<b >Selasa, 25 Mei 2017 22:30 WIB</b> 
								  </td>
								</tr>



							  </tbody>
							</table>
								
	<div id=detail_item style=margin-top:35px;display:none;margin-bottom:15px>
		<p style=font-size:12.5px;font-family:lucida;margin-left:7px><span style=color:#222;font-family:verdana;opacity:0.9><u><b>Item URL</b></u> : </span> </b>
		<input type=text disabled style=margin-left:3px;width:142px;color:#555;font-size:13.5px;padding-left:2px value="http://lelang.in/87asjd8"></input> <i style=opacity:0.8;margin-top:-2px class="ui large flipped unlink icon "></i>
		</p>



	<div id=tags style=text-align:left;margin-top:24px;margin-bottom:0px;margin-left:3px>
	<b> <span style=color:maroon>&nbsp;<u>Tags</u>:</span></b>
	
	<!-- <hr style=align:left;margin-left:2%;margin-top:0px;margin-bottom:7px;opacity:0.14;width:92%;>
	 -->
	<div style=margin-top:3px;>
		<a class="ui green tag label">figure</a> <a class="ui green tag label">nendoroid</a> <a class="ui green tag label">anime</a> <a class="ui green tag label">haikyuu</a> <a class="ui green tag label">hinata</a> 
	</div>
	</div>


</div>



</div>
				


				<div onclick=expand_details() style="cursor:pointer;margin:0px 3px 5px 13px;font-size:12px;opacity:0.55;margin-top:8px" class='link center aligned'>

<center>
					<a id=expand_link style=color:#111;opacity:0.8;font-weight:bold ><u>Show more</u> <i class="tiny chevron down icon"></i></a>

</center>
				</div>

 </div>				

			<div id=right_buttons class="ui two column grid center" style=text-align:center;margin-top:-2px>


<!-- SLIDER for price range... -->
		<div style=width:96%;margin-left:14px;margin-top:-15px;position:relative>
			<div id=price_slide style=display:none;margin-bottom:43px> </div>
				
		</div>
		
		<!-- SLIDER ends .. -->



			<div id=social_sharing class="ui " style=margin-top:20px>
			<!-- 	<h5>Link:</h5>
				<input type=text disabled value="http://lelang.in/87asjd8"></input> <i class="ui small unlink icon "></i>
				 -->
				<h5 style=margin-bottom:5px>Share on:</h5>
				<div style=display:inline-block><i class="ui icon big facebook square gray"></i></div>
				<div style=display:inline-block> <i class="ui icon big twitter square gray"></i></div>
				<div style=display:inline-block> <i class="ui icon big google plus square gray"></i></div>
<!-- 				<div style=display:inline-block> <i class="ui icon big pinterest square gray"></i></div> -->
				<br><br>
			</div>



			<div id=right_bottom style="margin-top:6x;right:1px;margin-bottom:0px;opacity:0.75;line-height:200%">

					<div id=stats_below style=margin-top:-24px>

<center>						

<br>

						<div id=jejak_count style=display:none;position:absolute;float:left;margin-left:-4px;margin-top:1px><span style=font-size:13px>&nbsp; </span>
							<img width=20 style=margin-top:3px;margin-right:-30px;vertical-align:top;opacity:0.34 src=images/paw3.png> 3<span class=stats_text>&nbsp;orang ninggalin jejak </span>
						</div>

						
					</div>
				</div>




				<!-- Right Action Buttons  -->
				<div id=place_right class="sixteen wide computer ten wide tablet ten wide mobile column " style=margin-top:30px;z-index:9999;margin-bottom:-11px;display:none>

					<!-- button slide actions -->

					<button id=submitBid class="ui big orange button" style=visibility:visible><i style=margin-top:-4px;z-index:9 class="big edit icon"></i><span id=place_text>Place Bid 
					<div style=margin-top:2px;margin-left:24px;margin-bottom:-38pxpx;color:#606060;font-size:10px>(hold to change)</div></span></button>
					
					<br>
<!-- 					
					<div style=margin-top:3px>
						<a href=# style=color:brown;font-family:verdana;font-size:12px;><u>Request BIN</u></a>
					</div>
-->					
					</div>			
					

				<div class="sixteen wide computer six wide tablet six wide mobile column" style=>

				<div id=watch_right class="sixteen wide computer six wide tablet six wide mobile column" style=display:none>
					<button id=watchBtn class="ui big teal button" style=padding-left:20px>
					<img width=28px src=images/paw3.png style=position:absolute;margin-top:-4px;opacity:0.45;vertical-align:bottom><div id=watch_text style=display:inline-block;> <!-- Tinggalin Jejak --></div></button>

				</div>				

				</div>

				
			<!-- End of Right Action Buttons -->
			
			<style>
				.square.gray {
					opacity :0.7;
				}
			</style>


	

		</div>




<br>


<!-- 
				<div class="ui icon message ">
				  <i class="dollar red icon"></i>
				  <div class="content">

					<div style="font-size:19px;color: #6cfc00;text-shadow:2px 1px 1px #777;font-family:verdana;margin-left:-50px;margin-top:-2px;margin-bottom:-1px;letter-spacing:0.4pt"><u>Highest Bid</u>:</div>
						<div id=last_bid style=font-size:21px;margin-left:-2px>
							<h3 class=last_bid style=color:red><strong> Rp. 90.000</strong></h3>

						</div>
					<h5 style=margin-top:9px class=bidder_info>
						by: &nbsp;<img class="ui avatar image" src=images/beni.jpg> <span style=cursor:pointer;font-size:12px;font-weight:normal;color:orange><i><u>kutukupret-2016</u></i> </span>
					<br><div style=font-weight:normal;margin-top:2px;color:#777;font-family:verdana;font-size:10px><i>(5 hours ago)</i></div></h5>

					<p>Get the best news in your e-mail every day.</p>
				  </div>
				</div>
-->

				<!-- Time left -->

			<div class="six wide computer four wide mobile column">
			<!-- 
				<div class="ui piled segment">
			
				<h3>Related Items</h3>
				<hr>
				
				<div class="ui mini images" style=margin-bottom:-20px>
					<img src=images/4.jpg>
					<img src=images/3.jpg>
				</div>
			 -->

			<!-- ACTION BUTTONS PC -->
<!-- 
			<div class="tablet computer only ui column grid" id=PC_buttons>
				<div class="ui teal buttons">
				<div class="ui button nextBid" id=bidBtn onclick=nextBid()></div>
				<div class="ui combo top right pointing dropdown icon button">
					<i class="dropdown icon"></i>
					<div class="menu">
					<div class="item" ><i class="checkmark icon"></i> Rp.<span id=nextbid>70.000</span></div>
					 <div class="item"><i class="add circle icon"></i> Enter	Nominal..</div>
				</div>
	  			</div>
				</div>
		
				<button id=mweh class="ui red button">History</button>
				<button class="ui pink button"><i class="white flipped horizontally big icon wechat"></i></button>

				<div class="ui horizontal button open button" data-transition="slide along" data-direction="right" onclick="$('.right.demo.sidebar').sidebar('toggle');">
					Slide Along
				  </div>
				<button class="ui orange button" > Watch</button>
				<button class="ui yellow button">Chat</button>
				<button class="ui pink button" id="push_button">Push</button>
					</div>

			<br><br>
			</div>
			</div>
 -->			
		<!-- END OF ACTION BUTTONS -->
	
		</div>
		</div>


		<div class="sixteen wide mobile only centered column">
		<br>
		<center>
					<!-- ACTION BUTTONS PC -->
<!-- 
				<div class="ui teal buttons">
				<div class="ui button nextBid" id=bidBtn onclick=nextBid()></div>
				<div class="ui combo top right pointing dropdown icon button">
					<i class="dropdown icon"></i>
					<div class="menu">
					<div class="item" ><i class="checkmark icon"></i> Rp.<span id=nextbid>70.000</span></div>
					 <div class="item"><i class="add circle icon"></i> Enter	Nominal..</div>
				</div>
	  			</div>
				</div> <br><br>
		
				<button id=mweh class="ui red button">History</button>
				<button class="ui pink button"><i class="white flipped horizontally big icon wechat"></i></button>
 -->
				<!-- <div class="ui horizontal button open button" data-transition="slide along" data-direction="right" onclick="$('.right.demo.sidebar').sidebar('toggle');">
					Slide Along
				  </div>
				<button class="ui orange button" > Watch</button>
				<button class="ui yellow button">Chat</button>
				<button class="ui pink button" id="push_button">Push</button>
					</div>  -->
				

		<!-- END OF ACTION BUTTONS -->

		</div>

<!-- 
		<div class="four wide computer sixteen wide mobile column">

			<div class="ui card" style=width:94%>
				Seller info
				<div style=width:200px;background-color:violet;height:300px>
				</div>
			</div>

		</div>
 -->

		</div>	
		</div>

<!-- 
<div class="ui stackable four column grid">
  <div class="column">1</div>
  <div class="column">2</div>
  <div class="column">3</div>
  <div class="column">4</div>
</div>
 -->	
	</div>
<!-- END OF PUSHER -->

</div>

<!-- END OF CONTAINER -->

    <script type="text/javascript" src="dist/semantic.min.js"></script>

    <script type="text/javascript" src="dist/components/dropdown.min.js"></script>

	<script src="libs/nouislider/nouislider.js"></script>

	<script src="libs/jquery-taphold-master/taphold.js"></script>

 	<!-- <script src="js/jquery.mobile.min.js"></script> -->



    <script type="text/javascript">
		$('.combo.dropdown').dropdown({
			action: 'combo'
		});

$(document).ready(function(){
    makeButtonIncrement(document.getElementById('submitBid'), "add", document.getElementById('last_bid'), 500, 0.7);
	/*
	$("#submitBid").on('taphold'), function() {
		alert('1');
	});
	*/
});



	// VARIABLE TO DETECT IF MOUSE HAS RELEASED
	hands_up = 1;


function makeButtonIncrement(button, action, target, initialDelay, multiplier){
	
	timerIsRunning = false
    var holdTimer, changeValue,  delay = initialDelay;
	var slider = document.getElementById('price_slide');
    
	changeValue = function(){
	
		current_val = target.innerHTML 
		clean_val = current_val.replace("Rp. ", "")

		if(timerIsRunning) {
			if(action == "add" )//&& clean_val < 1000)
			{
				clean_val =  parseInt(clean_val) + 5000;
				target.innerHTML = "Rp. " + clean_val
				slider.noUiSlider.set(clean_val);
				console.log("Rp. " + clean_val + '-' + hands_up)
			}
			else if(action == "subtract" && clean_val > 0)
			{
				clean_val--;
				target.innerHTML = "Rp. " + clean_val
			}
		}

        holdTimer = setTimeout(changeValue, delay);
        
		if(delay > 20) delay = delay * multiplier;
        if(!timerIsRunning){
            // When the function is first called, it puts an onmouseup handler on the whole document 
            // that stops the process when the mouse is released. This is important if the user moves
            // the cursor off of the button.
            document.onmouseup = function(){
				
                clearTimeout(holdTimer);
                document.onmouseup = null;
                timerIsRunning = false;
                delay = initialDelay;
				
				console.log(hands_up);

				//$('#submitBid').prop('onclick',null).off('click');
				setTimeout(function() {
					clear_to_submit()
				},500)

            }
            timerIsRunning = true;
        }
		else
		{
			$("#price_slide").slideDown();

			//$("#nextBid").slideUp();
			
			$("#submitBid").removeClass('orange').addClass('orange')
			$("#submitBid").html('<i style=margin-top:-4px;z-index:999 class="map big icon"></i>Raising...');

			hands_up = 0;
		}

    }
    button.onmousedown = changeValue;
}


	$("#submitBid").on('click', function() {
		// check if Mouse / tap has been released for quite a while
		if (hands_up && $(this).hasClass('green')) {
			console.log('sending new bid')
			$("#price_slide").fadeOut(200);			

			setTimeout(function(){
				//$("#nextBid").slideDown(100);
				$("#submitBid").html('<i style=margin-top:-4px;z-index:999 class="big edit icon"></i><span id=place_text>Place Bid</span>').removeClass('green').addClass('orange');
				
			}, 1500);

			nextBid()
		}
		else
			console.log(hands_up + '--' + $(this).hasClass('green'))
	});

	function clear_to_submit() {
		
		if ($("#submitBid").html().indexOf('Raising') > -1)
		{
			hands_up = 1;
			console.log('ready to submit - ' + hands_up)
			
			$("#submitBid").removeClass('orange').addClass('green')
			$("#submitBid").html('<i style=margin-top:-4px;z-index:999 class="check square big icon"></i><u>OK. Bid it!</u>');
		}
	}

	function expand_details(){

		if ($("#detail_item").is(':visible')){
			
			$("#detail_item").slideUp();
			$("#expand_link").html('<u>Show more</u> <i class="tiny chevron down icon"></i></i>')


			// move the Jejak button 			
			/*
			if ($(window).width() > 980) {
				$("#watch_right").fadeIn(400)
				$("#watch_left").fadeOut(200)

				//$("#right_bottom").css('margin-top',parseInt($("#right_bottom").css('margin-top')) - 110 + 'px');

				setTimeout(function() {
					//$("#tags").slideUp(100);
				}, 200)
			}
			*/
		}
		else {		
			
			$("#detail_item").slideDown();
			$("#expand_link").html('<u>Show less</u> <i class="tiny chevron up icon"></i>').css('color','#444')

			/*
			if ($(window).width() > 980) {
				$("#watch_right").fadeOut(200)
				$("#watch_left").fadeIn(400)
				
				//$("#tags").slideDown(500)
			}
			*/
		}
	}

	// PRICE SLIDER 
	// =============

	var stepSlider = document.getElementById('price_slide');
	var step = 5000;

	noUiSlider.create(stepSlider, {
		start: [ 6100000 ],
		step: step,
		range: {
			'min': [  6100000 ],
			'max': [ 7550000 ]
		},
		pips: {
			mode: 'count',
			values: 5,
			density: 4
		}
	});

	stepSlider.noUiSlider.on('update', function( values, handle ) {
		//console.log ( parseInt(values[0]) );
		$(".last_bid").html("Rp. " + parseInt(values[0]) );
	});

	</script>

<script>
function hide_tips() {
	$('.oxen_tips').fadeOut(400);
	$('.zebra_countdown').fadeOut(300);
}

function add_bid() {

}

$(document).ready(function() {
    $('#nextBid').on('click', function(e) {
        e.preventDefault();
        $.Zebra_Dialog('<h3 style=margin-top:-20px>Anda akan mengajukan bid:</h3><h1 class="ui teal" style=font-size:34px;color:red;margin-top:3px>Rp <span id=next_bid_nominal>' + localStorage.nextBid + '</span></h1> <div class=oxen_tips><h5>Oxen Tips:</u></h5> <p class=quickbid_text><strong>Pastikan dana Anda mencukupi</strong>, jangan terbawa napsu gan - Blacklist resikonya!</p>' +
		'<input onclick=hide_tips() type=checkbox name=check_quick id=check_quick /><label for=check_quick> Jangan munculkan pesan ini lagi</label></div><div class=zebra_countdown>Pesan ini akan otomatis tertutup dalam 5 detik...</div>', {
            'type':     'warning',
            'title':    'Quick Bid',
			'buttons':  [
				{caption: 'Yes, Bid It!',
				 callback: nextBid
				},
				'Whoops, ga jadi gan'],
			'animation_speed_show':	100,
			'width':	Math.floor($(window).width()*87/100)
        });
    });
});

</script>


	<!--SLIDEPANEL plugin-->
	<script type="text/javascript" src="js/jquery.slidepanel.js"></script>
	<!--Add the css -->
	<link rel="stylesheet" type="text/css" href="css/jquery.slidepanel.css">

	<script>
	      $(document).ready(function(){
          $('[data-slidepanel]').slidepanel({
              orientation: 'right',
              mode: 'push'
          });
      });
	</script>



	</div>
</body>
 
</html>