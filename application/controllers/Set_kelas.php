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

class Set_kelas extends MY_Controller {

   private $pk = 'id';
   private $table = 'siswa';

   public function __construct() {
      parent::__construct();
   }

   public function index() {
      $this->data['title'] = 'Pengaturan Kelas Siswa';
      $this->data['siswa'] = $this->data['set_kelas'] = TRUE;
      $this->data['alert'] = $this->session->flashdata('alert');
      $this->data['q_kelas'] = $this->db->get('view_kelas');
      $this->data['query'] = $this->db
         ->select('id, no_daftar, nis, nisn, nama, jenis_kelamin')
         ->where('kelas_id IS NULL')
         ->order_by('nama', 'ASC')
         ->get('view_siswa');
      $this->data['content'] = 'siswa/set_kelas';
      $this->load->view('backend/index', $this->data);
   }

   public function create() {
      if (isset($_POST['id'])) {
         $url = $this->input->post('url');
         $kelas_tujuan = $this->input->post('kelas_tujuan');
         $counter = 0;
         foreach ($_POST['id'] as $id) {
            $this->db->where('id', $id)->update('siswa', array('kelas_id' => $kelas_tujuan, 'status_siswa' => 'aktif'));
            $counter++;
         }
         $counter > 0 ?
         $this->session->set_flashdata('alert', alert('success', 'Pengaturan kelas sudah diproses !')) :
         $this->session->set_flashdata('alert', alert('warning', 'Pengaturan kelas tidak dapat diproses !'));
         redirect($url);
      } else {
         $this->session->set_flashdata('alert', alert('warning', status('not_selected')));
         redirect($this->uri->segment(1));
      }
   }
}

/* End of file set_kelas.php */
/* Location: ./application/controllers/set_kelas.php */