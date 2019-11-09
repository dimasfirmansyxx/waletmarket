<div class="col-12">
	<table class="table table-bordered" id="data_table">
		<thead>
		  <tr>
		    <th width="20">#</th>
		    <th>Tanggal</th>
		    <?php foreach ($jenis as $row): ?>
		    	<th><?= ucwords($row['jenis']) ?> (<?= $row['satuan'] ?>)</th>
		    <?php endforeach ?>
		  </tr>
		</thead>
		<tbody>
			<?php $i = 1; ?>
			<?php foreach ($datas as $data): ?>
				<?php 
					$getprice = $this->Func_model->get_info_harga($data['id_info']);
				?>
				<tr>
					<td><?= $i++ ?></td>
					<td><?= $data['tanggal'] ?></td>
					<?php foreach ($getprice as $price): ?>
						<td><?= $price['harga'] ?></td>
					<?php endforeach ?>
				</tr>
			<?php endforeach ?>
		</tbody>
	</table>
</div>

<script>
	$('#data_table').DataTable();
</script>