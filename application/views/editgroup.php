

<div id="container">
	<h1>Edit Group
	<div style="float:right" >
	<?php echo anchor('group/',img('images/back.gif'));?> &nbsp;
	
	</div>
	</h1>

	<div id="body">

	<?php echo form_open('group/update/'.$group['gid']);?>
	<?php echo validation_errors(); 
	if(isset($msg)){
	echo $msg; }
	?>
	
	
	<code>
	
	
	<table>
	<tr><td>Subject Name</td><td width="20px"></td><td><input type="text" name="group_name" value="<?php echo $group['group_name'];?>" ></td></tr>
	</table>
	
	<input type="submit" value="Submit">
	</code>
	
	 
	
	</div>

	
</div>

