<table class="table table-bordered">
	<tr>
		<th>Nomor Resi</th>
		<td><?= $get_data['noresi'] ?></td>
	</tr>
	<tr>
		<th>Nomor Resi (Foto)</th>
		<td><img src="<?= base_url() ?>assets/img/resi/<?= $get_data['noresi_photo'] ?>" class="img-fluid"></td>
	</tr>
	<tr>
		<th>Bukti Timbangan</th>
		<td><img src="<?= base_url() ?>assets/img/timbangan/<?= $get_data['timbangan'] ?>" class="img-fluid"></td>
	</tr>
	<tr>
		<th>Video Bahan</th>
		<td>
			<video controls class="embed-responsive" height="250">
              <source src="<?= base_url() ?>assets/video/bahan/<?= $get_data['video'] ?>" type="video/mp4">
            </video>
		</td>
	</tr>
</table>