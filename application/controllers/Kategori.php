<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Kategori extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $c_url = $this->router->fetch_class();
        $this->layout->auth(); 
        $this->layout->auth_privilege($c_url);
        $this->load->model('Kategori_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'kategori?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'kategori?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'kategori';
            $config['first_url'] = base_url() . 'kategori';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Kategori_model->total_rows($q);
        $kategori = $this->Kategori_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'kategori_data' => $kategori,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $data['title'] = 'Kategori';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Kategori' => '',
        ];
        $data['code_js'] = 'kategori/codejs';
        $data['page'] = 'kategori/Kategori_list';
        $this->load->view('template/backend', $data);
    }


    public function create() 
    {
        $data = array(
            'button' => 'Tambah',
            'action' => site_url('kategori/create_action'),
	    'id' => set_value('id'),
	    'kategori' => set_value('kategori'),
	    'keterangan' => set_value('keterangan'),
	    'min' => set_value('min'),
	    'max' => set_value('max'),
	);
        $data['title'] = 'Kategori';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Dashboard' => '',
        ];

        $data['page'] = 'kategori/Kategori_form';
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
		'kategori' => $this->input->post('kategori',TRUE),
		'keterangan' => $this->input->post('keterangan',TRUE),
		'min' => $this->input->post('min',TRUE),
		'max' => $this->input->post('max',TRUE),
	    );
if(! $this->Kategori_model->is_exist($this->input->post('id'))){
                $this->Kategori_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('kategori'));
            }else{
                $this->create();
                $this->session->set_flashdata('message', 'Create Record Faild, id is exist');
            }}
    }
    
    public function update($id) 
    {
        $row = $this->Kategori_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Ubah',
                'action' => site_url('kategori/update_action'),
		'id' => set_value('id', $row->id),
		'kategori' => set_value('kategori', $row->kategori),
		'keterangan' => set_value('keterangan', $row->keterangan),
		'min' => set_value('keterangan', $row->min),
		'max' => set_value('keterangan', $row->max),
	    );
            $data['title'] = 'Kategori';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Dashboard' => '',
        ];

        $data['page'] = 'kategori/Kategori_form';
        $this->load->view('template/backend', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('kategori'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
		'id' => $this->input->post('id',TRUE),
		'kategori' => $this->input->post('kategori',TRUE),
		'keterangan' => $this->input->post('keterangan',TRUE),
		'min' => $this->input->post('min',TRUE),
		'max' => $this->input->post('max',TRUE),
	    );

            $this->Kategori_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('kategori'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Kategori_model->get_by_id($id);

        if ($row) {
            $this->Kategori_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('kategori'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('kategori'));
        }
    }

    public function deletebulk(){
        $delete = $this->Kategori_model->deletebulk();
        if($delete){
            $this->session->set_flashdata('message', 'Delete Record Success');
        }else{
            $this->session->set_flashdata('message_error', 'Delete Record failed');
        }
        echo $delete;
    }
   
    public function _rules() 
    {
	$this->form_validation->set_rules('id', 'id', 'trim|required');
	$this->form_validation->set_rules('kategori', 'kategori', 'trim|required');
	$this->form_validation->set_rules('keterangan', 'keterangan', 'trim|required');

	$this->form_validation->set_rules('id', 'id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Kategori.php */
/* Location: ./application/controllers/Kategori.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2022-03-11 06:11:56 */
/* http://harviacode.com */