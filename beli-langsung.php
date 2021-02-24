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
  if( tambahKeranjang($_POST) > 0 ) {
    echo "
      <script>
        document.location.href = 'beli-langsung';
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
  if ( updateQTY($_POST) === 0 ) {
    echo "
      <script>
        alert('Anda Belum Input Nominal QTY !!!!!');
      </script>
    ";
  } elseif( updateQTY($_POST) > 0 ) {
    echo "
      <script>
        document.location.href = 'beli-langsung';
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
$inv = $_POST["penjualan_invoice2"];
if( isset($_POST["updateStock"]) ){
  // var_dump($_POST);

  // cek apakah data berhasil di tambahkan atau tidak
  if( updateStock($_POST) > 0 ) {
    echo "
      <script>
        document.location.href = 'invoice?no=".$inv."';
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
            <h1>Transaksi Kasir</h1>
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
      $keranjang = query("SELECT * FROM keranjang ORDER BY keranjang_id ASC");
      $penjualan = mysqli_query($conn,"select * from invoice");
      $jmlPenjualan = mysqli_num_rows($penjualan);
      $jmlPenjualan1 = $jmlPenjualan + 1;
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
                        $di = $today.$jmlPenjualan1;
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
            <div class="card-body">
              <div class="table-auto">
                <table id="" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th style="width: 6%;">No.</th>
                  <th>Nama</th>
                  <th>Harga</th>
                  <th style="text-align: center;">QTY</th>
                  <th style="width: 20%;">Sub Total</th>
                  <th style="text-align: center;">Aksi</th>
                </tr>
                </thead>
                <tbody>
                <?php 
                  $i=1; 
                  $total = 0;
                ?>
                <?php 
                  foreach($keranjang as $row) : 

                  $bik = $row['barang_id'];
                  $stockParent = mysqli_query( $conn, "select barang_stock from barang where barang_id = '".$bik."'");
                  $brg = mysqli_fetch_array($stockParent); 
                  $tb_brg = $brg['barang_stock'];

                  $sub_total = +$row['keranjang_harga'] * $row['keranjang_qty'];
        
                  if ( $row['keranjang_id_kasir'] === $_SESSION['user_id'] ) {
                  $total += $sub_total;
                ?>
                <tr>
                    <td><?= $i; ?></td>
                    <td><?= $row['keranjang_nama'] ?></td>
                    <td>Rp. <?= number_format($row['keranjang_harga'], 0, ',', '.'); ?></td>
                    <td style="text-align: center; width: 11%;">
                      <form role="form" action="" method="post">
                        <input type="hidden" name="keranjang_id" value="<?= $row['keranjang_id']; ?>">
                        <input type="number" min="1" name="keranjang_qty" value="<?= $row['keranjang_qty'] ?>" onkeypress="return hanyaAngka(event)" style="text-align: center; width: 60%;"> 
                        <input type="hidden" name="stock_brg" value="<?= $tb_brg; ?>">
                        <button class=" btn-primary" type="submit" name="update">
                            <i class="fa fa-refresh"></i>
                        </button>
                      </form>
                    </td>
                    <td>Rp. <?= number_format($sub_total, 0, ',', '.'); ?></td>
                    <td style="text-align: center; width: 6%;">
                        <a href="beli-langsung-delete?id=<?= $row['keranjang_id'] ?>" title="Delete Data">
                            <button class="btn btn-danger" type="submit" name="hapus">
                                <i class="fa fa-trash-o"></i>
                            </button>
                        </a>
                    </td>
                </tr>
                <?php $i++; ?>
                <?php } ?>
                <?php endforeach; ?>
              </table>
              </div>
              
       
              <div class="btn-transaksi">
                <form role="form" action="" method="POST">
                  <div class="row">
                    <div class="col-md-6 col-lg-7">
                        <div class="filter-customer">
                          <div class="form-group">
                          <label>Customer</label>
                          <select class="form-control select2bs4" required="" name="invoice_customer">
                            <option selected="selected" value="">-- Pilih Customer --</option>
                            <option value="0">Umum</option>
                            <?php  
                              $customer = query("SELECT * FROM customer WHERE customer_status = '1' ORDER BY customer_id DESC ");
                            ?>
                            <?php foreach ( $customer as $ctr ) : ?>
                              <?php if ( $ctr['customer_id'] != 0 ) { ?>
                              <option value="<?= $ctr['customer_id'] ?>"><?= $ctr['customer_nama'] ?></option>
                              <?php } ?>
                            <?php endforeach; ?>
                          </select>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6 col-lg-5">
                      <div class="invoice-table">
                        <table class="table">
                          <tr>
                              <td><b>Total</b></td>
                              <td class="table-nominal">
                                 <!-- Rp. <?php echo number_format($total, 0, ',', '.'); ?> -->
                                 <span>Rp. </span>
                                 <span>
                                    <input type="text" name="invoice_total" id="angka2" class="b2" onkeyup="hitung2();" value="<?= $total; ?>" onkeyup="return isNumberKey(event)" size="10" readonly>
                                 </span>
                                 
                              </td>
                          </tr>
                          <tr>
                              <td><b>Bayar</b></td>
                              <td class="table-nominal tn">
                                 <span>Rp.</span> 
                                 <span>
                                   <input type="text" name="angka1" id="angka1" class="a2" autocomplete="off" onkeyup="hitung2();" required="" onkeyup="return isNumberKey(event)" onkeypress="return hanyaAngka1(event)" size="10">
                                 </span>
                              </td>
                          </tr>
                          <tr>
                              <td>Kembali</td>
                              <td class="table-nominal">
                                <span>Rp.</span>
                                 <span>
                                  <input type="text" name="hasil" id="hasil" class="c2" readonly size="10" disabled>
                                </span>
                              </td>
                          </tr>
                          <tr>
                              <td></td>
                              <td>

                                <?php 
                                    foreach ($keranjang as $stk) : 
                                    if ( $stk['keranjang_id_kasir'] === $_SESSION['user_id'] ) {
                                ?>
                                  <input type="hidden" name="barang_ids[]" value="<?= $stk['barang_id']; ?>">
                                  <input type="hidden" min="1" name="keranjang_qty[]" value="<?= $stk['keranjang_qty'] ?>"> 
                                  <input type="hidden" name="keranjang_id_kasir[]" value="<?= $_SESSION['user_id']; ?>">

                                  <input type="hidden" name="kik" value="<?= $_SESSION['user_id']; ?>
                                  ">
                                  <input type="hidden" name="penjualan_invoice[]" value="<?= $di; ?>">
                                  <input type="hidden" name="penjualan_date[]" value="<?= date("Y-m-d") ?>">
                                <?php } ?>
                                <?php endforeach; ?>  
                                <input type="hidden" name="penjualan_invoice2" value="<?= $di; ?>">
                                <div class="payment">
                                  <button class="btn btn-primary" type="submit" name="updateStock">Proses <i class="fa fa-shopping-cart"></i></button>
                                </div>
                              </td>
                          </tr>
                        </table>
                      </div>
                    </div>
                  </div>
               </form>
              </div>
            </div>
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
      $data = query("SELECT * FROM barang WHERE barang_status='publish' ORDER BY barang_id DESC");
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
                        <th>Harga</th>
                        <th>Stock</th>
                        <th>Status</th>
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
                          <td>Rp. <?= number_format($row['barang_harga'], 0, ',', '.'); ?></td>
                          <td><?= $row['barang_stock'] ?></td>
                          <td><?= $row['barang_status'] ?></td>
                          <td style="text-align: center; width: 17%;">
                            <form role="form" action="" method="post">
                              <input type="hidden" name="barang_id" value="<?= $row["barang_id"]; ?>">
                              <input type="hidden" name="keranjang_nama" value="<?= $row['barang_nama'];  ?>">
                              <input type="hidden" name="keranjang_harga" value="<?= $row['barang_harga']; ?>">
                              <input type="hidden" name="keranjang_id_kasir" value="<?= $_SESSION['user_id']; ?>">
                              <?php 
                                if ( $row['barang_stock'] <= 0 ) {
                                  echo '
                                    <button class="btn btn-default" disabled="" title="Stok Habis">
                                      <i class="fa fa-shopping-cart"></i> Pilih
                                    </button>
                                  ';
                                } else {
                                  echo '
                                    <button class="btn btn-primary" type="submit" name="submit">
                                      <i class="fa fa-shopping-cart"></i> Pilih
                                    </button>
                                  ';
                                }

                              ?>
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


  
  

<?php include '_footer.php'; ?>

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
<script>
  $(function () {

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })
  });
</script>
</body>
</html>