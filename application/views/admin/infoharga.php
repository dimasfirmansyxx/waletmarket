<div class="container-fluid">
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Info Harga</h1>
  </div>

  <div class="row">

    <div class="col-12">
      <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">Data Harga</h6>
        </div>
        <div class="card-body">
          <table class="table table-bordered" id="data_table">
            <thead>
              <tr>
                <th>#</th>
                <th>Tanggal</th>
                <th>Mangkok (kg)</th>
                <th>Sudut (kg)</th>
                <th>Patahan (kg)</th>
                <th>Cong 60-90 (kg)</th>
              </tr>
            </thead>
          </table>
        </div>
      </div>
    </div>

  </div>

</div>

<script>
  $(document).ready(function() {
    
    $('#data_table').DataTable();
  
  });
</script>