

<div id="container">
	<h1>Add New Subject
	<div style="float:right" >
	<?php echo anchor('subject/',img('images/back.gif'));?> &nbsp;
	
	</div>
	</h1>

	<div id="body">

	<?php echo form_open('subject/add/');?>
	<?php echo validation_errors(); 
	if(isset($msg)){
	echo $msg; }
	?>
	
	
	<code>
	
	
	<table>
	<tr><td>Subject Name</td><td width="20px"></td><td><input type="text" name="subject_Name" value="" ></td></tr>
	</table>
	
	<input type="submit" value="Submit">
	</code>
	
	 
	
	</div>

	
</div>

