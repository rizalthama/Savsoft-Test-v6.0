<div id="container">
	<h1>
	<?=$test['test_name']?>
	</h1>
<?php 
$attributes=array('id'=>'testForm');
echo form_open('attemptTest/getquestion/',$attributes);
?>
	
	<div id="body">
	<?php
	$totq=explode(",",$test['random_question_no']);
	$totq=array_sum($totq);
	$totalQuestions=array_sum(explode(",",$test['random_question_no']));
	$selected_answers=explode(',',$result['selected_answers']);
	$selected_answers=$selected_answers[$qno-1];
	
	?>
	<input type="hidden" name="qno" value="<?=$qno?>" id="qno">
	<input type="hidden" name="direction" value="N" id="direction">
	<input type="hidden" name="submitTest" value="0" id="submitTest">
	<input type="hidden" name="time1" value="<?php $time_taken=explode(',',$result['time_taken']); echo (array_sum($time_taken)+$result['iniTime']);?>" >
	
	<code><table><tr><td valign="top" >Q<?=$qno?>) &nbsp;</td><td><?=$question['question']?></td></tr></table></code>
	<?php $option=explode(',',$question['options']); 
	foreach($option as $option){ 
	$ans="ans".$qno;
	
	
	?>
	
	<div id="qoption">
	<table><tr><td style="width:18px;" valign=top ><input type="radio" value="<?=$option?>" name="answer" <?php if($selected_answers==$option){ echo "checked";} ?>  >  </td><td><?=$option?></td></tr></table>
	
	 </div>
	<?php 
	 }
	
	?>
	<br/>
	
	
	
	<table><tr><td><?php if($qno>="2"){ ?><div id="button" style="width:70px;"><center><a href="javascript:document.getElementById('direction').value='B';document.getElementById('testForm').submit();" id="menu" >Back</a></center></div><?php } ?></td><td> &nbsp;&nbsp;</td><td>
	<?php if($qno<$totalQuestions){ ?><div id="button" style="width:70px;"><center><a href="javascript:document.getElementById('testForm').submit();" id="menu">Next</a></center></div> <?php } ?>
	</td><td> &nbsp;&nbsp;</td>
	<td>
	<div id="button" style="width:120px;"><center>
	<a href="javascript:document.getElementById('submitTest').value='1';document.getElementById('testForm').submit();" id="menu">Submit Test</a>
	</center></div>
	</td></tr></table>
	<br/>
	
	 
	 
	
	</div>


