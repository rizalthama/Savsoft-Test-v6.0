<script type="text/javascript" src="<?php echo base_url('/javascript/calendar/calendarDateInput.js'); ?>"></script>
<script type="text/javascript">
function getNoQ(sid,k)
{ 
var sids="sid"+sid;
var noq=document.getElementById(sids).value;


var strs="<select name='noq[]' ><option value='' >0</option>";
	for(var i=1; i<=noq; i++)
	{
	strs=strs+"<option value="+i+" >"+i+"</option>";
	}
	strs=strs+"</select>";
	var noq="noq"+k;
document.getElementById(noq).innerHTML=strs;
}

</script>


<div id="container">
	<h1><?=$test['test_name']?> 
	<div style="float:right" >
	<?php echo anchor('test/',img('images/back.gif'));?> &nbsp;
	<?php echo anchor('test/view/'.$test['tid'],img('images/view.png'));?>  &nbsp;
	<a href="javascript:print();"><?php echo img('images/print.png');?></a>
	</div>
	</h1>

	<div id="body">

	<?php echo form_open('test/update/'.$test['tid']);?>
	<?php echo validation_errors(); ?>
	
	<code>
	
	<table>
	<tr><td valign=top >Test Name</td><td width="20px"></td><td><input type="text" name="test_name" value="<?=$test['test_name']?>" ></td></tr>
	<tr><td valign=top >Description</td><td width="20px"></td><td><textarea name="description" rows="5" cols="70" ><?=$test['description']?></textarea></td></tr>
	<tr><td>Time Duration</td><td width="20px"></td><td><input type="text" name="test_time" style="width:55px" value="<?=$test['test_time']?>" > Minutes </td></tr>
	<tr><td valign=top >Start Time</td><td width="20px"></td><td><?php $std=date('d-M-Y',$test['start_time']);$etd=date('d-M-Y',$test['end_time']); ?>
	
	<table><tr><td>
	  <script>DateInput('start_time', true, 'DD-MON-YYYY','<?=$std?>')</script>
	  </td><td>
<select  name="Shour" ><option value="HH">HH</option><?php for($i=1; $i<=12; $i++){ if($i<='9'){ $j="0".$i;} else{ $j=$i;} ?><option value="<?=$j?>"  <?php if($j==date('h',$test['start_time'])){ echo "selected";}?> ><?=$j?></option><?php } ?></select>

<select  name="Sminute" ><option value="MM" >MM</option><?php for($i=0; $i<=60; $i++){ if($i<='9'){ $j="0".$i;} else{ $j=$i;} ?><option value="<?=$j?>"  <?php if($j==date('i',$test['start_time'])){ echo "selected";}?> ><?=$j?></option><?php } ?></select>
	  
	  <select name="Sampm"><option value="AM"  <?php if(date('A',$test['start_time'])=="AM"){ echo "selected";}?>>AM</option><option value="PM"  <?php if(date('A',$test['start_time'])=="PM"){ echo "selected";}?>>PM</option></select>
	  </td></tr></table>
	  
	  
	  
	</td></tr>
	<tr><td valign=top >End Time</td><td width="20px"></td><td>
	
	<table><tr><td>
	  <script>DateInput('end_time', true, 'DD-MON-YYYY','<?=$etd?>')</script>
	  </td><td>
<select  name="Ehour" ><option value="HH">HH</option><?php for($i=1; $i<=12; $i++){ if($i<='9'){ $j="0".$i;} else{ $j=$i;} ?><option value="<?=$j?>"  <?php if($j==date('h',$test['end_time'])){ echo "selected";}?> ><?=$j?></option><?php } ?></select>

<select  name="Eminute" ><option value="MM" >MM</option><?php for($i=0; $i<=60; $i++){ if($i<='9'){ $j="0".$i;} else{ $j=$i;} ?><option value="<?=$j?>"  <?php if($j==date('i',$test['end_time'])){ echo "selected";}?> ><?=$j?></option><?php } ?></select>
	  
	  <select name="Eampm"><option value="AM"  <?php if(date('A',$test['end_time'])=="AM"){ echo "selected";}?>>AM</option><option value="PM"  <?php if(date('A',$test['end_time'])=="PM"){ echo "selected";}?>>PM</option></select>
	  </td></tr></table>
	
	
	<br/>
	
	<?php //echo date('d-M-Y h:i A',$test['end_time']);?>
	</td></tr>
	<tr><td valign=top >Assigned to Groups</td><td width="20px"></td><td>
	<?php
	$groupids=explode(',',$test['group_id']); $br=1;
	foreach($groupname as $groupname)
	{ ?> <input type="checkbox" name="gid[]" value="<?php echo $groupname['gid'];?>" <?php
		foreach($groupids as $groupid){ if($groupid==$groupname['gid']){ echo "checked"; }} ?> ><?php echo $groupname['group_name']; if(($br%4)=="0"){ echo "<br/>"; }	
	$br+=1; }
	?>
	<br/><br/>
	
	 </td></tr>
	<tr><td>Test Type</td><td width="20px"></td><td>
	
	<input type="radio" name="type" value="0" <?php if($test['type']=="0"){ echo "checked";}?> > Free  &nbsp;&nbsp; 
	<input type="radio" name="type" value="1" <?php if($test['type']=="1"){ echo "checked";}?> > Paid  &nbsp; ( Amount <input type="text" name="amount" value="<?=$test['amount']?>" style="width:60px" > )
	</td></tr>
	<tr><td>Allow to view Answer</td><td width="20px"></td><td>
	<input type="radio" name="answer_view" value="1" <?php if($test['answer_view']=="1"){ echo "checked";}?> > Yes &nbsp;&nbsp; <input type="radio" name="answer_view" value="0" <?php if($test['answer_view']=="0"){ echo "checked";}?> > No
	
	</td></tr>
	<tr><td>Maximum Attempts </td><td width="20px"></td><td><select name="attempts"><?php for($i=1; $i<=100;$i++){ ?><option value="<?php echo $i;?>" <?php if($i==$test['attempts']){ echo "selected";}?> ><?=$i?></option><?php }?></select></td></tr>
	</table>
	
	<br/>
	</code>
	
	<code>
	Selected Questions<br/><br/>
	
	<?php foreach($subjectname as $subject){ ?><input type="hidden" value="<?=$subject['noq']?>" id="sid<?=$subject['sid']?>" ><?php } ?>
<table>
<?php
$random_question=explode(",",$test['random_question_no']);
$subject_ids=explode(",",$test['subject_ids']);
$k=1;
foreach($random_question as $key=> $random_q)
						{
						
						?>
						<tr><td>
						Subject <select name="sid[]" onChange="getNoQ(this.value,'<?=$k?>');" ><option value=""></option>
						<?php foreach($subjectname as $subject){ ?>
						<option value="<?=$subject['sid']?>" <?php if($subject['sid']==$subject_ids[$key]){ echo "selected"; $snoq=$subject['noq']; } ?>  >
						<?=$subject['subject_Name']?>
						</option> <?php } ?></select>
						 &nbsp; no. of Questions  
						</td><td>
						<div id="noq<?=$k?>" ><select name="noq[]"><option value="">0</option><?php for($i=1; $i<=$snoq; $i++){?> 
						<option value="<?=$i?>" <?php if($i==$random_q){ echo "selected";}?> >
						<?=$i?></option><?php } ?></select></div>
						</td></tr>
						<?php 
						$k+=1;
						}
?>

<?php foreach($subjectname as $subject){ ?><input type="hidden" value="<?=$subject['noq']?>" id="sid<?=$subject['sid']?>" ><?php } ?>
<table><tr><td>
Subject <select name="sid[]" onChange="getNoQ(this.value,'<?=$k?>');" ><option value=""></option><?php foreach($subjectname as $subject){ ?><option value="<?=$subject['sid']?>" ><?=$subject['subject_Name']?></option> <?php } ?></select> &nbsp; no. of Questions  
	</td><td>
	<div id="noq<?=$k?>" ><select ><option value="0">0</option></select></div>


	</table>
	
	
	<br/><br/>
	
	<input type="submit" value="Submit">
	</code>
	 
	
	 
	
	</div>

	
</div>

