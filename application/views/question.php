

<div id="container">
	<h1>Question  #<?=$questionBank['qid']?> (Subject: <?=$questionBank['subject_Name']?>)
	<div style="float:right" >
	<?php echo anchor('qbank/',img('images/back.gif'));?> &nbsp;
	<?php echo anchor('qbank/edit/'.$questionBank['qid'],img('images/edit.png'));?> &nbsp;
	<a href="javascript:print();"><?php echo img('images/print.png');?></a>
	</div>
	</h1>

	<div id="body">

	
	<code><?=$questionBank['question']?></code>
	<?php $option=explode(',',$questionBank['options']); 
	foreach($option as $option){ ?>
	<p><table><tr><td style="width:18px;"><?php if($questionBank['answer']==$option){ 
	 echo img('images/tick.png');
	 }?> </td><td><?=$option?></td></tr></table></p>
	<?php } ?>
	 
	 
	
	</div>

	
</div>

