<?php
if(isset($alert_data['status'])){
?>
<div class="alert alert-<?=($alert_data['status']=='error')?'danger':'success';?>">
	 <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
	  <strong><?=($alert_data['status']=='error')?'Error':'Success';?>!</strong> <?=$alert_data['message']?>.
</div>
<?php
}
?>