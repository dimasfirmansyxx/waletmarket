<table class="table table-bordered">
	<thead>
		<tr>
			<th>#</th>
			<th>Seller</th>
			<th>Postingan</th>
			<th>Status</th>
			<th>Aksi</th>
		</tr>
	</thead>
	<tbody>
		<?php $i = 1; ?>
		<?php foreach ($get_data as $row): ?>
			<?php if ( $row['status'] == "deliver" ): ?>
				<tr>
					<td><?= $i++ ?></td>
					<td><?= $this->Home_model->user_info($row['id_buyer'],"nama") ?></td>
					<td>
						<a href="<?= base_url() ?>bid/conversation/<?= $row['id_bid'] ?>" target="_blank">
							<?= ucwords($this->Lelang_model->get_lelang($row['id_posting'])['judul']) ?>
						</a>
					</td>
					<td><?= ucwords($row['status']) ?></td>
					<td>
						<button class="btn btn-info btn-sm btnToReceived" data-id="<?= $row['id_transaksi'] ?>">
							Ganti Status Ke 'Received'
						</button>
					</td>
				</tr>
			<?php endif ?>
		<?php endforeach ?>
	</tbody>
</table>