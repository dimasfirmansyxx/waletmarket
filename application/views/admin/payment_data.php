<div class="col-12">
	<table class="table table-bordered" id="data_table">
		<thead>
		  <tr>
		    <th width="50">#</th>
		    <th>Buyer</th>
		    <th>Nama Bank</th>
		    <th>Nomor Rekening</th>
		    <th>Atas Nama</th>
		    <th>Jumlah Transfer</th>
		    <th>Bukti Transfer</th>
		    <th width="200">Aksi</th>
		  </tr>
		</thead>
		<tbody>
			<?php $i = 1; ?>
			<?php foreach ($datas as $data): ?>
				<tr>
					<td><?= $i++ ?></td>
					<td><?= $this->Home_model->user_info($data['id_user'],"nama") ?></td>
					<td><?= $data['bankname'] ?></td>
					<td><?= $data['norek'] ?></td>
					<td><?= $data['an'] ?></td>
					<td>Rp.<?= number_format($data['jumlah']) ?>,-</td>
					<td>
						<a href="<?= base_url() ?>assets/img/payment/<?= $data['bukti'] ?>">
							<img src="<?= base_url() ?>assets/img/payment/<?= $data['bukti'] ?>" class="" height="100" width="auto">
						</a>
					</td>
					<td align="center">
						<button class="btn btn-success btn-sm btnAccept" data-id="<?= $data['id_payment'] ?>">
							Accept
						</button>
						<button class="btn btn-danger btn-sm btnDecline" data-id="<?= $data['id_payment'] ?>">
							Decline
						</button>
					</td>
				</tr>
			<?php endforeach ?>
		</tbody>
	</table>
</div>

<script>
	$('#data_table').DataTable();
</script>