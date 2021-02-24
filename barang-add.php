<?php 
  include '_header.php';
  include '_nav.php';
  include '_sidebar.php'; 
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

// cek apakah tombol submit sudah ditekan atau belum
if( isset($_POST["submit"]) ){
  // var_dump($_POST);

  // cek apakah data berhasil di tambahkan atau tidak
  if( tambahBarang($_POST) > 0 ) {
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
            <h1>Tambah Data Barang</h1>
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
                        <div class="form-group">
                          <label for="barang_kode">Kode Barang</label>
                          <input type="text" name="barang_kode" class="form-control" id="barang_kode" placeholder="Contoh: lpt001" required>
                        </div>
                        <div class="form-group">
                            <label for="barang_nama">Nama Barang</label>
                            <input type="text" name="barang_nama" class="form-control" id="barang_nama" placeholder="Input Nama Barang" required>
                        </div>
                        <div class="form-group">
                            <label for="barang_deskripsi">Deskripsi</label>
                            <textarea name="barang_deskripsi" id="barang_deskripsi" class="form-control" rows="5" required="required" placeholder="Deskripsi Lengkap"></textarea>
                        </div>
                    </div>

                    <div class="col-md-6 col-lg-6">
                      <div class="form-group">
                            <label for="barang_harga">Harga Jual</label>
                            <input type="number" name="barang_harga" class="form-control" id="barang_harga" placeholder="Input Harga Barang" onkeypress="return hanyaAngka(event)" >
                        </div>
                        <div class="form-group ">
                            <label for="kategori_id" class="">Kategori</label>
                            <div class="">
                              <?php $data = query("SELECT * FROM kategori ORDER BY kategori_id DESC"); ?>
                              <select name="kategori_id" required="" class="form-control ">
                                  <option value="">--Pilih Kategori--</option>
                                  <?php foreach ( $data as $row ) : ?>
                                    <?php if ( $row['kategori_status'] === '1' ) { ?>
                                      <option value="<?= $row['kategori_id']; ?>">
                                        <?= $row['kategori_nama']; ?> 
                                      </option>
                                    <?php } ?>
                                  <?php endforeach; ?>
                              </select>
                            </div>
                          </div>
                          <div class="form-group ">
                              <label for="satuan_id">Satuan</label>
                              <div class="">
                                <?php $data2 = query("SELECT * FROM satuan ORDER BY satuan_id DESC"); ?>
                                  <select name="satuan_id" required="" class="form-control ">
                                    <option value="">-- Satuan --</option>
                                    <?php foreach ( $data2 as $row ) : ?>
                                      <?php if ( $row['satuan_status'] === '1' ) { ?>
                                        <option value="<?= $row['satuan_id']; ?>">
                                          <?= $row['satuan_nama']; ?>
                                        </option>
                                      <?php } ?>
                                    <?php endforeach; ?>
                                  </select>
                              </div>
                          </div>
                        <div class="form-group">
                          <label for="barang_stock">Stock</label>
                          <input type="text" name="barang_stock" class="form-control" id="barang_stock" placeholder="Input Jumlah Stock" required>
                        </div>
                        <div class="form-group ">
                              <label for="satuan_id">Status</label>
                              <div class="">
                               
                                  <select name="barang_status" required="" class="form-control ">
                                   
                                        <option value="publish">Publish</option>
                                        <option value="draft">Draft</option>
                                    
                                  </select>
                              </div>
                          </div>
                    </div>
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer text-right">
                  <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>


  </div>


<?php include '_footer.php'; ?>
<script>
    function hanyaAngka(evt) {
      var charCode = (evt.which) ? evt.which : event.keyCode
       if (charCode > 31 && (charCode < 48 || charCode > 57))
 
        return false;
      return true;
    }
</script>