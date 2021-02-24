<?php 
  include 'aksi/halau.php'; 
  include 'aksi/functions.php';
?>

	<?php  
      $keranjang = query("SELECT * FROM keranjang_pembelian ORDER BY keranjang_id ASC");

      $pembelian = mysqli_query($conn,"select * from invoice_pembelian");
      $jmlPembelian = mysqli_num_rows($pembelian);
      $jmlPembelian1 = $jmlPembelian + 1;
    ?>
    <?php  
        $today = date("Ymd");
        $di = $today.$jmlPembelian1;
    ?>

			<div class="card-body">
              <div class="table-auto">
                <table id="" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th style="width: 6%;">No.</th>
                  <th>Nama</th>
                  <th>Harga Beli</th>
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
                    <td>
                    	Rp. <?= number_format($row['keranjang_harga'], 0, ',', '.'); ?>
                    	<span class="keranjang-right">
                    		<button class=" btn-success" name="" class="keranjang-pembelian" id="keranjang-pembelian" data-id="<?= $row['keranjang_id']; ?>">
                            <i class="fa fa-edit"></i>
                        </button>	
                    	</span>
                    </td>
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
                        <a href="transaksi-pembelian-delete?id=<?= $row['keranjang_id'] ?>" title="Delete Data">
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
                          <label>Supplier</label>
                          <select class="form-control select2bs4" required="" name="invoice_supplier">
                            <option selected="selected" value="">-- Pilih Supplier --</option>
                            <?php  
                              $supplier = query("SELECT * FROM supplier WHERE supplier_status = '1' ORDER BY supplier_id DESC ");
                            ?>
                            <?php foreach ( $supplier as $ctr ) : ?>
                              <option value="<?= $ctr['supplier_id'] ?>">
                              	<?= $ctr['supplier_nama']; ?> - <?= $ctr['supplier_company']; ?>	
                              </option>
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
                                  <input type="hidden" name="pembelian_invoice[]" value="<?= $di; ?>">
                                  <input type="hidden" name="pembelian_date[]" value="<?= date("Y-m-d") ?>">
                                  <input type="hidden" name="barang_harga_beli[]" value="<?= $stk['keranjang_harga']; ?>">
                                <?php } ?>
                                <?php endforeach; ?>  
                                <input type="hidden" name="pembelian_invoice2" value="<?= $di; ?>">
                                <div class="payment">
                                  <?php  
                                  	 $idKasir = $_SESSION['user_id'];
                                  	 $keranjang = mysqli_query($conn,"select keranjang_harga from keranjang_pembelian where keranjang_harga < 1 && keranjang_id_kasir = ".$idKasir." ");
    								 $jmlKeranjang = mysqli_num_rows($keranjang);
                                  ?>

                                  <?php if ( $jmlKeranjang < 1 ) { ?>
                                  <button class="btn btn-primary" type="submit" name="updateStock">Simpan Payment <i class="fa fa-shopping-cart"></i></button>
                                  <?php } ?>

                                  <?php if ( $jmlKeranjang > 0 ) { ?>
                                  <a class="btn btn-default btn-disabled" type="" name="">Simpan Payment <i class="fa fa-shopping-cart"></i></a>
                                  <?php } ?>
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


<script>
  $(function () {

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })
  });

  $(document).ready(function(){
  	 $('.btn-disabled').click(function(){
	  	alert("Harga Beli Masih ada yang bernilai kosong (Rp.0) !! Segera Update Harga Pembelian Barang per Produk ..");
	  });
  });
</script>

