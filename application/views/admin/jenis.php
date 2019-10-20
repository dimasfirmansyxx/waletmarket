<div class="container-fluid">
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Konfigurasi Jenis</h1>
  </div>

  <div class="row">

    <div class="col-12">
      <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">
            List Jenis
            <button class="btn btn-primary btn-sm float-right" id="btnTambah">Tambah Jenis</button>
          </h6>
        </div>
        <div class="card-body table-responsive" id="load_data_area">
          <p class="text-center">Sedang Memuat data ...</p>
        </div>
      </div>
    </div>

  </div>

</div>

<div class="modal fade" id="modaltambah" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Tambah Jenis</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="frmTambah">
          <div class="form-group">
            <label>Nama Jenis</label>
            <input type="text" name="jenis" class="form-control" required autocomplete="off">
          </div>
          <div class="form-group">
            <label>Satuan</label>
            <input type="text" name="satuan" class="form-control" required autocomplete="off" value="kg">
          </div>
      </div>
      <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary btnSave">Save changes</button>
        </form>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modaledit" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Edit Jenis</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="frmEdit">
          <div class="form-group">
            <label>Nama Jenis</label>
            <input type="text" name="jenis" class="form-control txtJenis" required autocomplete="off">
          </div>
          <div class="form-group">
            <label>Satuan</label>
            <input type="text" name="satuan" class="form-control txtSatuan" required autocomplete="off" value="kg">
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

<script>
  $(document).ready(function() {
    
    var base_url = "<?= base_url() ?>";

    function loadData() {
      $("#load_data_area").load(base_url + "admin/jenis_data");
    }

    function labeledTextFieldOnEdit() {
      $(".txtJenis").val("Sedang memuat data ...");
      $(".txtSatuan").val("Sedang memuat data ...");
      $(".txtJenis").attr("disabled","disabled");
      $(".txtSatuan").attr("disabled","disabled");
    }

    function undisabledTextFieldOnEdit() {
      $(".txtJenis").removeAttr("disabled");
      $(".txtSatuan").removeAttr("disabled"); 
    }

    function setButtonSaving() {
      $(".btnSave").attr("disabled","disabled");
      $(".btnSave").html("Sedang Menyimpan ...");
    }

    function unsetButtonSaving() {
      $(".btnSave").removeAttr("disabled");
      $(".btnSave").html("Save Changes");
    }


    loadData();
    
    $("#btnTambah").on("click",function(){
      $("#modaltambah").modal("show");
    });

    $("#frmTambah").on("submit",function(e){
      e.preventDefault();
      setButtonSaving();
      $.ajax({
        url : base_url + "admin/jenis/tambah",
        type : "post",
        dataType : "text",
        data : new FormData(this),
        cache : false,
        processData : false,
        contentType : false,
        success : function(result) {
          if ( result == 0 ) {
            swal("Sukses","Sukses menambah jenis","success");
            $("#frmTambah").trigger("reset");
            loadData();
          } else if ( result == 2 ) {
            swal("Gagal","Jenis sudah ada","warning");
          } else if ( result == 1 ) {
            swal("Gagal","Kesalahan pada server","danger");
          }
          unsetButtonSaving();
        }
      });
    });

    var id_selected;

    $("#load_data_area").on("click",".btnEdit",function(){
      $("#modaledit").modal("show");
      id_selected = $(this).attr("data-id");
      labeledTextFieldOnEdit();
      $.ajax({
        url : base_url + "admin/jenis/get_jenis",
        data : { id : id_selected },
        type : "post",
        dataType : "json",
        success : function(result) {
          undisabledTextFieldOnEdit();
          $(".txtJenis").val(result.jenis);
          $(".txtSatuan").val(result.satuan);
        }
      });
    });

    $("#frmEdit").on("submit",function(e){
      e.preventDefault();
      setButtonSaving();
      var formdata = new FormData(this);
      formdata.append("id_jenis",id_selected);
      $.ajax({
        url : base_url + "admin/jenis/edit",
        type : "post",
        dataType : "text",
        data : formdata,
        cache : false,
        processData : false,
        contentType : false,
        success : function(result) {
          if ( result == 0 ) {
            swal("Sukses","Sukses mengubah jenis","success");
            loadData();
            $(".btnClose").click();
          } else if ( result == 2 ) {
            swal("Gagal","Jenis sudah ada","warning");
          } else if ( result == 1 ) {
            swal("Gagal","Kesalahan pada server","danger");
          }
          unsetButtonSaving();
        }
      });
    });

    $("#load_data_area").on("click",".btnHapus",function(){
      id_selected = $(this).attr("data-id");
      swal({
        title: "Yakin?",
        text: "Apakah yakin jenis ini akan dihapus ?",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
      .then((willDelete) => {
        if (willDelete) {
          $.ajax({
            url : base_url + "admin/jenis/delete",
            data : { id : id_selected },
            type : "post",
            dataType : "text",  
            success: function(result) {
              if ( result == 0 ) {
                swal("Sukses","Sukses menghapus jenis","success");
                loadData();
              } else if ( result == 3 ) {
                swal("Gagal","Jenis tidak ada","warning");
              } else if ( result == 1 ) {
                swal("Gagal","Kesalahan pada server","danger");
              }
            }
          });
        }
      });
    });

  });
</script>