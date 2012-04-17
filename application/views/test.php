

<div id="container">
	<h1>Test / Quiz
	<div style="float:right;"><?php if(($this->session->userdata('su'))=='1'){  echo anchor('test/newt/','Add New'); }?></div>
	</h1>
	<div id="body">
	<?php if(($this->session->userdata('su'))=='1'){ ?>
	<input type="text" id="searcht" value="" onkeydown="if(event.keyCode==13){return searchtest();}"> <a href="javascript:searchtest();"><?php echo img(array('src'=>'images/search.jpg','width'=>'20','height'=>'20','title'=>'Search'));?></a>
	<?php } ?>
	<table>
	<tr id="Theading" >
	<th id="Theading"> ID </th>
	<th id="Theading"> Test Name</th>
	<th id="Theading"> Test Duration </th>
	<th id="Theading"> Start Time </th>
	<th id="Theading"> End Time </th>
	<th id="Theading"> View </th>
	<?php if(($this->session->userdata('su'))=='1'){ ?>
	<th id="Theading"> Edit </th>
	<th id="Theading"> Delete </th>
	<?php } ?>
	</tr>
	<?php foreach($test as $test){ ?>
	<tr id="Tvalues">
	<td ><?=$test['tid']?></td>
	<td ><?=$test['test_name']?></td>
	<td ><?php echo $test['test_time'];?> Min.</td>
	<td >&nbsp; <?php echo date('d-M-Y h:i A',$test['start_time']);?> &nbsp;</td>
	<td >&nbsp; <?php echo date('d-M-Y h:i A',$test['end_time']);?> &nbsp;</td>
	<td ><center><?php echo anchor('test/view/'.$test['tid'],img(array('src'=>'images/view.png','title'=>'View')));?> </center></td>
	<?php if(($this->session->userdata('su'))=='1'){ ?>
	<td ><center><?php echo anchor('test/edit/'.$test['tid'],img('images/edit.png'))?></center></td>
	<td ><center><a href="javascript:delt('<?php echo $test['tid']?>');"><?php echo img('images/delete.png')?></a></center></td>
	<?php } ?>
	</tr>
	<?php } ?>
	</table>
	<?php if(isset($limit)){
	if(count($test)<=0){ echo "No Test Found!<br/>";}
	 
	$next=($limit+30); $back=($limit-30); 
	if($back<0){ $back=0;}
		echo anchor('test/index/'.$back,'Back');?> | <?php echo anchor('test/index/'.$next,'Next'); 
		
		} ?>
	<br/><br/>
	
	
	</div>

	
</div>

