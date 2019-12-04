<table class="table table-bordered">
	<thead>
		<tr>
			<th>#</th>
			<th>Seller</th>
			<th>Postingan</th>
			<th>Total Bayar</th>
			<th>Status</th>
			<th>Aksi</th>
		</tr>
	</thead>
	<tbody>
		<?php $i = 1; ?>
		<?php foreach ($get_data as $row): ?>
			<?php 
				$bid_info = $this->Lelang_model->bid_info($row['id_bid']);
			?>
			<tr>
				<td><?= $i++ ?></td>
				<td><?= $this->Home_model->user_info($row['id_seller'],"nama") ?></td>
				<td>
					<a href="<?= base_url() ?>bid/conversation/<?= $row['id_bid'] ?>" target="_blank">
						<?= ucwords($this->Lelang_model->get_lelang($row['id_posting'])['judul']) ?>
					</a>
				</td>
				<td>
					Rp.<?= number_format($bid_info['jumlah']) ?>,-
				</td>
				<td><?= ucwords($row['status']) ?></td>
				<td>
					<?php if ( $row['status'] == "waiting" ): ?>
						<button class="btn btn-info btn-sm btnDoPayment" data-id="<?= $row['id_transaksi'] ?>">
							Lakukan Pembayaran
						</button>
					<?php elseif ( $row['status'] == "deliver" ): ?>
						<button class="btn btn-primary btn-sm btnShowResi mt-1 mb-1" data-id="<?= $row['id_transaksi'] ?>">
							Lihat Informasi Pengiriman
						</button>
						<button class="btn btn-info btn-sm btnToReceived mt-1 mb-1" data-id="<?= $row['id_transaksi'] ?>">
							Ganti Status Ke 'Received'
						</button>
					<?php endif ?>
				</td>
			</tr>
		<?php endforeach ?>
	</tbody>
</table>