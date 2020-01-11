<div class="container-fluid" style="margin: 0px !important; padding: 0px !important;">
	<?php if ( $convers_data != 3 ): ?>
		<?php foreach ($convers_data as $convers): ?>
			<?php if ( $convers['id_user'] == "0" ): ?>
				<div class="row mt-1">
					<div class="col-md-4"></div>
					<div class="col-md-8">
						<small class="text-muted">You</small>
						<div class="card bg-primary text-white">
							<div class="card-body" style="font-size: 8pt; padding: 10px;">
								<?= $convers['remarks'] ?>
							</div>
						</div>
					</div>
				</div>
			<?php else: ?>
				<div class="row mt-1">
					<div class="col-2">
						<img src="<?= base_url() ?>assets/img/core/ava-square.png" class="img-fluid rounded-circle">
					</div>
					<div class="col-8">
						<small class="text-muted">
							<?php if ( $buyer_info['id_user'] == $convers['id_user'] ): ?>
								<?= $this->Home_model->user_info($convers['id_user'],$show = "nama") ?> (Buyer)
							<?php else: ?>
								<?= $this->Home_model->user_info($convers['id_user'],$show = "nama") ?> (Seller)
							<?php endif ?>
						</small>
						<div class="card bg-secondary text-white">
						  <div class="card-body" style="font-size: 8pt; padding: 10px;">
						    <?= $convers['remarks'] ?>
						  </div>
						</div>
					</div>
				</div>
			<?php endif ?>
		<?php endforeach ?>
	<?php endif ?>
</div>