<table class="table table-bordered">
	<thead>
		<tr>
			<th>#</th>
			<th>Bidder</th>
			<th>No.HP Bidder</th>
			<th>Bid</th>
			<th>Aksi</th>
		</tr>
	</thead>
	<tbody>
		<?php $i = 1; ?>
		<?php foreach ($get_data as $row): ?>
			<tr>
				<td><?= $i++ ?></td>
				<td><?= $this->Home_model->user_info($row['id_user'],"nama") ?></td>
				<td><?= $this->Home_model->user_info($row['id_user'],"nohp") ?></td>
				<td>Rp.<?= number_format($row['jumlah']) ?>,-</td>
				<td>
					<a href="<?= base_url() ?>bid/conversation/<?= $row['id_bid'] ?>" class="btn btn-info btn-sm">Lihat Conversation</a>
					<button class="btn btn-danger btn-sm btnDeclineBid" data-id="<?= $row['id_posting'] ?>">Decline Bid</button>
				</td>
			</tr>
		<?php endforeach ?>
	</tbody>
</table>