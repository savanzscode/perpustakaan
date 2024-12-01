<section class="content-header">
    <h1 style="text-align:center;">
        Riwayat Pengembalian Buku
    </h1>
    <ol class="breadcrumb">
        <li>
            <a href="index.php">
                <i class="fa fa-home"></i>
                <b>Si Perpustakaan</b>
            </a>
        </li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="box box-primary">
        <!-- /.box-header -->
        <div class="box-body">
            <div class="table-responsive">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Buku</th>
                            <th>Peminjam</th>
                            <th>Tgl Di kembalikan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        // Modified SQL query with IFNULL handling for NULL dates
                        $sql = $koneksi->query("SELECT b.judul_buku, a.id_anggota, a.nama, s.tgl_kembali, IFNULL(s.tgl_kembali, 'Belum Dikembalikan') as tgl_kembali
                                                FROM tb_sirkulasi s
                                                INNER JOIN tb_buku b ON s.id_buku = b.id_buku
                                                INNER JOIN tb_anggota a ON s.id_anggota = a.id_anggota
                                                WHERE status = 'KEM' ORDER BY tgl_kembali ASC");
                        while ($data = $sql->fetch_assoc()) {
                        ?>
                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td><?php echo $data['judul_buku']; ?></td>
                            <td><?php echo $data['id_anggota']; ?> - <?php echo $data['nama']; ?></td>
                            <td>
                                <?php
                                // Check if the return date exists before formatting
                                if ($data['tgl_kembali'] != 'Belum kembali') {
                                    echo date("d/M/Y", strtotime($data['tgl_kembali']));
                                } else {
                                    echo $data['tgl_kembali']; // Show 'Belum Dikembalikan' if no return date
                                }
                                ?>
                            </td>
                        </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
