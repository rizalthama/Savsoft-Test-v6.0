

<div id="container">
	<h1><?=$test['test_name']?> 
	<div style="float:right" >
	<?php echo anchor('test/',img('images/back.gif'));?> &nbsp;
	<?php if(($this->session->userdata('su'))=='1'){  echo anchor('test/edit/'.$test['tid'],img('images/edit.png')); }?>  &nbsp;
	<a href="javascript:print();"><?php echo img('images/print.png');?></a>
	</div>
	</h1>

	<div id="body">

	
	<code>
	
	<table>
	<tr><td valign=top >Test Name</td><td width="20px"></td><td><?=$test['test_name']?></td></tr>
	<tr><td valign=top >Description</td><td width="20px"></td><td><?=$test['description']?></td></tr>
	<tr><td>No. of Questions</td><td width="20px"></td><td><?php $nofquestion=explode(",",$test['random_question_no']); 
	$nofquestions=0;
	foreach($nofquestion as $nofquestion){ $nofquestions+=$nofquestion; }
	echo $nofquestions;?></td></tr>
	<tr><td>Time Duration</td><td width="20px"></td><td><?=$test['test_time']?> Minutes </td></tr>
	<tr><td>Start Time</td><td width="20px"></td><td><?php echo date('d-M-Y h:i A',$test['start_time']);?></td></tr>
	<tr><td>End Time</td><td width="20px"></td><td><?php echo date('d-M-Y h:i A',$test['end_time']);?></td></tr>
	<tr><td>Test Type</td><td width="20px"></td><td><?php if($test['type']=="1"){ echo "Paid ( Amount: ".$test['amount']." )"; }else{ echo "Free"; } ?></td></tr>
	<?php if(($this->session->userdata('su'))=='1'){ ?>
	<tr><td valign=top >Assigned to Groups</td><td width="20px"></td><td>
	<?php
	$groupids=explode(',',$test['group_id']);
	foreach($groupname as $groupname)
	{
		foreach($groupids as $groupid)
		{
		if($groupid==$groupname['gid'])	{ echo $groupname['group_name'].", "; }
		}	
	}
	?>
	 </td></tr>
	<tr><td>Allow to view Answer</td><td width="20px"></td><td><?php if($test['answer_view']=="1"){ echo "Yes";}else{ echo "No";}?></td></tr>
	<tr><td>Maximum Attempts </td><td width="20px"></td><td><?php echo $test['attempts'];?></td></tr>
	<?php } ?>
	</table>
	
	</code>
	
	<?php if(($this->session->userdata('su'))=='1'){ ?>
	<code>
	Randomly select following questions:<br/><br>
	<?php if($test['random_question_no']=="" || $test['random_question_no']=="0"){
	echo "No question added in the test."; }
	else
	{ 
	 
	// explode random_question_no to show
	$random_question=explode(",",$test['random_question_no']);
	$subject_ids=explode(",",$test['subject_ids']);
		foreach($random_question as $key=> $random_q)
				{
				$makesubjectname="";
							foreach($subjectname as $subject)
							{
											if($subject['sid']==$subject_ids[$key])
											{
											$makesubjectname=$subject['subject_Name'];
											}
							}
				echo $random_q." questions of subject '".$makesubjectname."'<br/>";
	
				}
				
	}
	?>
	</code>
	<?php
	}
	?>
	 
	<code>
	<?php if($startButton=="1"){ ?>
<table><tr>
<td><div id="button">
<?php  echo anchor('attemptTest/index/'.$test['tid'],'Start Test',array('id'=>'menu')); ?> 
</div></td></tr></table>
<?php
}
if(isset($msg) && $msg!=""){ echo $msg;}
?>
</code>
	</div>

	
</div>

