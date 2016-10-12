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

class Hasil_seleksi extends MY_Controller {

   private $pk = 'id';
   private $table = 'siswa';

   public function __construct() {
      parent::__construct();
      if ($this->setting['ppdb_status'] == 'close') {
         redirect(base_url());
      }
   }
   
   public function index() {
      redirect('ppdb-sd/hasil_seleksi/diterima');
   }

   public function diterima() {
      $tahun = $this->uri->segment(4) == FALSE ? $this->setting['ppdb_tahun'] : $this->uri->segment(4);
      $this->load->library('pagination');
      $config['base_url'] = site_url('ppdb-sd/hasil_seleksi/diterima/' . $tahun);
      $config['uri_segment'] = 5;
      $config['total_rows'] = $this->db
         ->where('LEFT(tanggal_daftar, 4) =', $tahun)
         ->where_not_in('hasil_seleksi', array('belum_diseleksi', 'tidak_diterima'))
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
      $this->data['title'] = 'Hasil Seleksi PPDB Tahun ' . $tahun . ' yang Diterima';
      $this->data['ppdb'] = $this->data['diterima'] = TRUE;
      $this->data['alert'] = $this->session->flashdata('alert');
      $this->data['q_tahun'] = $this->db->query("
         SELECT LEFT(tanggal_daftar, 4) AS tahun
   		FROM siswa
   		WHERE tanggal_daftar != '0000-00-00'
   		GROUP BY LEFT(tanggal_daftar, 4)
   		ORDER BY LEFT(tanggal_daftar, 4) DESC
      ");
      $this->data['query'] = $this->db
         ->where('LEFT(tanggal_daftar, 4) =', $tahun)
         ->where_not_in('hasil_seleksi', array('belum_diseleksi', 'tidak_diterima'))
         ->get('view_siswa', $config['per_page'], $this->uri->segment(5));
      $this->data['content'] = 'ppdb-sd/hasil_seleksi';
      $this->load->view('backend/index', $this->data);
   }

   public function tidak_diterima() {
      $tahun = $this->uri->segment(4) == FALSE ? $this->setting['ppdb_tahun'] : $this->uri->segment(4);

      $this->load->library('pagination');
      $config['base_url'] = site_url('ppdb-sd/hasil_seleksi/diterima/' . $tahun);
      $config['uri_segment'] = 5;
      $config['total_rows'] = $this->db
         ->where('LEFT(tanggal_daftar, 4) =', $tahun)
         ->where('hasil_seleksi', 'tidak_diterima')
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
      $this->data['title'] = 'Hasil Seleksi PPDB Tahun ' . $tahun . ' yang Tidak Diterima';
      $this->data['ppdb'] = $this->data['tidak_diterima'] = TRUE;
      $this->data['alert'] = $this->session->flashdata('alert');
      $this->data['q_tahun'] = $this->db->query("
      	SELECT LEFT(tanggal_daftar, 4) AS tahun
			FROM siswa
			WHERE tanggal_daftar != '0000-00-00'
			GROUP BY LEFT(tanggal_daftar, 4)
			ORDER BY LEFT(tanggal_daftar, 4) DESC
		");
      $this->data['query'] = $this->db
         ->where('LEFT(tanggal_daftar, 4) =', $tahun)
         ->where('hasil_seleksi', 'tidak_diterima')
         ->get('view_siswa', $config['per_page'], $this->uri->segment(5));
      $this->data['content'] = 'ppdb-sd/hasil_seleksi';
      $this->load->view('backend/index', $this->data);
   }

   public function clear() {
      if (isset($_POST['clear']) && isset($_POST[$this->pk])) {
         $n = 0;
         foreach ($_POST[$this->pk] as $key) {
            if ($this->db->where($this->pk, $key)->update($this->table, array('hasil_seleksi' => 'belum_diseleksi'))) {
               $n++;
            }
         }
         $n > 0 ?
         $this->session->set_flashdata('alert', alert('success', 'Hasil seleksi sudah dihapus!')) :
         $this->session->set_flashdata('alert', alert('info', 'Hasil seleksi tidak terhapus!'));
      } else {
         $this->session->set_flashdata('alert', alert('warning', status('not_selected')));
      }
      redirect($this->input->post('url'));
   }

   public function export_excel() {
      $tahun = $this->uri->segment(5) ? $this->uri->segment(5) : $this->setting['ppdb_tahun'];
      $hasil_seleksi = $this->uri->segment(4);
      $file_name = '';
      if ($hasil_seleksi == 'diterima') {
         $query = $this->db
            ->where('LEFT(tanggal_daftar, 4) =', $tahun)
            ->where_not_in('hasil_seleksi', array('belum_diseleksi', 'tidak_diterima'))
            ->get('view_siswa');
         $file_name = 'Hasil Seleksi PPDB Tahun ' . $tahun . ' yang Diterima.xls';
      } else if ($hasil_seleksi == 'tidak_diterima') {
         $query = $this->db
            ->where('LEFT(tanggal_daftar, 4) =', $tahun)
            ->where('hasil_seleksi', 'tidak_diterima')
            ->get('view_siswa');
         $file_name = 'Hasil Seleksi PPDB Tahun ' . $tahun . ' yang Tidak Diterima.xls';
      }

      header("Content-Type: application/xls");
      header("Content-Disposition: attachment; filename=$file_name");
      header("Pragma: no-cache");
      header("Expires: 0");
      $no = 1;
      $table = '<table border="1">';
      $table .= '<tr>';
      $table .= '<td>NO</td>';
      $table .= '<td>NO. PENDAFTARAN</td>';
      $table .= '<td>TANGGAL PENDAFTARAN</td>';
      $table .= '<td>HASIL SELEKSI</td>';
      $table .= '<td>NAMA CALON PESERTA DIDIK</td>';
      $table .= '<td>TEMPAT LAHIR</td>';
      $table .= '<td>TANGGAL LAHIR</td>';
      $table .= '<td>JENIS KELAMIN</td>';
      $table .= '<td>AGAMA</td>';
      $table .= '<td>STATUS ANAK</td>';
      $table .= '<td>ANAK KE</td>';
      $table .= '<td>ALAMAT</td>';
      $table .= '<td>TELEPON</td>';
      $table .= '<td>TK ASAL</td>';
      $table .= '<td>NAMA AYAH</td>';
      $table .= '<td>NAMA IBU</td>';
      $table .= '<td>ALAMAT ORANG TUA</td>';
      $table .= '<td>TELEPON ORANG TUA</td>';
      $table .= '<td>PEKERJAAN AYAH</td>';
      $table .= '<td>PEKERJAAN IBU</td>';
      $table .= '<td>NAMA WALI</td>';
      $table .= '<td>ALAMAT WALI</td>';
      $table .= '<td>TELEPON WALI</td>';
      $table .= '<td>PEKERJAAN WALI</td>';
      $table .= '</tr>';
      foreach ($query->result_array() as $data) {
         $table .= '<tr>';
         $table .= '<td>'.$no.'</td>';
         $table .= '<td>'.$data['no_daftar'].'</td>';
         $table .= '<td>'.indo_date($data['tanggal_daftar']).'</td>';
         if ($data['hasil_seleksi'] == 'tidak_diterima') {
            $table .= '<td>'.'Tidak Diterima'.'</td>';
         } else {
            $table .= '<td>'.'Diterima'.'</td>';         
         }
         $table .= '<td>'.$data['nama'].'</td>';
         $table .= '<td>'.$data['tempat_lahir'].'</td>';
         $table .= '<td>'.indo_date($data['tanggal_lahir']).'</td>';
         $table .= '<td>'.$data['jenis_kelamin'].'</td>';
         $table .= '<td>'.$data['agama'].'</td>';
         $table .= '<td>'.$data['status_anak'].'</td>';
         $table .= '<td>'.$data['anak_ke'].'</td>';
         $table .= '<td>'.$data['alamat'].'</td>';
         $table .= '<td>'.$data['telp_rumah'].'</td>';
         $table .= '<td>'.$data['sekolah_asal'].'</td>';
         $table .= '<td>'.$data['ayah'].'</td>';
         $table .= '<td>'.$data['ibu'].'</td>';
         $table .= '<td>'.$data['alamat_ortu'].'</td>';
         $table .= '<td>'.$data['telp_ortu'].'</td>';
         $table .= '<td>'.$data['pekerjaan_ayah'].'</td>';
         $table .= '<td>'.$data['pekerjaan_ibu'].'</td>';
         $table .= '<td>'.$data['nama_wali'].'</td>';
         $table .= '<td>'.$data['alamat_wali'].'</td>';
         $table .= '<td>'.$data['telp_wali'].'</td>';
         $table .= '<td>'.$data['pekerjaan_wali'].'</td>';
         $table .= '</tr>';  
         $no++;
      }
      $table .= '</table>';
      echo $table;
   }
}

/* End of file siswa.php */
/* Location: ./application/controllers/siswa.php */