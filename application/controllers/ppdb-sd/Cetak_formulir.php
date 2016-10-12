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

class Cetak_formulir extends MY_Controller {

   public function __construct() {
      parent::__construct();
      if ($this->setting['ppdb_status'] == 'close') {
         redirect(base_url());
      }
   }

   public function index() {
      $this->load->library('form_validation');
      $this->form_validation->set_rules('no_daftar', 'Nomor Pendaftaran', 'trim|required');
      $this->form_validation->set_rules('tanggal_lahir', 'Tanggal Lahir', 'trim|required|callback_check_date');
      $this->form_validation->set_message('required', 'Isian %s harus diisi');
      $this->form_validation->set_error_delimiters('<div class="block-error">', '</div>');
      if ($this->form_validation->run() == FALSE) {
         $this->data['ppdb'] = TRUE;
         $this->data['alert'] = $this->session->flashdata('alert');
         $this->data['title'] = 'Cetak Formulir PPDB Tahun ' . $this->setting['ppdb_tahun'];
         $this->data['button'] = 'CETAK FORMULIR';
         $this->data['action'] = site_url(uri_string());
         $this->data['content'] = 'themes/' . $this->setting['themes'] . '/ppdb-sd/ppdb-check';
         $this->load->view('themes/' . $this->setting['themes'] . '/index', $this->data);
      } else {
         $no_daftar = $this->input->post('no_daftar');
         $tanggal_lahir = $this->input->post('tanggal_lahir');
         $tahun = $this->setting['ppdb_tahun'];
         $query = $this->db
            ->where('no_daftar', $no_daftar)
            ->where('tanggal_lahir', $tanggal_lahir)
            ->where('LEFT(tanggal_daftar, 4) =', $tahun)
            ->get('view_siswa');
         if ($query->num_rows() == 1) {
            $this->data['query'] = $query->row_array(); 
            $this->load->view('ppdb-sd/ppdb-cetak-formulir', $this->data);
         } else {
            $alert = '<div class="alert alert-danger">';
            $alert .= 'Data tidak ditemukan!';
            $alert .= '</div>';
            $this->session->set_flashdata('alert', $alert);
            redirect('ppdb-sd/cetak_formulir');
         }
      }
   }

   /**
    * check date validation format
    * @return boolean
    */
   public function check_date($date) {
      $split = [];
      if (is_valid_date($date)) {
         return true;
      }
      $this->form_validation->set_message('check_date', 'Format tanggal diisi dengan format YYYY-MM-DD');
      return false;
   }
}

/* End of file check.php */
/* Location: ./application/controllers/ppdb/check.php */