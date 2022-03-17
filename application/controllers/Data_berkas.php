<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Data_berkas extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $c_url = $this->router->fetch_class();
        $this->layout->auth(); 
        $this->layout->auth_privilege($c_url);
        $this->load->model('Data_berkas_model');
        $this->load->model('Data_pegawai_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $id = $this->Data_pegawai_model->get_by_id_join($this->ion_auth->user()->row()->id)->dp_id;
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'data_berkas?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'data_berkas?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'data_berkas';
            $config['first_url'] = base_url() . 'data_berkas';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Data_berkas_model->total_rows($q,$id);
        $data_berkas = $this->Data_berkas_model->get_limit_data($config['per_page'], $start, $q,$id);
        // echo $this->db->last_query();
        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'data_berkas_data' => $data_berkas,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $data['title'] = 'Data Berkas';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Data Berkas' => '',
        ];
        $data['code_js'] = 'data_berkas/codejs';
        $data['page'] = 'data_berkas/Data_berkas_list';
        $this->load->view('template/backend', $data);
    }

    public function read($id) 
    {
        $row = $this->Data_berkas_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id' => $row->id,
		'id_pegawai' => $row->id_pegawai,
		'sertifikasi' => $row->sertifikasi,
		'ijazah' => $row->ijazah,
		'transkrip' => $row->transkrip,
	    );
        $data['title'] = 'Data Berkas';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Dashboard' => '',
        ];

        $data['page'] = 'data_berkas/Data_berkas_read';
        $this->load->view('template/backend', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('data_berkas'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('data_berkas/create_action'),
	    'id' => set_value('id'),
	    'id_pegawai' => set_value('id_pegawai'),
	    'sertifikasi' => set_value('sertifikasi'),
	    'ijazah' => set_value('ijazah'),
	    'transkrip' => set_value('transkrip'),
	);
        $data['title'] = 'Data Berkas';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Dashboard' => '',
        ];

        $data['page'] = 'data_berkas/Data_berkas_form';
        $this->load->view('template/backend', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'id' => $this->input->post('id',TRUE),
		'id_pegawai' => $this->input->post('id_pegawai',TRUE),
		'sertifikasi' => $this->input->post('sertifikasi',TRUE),
		'ijazah' => $this->input->post('ijazah',TRUE),
		'transkrip' => $this->input->post('transkrip',TRUE),
	    );
        if(! $this->Data_berkas_model->is_exist($this->input->post('id'))){
                $this->Data_berkas_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('data_berkas'));
            }else{
                $this->create();
                $this->session->set_flashdata('message', 'Create Record Failed, id is exist');
            }}
    }
    
    public function update($id) 
    {
        $row = $this->Data_berkas_model->get_by_id($id);
        // echo $this->db->last_query();
        if ($row) {
            $data = array(
                'button' => 'Ubah',
                'action' => site_url('data_berkas/update_action'),
            'id' => set_value('id', $row->id),
            'id_pegawai' => set_value('id_pegawai', $row->id_pegawai),
            'sertifikasi' => set_value('sertifikasi', $row->sertifikasi),
            'ijazah' => set_value('ijazah', $row->ijazah),
            'transkrip' => set_value('transkrip', $row->transkrip)
	    );
            $data['title'] = 'Data Berkas';
            $data['id_pegawai'] = $id;
            $data['subtitle'] = '';
            $data['crumb'] = [
            'Dashboard' => '',
        ];

        $data['page'] = 'data_berkas/Data_berkas_form';
        $this->load->view('template/backend', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('data_berkas'));
        }
    }
    
    public function update_action() 
    {
        //ijazah
        $config['upload_path']          = './assets/uploads/berkas/ijazah';
		$config['allowed_types']        = 'pdf';
		$config['encrypt_name']			= TRUE;
		$this->load->library('upload', $config);
		if ( ! $this->upload->do_upload('ijazah'))
		{
				echo $this->upload->display_errors();
		}
		else
		{
            $path = './assets/uploads/berkas/ijazah/'.$this->input->post('old',TRUE);
            unlink($path);
			$data['ijazah'] = $this->upload->data("file_name");
            $this->db->where('id_pegawai', $this->input->post('id', TRUE));
            $this->db->update('data_berkas', $data);
			// redirect('data_berkas');
		}

        //transkrip
        $config2['upload_path']          = './assets/uploads/berkas/transkrip';
		$config2['allowed_types']        = 'pdf';
		$config2['encrypt_name']			= TRUE;
        $this->upload->initialize($config2);
		if ( ! $this->upload->do_upload('transkrip'))
		{
				echo $this->upload->display_errors();
		}
		else
		{
            $path = './assets/uploads/berkas/transkrip/'.$this->input->post('old2',TRUE);
            unlink($path);
			$data['transkrip'] = $this->upload->data("file_name");
            $this->db->where('id_pegawai', $this->input->post('id', TRUE));
            $this->db->update('data_berkas', $data);
			// redirect('data_berkas');
		}

        //transkrip
        $config3['upload_path']          = './assets/uploads/berkas/sertifikasi';
		$config3['allowed_types']        = 'pdf';
		$config3['encrypt_name']			= TRUE;
        $this->upload->initialize($config3);
		if ( ! $this->upload->do_upload('sertifikasi'))
		{
            if (strpos($this->upload->display_errors(), 'Anda tidak memilih berkas untuk mengunggah.')!==false){
                redirect('data_berkas'); 
            }else{
				echo $this->upload->display_errors()."xx";
                echo ".";
            }
		}
		else
		{
            $path = './assets/uploads/berkas/sertifikasi/'.$this->input->post('old3',TRUE);
            unlink($path);
			$data['sertifikasi'] = $this->upload->data("file_name");
            $this->db->where('id_pegawai', $this->input->post('id', TRUE));
            $this->db->update('data_berkas', $data);
			redirect('data_berkas');
		}
	}
    
    public function delete($id) 
    {
        $row = $this->Data_berkas_model->get_by_id($id);

        if ($row) {
            $this->Data_berkas_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('data_berkas'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('data_berkas'));
        }
    }

    public function deletebulk(){
        $delete = $this->Data_berkas_model->deletebulk();
        if($delete){
            $this->session->set_flashdata('message', 'Delete Record Success');
        }else{
            $this->session->set_flashdata('message_error', 'Delete Record failed');
        }
        echo $delete;
    }
   
    public function _rules() 
    {
	// $this->form_validation->set_rules('id', 'id', 'trim|required');
	// $this->form_validation->set_rules('id_pegawai', 'id pegawai', 'trim|required');
	// $this->form_validation->set_rules('sertifikasi', 'sertifikasi', 'trim|required');
	// $this->form_validation->set_rules('ijazah', 'ijazah', 'trim|required');
	// $this->form_validation->set_rules('transkrip', 'transkrip', 'trim|required');

	$this->form_validation->set_rules('id', 'id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Data_berkas.php */
/* Location: ./application/controllers/Data_berkas.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2022-03-07 18:50:05 */
/* http://harviacode.com */