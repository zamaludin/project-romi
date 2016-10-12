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

class Statistik extends MY_Controller {

   public function __construct() {
      parent::__construct();
   }
   
   public function index() {
      redirect('ppdb-sd/statistik/frontend');
   }

   public function frontend() {
      $this->output->cache(5);
      $this->data['ppdb'] = TRUE;
      $this->data['alert'] = $this->session->flashdata('alert');
      $tahun = date('Y');
      $this->data['title'] = 'Grafik PPDB Tahun ' . $tahun;
      $this->data['q_tahun'] = $this->db->query("
      	SELECT LEFT(tanggal_daftar, 4) AS tahun
			FROM siswa
			WHERE tanggal_daftar != '0000-00-00'
			GROUP BY 1
			ORDER BY 1 DESC
		");
      $this->data['per_bulan'] = $this->m_global->per_bulan($tahun);
      $this->data['per_kelamin'] = $this->m_global->per_kelamin($tahun);
      $this->data['per_sekolah'] = $this->m_global->per_sekolah($tahun);
      $this->data['content'] = 'themes/' . $this->setting['themes'] . '/ppdb-sd/ppdb-statistik';
      $this->load->view('themes/' . $this->setting['themes'] . '/index', $this->data);
   }

   public function redirect_tahun() {
      redirect('ppdb-sd/statistik/tahun/' . $this->input->post('tahun'));
   }

   public function tahun() {
      $this->output->cache(5);
      $tahun = $this->uri->segment(4);
      if ($tahun) {
         $this->data['ppdb'] = TRUE;
         $this->data['alert'] = $this->session->flashdata('alert');
         $this->data['title'] = 'Grafik PPDB Tahun ' . $tahun;
         $this->data['q_tahun'] = $this->db->query("
         	SELECT LEFT(tanggal_daftar, 4) AS tahun
            FROM siswa
            WHERE tanggal_daftar != '0000-00-00'
            GROUP BY 1
            ORDER BY 1 DESC
			");
         $this->data['per_bulan'] = $this->m_global->per_bulan($tahun);
         $this->data['per_kelamin'] = $this->m_global->per_kelamin($tahun);
         $this->data['per_sekolah'] = $this->m_global->per_sekolah($tahun);
         $this->data['content'] = 'themes/' . $this->setting['themes'] . '/ppdb-sd/ppdb-statistik';
         $this->load->view('themes/' . $this->setting['themes'] . '/index', $this->data);
      } else {
         redirect('ppdb-sd/statistik/');
      }
   }
}