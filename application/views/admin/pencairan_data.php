<div class="col-12">
	<table class="table table-bordered" id="data_table">
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
			<?php foreach ($datas as $row): ?>
				<tr>
					<td><?= $i++ ?></td>
					<td><?= $this->Home_model->user_info($row['id_seller'],"nama") ?></td>
					<td>
						<?= ucwords($this->Lelang_model->get_lelang($row['id_posting'])['judul']) ?>
					</td>
					<td><?= ucwords($row['status']) ?></td>
					<td>
						<button class="btn btn-info btn-sm btnTransaksiSelesai" data-id="<?= $row['id_transaksi'] ?>">
							Transaksi Selesai
						</button>
						<button class="btn btn-warning btn-sm btnShowRek" data-id="<?= $row['id_seller'] ?>">
							Lihat info rekening
						</button>
						<button class="btn btn-primary btn-sm btnShowInfo" data-id="<?= $row['id_seller'] ?>">
							Lihat info seller
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