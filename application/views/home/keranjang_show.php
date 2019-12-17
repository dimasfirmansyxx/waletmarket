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
			<?php if ( !($row['status'] == "received" || $row['status'] == "success") ): ?>
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
					<td>Rp.<?= number_format($bid_info['jumlah']) ?>,-</td>
					<td><?= ucwords($row['status']) ?></td>
					<td>
						<?php if ( $row['status'] == "waiting" ): ?>
							<button class="btn btn-info btn-sm btnDoPayment" data-id="<?= $row['id_transaksi'] ?>">
								Lakukan Pembayaran
							</button>
							<button class="btn btn-warning btn-sm btnDetail" data-id="<?= $row['id_transaksi'] ?>">
								Detail Jumlah Pembayaran
							</button>
							<button class="btn btn-danger btn-sm btnHapus" data-id="<?= $row['id_transaksi'] ?>">
								Hapus
							</button>
						<?php elseif ( $row['status'] == "deliver" ): ?>
							<button class="btn btn-primary btn-sm btnShowResi mt-1 mb-1" data-id="<?= $row['id_transaksi'] ?>">
								Info Pengiriman
							</button>
							<button class="btn btn-success btn-sm btnToReceived mt-1 mb-1" data-id="<?= $row['id_transaksi'] ?>">
								Konfirmasi
							</button>
							<button class="btn btn-danger btn-sm btnToArbitrase mt-1 mb-1" data-id="<?= $row['id_transaksi'] ?>">
								Arbitrase
							</button>
						<?php endif ?>
					</td>
				</tr>
			<?php endif ?>
		<?php endforeach ?>
	</tbody>
</table>