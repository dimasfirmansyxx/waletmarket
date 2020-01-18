<table class="table table-bordered">
	<thead>
		<tr>
			<th>#</th>
			<th>Dana ke Buyer</th>
			<th>Dana ke Seller</th>
			<th>Status</th>
			<th>Aksi</th>
		</tr>
	</thead>
	<tbody>
		<?php $i = 1 ?>
		<?php foreach ($arbitrase_data as $row): ?>
			<tr>
				<td><?= $i++ ?></td>
				<td><?= number_format($row['dana_buyer']) ?></td>
				<td><?= number_format($row['dana_seller']) ?></td>
				<td><?= ucwords($row['status']) ?></td>
				<?php if ( !($row['id_user'] == $this->session->user_id) && $row['status'] == "pending"  ): ?>
					<td>
						<button class="btn btn-success btn-sm btnkonfirmasi" data-id="<?= $row['id_confirm'] ?>">
							Konfirmasi
						</button>
						<button class="btn btn-danger btn-sm btntolak" data-id="<?= $row['id_confirm'] ?>">
							Tolak
						</button>
					</td>
				<?php else: ?>
					<td></td>
				<?php endif ?>
			</tr>
		<?php endforeach ?>
	</tbody>
</table>