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

class Sekolah extends MY_Controller {

   private $pk = 'id';
   private $table = 'options';

   public function __construct() {
      parent::__construct();
   }

   public function index() {
      if ($_POST) {
         if ($this->validation()) {
            if (empty($_FILES['file']['name'])) {
               $data = $this->field_data();
               foreach($data as $key => $value) {
                  $check = $this->db->where('variable', $key)->count_all_results('options');
                  if ($check == 0) {
                     $this->db->insert('options', ['variable' => $key, 'value' => $value]);
                  } else {
                     $this->db->where('variable', $key)->update('options', ['value' => $value]);
                  }
               }
               $this->session->set_flashdata('alert', alert('success', status('updated')));
            } else {
               $file = $this->upload();
               if ($file['status'] == 'success') {
                  $data = $this->field_data($file['data']);
                  $query = $this->db
                                 ->select('value')
                                 ->where('variable', 'logo')
                                 ->limit(1)
                                 ->get('options')->row();
                  @unlink('./assets/images/' . $query->value);
                  foreach($data as $key => $value) {
                     $check = $this->db->where('variable', $key)->count_all_results('options');
                     if ($check == 0) {
                        $this->db->insert('options', ['variable' => $key, 'value' => $value]);
                     } else {
                        $this->db->where('variable', $key)->update('options', ['value' => $value]);
                     }
                  }
               } else {
                  $this->session->set_flashdata('alert', alert('error', $file['data']));
               }
            }
         } else {
            $this->session->set_flashdata('alert', alert('error', validation_errors()));
         }
         redirect($this->uri->segment(1));
      } else {
         $this->data['title'] = 'Identitas Sekolah';
         $this->data['button'] = 'SIMPAN PENGATURAN';
         $this->data['action'] = site_url(uri_string());
         $this->data['setting'] = $this->data['sekolah'] = TRUE;
         $this->data['alert'] = $this->session->flashdata('alert');
         $this->data['q_ptk'] = $this->m_global->dropdown('id', 'nama', 'ptk');
         $this->data['query'] = $this->m_global->get_options();
         $this->data['content'] = 'sekolah/create';
         $this->load->view('backend/index', $this->data);
      }
   }

   private function field_data($file = '') {
      $data['npsn'] = $this->input->post('npsn');
      $data['nama_sekolah'] = $this->input->post('nama_sekolah');
      $data['jenjang'] = $this->input->post('jenjang');
      $data['alamat'] = $this->input->post('alamat');
      $data['kelurahan'] = $this->input->post('kelurahan');
      $data['kecamatan'] = $this->input->post('kecamatan');
      $data['kabupaten'] = $this->input->post('kabupaten');
      $data['propinsi'] = $this->input->post('propinsi');
      $data['website'] = $this->input->post('website');
      $data['email'] = $this->input->post('email');
      $data['telp'] = $this->input->post('telp');
      $data['ptk_id'] = $this->input->post('ptk_id');
      $data['telp'] = $this->input->post('telp');
      $data['facebook'] = prep_url($this->input->post('facebook'));
      $data['twitter'] = $this->input->post('twitter');
      $data['google_plus'] = $this->input->post('google_plus');
      $data['youtube'] = prep_url($this->input->post('youtube'));
      $data['yahoo'] = $this->input->post('yahoo');
      $data['meta_keywords'] = $this->input->post('meta_keywords');
      $data['meta_description'] = $this->input->post('meta_description');
      $data['google_map'] = $this->input->post('google_map');
      if ($file != '') {
         $data['logo'] = $file['file_name'];
      }
      return $data;
   }

   private function validation() {
      $this->load->library('form_validation');
      $this->form_validation->set_rules('npsn', 'npsn', 'trim|required');
      $this->form_validation->set_rules('nama_sekolah', 'Nama Sekolah', 'trim|required');
      $this->form_validation->set_rules('alamat', 'Alamat', 'trim|required');
      $this->form_validation->set_rules('kelurahan', 'Kelurahan', 'trim');
      $this->form_validation->set_rules('kecamatan', 'Kecamatan', 'trim');
      $this->form_validation->set_rules('kabupaten', 'Kabupaten', 'trim|required');
      $this->form_validation->set_rules('propinsi', 'Propinsi', 'trim');
      $this->form_validation->set_rules('website', 'Website', 'trim|required|callback_website_check');
      $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
      $this->form_validation->set_rules('telp', 'Telp', 'trim');
      $this->form_validation->set_rules('ptk_id', 'Kepala Sekolah', 'required');
      $this->form_validation->set_rules('facebook', 'Facebook', 'trim');
      $this->form_validation->set_rules('twitter', 'Twitter', 'trim');
      $this->form_validation->set_rules('google_plus', 'Google Plus', 'trim');
      $this->form_validation->set_rules('youtube', 'Youtube', 'trim');
      $this->form_validation->set_rules('yahoo', 'Yahoo', 'trim');
      $this->form_validation->set_rules('meta_keywords', 'Meta Keywords', 'trim');
      $this->form_validation->set_rules('meta_description', 'Meta Description', 'trim');
      $this->form_validation->set_rules('google_map', 'Google Map', 'trim');
      $this->form_validation->set_error_delimiters('', '<br>');
      return $this->form_validation->run();
   }

   private function upload() {
      create_dir('./assets/images');
      $config['upload_path'] = './assets/images/';
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
         $resize['source_image'] = './assets/images/' . $data['file_name'];
         $resize['maintain_ratio'] = TRUE;
         $resize['width'] = 100;
         $resize['height'] = 100;
         $this->load->library('image_lib', $resize);
         $this->image_lib->resize();
         return [
            'status' => 'success',
            'data' => $this->upload->data(),
         ];
      }
   }

   public function website_check($str) {
      if (strpos($str, '.com')) {
         return TRUE;
      } else {
         $this->form_validation->set_message('website_check', 'Aplikasi ini khusus untuk domain resmi sekolah. Silahkan masukan nama domain resmi sekolah! contoh : http://www.namasekolah.sch.id');
         return FALSE;
      }
   }
}

/* End of file sekolah.php */
/* Location: ./application/controllers/sekolah.php */