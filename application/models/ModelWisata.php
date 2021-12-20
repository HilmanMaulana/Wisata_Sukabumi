<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ModelWisata extends CI_Model
{
    //Manajemen Tempat Wisata
    public function getWisata()
    {
        return $this->db->get('wisata');
    }

    public function wisataWhere($where)
    {
        return $this->db->get_where('wisata', $where);
    }

    public function simpanWisata($data = null)
    {
        $this->db->insert('wisata', $data);
    }

    public function updateWisata($data = null, $where = null)
    {
        $this->db->update('wisata', $data, $where);
    }

    public function hapusWisata($where = null)
    {
        $this->db->delete('wisata', $where);
    }

    public function total($field, $where)
    {
        $this->db->select_sum($field);
        if(!empty($where) && count($where) > 0){
            $this->db->where($where);
        }
        $this->db->from('wisata');
        return $this->db->get()->row($field);
    }

    //Manajemen Wisata Sejarah
    public function getWisataSejarah()
    {
        return $this->db->get('wisata_sejarah');
    }

    public function wisataSejarahWhere($where)
    {
        return $this->db->get_where('wisata_sejarah', $where);
    }

    public function simpanWisataSejarah($data = null)
    {
        $this->db->insert('wisata_sejarah', $data);
    }

    public function updateWisataSejarah($data = null, $where = null)
    {
        $this->db->update('wisata_sejarah', $data, $where);
    }

    public function hapusWisataSejarah($where = null)
    {
        $this->db->delete('wisata_sejarah', $where);
    }

    public function totalSejarah($field, $where)
    {
        $this->db->select_sum($field);
        if(!empty($where) && count($where) > 0){
            $this->db->where($where);
        }
        $this->db->from('wisata_sejarah');
        return $this->db->get()->row($field);
    }

    //manajemen kategori
    public function getKategori()
    {
        return $this->db->get('kategori');
    }

    public function kategoriWhere($where)
    {
        return $this->db->get_where('kategori', $where);
    }

    public function simpanKategori($data = null)
    {
        $this->db->insert('kategori', $data);
    }

    public function hapusKategori($where = null)
    {
        $this->db->delete('kategori', $where);
    }

    public function updateKategori($where = null, $data = null)
    {
        $this->db->update('kategori', $data, $where);
    }

    //join
    public function joinKategoriWisata($where)
    {
        $this->db->select('wisata.id_kategori,kategori.kategori');
        $this->db->from('wisata');
        $this->db->join('kategori','kategori.id = wisata.id_kategori');
        $this->db->where($where);
        return $this->db->get();
    }
    
    public function joinKategoriWisataSejarah($where)
    {
        $this->db->select('wisata_sejarah.id_kategori,kategori.kategori');
        $this->db->from('wisata_sejarah');
        $this->db->join('kategori','kategori.id = wisata_sejarah.id_kategori');
        $this->db->where($where);
        return $this->db->get();

    }
}