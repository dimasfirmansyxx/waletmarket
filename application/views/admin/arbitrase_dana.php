<table class="table table-bordered">
	<thead>
		<tr>
			<th>#</th>
			<th>Dana ke Buyer</th>
			<th>Dana ke Seller</th>
			<th>Status</th>
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
			</tr>
		<?php endforeach ?>
	</tbody>
</table>