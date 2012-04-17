<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title><?=$title?></title>
<link rel="stylesheet" href="<?php echo base_url('/javascript/style.css'); ?>" type="text/css">
<script type="text/javascript">
       var  base_url = "<?=base_url() ?>";
</script>
<script type="text/javascript" src="<?php echo base_url('/javascript/javascript.js'); ?>" ></script>

</head>
</head>
<body>

<div id="body">

<?php 

// logo img 
if($this->config->item('logo')=="yes"){
echo img(array('src'=>'images/logo.jpg','title'=>'logo')); 
}

// if user logged in show menu's
if(($this->session->userdata('logged_in'))=='TRUE')
	{
	?>

<table><tr>
<td><div id="menu">
<?php echo anchor('index/','Home',array('id'=>'menu'));?> 
</div></td>
<td><div id="menu">
<?php 
// if logged in user is administrator or super user 
if(($this->session->userdata('su'))=='1'){  
echo anchor('member/','Member',array('id'=>'menu'));
}
else
{
echo anchor('member/view/'.$this->session->userdata('uid'),'My account',array('id'=>'menu'));
}

?>
</div></td>
<?php 
// if logged in user is administrator or super user 
if(($this->session->userdata('su'))=='1'){  ?>
<td><div id="menu">
<?php echo anchor('qbank/','Question Bank',array('id'=>'menu'));?>
</div></td>
<?php }?>
<td><div id="menu">
<?php echo anchor('test/','Test',array('id'=>'menu'));?>
</div></td>
<td><div id="menu">
<?php echo anchor('result/','Result',array('id'=>'menu'));?> 
</div></td>

<?php
// if logged in user is administrator or super user 
if(($this->session->userdata('su'))=='1'){
?><td><div id="menu"><?php  
echo anchor('setting/','Setting',array('id'=>'menu'));
?></div></td>
<?php 
}
?>

<td><div id="menu">
<?php echo anchor('logout/','Logout',array('id'=>'menu'));?> 
</div></td>
</tr></table>

<?php
}
?>
</div>


</div>

