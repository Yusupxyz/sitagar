<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Daftar_pegawai extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $c_url = $this->router->fetch_class();
        $this->layout->auth(); 
        $this->layout->auth_privilege($c_url);
        $this->load->model('Data_pegawai_model');
        $this->load->model('Data_berkas_model');
        $this->load->library('form_validation');
        $this->load->library(array('excel','session'));

    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'daftar_pegawai?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'daftar_pegawai?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'daftar_pegawai';
            $config['first_url'] = base_url() . 'daftar_pegawai';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Data_pegawai_model->total_rows($q);
        $data_pegawai = $this->Data_pegawai_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'data_pegawai_data' => $data_pegawai,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $data['title'] = 'Data Pegawai Honorer';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Data Pegawai' => '',
        ];
        $data['code_js'] = 'daftar_pegawai/codejs';
        $data['page'] = 'daftar_pegawai/Daftar_pegawai_list';
        $this->load->view('template/backend', $data);
    }

    public function read($id) 
    {
        $row = $this->Data_berkas_model->get_by_idpegawai($id);
        // echo $this->db->last_query();
        if ($row) {
            $data = array(
		'id' => $row->id,
		'nama' => $row->nama,
		'nik' => $row->nik,
		'ijazah' => $row->ijazah,
		'transkrip' => $row->tempat_lahir,
		'sertifikasi' => $row->sertifikasi,
	    );
        $data['title'] = 'Data Pegawai';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Dashboard' => '',
        ];

        $data['page'] = 'daftar_pegawai/Daftar_pegawai_read';
        $this->load->view('template/backend', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('daftar_pegawai'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Tambah',
            'action' => site_url('data_pegawai/create_action'),
	    'id' => set_value('id'),
	    'nama' => set_value('nama'),
	    'nik' => set_value('nik'),
	    'tempat_lahir' => set_value('tempat_lahir'),
	    'tanggal_lahir' => set_value('tanggal_lahir'),
	    'jk' => set_value('jk'),
	    'pendidikan_terakhir' => set_value('pendidikan_terakhir'),
	    'alamat' => set_value('alamat'),
	    'jabatan' => set_value('jabatan'),
	    'tahun_lulus' => set_value('tahun_lulus'),
	    'tanggal_sk_awal' => set_value('tanggal_sk_awal'),
	    'tempat_tugas' => set_value('tempat_tugas'),
	    'no_hp' => set_value('no_hp'),
	    'email' => set_value('email'),
	);
        $data['title'] = 'Data Pegawai Honorer';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Dashboard' => '',
        ];

        $data['page'] = 'data_pegawai/Data_pegawai_form';
        $this->load->view('template/backend', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE){
            $this->create();
        } else {
            $data = array(
            'nama' => $this->input->post('nama',TRUE),
            'nik' => $this->input->post('nik',TRUE),
            'password' => $this->input->post('nik',TRUE),
            'tempat_lahir' => $this->input->post('tempat_lahir',TRUE),
            'tanggal_lahir' => $this->input->post('tanggal_lahir',TRUE),
            'jk' => $this->input->post('jk',TRUE),
            'pendidikan_terakhir' => $this->input->post('pendidikan_terakhir',TRUE),
            'alamat' => $this->input->post('alamat',TRUE),
            'jabatan' => $this->input->post('jabatan',TRUE),
            'tahun_lulus' => $this->input->post('tahun_lulus',TRUE),
            'tanggal_sk_awal' => $this->input->post('tanggal_sk_awal',TRUE),
            'tempat_tugas' => $this->input->post('tempat_tugas',TRUE),
            'no_hp' => $this->input->post('no_hp',TRUE),
            'email' => $this->input->post('email',TRUE)
	    );
            $this->Data_pegawai_model->insert($data);

            $data2=array(
                'id_pegawai' => $this->db->insert_id()
            );
            $this->Data_berkas_model->insert($data2);

            $this->create_user($this->input->post('nik',TRUE),$this->input->post('nik',TRUE),$this->input->post('nama',TRUE));

            $this->session->set_flashdata('message', 'Tambah Data Sukses');
            redirect(site_url('data_pegawai'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Data_pegawai_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Ubah',
                'action' => site_url('data_pegawai/update_action'),
		'id' => set_value('id', $row->id),
		'nama' => set_value('nama', $row->nama),
		'nik' => set_value('nik', $row->nik),
		'tempat_lahir' => set_value('tempat_lahir', $row->tempat_lahir),
		'tanggal_lahir' => set_value('tanggal_lahir', $row->tanggal_lahir),
		'jk' => set_value('jk', $row->jk),
		'pendidikan_terakhir' => set_value('pendidikan_terakhir', $row->pendidikan_terakhir),
		'alamat' => set_value('alamat', $row->alamat),
		'jabatan' => set_value('jabatan', $row->jabatan),
		'tahun_lulus' => set_value('tahun_lulus', $row->tahun_lulus),
		'tanggal_sk_awal' => set_value('tanggal_sk_awal', $row->tanggal_sk_awal),
		'tempat_tugas' => set_value('tempat_tugas', $row->tempat_tugas),
		'no_hp' => set_value('no_hp', $row->no_hp),
		'email' => set_value('email', $row->email),
		'status_verif' => set_value('status_verif', $row->status_verif),
		'catatan_verif' => set_value('catatan_verif', $row->catatan_verif),
	    );
            $data['title'] = 'Data Pegawai';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Dashboard' => '',
        ];

        $data['page'] = 'data_pegawai/Data_pegawai_form';
        $this->load->view('template/backend', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('data_pegawai'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
		'nama' => $this->input->post('nama',TRUE),
		'nik' => $this->input->post('nik',TRUE),
		'tempat_lahir' => $this->input->post('tempat_lahir',TRUE),
		'tanggal_lahir' => $this->input->post('tanggal_lahir',TRUE),
		'jk' => $this->input->post('jk',TRUE),
		'pendidikan_terakhir' => $this->input->post('pendidikan_terakhir',TRUE),
		'alamat' => $this->input->post('alamat',TRUE),
		'jabatan' => $this->input->post('jabatan',TRUE),
		'tahun_lulus' => $this->input->post('tahun_lulus',TRUE),
		'tanggal_sk_awal' => $this->input->post('tanggal_sk_awal',TRUE),
		'tempat_tugas' => $this->input->post('tempat_tugas',TRUE),
		'no_hp' => $this->input->post('no_hp',TRUE),
		'email' => $this->input->post('email',TRUE),
		'status_verif' => $this->input->post('status_verif',TRUE),
		'catatan_verif' => $this->input->post('catatan_verif',TRUE),
	    );

            $this->Data_pegawai_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Ubah Data Sukses');
            redirect(site_url('data_pegawai'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Data_pegawai_model->get_by_id($id);

        if ($row) {
            $this->Data_pegawai_model->delete($id);
            $this->session->set_flashdata('message', 'Hapus Data Sukses');
            redirect(site_url('data_pegawai'));
        } else {
            $this->session->set_flashdata('message', 'Data Tidak Ditemukan');
            redirect(site_url('data_pegawai'));
        }
    }

    public function deletebulk(){
        $delete = $this->Data_pegawai_model->deletebulk();
        if($delete){
            $this->session->set_flashdata('message', 'Hapus Data Sukses');
        }else{
            $this->session->set_flashdata('message_error', 'Hapus Data Gagal');
        }
        echo $delete;
    }
   
    public function _rules() 
    {
	$this->form_validation->set_rules('nama', 'nama', 'trim|required');
	$this->form_validation->set_rules('nik', 'nik', 'trim|required');
	// $this->form_validation->set_rules('tempat_lahir', 'tempat lahir', 'trim|required');
	// $this->form_validation->set_rules('tanggal_lahir', 'tanggal lahir', 'trim|required');
	$this->form_validation->set_rules('jk', 'jk', 'trim|required');
	// $this->form_validation->set_rules('pendidikan_terakhir', 'pendidikan terakhir', 'trim|required');
	// $this->form_validation->set_rules('alamat', 'alamat', 'trim|required');
	// $this->form_validation->set_rules('jabatan', 'jabatan', 'trim|required');
	// $this->form_validation->set_rules('tahun_lulus', 'tahun lulus', 'trim|required');
	// $this->form_validation->set_rules('tanggal_sk_awal', 'tanggal sk awal', 'trim|required');
	// $this->form_validation->set_rules('tempat_tugas', 'tempat tugas', 'trim|required');
	// $this->form_validation->set_rules('no_hp', 'no hp', 'trim|required');
	// $this->form_validation->set_rules('email', 'email', 'trim|required');
	// $this->form_validation->set_rules('status_verif', 'status verif', 'trim|required');
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

    public function import() 
    {
        $data = array(
                'button' => 'Import',
                'action' => site_url('data_pegawai/import_action'),
            'id' => set_value('id'),
            'nama' => set_value('nama'),
            'nik' => set_value('nik'),
            'tempat_lahir' => set_value('tempat_lahir'),
            'tanggal_lahir' => set_value('tanggal_lahir'),
            'jk' => set_value('jk'),
            'pendidikan_terakhir' => set_value('pendidikan_terakhir'),
            'alamat' => set_value('alamat'),
            'jabatan' => set_value('jabatan'),
            'tahun_lulus' => set_value('tahun_lulus'),
            'tanggal_sk_awal' => set_value('tanggal_sk_awal'),
            'tempat_tugas' => set_value('tempat_tugas'),
            'no_hp' => set_value('no_hp'),
            'email' => set_value('email'),
        );
        $data['title'] = 'Data Pegawai Honorer';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Dashboard' => '',
        ];

        $data['page'] = 'data_pegawai/Data_pegawai_import';
        $this->load->view('template/backend', $data);
    }
    
    public function import_action() 
    {
        if (isset($_FILES["file"]["name"])) {
			$path = $_FILES["file"]["tmp_name"];
			$object = PHPExcel_IOFactory::load($path);            
			foreach($object->getWorksheetIterator() as $worksheet)
			{   
			    $highestRow = $worksheet->getHighestRow();
				$highestColumn = $worksheet->getHighestColumn();	
				for($row=2; $row<=$highestRow; $row++)
				{
					$nama = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
					$nik = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
					$tempat_lahir = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
					$tanggal_lahir = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
					$jk = $worksheet->getCellByColumnAndRow(5, $row)->getValue();
					$pendidikan_terakhir = $worksheet->getCellByColumnAndRow(6, $row)->getValue();
					$alamat = $worksheet->getCellByColumnAndRow(7, $row)->getValue();
					$jabatan = $worksheet->getCellByColumnAndRow(8, $row)->getValue();
					$tahun_lulus = $worksheet->getCellByColumnAndRow(9, $row)->getValue();
					$tanggal_sk_awal = $worksheet->getCellByColumnAndRow(10, $row)->getValue();
					$tempat_tugas = $worksheet->getCellByColumnAndRow(11, $row)->getValue();
					$no_hp = $worksheet->getCellByColumnAndRow(12, $row)->getValue();
					$email = $worksheet->getCellByColumnAndRow(13, $row)->getValue();
					$temp_data = array(
						'nama' => $nama,
                        'nik' => $nik,
                        'tempat_lahir' => $tempat_lahir,
                        'tanggal_lahir' => $tanggal_lahir,
                        'jk' => $jk,
                        'pendidikan_terakhir' => $pendidikan_terakhir,
                        'alamat' => $alamat,
                        'jabatan' => $jabatan,
                        'tahun_lulus' => $tahun_lulus,
                        'tanggal_sk_awal' => $tanggal_sk_awal,
                        'tempat_tugas' => $tempat_tugas,
                        'no_hp' => $no_hp,
                        'email' => $email
					); 	
                    $this->Data_pegawai_model->insert($temp_data);
                    $data2=array(
                        'id_pegawai' => $this->db->insert_id()
                    );
                    $this->Data_berkas_model->insert($data2);
                    $this->create_user($nik,$nik,$nama);

                    $this->session->set_flashdata('message', 'Import Data Sukses');
                    redirect(site_url('data_pegawai'));
				}
			}



		}else{
			echo "Tidak ada file yang masuk";
		}
        
    }

    private function create_user($nik,$email,$nama)
	{
        $identity_column = $this->config->item('identity', 'ion_auth');
        $identity = ($identity_column === 'email') ? $email : $this->input->post('identity');

        $additional_data = array(
            'first_name' => $nama,
            'last_name' => '',
            'company' => '',
            'phone' => ''
        );
		if ($this->ion_auth->register($identity, $nik, $email, $additional_data))
		{
			// check to see if we are creating the user
			// redirect them back to the admin page
			$this->session->set_flashdata('message', $this->ion_auth->messages());

		}
	}

}

/* End of file Data_pegawai.php */
/* Location: ./application/controllers/Data_pegawai.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2022-03-02 20:19:09 */
/* http://harviacode.com */