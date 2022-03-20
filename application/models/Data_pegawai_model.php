<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Data_pegawai_model extends CI_Model
{

    public $table = 'data_pegawai';
    public $id = 'data_pegawai.id';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // get all
    function get_all()
    {
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }

    // count all
    function count_all()
    {
        $this->db->select('count(*) as "total"');
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->row();
    }


    // count all verif
    function count_verif_all()
    {
        $this->db->select('count(*) as "total"');
        $this->db->order_by($this->id, $this->order);
        $this->db->where('status_verif', '2');
        return $this->db->get($this->table)->row();
    }

    // count all non verif
    function count_nonverif_all()
    {
        $this->db->select('count(*) as "total"');
        $this->db->order_by($this->id, $this->order);
        $this->db->where('status_verif', '1');
        return $this->db->get($this->table)->row();
    }

    // get data by id
    function get_by_id($id)
    {
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
    }

    // get data by id join
    function get_by_id_join($id)
    {
        $this->db->select('*,data_pegawai.email as "dp_email",data_pegawai.id as "dp_id"');
        $this->db->join('users','users.email=data_pegawai.nik','left');
        $this->db->where('users.id', $id);
        return $this->db->get($this->table)->row();
    }
    
    // get total rows
    function total_rows($q = NULL) {
        $this->db->like('id', $q);
	$this->db->or_like('nama', $q);
	$this->db->or_like('nik', $q);
	$this->db->or_like('password', $q);
	$this->db->or_like('tempat_lahir', $q);
	$this->db->or_like('tanggal_lahir', $q);
	$this->db->or_like('jk', $q);
	$this->db->or_like('pendidikan_terakhir', $q);
	$this->db->or_like('alamat', $q);
	$this->db->or_like('jabatan', $q);
	$this->db->or_like('tahun_lulus', $q);
	$this->db->or_like('tanggal_sk_awal', $q);
	$this->db->or_like('tempat_tugas', $q);
	$this->db->or_like('no_hp', $q);
	$this->db->or_like('email', $q);
	$this->db->or_like('status_verif', $q);
	$this->db->or_like('catatan_verif', $q);
	$this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get total rows berkas
    function total_rows_berkas($q = NULL) {
        $this->db->like('data_pegawai.id', $q);
	$this->db->or_like('nama', $q);
	$this->db->or_like('nik', $q);
	$this->db->or_like('password', $q);
	$this->db->or_like('tempat_lahir', $q);
	$this->db->or_like('tanggal_lahir', $q);
	$this->db->or_like('jk', $q);
	$this->db->or_like('pendidikan_terakhir', $q);
	$this->db->or_like('alamat', $q);
	$this->db->or_like('jabatan', $q);
	$this->db->or_like('tahun_lulus', $q);
	$this->db->or_like('tanggal_sk_awal', $q);
	$this->db->or_like('tempat_tugas', $q);
	$this->db->or_like('no_hp', $q);
	$this->db->or_like('email', $q);
	$this->db->or_like('status_verif', $q);
	$this->db->or_like('catatan_verif', $q);
	$this->db->join('data_berkas','data_pegawai.id=data_berkas.id_pegawai','left');
	$this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get total rows status
    function total_rows_status($q = NULL,$id) {
	$this->db->where($this->id, $id);
	$this->db->join('data_berkas','data_pegawai.id=data_berkas.id_pegawai','left');
	$this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('id', $q);
	$this->db->or_like('nama', $q);
	$this->db->or_like('nik', $q);
	$this->db->or_like('password', $q);
	$this->db->or_like('tempat_lahir', $q);
	$this->db->or_like('tanggal_lahir', $q);
	$this->db->or_like('jk', $q);
	$this->db->or_like('pendidikan_terakhir', $q);
	$this->db->or_like('alamat', $q);
	$this->db->or_like('jabatan', $q);
	$this->db->or_like('tahun_lulus', $q);
	$this->db->or_like('tanggal_sk_awal', $q);
	$this->db->or_like('tempat_tugas', $q);
	$this->db->or_like('no_hp', $q);
	$this->db->or_like('email', $q);
	$this->db->or_like('status_verif', $q);
	$this->db->or_like('catatan_verif', $q);
	$this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }

    // get data with limit and search berkas
    function get_limit_data_berkas($limit, $start = 0, $q = NULL) {
        $this->db->select('*,data_pegawai.id as"dp_id"');
        $this->db->order_by($this->id, $this->order);
        $this->db->like('data_pegawai.id', $q);
	$this->db->or_like('nama', $q);
	$this->db->or_like('nik', $q);
	$this->db->or_like('password', $q);
	$this->db->or_like('tempat_lahir', $q);
	$this->db->or_like('tanggal_lahir', $q);
	$this->db->or_like('jk', $q);
	$this->db->or_like('pendidikan_terakhir', $q);
	$this->db->or_like('alamat', $q);
	$this->db->or_like('jabatan', $q);
	$this->db->or_like('tahun_lulus', $q);
	$this->db->or_like('tanggal_sk_awal', $q);
	$this->db->or_like('tempat_tugas', $q);
	$this->db->or_like('no_hp', $q);
	$this->db->or_like('email', $q);
	$this->db->or_like('status_verif', $q);
	$this->db->or_like('catatan_verif', $q);
	$this->db->join('data_berkas','data_pegawai.id=data_berkas.id_pegawai','left');
	$this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }

    // get data with limit and search status
    function get_limit_data_status($limit, $start = 0, $q = NULL,$id) {
        $this->db->select('*,data_pegawai.id as"dp_id"');
        $this->db->order_by($this->id, $this->order);
        $this->db->where($this->id, $id);
        $this->db->join('data_berkas','data_pegawai.id=data_berkas.id_pegawai','left');
        $this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }

    // insert data
    function insert($data)
    {
        $this->db->insert($this->table, $data);
    }

    // update data
    function update($id, $data)
    {
        $this->db->where($this->id, $id);
        $this->db->update($this->table, $data);
    }

    // delete data
    function delete($id)
    {
        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
    }

    // delete bulkdata
    function deletebulk(){
        $data = $this->input->post('msg_', TRUE);
        $arr_id = explode(",", $data); 
        $this->db->where_in($this->id, $arr_id);
        return $this->db->delete($this->table);
    }


}

/* End of file Data_pegawai_model.php */
/* Location: ./application/models/Data_pegawai_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2022-03-02 20:19:09 */
/* http://harviacode.com */