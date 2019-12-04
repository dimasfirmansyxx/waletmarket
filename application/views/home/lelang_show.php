<table class="table table-bordered">
	<thead>
		<tr>
			<th>#</th>
			<th>Judul</th>
			<th>Aksi</th>
		</tr>
	</thead>
	<tbody>
		<?php $i = 1; ?>
		<?php foreach ($get_data as $row): ?>
			<?php if ( $row['status'] == "not" ): ?>
				<tr>
					<td><?= $i++ ?></td>
					<td>
						<?= ucwords($row['judul']) ?>
					</td>
					<td>
						<?php if ( $row['status'] == "not" ): ?>
							<button class="btn btn-danger btn-sm btnDelete" data-id="<?= $row['id_posting'] ?>">Hapus</button>
						<?php endif ?>
					</td>
				</tr>
			<?php endif ?>
		<?php endforeach ?>
	</tbody>
</table>