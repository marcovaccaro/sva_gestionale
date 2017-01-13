<?php	
echo'
	<style>
	#floatingCirclesG{
	position:relative;
	width:30px;
	height:30px;
	-webkit-transform:scale(0.6);
	-moz-transform:scale(0.6)}
	
	.f_circleG{
	position:absolute;
	background-color:#FFFFFF;
	height:5px;
	width:5px;
	-moz-border-radius:3px;
	-webkit-border-radius:3px;
	-webkit-animation-name:f_fadeG;
	-webkit-animation-duration:1.04s;
	-webkit-animation-iteration-count:infinite;
	-webkit-animation-direction:linear;
	-moz-animation-name:f_fadeG;
	-moz-animation-duration:1.04s;
	-moz-animation-iteration-count:infinite;
	-moz-animation-direction:linear}
	
	#frotateG_01{
	left:0;
	top:12px;
	-webkit-animation-delay:0.39s;
	-moz-animation-delay:0.39s}
	
	#frotateG_02{
	left:4px;
	top:4px;
	-webkit-animation-delay:0.52s;
	-moz-animation-delay:0.52s}
	
	#frotateG_03{
	left:12px;
	top:0;
	-webkit-animation-delay:0.65s;
	-moz-animation-delay:0.65s}
	
	#frotateG_04{
	right:4px;
	top:4px;
	-webkit-animation-delay:0.78s;
	-moz-animation-delay:0.78s}
	
	#frotateG_05{
	right:0;
	top:12px;
	-webkit-animation-delay:0.9099999999999999s;
	-moz-animation-delay:0.9099999999999999s}
	
	#frotateG_06{
	right:4px;
	bottom:4px;
	-webkit-animation-delay:1.04s;
	-moz-animation-delay:1.04s}
	
	#frotateG_07{
	left:12px;
	bottom:0;
	-webkit-animation-delay:1.1700000000000002s;
	-moz-animation-delay:1.1700000000000002s}
	
	#frotateG_08{
	left:4px;
	bottom:4px;
	-webkit-animation-delay:1.3s;
	-moz-animation-delay:1.3s}
	
	@-webkit-keyframes f_fadeG{
	0%{
	background-color:#000000}
	
	100%{
	background-color:#FFFFFF}
	
	}
	
	@-moz-keyframes f_fadeG{
	0%{
	background-color:#000000}
	
	100%{
	background-color:#FFFFFF}
	
	}
	
	</style>
	<div id="floatingCirclesG">
	<div class="f_circleG" id="frotateG_01">
	</div>
	<div class="f_circleG" id="frotateG_02">
	</div>
	<div class="f_circleG" id="frotateG_03">
	</div>
	<div class="f_circleG" id="frotateG_04">
	</div>
	<div class="f_circleG" id="frotateG_05">
	</div>
	<div class="f_circleG" id="frotateG_06">
	</div>
	<div class="f_circleG" id="frotateG_07">
	</div>
	<div class="f_circleG" id="frotateG_08">
	</div></div>
	';
?>