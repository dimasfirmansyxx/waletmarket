<?php if ( $convers_data != 3 ): ?>
	<?php foreach ($convers_data as $convers): ?>
		<?php if ( $convers['id_user'] == $this->session->user_id ): ?>
			<div class="row mt-2">
				<div class="col-md-4"></div>
				<div class="col-md-8">
					<small class="text-muted">You</small>
					<div class="card bg-primary text-white">
						<div class="card-body">
							<?= $convers['remarks'] ?>
						</div>
					</div>
				</div>
			</div>
		<?php else: ?>
			<div class="row mt-2">
				<div class="col-2">
					<img src="<?= base_url() ?>assets/img/core/ava-square.png" class="img-fluid rounded-circle">
				</div>
				<div class="col-8">
					<small class="text-muted">
						<?= $this->Home_model->user_info($convers['id_user'],$show = "nama") ?>
					</small>
					<div class="card bg-secondary text-white">
					  <div class="card-body">
					    <?= $convers['remarks'] ?>
					  </div>
					</div>
				</div>
			</div>
		<?php endif ?>
	<?php endforeach ?>
<?php endif ?>