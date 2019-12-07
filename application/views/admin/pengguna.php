<div class="container-fluid">
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Info Pengguna</h1>
  </div>

  <div class="row">

    <div class="col-12">
      <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">
            Daftar Pengguna
          </h6>
        </div>
        <div class="card-body table-responsive">
          <table class="table table-bordered table-hover" id="data_table">
            <thead>
              <tr>
                <th>#</th>
                <th>Nama</th>
                <th>Username</th>
                <th>Email</th>
                <th>No HP</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php $i = 1; ?>
              <?php foreach ($get_data as $row): ?>
                <tr>
                  <td><?= $i++ ?></td>
                  <td><?= ucwords($row['nama']) ?></td>
                  <td><?= $row['username'] ?></td>
                  <td><?= $row['email'] ?></td>
                  <td><?= $row['nohp'] ?></td>
                  <td>
                    <button class="btn btn-danger btn-sm btnReset" data-id="<?= $row['id_user'] ?>">Reset Password</button>
                    <button class="btn btn-info btn-sm btnBank" data-id="<?= $row['id_user'] ?>">Info Rekening</button>
                  </td>
                </tr>
              <?php endforeach ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>

  </div>

</div>


<div class="modal fade" id="modalreset" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Reset Password</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="frmReset">
          <div class="form-group">
            <label>Password Baru</label>
            <input type="password" name="password" class="form-control txtpassword" required>
          </div>
      </div>
      <div class="modal-footer">
          <button type="button" class="btn btn-secondary btnClose" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary btnSave">Save changes</button>
        </form>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modalbank" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Info Rekening</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <table class="table table-bordered">
          <tr>
            <th>Bank Name</th>
            <td id="lblBankName">loading ...</td>
          </tr>
          <tr>
            <th>Nomor Rekening</th>
            <td id="lblNorek">loading ...</td>
          </tr>
          <tr>
            <th>Atas Nama</th>
            <td id="lblAn">loading ...</td>
          </tr>
        </table>        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary btnClose" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>


<script>
  $(document).ready(function() {
  
    var base_url = "<?= base_url() ?>";

    $('#data_table').DataTable();

    function setButtonSaving() {
      $(".btnSave").attr("disabled","disabled");
      $(".btnSave").html("Sedang Menyimpan ...");
    }

    function unsetButtonSaving() {
      $(".btnSave").removeAttr("disabled");
      $(".btnSave").html("Save Changes");
    }

    function loading_text()
    {
      $("#lblBankName").html("loading ...")
      $("#lblNorek").html("loading ...")
      $("#lblAn").html("loading ...")
    }

    var id_user;
    $(".btnReset").on("click",function(){
      id_user = $(this).attr('data-id');
      $("#modalreset").modal("show");
    });

    $("#frmReset").on("submit",function(e){
      e.preventDefault();
      var password = $(".txtpassword").val();
      setButtonSaving()
      $.ajax({
        url : base_url + "admin/pengguna/resetpassword",
        data : { id_user : id_user, password : password },
        type : "post",
        dataType : "text",
        success : function(result) {
          if ( result == 0 ) {
            swal("Sukses","Sukses me-reset password","success");
            $(".btnClose").click();
          } else if ( result == 1 ) {
            swal("Gagal","Kesalahan pada server","error");
          }
          unsetButtonSaving()
        }
      });
    });

    $(".btnBank").on("click",function(){
      id_user = $(this).attr("data-id");
      loading_text();
      $("#modalbank").modal("show");
      $.ajax({
        url : base_url + "admin/pengguna/bankinfo",
        data : { id_user : id_user },
        type : "post",
        dataType : "json",
        success : function(result) {
          if ( result == 3 ) {
            $("#lblBankName").html("TIDAK TERCANTUM");
            $("#lblNorek").html("TIDAK TERCANTUM");
            $("#lblAn").html("TIDAK TERCANTUM");
          } else {
            $("#lblBankName").html(result.bankname);
            $("#lblNorek").html(result.norek);
            $("#lblAn").html(result.an);
          }
        }
      });
    });
    
  });
</script>