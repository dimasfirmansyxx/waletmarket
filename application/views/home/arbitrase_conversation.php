<div class="col-md-8">
	
	<div class="row mt-5">
		<div class="col-md-8">
			<p class="text-muted">
				<?= $buyer_info['nama'] ?> <br>
				@<?= $buyer_info['username'] ?>
			</p>
		</div>
	</div>
	<div class="row mt-3">
		<div class="col-12 text-justify">
			<p><?= $arbitrase_data['remarks'] ?></p>
		</div>
	</div>
	<div class="row mt-3">
		<div class="col-12">
			<div class="row">
				<?php foreach ($media as $row): ?>
					<div class="col-md-4">
						<a href="<?= base_url() ?>assets/img/arbitrase/<?= $row['image'] ?>" target="_blank">
							<img src="<?= base_url() ?>assets/img/arbitrase/<?= $row['image'] ?>" class="img-fluid">
						</a>
					</div>
				<?php endforeach ?>
			</div>
		</div>
	</div>
	<div class="row mt-3">
		<div class="col-md-8">
			
			<div class="card">
				<div class="card-header">Chat</div>
				<div class="card-body showChat" style="height: 400px; overflow-y: scroll;">
					
				</div>
				<div class="card-footer">
					<form class="col-md-12" id="frmChat">
						<div class="input-group">
							<input type="text" class="form-control" required autocomplete="off" id="txtMessage">
							<div class="input-group-append">
								<button type="submit" class="btn btn-success">Kirim</button>
							</div>
						</div>
					</form>
				</div>
			</div>

		</div>
	</div>

</div>

<script>
	$(document).ready(function(){

		var base_url = "<?= base_url() ?>";
		var id_arbitrase = "<?= $arbitrase_data['id_arbitrase'] ?>";
		var id_user = "<?= $this->session->user_id ?>";

		function loadChat() {
			$(".showChat").load(base_url + "arbitrase/chat_conversation/" + id_arbitrase);
		}

		loadChat();

		setInterval(function(){
			loadChat();
		},1000);

		$("#frmChat").on("submit",function(e){
			e.preventDefault();
			var remarks = $("#txtMessage").val();
			$.ajax({
				url : base_url + "arbitrase/sendchat",
				data : { id_arbitrase : id_arbitrase, id_user : id_user, remarks : remarks },
				type : "post",
				dataType : "text",
				success : function(result) {
					if ( result == 0 ) {
						loadChat();
						$("#txtMessage").val("");
					} else {
						swal("Gagal!","Kesalahan pada server","error");
					}
				}
			});
		});

	});
</script>