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

class Seleksi extends MY_Controller {

   private $pk = 'id';
   private $table = 'siswa';

   public function __construct() {
      parent::__construct();
   }

   public function index() {
      $tahun = $this->uri->segment(4) == FALSE ? $this->setting['ppdb_tahun'] : $this->uri->segment(4);
      $this->load->library('pagination');
      $config['base_url'] = site_url('ppdb-sd/seleksi/index/' . $tahun);
      $config['uri_segment'] = 5;
      $config['total_rows'] = $this->db
         ->where('status_siswa', 'baru')
         ->where('hasil_seleksi', 'belum_diseleksi')
         ->where('LEFT(tanggal_daftar, 4) =', $tahun)
         ->count_all_results('view_siswa');
      $config['per_page'] = 10;
      $config['prev_link'] = 'Prev';
      $config['next_link'] = 'Next';
      $config['prev_tag_open'] = '<li>';
      $config['prev_tag_close'] = '</li>';
      $config['next_tag_open'] = '<li>';
      $config['next_tag_close'] = '</li>';
      $config['first_link'] = '&laquo;';
      $config['last_link'] = '&raquo;';
      $config['first_tag_open'] = '<li>';
      $config['first_tag_close'] = '</li>';
      $config['last_tag_open'] = '<li>';
      $config['last_tag_close'] = '</li>';
      $config['num_tag_open'] = '<li>';
      $config['num_tag_close'] = '</li>';
      $config['cur_tag_open'] = '<li><a>';
      $config['cur_tag_close'] = '</a></li>';
      $this->pagination->initialize($config);
      $this->data['pagination'] = $this->pagination->create_links();
      $this->data['total_rows'] = $config['total_rows'];
      $this->data['title'] = 'Seleksi Calon Peserta Didik Baru Tahun ' . $tahun;
      $this->data['ppdb'] = $this->data['seleksi'] = TRUE;
      $this->data['alert'] = $this->session->flashdata('alert');
      $this->data['action'] = site_url('ppdb-sd/seleksi/save');
      $this->data['q_tahun'] = $this->db->query("
         SELECT LEFT(tanggal_daftar, 4) AS tahun
         FROM siswa
         WHERE tanggal_daftar != '0000-00-00'
         GROUP BY 1
         ORDER BY 1 DESC
      ");
      $this->data['query'] = $this->db
         ->where('status_siswa', 'baru')
         ->where('hasil_seleksi', 'belum_diseleksi')
         ->where('LEFT(tanggal_daftar, 4) =', $tahun)
         ->get('view_siswa', $config['per_page'], $this->uri->segment(5));
      $this->data['content'] = 'ppdb-sd/seleksi';
      $this->load->view('backend/index', $this->data);
   }

   public function save() {
      if (isset($_POST['simpan']) && isset($_POST[$this->pk])) {
         $n = 0;
         $hasil_seleksi = $this->input->post('hasil_seleksi');
         foreach ($_POST[$this->pk] as $key) {
            if ($this->db->where($this->pk, $key)->update($this->table, array('hasil_seleksi' => $hasil_seleksi))) {
               $n++;
            }
         }

         $n > 0 ?
         $this->session->set_flashdata('alert', alert('success', 'Hasil seleksi sudah tersimpan!')) :
         $this->session->set_flashdata('alert', alert('info', 'Hasil seleksi tidak tersimpan!'));
      } else {
         $this->session->set_flashdata('alert', alert('warning', status('not_selected')));
      }

      redirect($this->input->post('url'));
   }

   public function clear() {
      if (isset($_POST['delete']) && isset($_POST[$this->pk])) {
         $n = 0;
         foreach ($_POST[$this->pk] as $key) {
            $photo = $this->m_global->find($this->table, $this->pk, $key)->row_array();
            if ($this->db->where($this->pk, $key)->delete($this->table)) {
               @unlink('./assets/siswa/' . $photo['photo']);
               $n++;
            }
         }
         $n > 0 ?
         $this->session->set_flashdata('alert', alert('success', status('deleted'))) :
         $this->session->set_flashdata('alert', alert('info', status('not_deleted')));
      } else if ($this->uri->segment(4)) {
         $photo = $this->m_global->find($this->table, $this->pk, $this->uri->segment(4))->row_array();
         if ($this->db->where($this->pk, $this->uri->segment(4))->delete($this->table)) {
            @unlink('./assets/siswa/' . $photo['photo']);
            $this->session->set_flashdata('alert', alert('success', status('deleted')));
         } else {
            $this->session->set_flashdata('alert', alert('info', status('not_deleted')));
         }
      } else {
         $this->session->set_flashdata('alert', alert('warning', status('not_selected')));
      }
      redirect('ppdb-sd/siswa');
   }
}

/* End of file siswa.php */
/* Location: ./application/controllers/ppdb-sd/siswa.php */