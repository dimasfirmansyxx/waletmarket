<div class="col-md-8">
  <?php 
    if ( $this->session->user_logged ) {
      if ( $this->session->user_jenis == "pembeli" ) {
        include 'home_postingan.php';
      } else {
        include 'home_penjual.php';
      }
    } else {
      include 'home_postingan.php';
    }
  ?>
  
</div>

<script>
  $(document).ready(function(){

    var base_url = "<?= base_url() ?>";
    var posting_selected;

    function formatRupiah(angka, prefix){
      var number_string = angka.replace(/[^,\d]/g, '').toString(),
      split       = number_string.split(','),
      sisa        = split[0].length % 3,
      rupiah        = split[0].substr(0, sisa),
      ribuan        = split[0].substr(sisa).match(/\d{3}/gi);
     
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

    $(".btnAlertLogin").on("click",function(){
      swal("Login!","Lakukan login terlebih dahulu","warning");
    });

  });
</script>