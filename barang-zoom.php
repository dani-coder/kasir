<?php 
  include '_header.php';
  include '_nav.php';
  include '_sidebar.php'; 
  error_reporting(0);
?>
<?php  
  if ( $levelLogin === "kasir") {
    echo "
      <script>
        document.location.href = 'bo';
      </script>
    ";
  }
    
?>
<?php  
// ambil data di URL
$id = abs((int)$_GET['id']);

// query data mahasiswa berdasarkan id
$barang = query("SELECT * FROM barang WHERE barang_id = $id ")[0];

// cek apakah tombol submit sudah ditekan atau belum
if( isset($_POST["submit"]) ){
  // var_dump($_POST);

  // cek apakah data berhasil di tambahkan atau tidak
  if( editBarang($_POST) > 0 ) {
    echo "
      <script>
        document.location.href = 'barang';
      </script>
    ";
  } else {
    echo "
      <script>
        alert('data gagal ditambahkan');
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
            <h1>Edit Data Barang</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="bo">Home</a></li>
              <li class="breadcrumb-item active">Data Barang</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Data Barang</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" action="" method="post">
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-6 col-lg-6">
                        <input type="hidden" name="barang_id" value="<?= $barang['barang_id']; ?>">
                        <div class="form-group">
                          <label for="barang_kode">Kode Barang</label>
                          <input type="text" name="barang_kode" class="form-control" id="barang_kode" value="<?= $barang['barang_kode']; ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label for="barang_nama">Nama Barang</label>
                            <input type="text" name="barang_nama" class="form-control" id="barang_nama" value="<?= $barang['barang_nama']; ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label for="barang_deskripsi">Deskripsi</label>
                            <textarea name="barang_deskripsi" id="barang_deskripsi" class="form-control" rows="5" readonly="readonly" ><?= $barang['barang_deskripsi']; ?></textarea>
                        </div>
                        <div class="form-group">
                            <label for="barang_tanggal">Tanggal Input</label>
                            <input type="text" name="barang_tanggal" class="form-control" id="barang_tanggal" value="<?= $barang['barang_tanggal']; ?>" readonly>
                        </div>
                    </div>

                    <div class="col-md-6 col-lg-6">
                      <!-- <div class="form-group">
                            <label for="barang_harga_beli">Harga Beli</label>
                            <?php  
                              $bik = $barang['barang_id'];

                              $hargaBeli = query("SELECT * FROM pembelian WHERE barang_id = $bik ORDER BY pembelian_id DESC LIMIT 1")[0];

                              $brg = $hargaBeli['barang_harga_beli'];
                            ?>
                            <?php  
                                if ( $brg < 1 ) {
                                  $bhb = "-";
                                } else {
                                  $bhb = $brg;
                                }
                            ?> 
                            <input type="text" name="barang_harga_beli" class="form-control" id="barang_harga" value="<?= $bhb; ?>" readonly>
                        </div> -->

                        <div class="form-group">
                            <label for="barang_harga">Harga Jual</label>
                            <input type="text" name="barang_harga" class="form-control" id="barang_harga" value="<?= $barang['barang_harga']; ?>" readonly>
                        </div>

                        <div class="form-group ">
                            <label for="kategori_id" class="">Kategori</label>
                            <div class="">
                              <select name="kategori_id" readonly="" class="form-control ">
                                <?php  
                                    $kategori = $barang['kategori_id'];
                                    $kategoriParent = mysqli_query( $conn, "select kategori_nama from kategori where kategori_id = '".$kategori."'");
                                    $kn = mysqli_fetch_array($kategoriParent); 
                                    $nKn = $kn['kategori_nama'];
                                ?>

                                  <option value="<?= $kategori; ?>"><?= $nKn; ?></option>

                                  <?php $data = query("SELECT * FROM kategori ORDER BY kategori_id DESC"); ?>
                                  <?php foreach ( $data as $row ) : ?>
                                    <?php if ( $row['kategori_status'] === '1' ) { ?>
                                    <?php if ( $row['kategori_id'] !== $barang['kategori_id'] ) { ?>
                                      <option value="<?= $row['kategori_id']; ?>">
                                        <?= $row['kategori_nama']; ?> 
                                      </option>
                                    <?php } ?>
                                    <?php } ?>
                                  <?php endforeach; ?>
                              </select>
                            </div>
                          </div>
                          <div class="form-group ">
                              <label for="satuan_id">Satuan</label>
                              <div class="">
                                  <select name="satuan_id" readonly="" class="form-control ">
                                  <?php  
                                    $satuan = $barang['satuan_id'];
                                    $satuanParent = mysqli_query( $conn, "select satuan_nama from satuan where satuan_id = '".$satuan."'");
                                    $sn = mysqli_fetch_array($satuanParent); 
                                    $nSn = $sn['satuan_nama'];
                                ?>

                                  <option value="<?= $satuan; ?>"><?= $nSn; ?></option>

                                  <?php $data1 = query("SELECT * FROM satuan ORDER BY satuan_id DESC"); ?>
                                  <?php foreach ( $data1 as $row ) : ?>
                                    <?php if ( $row['satuan_status'] === '1' ) { ?>
                                    <?php if ( $row['satuan_id'] !== $barang['satuan_id'] ) { ?>
                                      <option value="<?= $row['satuan_id']; ?>">
                                        <?= $row['satuan_nama']; ?> 
                                      </option>
                                    <?php } ?>
                                    <?php } ?>
                                  <?php endforeach; ?>
                              </select>
                              </div>
                          </div>
                        <div class="form-group">
                          <label for="barang_stock">Stock</label>
                          <input type="text" name="barang_stock" class="form-control" id="barang_stock" value="<?= $barang['barang_stock']; ?>" readonly>
                        </div>
                        <div class="form-group">
                          <label>Status</label>
                          <input type="text" name="barang_status" class="form-control"  value="<?= $barang['barang_status']; ?>" readonly>
                        </div>
                    </div>
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer text-right">
                  <a href="barang" class="btn btn-success">Kembali</a>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>


  </div>


<?php include '_footer.php'; ?>