<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Nilai_laporan_kinerja extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $c_url = $this->router->fetch_class();
        $this->layout->auth(); 
        $this->layout->auth_privilege($c_url);
        $this->load->model('Laporan_kinerja_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'nilai_laporan_kinerja?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'nilai_laporan_kinerja?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'nilai_laporan_kinerja';
            $config['first_url'] = base_url() . 'nilai_laporan_kinerja';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Laporan_kinerja_model->total_rows($q);
        $laporan_kinerja = $this->Laporan_kinerja_model->get_limit_data($config['per_page'], $start, $q);
        echo $this->db->last_query();

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'laporan_kinerja_data' => $laporan_kinerja,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $data['title'] = 'Nilai Laporan Kinerja';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Laporan Kinerja' => '',
        ];
        $data['code_js'] = 'nilai_laporan_kinerja/codejs';
        $data['page'] = 'nilai_laporan_kinerja/Nilai_laporan_kinerja_list';
        $this->load->view('template/backend', $data);
    }

    public function read($id) 
    {
        $row = $this->Laporan_kinerja_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id' => $row->id,
		'kegiatan' => $row->kegiatan,
		'laporan' => $row->laporan,
	    );
        $data['title'] = 'Laporan Kinerja';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Dashboard' => '',
        ];

        $data['page'] = 'laporan_kinerja/Laporan_kinerja_read';
        $this->load->view('template/backend', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('laporan_kinerja'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Tambah',
            'action' => site_url('laporan_kinerja/create_action'),
	    'id' => set_value('id'),
	    'kegiatan' => set_value('kegiatan'),
	    'laporan' => set_value('laporan'),
	);
        $data['title'] = 'Laporan Kinerja';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Dashboard' => '',
        ];

        $data['page'] = 'laporan_kinerja/Laporan_kinerja_form';
        $this->load->view('template/backend', $data);
    }
    
    public function create_action() 
    {
       $config['upload_path']          = './assets/uploads/laporan';
       $config['allowed_types']        = 'pdf';
       $config['encrypt_name']			= TRUE;
       $this->load->library('upload', $config);
       if ( ! $this->upload->do_upload('laporan'))
       {
               echo $this->upload->display_errors();
       }
       else
       {
           $data['laporan'] = $this->upload->data("file_name");
           $data['kegiatan'] = $this->input->post('kegiatan',TRUE);
           $this->db->insert('laporan_kinerja',$data);
           redirect('laporan_kinerja');
       }
    }
    
    public function update($id) 
    {
        $row = $this->Laporan_kinerja_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('nilai_laporan_kinerja/update_action'),
		'id' => set_value('id', $row->id),
		'kegiatan' => set_value('kegiatan', $row->kegiatan),
		'laporan' => set_value('laporan', $row->laporan),
	    );
            $data['title'] = 'Nilai laporan Kinerja';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Dashboard' => '',
        ];

        $data['page'] = 'nilai_laporan_kinerja/Nilai_laporan_kinerja_form';
        $this->load->view('template/backend', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('nilai_laporan_kinerja'));
        }
    }
    
    public function update_action() 
    {
       $config['upload_path']          = './assets/uploads/laporan';
       $config['allowed_types']        = 'pdf';
       $config['encrypt_name']		   = TRUE;
       $this->load->library('upload', $config);
       if ( ! $this->upload->do_upload('laporan'))
       {
               echo $this->upload->display_errors();
       }
       else
       {
           $path = './assets/uploads/laporan/'.$this->input->post('old',TRUE);
           unlink($path);
           $data['laporan'] = $this->upload->data("file_name");
           $data['kegiatan'] = $this->input->post('kegiatan',TRUE);
           $this->db->where('id', $this->input->post('id',TRUE));
           $this->db->update('laporan_kinerja', $data);
           redirect('laporan_kinerja');
       }
    }
    
    public function delete($id) 
    {
        $row = $this->Laporan_kinerja_model->get_by_id($id);

        if ($row) {
            $this->Laporan_kinerja_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('laporan_kinerja'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('laporan_kinerja'));
        }
    }

    public function deletebulk(){
        $delete = $this->Laporan_kinerja_model->deletebulk();
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
	$this->form_validation->set_rules('kegiatan', 'kegiatan', 'trim|required');
	$this->form_validation->set_rules('laporan', 'laporan', 'trim|required');

	$this->form_validation->set_rules('id', 'id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Laporan_kinerja.php */
/* Location: ./application/controllers/Laporan_kinerja.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2022-03-10 16:11:06 */
/* http://harviacode.com */