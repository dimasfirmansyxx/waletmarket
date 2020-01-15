<div class="container-fluid">
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Newsletter</h1>
  </div>

  <div class="row">

    <div class="col-12">
      <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">
            List Terdaftar
            <button class="btn btn-primary btn-sm float-right" id="btnBroadcast">Broadcast Message</button>
          </h6>
        </div>
        <div class="card-body table-responsive" id="load_data_area">
          <p class="text-center">Sedang Memuat data ...</p>
        </div>
      </div>
    </div>

  </div>

</div>

<div class="modal fade" id="personalmodal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Kirim Pesan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="frmPersonal">
          <div class="form-group">
            <label>Subject</label>
            <input type="text" name="subject" class="form-control" required autocomplete="off">
          </div>
          <div class="form-group">
            <label>Message</label>
            <textarea class="form-control" name="message" required></textarea>
          </div>
      </div>
      <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary btnSave">Kirim</button>
        </form>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="broadcastmodal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Broadcast Message</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="frmBroadcast">
          <div class="form-group">
            <label>Subject</label>
            <input type="text" name="subject" class="form-control" required autocomplete="off">
          </div>
          <div class="form-group">
            <label>Message</label>
            <textarea class="form-control" name="message" required></textarea>
          </div>
      </div>
      <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary btnSave">Kirim</button>
        </form>
      </div>
    </div>
  </div>
</div>


<script>
  $(document).ready(function() {
  
    var base_url = "<?= base_url() ?>";

    function loadData() {
      $("#load_data_area").load(base_url + "admin/newsletter_data");
    }

    function setButtonSaving(word) {
      $(".btnSave").attr("disabled","disabled");
      $(".btnSave").html(word);
    }

    function unsetButtonSaving(word) {
      $(".btnSave").removeAttr("disabled");
      $(".btnSave").html(word);
    }

    $("#load_data_area").on("click",".btnhapus",function(){
      var id_selected = $(this).attr("data-id");
      swal({
        title: "Yakin?",
        text: "Apakah yakin subscriber ini akan dihapus ?",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
      .then((willDelete) => {
        if (willDelete) {
          $.ajax({
            url : base_url + "admin/newsletter_action/delete",
            data : { id : id_selected },
            type : "post",
            dataType : "text",  
            success: function(result) {
              if ( result == 0 ) {
                swal("Sukses","Sukses menghapus subscriber","success");
                loadData();
              } else {
                swal("Gagal","Kesalahan pada server","danger");
              }
            }
          });
        }
      });
    });


    var id_newsletter;
    $("#load_data_area").on("click",".btnpesan",function(){
      id_newsletter = $(this).attr("data-id");
      $("#personalmodal").modal("show");
    });

    $("#frmPersonal").on("submit",function(e){
      e.preventDefault();
      setButtonSaving("Mengirim...");
      var data = new FormData(this);
      data.append("id_newsletter",id_newsletter);
      $.ajax({
        url : base_url + "admin/sendmail/personal",
        type : "post",
        data : data,
        processData : false,
        cache : false,
        contentType : false,
        dataType : "text",
        success : function(result) {
          if ( result == 0 ) {
            swal("Sukses","Sukses mengirim email","success");
            $("#personalmodal").modal("hide");
            unsetButtonSaving("Kirim");
          } else {
            swal("Gagal","Kesalahan pada server","danger");
          }
        }
      });
    });

    $("#btnBroadcast").on("click",function(){
      $("#broadcastmodal").modal("show");
    });

    $("#frmBroadcast").on("submit",function(e){
      e.preventDefault();
      setButtonSaving("Broadcasting...");
      var data = new FormData(this);
      $.ajax({
        url : base_url + "admin/sendmail/broadcast",
        type : "post",
        data : data,
        processData : false,
        cache : false,
        contentType : false,
        dataType : "text",
        success : function(result) {
          if ( result == 0 ) {
            swal("Sukses","Broadcast Selesai","success");
            $("#broadcastmodal").modal("hide");
            unsetButtonSaving("Kirim");
          } else {
            swal("Gagal","Kesalahan pada server","danger");
          }
        }
      });
    });

    loadData();
  });
</script>