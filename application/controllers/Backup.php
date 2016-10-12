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

class Backup extends MY_Controller {

   public function __construct() {
      parent::__construct();
   }

	public function index() {
		if ($this->session->userdata('level') != 'administrator') {
			exit('You cannot access this page!');
		} else {
			$this->load->dbutil();
			$prefs = array(
				'ignore' => ['view_siswa', 'view_kelas', 'view_polling'],
				'format'   => 'zip',
				'filename' => 'BACKUP-DATABASE-'.date("Y-m-d H-i-s").'.sql'
			);
			$backup =& $this->dbutil->backup($prefs); 
			$file_name = 'backup-on-'. date("Y-m-d-H-i-s") .'.zip';
			$this->zip->download($file_name);
		}
	}
}