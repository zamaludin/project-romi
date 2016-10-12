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
      $tahun = $this->uri->segment(4) == FALSE ? $this->setting['ppdb_tahun'] : $this->uri->segment(4);
      $this->load->library('pagination');
      $config['base_url'] = site_url('ppdb-sd/siswa/index/' . $tahun);
      $config['uri_segment'] = 5;
      $config['total_rows'] = $this->db
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
      $this->data['title'] = 'Calon Peserta Didik Baru Tahun ' . $tahun;
      $this->data['ppdb'] = $this->data['pendaftar'] = TRUE;
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
         ->order_by('tanggal_daftar', 'DESC')
         ->order_by('no_daftar', 'DESC')
         ->get('view_siswa', $config['per_page'], $this->uri->segment(5));
      $this->data['content'] = 'ppdb-sd/read';
      $this->load->view('backend/index', $this->data);
   }

   public function update() {
      $id = $this->uri->segment(4);
      if ($_POST) {
         if ($this->validation()) {
            if (empty($_FILES['file']['name'])) {
               if ($this->m_global->update($this->pk, $id, $this->table, $this->field_data())) {
                  $this->session->set_flashdata('alert', alert('success', status('updated')));
               } else {
                  $this->session->set_flashdata('alert', alert('warning', status('existed')));
               }
            } else {
               $file = $this->upload_photo();
               if ($file['status'] == 'success') {
                  $query = $this->m_global->find($this->table, $this->pk, $id)->row_array();
                  if ($this->m_global->update($this->pk, $id, $this->table, $this->field_data($file['data']['file_name']))) {
                     $this->resize_photo($file['data']['file_name']);
                     $this->session->set_flashdata('alert', alert('success', status('created')));
                  } else {
                     @unlink('./assets/siswa/' . $file['data']['file_name']);
                     $this->session->set_flashdata('alert', alert('warning', status('existed')));
                  }
               } else {
                  $this->session->set_flashdata('alert', alert('error', $file['data']));
               }
            }
         } else {
            $this->session->set_flashdata('alert', alert('error', validation_errors()));
         }

         redirect(uri_string());
      } elseif ($id && $id != 0 && ctype_digit((string) $id)) {
         $this->data['title']   = 'Edit Data Calon Peserta Didik Baru';
            $this->data['button']  = 'UPDATE';
            $this->data['action']  = site_url(uri_string());
            $this->data['ppdb']    = $this->data['pendaftar'] = TRUE;
            $this->data['alert']   = $this->session->flashdata('alert');
            $this->data['jalur']   = $this->m_global->dropdown('jalur_pendaftaran_id', 'jalur_pendaftaran', 'jalur_pendaftaran');
            $this->data['query']   = $this->m_global->find($this->table, $this->pk, $id)->row_array();
            $this->data['content'] = 'ppdb-sd/create';
            $this->load->view('backend/index', $this->data);
      } else {
         $this->session->set_flashdata('alert', alert('error', status('404')));
         redirect('ppdb-sd/siswa');
      }
   }

   public function delete() {
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

   private function field_data($file = '') {
      $data['nama'] = $this->input->post('nama');
      $data['tempat_lahir'] = $this->input->post('tempat_lahir');
      $data['tanggal_lahir'] = $this->input->post('tanggal_lahir');
      $data['jenis_kelamin'] = $this->input->post('jenis_kelamin');
      $data['agama'] = $this->input->post('agama');
      $data['status_anak'] = $this->input->post('status_anak');
      $data['anak_ke'] = $this->input->post('anak_ke');
      $data['alamat'] = $this->input->post('alamat');
      $data['telp_rumah'] = $this->input->post('telp_rumah');
      $data['sekolah_asal'] = $this->input->post('sekolah_asal');
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
         $data['photo'] = $file;
      }

      return $data;
   }

   private function validation() {
      $this->load->library('form_validation');
      $this->form_validation->set_rules('nama', 'Nama', 'trim|required');
      $this->form_validation->set_rules('tempat_lahir', 'Tempat Lahir', 'trim|required');
      $this->form_validation->set_rules('tanggal_lahir', 'Tanggal Lahir', 'trim|required|callback_check_date');
      $this->form_validation->set_rules('anak_ke', 'Anak ke', 'trim|required|is_natural_no_zero');
      $this->form_validation->set_rules('alamat', 'Alamat', 'trim|required');
      $this->form_validation->set_rules('telp_rumah', 'Telp', 'trim|required|numeric');
      $this->form_validation->set_rules('sekolah_asal', 'Sekolah Asal', 'trim|required');
      $this->form_validation->set_rules('ayah', 'Ayah', 'trim|required');
      $this->form_validation->set_rules('ibu', 'Ibu', 'trim|required');
      $this->form_validation->set_rules('alamat_ortu', 'Alamat Orang Tua', 'trim|required');
      $this->form_validation->set_rules('telp_ortu', 'Telepon Orang Tua', 'trim|required|numeric');
      $this->form_validation->set_rules('pekerjaan_ayah', 'Pekerjaan Ayah', 'trim|required');
      $this->form_validation->set_rules('pekerjaan_ibu', 'Pekerjaan Ibu', 'trim|required');
      $this->form_validation->set_rules('nama_wali', 'Nama Wali', 'trim');
      $this->form_validation->set_rules('alamat_wali', 'Alamat Wali', 'trim');
      $this->form_validation->set_rules('telp_wali', 'Telepon Wali', 'trim|numeric');
      $this->form_validation->set_rules('pekerjaan_wali', 'Pekerjaan Wali', 'trim');
      $this->form_validation->set_message('required', 'Isian %s harus diisi');
      $this->form_validation->set_message('numeric', 'Isian %s harus diisi dengan angka');
      $this->form_validation->set_message('is_natural_no_zero', 'Isian %s harus diisi dengan angka dan tidak boleh nol');
      $this->form_validation->set_error_delimiters('', '<br>');
      return $this->form_validation->run();
   }

   private function upload_photo() {
      $config['upload_path'] = './assets';
      $config['allowed_types'] = 'jpg';
      $config['max_size'] = 1000;
      $config['encrypt_name'] = TRUE;
      $config['overwrite'] = FALSE;
      $this->load->library('upload', $config);

      if (!$this->upload->do_upload('file')) {
         return array(
            'status' => 'error',
            'data' => $this->upload->display_errors(),
         );
      } else {
         $data = $this->upload->data();
         return array(
            'status' => 'success',
            'data' => $this->upload->data(),
         );
      }
   }

   private function resize_photo($photo) {
      $this->load->library('image_lib');
      $config['image_library'] = 'gd2';
      $config['source_image'] = './assets/' . $photo;
      $config['new_image'] = './assets/siswa/' . $photo;
      $config['create_thumb'] = FALSE;
      $config['maintain_ratio'] = TRUE;
      $config['width'] = 113;
      $config['height'] = 170;
      $this->image_lib->initialize($config);
      $this->image_lib->resize();
      $this->image_lib->clear();
      @unlink('./assets/' . $photo);
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

   public function export_excel() {
      $tahun  = $this->uri->segment(4) ? $this->uri->segment(4) : $this->setting['ppdb_tahun'];
      $query  = $this->db->where('LEFT(tanggal_daftar, 4) =', $tahun)->get('view_siswa');
      $file_name = 'CALON PESERTA DIDIK BARU TAHUN '.$tahun;
      $objXLS   = new PHPExcel();
      $objSheet = $objXLS->setActiveSheetIndex(0);            
      $cell     = 2;        
      $no       = 1;
      $objSheet->setCellValue('A1', 'NO');
      $objSheet->setCellValue('B1', 'NO. PENDAFTARAN');
      $objSheet->setCellValue('C1', 'TANGGAL PENDAFTARAN');
      $objSheet->setCellValue('D1', 'TK ASAL');
      $objSheet->setCellValue('E1', 'NAMA CALON PESERTA DIDIK');
      $objSheet->setCellValue('F1', 'TEMPAT LAHIR');
      $objSheet->setCellValue('G1', 'TANGGAL LAHIR');
      $objSheet->setCellValue('H1', 'JENIS KELAMIN');
      $objSheet->setCellValue('I1', 'AGAMA');
      $objSheet->setCellValue('J1', 'STATUS ANAK');
      $objSheet->setCellValue('K1', 'ANAK KE');
      $objSheet->setCellValue('L1', 'ALAMAT');
      $objSheet->setCellValue('M1', 'TELEPON');
      $objSheet->setCellValue('N1', 'EMAIL');
      $objSheet->setCellValue('O1', 'NAMA AYAH');
      $objSheet->setCellValue('P1', 'NAMA IBU');
      $objSheet->setCellValue('Q1', 'ALAMAT ORANG TUA');
      $objSheet->setCellValue('R1', 'TELEPON ORANG TUA');
      $objSheet->setCellValue('S1', 'PEKERJAAN AYAH');
      $objSheet->setCellValue('T1', 'PEKERJAAN IBU');
      $objSheet->setCellValue('U1', 'NAMA WALI');
      $objSheet->setCellValue('V1', 'ALAMAT WALI');
      $objSheet->setCellValue('W1', 'TELEPON WALI');
      $objSheet->setCellValue('X1', 'PEKERJAAN WALI');
      foreach($query->result_array() as $data) {
         $objSheet->setCellValue('A'.$cell, $no);
         $objSheet->setCellValue('B'.$cell, $data['no_daftar']);
         $objSheet->setCellValue('C'.$cell, indo_date($data['tanggal_daftar']));
         $objSheet->setCellValue('D'.$cell, $data['sekolah_asal']);
         $objSheet->setCellValue('E'.$cell, $data['nama']);
         $objSheet->setCellValue('F'.$cell, $data['tempat_lahir']);
         $objSheet->setCellValue('G'.$cell, indo_date($data['tanggal_lahir']));
         $objSheet->setCellValue('H'.$cell, $data['jenis_kelamin']);
         $objSheet->setCellValue('I'.$cell, $data['agama']);
         $objSheet->setCellValue('J'.$cell, $data['status_anak']);
         $objSheet->setCellValue('K'.$cell, $data['anak_ke']);
         $objSheet->setCellValue('L'.$cell, $data['alamat']);
         $objSheet->setCellValue('M'.$cell, $data['telp_rumah']);
         $objSheet->setCellValue('N'.$cell, $data['email']);
         $objSheet->setCellValue('O'.$cell, $data['ayah']);
         $objSheet->setCellValue('P'.$cell, $data['ibu']);
         $objSheet->setCellValue('Q'.$cell, $data['alamat_ortu']);
         $objSheet->setCellValue('R'.$cell, $data['telp_ortu']);
         $objSheet->setCellValue('S'.$cell, $data['pekerjaan_ayah']);
         $objSheet->setCellValue('T'.$cell, $data['pekerjaan_ibu']);
         $objSheet->setCellValue('U'.$cell, $data['nama_wali']);
         $objSheet->setCellValue('V'.$cell, $data['alamat_wali']);
         $objSheet->setCellValue('W'.$cell, $data['telp_wali']);
         $objSheet->setCellValue('X'.$cell, $data['pekerjaan_wali']);
         $cell++;
         $no++;    
      }                    
      foreach(range('A', 'X') as $alphabet) {
         $objXLS->getActiveSheet()->getColumnDimension($alphabet)->setAutoSize(true);
      }
      $font = array('font' => array( 'bold' => true));
      $objXLS->getActiveSheet()
      ->getStyle('A1:X1')
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
      $objSheet->getStyle('A1:X'.$no)->applyFromArray($styleArray);
      $objWriter = PHPExcel_IOFactory::createWriter($objXLS, 'Excel5'); 
      header('Content-Type: application/vnd.ms-excel'); 
      header('Content-Disposition: attachment;filename="'.$file_name.'.xls"'); 
      header('Cache-Control: max-age=0'); 
      $objWriter->save('php://output'); 
      exit();      
   }
}

/* End of file siswa.php */
/* Location: ./application/controllers/siswa.php */