<div class="col-md-8">
	
	<div class="row mt-5">
		<div class="col-md-8">
			<h4 style="margin-top: 0;"><?= ucwords($post_data['judul']) ?></h4>
			<p class="text-muted">
				<?= $buyer_info['nama'] ?> <br>
				@<?= $buyer_info['username'] ?>
			</p>
		</div>
		<div class="col-md-4">
			<?php if ($post_data['status'] == "not"): ?>
				<button class="btn btn-success btn-sm" id="btnAcceptBid">Accept Bid</button><br>
			<?php endif ?>
			<h4 style="margin-top: 0;" class="text-right">
				Rp.<?= number_format($bid_data['jumlah']) ?>,-
			</h4>
		</div>
	</div>
	<div class="row mt-3">
		<div class="col-12 text-justify">
			<p><?= $bid_data['remarks'] ?></p>
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
			<?php 
				$detailposting = $this->Lelang_model->get_all_lelang_detail($post_data['id_posting']);
			?>
			<table class="table table-bordered mt-3">
	          <?php foreach ($detailposting as $detail): ?>
	            <tr>
	              <th><?= ucwords($this->Func_model->get_jenis($detail['id_jenis'])['jenis']) ?></th>
	              <td><?= $detail['jumlah'] ?> <?= $this->Func_model->get_jenis($detail['id_jenis'])['satuan'] ?></td>
	            </tr>
	          <?php endforeach ?>
	          <tr>
	            <th>Kadar</th>
	            <td><?= $post_data['kadar'] ?> %</td>
	          </tr>
	          <tr>
	            <th>Warna</th>
	            <td><?= $post_data['warna'] ?></td>
	          </tr>
	        </table>
		</div>
	</div>

</div>

<script>
	$(document).ready(function(){

		var base_url = "<?= base_url() ?>";
		var id_bid = "<?= $bid_data['id_bid'] ?>";
		var id_user = "<?= $this->session->user_id ?>";

		function loadChat() {
			$(".showChat").load(base_url + "bid/chat_conversation/" + id_bid);
		}

		loadChat();

		setInterval(function(){
			loadChat();
		},1000);

		$("#frmChat").on("submit",function(e){
			e.preventDefault();
			var remarks = $("#txtMessage").val();
			$.ajax({
				url : base_url + "bid/conversation_act/sendchat",
				data : { id_bid : id_bid, id_user : id_user, remarks : remarks },
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

		$("#btnAcceptBid").on("click",function(){
			$.ajax({
				url : base_url + "bid/accept",
				data : { id_bid : id_bid },
				type : "post",
				dataType : "text",
				success : function(result) {
					if ( result == 0 ) {
						swal("Sukses memilih bid!","Menunggu Pembayaran dari Buyer","success");
						setTimeout(function(){
							window.location = base_url + "bid/conversation/" + id_bid;
						},1000);
					} else if ( result == 1 ) {
						swal("Gagal!","Kesalahan pada server","error");
					}
				}
			});
		});

	});
</script>