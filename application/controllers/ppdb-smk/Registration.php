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

class Registration extends MY_Controller {

   public function __construct() {
      parent::__construct();
      if ($this->setting['ppdb_status'] == 'close') {
         redirect(base_url());
      }
      $this->load->helper(['captcha', 'string']);
   }

   public function index() {
      $this->load->library('form_validation');
      $this->form_validation->set_rules('jalur_pendaftaran_id', 'jalur_pendaftaran_id', 'trim|required');
      $this->form_validation->set_rules('pilihan_1', 'pilihan_1', 'trim|required');
      $this->form_validation->set_rules('pilihan_2', 'pilihan_2', 'trim|required');
      $this->form_validation->set_rules('nama', 'Nama', 'trim|required');
      $this->form_validation->set_rules('tempat_lahir', 'Tempat Lahir', 'trim|required');
      $this->form_validation->set_rules('tanggal_lahir', 'Tanggal Lahir', 'trim|required|callback_check_date');
      $this->form_validation->set_rules('anak_ke', 'Anak ke', 'trim|required|is_natural_no_zero');
      $this->form_validation->set_rules('alamat', 'Alamat', 'trim|required');
      $this->form_validation->set_rules('telp_rumah', 'Telp', 'trim|required|numeric');
      $this->form_validation->set_rules('sekolah_asal', 'Sekolah Asal', 'trim|required');
      $this->form_validation->set_rules('email', 'Email', 'trim|valid_email|callback_check_email');
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
      $this->form_validation->set_rules('captcha', 'Captcha', 'trim|required|callback_valid_captcha');
      $this->form_validation->set_message('required', 'Isian %s harus diisi');
      $this->form_validation->set_message('valid_email', 'Isian %s harus diisi dengan format email yang benar');
      $this->form_validation->set_message('numeric', 'Isian %s harus diisi dengan angka');
      $this->form_validation->set_message('is_natural_no_zero', 'Isian %s harus diisi dengan angka dan tidak boleh nol');
      $this->form_validation->set_error_delimiters('<div class="block-error">', '</div>');
      if ($this->form_validation->run() == false) {
         $this->data['ppdb'] = true;
         $this->data['alert'] = $this->session->flashdata('alert');
         $this->data['title'] = 'Penerimaan Peserta Didik Baru ' . date('Y');
         $this->data['action'] = site_url(uri_string());
         $this->data['jalur'] = $this->m_global->dropdown('jalur_pendaftaran_id', 'jalur_pendaftaran', 'jalur_pendaftaran');
         $this->data['jurusan'] = $this->m_global->dropdown('jurusan_id', 'jurusan', 'jurusan');
         $this->data['captcha'] = $this->m_global->set_captcha();
         $this->data['query'] = false;
         $this->data['content'] = 'themes/' . $this->setting['themes'] . '/ppdb-smk/ppdb-registered';
         $this->load->view('themes/' . $this->setting['themes'] . '/index', $this->data);
      } else {
         $photo = $this->upload_photo();
         if ($photo['status'] == 'success') {
            $field_data = $this->field_data($photo['data']['file_name']);
            if ($this->db->insert('siswa', $field_data)) {
               $this->resize_photo($photo['data']['file_name']);
               $alert = '<div class="alert alert-success">Data pendaftaran anda sudah tersimpan pada sistem kami. Berikut ini merupakan data yang anda masukan. Silahkan untuk mencetaknya dengan menekan tombol cetak dibawah!</div>';
               $this->session->set_flashdata('alert', $alert);
               redirect('ppdb-smk/confirmation/index/' . encode_url($this->db->insert_id()));
            } else {
               @unlink('./assets/' . $photo['data']['file_name']);
               $alert = '<div class="alert alert-danger">Data pendaftaran tidak tersimpan! Silahkan periksa kembali data anda!</div>';
               $this->session->set_flashdata('alert', $alert);
               redirect('ppdb-smk/registration/');
            }
         } else {
            $alert = '<div class="alert alert-danger">' . $photo['data'] . '</div>';
            $this->session->set_flashdata('alert', $alert);
            redirect('ppdb-smk/registration/');
         }
      }
   }

   private function field_data($photo = null) {
      $data['jalur_pendaftaran_id'] = $this->input->post('jalur_pendaftaran_id', true);
      $data['nisn'] = $this->input->post('nisn', true);
      $data['pilihan_1'] = $this->input->post('pilihan_1', true);
      $data['pilihan_2'] = $this->input->post('pilihan_2', true);
      $data['nama'] = $this->input->post('nama', true);
      $data['tempat_lahir'] = $this->input->post('tempat_lahir', true);
      $data['tanggal_lahir'] = $this->input->post('tanggal_lahir', true);
      $data['jenis_kelamin'] = $this->input->post('jenis_kelamin', true);
      $data['agama'] = $this->input->post('agama', true);
      $data['status_anak'] = $this->input->post('status_anak', true);
      $data['anak_ke'] = $this->input->post('anak_ke', true);
      $data['alamat'] = $this->input->post('alamat', true);
      $data['telp_rumah'] = $this->input->post('telp_rumah', true);
      $data['email'] = $this->input->post('email') == '' ? null : $this->input->post('email', true);
      $data['sekolah_asal'] = $this->input->post('sekolah_asal', true);
      if ($photo != null) {
         $data['photo'] = $photo;
      }

      if ($this->uri->segment(3) != 'update') {
         $year = $this->setting['ppdb_tahun'];
         $data['no_daftar'] = $this->m_global->no_daftar($year);
         $data['tanggal_daftar'] = date('Y-m-d');
         $data['status_siswa'] = 'baru';
         $data['hasil_seleksi'] = 'belum_diseleksi';
      }

      $data['ayah'] = $this->input->post('ayah', true);
      $data['ibu'] = $this->input->post('ibu', true);
      $data['alamat_ortu'] = $this->input->post('alamat_ortu', true);
      $data['telp_ortu'] = $this->input->post('telp_ortu', true);
      $data['pekerjaan_ayah'] = $this->input->post('pekerjaan_ayah', true);
      $data['pekerjaan_ibu'] = $this->input->post('pekerjaan_ibu', true);
      $data['nama_wali'] = $this->input->post('nama_wali', true);
      $data['alamat_wali'] = $this->input->post('alamat_wali', true);
      $data['telp_wali'] = $this->input->post('telp_wali', true);
      $data['pekerjaan_wali'] = $this->input->post('pekerjaan_wali', true);
      return $data;
   }

   /**
    * captcha validation
    * @return boolean
    */
   public function valid_captcha($str) {
      if ($this->m_global->is_valid_captcha($str)) {
         return true;
      }
      $this->form_validation->set_message('valid_captcha', 'Kode Keamanan tidak valid.');
      return false;
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

   public function check_email($email) {
      $query = $this->m_global->is_mail_exist($email, 'siswa');
      if (!$query) {
         $this->form_validation->set_message('check_email', 'Email sudah digunakan, silahkan ganti dengan email lainnya!');
         return false;
      }
      return true;
   }

   private function upload_photo() {
      $config['upload_path'] = './assets';
      $config['allowed_types'] = 'jpg';
      $config['max_size'] = 1000;
      $config['encrypt_name'] = true;
      $config['overwrite'] = false;
      $this->load->library('upload', $config);
      if (!$this->upload->do_upload('file')) {
         return [
            'status' => 'error',
            'data' => $this->upload->display_errors(),
         ];
      } else {
         $data = $this->upload->data();
         return [
            'status' => 'success',
            'data' => $this->upload->data(),
         ];
      }
   }

   private function resize_photo($photo) {
      $this->load->library('image_lib');
      $config['image_library'] = 'gd2';
      $config['source_image'] = './assets/' . $photo;
      $config['new_image'] = './assets/siswa/' . $photo;
      $config['create_thumb'] = false;
      $config['maintain_ratio'] = true;
      $config['width'] = 113;
      $config['height'] = 170;
      $this->image_lib->initialize($config);
      $this->image_lib->resize();
      $this->image_lib->clear();
      @unlink('./assets/' . $photo);
   }

   public function update() {
      $id = decode_url($this->uri->segment(4));
      if ($id) {
         $siswa = $this->m_global->find('view_siswa', 'id', $id)->row_array();
         $photo_lama = $siswa['photo'];
         $this->load->library('form_validation');
         $this->form_validation->set_rules('jalur_pendaftaran_id', 'jalur_pendaftaran_id', 'trim|required');
         $this->form_validation->set_rules('pilihan_1', 'pilihan_1', 'trim|required');
         $this->form_validation->set_rules('pilihan_2', 'pilihan_2', 'trim|required');
         $this->form_validation->set_rules('nama', 'Nama', 'trim|required');
         $this->form_validation->set_rules('tempat_lahir', 'Tempat Lahir', 'trim|required');
         $this->form_validation->set_rules('tanggal_lahir', 'Tanggal Lahir', 'trim|required|callback_check_date');
         $this->form_validation->set_rules('anak_ke', 'Anak ke', 'trim|required|is_natural_no_zero');
         $this->form_validation->set_rules('alamat', 'Alamat', 'trim|required');
         $this->form_validation->set_rules('telp_rumah', 'Telp', 'trim|required|numeric');
         $this->form_validation->set_rules('sekolah_asal', 'Sekolah Asal', 'trim|required');
         $this->form_validation->set_rules('email', 'Email', 'trim|valid_email');
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
         $this->form_validation->set_rules('captcha', 'Captcha', 'trim|required|callback_valid_captcha');
         $this->form_validation->set_message('required', 'Isian %s harus diisi');
         $this->form_validation->set_message('valid_email', 'Isian %s harus diisi dengan format email yang benar');
         $this->form_validation->set_message('numeric', 'Isian %s harus diisi dengan angka');
         $this->form_validation->set_message('is_natural_no_zero', 'Isian %s harus diisi dengan angka dan tidak boleh nol');
         $this->form_validation->set_error_delimiters('<div class="block-error">', '</div>');
         if ($this->form_validation->run() == false) {
            $this->data['ppdb'] = true;
            $this->data['alert'] = $this->session->flashdata('alert');
            $this->data['title'] = 'Penerimaan Peserta Didik Baru ' . date('Y');
            $this->data['action'] = site_url(uri_string());
            $this->data['jalur'] = $this->m_global->dropdown('jalur_pendaftaran_id', 'jalur_pendaftaran', 'jalur_pendaftaran');
            $this->data['jurusan'] = $this->m_global->dropdown('jurusan_id', 'jurusan', 'jurusan');
            $this->data['captcha'] = $this->m_global->set_captcha();
            $this->data['query'] = $siswa;
            $this->data['content'] = 'themes/' . $this->setting['themes'] . '/ppdb-smk/ppdb-registered';
            $this->load->view('themes/' . $this->setting['themes'] . '/index', $this->data);
         } else {
            if (empty($_FILES['file']['name'])) {
               $field_data = $this->field_data();
               if ($this->db->where('id', $id)->update('siswa', $field_data)) {
                  $alert = '<div class="alert alert-info">Data sudah diperbaharui</div>';
                  $this->session->set_flashdata('alert', $alert);
               } else {
                  $alert = '<div class="alert alert-danger">Data tidak diperbaharui</div>';
                  $this->session->set_flashdata('alert', $alert);
               }
               redirect('ppdb-smk/confirmation/index/' . encode_url($id));
            } else {
               $photo = $this->upload_photo();
               if ($photo['status'] == 'success') {
                  $field_data = $this->field_data($photo['data']['file_name']);
                  if ($this->db->where('id', $id)->update('siswa', $field_data)) {
                     $this->resize_photo($photo['data']['file_name']);
                     @unlink('./assets/siswa/' . $photo_lama);
                     $alert = '<div class="alert alert-success">Data sudah diperbaharui</div>';
                     $this->session->set_flashdata('alert', $alert);
                     redirect('ppdb-smk/confirmation/index/' . encode_url($id));
                  } else {
                     @unlink('./assets/' . $photo['data']['file_name']);
                     $alert = '<div class="alert alert-danger">Data tidak diperbaharui</div>';
                     $this->session->set_flashdata('alert', $alert);
                     redirect('ppdb-smk/confirmation/index/' . encode_url($id));
                  }
               } else {
                  $this->session->set_flashdata('alert', alert('error', $photo['data']));
                  redirect('ppdb-smk/confirmation/index/' . encode_url($id));
               }
            }
         }
      } else {
         $alert = '<div class="alert alert-danger">Anda tidak diperkenankan memanipulasi URL</div>';
         $this->session->set_flashdata('alert', $alert);
         redirect('ppdb-smk/registration');
      }
   }
}

/* End of file registration.php */
/* Location: ./application/controllers/ppdb-smk/registration.php */