

<div id="container">
	<h1>Results
	
	</h1>
	<div id="body">
	<?php if(($this->session->userdata('su'))=='1'){ ?>
<input type="text" id="searchr" value="" onkeydown="if(event.keyCode==13){return searchresult();}"> <a href="javascript:searchresult();"><?php echo img(array('src'=>'images/search.jpg','width'=>'20','height'=>'20','title'=>'Search'));?></a>
<?php } ?>
	<table>
	<tr id="Theading" >
	<th id="Theading"> ID </th>
	<th id="Theading"> Test Name</th>
	<th id="Theading"> Obtained % </th>
	<th id="Theading"> Status </th>
	<th id="Theading"> View </th>
	<?php if(($this->session->userdata('su'))=='1'){ ?>
	<th id="Theading"> Delete </th>
	<?php } ?>
	</tr>
	<?php foreach($result as $result){ ?>
	<tr id="Tvalues">
	<td > <?=$result['result_id']?> </td>
	<td > <?=$result['test_name']?> </td>
	<td ><center> <?=$result['obtained_percentage']?> % </center></td>
	<td > <?php if($result['status']==1){ echo "Pass"; }else{ echo "Fail";}  ?> </td>
	<td ><center><?php echo anchor('result/view/'.$result['result_id'],img(array('src'=>'images/view.png','title'=>'View')));?> </center></td>
	<?php if(($this->session->userdata('su'))=='1'){ ?>
	<td ><center><a href="javascript:delr('<?php echo $result['result_id']?>');"><?php echo img('images/delete.png');?></a></center></td>
	<?php } ?>
	</tr>
	<?php } ?>
	</table>
	<?php if(isset($limit)){
	if(count($result)<=0){ echo "No Result Found!<br/>";}
	 
	$next=($limit+30); $back=($limit-30); 
	if($back<0){ $back=0;}
		echo anchor('result/index/'.$back,'Back');?> | <?php echo anchor('result/index/'.$next,'Next'); 
		
		} ?>
	<br/><br/>
	
	
	</div>

	
</div>

