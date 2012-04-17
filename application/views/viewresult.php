
<?php

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



<div id="container">
	<h1>Result #<?=$result['result_id']?> 
	<div style="float:right" >
	<?php echo anchor('result/',img('images/back.gif'));?> &nbsp;
	<a href="javascript:print();"><?php echo img('images/print.png');?></a>
	</div>
	</h1>

	<div id="body">

	<?php
	if(isset($msg)){
	echo $msg;
	}
	?>
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
	if($this->config->item('view_answer')=="yes"){
echo anchor('answer/index/'.$result['result_id'],'View answers');
}
?>
&nbsp; | &nbsp;
<?php
if($this->config->item('email_result')=="yes"){
echo anchor('result/view/'.$result['result_id'].'/email','Send to email');
}
?>
	
	
	
	
	

