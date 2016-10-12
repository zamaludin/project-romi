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

class Verifikasi extends MY_Controller {

   public function __construct() {
      parent::__construct();
   }
   
   public function index() {
      if ($_POST) {
         $query = $this->db
            ->where('no_daftar', $this->input->post('no_daftar'))
            ->get('view_siswa');
         if ($query->num_rows() == 1) {
            $this->data['query'] = $this->m_global->find('view_siswa', 'no_daftar', $this->input->post('no_daftar'))->row_array();
            $this->load->view('ppdb/ppdb-cetak-formulir', $this->data);
         } else {
            $this->session->set_flashdata('alert', alert('error', status('404')));
            redirect($this->uri->segment(1) . '/' . $this->uri->segment(2));
         }
      } else {
         $this->data['title'] = 'Verifikasi Pendaftaran';
         $this->data['button'] = 'VERIFIKASI';
         $this->data['action'] = site_url(uri_string());
         $this->data['ppdb'] = $this->data['verifikasi'] = TRUE;
         $this->data['alert'] = $this->session->flashdata('alert');
         $this->data['content'] = 'ppdb-verifikasi';
         $this->load->view('backend/index', $this->data);
      }
   }
}