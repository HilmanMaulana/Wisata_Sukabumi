<!-- Begin Page Content -->
<div class="container-fluid">

    <?= $this->session->flashdata('pesan'); ?>
    <div class="row">
        <div class="col-lg-12">
            <?php if(validation_errors()){?>
                <div class="alert alert-danger" role="alert">
                    <?= validation_errors();?>
                </div>
            <?php }?>
            <?= $this->session->flashdata('pesan'); ?>
            <a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#wisataBaruModal"><i class="fas fa-th-list"></i> Tempat Wisata Baru</a>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nama Wisata</th>
                        <th scope="col">Alamat</th>
                        <th scope="col">Keterangan</th>
                        <th scope="col">Harga Tiket</th>
                        <th scope="col">Gambar</th>
                        <th scope="col">Pilihan</th>
                    </tr>
                </thead>
                <tbody>

                    <?php
                        $a = 1;
                        foreach ($wisata as $w) { ?>
                    <tr>
                        <th scope="row"><?= $a++; ?></th>
                        <td><?= $w['nama_wisata']; ?></td>
                        <td><?= $w['alamat']; ?></td>
                        <td><?= $w['keterangan']; ?></td>
                        <td><?= $w['harga_tiket']; ?></td>
                        <td>
                            <picture>
                                <source srcset="" type="image/svg+xml">
                                <img src="<?= base_url('assets/img/upload/') . $w['image'];?>" class="img-fluid img-thumbnail" alt="..." width="150px">
                            </picture></td>
                        <td>
                            <a href="<?= base_url('wisata/ubahWisata/').$w['id'];?>" class="badge badge-info"><i class="fas fa-edit"></i> Ubah</a>
                            <a href="<?= base_url('wisata/hapuswisata/').$w['id'];?>" onclick="return confirm('Kamu yakin akan menghapus <?= $judul.' '.$w['nama_wisata'];?> ?');" class="badge badge-danger"><i class="fas fa-trash"></i> Hapus</a>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<!-- Modal Tambah wisata baru-->
<div class="modal fade" id="wisataBaruModal" tabindex="-1" role="dialog" aria-labelledby="wisataBaruModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="wisataBaruModalLabel">Tambah Tempat Wisata</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('wisata'); ?>" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control form-control-user" id="nama_wisata" name="nama_wisata" placeholder="Masukkan Nama Wisata">
                    </div>
                    <div class="form-group">
                        <select name="id_kategori" class="form-control form-control-user">
                            <option value="">Pilih Kategori</option>
                            <?php
                            foreach ($kategori as $k) { ?>
                            <option value="<?= $k['id'];?>"><?= $k['kategori'];?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control form-control-user" id="alamat" name="alamat" placeholder="Masukkan alamat">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control form-control-user" id="keterangan" name="keterangan" placeholder="Masukkan keterangan">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control form-control-user" id="harga_tiket" name="harga_tiket" placeholder="Masukkan harga tiket">
                    </div>
                    <div class="form-group">
                        <input type="file" class="form-control form-control-user" id="image" name="image">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-ban"></i> Close</button>
                    <button type="submit" class="btn btn-primary"><i class="fas fa-plus-circle"></i> Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- End of Modal Tambah Mneu -->

