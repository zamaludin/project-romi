<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @copyright  (c) 2014-2016
 * @link       http://inorobo.com
 * @since      Version 1.4.7
 *
 * 
 */

class Dashboard extends MY_Controller {

	public function __construct() {
      parent::__construct();
   }

	public function index() {
		$this->data['title'] = 'Dashboard';
		$this->data['dashboard'] = TRUE;
		$this->data['alert'] = $this->session->flashdata('alert');
		$ppdb_tahun = $this->setting['ppdb_tahun'];
		if ($this->session->userdata('level') == 'administrator' || $this->session->userdata('level') == 'operator') {
			$this->data['count_inbox'] = $this->db->count_all('hubungi_kami');
			$this->data['count_ptk'] = $this->db->count_all_results('ptk');
			$this->data['count_file'] = $this->db->count_all('file');
			$this->data['count_ppdb'] = $this->db->where("LEFT(no_daftar, 4) = $ppdb_tahun")->count_all_results('siswa');
			$this->data['count_photo'] = $this->db->count_all('photo');
			$this->data['count_posts'] = $this->db
				->where('post_type', 'post')
				->count_all_results('posts');
			$this->data['count_pages'] = $this->db
				->where('post_type', 'page')
				->count_all_results('posts');
			$this->data['inbox'] = $this->db->limit(5)->order_by('tanggal', 'DESC')->get('hubungi_kami');
			$this->data['agenda'] = $this->db
												->where('post_type', 'agenda')
												->limit(5)
												->order_by('post_date', 'DESC')
												->get('posts');
		}
		$this->data['content'] = 'backend/dashboard';
		$this->load->view('backend/index', $this->data);
	}
}