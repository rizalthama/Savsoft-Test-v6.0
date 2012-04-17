

<div id="container">
	<h1>Subjects 
	<div style="float:right;"><?php echo anchor('subject/newsubject/','Add New');?></div>
	</h1>
	<div id="body">
	<input type="text" id="searchs" value="" onkeydown="if(event.keyCode==13){return searchSubject();}"> <a href="javascript:searchSubject();"><?php echo img(array('src'=>'images/search.jpg','width'=>'20','height'=>'20','title'=>'Search'));?></a>
	<table>
	<tr id="Theading" >
	<th id="Theading"> ID </th>
	<th id="Theading"> Subject Name </th>
	<th id="Theading"> Edit </th>
	<th id="Theading"> Delete </th>
	</tr>
	<?php  foreach($subject as $subject){ ?>
	<tr id="Tvalues">
	<td ><?=$subject['sid']?></td>
	<td ><?=$subject['subject_Name']?></td>
	<td ><center><?php echo anchor('subject/edit/'.$subject['sid'],img('images/edit.png'))?></center></td>
	<td ><center><a href="javascript:dels('<?php echo $subject['sid']?>');"><?php echo img('images/delete.png')?></a></center></td>
	</tr>
	<?php } ?>
	</table>
	
	<br/><br/>
	
	
	</div>

	
</div>

