<div class="container">
  <div class="row justify-content-center">
    <div class="col-12">
      <div class="card o-hidden border-0 shadow-lg my-5">
        <div class="card-body p-0">
          <!-- Nested Row within Card Body -->
          <div class="row">
            <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
            <div class="col-lg-6">
              <div class="p-5">
                <div class="text-center">
                  <h1 class="h4 text-gray-900 mb-4">Administrator Area</h1>
                </div>

                <div class="alert alert-success AlertSuccess" role="alert">
                  Login Sukses. Harap Tunggu, sedang mengalihkan ...
                </div>

                <div class="alert alert-danger AlertFailed" role="alert">
                  Login Gagal. <span class="failedreason"></span>
                </div>

                <form class="user" id="frmLogin">
                  <div class="form-group">
                    <input type="text" class="form-control form-control-user" placeholder="Username" name="username" autocomplete="off">
                  </div>
                  <div class="form-group">
                    <input type="password" class="form-control form-control-user" placeholder="Password" name="password" autocomplete="off">
                  </div>
                  <button type="submit" class="btn btn-primary btn-user btn-block btn-login">
                    Login
                  </button>
                </form>
                <hr>
                <small class="text-muted text-center">Developed by Planea</small>
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>

  </div>  
</div>
<script>
  $(document).ready(function(){

    var base_url = "<?= base_url() ?>";

    function alertClear() {
      $(".alert").css("display","none");
    }

    alertClear();

    $("#frmLogin").on("submit",function(e){
      e.preventDefault();
      alertClear();
      $(".btn-login").attr("disabled","disabled");
      $(".btn-login").html("Sedang Mengecek ...");
      $.ajax({
        url : base_url + "admin/login_check",
        type : "post",
        data : new FormData(this),
        cache : false,
        processData : false,
        contentType : false,
        dataType : "text",
        success : function(result) {
          if ( result == 0 ) {
            $(".AlertSuccess").css("display","block");
            setTimeout(function(){
              window.location = base_url + "admin";
            },1000);
          } else if ( result == 3 ) {
            $(".AlertFailed").css("display","block");
            $(".failedreason").html("Username tidak ada");
          } else if ( result == 5 ) {
            $(".AlertFailed").css("display","block");
            $(".failedreason").html("Password salah");
          }

          $(".btn-login").removeAttr("disabled");
          $(".btn-login").html("Login");
        }
      });
    });

  });
</script>