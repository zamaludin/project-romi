<?php
defined('BASEPATH') OR exit('No direct script access allowed');


require APPPATH . 'third_party/PHPExcel.php';

class Ptk extends MY_Controller {

   private $pk = 'id';
   private $table = 'ptk';

   public function __construct() {
      parent::__construct();
   }

   public function index() {
      $this->load->library('pagination');
      $config['base_url'] = site_url('ptk/index');
      $config['uri_segment'] = 3;
      $config['total_rows'] = $this->db->count_all_results($this->table);
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
      $this->data['title'] = 'Data Pendidik dan Tenaga Kependidikan';
      $this->data['ptk'] = $this->data['ptk_list'] = TRUE;
      $this->data['alert'] = $this->session->flashdata('alert');
      $this->data['query'] = $this->db->get($this->table, $config['per_page'], $this->uri->segment(3));
      $this->data['content'] = 'ptk/read';
      $this->load->view('backend/index', $this->data);
   }

   public function create() {
      if ($_POST) {
         if ($this->validation()) {
            if (empty($_FILES['file']['name'])) {
               if ($this->db->insert($this->table, $this->field_data())) {
                  // Create Users Account
                  $this->create_account($this->input->post('nik'));
                  $this->session->set_flashdata('alert', alert('success', status('created')));
               }
            } else {
               $file = $this->upload();
               if ($file['status'] == 'success') {
                  if ($this->db->insert($this->table, $this->field_data($file['data']))) {
                     // Create Users Account
                     $this->create_account($this->input->post('nik'));
                     $this->session->set_flashdata('alert', alert('success', status('created')));
                  } else {
                     @unlink('./assets/ptk/' . $file['data']['file_name']);
                     $this->session->set_flashdata('alert', alert('warning', status('existed')));
                  }
               } else {
                  $this->session->set_flashdata('alert', alert('error', $file['data']));
               }
            }
         } else {
            $this->session->set_flashdata('alert', alert('error', validation_errors()));
         }
         redirect($this->uri->segment(1));
      }
      $this->data['title'] = 'Tambah Data Pendidik dan Tenaga Kependidikan';
      $this->data['button'] = 'SIMPAN';
      $this->data['action'] = site_url(uri_string());
      $this->data['ptk'] = $this->data['ptk_input'] = TRUE;
      $this->data['alert'] = $this->session->flashdata('alert');
      $this->data['query'] = FALSE;
      $this->data['content'] = 'ptk/create';
      $this->load->view('backend/index', $this->data);
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
                     @unlink('./assets/ptk/' . $query['photo']);
                     $this->session->set_flashdata('alert', alert('success', status('created')));
                  } else {
                     @unlink('./assets/ptk/' . $file['data']['file_name']);
                     $this->session->set_flashdata('alert', alert('warning', status('existed')));
                  }
               } else {
                  $this->session->set_flashdata('alert', alert('error', $file['data']));
               }
            }
            // Create Users Account
            $this->create_account($this->input->post('nik'));
         } else {
            $this->session->set_flashdata('alert', alert('error', validation_errors()));
         }
         redirect(current_url());
      } elseif ($id && $id != 0 && ctype_digit((string) $id)) {
         $this->data['title'] = 'Edit Data Pendidik dan Tenaga Kependidikan';
         $this->data['button'] = 'UPDATE';
         $this->data['action'] = site_url(uri_string());
         $this->data['ptk'] = $this->data['ptk_input'] = TRUE;
         $this->data['alert'] = $this->session->flashdata('alert');
         $this->data['query'] = $this->m_global->find($this->table, $this->pk, $id)->row_array();
         $this->data['content'] = 'ptk/create';
         $this->load->view('backend/index', $this->data);
      } else {
         $this->session->set_flashdata('alert', alert('error', status('404')));
         redirect($this->uri->segment(1));
      }
   }

   private function create_account($nik) {
      $check = $this->db
                  ->where('username', $nik)
                  ->count_all_results('users');
      if ($check == 0) {
         $users = [
            'username' => $nik,
            'password' => password_hash($nik, PASSWORD_BCRYPT),
            'level' => 'ptk',
         ];
         $this->db->insert('users', $users);
      }
   }

   public function import() {
      if($_POST) {
         $rows= explode("\n", $this->input->post('rows'));
         $success = 0;
         $failled = 0;
         $exist = 0;
         foreach($rows as $row) {
            $exp = explode("\t", $row);
            if (count($exp) != 14) continue;
            $nik = trim($exp[0]);
            $arr = [
               'nik' => trim($exp[0]),
               'nip' => trim($exp[1]),
               'nuptk' => trim($exp[2]),
               'nama' => trim($exp[3]),
               'jenis_kelamin' => trim($exp[4]) == 'L' ? 'Laki-laki' : 'Perempuan',
               'alamat' => trim($exp[5]),
               'telp' => trim($exp[6]),
               'email' => trim($exp[7]),
               'tempat_lahir' => trim($exp[8]),
               'tanggal_lahir' => trim($exp[9]),
               'pendidikan' => trim($exp[10]),
               'jurusan' => trim($exp[11]),
               'status_kepegawaian' => trim($exp[12]),
               'jenis_ptk' => trim($exp[13])
            ];
            $check = $this->db
                        ->where('nik', trim($exp[0]))
                        ->count_all_results('ptk');
            if ($check == 0) {
               if ($this->db->insert('ptk', $arr)) {
                  $success++;
               } else {
                  $failled++;
               }
            } else {
               $exist++;
            }
         }
         $msg = 'Sukses : ' . $success. ' baris, Gagal : '. $failled .', Duplikat : ' . $exist;
         $this->session->set_flashdata('alert', alert('info', $msg));
         redirect('ptk/import');
      } else {
         $this->data['title'] = 'Import Data Pendidik dan Tenaga Kependidikan';
         $this->data['button'] = 'IMPORT';
         $this->data['action'] = site_url(uri_string());
         $this->data['ptk'] = $this->data['ptk_import'] = TRUE;
         $this->data['alert'] = $this->session->flashdata('alert');
         $this->data['query'] = FALSE;
         $this->data['content'] = 'ptk/form_import';
         $this->load->view('backend/index', $this->data);
      }
   }

   public function download() {
      $data = file_get_contents("./assets/template_excel/template_ptk.xlsx");
      $name = 'format-file-penginputan-data-pendidik-dan-tenaga-kependidikan.xlsx';
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
               @unlink('./assets/ptk/' . $photo['photo']);
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
            @unlink('./assets/ptk/' . $photo['photo']);
            $this->session->set_flashdata('alert', alert('success', status('deleted')));
         } else {
            $this->session->set_flashdata('alert', alert('info', status('not_deleted')));
         }
      } else {
         $this->session->set_flashdata('alert', alert('warning', status('not_selected')));
      }
      redirect($this->uri->segment(1));
   }

   private function field_data($file = '') {
      $data['nik'] = $this->input->post('nik', true);
      $data['nip'] = $this->input->post('nip', true);
      $data['nuptk'] = $this->input->post('nuptk', true);
      $data['nama'] = $this->input->post('nama', true);
      $data['jenis_kelamin'] = $this->input->post('jenis_kelamin', true);
      $data['alamat'] = $this->input->post('alamat', true);
      $data['telp'] = $this->input->post('telp', true);
      $data['email'] = $this->input->post('email', true);
      $data['tempat_lahir'] = $this->input->post('tempat_lahir', true);
      $data['tanggal_lahir'] = $this->input->post('tanggal_lahir', true);
      $data['pendidikan'] = $this->input->post('pendidikan', true);
      $data['jurusan'] = $this->input->post('jurusan', true);
      $data['status_kepegawaian'] = $this->input->post('status_kepegawaian', true);
      $data['jenis_ptk'] = $this->input->post('jenis_ptk', true);
      if ($file != '') {
         $data['photo'] = $file['file_name'];
      }
      return $data;
   }

   private function validation() {
      $this->load->library('form_validation');
      if ($this->uri->segment(3)) {
         $this->form_validation->set_rules('nik', 'Nomor Induk Karyawan', 'trim|required');
         $this->form_validation->set_rules('nip', 'Nomor Induk Pegawai', 'trim');
         $this->form_validation->set_rules('nuptk', 'NUPTK', 'trim');
         $this->form_validation->set_rules('email', 'Email', 'trim|valid_email');
      } else {
         $this->form_validation->set_rules('nik', 'Nomor Induk Karyawan', 'trim|required|is_unique[ptk.nik]', ['is_unique' => 'This %s already exists']);
         $this->form_validation->set_rules('nip', 'Nomor Induk Pegawai', 'trim|is_unique[ptk.nip]', ['is_unique' => 'This %s already exists']);
         $this->form_validation->set_rules('nuptk', 'NUPTK', 'trim|is_unique[ptk.nuptk]', ['is_unique' => 'This %s already exists']);
         $this->form_validation->set_rules('email', 'Email', 'trim|valid_email|is_unique[ptk.email]', ['is_unique' => 'This %s already exists']);
      }
      $this->form_validation->set_rules('nama', 'Nama', 'trim|required');
      $this->form_validation->set_rules('alamat', 'Alamat', 'trim');
      $this->form_validation->set_rules('telp', 'Telepon', 'trim');
      $this->form_validation->set_rules('tempat_lahir', 'Tempat Lahir', 'trim');
      $this->form_validation->set_rules('tanggal_lahir', 'Tanggal  Lahir', 'trim');
      $this->form_validation->set_rules('jurusan', 'Jurusan', 'trim');
      $this->form_validation->set_error_delimiters('', '<br>');
      return $this->form_validation->run();
   }

   public function email_check($email) {
      $query = $this->db->where('email', $email)->get($this->table);
      if ($query->num_rows() > 1) {
         $this->form_validation->set_message('callback_email_check', '%s Email sudah digunakan ! Silahkan ganti.');
         return FALSE;
      }
      return TRUE;
   }

   private function upload() {
      create_dir('./assets/ptk/');
      $config['upload_path'] = './assets/ptk/';
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
         $resize['source_image'] = './assets/ptk/' . $data['file_name'];
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
      $query = $this->db->get($this->table);
      $file_name = 'DAFTAR PENDIDIK DAN TENAGA KEPENDIDIKAN ' . strtoupper($this->setting['nama_sekolah']);
      $objXLS = new PHPExcel();
      $objSheet = $objXLS->setActiveSheetIndex(0);            
      $cell = 2;        
      $no = 1;
      $objSheet->setCellValue('A1', 'NO');
      $objSheet->setCellValue('B1', 'NIK');
      $objSheet->setCellValue('C1', 'NIP');
      $objSheet->setCellValue('D1', 'NUPTK');
      $objSheet->setCellValue('E1', 'NAMA');
      $objSheet->setCellValue('F1', 'JENIS KELAMIN');
      $objSheet->setCellValue('G1', 'ALBUM');
      $objSheet->setCellValue('H1', 'ALAMAT');
      $objSheet->setCellValue('I1', 'TELP');
      $objSheet->setCellValue('J1', 'EMAIL');
      $objSheet->setCellValue('K1', 'TEMPAT TINGGAL');
      $objSheet->setCellValue('L1', 'PENDIDIKAN');
      $objSheet->setCellValue('M1', 'JURUSAN');
      foreach($query->result_array() as $data) {
         $objSheet->setCellValue('A'.$cell, $no);
         $objSheet->setCellValue('B'.$cell, $data['nik']);
         $objSheet->setCellValue('C'.$cell, $data['nip']);
         $objSheet->setCellValue('D'.$cell, $data['nuptk']);
         $objSheet->setCellValue('E'.$cell, $data['nama']);
         $objSheet->setCellValue('F'.$cell, $data['jenis_kelamin']);
         $objSheet->setCellValue('G'.$cell, $data['alamat']);
         $objSheet->setCellValue('H'.$cell, $data['telp']);
         $objSheet->setCellValue('I'.$cell, $data['email']);
         $objSheet->setCellValue('J'.$cell, $data['tempat_lahir']);
         $objSheet->setCellValue('K'.$cell, $data['tanggal_lahir']);
         $objSheet->setCellValue('L'.$cell, pendidikan($data['pendidikan']));
         $objSheet->setCellValue('M'.$cell, $data['jurusan']);
         $cell++;
         $no++;    
      }
      foreach(range('A', 'M') as $alphabet) {
         $objXLS->getActiveSheet()->getColumnDimension($alphabet)->setAutoSize(true);
      }
      $font = array('font' => array( 'bold' => true));
      $objXLS->getActiveSheet()
         ->getStyle('A1:M1')
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
      $objSheet->getStyle('A1:B'.$no)->applyFromArray($styleArray);
      $objWriter = PHPExcel_IOFactory::createWriter($objXLS, 'Excel5'); 
      header('Content-Type: application/vnd.ms-excel'); 
      header('Content-Disposition: attachment;filename="'.$file_name.'.xls"'); 
      header('Cache-Control: max-age=0'); 
      $objWriter->save('php://output'); 
      exit();
    }

   public function chart() {
      $this->data['title'] = 'Grafik Pendidik dan Tenaga Kependidikan (PTK) ' . $this->setting['nama_sekolah'];
      $this->data['ptk'] = $this->data['ptk_chart'] = TRUE;
      $this->data['status_kepegawaian'] = $this->db->query("
         SELECT COUNT(*) AS jumlah
            , status_kepegawaian
         FROM ptk
         GROUP BY 2
         ");
      $this->data['jenis_ptk'] = $this->db->query("
         SELECT COUNT(*) AS jumlah
            , jenis_ptk
         FROM ptk
         GROUP BY 2
         ");
      $this->data['jenis_kelamin'] = $this->db->query("
         SELECT COUNT(*) AS jumlah
            , jenis_kelamin
         FROM ptk
         GROUP BY 2
         ");
      $this->data['query'] = FALSE;
      $this->data['content'] = 'ptk/chart';
      $this->load->view('backend/index', $this->data);
   }
}

/* End of file ptk.php */
/* Location: ./application/controllers/ptk.php */