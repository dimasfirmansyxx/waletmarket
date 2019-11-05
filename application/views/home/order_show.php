<table class="table table-bordered">
	<thead>
		<tr>
			<th>#</th>
			<th>Buyer</th>
			<th>Postingan</th>
			<th>Status</th>
			<th>Aksi</th>
		</tr>
	</thead>
	<tbody>
		<?php $i = 1; ?>
		<?php foreach ($get_data as $row): ?>
			<?php if ( $row['status'] == "prepare" || $row['status'] == "deliver" ): ?>
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
						<?php if ( $row['status'] == "prepare" ): ?>
							<button class="btn btn-info btn-sm btnToDeliver" data-id="<?= $row['id_transaksi'] ?>">
								Ganti Status Ke 'Deliver'
							</button>
						<?php endif ?>
					</td>
				</tr>
			<?php endif ?>
		<?php endforeach ?>
	</tbody>
</table>