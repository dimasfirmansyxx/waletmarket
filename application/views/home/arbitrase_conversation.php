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
					<?php 
						$filename = $row['image'];
						$explode = explode(".", $filename);
						$extension = strtolower(end($explode));
						$image = ["jpg","jpeg","png","bmp"];
					?>
					<?php if ( in_array($extension, $image) ): ?>
						<div class="col-md-4 mt-2">
							<a href="<?= base_url() ?>assets/img/arbitrase/<?= $row['image'] ?>" target="_blank">
								<img src="<?= base_url() ?>assets/img/arbitrase/<?= $row['image'] ?>" class="img-fluid">
							</a>
						</div>
					<?php endif ?>
				<?php endforeach ?>
			</div>
		</div>
	</div>
	<div class="row mt-3">
		<div class="col-12">
			<div class="row">
				<?php foreach ($media as $row): ?>
					<?php 
						$filename = $row['image'];
						$explode = explode(".", $filename);
						$extension = strtolower(end($explode));
						$video = ["mp4","mkv","avi","3gp"];
					?>
					<?php if ( in_array($extension, $video) ): ?>
						<div class="col-md-4 mt-2">
							<video controls class="embed-responsive" height="200">
								<source src="<?= base_url() ?>assets/img/arbitrase/<?= $row['image'] ?>" type="video/mp4">
				            </video>
						</div>
					<?php endif ?>
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
		<div class="col-md-4">
			<small class="text-muted">Attach file</small>
			<form id="frmAttach">
				<input type="file" name="bukti[]" multiple="multiple" class="form-control" required>
				<button type="submit" class="btn btn-primary mt-2 mb-2 mr-2 btnSave btn-sm">Upload</button>
			</form>
		</div>
	</div>
	<div class="row mt-3">
		<div class="col-8">
			<h4 style="margin-top: 0; padding-top: 0;">Pengembalian Dana</h4>
		</div>
		<div class="col-4 ml-auto">
			<button class="btn btn-primary btn-sm btnTambahPengembalian">Tambah Data</button>
		</div>
		<div class="col-12 table-responsive mt-2 danaArea">
			
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

		function loadDana() {
			$(".danaArea").load(base_url + "arbitrase/arbitrase_dana/" + id_arbitrase);
		}

		function setButton(attribute,word) {
			$(attribute).attr("disabled","disabled");
			$(attribute).html(word);
		}

	    function unsetButton(attribute,word) {
			$(attribute).removeAttr("disabled");
			$(attribute).html(word);
		}

		loadChat();
		loadDana();

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

		$("#frmAttach").on("submit",function(e){
			e.preventDefault();
			var formdata = new FormData(this);
			formdata.append("id_arbitrase",id_arbitrase);
			setButton(".btnSave","Uploading...")
			$.ajax({
				url : base_url + "arbitrase/attach",
				data : formdata,
				processData : false,
				contentType : false,
				cache : false,
				type : "post",
				dataType : "text",
				success : function(result) {
					if ( result == 0 ) {
						window.location.reload();
					} else if ( result == 4 ) {
				        swal("Gagal","Pastikan format gambar adalah 'jpg,jpeg,png,bmp'");
					} else {
						swal("Gagal","Kesalahan pada server","error");
					}
					unsetButton(".btnSave","Upload");
				}
			});
		});

	});
</script>