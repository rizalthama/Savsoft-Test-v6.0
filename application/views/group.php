

<div id="container">
	<h1>Groups 
	<div style="float:right;"><?php echo anchor('group/newgroup/','Add New');?></div>
	</h1>
	<div id="body">
	<input type="text" id="searchs" value="" onkeydown="if(event.keyCode==13){return searchGroup();}"> <a href="javascript:searchGroup();"><?php echo img(array('src'=>'images/search.jpg','width'=>'20','height'=>'20','title'=>'Search'));?></a>
	<table>
	<tr id="Theading" >
	<th id="Theading"> ID </th>
	<th id="Theading"> Group Name </th>
	<th id="Theading"> Edit </th>
	<th id="Theading"> Delete </th>
	</tr>
	<?php  foreach($group as $group){ ?>
	<tr id="Tvalues">
	<td ><?=$group['gid']?></td>
	<td ><?=$group['group_name']?></td>
	<td ><center><?php echo anchor('group/edit/'.$group['gid'],img('images/edit.png'))?></center></td>
	<td ><center><a href="javascript:delg('<?php echo $group['gid']?>');"><?php echo img('images/delete.png')?></a></center></td>
	</tr>
	<?php } ?>
	</table>
	
	<br/><br/>
	
	
	</div>

	
</div>

