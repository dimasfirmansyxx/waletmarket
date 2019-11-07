<?php 
	$get_notif = $this->Home_model->get_notification($this->session->user_id);
?>
<div class="row mt-3">
	<?php foreach ($get_notif as $row): ?>
		<div class="col-md-12">
			<div class="alert alert-warning text-dark fade show alertnotification" data-id="<?= $row['id_notif'] ?>" role="alert" style="cursor: pointer;">
			  <?= $row['pesan'] ?>
			</div>
		</div>
	<?php endforeach ?>
</div>

<script>
	$(document).ready(function(){

		var base_url = "<?= base_url() ?>";

		$(".alertnotification").on("click",function(){
			var thisss = $(this);
			var id = $(this).attr("data-id");
			$(this).removeClass("show");
			$(this).addClass("hide");
			setTimeout(function(){
				thisss.css("display","none");
			},500);
			$.ajax({
				url : base_url + "home/clear_notif",
				data : { id_notif : id },
				type : "post",
				success : function(){}
			});
		});

	});
</script>