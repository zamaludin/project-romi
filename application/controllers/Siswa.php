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

require APPPATH . 'third_party/PHPExcel.php';

class Siswa extends MY_Controller {

   private $pk = 'id';
   private $table = 'siswa';

   public function __construct() {
      parent::__construct();
   }

   public function index() {
      redirect('siswa/status/aktif');
   }

   public function status() {
      $status = $this->uri->segment(3);
      if ($status) {
         $title = '';
         if ($status == 'aktif') {
            $title = 'Data Siswa Aktif';
         } else if ($status == 'pindah') {
            $title = 'Data Siswa Pindah Sekolah';
         } else if ($status == 'dropout') {
            $title = 'Data Siswa Drop Out / Dikeluarkan';
         } else if ($status == 'lulus') {
            $title = 'Data Alumni';
         }
         $this->load->library('pagination');
         $config['base_url'] = site_url('siswa/status/' . $status);
         $config['uri_segment'] = 4;
         $config['total_rows'] = $this->db
            ->where('status_siswa', $status)
            ->count_all_results($this->table);
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
         $this->data['title'] = $title;
         $this->data['siswa'] = $this->data[$this->uri->segment(3)] = TRUE;
         $this->data['alert'] = $this->session->flashdata('alert');
         $this->data['q_kelas'] = $this->db->get('kelas');
         $this->data['query'] = $this->db
            ->where('status_siswa', $status)
            ->get('siswa', $config['per_page'], $this->uri->segment(4));
         $this->data['content'] = 'siswa/read';
         $this->load->view('backend/index', $this->data);
      } else {
         $this->session->set_flashdata('alert', alert('error', status('404')));
         redirect($this->uri->segment(1));
      }
   }

   public function kelas() {
      $kelas_id = $this->uri->segment(3);
      if ($kelas_id) {
         $this->load->library('pagination');
         $config['base_url'] = site_url('siswa/kelas/' . $kelas_id);
         $config['uri_segment'] = 4;
         $config['total_rows'] = $this->db
            ->where('status_siswa', 'aktif')
            ->where('kelas_id', $kelas_id)
            ->count_all_results($this->table);
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
         $this->data['title'] = 'Data Siswa Kelas ' . $this->m_global->get_kelas($kelas_id);
         $this->data['siswa'] = $this->data['aktif'] = TRUE;
         $this->data['alert'] = $this->session->flashdata('alert');
         $this->data['q_kelas'] = $this->db->get('kelas');
         $this->data['query'] = $this->db
            ->where('status_siswa', 'aktif')
            ->where('kelas_id', $kelas_id)
            ->get('siswa', $config['per_page'], $this->uri->segment(4));
         $this->data['content'] = 'siswa/read';
         $this->load->view('backend/index', $this->data);
      } else {
         $this->session->set_flashdata('alert', alert('error', status('404')));
         redirect($this->uri->segment(1));
      }
   }

   public function create() {
      if ($_POST) {
         if ($this->validation()) {
            $file = $this->upload();
            if ($file['status'] == 'success') {
               if ($this->db->insert($this->table, $this->field_data($file['data']))) {
                  // Create Users Account
                  $this->create_account($this->input->post('nisn'));
                  $this->session->set_flashdata('alert', alert('success', status('created')));
               } else {
                  @unlink('./assets/siswa/' . $file['data']['file_name']);
                  $this->session->set_flashdata('alert', alert('warning', status('existed')));
               }
            } else {
               $this->session->set_flashdata('alert', alert('error', $file['data']));
            }
         } else {
            $this->session->set_flashdata('alert', alert('error', validation_errors()));
         }
         redirect(uri_string());
      } else {
         $this->data['title'] = 'Tambah Data Siswa';
         $this->data['button'] = 'SIMPAN';
         $this->data['action'] = site_url(uri_string());
         $this->data['siswa'] = $this->data['add_siswa'] = TRUE;
         $this->data['alert'] = $this->session->flashdata('alert');
         $this->data['q_kelas'] = $this->m_global->dropdown('kelas_id', 'kelas', 'view_kelas');
         $this->data['query'] = FALSE;
         $this->data['content'] = 'siswa/create';
         $this->load->view('backend/index', $this->data);
      }
   }

   public function update() {
      $id = $this->uri->segment(3);
      if ($_POST) {
         if ($this->validation()) {
            if (empty($_FILES['file']['name'])) {
               if ($this->m_global->update($this->pk, $id, $this->table, $this->field_data())) {
                  $this->session->set_flashdata('alert', alert('success', status('updated')));
               } else {
                  $this->session->set_flashdata('alert', alert('warning', status('existed')));
               }
            } else {
               $file = $this->upload();
               if ($file['status'] == 'success') {
                  $query = $this->m_global->find($this->table, $this->pk, $id)->row_array();
                  if ($this->m_global->update($this->pk, $id, $this->table, $this->field_data($file['data']))) {
                     @unlink('./assets/siswa/' . $query['photo']);
                     $this->session->set_flashdata('alert', alert('success', status('created')));
                  } else {
                     @unlink('./assets/siswa/' . $file['data']['file_name']);
                     $this->session->set_flashdata('alert', alert('warning', status('existed')));
                  }
               } else {
                  $this->session->set_flashdata('alert', alert('error', $file['data']));
               }
            }
            // Create Users Account
            $this->create_account($this->input->post('nisn'));
         } else {
            $this->session->set_flashdata('alert', alert('error', validation_errors()));
         }
         redirect(current_url());
      } elseif ($id) {
         $this->data['title'] = 'Edit Data Siswa';
         $this->data['button'] = 'UPDATE';
         $this->data['action'] = site_url(uri_string());
         $this->data['siswa'] = $this->data['aktif'] = TRUE;
         $this->data['alert'] = $this->session->flashdata('alert');
         $this->data['q_kelas'] = $this->m_global->dropdown('kelas_id', 'kelas', 'view_kelas');
         $this->data['query'] = $this->m_global->find($this->table, $this->pk, $id)->row_array();
         $this->data['content'] = 'siswa/create';
         $this->load->view('backend/index', $this->data);
      } else {
         $this->session->set_flashdata('alert', alert('error', status('404')));
         redirect($this->uri->segment(1));
      }
   }

   private function create_account($nisn) {
      $check = $this->db
                  ->where('username', $nisn)
                  ->count_all_results('users');
      if ($check == 0) {
         $users = [
            'username' => $nisn,
            'password' => password_hash($nisn, PASSWORD_BCRYPT),
            'level' => 'siswa',
         ];
         $this->db->insert('users', $users);
      }
   }

   public function import() {
      if ($_POST) {
         $rows= explode("\n", $this->input->post('rows'));
         $success = 0;
         $failled = 0;
         $exist = 0;
         $nis = '';
         foreach($rows as $row) {
            $exp = explode("\t", $row);
            if (count($exp) != 13) continue;
            $nis = trim($exp[0]);
            $arr = [
               'nis' => trim($exp[0]),
               'nisn' => trim($exp[1]),
               'nama' => trim($exp[2]),
               'tempat_lahir' => trim($exp[3]),
               'tanggal_lahir' => trim($exp[4]),
               'jenis_kelamin' => trim($exp[5]) == 'L' ? 'Laki-laki' : 'Perempuan',               
               'alamat' => trim($exp[6]),               
               'telp_rumah' => trim($exp[7]),
               'email' => trim($exp[8]),
               'sekolah_asal' => trim($exp[9]),               
               'ayah' => trim($exp[10]),
               'ibu' => trim($exp[11]),
               'alamat_ortu' => trim($exp[12])
            ];

            $check = $this->db
                     ->where('nisn', trim($exp[0]))
                     ->count_all_results('siswa');
            if ($check == 0) {
               if ($this->db->insert('siswa', $arr)) {
                  $success++;
               } else {
                  $failled++;
               }
            } else {
               $exist++;
            }
            $check_user = $this->db
                           ->where('username', $nisn)
                           ->count_all_results('users');  
            if ($check_user == 0) {
               $users = [
                  'username' => trim($exp[0]),
                  'password' => password_hash(trim($exp[0]), PASSWORD_BCRYPT),
                  'level' => 'siswa',
               ];
               $this->db->insert('users', $users);
            }
         }
         $msg = 'Sukses : ' . $success. ' baris, Gagal : '. $failled .', Duplikat : ' . $exist;
         $this->session->set_flashdata('alert', alert('info', $msg));
         redirect('siswa/import');
      } else {
         $this->data['title'] = 'Import Data Siswa';
         $this->data['button'] = 'IMPORT';
         $this->data['action'] = site_url(uri_string());
         $this->data['siswa'] = $this->data['import_siswa'] = TRUE;
         $this->data['alert'] = $this->session->flashdata('alert');
         $this->data['query'] = FALSE;
         $this->data['content'] = 'siswa/import';
         $this->load->view('backend/index', $this->data);
      }
   }

   public function download() {
      $data = file_get_contents("./assets/template_excel/template_siswa.xlsx");
      $name = 'format-file-penginputan-data-siswa.xlsx';
      $this->load->helper('download');
      force_download($name, $data);
   }

   public function delete() {
      if (isset($_POST['delete']) && isset($_POST[$this->pk])) {
         $n = 0;
         foreach ($_POST[$this->pk] as $key) {
            $photo = $this->m_global->find($this->table, $this->pk, $key)->row_array();
            if ($this->db->where($this->pk, $key)->delete($this->table)) {
               $this->db->where('username', $key)->delete('users');
               @unlink('./assets/siswa/' . $photo['photo']);
               $n++;
            }
         }
         $n > 0 ?
         $this->session->set_flashdata('alert', alert('success', status('deleted'))) :
         $this->session->set_flashdata('alert', alert('info', status('not_deleted')));
      } else if ($this->uri->segment(3)) {
         $photo = $this->m_global->find($this->table, $this->pk, $this->uri->segment(3))->row_array();
         if ($this->db->where($this->pk, $this->uri->segment(3))->delete($this->table)) {
            $this->db->where('username', $this->uri->segment(3))->delete('users');
            @unlink('./assets/siswa/' . $photo['photo']);
            $this->session->set_flashdata('alert', alert('success', status('deleted')));
         } else {
            $this->session->set_flashdata('alert', alert('info', status('not_deleted')));
         }
      } else {
         $this->session->set_flashdata('alert', alert('warning', status('not_selected')));
      }
      redirect($this->input->post('url'));
   }

   private function field_data($file = '') {
      $data['nis'] = $this->input->post('nis');
      $data['nisn'] = $this->input->post('nisn');
      $data['nama'] = $this->input->post('nama');
      $data['kelas_id'] = $this->input->post('kelas_id');
      $data['status_siswa'] = $this->input->post('status_siswa');
      $data['tempat_lahir'] = $this->input->post('tempat_lahir');
      $data['tanggal_lahir'] = $this->input->post('tanggal_lahir');
      $data['jenis_kelamin'] = $this->input->post('jenis_kelamin');
      $data['agama'] = $this->input->post('agama');
      $data['status_anak'] = $this->input->post('status_anak');
      $data['anak_ke'] = $this->input->post('anak_ke');
      $data['alamat'] = $this->input->post('alamat');
      $data['telp_rumah'] = $this->input->post('telp_rumah');
      $data['sekolah_asal'] = $this->input->post('sekolah_asal');
      $data['diterima_dikelas'] = $this->input->post('diterima_dikelas');
      $data['pada_tanggal'] = $this->input->post('pada_tanggal');
      $data['ayah'] = $this->input->post('ayah');
      $data['ibu'] = $this->input->post('ibu');
      $data['alamat_ortu'] = $this->input->post('alamat_ortu');
      $data['telp_ortu'] = $this->input->post('telp_ortu');
      $data['pekerjaan_ayah'] = $this->input->post('pekerjaan_ayah');
      $data['pekerjaan_ibu'] = $this->input->post('pekerjaan_ibu');
      $data['nama_wali'] = $this->input->post('nama_wali');
      $data['alamat_wali'] = $this->input->post('alamat_wali');
      $data['telp_wali'] = $this->input->post('telp_wali');
      $data['pekerjaan_wali'] = $this->input->post('pekerjaan_wali');

      if ($file != '') {
         $data['photo'] = $file['file_name'];
      }

      return $data;
   }

   private function validation() {
      $this->load->library('form_validation');
      $this->form_validation->set_rules('nis', 'Nomor Induk Siswa', 'trim|required');
      $this->form_validation->set_rules('nisn', 'Nomor Induk Siswa Nasional', 'trim|required');
      $this->form_validation->set_rules('nama', 'Nama Siswa', 'trim|required');
      $this->form_validation->set_error_delimiters('', '<br>');
      return $this->form_validation->run();
   }

   private function upload() {
      create_dir('./assets/siswa/');
      $config['upload_path'] = './assets/siswa/';
      $config['allowed_types'] = 'jpg|png|gif';
      $config['max_size'] = 0;
      $config['encrypt_name'] = TRUE;
      $this->load->library('upload', $config);
      if (!$this->upload->do_upload('file')) {
         return [
            'status' => 'error',
            'data' => $this->upload->display_errors(),
         ];
      } else {
         $data = $this->upload->data();
         $resize['image_library'] = 'gd2';
         $resize['source_image'] = './assets/siswa/' . $data['file_name'];
         $resize['maintain_ratio'] = TRUE;
         $resize['width'] = 113;
         $resize['height'] = 170;
         $this->load->library('image_lib', $resize);
         $this->image_lib->resize();
         return [
            'status' => 'success',
            'data' => $this->upload->data(),
         ];
      }
   }

   public function export_excel() {
      $segment_3 = $this->uri->segment(3);
      $segment_4 = $this->uri->segment(4);
      $file_name = '';
      if ($segment_3 == 'status') {
         $query = $this->db
            ->where('status_siswa', $segment_4)
            ->get('siswa');
         $file_name = 'DATA SISWA ' . strtoupper($segment_4) . ' ' . strtoupper($this->setting['nama_sekolah']);
      } else if ($segment_3 == 'kelas') {
         $query = $this->db
            ->where('status_siswa', 'aktif')
            ->where('kelas_id', $segment_4)
            ->get('siswa');
         $file_name = 'DATA SISWA KELAS ' . strtoupper($this->m_global->get_kelas($segment_4)) . ' ' . strtoupper($this->setting['nama_sekolah']);
      }

      $objXLS   = new PHPExcel();
      $objSheet = $objXLS->setActiveSheetIndex(0);            
      $cell     = 2;        
      $no       = 1;
      $objSheet->setCellValue('A1', 'NO');
      $objSheet->setCellValue('B1', 'NIS');
      $objSheet->setCellValue('C1', 'NISN');
      $objSheet->setCellValue('D1', 'NAMA');
      $objSheet->setCellValue('E1', 'KELAS');
      $objSheet->setCellValue('F1', 'STATUS SISWA');
      $objSheet->setCellValue('G1', 'TEMPAT LAHIR');
      $objSheet->setCellValue('H1', 'TANGGAL LAHIR');
      $objSheet->setCellValue('I1', 'JENIS KELAMIN');
      $objSheet->setCellValue('J1', 'AGAMA');
      $objSheet->setCellValue('K1', 'STATUS ANAK');
      $objSheet->setCellValue('L1', 'ANAK KE');
      $objSheet->setCellValue('M1', 'ALAMAT');
      $objSheet->setCellValue('N1', 'TELEPON RUMAH');
      $objSheet->setCellValue('O1', 'EMAIL');
      $objSheet->setCellValue('P1', 'SEKOLAH ASAL');
      $objSheet->setCellValue('Q1', 'DITERIMA DIKELAS');
      $objSheet->setCellValue('R1', 'PADA TANGGAL');
      $objSheet->setCellValue('S1', 'NAMA AYAH');
      $objSheet->setCellValue('T1', 'NAMA IBU');
      $objSheet->setCellValue('U1', 'ALAMAT ORANG TUA');
      $objSheet->setCellValue('V1', 'TELEPON ORANG TUA');
      $objSheet->setCellValue('W1', 'PEKERJAAN AYAH');
      $objSheet->setCellValue('X1', 'PEKERJAAN IBU');
      $objSheet->setCellValue('Y1', 'NAMA WALI');
      $objSheet->setCellValue('Z1', 'ALAMAT WALI');
      $objSheet->setCellValue('AA1', 'TELEPON WALI');
      $objSheet->setCellValue('AB1', 'PEKERJAAN WALI');
      foreach($query->result_array() as $data) {
         $objSheet->setCellValue('A'.$cell, $no);
         $objSheet->setCellValue('B'.$cell, $data['nis']);
         $objSheet->setCellValue('C'.$cell, $data['nisn']);
         $objSheet->setCellValue('D'.$cell, $data['nama']);
         $objSheet->setCellValue('E'.$cell, $data['kelas']);
         $objSheet->setCellValue('F'.$cell, ucfirst($data['status_siswa']));
         $objSheet->setCellValue('G'.$cell, $data['tempat_lahir']);
         $objSheet->setCellValue('H'.$cell, indo_date($data['tanggal_lahir']));
         $objSheet->setCellValue('I'.$cell, $data['jenis_kelamin']);
         $objSheet->setCellValue('J'.$cell, $data['agama']);
         $objSheet->setCellValue('K'.$cell, $data['status_anak']);
         $objSheet->setCellValue('L'.$cell, $data['anak_ke']);
         $objSheet->setCellValue('M'.$cell, $data['alamat']);
         $objSheet->setCellValue('N'.$cell, $data['telp_rumah']);
         $objSheet->setCellValue('O'.$cell, $data['email']);
         $objSheet->setCellValue('P'.$cell, $data['sekolah_asal']);
         $objSheet->setCellValue('Q'.$cell, $this->m_global->get_kelas($data['diterima_dikelas']));
         $objSheet->setCellValue('R'.$cell, indo_date($data['pada_tanggal']));
         $objSheet->setCellValue('S'.$cell, $data['ayah']);
         $objSheet->setCellValue('T'.$cell, $data['ibu']);
         $objSheet->setCellValue('U'.$cell, $data['alamat_ortu']);
         $objSheet->setCellValue('V'.$cell, $data['telp_ortu']);
         $objSheet->setCellValue('W'.$cell, $data['pekerjaan_ayah']);
         $objSheet->setCellValue('X'.$cell, $data['pekerjaan_ibu']);
         $objSheet->setCellValue('Y'.$cell, $data['nama_wali']);
         $objSheet->setCellValue('Z'.$cell, $data['alamat_wali']);
         $objSheet->setCellValue('AA'.$cell, $data['telp_wali']);
         $objSheet->setCellValue('AB'.$cell, $data['pekerjaan_wali']);
         $cell++;
         $no++;    
      }                    
      foreach(range('A', 'AB') as $alphabet) {
         $objXLS->getActiveSheet()->getColumnDimension($alphabet)->setAutoSize(true);
      }
      $font = array('font' => array( 'bold' => true));
      $objXLS->getActiveSheet()
      ->getStyle('A1:AB1')
      ->applyFromArray($font);
      $objXLS->setActiveSheetIndex(0);        
      $styleArray = array(
         'borders' => array(
            'allborders' => array(
               'style' => PHPExcel_Style_Border::BORDER_THIN,
               'color' => array(
                  'rgb'  => '000000'
               ),
            ),
         ),
      );
      $objSheet->getStyle('A1:AB'.$no)->applyFromArray($styleArray);
      $objWriter = PHPExcel_IOFactory::createWriter($objXLS, 'Excel5'); 
      header('Content-Type: application/vnd.ms-excel'); 
      header('Content-Disposition: attachment;filename="'.$file_name.'.xls"'); 
      header('Cache-Control: max-age=0'); 
      $objWriter->save('php://output'); 
      exit();      
    }

   public function chart() {
      $this->data['title'] = 'Grafik Siswa ' . $this->setting['nama_sekolah'];
      $this->data['siswa'] = $this->data['chart_siswa'] = TRUE;
      $this->data['perkelas'] = $this->db->query("
      	SELECT COUNT(*) AS jumlah
         , x2.kelas
         , SUM(IF(x1.jenis_kelamin = 'Laki-Laki', 1, 0)) AS L
         , SUM(IF(x1.jenis_kelamin = 'Perempuan', 1, 0)) AS P
         FROM siswa x1
         LEFT JOIN view_kelas x2
            ON x1.kelas_id = x2.kelas_id
         WHERE x1.status_siswa = 'aktif'
         AND x1.kelas_id IS NOT NULL
         GROUP BY 2
			");
      $this->data['status_siswa'] = $this->db->query("
      	SELECT COUNT(*) AS jumlah, status_siswa
			FROM siswa
			WHERE kelas_id IS NOT NULL
			GROUP BY status_siswa
			");
      $this->data['query'] = FALSE;
      $this->data['content'] = 'siswa/chart';
      $this->load->view('backend/index', $this->data);
   }
}

/* End of file siswa.php */
/* Location: ./application/controllers/siswa.php */