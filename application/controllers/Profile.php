<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->layout->auth();
        $this->load->model('Ion_auth_model');
        $this->load->model('Users_model');
	}
	
	public function index()
	{
		$data['title'] = 'Profil';
		$data['subtitle'] = '';
		$data['action'] = site_url('profile/update_action');
		$data['user'] = $id = $this->ion_auth->user()->row();
		// var_dump($data['user']);
        $data['crumb'] = [
            'Profile' => '',
        ];
        //$this->layout->set_privilege(1);
        $data['page'] = 'profile';
		$this->load->view('template/backend', $data);
	}

	public function update_action(){
		$id=$this->ion_auth->user()->row()->id;
		$email = $this->input->post('email',TRUE);
		$old_p = $this->input->post('old_p',TRUE);
		$new_p = $this->input->post('new_p',TRUE);
		$konfirmasi = $this->input->post('konfirmasi_p',TRUE);
		$m_email="";
		$m_password="";
		$m_foto="";
		if ($this->Ion_auth_model->cek_oldp($id,$old_p)){
			if($email!=null){
				$data = array(
					'email' => $email
				);
				$this->Users_model->update($this->input->post('id', TRUE), $data);
				// echo $this->db->last_query();
				$m_email="Email berhasil diubah<br>";
			}

			//foto
			$config['upload_path']          = './assets/uploads/foto';
			$config['allowed_types'] 		= "jpg|png|jpeg";
			$config['encrypt_name']			= TRUE;
			$this->load->library('upload', $config);
			if ( ! $this->upload->do_upload('foto'))
			{
				// echo $this->upload->display_errors();
				$this->session->set_flashdata('error', $this->upload->display_errors());
				$m_foto="Foto gagal diubah karena ".$this->upload->display_errors()."<br>";

			}
			else
			{
				$path = './assets/uploads/foto/'.$this->input->post('old',TRUE);
				unlink($path);
				$data['foto'] = $this->upload->data("file_name");
				$this->db->where('id', $this->input->post('id', TRUE));
				$this->db->update('users', $data);
				$m_password="Foto berhasil diubah <br>";
			}

			if($new_p!=null){
				if ($new_p==$konfirmasi){
					$this->Ion_auth_model->update_password($this->input->post('id', TRUE), $new_p);
					// echo $this->db->last_query();
					redirect(site_url('auth/logout'));
				}else{
					$m_password="Password tidak terkonfirmasi <br>";

				}
			
			}
			$this->session->set_flashdata('message', $m_email.$m_foto.$m_password);
			redirect(site_url('profile'));
		

		}else{
			$this->session->set_flashdata('error', 'Password Lama Tidak Sama');
			redirect(site_url('profile'));
		}
		



		
	}

}
