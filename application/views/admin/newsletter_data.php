<div class="col-12">
	<table class="table table-bordered" id="data_table">
		<thead>
		  <tr>
		    <th width="20">#</th>
		    <th>Nama</th>
		    <th>Kota</th>
		    <th>Nomor HP</th>
		    <th>Email</th>
		    <th>Aksi</th>
		  </tr>
		</thead>
		<tbody>
			<?php $i = 1; ?>
			<?php foreach ($datas as $data): ?>
				<tr>
					<td><?= $i++ ?></td>
					<td><?= $data['nama'] ?></td>
					<td><?= $data['kota'] ?></td>
					<td><?= $data['nohp'] ?></td>
					<td><?= $data['email'] ?></td>
					<td>
						<button class="btn btn-primary btn-sm btnpesan" data-id="<?= $data['id_newsletter'] ?>">
							Kirim Pesan
						</button>
						<button class="btn btn-danger btn-sm btnhapus" data-id="<?= $data['id_newsletter'] ?>">
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