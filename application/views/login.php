<body>
<div id="container">
	<h1>Login</h1>

	
	<?php 
$attributes=array('id'=>'loginForm');
echo form_open('login/loginCheck',$attributes);
?>

	<table>
	<tr>
	<td>
	
	</td>
	<td>
	<?php 
	if(isset($msg)){
	echo $msg;
	}
	?>
	</td>
	</tr>
	<tr>
	<td>
	Email
	</td>
	<td>
	<input type="text" name="email">
	</td>
	</tr>
	<tr>
	<td>
	Password
	</td>
	<td>
	<input type="password" name="password">
	</td>
	</tr>
	<tr>
	<td>
	</td>
	<td>
	<table><tr><td>
	<div id="button" style="width:80px;"><center>
	<a href="javascript: document.getElementById('loginForm').submit();" id="menu">Login</a>
	</center></div>
	</td><td>
	 <?php
		if($this->config->item('registration')=="yes"){
		echo anchor('register','Register new account');
		}
	 ?>
	 </td></tr></table>
	 
	</td>
	</tr>
	</table>
	</form>
	<br/><br/>
	
	


	
</div>

