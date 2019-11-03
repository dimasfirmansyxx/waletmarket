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
				<td>
					<?= ucwords($row['judul']) ?>
					<?php if ( $row['status'] == "sold" ): ?>
						<strong>(SOLD)</strong>
					<?php endif ?>
				</td>
				<td><?= $this->Lelang_model->count_bidder($row['id_posting']) ?></td>
				<td>
					<button class="btn btn-info btn-sm btnShowBidder" data-id="<?= $row['id_posting'] ?>">Lihat Bidder</button>
					<?php if ( $row['status'] == "not" ): ?>
						<button class="btn btn-danger btn-sm btnDelete" data-id="<?= $row['id_posting'] ?>">Hapus</button>
					<?php endif ?>
				</td>
			</tr>
		<?php endforeach ?>
	</tbody>
</table>