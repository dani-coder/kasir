<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="bo" class="brand-link">
      <img src="dist/img/Gotosovie_logo.png" alt="AdminLTE Logo" class="brand-image ">
      <span class="brand-text font-weight-light">Gotosovie - POS</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="dist/img/avatar04.png" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block"><?= $_SESSION['user_nama']; ?></a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item">
            <a href="bo" class="nav-link">
              <i class="nav-icon fa fa-desktop"></i> 
              <p>
                 Dashboard
              </p>
            </a>
          </li>

          <?php if ( $levelLogin !== "kasir" ) { ?>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fa fa-university"></i>
              <p>
                Master
                <i class="fas fa-angle-left right"></i>
                <!-- <span class="badge badge-info right">4</span> -->
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="kategori" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Kategori</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="satuan" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Satuan</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="barang" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Barang</p>
                </a>
              </li>
              <!-- <li class="nav-item">
                <a href="ekspedisi" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Ekspedisi</p>
                </a>
              </li> -->
            </ul>
          </li>
          <?php } ?>

          <li class="nav-item">
            <a href="customer" class="nav-link">
              <i class="nav-icon fa fa-address-book-o"></i> 
              <p>
                 Customer
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="beli-langsung" class="nav-link">
              <i class="nav-icon fa fa-shopping-cart"></i> 
              <p>
                 Kasir
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="penjualan" class="nav-link">
              <i class="nav-icon fa fa-table"></i> 
              <p>
                 Penjualan
              </p>
            </a>
          </li>

          <!-- <?php if ( $levelLogin !== "kasir" ) { ?>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fa fa-shopping-bag"></i>
              <p>
                Pembelian Produk
                <i class="fas fa-angle-left right"></i>
                <span class="badge badge-info right">3</span>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="supplier" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Supplier</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="transaksi-pembelian" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Transaksi</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pembelian" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Data Pembelian</p>
                </a>
              </li>
            </ul>
          </li>
          <?php } ?> -->


          <?php if ( $levelLogin !== "kasir" ) { ?>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fa fa-file"></i>
              <p>
                Laporan
                <i class="fas fa-angle-left right"></i>
                <!-- <span class="badge badge-info right">9</span> -->
              </p>
            </a>
            <ul class="nav nav-treeview">
            <li class="nav-item">
                <a href="periode" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Penjualan Per Periode</p>
                </a>
              </li>
              <!--  <li class="nav-item">
                <a href="laporan-kasir" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Kasir</p>
                </a>
              </li>
             <li class="nav-item">
                <a href="laporan-customer" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Customer</p>
                </a>
              </li> 
              
              <li class="nav-item">
                <a href="edit-transaksi" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Penjualan Retur</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="laporan-supplier" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Supplier</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="periode-pembelian" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Pembelian Per Periode</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="edit-transaksi-pembelian" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Pembelian Retur</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="terlaris" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Terlaris</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="stok" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Stok</p>
                </a>
              </li>-->
            </ul>
          </li>
          <?php } ?>

          <?php if ( $levelLogin === "super admin" ) { ?>
          <li class="nav-header">SETTINGS</li>
          <li class="nav-item">
            <a href="users" class="nav-link">
              <i class="nav-icon fa fa-users"></i> 
              <p>
                 Users
              </p>
            </a>
          </li>
          <?php  
            $toko = query("SELECT * FROM toko WHERE toko_id = 1");
          ?>
          <?php foreach ( $toko as $row ) : ?>
            <?php 
              $toko_id = $row['toko_id']; 
              $toko_nama = $row['toko_nama']; 
            ?>
          <?php endforeach; ?>
          <?php  
            $namaToko = str_replace(" ", "-", $toko_nama)
          ?>
          <li class="nav-item">
            <a href="toko?no=<?= $toko_id; ?>-nama-toko-<?= $namaToko; ?>" class="nav-link">
              <i class="nav-icon fa fa-id-card-o"></i> 
              <p>
                 Toko
              </p>
            </a>
          </li>
          <?php } ?>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>