<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @copyright  (c) 2014-2016
 * @link       http://inorobo.com
 * @since      Version 1.4.7
 *
 * PERINGATAN :
 * 1. TIDAK DIPERKENANKAN MEMPERJUALBELIKAN APLIKASI INI TANPA SEIZIN DARI PIHAK PENGEMBANG APLIKASI.
 * 2. TIDAK DIPERKENANKAN MENGHAPUS KODE SUMBER APLIKASI.
 * 3. TIDAK MENYERTAKAN LINK KOMERSIL (JASA LAYANAN HOSTING DAN DOMAIN) YANG MENGUNTUNGKAN SEPIHAK.
 */

class Caching extends MY_Controller {

	private $pk = 'id';
	private $table = 'options';

	public function __construct() {
      parent::__construct();
   }

	public function index() {
		if ($_POST) {
			if ($this->input->post('cache_file') == 'n') {
				$this->delete_cache();
			}
			$this->db->where('variable', 'cache_file')->update($this->table, ['value' => $this->input->post('cache_file')]);
			$this->session->set_flashdata('alert', alert('success', status('updated')));
			redirect(uri_string());
		} else {
			$this->data['title'] = 'Web Page Caching';
			$this->data['button'] = 'SAVE';
			$this->data['action'] = site_url(uri_string());
			$this->data['setting'] = $this->data['caching'] = TRUE;
			$this->data['alert'] = $this->session->flashdata('alert');
			$this->data['content'] = 'caching';
			$this->load->view('backend/index', $this->data);
		}
	}

	private function delete_cache() {
		$this->load->helper('directory');
		$path = APPPATH . 'cache';
		$files = directory_map($path, FALSE, TRUE);
		foreach ($files as $file) {
			if ($file !== 'index.html' && $file !== '.htaccess') {
				@unlink($path . '/' . $file);
			}
		}
	}
}

/* End of file Caching.php */
/* Location: ./application/controllers/ppdb/Caching.php */