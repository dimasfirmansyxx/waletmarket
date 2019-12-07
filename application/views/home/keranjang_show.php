<table class="table table-bordered">
	<thead>
		<tr>
			<th>#</th>
			<th>Seller</th>
			<th>Postingan</th>
			<th>Harga</th>
			<th>Fee Transaksi</th>
			<th>Ongkos Kirim</th>
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
				$posting_info = $this->Lelang_model->get_lelang($row['id_posting']);
				$posting_detail = $this->Lelang_model->get_all_lelang_detail($row['id_posting']);

				$harga = 0;
				$berat = 0;
				$fee = 0;
				$ongkir = 0;

				foreach ($posting_detail as $get) {
					if ( $get['id_jenis'] == 6 ) {
						$harga = $get['jumlah'] * $get['harga'];
						$berat = $get['jumlah'];
					}
				}

				if ( $harga >= 100000000 ) {
					$fee = 3;
				} else {
					if ( $berat >= 10 ) {
						$fee = 3;
					} else {
						$fee = 5;
					}
				}
				$fee = $harga * $fee / 100;

				$ongkir = ($berat * 1.3) * 34000;
			?>
			<tr>
				<td><?= $i++ ?></td>
				<td><?= $this->Home_model->user_info($row['id_seller'],"nama") ?></td>
				<td>
					<a href="<?= base_url() ?>bid/conversation/<?= $row['id_bid'] ?>" target="_blank">
						<?= ucwords($posting_info['judul']) ?>
					</a>
				</td>
				<td>Rp.<?= number_format($harga) ?>,-</td>
				<td>Rp.<?= number_format($fee) ?>,-</td>
				<td>Rp.<?= number_format($ongkir) ?>,-</td>
				<td>Rp.<?= number_format($bid_info['jumlah']) ?>,-</td>
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