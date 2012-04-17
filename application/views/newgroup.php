

<div id="container">
	<h1>Add New Group
	<div style="float:right" >
	<?php echo anchor('group/',img('images/back.gif'));?> &nbsp;
	
	</div>
	</h1>

	<div id="body">

	<?php echo form_open('group/add/');?>
	<?php echo validation_errors(); 
	if(isset($msg)){
	echo $msg; }
	?>
	
	
	<code>
	
	
	<table>
	<tr><td>Group Name</td><td width="20px"></td><td><input type="text" name="group_name" value="" ></td></tr>
	</table>
	
	<input type="submit" value="Submit">
	</code>
	
	 
	
	</div>

	
</div>

