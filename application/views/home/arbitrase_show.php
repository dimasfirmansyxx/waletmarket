<table class="table table-bordered">
	<thead>
		<tr>
			<th>#</th>
			<th>Postingan</th>
			<?php if ($this->session->user_jenis == "pembeli"): ?>
				<th>Seller</th>
			<?php elseif ($this->session->user_jenis == "penjual"): ?>
				<th>Buyer</th>
			<?php endif ?>
			<th>Aksi</th>
		</tr>
	</thead>
	<tbody>
		<?php $i = 1; ?>
		<?php foreach ($get_data as $row): ?>
			<?php 
				$transaksi = $this->Lelang_model->get_transaksi($row['id_transaksi']);
				$posting = $this->Lelang_model->get_lelang($transaksi['id_posting']);
				$buyer = $this->Home_model->user_info($transaksi['id_buyer']);
				$seller = $this->Home_model->user_info($transaksi['id_seller']);
			?>
			<tr>
				<td><?= $i++ ?></td>
				<td><?= ucwords($posting['judul']) ?></td>
				<?php if ($this->session->user_jenis == "pembeli"): ?>
					<td><?= $seller['nama'] ?></td>
				<?php elseif ($this->session->user_jenis == "penjual"): ?>
					<td><?= $buyer['nama'] ?></td>
				<?php endif ?>
				<td>
					<a href="<?= base_url() ?>arbitrase/conversation/<?= $row['id_arbitrase'] ?>" class="btn btn-primary btn-sm">Chat</a>
				</td>
			</tr>
		<?php endforeach ?>
	</tbody>
</table>