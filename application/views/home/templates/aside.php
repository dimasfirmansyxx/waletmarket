<div class="container">
  <div class="aa-product-details section" id="features">
    <div class="row">
      <div class="col-md-3">
      	<div class="row mt-2">
		    <div class="col-md-12">
		    	<?php if ( $this->session->user_logged ): ?>
		    		<h3><?= $this->Home_model->user_info($this->session->user_id,"nama") ?></h3>
		    		<h5>@<?= $this->Home_model->user_info($this->session->user_id,"username") ?></h5>
					<div class="list-group mt-2" style="cursor: pointer;">
			    		<?php if ( $this->session->user_jenis == "pembeli" ): ?>
						  <a class="list-group-item list-group-item-action" id="btnKeranjang">
						  	Keranjang
						  </a>
						  <a class="list-group-item list-group-item-action" id="btnProfil">
						  	Profil
						  </a>
						<?php else: ?>
							<a class="list-group-item list-group-item-action" id="btnLelang">
							  	Postingan
							</a>
							<a class="list-group-item list-group-item-action" id="btnOrder">
								List Order
							</a>
							<a class="list-group-item list-group-item-action" id="btnProfil">
								Profil
							</a>
			    		<?php endif ?>
			    		<a class="list-group-item list-group-item-action" id="btnArbitrase">
							Komplain
						</a>
					</div>
					<br>
					<h3>Notification</h3>
					<small>* klik untuk menghapus notifikasi</small>
					<?php $this->load->view("home/templates/notif.php") ?>
					<?php $this->load->view("home/templates/sidemodal.php") ?>
		    	<?php endif ?>
		    </div>
		  </div>
      </div>

      <?php if ( !$this->session->user_logged ): ?>
      	
      <div class="modal fade" id="loginmodal" tabindex="-1" role="dialog" aria-hidden="true">
		  <div class="modal-dialog" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <h5 class="modal-title">Login</h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
		      </div>
		      <div class="modal-body">
		        <form id="frmLogin">
		        	<div class="alert alert-login alert-success AlertSuccess" role="alert">
	                  Login Sukses. Harap Tunggu, sedang mengalihkan ...
	                </div>

	                <div class="alert alert-login alert-danger AlertFailed" role="alert">
	                  Login Gagal. <span class="failedreason"></span>
	                </div>
		        	<div class="form-group">
		        		<label>Username</label>
		        		<input type="text" name="username" class="form-control" required autocomplete="off">
		        	</div>
		        	<div class="form-group">
		        		<label>Password</label>
		        		<input type="password" name="password" class="form-control" required autocomplete="off">
		        	</div>
		        	<div class="form-group">
		        		<label>Jenis</label>
		        		<select class="form-control" name="jenis" required>
		        			<option value="pembeli">Pembeli</option>
		        			<option value="penjual">Penjual</option>
		        		</select>
		        	</div>
		        	<button type="submit" class="btn btn-primary btn-block btnSave">Login</button>
		        </form>
		      	<p>Do not have an account ? <a href="#">Register!</a></p>
		      </div>
		    </div>
		  </div>
		</div>

		<div class="modal fade" id="registermodal" tabindex="-1" role="dialog" aria-hidden="true">
		  <div class="modal-dialog modal-lg" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <h5 class="modal-title">Register</h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
		      </div>
		      <div class="modal-body">
		        <form id="frmRegister">
		        	<div class="row">
		        		<div class="col-md-6">
		        			<div class="form-group">
		        				<label>Nama</label>
		        				<input type="text" name="nama" class="form-control" required autocomplete="off">
		        			</div>
		        			<div class="form-group">
		        				<label>Username</label>
		        				<input type="text" maxlength="16" name="username" class="form-control" required autocomplete="off">
		        			</div>
		        			<div class="form-group">
		        				<label>Password</label>
		        				<input type="password" maxlength="16" name="password" class="form-control" required autocomplete="off">
		        			</div>
		        			<div class="form-group">
		        				<label>Email</label>
		        				<input type="email" name="email" class="form-control" required autocomplete="off">
		        			</div>
		        		</div>
		        		<div class="col-md-6">
		        			<div class="form-group">
		        				<label>Nomor HP / Whatsapp</label>
		        				<input type="text" name="nohp" class="form-control txtNoHp" required autocomplete="off">
		        			</div>
		        			<div class="form-group">
		        				<label>Alamat</label>
		        				<input type="text" name="alamat" class="form-control" required autocomplete="off">
		        			</div>
		        			<div class="form-group">
		        				<label>Kota</label>
		        				<input type="text" name="kota" class="form-control" required autocomplete="off">
		        			</div>
		        			<div class="form-group">
		        				<label>Provinsi</label>
		        				<input type="text" name="provinsi" class="form-control" required autocomplete="off">
		        			</div>
		        		</div>
		        	</div>
		        	<button type="submit" class="btn btn-primary btn-block btnSave">Register</button>
		        </form>
		      	<p>Have an account ? <a href="#">Login!</a></p>
		      </div>
		    </div>
		  </div>
		</div>

		<div class="modal fade" id="subsmodal" tabindex="-1" role="dialog" aria-hidden="true">
		  <div class="modal-dialog" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <h3 style="margin-top: 0" class="modal-title">Update harga walet harian langsung ke HP Anda</h3>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
		      </div>
		      <div class="modal-body">
		        <form id="frmSubs">
		          <div class="form-group">
		            <label>Nama</label>
		            <input type="text" name="nama" class="form-control" required autocomplete="off">
		          </div>
		          <div class="form-group">
		          	<label>Kota</label>
		          	<input type="text" name="kota" class="form-control" required autocomplete="off">
		          </div>
		          <div class="form-group">
		            <label>No HP</label>
		            <input type="number" name="nohp" class="form-control" required autocomplete="off">
		          </div>
		          <div class="form-group">
		            <label>Email</label>
		            <input type="email" name="email" class="form-control" required autocomplete="off">
		          </div>
		      </div>
		      <div class="modal-footer">
		          <button type="button" class="btn btn-secondary mt-2 mb-2 mr-2 btnClose" data-dismiss="modal">Close</button>
		          <button type="submit" class="btn btn-primary mt-2 mb-2 mr-2 btnSave">Subscribe</button>
		        </form>
		      </div>
		    </div>
		  </div>
		</div>
      <?php endif ?>

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

	    function alertClear() {
	      $(".alert-login").css("display","none");
	    }

	    function openNewsletter() {
	    	$("#subsmodal").modal("show");
	    }

	    alertClear();

	    setTimeout(function(){
	    	openNewsletter();
	    },1000);

		$("#btnLogin").on("click",function(e){
			e.preventDefault();
			$("#loginmodal").modal("show");
		});

		$("#btnTransaksiAman").on("click",function(e){
			e.preventDefault();
			$("#loginmodal").modal("show");
		});

		$("#btnRegister").on("click",function(e){
			e.preventDefault();
			$("#registermodal").modal("show");
		});

		$("#frmRegister").on("submit",function(e){
			e.preventDefault();
			if ( $.isNumeric($(".txtNoHp").val()) == false ) {
				swal("Gagal","Isi nomor HP hanya dengan angka!","warning");
				return;
			}
			setButtonSaving("Sedang mendaftar ...")
			$.ajax({
				url : base_url + "home/register",
				type : "post",
				dataType : "text",
				data : new FormData(this),
				cache : false,
				contentType : false,
				processData : false,
				success: function(result) {
					if ( result == 0 ) {
						swal("Sukses","Pendaftaran sukses","success");
						$("#frmRegister").trigger("reset");
						$("#registermodal").modal("hide");
						$("#loginmodal").modal("show");
					} else if ( result == 2 ) {
						swal("Gagal","Username sudah ada","warning");
					} else if ( result == 202 ) {
						swal("Gagal","Email sudah ada","warning");
					} else if ( result == 1 ) {
						swal("Gagal","Kesalahan pada server","danger");
					}
					unsetButtonSaving("Register");
				}
			});
		});

		$("#frmLogin").on("submit",function(e){
			e.preventDefault();
			setButtonSaving("Sedang mengecek ...")
			alertClear();
			$.ajax({
				url : base_url + "home/login",
				type : "post",
				dataType : "text",
				data : new FormData(this),
				cache : false,
				contentType : false,
				processData : false,
				success: function(result) {
					if ( result == 0 ) {
						$(".AlertSuccess").css("display","block");
						setTimeout(function(){
							window.location = base_url + "home";
						},1000);
					} else if ( result == 3 ) {
						$(".AlertFailed").css("display","block");
						$(".failedreason").html("Username tidak ada");
					} else if ( result == 5 ) {
						$(".AlertFailed").css("display","block");
						$(".failedreason").html("Password salah");
					}
					unsetButtonSaving("Login");
				}
			});
		});

		$("#frmSubs").on("submit",function(e){
	      e.preventDefault();
	      setButtonSaving("Saving...");
	      var formdata = new FormData(this);
	      $.ajax({
	        url : base_url + "home/subscribe",
	        data : formdata,
	        cache : false,
	        processData : false,
	        contentType : false,
	        type : "post",
	        dataType : "text",
	        success : function(result) {
	          if ( result == 0 ) {
	            swal("Sukses","Sukses bergabung newsletter","success");
	            $("#subsmodal").modal("hide");
	          } else if ( result == 1 ) {
	            swal("Gagal","Kesalahan pada server","error");
	          }
	          unsetButtonSaving("Subscribe");
	        }
	      });
	    });

	});
</script>