<div class="col-12">
	<table class="table table-bordered" id="data_table">
		<thead>
		  <tr>
		    <th width="20">#</th>
		    <th>Seller</th>
		    <th>Buyer</th>
		    <th>Judul</th>
		    <th>Total Bayar</th>
		    <th>Status</th>
		    <th>Aksi</th>
		  </tr>
		</thead>
		<tbody>
			<?php $i = 1; ?>
			<?php foreach ($get_data as $row): ?>
				<?php if ( $row['status'] == "deliver" ): ?>
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
						<td><?= $this->Home_model->user_info($row['id_buyer'],"nama") ?></td>
						<td><?= ucwords($posting_info['judul']) ?></td>
						<td>Rp.<?= number_format($bid_info['jumlah']) ?>,-</td>
						<td><?= ucwords($row['status']) ?></td>
						<td>
							<button class="btn btn-primary btn-sm btnshowinfo" data-id="<?= $row['id_transaksi'] ?>">Informasi Pengiriman</button>
						</td>
					</tr>
				<?php endif ?>
			<?php endforeach ?>
		</tbody>
	</table>
</div>

<script>
	$('#data_table').DataTable();
</script>