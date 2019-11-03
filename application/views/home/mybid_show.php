<table class="table table-bordered">
	<thead>
		<tr>
			<th>#</th>
			<th>Judul</th>
			<th>Jumlah</th>
			<th>Aksi</th>
		</tr>
	</thead>
	<tbody>
		<?php $i = 1; ?>
		<?php foreach ($get_data as $row): ?>
			<tr>
				<td><?= $i++ ?></td>
				<td><?= ucwords($this->Lelang_model->get_lelang($row['id_posting'])['judul']) ?></td>
				<td>Rp.<?= number_format($row['jumlah']) ?>,-</td>
				<td>
					<a href="<?= base_url() ?>bid/conversation/<?= $row['id_bid'] ?>" class="btn btn-info btn-sm">Lihat Conversation</a>
				</td>
			</tr>
		<?php endforeach ?>
	</tbody>
</table>