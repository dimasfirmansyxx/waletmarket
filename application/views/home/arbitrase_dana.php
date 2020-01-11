<table class="table table-bordered">
	<thead>
		<tr>
			<th>#</th>
			<th>Dana ke Buyer</th>
			<th>Dana ke Seller</th>
			<th>Persetujuan Buyer</th>
			<th>Persetujuan Seller</th>
		</tr>
	</thead>
	<tbody>
		<?php $i = 1 ?>
		<?php foreach ($arbitrase_data as $row): ?>
			<tr>
				<td><?= $i++ ?></td>
				<td><?= $row['dana_buyer'] ?></td>
				<td><?= $row['dana_seller'] ?></td>
				<td><?= $row['confirm_buyer'] ?></td>
				<td><?= $row['confirm_seller'] ?></td>
			</tr>
		<?php endforeach ?>
	</tbody>
</table>