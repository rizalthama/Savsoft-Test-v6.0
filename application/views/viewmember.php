

<div id="container">
	<h1><?=$member['first_name']?> <?=$member['last_name']?> 
	<div style="float:right" >
	<?php if(($this->session->userdata('su'))=='1'){  echo anchor('member/',img('images/back.gif')); }?> &nbsp;
	<?php echo anchor('member/edit/'.$member['uid'],img('images/edit.png'));?>  &nbsp;
	<a href="javascript:print();"><?php echo img('images/print.png');?></a>
	</div>
	</h1>

	<div id="body">

	
	<code>
	
	<table>
	<tr><td>Email</td><td width="20px"></td><td><?=$member['email']?></td></tr>
	<tr><td>Contact No. </td><td width="20px"></td><td><?=$member['contact_no']?></td></tr>
	<tr><td valign=top >Address</td><td width="20px"></td><td><?=$member['address']?></td></tr>
	<tr><td>Country</td><td width="20px"></td><td><?=$member['country']?></td></tr>
	<tr><td>Credit</td><td width="20px"></td><td><?=$member['credit']?></td></tr>
	<tr><td>Group</td><td width="20px"></td><td><?=$member['group_name']?></td></tr>
	<?php if(($this->session->userdata('su'))=='1'){ ?>
	<tr><td>Status</td><td width="20px"></td><td><?php if($member['status']=="1"){ echo "Active";} else{ echo "DeActive";} ?></td></tr>
	<tr><td>Account type</td><td width="20px"></td><td><?php if($member['su']=="1"){ echo "Administrator";} else{ echo "User";} ?></td></tr>
	<?php
	}
	?>
	</table>
	
	</code>
	
	 
	
	</div>

	
</div>

