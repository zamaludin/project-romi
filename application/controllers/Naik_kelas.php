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

class Naik_kelas extends MY_Controller {

   private $pk = 'id';
   private $table = 'siswa';

   public function __construct() {
      parent::__construct();
   }

   public function index() {
      $kelas_id = $this->uri->segment(3);
      if (!$kelas_id) {
         $query = $this->db
            ->select('kelas_id')
            ->limit(1)
            ->get('kelas')
            ->row_array();
         $kelas_id = $query['kelas_id'];
      }

      $this->data['title'] = 'Data Siswa Kelas ' . $this->m_global->get_kelas($kelas_id);
      $this->data['siswa'] = $this->data['naik_kelas'] = TRUE;
      $this->data['alert'] = $this->session->flashdata('alert');
      $this->data['q_kelas'] = $this->db->get('view_kelas');
      $this->data['query'] = $this->db
         ->select('id, nis, nisn, nama, jenis_kelamin')
         ->where('status_siswa', 'aktif')
         ->where('kelas_id', $kelas_id)
         ->get($this->table);
      $this->data['content'] = 'siswa/naik_kelas';
      $this->load->view('backend/index', $this->data);
   }

   public function create() {
      if (isset($_POST['id'])) {
         $url = $this->input->post('url');
         $kelas_tujuan = $this->input->post('kelas_tujuan');
         if ($kelas_tujuan == 'lulus') {
            $counter = 0;
            foreach ($_POST['id'] as $id) {
               $this->db
                  ->where('id', $id)
                  ->update('siswa', ['status_siswa' => 'lulus', 'tahun_lulus' => date('Y')]);
               $counter++;
            }
         } else {
            $counter = 0;
            foreach ($_POST['id'] as $id) {
               $this->db->where('id', $id)->update('siswa', ['kelas_id' => $kelas_tujuan]);
               $counter++;
            }
         }
         $counter > 0 ?
         $this->session->set_flashdata('alert', alert('success', 'kenaikan kelas sudah diproses !')) :
         $this->session->set_flashdata('alert', alert('warning', 'kenaikan kelas tidak dapat diproses !'));
         redirect($url);
      } else {
         $this->session->set_flashdata('alert', alert('warning', status('not_selected')));
         redirect($this->uri->segment(1));
      }
   }
}

/* End of file Naik_kelas.php */
/* Location: ./application/controllers/Naik_kelas.php */