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
    		<?php $get_jenis = $this->Func_model->get_all_jenis(); ?>
    		<?php foreach ($get_jenis as $row): ?>
    			<div class="form-group">
        			<label><?= ucwords($row['jenis']) ?></label>
        			<div class="row">
        				<?php if ( $row['jenis'] == 'cong 60:40' ): ?>
	        				<div class="col-md-6">
	        					<label>Berat (<?= $row['satuan'] ?>)</label>
			        			<input type="text" name="<?= $row['id_jenis'] ?>0001" class="form-control" required autocomplete="off" id="txtcong" placeholder="Jumlah" readonly value="0">
	        				</div>
    					<?php else: ?>
    						<div class="col-md-6">
	        					<label>Berat (<?= $row['satuan'] ?>)</label>
			        			<input type="text" name="<?= $row['id_jenis'] ?>0001" class="form-control beratjenis" id="txt<?= $row['jenis'] ?>" required autocomplete="off" placeholder="Jumlah" value="0">
	        				</div>
        				<?php endif ?>
        				<div class="col-md-6">
        					<label>Harga</label>
        					<input type="text" name="<?= $row['id_jenis'] ?>0002" class="form-control hargaformat" required autocomplete="off" placeholder="Harga">
        				</div>
        			</div>
        		</div>
    		<?php endforeach ?>
    		<div class="form-group">
    			<label>Kadar (%)</label>
    			<input type="number" name="kadar" class="form-control" required autocomplete="off">
    		</div>
    		<div class="form-group">
    			<label>Warna</label>
    			<select class="form-control" name="warna" required>
    				<option value="Putih Kapas">Putih Kapas</option>
    				<option value="Putih Beras">Putih Beras</option>
    				<option value="Cream">Cream</option>
    				<option value="Abu-abu">Abu-abu</option>
    				<option value="Kuning">Kuning</option>
    			</select>
    		</div>
    	</div>
    </div>
	<button type="submit" class="btn btn-primary btn-block btnSave">Posting</button>
</form>

<script>
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

	function formatRupiah(angka, prefix){
		var number_string = angka.replace(/[^,\d]/g, '').toString(),
		split   		= number_string.split(','),
		sisa     		= split[0].length % 3,
		rupiah     		= split[0].substr(0, sisa),
		ribuan     		= split[0].substr(sisa).match(/\d{3}/gi);
	 
		// tambahkan titik jika yang di input sudah menjadi angka ribuan
		if(ribuan){
			separator = sisa ? '.' : '';
			rupiah += separator + ribuan.join('.');
		}
	 
		rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
		return prefix == undefined ? rupiah : (rupiah ? rupiah : '');
	}

	$(".hargaformat").on("keyup",function(e){
		var get = formatRupiah($(this).val(),"");
		$(this).val(get);
	});	

	$(".beratjenis").on("keyup",function(e){
		var total;
		var mangkok = $("#txtmangkok").val();
		var sudut = $("#txtsudut").val();
		var patahan = $("#txtpatahan").val();
		var kakian = $("#txtkakian").val();

		mangkok = mangkok.replace(",",".");
		sudut = sudut.replace(",",".");
		patahan = patahan.replace(",",".");
		kakian = kakian.replace(",",".");

		total = parseFloat(mangkok) + parseFloat(sudut) + parseFloat(patahan) + parseFloat(kakian);
		$("#txtcong").val(total);
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
		            window.location = base_url + "home";
		        } else if ( result == 401 ) {
		            swal("Gagal","Gambar yang diupload harus berformat jpg, jpeg, png atau bmp","warning");
		        } else if ( result == 402 ) {
		            swal("Gagal","Video yang diupload harus berformat mp4, mkv, avi atau 3gp","warning");
		        }
		        unsetButtonSaving("Posting");
			}
		});
	});
</script>