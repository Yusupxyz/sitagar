<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Nilai extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $c_url = $this->router->fetch_class();
        $this->layout->auth(); 
        $this->layout->auth_privilege($c_url);
        $this->load->model('Nilai_model');
        $this->load->model('Kategori_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'nilai?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'nilai?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'nilai';
            $config['first_url'] = base_url() . 'nilai';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Nilai_model->total_rows($q);
        $nilai = $this->Nilai_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'nilai_data' => $nilai,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $data['title'] = 'Nilai';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Nilai' => '',
        ];
        $data['code_js'] = 'nilai/codejs';
        $data['page'] = 'nilai/Nilai_list';
        $this->load->view('template/backend', $data);
    }

    public function read($id) 
    {
        $row = $this->Nilai_model->get_by_idlaporan($id);
        if ($row) {
            $data = array(
		'id' => $row->id,
		'id_laporan_kinerja' => $row->id_laporan_kinerja,
		'tanggung_jawab' => $row->tanggung_jawab,
		'ketaatan' => $row->ketaatan,
		'produktivitas' => $row->produktivitas,
		'efesiensi' => $row->efesiensi,
		'inovasi' => $row->inovasi,
		'kerja_sama' => $row->kerja_sama,
		'efektivitas' => $row->efektivitas,
		'kecepatan' => $row->kecepatan,
	    );
        $data['title'] = 'Nilai';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Dashboard' => '',
        ];

        $data['page'] = 'nilai/Nilai_read';
        $this->load->view('template/backend', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('nilai'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('nilai/create_action'),
	    'id' => set_value('id'),
	    'id_laporan_kinerja' => set_value('id_laporan_kinerja'),
	    'tanggung_jawab' => set_value('tanggung_jawab'),
	    'ketaatan' => set_value('ketaatan'),
	    'produktivitas' => set_value('produktivitas'),
	    'efesiensi' => set_value('efesiensi'),
	    'inovasi' => set_value('inovasi'),
	    'kerja_sama' => set_value('kerja_sama'),
	    'efektivitas' => set_value('efektivitas'),
	    'kecepatan' => set_value('kecepatan'),
	);
        $data['title'] = 'Nilai';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Dashboard' => '',
        ];

        $data['page'] = 'nilai/Nilai_form';
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
		'id_laporan_kinerja' => $this->input->post('id_laporan_kinerja',TRUE),
		'tanggung_jawab' => $this->input->post('tanggung_jawab',TRUE),
		'ketaatan' => $this->input->post('ketaatan',TRUE),
		'produktivitas' => $this->input->post('produktivitas',TRUE),
		'efesiensi' => $this->input->post('efesiensi',TRUE),
		'inovasi' => $this->input->post('inovasi',TRUE),
		'kerja_sama' => $this->input->post('kerja_sama',TRUE),
		'efektivitas' => $this->input->post('efektivitas',TRUE),
		'kecepatan' => $this->input->post('kecepatan',TRUE),
	    );
if(! $this->Nilai_model->is_exist($this->input->post('id'))){
                $this->Nilai_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('nilai'));
            }else{
                $this->create();
                $this->session->set_flashdata('message', 'Create Record Faild, id is exist');
            }}
    }
    
    public function update($id) 
    {
        $row = $this->Nilai_model->get_by_idlaporan($id);
        if ($row) {
            $data = array(
                'button' => 'Ubah',
                'action' => site_url('nilai/update_action'),
		'id' => set_value('id', $row->id),
		'tanggung_jawab' => set_value('tanggung_jawab', $row->tanggung_jawab),
		'ketaatan' => set_value('ketaatan', $row->ketaatan),
		'produktivitas' => set_value('produktivitas', $row->produktivitas),
		'efesiensi' => set_value('efesiensi', $row->efesiensi),
		'inovasi' => set_value('inovasi', $row->inovasi),
		'kerja_sama' => set_value('kerja_sama', $row->kerja_sama),
		'efektivitas' => set_value('efektivitas', $row->efektivitas),
		'kecepatan' => set_value('kecepatan', $row->kecepatan),
	    );
            $data['title'] = 'Nilai';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Dashboard' => '',
        ];

        $data['page'] = 'nilai/Nilai_form';
        $this->load->view('template/backend', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('nilai'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $total=$this->input->post('tanggung_jawab',TRUE)+$this->input->post('ketaatan',TRUE)+$this->input->post('produktivitas',TRUE)+$this->input->post('efesiensi',TRUE)+$this->input->post('inovasi',TRUE)+$this->input->post('kerja_sama',TRUE)+$this->input->post('efektivitas',TRUE)+$this->input->post('kecepatan',TRUE);
            $skor=ceil($total/8);
            $id_kategori=$this->Kategori_model->get_by_skor($skor)->id;
            // echo $this->db->last_query();
            $data = array(
		'tanggung_jawab' => $this->input->post('tanggung_jawab',TRUE),
		'ketaatan' => $this->input->post('ketaatan',TRUE),
		'produktivitas' => $this->input->post('produktivitas',TRUE),
		'efesiensi' => $this->input->post('efesiensi',TRUE),
		'inovasi' => $this->input->post('inovasi',TRUE),
		'kerja_sama' => $this->input->post('kerja_sama',TRUE),
		'efektivitas' => $this->input->post('efektivitas',TRUE),
		'kecepatan' => $this->input->post('kecepatan',TRUE),
		'skor' => $skor,
		'id_kategori' => $id_kategori,
	    );

            $this->Nilai_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('nilai_laporan_kinerja'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Nilai_model->get_by_id($id);

        if ($row) {
            $this->Nilai_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('nilai'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('nilai'));
        }
    }

    public function deletebulk(){
        $delete = $this->Nilai_model->deletebulk();
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
	// $this->form_validation->set_rules('id_laporan_kinerja', 'id laporan kinerja', 'trim|required');
	$this->form_validation->set_rules('tanggung_jawab', 'tanggung jawab', 'trim|required');
	$this->form_validation->set_rules('ketaatan', 'ketaatan', 'trim|required');
	$this->form_validation->set_rules('produktivitas', 'produktivitas', 'trim|required');
	$this->form_validation->set_rules('efesiensi', 'efesiensi', 'trim|required');
	$this->form_validation->set_rules('inovasi', 'inovasi', 'trim|required');
	$this->form_validation->set_rules('kerja_sama', 'kerja sama', 'trim|required');
	$this->form_validation->set_rules('efektivitas', 'efektivitas', 'trim|required');
	$this->form_validation->set_rules('kecepatan', 'kecepatan', 'trim|required');

	$this->form_validation->set_rules('id', 'id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Nilai.php */
/* Location: ./application/controllers/Nilai.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2022-03-11 06:05:05 */
/* http://harviacode.com */