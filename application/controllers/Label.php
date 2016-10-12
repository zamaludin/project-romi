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

class Label extends MY_Controller {

   private $pk = 'id';
   private $table = 'options';

   public function __construct() {
      parent::__construct();
   }

   public function index() {
      if ($_POST) {
         if ($this->validation()) {
            $this->db->where('variable', 'set_menu_label')->update($this->table, ['value' => $this->field_data()]);
            $this->session->set_flashdata('alert', alert('success', status('updated')));
         } else {
            $this->session->set_flashdata('alert', alert('error', validation_errors()));
         }
         redirect(uri_string());
      } else {
         $this->data['title'] = 'Pengaturan Label Widget';
         $this->data['button'] = 'SIMPAN PENGATURAN LABEL WIDGET';
         $this->data['action'] = site_url(uri_string());
         $this->data['setting'] = $this->data['labels'] = TRUE;
         $this->data['alert'] = $this->session->flashdata('alert');
         $this->data['set_menu'] = json_decode($this->setting['set_menu_label'], true);
         $this->data['content'] = 'menu';
         $this->load->view('backend/index', $this->data);
      }
   }

   private function field_data() {
      $menu = [
         'home' => $this->input->post('home'),
         'direktori' => $this->input->post('direktori'),
         'event' => $this->input->post('event'),         
         'direktori_ptk' => $this->input->post('direktori_ptk'),
         'direktori_siswa' => $this->input->post('direktori_siswa'),
         'direktori_alumni' => $this->input->post('direktori_alumni'),
         'sambutan_kepala_sekolah' => $this->input->post('sambutan_kepala_sekolah'),
         'prestasi' => $this->input->post('prestasi'),
         'prestasi_sekolah' => $this->input->post('prestasi_sekolah'),
         'prestasi_ptk' => $this->input->post('prestasi_ptk'),
         'prestasi_siswa' => $this->input->post('prestasi_siswa'),
         'ppdb' => $this->input->post('ppdb'),
         'daftar_sekarang' => $this->input->post('daftar_sekarang'),
         'hasil_seleksi' => $this->input->post('hasil_seleksi'),
         'cetak_formulir' => $this->input->post('cetak_formulir'),
         'grafik_ppdb' => $this->input->post('grafik_ppdb'),
         'download_formulir' => $this->input->post('download_formulir'),
         'download' => $this->input->post('download'),
         'gallery' => $this->input->post('gallery'),
         'gallery_photo' => $this->input->post('gallery_photo'),
         'gallery_video' => $this->input->post('gallery_video'),
         'hubungi_kami' => $this->input->post('hubungi_kami'),
         'jajak_pendapat' => $this->input->post('jajak_pendapat'),
         'banner' => $this->input->post('banner'),
         'login' => $this->input->post('login'),
         'kategori' => $this->input->post('kategori'),
         'arsip' => $this->input->post('arsip'),
         'tautan' => $this->input->post('tautan'),
         'yahoo' => $this->input->post('yahoo'),
      ];
      return json_encode($menu);
   }

   private function validation() {
      $this->load->library('form_validation');
      $this->form_validation->set_rules('home', 'Home', 'trim|required');
      $this->form_validation->set_rules('direktori', 'Direktori', 'trim|required');
      $this->form_validation->set_rules('event', 'Agenda Sekolah', 'trim|required');
      $this->form_validation->set_rules('direktori_ptk', 'Direktori PTK', 'trim|required');
      $this->form_validation->set_rules('direktori_siswa', 'Direktori Siswa', 'trim|required');
      $this->form_validation->set_rules('direktori_alumni', 'Direktori Alumni', 'trim|required');
      $this->form_validation->set_rules('sambutan_kepala_sekolah', 'Sambutan Kepala Sekolah', 'trim|required');
      $this->form_validation->set_rules('prestasi', 'Prestasi', 'trim|required');
      $this->form_validation->set_rules('prestasi_sekolah', 'Prestasi Sekolah', 'trim|required');
      $this->form_validation->set_rules('prestasi_ptk', 'Prestasi PTK', 'trim|required');
      $this->form_validation->set_rules('prestasi_siswa', 'Prestasi Siswa', 'trim|required');
      $this->form_validation->set_rules('ppdb', 'PPDB', 'trim|required');
      $this->form_validation->set_rules('daftar_sekarang', 'Daftar Sekarang', 'trim|required');
      $this->form_validation->set_rules('hasil_seleksi', 'Hasil Seleksi', 'trim|required');
      $this->form_validation->set_rules('cetak_formulir', 'Cetak Formulir', 'trim|required');
      $this->form_validation->set_rules('grafik_ppdb', 'Grafik PPDB', 'trim|required');
      $this->form_validation->set_rules('download_formulir', 'Download Formulir', 'trim|required');
      $this->form_validation->set_rules('download', 'Download', 'trim|required');
      $this->form_validation->set_rules('gallery', 'Gallery', 'trim|required');
      $this->form_validation->set_rules('gallery_photo', 'Gallery Photo', 'trim|required');
      $this->form_validation->set_rules('gallery_video', 'Gallery Video', 'trim|required');
      $this->form_validation->set_rules('hubungi_kami', 'Hubungi Kami', 'trim|required');
      $this->form_validation->set_rules('jajak_pendapat', 'Jajak Pendapat', 'trim|required');
      $this->form_validation->set_rules('banner', 'Banner', 'trim|required');
      $this->form_validation->set_rules('login', 'Login', 'trim|required');
      $this->form_validation->set_rules('kategori', 'Kategori', 'trim|required');
      $this->form_validation->set_rules('arsip', 'Arsip', 'trim|required');
      $this->form_validation->set_rules('tautan', 'Tautan', 'trim|required');
      $this->form_validation->set_rules('yahoo', 'Yahoo Messenger', 'trim|required');
      $this->form_validation->set_error_delimiters('', '<br>');
      return $this->form_validation->run();
   }
}

/* End of file menu.php */
/* Location: ./application/controllers/menu.php */