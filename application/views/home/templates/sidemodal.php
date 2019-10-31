<div class="modal fade" id="buatlelangmodal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Buat Lelang</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      	<form id="frmBuatLelang" enctype="multipart/form-data">
	        <div class="row">
	        	<div class="col-md-6">
	        		<div class="form-group">
	        			<label>Judul</label>
	        			<input type="text" name="judul" class="form-control" required autocomplete="off">
	        		</div>
	        		<div class="form-group">
	        			<label>Photo</label>
	        			<input type="file" name="photo" class="form-control" required autocomplete="off">
	        			<small>max size 13 MB</small>
	        		</div>
	        		<div class="form-group">
	        			<label>Video</label>
	        			<input type="file" name="video" class="form-control" autocomplete="off">
	        			<small>max size 13 MB</small>
	        		</div>
	        		<div class="form-group">
	        			<label>Keterangan</label>
	        			<textarea class="form-control" name="remarks" rows="5"></textarea>
	        		</div>
	        		<div class="form-group">
	        			<label>Jenis</label>
	        			<select name="jenis" class="form-control" required>
	        				<option value="jual">Jual</option>
	        				<option value="beli">Beli</option>
	        			</select>
	        		</div>
	        	</div>
	        	<div class="col-md-6">
	        		<?php $get = $this->Func_model->get_all_jenis(); ?>
	        		<?php foreach ($get as $row): ?>
	        			<div class="form-group">
		        			<label><?= ucwords($row['jenis']) ?> (<?= $row['satuan'] ?>)</label>
		        			<input type="number" name="<?= $row['id_jenis'] ?>" class="form-control" required autocomplete="off">
		        		</div>
	        		<?php endforeach ?>
	        		<div class="form-group">
	        			<label>Kadar (%)</label>
	        			<input type="number" name="kadar" class="form-control" required autocomplete="off">
	        		</div>
	        		<div class="form-group">
	        			<label>Warna</label>
	        			<input type="text" name="warna" class="form-control" required autocomplete="off">
	        		</div>
	        	</div>
	        </div>
      </div>
      <div class="modal-footer">
	      	<button type="button" class="btn btn-secondary mt-2 mb-2 btnClose" data-dismiss="modal">Close</button>
			<button type="submit" class="btn btn-primary btnSave mt-2 mb-2 mr-2">Posting</button>
		</form>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="mylelangmodel" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Postingan Lelang</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      	<div class="row">
      		<div class="col-lg-12 showLelang">
		      	<p class="text-center">Sedang Memuat data ...</p>
      		</div>
      	</div>
      </div>
      <div class="modal-footer">
      	<button type="button" class="btn btn-secondary mt-2 mb-2 mr-2 btnClose" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="biddermodel" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Bidder</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      	<div class="row">
      		<div class="col-lg-12 showBidder">
		      	<p class="text-center">Sedang Memuat data ...</p>
      		</div>
      	</div>
      </div>
      <div class="modal-footer">
      	<button type="button" class="btn btn-secondary mt-2 mb-2 mr-2 btnClose" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<script>
	$(document).ready(function(){

		var base_url = "<?= base_url() ?>";
		var id_user = "<?= $this->session->user_id ?>";

		function setButtonSaving(word) {
	      $(".btnSave").attr("disabled","disabled");
	      $(".btnSave").html(word);
	    }

	    function unsetButtonSaving(word) {
	      $(".btnSave").removeAttr("disabled");
	      $(".btnSave").html(word);
	    }

	    function loadLelangData() {
	    	$(".showLelang").load( base_url + "home/get_my_lelang/" + id_user );
	    }

	    function loadBidData(id_posting) {
	    	$(".showBidder").load( base_url + "home/get_bidder/" + id_posting )
	    }

		$("#btnBuatLelang").on("click",function(){
			$("#buatlelangmodal").modal("show");
		});

		$("#btnLelang").on("click",function(){
			loadLelangData();
			$("#mylelangmodel").modal("show");
		});

		$(".showLelang").on("click",".btnShowBidder",function(){
			var id = $(this).attr("data-id");
			loadBidData(id);
			$("#biddermodel").modal("show");
		});

		$("#frmBuatLelang").on("submit",function(e){
			e.preventDefault();
			setButtonSaving("Memposting ...");
			$.ajax({
				url : base_url + "home/lelang/buat",
				type : "post",
				dataType : "json",
				data : new FormData(this),
				cache : false,
				contentType : false,
				processData : false,
				success : function(result) {
					if ( result == 0 ) {
			            swal("Sukses","Sukses membuat postingan","success");
			            $(".btnClose").click();
			        } else if ( result == 401 ) {
			            swal("Gagal","Gambar yang diupload harus berformat jpg, jpeg, png atau bmp","warning");
			        } else if ( result == 402 ) {
			            swal("Gagal","Video yang diupload harus berformat mp4, mkv, avi atau 3gp","warning");
			        }
			        unsetButtonSaving("Posting");
				}
			});
		});
	});
</script>