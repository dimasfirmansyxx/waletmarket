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
	      	<button type="button" class="btn btn-secondary mt-2 mb-2" data-dismiss="modal">Close</button>
			<button type="submit" class="btn btn-primary btnSave mt-2 mb-2 mr-2">Posting</button>
		</form>
      </div>
    </div>
  </div>
</div>
<script>
	$(document).ready(function(){

		var base_url = "<?= base_url() ?>";

		function setButtonSaving(word) {
	      $(".btnSave").attr("disabled","disabled");
	      $(".btnSave").html(word);
	    }

	    function unsetButtonSaving(word) {
	      $(".btnSave").removeAttr("disabled");
	      $(".btnSave").html(word);
	    }

		$("#btnBuatLelang").on("click",function(){
			$("#buatlelangmodal").modal("show");
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
			            $("#frmTambah").trigger("reset");
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