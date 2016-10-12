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

class Check extends MY_Controller {

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
         $this->data['title'] = 'Hasil Seleksi PPDB Tahun ' . $this->setting['ppdb_tahun'];
         $this->data['button'] = 'LIHAT HASIL SELEKSI';
         $this->data['action'] = site_url(uri_string());
         $this->data['content'] = 'themes/' . $this->setting['themes'] . '/ppdb-sd/ppdb-check';
         $this->load->view('themes/' . $this->setting['themes'] . '/index', $this->data);
      } else {
         $no_daftar = $this->input->post('no_daftar');
         $tanggal_lahir = $this->input->post('tanggal_lahir');
         $tahun = $this->setting['ppdb_tahun'];
         $query = $this->db
            ->select('no_daftar, nama, hasil_seleksi')
            ->where('no_daftar', $no_daftar)
            ->where('LEFT(tanggal_daftar, 4) =', $tahun)
            ->where('tanggal_lahir', $tanggal_lahir)
            ->get('view_siswa');
         if ($query->num_rows() == 1) {
            $row = $query->row_array();
            if ($row['hasil_seleksi'] == 'belum_diseleksi') {
               $alert = '<div class="alert alert-success">';
               $alert .= 'Proses seleksi Penerimaan Peserta Didik Baru Tahun ' . $tahun . ' ' . $this->setting['nama_sekolah'] . ' belum selesai.';
               $alert .= '</div>';
               $this->session->set_flashdata('alert', $alert);
            } else if ($row['hasil_seleksi'] == 'tidak_diterima') {
               $alert = '<div class="alert alert-success">';
               $alert .= 'Mohon maaf ' . $row['nama'] . ' ! Anda belum berhasil lolos seleksi Penerimaan Peserta Didik Baru Tahun ' . $tahun . ' ' . $this->setting['nama_sekolah'];
               $alert .= '</div>';
               $this->session->set_flashdata('alert', $alert);
            } else if ($row['hasil_seleksi'] == 'diterima') {
               $alert = '<div class="alert alert-success">';
               $alert .= 'Selamat ' . $row['nama'] . ' ! Anda berhasil lolos seleksi Penerimaan Peserta Didik Baru Tahun ' . $tahun . ' ' . $this->setting['nama_sekolah'];
               $alert .= '</div>';
               $this->session->set_flashdata('alert', $alert);
            }
         } else {
            $alert = '<div class="alert alert-danger">';
            $alert .= 'Data tidak ditemukan!';
            $alert .= '</div>';
            $this->session->set_flashdata('alert', $alert);
         }
         redirect('ppdb-sd/check');
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