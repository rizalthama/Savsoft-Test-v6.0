
<?php


// Function to change seconds into standard time (H:M:S)

  function sec2hms ($sec, $padHours = false) 
  {

    // start with a blank string
    $hms = "";
    
    // do the hours first: there are 3600 seconds in an hour, so if we divide
    // the total number of seconds by 3600 and throw away the remainder, we're
    // left with the number of hours in those seconds
    $hours = intval(intval($sec) / 3600); 

    // add hours to $hms (with a leading 0 if asked for)
    $hms .= ($padHours) 
          ? str_pad($hours, 2, "0", STR_PAD_LEFT). ":"
          : $hours. ":";
    
    // dividing the total seconds by 60 will give us the number of minutes
    // in total, but we're interested in *minutes past the hour* and to get
    // this, we have to divide by 60 again and then use the remainder
    $minutes = intval(($sec / 60) % 60); 

    // add minutes to $hms (with a leading 0 if needed)
    $hms .= str_pad($minutes, 2, "0", STR_PAD_LEFT). ":";

    // seconds past the minute are found by dividing the total number of seconds
    // by 60 and using the remainder
    $seconds = intval($sec % 60); 

    // add seconds to $hms (with a leading 0 if needed)
    $hms .= str_pad($seconds, 2, "0", STR_PAD_LEFT);

    // done!
    return $hms;
    
  }



?>
<style>
<!--
CSS to change background color of questions on mouseover
-->

#question{
		background-color:#ffffff;
		font: 15px/20px normal Helvetica, Arial, sans-serif;
		color: #222222;
		margin: 5px 0px 5px 0px;
	}
#question:hover{
		background-color:#eeeeee;
		font: 15px/20px normal Helvetica, Arial, sans-serif;
		color: #222222;
		margin: 5px 0px 5px 0px;
		}

</style>


<div id="container">
	<h1>Result #<?=$result['result_id']?> 
	<div style="float:right" >
	<?php echo anchor('result/',img('images/back.gif'));?> &nbsp;
	<a href="javascript:print();"><?php echo img('images/print.png');?></a>
	</div>
	</h1>

	<div id="body">

	
	<code>
	<table bgcolor="#ffffff">
	<?php if(($this->session->userdata('su'))=='1'){ ?>
	<tr ><td bgcolor="#eeeeee" width="350px">Full Name</td><td bgcolor="#eeeeee" ><?=$result['first_name']?> <?=$result['last_name']?></td></tr>
	<tr ><td bgcolor="#ffffff" >User ID</td><td bgcolor="#ffffff" ><? echo anchor('member/view/'.$result['uid'],$result['uid']);?></td></tr>
	<?php
	}
	?>
	<tr ><td bgcolor="#eeeeee" width="350px">Test Name</td><td bgcolor="#eeeeee" ><?=$result['test_name']?></td></tr>
	<tr><td bgcolor="#ffffff">Correct Answers / Total Questions</td><td bgcolor="#ffffff">
	<?php $correct=str_replace("2","0",$result['correct_answer']); $correct=explode(",",$correct); echo array_sum($correct); ?> / <?=$result['total_question']?>
	</td></tr>
	<tr><td bgcolor="#eeeeee" >Obtained Percentage </td><td bgcolor="#eeeeee"><?=$result['obtained_percentage']?> % </td></tr>
	<tr><td bgcolor="#ffffff">Time Taken / Time Duration (H:M:S)</td><td bgcolor="#ffffff">
	<?php $time_taken=explode(",",$result['time_taken']); echo sec2hms(array_sum($time_taken)); ?> / <?php echo sec2hms(($result['test_time'])*60);?>
	</td></tr>
	<tr><td bgcolor="#eeeeee">Status</td><td bgcolor="#eeeeee"><?php if($result['status']=="1"){ echo "Pass";} else{ echo "Fail";} ?></td></tr>
	</table>
	</code>
	
		 
	
	<?php
	$qno=1;
	$selected_answers=explode(",",$result['selected_answers']);
	$correct_answers=explode(",",$result['correct_answer']);
	
	foreach($questions as $question){
	$selected_answer=$selected_answers[$qno-1];
	?>
	<table width="100%"><tr id="question"><td valign=top width="80%">
	<table><tr><td valign="top" >Q<?=$qno?>) &nbsp;</td><td><?=$question['question']?></td></tr></table>
	<?php $option=explode(',',$question['options']); 
	foreach($option as $option){ 
	
	?>
	<table><tr><td style="width:18px;" valign=top ><input type="radio" value="<?=$option?>" name="answer<?php echo $qno;?>" <?php if($selected_answer==$option){ echo "checked";} ?>     >  </td><td><?=$option?></td></tr></table>
	<?php
	}
	
	?>
	</td>
	<td valign=top >
	<?php
	
	if(($correct_answers[$qno-1])=="1"){
	$atr=array('title'=>'Correct');
	echo img('images/tick.png',$atr);
	}
	if(($correct_answers[$qno-1])=="0"){
	echo img('images/delete.png',$atr);
	}
	if(($correct_answers[$qno-1])=="2"){
	?>
	UnAttempted
	<?php	
	}
	?>
	</td></tr></table>
	<br/><br/>
<?php
$qno+=1;
	}
?>
	
	
	
	
	

