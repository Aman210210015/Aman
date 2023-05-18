<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class admin extends CI_Controller {
	public function __construct()
    {
		parent::__construct();
		$this->load->model('model');
        //cek session dan level user
        if($this->model->is_role() != "1"){
			redirect("C_login");
			
        }
	}
	public function logout()
    {
        $this->session->sess_destroy();
        redirect('C_login');
	}
	public function index()
	{
		$this->load->view('admin/head');
		$this->load->view('admin/menu');
		$this->load->view('admin/dashboard');
		$this->load->view('admin/footer');
	}
	
	public function tambah_us()
	{
		$this->load->view('admin/head');
		$this->load->view('admin/menu');
		$this->load->view('admin/tambah_user');
		$this->load->view('admin/footer');
	}
	public function aksi_tambah_us()
	{
		$id_user = $this->input->post('id_user');
		$nama = $this->input->post('nama');
		$username = $this->input->post('username');
		$email = $this->input->post('email');
		$password = $this->input->post('password');
		$notelp = $this->input->post('notelp');
		$data = array(
			'id_user' => $id_user,
			'nama' => $nama,
			'username' => $username,
			'email' => $email,
			'password' => MD5($password),
			'notelp' => $notelp,
		);
		$this->model->input($data, 'user');
		redirect('admin/user');
	}
	public function edit_us($id){
		$where = array('id_user' => $id);
		$data['user'] = $this->model->edit($where,'user')->result();
		$this->load->view('admin/head');
		$this->load->view('admin/menu');
		$this->load->view('admin/edit_user',$data);
		$this->load->view('admin/footer');

	}
	public function update_us(){
		$id_user = $this->input->post('id_user');
		$nama = $this->input->post('nama');
		$username = $this->input->post('username');
		$email = $this->input->post('email');
		$password = $this->input->post('password');
		$notelp = $this->input->post('notelp');
		$where = array(
			'id_user' => $id_user
		);
		$data = array(
			'id_user' => $id_user,
			'nama' => $nama,
			'username' => $username,
			'email' => $email,
			'password' => MD5($password),
			'notelp' => $notelp,
		);
		$this->model->update($where,$data,'user');
		redirect('admin/user');
	}
	public function hapus_us($id)
	{
		$where = array('id_user' => $id);
		$this->model->hapus($where,'user');
		redirect('admin/user');
	}
	public function user()
	{
		$data['user'] = $this->model->tampil('user')->result();
		$this->load->view('admin/head');
		$this->load->view('admin/menu');
		$this->load->view('admin/user',$data);
		$this->load->view('admin/footer');
	}
	
}
?>