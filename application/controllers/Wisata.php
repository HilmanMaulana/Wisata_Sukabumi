<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Wisata extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        cek_login();
    }

    //manajemen wisata
    public function index()
    {
        $data['judul'] = 'Wisata Alam';
        $data['user'] = $this->ModelUser->cekData(['email' => $this->session->userdata('email')])->row_array();
        $data['wisata'] = $this->ModelWisata->getWisata()->result_array();
        $data['kategori'] = $this->ModelWisata->getKategori()->result_array();

        $this->form_validation->set_rules('nama_wisata', 'Nama Wisata', 'required|min_length[3]', [
            'required' => 'Nama Wisata harus diisi',
            'min_length' => 'Nama Wisata terlalu pendek'
        ]);

        $this->form_validation->set_rules('id_kategori', 'Kategori', 'required', [
            'required' => 'Alamat harus diisi',
        ]);

        $this->form_validation->set_rules('alamat', 'Alamat', 'required|min_length[3]', [
            'required' => 'Alamat harus diisi',
            'min_length' => 'Alamat terlalu pendek'
        ]);

        $this->form_validation->set_rules('keterangan', 'Keterangan Wisata', 'required|min_length[3]', [
            'required' => 'Keterangan harus diisi',
            'min_length' => 'Keterangan terlalu pendek'
        ]);

        $this->form_validation->set_rules('harga_tiket', 'Harga Tiket', 'required|min_length[2]|max_length[10]|numeric', [
            'required' => 'Harga Tiket harus diisi',
            'min_length' => 'Harga Tiket terlalu pendek',
            'max_length' => 'Harga Tiket terlalu panjang',
            'numeric' => 'Hanya boleh diisi angka'
        ]);


        //konfigurasi sebelum gambar diupload
        $config['upload_path'] = './assets/img/upload/';
        $config['allowed_types'] = 'jpg|png|jpeg';
        $config['max_size'] = '3000';
        $config['max_width'] = '1024';
        $config['max_height'] = '1000';
        $config['file_name'] = 'img' . time();

        $this->load->library('upload', $config);

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('wisata/index', $data);
            $this->load->view('templates/footer');
        } else {
            if ($this->upload->do_upload('image')) {
                $image = $this->upload->data();
                $gambar = $image['file_name'];
            } else {
                $gambar = '';
            }

            $data = [
                'nama_wisata' => $this->input->post('nama_wisata', true),
                'id_kategori' => $this->input->post('id_kategori', true),
                'alamat' => $this->input->post('alamat', true),
                'keterangan' => $this->input->post('keterangan', true),
                'harga_tiket' => $this->input->post('harga_tiket', true),
                'image' => $gambar
            ];

            $this->ModelWisata->simpanWisata($data);
            redirect('wisata');
        }
    }


    public function ubahWisata()
    {
        $data['judul'] = 'Ubah Data Wisata';
        $data['user'] = $this->ModelUser->cekData(['email' => $this->session->userdata('email')])->row_array();
        $data['wisata'] = $this->ModelWisata->wisataWhere(['id' => $this->uri->segment(3)])->result_array();
        $kategori = $this->ModelWisata->joinKategoriWisata(['wisata.id' => $this->uri->segment(3)])->result_array();
        foreach ($kategori as $k) {
            $data['id'] = $k['id_kategori'];
            $data['k'] = $k['kategori'];
        }
        $data['kategori'] = $this->ModelWisata->getKategori()->result_array();

        $this->form_validation->set_rules('nama_wisata', 'Nama Wisata', 'required|min_length[3]', [
            'required' => 'Nama Wisata harus diisi',
            'min_length' => 'Nama Wisata terlalu pendek'
        ]);
        $this->form_validation->set_rules('id_kategori', 'Kategori', 'required', [
            'required' => 'Alamat harus diisi',
        ]);

        $this->form_validation->set_rules('alamat', 'Alamat', 'required|min_length[3]', [
            'required' => 'Alamat harus diisi',
            'min_length' => 'Alamat terlalu pendek'
        ]);

        $this->form_validation->set_rules('keterangan', 'Keterangan Wisata', 'required|min_length[3]', [
            'required' => 'Keterangan harus diisi',
            'min_length' => 'Keterangan terlalu pendek'
        ]);

        $this->form_validation->set_rules('harga_tiket', 'Harga Tiket', 'required|min_length[2]|max_length[10]|numeric', [
            'required' => 'Harga Tiket harus diisi',
            'min_length' => 'Harga Tiket terlalu pendek',
            'max_length' => 'Harga Tiket terlalu panjang',
            'numeric' => 'Hanya boleh diisi angka'
        ]);

        //konfigurasi sebelum gambar diupload
        $config['upload_path'] = './assets/img/upload/';
        $config['allowed_types'] = 'jpg|png|jpeg';
        $config['max_size'] = '3000';
        $config['max_width'] = '1024';
        $config['max_height'] = '1000';
        $config['file_name'] = 'img' . time();

        //memuat atau memanggil library upload
        $this->load->library('upload', $config);

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('wisata/ubah_wisata', $data);
            $this->load->view('templates/footer');
        } else {
            if ($this->upload->do_upload('image')) {
                $image = $this->upload->data();
                unlink('assets/img/upload/' . $this->input->post('old_pict', TRUE));
                $gambar = $image['file_name'];
            } else {
                $gambar = $this->input->post('old_pict', TRUE);
            }

            $data = [
                'nama_wisata' => $this->input->post('nama_wisata', true),
                'id_kategori' => $this->input->post('id_kategori', true),
                'alamat' => $this->input->post('alamat', true),
                'keterangan' => $this->input->post('keterangan', true),
                'harga_tiket' => $this->input->post('harga_tiket', true),
                'image' => $gambar
            ];
            $this->ModelWisata->updateWisata($data, ['id' => $this->input->post('id')]);
            redirect('wisata');
        }
    }

    public function hapusWisata()
    {
        $where = ['id' => $this->uri->segment(3)];
        $this->ModelWisata->hapusWisata($where);
        redirect('wisata');
    }



    //Wisata Sejarah
    public function wisata_sejarah(){
        $data['judul'] = 'Wisata Sejarah';
        $data['user'] = $this->ModelUser->cekData(['email' => $this->session->userdata('email')])->row_array();
        $data['wisata_sejarah'] = $this->ModelWisata->getWisataSejarah()->result_array();
        $data['kategori'] = $this->ModelWisata->getKategori()->result_array();

        $this->form_validation->set_rules('nama_wisata', 'Nama Wisata', 'required|min_length[3]', [
            'required' => 'Nama Wisata harus diisi',
            'min_length' => 'Nama Wisata terlalu pendek'
        ]);

        $this->form_validation->set_rules('id_kategori', 'Kategori', 'required', [
            'required' => 'Alamat harus diisi',
        ]);

        $this->form_validation->set_rules('alamat', 'Alamat', 'required|min_length[3]', [
            'required' => 'Alamat harus diisi',
            'min_length' => 'Alamat terlalu pendek'
        ]);

        $this->form_validation->set_rules('keterangan', 'Keterangan Wisata', 'required|min_length[3]', [
            'required' => 'Keterangan harus diisi',
            'min_length' => 'Keterangan terlalu pendek'
        ]);

        $this->form_validation->set_rules('harga_tiket', 'Harga Tiket', 'required|min_length[2]|max_length[10]|numeric', [
            'required' => 'Harga Tiket harus diisi',
            'min_length' => 'Harga Tiket terlalu pendek',
            'max_length' => 'Harga Tiket terlalu panjang',
            'numeric' => 'Hanya boleh diisi angka'
        ]);


        //konfigurasi sebelum gambar diupload
        $config['upload_path'] = './assets/img/upload/';
        $config['allowed_types'] = 'jpg|png|jpeg';
        $config['max_size'] = '3000';
        $config['max_width'] = '1024';
        $config['max_height'] = '1000';
        $config['file_name'] = 'img' . time();

        $this->load->library('upload', $config);

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('wisata_sejarah/index', $data);
            $this->load->view('templates/footer');
        } else {
            if ($this->upload->do_upload('image')) {
                $image = $this->upload->data();
                $gambar = $image['file_name'];
            } else {
                $gambar = '';
            }

            $data = [
                'nama_wisata' => $this->input->post('nama_wisata', true),
                'id_kategori' => $this->input->post('id_kategori', true),
                'alamat' => $this->input->post('alamat', true),
                'keterangan' => $this->input->post('keterangan', true),
                'harga_tiket' => $this->input->post('harga_tiket', true),
                'image' => $gambar
            ];

            $this->ModelWisata->simpanWisataSejarah($data);
            redirect('wisata/wisata_sejarah');
        }
    }


    public function ubahWisataSejarah()
    {
        $data['judul'] = 'Ubah Data Wisata Sejarah';
        $data['user'] = $this->ModelUser->cekData(['email' => $this->session->userdata('email')])->row_array();
        $data['wisata_sejarah'] = $this->ModelWisata->wisataSejarahWhere(['id' => $this->uri->segment(3)])->result_array();
        $kategori = $this->ModelWisata->joinKategoriWisataSejarah(['wisata_sejarah.id' => $this->uri->segment(3)])->result_array();
        foreach ($kategori as $k) {
            $data['id'] = $k['id_kategori'];
            $data['k'] = $k['kategori'];
        }
        $data['kategori'] = $this->ModelWisata->getKategori()->result_array();

        $this->form_validation->set_rules('nama_wisata', 'Nama Wisata', 'required|min_length[3]', [
            'required' => 'Nama Wisata harus diisi',
            'min_length' => 'Nama Wisata terlalu pendek'
        ]);
        $this->form_validation->set_rules('id_kategori', 'Kategori', 'required', [
            'required' => 'Alamat harus diisi',
        ]);

        $this->form_validation->set_rules('alamat', 'Alamat', 'required|min_length[3]', [
            'required' => 'Alamat harus diisi',
            'min_length' => 'Alamat terlalu pendek'
        ]);

        $this->form_validation->set_rules('keterangan', 'Keterangan Wisata', 'required|min_length[3]', [
            'required' => 'Keterangan harus diisi',
            'min_length' => 'Keterangan terlalu pendek'
        ]);

        $this->form_validation->set_rules('harga_tiket', 'Harga Tiket', 'required|min_length[2]|max_length[10]|numeric', [
            'required' => 'Harga Tiket harus diisi',
            'min_length' => 'Harga Tiket terlalu pendek',
            'max_length' => 'Harga Tiket terlalu panjang',
            'numeric' => 'Hanya boleh diisi angka'
        ]);

        //konfigurasi sebelum gambar diupload
        $config['upload_path'] = './assets/img/upload/';
        $config['allowed_types'] = 'jpg|png|jpeg';
        $config['max_size'] = '3000';
        $config['max_width'] = '1024';
        $config['max_height'] = '1000';
        $config['file_name'] = 'img' . time();

        //memuat atau memanggil library upload
        $this->load->library('upload', $config);

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('wisata_sejarah/ubah_wisata', $data);
            $this->load->view('templates/footer');
        } else {
            if ($this->upload->do_upload('image')) {
                $image = $this->upload->data();
                unlink('assets/img/upload/' . $this->input->post('old_pict', TRUE));
                $gambar = $image['file_name'];
            } else {
                $gambar = $this->input->post('old_pict', TRUE);
            }

            $data = [
                'nama_wisata' => $this->input->post('nama_wisata', true),
                'id_kategori' => $this->input->post('id_kategori', true),
                'alamat' => $this->input->post('alamat', true),
                'keterangan' => $this->input->post('keterangan', true),
                'harga_tiket' => $this->input->post('harga_tiket', true),
                'image' => $gambar
            ];
            $this->ModelWisata->updateWisataSejarah($data, ['id' => $this->input->post('id')]);
            redirect('wisata/wisata_sejarah');
        }
    }


    public function hapusWisataSejarah()
    {
        $where = ['id' => $this->uri->segment(3)];
        $this->ModelWisata->hapusWisataSejarah($where);
        redirect('wisata/wisata_sejarah');
    }


    //manajemen kategori
    public function kategori()
    {
        $data['judul'] = 'Kategori Wisata';
        $data['user'] = $this->ModelUser->cekData(['email' => $this->session->userdata('email')])->row_array();
        $data['kategori'] = $this->ModelWisata->getKategori()->result_array();

        $this->form_validation->set_rules('kategori', 'Kategori', 'required', [
            'required' => 'Nama Wisata harus diisi'
        ]);

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('wisata/kategori', $data);
            $this->load->view('templates/footer');
        } else {
        $data = [
            'kategori' => $this->input->post('kategori')
        ];

        $this->ModelWisata->simpanKategori($data);
        redirect('wisata/kategori');
        }
    }

    public function ubahKategori()
    {
        $data['judul']='Ubah Data Kategori';
        $data['user']=$this->ModelUser->cekData(['email'=>$this->session->userdata('email')])->row_array();
        $data['kategori']=$this->ModelWisata->kategoriWhere(['id'=>$this->uri->segment(3)])->result_array();
        
        $this->form_validation->set_rules('kategori', 'Nama Kategori', 'required|min_length[3]', [
            'required'=>'Nama Kategori Harus diisi',
            'min_length'=> 'Nama Terlalu Pendek'
        ]);

        if ($this->form_validation->run()==false)
        {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('wisata/ubahKategori', $data);
            $this->load->view('templates/footer');
        }
        else
        {
            $data=['kategori'=>$this->input->post('kategori', true)];
            $this->ModelWisata->updateKategori(['id'=>$this->input->post('id')], $data);
            redirect('wisata/kategori');
        }
    }

    public function hapusKategori()
    {
        $where = ['id' => $this->uri->segment(3)];
        $this->ModelWisata->hapusKategori($where);
        redirect('wisata/kategori');
    }

}