<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="row justify-content-around">
        <div class="col-12">
            <div class="card mb-3" style="max-width: 54rem;">
                <div class="row no-gutters">
                    <?php
                    foreach ($wisata as $w) { ?>
                        <div class="col-md-4">
                            <img src="<?= base_url('assets/img/upload/') . $w['image']; ?>" class="card-img" alt="...">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title">Wisata <?= $w['nama_wisata']; ?></h5>
                                <form action="<?= base_url('wisata/ubahWisata'); ?>" method="post" enctype="multipart/form-data">
                                    <input type="hidden" name="old_pict" value="<?= $w['image']; ?>">
                                    <input type="hidden" name="id" value="<?= $w['id']; ?>">
                                    <div class="form-group">
                                        <label for="nama_wisata">Nama Wisata</label>
                                        <input type="text" class="form-control formcontrol-user" id="nama_wisata" name="nama_wisata" placeholder="Masukkan Nama Wisata" value="<?= $w['nama_wisata']; ?>">
                                    </div>

                                    <div class="form-group">
                                        <select name="id_kategori" class="custom-select form-control-user">
                                            <option value="">Pilih Kategori</option>
                                            <?php foreach ($kategori as $k) : ?>
                                                <?php if ($k['id'] == $w['id_kategori']) : ?>
                                                    <option value="<?= $k['id']; ?>" selected><?= $k['kategori']; ?></option>
                                                <?php else : ?>
                                                    <option value="<?= $k['id']; ?>"><?= $k['kategori']; ?></option>
                                                <?php endif; ?>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <input type="text" class="form-control form-control-user" id="alamat" name="alamat" placeholder="Masukkan alamat" value="<?= $w['alamat']; ?>">
                                    </div>

                                    <div class="form-group">
                                        <input type="text" class="form-control formcontrol-user" id="keterangan" name="keterangan" placeholder="Masukkan keterangan" value="<?= $w['keterangan']; ?>">
                                    </div>

                                    <div class="form-group">
                                        <input type="text" class="form-control formcontrol-user" id="harga_tiket" name="harga_tiket" placeholder="Masukkan harga tiket" value="<?= $w['harga_tiket']; ?>">
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-4">
                                            <label for="image">Pilih Gambar</label>
                                        </div>
                                        <div class="col-3">

                                            <input type="file" id="image" name="image">
                                        </div>
                                    </div>
                                <?php } ?>

                                <div class="form-group float-right mt-3">
                                    <a href="<?= base_url('wisata'); ?>" class="btn btn-secondary"><i class="fas fa-ban"></i> Batal</a>
                                    <button type="submit" class="btn btn-primary"><i class="fas fa-edit"></i> Edit</button>
                                </div>
                                </form>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>

</div>
<!-- End of Main Content -->