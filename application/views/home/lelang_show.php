<table class="table table-bordered">
	<thead>
		<tr>
			<th>#</th>
			<th>Judul</th>
			<th>Jumlah Bidder</th>
			<th>Aksi</th>
		</tr>
	</thead>
	<tbody>
		<?php $i = 1; ?>
		<?php foreach ($get_data as $row): ?>
			<tr>
				<td><?= $i++ ?></td>
				<td><?= ucwords($row['judul']) ?></td>
				<td><?= $this->Lelang_model->count_bidder($row['id_posting']) ?></td>
				<td>
					<button class="btn btn-info btn-sm btnShowBidder" data-id="<?= $row['id_posting'] ?>">Lihat Bidder</button>
					<button class="btn btn-danger btn-sm btnDelete" data-id="<?= $row['id_posting'] ?>">Hapus</button>
				</td>
			</tr>
		<?php endforeach ?>
	</tbody>
</table>