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
          </h6>
        </div>
        <div class="card-body table-responsive" id="load_data_area">
          <p class="text-center">Sedang Memuat data ...</p>
        </div>
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

    function setButtonSaving() {
      $(".btnSave").attr("disabled","disabled");
      $(".btnSave").html("Sedang Menyimpan ...");
    }

    function unsetButtonSaving() {
      $(".btnSave").removeAttr("disabled");
      $(".btnSave").html("Save Changes");
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

    loadData();
  });
</script>