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

class Confirmation extends MY_Controller {

   public function __construct() {
      parent::__construct();
      if ($this->setting['ppdb_status'] == 'close') {
         redirect(base_url());
      }
   }

   public function index() {
      $id = decode_url($this->uri->segment(4));
      if ($id && $id != 0 && ctype_digit((string) $id)) {
         $this->data['ppdb'] = TRUE;
         $this->data['alert'] = $this->session->flashdata('alert');
         $this->data['title'] = 'Penerimaan Peserta Didik Baru ' . $this->setting['ppdb_tahun'];
         $this->data['query'] = $this->m_global->find('view_siswa', 'id', $id)->row_array();
         $this->data['content'] = 'themes/' . $this->setting['themes'] . '/ppdb-sd/ppdb-confirmation';
         $this->load->view('themes/' . $this->setting['themes'] . '/index', $this->data);
      } else {
         $alert = '<div class="alert alert-danger">Anda tidak diperkenankan memanipulasi URL</div>';
         $this->session->set_flashdata('alert', $alert);
         redirect('ppdb-sd/registration');
      }
   }
}