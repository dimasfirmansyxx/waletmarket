<table class="table table-bordered">
	<tr>
		<th>Nama</th>
		<td><?= $user_info['nama'] ?></td>
	</tr>
	<tr>
		<th>Username</th>
		<td><?= $user_info['username'] ?></td>
	</tr>
	<tr>
		<th>Email</th>
		<td><?= $user_info['email'] ?></td>
	</tr>
	<tr>
		<th>Nomor HP</th>
		<td><?= $user_info['nohp'] ?></td>
	</tr>
	<tr>
		<th>Alamat</th>
		<td>
			<?= $user_info['alamat'] ?>, <?= $user_info['kota'] ?>, <?= $user_info['provinsi'] ?>
		</td>
	</tr>
</table>