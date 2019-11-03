<?php 
	$get_notif = $this->Home_model->get_notification($this->session->user_id);
?>
<div class="row mt-3">
	<?php foreach ($get_notif as $row): ?>
		<div class="col-md-12">
			<div class="alert alert-warning text-dark alert-dismissible fade show" role="alert">
			  <?= $row['pesan'] ?>
			</div>
		</div>
	<?php endforeach ?>
</div>