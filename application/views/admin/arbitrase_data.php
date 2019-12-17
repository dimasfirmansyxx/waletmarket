<div class="col-12">
	<table class="table table-bordered" id="data_table">
		<thead>
		  <tr>
		    <th width="20">#</th>
		    <th>Postingan</th>
		    <th>Buyer</th>
		    <th>Seller</th>
		    <th>Total Biaya</th>
		    <th>Aksi</th>
		  </tr>
		</thead>
		<tbody>
			<?php $i = 1; ?>
			<?php foreach ($datas as $data): ?>
				<?php 
					$transaksi_info = $this->Lelang_model->get_transaksi($data['id_transaksi']);
					$postingan_info = $this->Lelang_model->get_lelang($transaksi_info['id_posting']);
					$buyer_info = $this->Home_model->user_info($transaksi_info['id_buyer']);
					$seller_info = $this->Home_model->user_info($transaksi_info['id_seller']);
					$bid_info = $this->Lelang_model->bid_info($transaksi_info['id_bid']);

					$arr = [ 
						"id_arbitrase" => $data['id_arbitrase'], 
						"id_seller" => $seller_info['id_user'],
						"id_buyer" => $buyer_info['id_user'] 
					];
				?>
				<tr>
					<td><?= $i++ ?></td>
					<td><?= $postingan_info['judul'] ?></td>
					<td><?= $buyer_info['nama'] ?></td>
					<td><?= $seller_info['nama'] ?></td>
					<td>Rp.<?= number_format($bid_info['jumlah']) ?>,-</td>
					<td>
						<a href="<?= base_url() ?>admin/arbitrase/chat/<?= $data['id_arbitrase'] ?>" class="btn btn-primary btn-sm">Chat</a>
						<button class="btn btn-success btn-sm btnselesai" data-id='<?= json_encode($arr) ?>'>Selesai</button>
						<button class="btn btn-warning btn-sm btndetail" data-id="<?= $data['id_transaksi'] ?>">Detail Biaya</button>
					</td>
				</tr>
			<?php endforeach ?>
		</tbody>
	</table>
</div>

<script>
	$('#data_table').DataTable();
</script>