<script type="text/javascript" src="<?php echo base_url('/javascript/calendar/calendarDateInput.js'); ?>"></script>
<script type="text/javascript">
function getNoQ(sid)
{ 
var sids="sid"+sid;
var noq=document.getElementById(sids).value;


var strs="<select name='noq[]' ><option value='' >0</option>";
	for(var i=1; i<=noq; i++)
	{
	strs=strs+"<option value="+i+" >"+i+"</option>";
	}
	strs=strs+"</select>";
document.getElementById('noq').innerHTML=strs;

}

</script>


<div id="container">
	<h1> Add New Test 
	<div style="float:right" >
	<?php echo anchor('test/',img('images/back.gif'));?> &nbsp;
	</a>
	</div>
	</h1>

	<div id="body">

	<?php echo form_open('test/add/');?>
	<?php echo validation_errors(); ?>
	
	<code>
	
	<table>
	<tr><td valign=top >Test Name</td><td width="20px"></td><td><input type="text" name="test_name" value="" ></td></tr>
	<tr><td valign=top >Description</td><td width="20px"></td><td><textarea name="description" rows="5" cols="70" ></textarea></td></tr>
	<tr><td>Time Duration</td><td width="20px"></td><td><input type="text" name="test_time" style="width:55px" value="" > Minutes </td></tr>
	<tr><td valign=top >Start Time</td><td width="20px"></td><td>
	
	<table><tr><td>
	  <script>DateInput('start_time', true, 'DD-MON-YYYY')</script>
	  </td><td>
<select  name="Shour" ><option value="HH">HH</option><?php for($i=1; $i<=12; $i++){ if($i<='9'){ $j="0".$i;} else{ $j=$i;} ?><option value="<?=$j?>" ><?=$j?></option><?php } ?></select>

<select  name="Sminute" ><option value="MM" >MM</option><?php for($i=0; $i<=60; $i++){ if($i<='9'){ $j="0".$i;} else{ $j=$i;} ?><option value="<?=$j?>" ><?=$j?></option><?php } ?></select>
	  
	  <select name="Sampm"><option value="AM" >AM</option><option value="PM"  >PM</option></select>
	  </td></tr></table>
	  
	  
	  
	</td></tr>
	<tr><td valign=top >End Time</td><td width="20px"></td><td>
	
	<table><tr><td>
	  <script>DateInput('end_time', true, 'DD-MON-YYYY')</script>
	  </td><td>
<select  name="Ehour" ><option value="HH">HH</option><?php for($i=1; $i<=12; $i++){ if($i<='9'){ $j="0".$i;} else{ $j=$i;} ?><option value="<?=$j?>"   ><?=$j?></option><?php } ?></select>

<select  name="Eminute" ><option value="MM" >MM</option><?php for($i=0; $i<=60; $i++){ if($i<='9'){ $j="0".$i;} else{ $j=$i;} ?><option value="<?=$j?>" ><?=$j?></option><?php } ?></select>
	  
	  <select name="Eampm"><option value="AM" >AM</option><option value="PM"  >PM</option></select>
	  </td></tr></table>
	
	
	<br/>
	
	<?php //echo date('d-M-Y h:i A',$test['end_time']);?>
	</td></tr>
	<tr><td valign=top >Assigned to Groups</td><td width="20px"></td><td>
	<?php
	$br=1;
	foreach($groupname as $groupname)
	{ ?> <input type="checkbox" name="gid[]" value="<?php echo $groupname['gid'];?>"  ><?php echo $groupname['group_name']; if(($br%4)=="0"){ echo "<br/>"; }	
	$br+=1; }
	?>
	<br/><br/>
	
	 </td></tr>
	<tr><td>Test Type</td><td width="20px"></td><td>
	
	<input type="radio" name="type" value="0"  > Free  &nbsp;&nbsp; 
	<input type="radio" name="type" value="1" > Paid  &nbsp; ( Amount <input type="text" name="amount" value="" style="width:60px" > )
	</td></tr>
	<tr><td>Allow to view Answer</td><td width="20px"></td><td>
	<input type="radio" name="answer_view" value="1"  > Yes &nbsp;&nbsp; <input type="radio" name="answer_view" value="0"  > No
	
	</td></tr>
	<tr><td>Maximum Attempts </td><td width="20px"></td><td><select name="attempts"><?php for($i=1; $i<=100;$i++){ ?><option value="<?php echo $i;?>"  ><?=$i?></option><?php }?></select></td></tr>
	</table>
	
	<br/>
	
	</code>
	
	<code>
	Add Questions<br/><br/>
	
	<?php foreach($subjectname as $subject){ ?><input type="hidden" value="<?=$subject['noq']?>" id="sid<?=$subject['sid']?>" ><?php } ?>
<table><tr><td>
Select Subject <select name="sid[]" onChange="getNoQ(this.value);" ><option value=""></option><?php foreach($subjectname as $subject){ ?><option value="<?=$subject['sid']?>" ><?=$subject['subject_Name']?></option> <?php } ?></select> &nbsp; no. of Questions  
	</td><td>
	<div id="noq" ><select ><option value="0">0</option></select></div>
	</td></tr></table>
	
	
	<br/><br/>
	
	<input type="submit" value="Submit">
	</code>
	 
	
	</div>

	
</div>

