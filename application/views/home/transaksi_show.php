<table class="table table-bordered">
	<thead>
		<tr>
			<th>#</th>
			<th>Judul</th>
			<th>Jumlah</th>
			<th>Status</th>
			<th>Aksi</th>
		</tr>
	</thead>
	<tbody>
		<?php $i = 1; ?>
		<?php foreach ($get_data as $row): ?>
			<tr>
				<td><?= $i++ ?></td>
				<td><?= ucwords($this->Lelang_model->get_lelang($row['id_posting'])['judul']) ?></td>
				<td>Rp.<?= number_format($this->Lelang_model->bid_info($row['id_bid'])['jumlah']) ?>,-</td>
				<td>
					<?php if ( $row['status'] == "waiting" ): ?>
						Waiting Payment
					<?php elseif ( $row['status'] == "verifying" ): ?>
						Verifying Payment
					<?php elseif ( $row['status'] == "prepare" ): ?>
						Prepare Item
					<?php elseif ( $row['status'] == "deliver" ): ?>
						Deliver to Customer
					<?php else: ?>
						<?= ucwords($row['status']) ?>
					<?php endif ?>	
				</td>
				<td>
					<button class="btn btn-info btn-sm btnDoPayment" data-id="<?= $row['id_transaksi'] ?>">Lakukan Pembayaran</button>
				</td>
			</tr>
		<?php endforeach ?>
	</tbody>
</table>