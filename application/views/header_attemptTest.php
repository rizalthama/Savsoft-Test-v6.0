<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Online Test/Exam</title>
<link rel="stylesheet" href="<?php echo base_url('/javascript/style.css'); ?>" type="text/css">
<script type="text/javascript" src="<?php echo base_url('/javascript/javascript.js'); ?>" ></script>
<script language="javascript">





var c = null
var time = null;
function startTime() {
//if(getCookie('timeLeft')){
//document.getElementById('timer').innerHTML=getCookie('timeLeft');
//}

	timerDisplay = document.getElementById('timer');

if((timerDisplay.innerHTML)=="0.00"){

time=getCookie('timeLeft').replace(':','.');

time = parseFloat(time);

}
else
{
	time = parseFloat(timerDisplay.innerHTML.replace(':','.'));

}



timerDisplay.innerHTML = time.toFixed(2).replace('.', ':');

	var c=setInterval(countdown, 1000);

}
function countdown() {
	if(time > 0.01) {
		time -= 0.01;
		if(time%1 > 0.59) time = Math.floor(time) + 0.59;
		timerDisplay.innerHTML = time.toFixed(2).replace('.', ':');
setCookie('timeLeft',time.toFixed(2).replace('.', ':'),'1');
	} else 
{
clearInterval(c);
timerDisplay.innerHTML = "0:00";
alert("Time Over!\n Press Ok to Submit");
document.getElementById('submitTest').value='1';
document.getElementById('testForm').submit(); 
return;
}

}
</script>
<style>
#qoption{
		background-color:#ffffff;
		font: 15px/20px normal Helvetica, Arial, sans-serif;
		color: #222222;
		margin: 5px 0px 5px 0px;
	}
#qoption:hover{
		background-color:#eeeeee;
		font: 15px/20px normal Helvetica, Arial, sans-serif;
		color: #222222;
		margin: 5px 0px 5px 0px;
		}
#timers{
  position: fixed;
  right: 0;
  top: 10%;
  width: 200px;
  margin-top: -2.5em;
}
</style>
</head>
</head>
<body onLoad="startTime();">
<?php 
// getting minutes
$minutes=intval((($test['test_time']*60)-(time()-$result['iniTime']))/60);
//getting seconds
$seconds=intval((($test['test_time']*60)-(time()-$result['iniTime']))%60);
?>
<div id='timers'>
<table><tr><td>Time Left</td><td><div id="timer">
<?php echo $minutes.":".$seconds;?>
</div>
</td><td>Minutes</td></tr></table>
</div>



