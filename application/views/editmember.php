

<div id="container">
	<h1><?=$member['first_name']?> <?=$member['last_name']?> 
	<div style="float:right" >
	<?php if(($this->session->userdata('su'))=='1'){ echo anchor('member/',img('images/back.gif')); }?> &nbsp;
	<?php echo anchor('member/view/'.$member['uid'],img('images/view.png'));?>  &nbsp;
	<a href="javascript:print();"><?php echo img('images/print.png');?></a>
	</div>
	</h1>

	<div id="body">

	<?php echo form_open('member/update/'.$member['uid']);?>
	<?php echo validation_errors(); ?>
	<code>
	
	
	<table>
	<tr><td>First Name</td><td width="20px"></td><td><input type="text" name="first_name" value="<?=$member['first_name']?>" ></td></tr>
	<tr><td>Last Name</td><td width="20px"></td><td><input type="text" name="last_name" value="<?=$member['last_name']?>" ></td></tr>
	<tr><td>Email</td><td width="20px"></td><td><input type="text" name="email" value="<?=$member['email']?>"  <?php if(($this->session->userdata('su'))!='1'){ echo "readonly";}?>  ></td></tr>
	<tr><td> Reset Password</td><td width="20px"></td><td><input type="password" name="password" value="" > (Optional)</td></tr>
	<tr><td>Contact No. </td><td width="20px"></td><td><input type="text" name="contact_no" value="<?=$member['contact_no']?>" ></td></tr>
	<tr><td valign=top >Address</td><td width="20px"></td><td><input type="text" name="address" value="<?=$member['address']?>" ></td></tr>
	<tr><td>Country</td><td width="20px"></td><td><input type="text" name="country" value="<?=$member['country']?>" ></td></tr>
	<tr><td>Group</td><td width="20px"></td><td><select name="gid"><?php foreach($groupName as $groupname){ ?><option value="<?=$groupname['gid']?>" <?php if($member['gid']==$groupname['gid']){ echo "selected";} ?> ><?=$groupname['group_name']?></option><?php } ?></select></td></tr>
	
	<?php if(($this->session->userdata('su'))=='1'){ ?>
	<tr><td>Credit</td><td width="20px"></td><td><input type="text" name="credit" value="<?=$member['credit']?>" ></td></tr>
	<tr><td valign=top >Status</td><td width="20px"></td><td><input type="radio" name="status" value="1" <?php if($member['status']=="1"){ echo "checked";} ?> > Active <br/><input type="radio" name="status" value="0" <?php if($member['status']=="0"){ echo "checked";} ?> > Deactive</td></tr>
	<tr><td valign=top >Account type</td><td width="20px"></td><td><input type="radio" name="su" value="0" <?php if($member['su']=="0"){ echo "checked";} ?> > User <br/><input type="radio" name="su" value="1" <?php if($member['su']=="1"){ echo "checked";} ?> > Administrator</td></tr>
	
	<?php
	}
	?>
	</table>
	
	<input type="submit" value="Submit">
	</code>
	
	 
	
	</div>

	
</div>

