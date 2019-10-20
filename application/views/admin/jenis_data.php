<div class="col-12">
	<table class="table table-bordered" id="data_table">
		<thead>
		  <tr>
		    <th width="50">#</th>
		    <th>Nama Jenis</th>
		    <th>Satuan</th>
		    <th width="200">Aksi</th>
		  </tr>
		</thead>
		<tbody>
			<?php $i = 1; ?>
			<?php foreach ($datas as $data): ?>
				<tr>
					<td><?= $i++ ?></td>
					<td><?= ucwords($data['jenis']) ?></td>
					<td><?= $data['satuan'] ?></td>
					<td align="center">
						<button class="btn btn-success btn-sm btnEdit" data-id="<?= $data['id_jenis'] ?>">
							Edit
						</button>
						<button class="btn btn-danger btn-sm btnHapus" data-id="<?= $data['id_jenis'] ?>">
							Hapus
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