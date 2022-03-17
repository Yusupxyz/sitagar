<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Verifikasi extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $c_url = $this->router->fetch_class();
        $this->layout->auth(); 
        $this->layout->auth_privilege($c_url);
        $this->load->model('Data_pegawai_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'data_pegawai?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'data_pegawai?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'data_pegawai';
            $config['first_url'] = base_url() . 'data_pegawai';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Data_pegawai_model->total_rows_berkas($q);
        $data_pegawai = $this->Data_pegawai_model->get_limit_data_berkas($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'data_pegawai_data' => $data_pegawai,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $data['title'] = 'Verifikasi Data Berkas';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Data Pegawai' => '',
        ];
        $data['code_js'] = 'verifikasi/codejs';
        $data['page'] = 'verifikasi/Verifikasi_list';
        $this->load->view('template/backend', $data);
    }
    
    public function update($id) 
    {
        $row = $this->Data_pegawai_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Ubah',
                'action' => site_url('verifikasi/update_action'),
		'id' => set_value('id', $row->id),
		'nama' => set_value('nama', $row->nama),
		'nik' => set_value('nik', $row->nik),
		'status_verif' => set_value('status_verif', $row->status_verif),
		'catatan_verif' => set_value('catatan_verif', $row->catatan_verif),
	    );
            $data['title'] = 'Data Pegawai';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Dashboard' => '',
        ];

        $data['page'] = 'verifikasi/Verifikasi_form';
        $this->load->view('template/backend', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('verifikasi'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
		'status_verif' => $this->input->post('status_verif',TRUE),
		'catatan_verif' => $this->input->post('catatan_verif',TRUE),
	    );


            $this->Data_pegawai_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('verifikasi'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Data_pegawai_model->get_by_id($id);

        if ($row) {
            $this->Data_pegawai_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('data_pegawai'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('data_pegawai'));
        }
    }

    public function deletebulk(){
        $delete = $this->Data_pegawai_model->deletebulk();
        if($delete){
            $this->session->set_flashdata('message', 'Delete Record Success');
        }else{
            $this->session->set_flashdata('message_error', 'Delete Record failed');
        }
        echo $delete;
    }
   
    public function _rules() 
    {
	$this->form_validation->set_rules('nama', 'nama', 'trim|required');
	$this->form_validation->set_rules('nik', 'nik', 'trim|required');
	// $this->form_validation->set_rules('tempat_lahir', 'tempat lahir', 'trim|required');
	// $this->form_validation->set_rules('tanggal_lahir', 'tanggal lahir', 'trim|required');
	// $this->form_validation->set_rules('jk', 'jk', 'trim|required');
	// $this->form_validation->set_rules('pendidikan_terakhir', 'pendidikan terakhir', 'trim|required');
	// $this->form_validation->set_rules('alamat', 'alamat', 'trim|required');
	// $this->form_validation->set_rules('jabatan', 'jabatan', 'trim|required');
	// $this->form_validation->set_rules('tahun_lulus', 'tahun lulus', 'trim|required');
	// $this->form_validation->set_rules('tanggal_sk_awal', 'tanggal sk awal', 'trim|required');
	// $this->form_validation->set_rules('tempat_tugas', 'tempat tugas', 'trim|required');
	// $this->form_validation->set_rules('no_hp', 'no hp', 'trim|required');
	// $this->form_validation->set_rules('email', 'email', 'trim|required');
	$this->form_validation->set_rules('status_verif', 'status verif', 'trim|required');
	// $this->form_validation->set_rules('catatan_verif', 'catatan verif', 'trim|required');

	$this->form_validation->set_rules('id', 'id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "data_pegawai_honorer.xls";
        $judul = "Data Pegawai Honorer";
        $tablehead = 0;
        $tablebody = 1;
        $nourut = 1;
        //penulisan header
        header("Pragma: public");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");
        header("Content-Disposition: attachment;filename=" . $namaFile . "");
        header("Content-Transfer-Encoding: binary ");

        xlsBOF();

        $kolomhead = 0;
        xlsWriteLabel($tablehead, $kolomhead++, "No");
	xlsWriteLabel($tablehead, $kolomhead++, "Nama");
	xlsWriteLabel($tablehead, $kolomhead++, "NIK");
	xlsWriteLabel($tablehead, $kolomhead++, "Tempat Lahir");
	xlsWriteLabel($tablehead, $kolomhead++, "Tanggal Lahir");
	xlsWriteLabel($tablehead, $kolomhead++, "Jenis Kelamin");
	xlsWriteLabel($tablehead, $kolomhead++, "Pendidikan Terakhir");
	xlsWriteLabel($tablehead, $kolomhead++, "Alamat");
	xlsWriteLabel($tablehead, $kolomhead++, "Jabatan");
	xlsWriteLabel($tablehead, $kolomhead++, "Tahun Lulus");
	xlsWriteLabel($tablehead, $kolomhead++, "Tanggal Sk Awal");
	xlsWriteLabel($tablehead, $kolomhead++, "Tempat Tugas");
	xlsWriteLabel($tablehead, $kolomhead++, "No Hp");
	xlsWriteLabel($tablehead, $kolomhead++, "Email");
	xlsWriteLabel($tablehead, $kolomhead++, "Status Verif");
	xlsWriteLabel($tablehead, $kolomhead++, "Catatan Verif");

	foreach ($this->Data_pegawai_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nama);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nik);
	    xlsWriteLabel($tablebody, $kolombody++, $data->tempat_lahir);
	    xlsWriteLabel($tablebody, $kolombody++, $data->tanggal_lahir);
	    xlsWriteLabel($tablebody, $kolombody++, $data->jk);
	    xlsWriteLabel($tablebody, $kolombody++, $data->pendidikan_terakhir);
	    xlsWriteLabel($tablebody, $kolombody++, $data->alamat);
	    xlsWriteLabel($tablebody, $kolombody++, $data->jabatan);
	    xlsWriteLabel($tablebody, $kolombody++, $data->tahun_lulus);
	    xlsWriteLabel($tablebody, $kolombody++, $data->tanggal_sk_awal);
	    xlsWriteLabel($tablebody, $kolombody++, $data->tempat_tugas);
	    xlsWriteLabel($tablebody, $kolombody++, $data->no_hp);
	    xlsWriteLabel($tablebody, $kolombody++, $data->email);
	    xlsWriteLabel($tablebody, $kolombody++, $data->status_verif);
	    xlsWriteLabel($tablebody, $kolombody++, $data->catatan_verif);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

}

/* End of file Data_pegawai.php */
/* Location: ./application/controllers/Data_pegawai.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2022-03-02 20:19:09 */
/* http://harviacode.com */