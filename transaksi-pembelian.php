<?php 
  include '_header.php';
  include '_nav.php';
  include '_sidebar.php'; 
?>

<?php 
// Insert Ke keranjang
if( isset($_POST["submit"]) ){
  // var_dump($_POST);

  // cek apakah data berhasil di tambahkan atau tidak
  if( tambahKeranjangPembelian($_POST) > 0 ) {
    echo "
      <script>
        document.location.href = 'transaksi-pembelian';
      </script>
    ";
  } 
  
}
?>


<?php  
// Edit QTY
if( isset($_POST["update"]) ){
  // var_dump($_POST);

  // cek apakah data berhasil di tambahkan atau tidak
  if ( updateQTYpembelian($_POST) === 0 ) {
    echo "
      <script>
        alert('Anda Belum Input Nominal QTY !!!!!');
      </script>
    ";
  } elseif( updateQTYpembelian($_POST) > 0 ) {
    echo "
      <script>
        document.location.href = 'transaksi-pembelian';
      </script>
    ";
  } 
  else {
    echo "
      
    ";
  }
  
}
?>

<?php 
error_reporting(0);
// Insert Ke keranjang
$inv = $_POST["pembelian_invoice2"];
if( isset($_POST["updateStock"]) ){
  // var_dump($_POST);

  // cek apakah data berhasil di tambahkan atau tidak
  if( updateStockPembelian($_POST) > 0 ) {
    echo "
      <script>
        document.location.href = 'invoice-pembelian?no=".$inv."';
      </script>
    ";
  } else {
    echo "
      <script>
        alert('Data Gagal berkurang');
      </script>
    ";
  }
  
}
?>

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Transaksi Pembelian Produk</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="bo">Home</a></li>
              <li class="breadcrumb-item active">Barang</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>


    <section class="content">
    <?php  
      $keranjang = query("SELECT * FROM keranjang_pembelian ORDER BY keranjang_id ASC");

      $pembelian = mysqli_query($conn,"select * from invoice_pembelian");
      $jmlPembelian = mysqli_num_rows($pembelian);
      $jmlPembelian1 = $jmlPembelian + 1;
    ?>
        <div class="col-lg-12">
        	<div class="card">
            <div class="card-header">
              <div class="row">
                <div class="col-md-8 col-lg-8">
                    <div class="card-invoice">
                      <span>No. Invoice: </span>
                      <?php  
                        $today = date("Ymd");
                        $di = $today.$jmlPembelian1;
                      ?>
                      <input type="" name="" value="<?= $di; ?>">
                    </div>
                </div>
                <div class="col-md-4 col-lg-4">
                    <div class="cari-barang-parent">
                      <a href='#modal-id' data-toggle="modal" id="cari-barang">
                        <span class="title-cari-produk" for="cari-barang">Cari Barang</span>
                      </a>
                      <a class="btn btn-primary" data-toggle="modal" id="cari-barang" href='#modal-id'>
                         <i class="fa fa-search"></i>
                      </a>
                    </div>
                </div>
                </div>
              </div>

            <!-- /.card-header -->
              <span id="transaksi-pembelian-keranjang"></span>
            <!-- /.card-body -->
          </div>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
</div>


    <?php  
      $data = query("SELECT * FROM barang ORDER BY barang_id DESC");
    ?>
    <div class="modal fade" id="modal-id">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-body">
                  <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Data barang Keseluruhan</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <div class="table-auto">
                    <table id="example1" class="table table-bordered table-striped">
                      <thead>
                      <tr>
                        <th style="width: 6%;">No.</th>
                        <th style="width: 13%;">Kode Barang</th>
                        <th>Nama</th>
                        <th>Satuan</th>
                        <th>Stock</th>
                        <th style="text-align: center;">Aksi</th>
                      </tr>
                      </thead>
                      <tbody>
                      <?php $i=1; ?>
                      <?php foreach($data as $row) : ?>
                      <tr>
                          <td><?= $i; ?></td>
                          <td><?= $row['barang_kode'] ?></td>
                          <td><?= $row['barang_nama'] ?></td>
                          <td>
                            <?php  
                                $satuan = $row['satuan_id'];
                                $satuanParent = mysqli_query( $conn, "select satuan_nama from satuan where satuan_id = '".$satuan."'");
                                $sn = mysqli_fetch_array($satuanParent); 
                                $nSn = $sn['satuan_nama'];

                                echo $nSn;
                                ?>
                          </td>
                          <td><?= $row['barang_stock'] ?></td>
                          <td style="text-align: center; width: 17%;">
                            <form role="form" action="" method="post">
                              <input type="hidden" name="barang_id" value="<?= $row["barang_id"]; ?>">
                              <input type="hidden" name="keranjang_nama" value="<?= $row['barang_nama'];  ?>">
                              <input type="hidden" name="keranjang_harga" value="0">
                              <input type="hidden" name="keranjang_id_kasir" value="<?= $_SESSION['user_id']; ?>">
      
                              <button class="btn btn-primary" type="submit" name="submit">
                                  <i class="fa fa-shopping-cart"></i> Pilih
                              </button>
                            </form>
                          </td>
                      </tr>
                      <?php $i++; ?>
                      <?php endforeach; ?>
                    </tbody>
                  </table>
                </div>
              </div>
                <!-- /.card-body -->
              </div>    
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
    </div>

  <!-- Modal Update Harga Pembelian -->
  <div class="modal fade" id="modal-id-2">
    <div class="modal-dialog">
      <div class="modal-content">

        <form role="form" id="form-edit-harga-beli" method="post" action="transaksi-pembelian-harga-beli-proses.php">
          <div class="modal-header">
            <h4 class="modal-title">Harga Pembelian</h4>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          </div>
          <div class="modal-body" id="data-keranjang-pembelian">
            
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
            <button type="submit" class="btn btn-primary" >Edit Data</button>
          </div>
        </form>

      </div>
    </div>
  </div>
  
  

<?php include '_footer.php'; ?>

<script>
  $(document).ready(function(){
      $('#transaksi-pembelian-keranjang').load('transaksi-pembelian-keranjang.php');


      // Edit Status 
      $(document).on('click','#keranjang-pembelian',function(e){
          e.preventDefault();
          $("#modal-id-2").modal('show');
          $.post('transaksi-pembelian-harga-beli.php',
            {id:$(this).attr('data-id')},
            function(html){
              $("#data-keranjang-pembelian").html(html);
            }   
          );
        });

      $("#form-edit-harga-beli").submit(function(e) {
        e.preventDefault();
        
        var dataform = $("#form-edit-harga-beli").serialize();
        $.ajax({
          url: "transaksi-pembelian-harga-beli-proses.php",
          data: dataform,
          type: "post",
          success: function(result) {
            var hasil = JSON.parse(result);
            if (hasil.hasil !== "sukses") {
            } else {
              $('#modal-id-2').modal('hide');
              Swal.fire(
                'Sukses !!',
                'Data Berhasil diupdate',
                'success'
              );
              $('#transaksi-pembelian-keranjang').load('transaksi-pembelian-keranjang.php');
            }
          }
        });
      });
      // End Edit Status
  });
</script>

<!-- DataTables -->
<script src="plugins/datatables/jquery.dataTables.js"></script>
<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
<script>
  $(function () {
    $("#example1").DataTable();
  });
</script>
<script>
    function hanyaAngka(evt) {
      var charCode = (evt.which) ? evt.which : event.keyCode
       if (charCode > 31 && (charCode < 48 || charCode > 57))
 
        return false;
      return true;
    }
    function hanyaAngka1(evt) {
      var charCode = (evt.which) ? evt.which : event.keyCode
       if (charCode > 31 && (charCode < 48 || charCode > 57))
 
        return false;
      return true;
    }
</script>
 <script>
      function hitung2() {
      var a = $(".a2").val();
      var b = $(".b2").val();
      c = a - b;
      $(".c2").val(c);
      }
      function isNumberKey(evt){
       var charCode = (evt.which) ? evt.which : event.keyCode;
       if (charCode != 46 && charCode > 31 && (charCode < 48 || charCode > 57))
       return false;
       return true;
      }
</script>

</body>
</html>