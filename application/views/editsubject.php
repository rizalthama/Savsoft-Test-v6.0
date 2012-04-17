

<div id="container">
	<h1>Edit Subject
	<div style="float:right" >
	<?php echo anchor('subject/',img('images/back.gif'));?> &nbsp;
	
	</div>
	</h1>

	<div id="body">

	<?php echo form_open('subject/update/'.$subjectname['sid']);?>
	<?php echo validation_errors(); 
	if(isset($msg)){
	echo $msg; }
	?>
	
	
	<code>
	
	
	<table>
	<tr><td>Subject Name</td><td width="20px"></td><td><input type="text" name="subject_Name" value="<?php echo $subjectname['subject_Name'];?>" ></td></tr>
	</table>
	
	<input type="submit" value="Submit">
	</code>
	
	 
	
	</div>

	
</div>

