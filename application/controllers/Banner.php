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

class Banner extends MY_Controller {

   private $pk = 'id';
   private $table = 'banner';

   public function __construct() {
      parent::__construct();
   }

   public function index() {
      $this->load->library('pagination');
      $config['base_url'] = site_url('banner/index');
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
      $this->data['title'] = 'Banner';
      $this->data['module'] = $this->data['banner'] = TRUE;
      $this->data['alert'] = $this->session->flashdata('alert');
      $this->data['query'] = $this->db->get($this->table, $config['per_page'], $this->uri->segment(3));
      $this->data['content'] = 'banner/read';
      $this->load->view('backend/index', $this->data);
   }

   public function create() {
      if ($_POST) {
         if ($this->validation()) {
            $file = $this->upload();
            if ($file['status'] == 'success') {
               if ($this->db->insert($this->table, $this->field_data($file['data']))) {
                  $this->session->set_flashdata('alert', alert('success', status('created')));
               } else {
                  @unlink('./assets/banner/' . $file['data']['file_name']);
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
         $this->data['title'] = 'Tambah Banner';
         $this->data['button'] = 'SIMPAN';
         $this->data['action'] = site_url(uri_string());
         $this->data['module'] = $this->data['banner'] = TRUE;
         $this->data['alert'] = $this->session->flashdata('alert');
         $this->data['query'] = FALSE;
         $this->data['content'] = 'banner/create';
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
                     @unlink('./assets/banner/' . $query['gambar']);
                     $this->session->set_flashdata('alert', alert('success', status('created')));
                  } else {
                     @unlink('./assets/banner/' . $file['data']['file_name']);
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
         $this->data['title'] = 'Edit Banner';
         $this->data['button'] = 'UPDATE';
         $this->data['action'] = site_url(uri_string());
         $this->data['module'] = $this->data['banner'] = TRUE;
         $this->data['alert'] = $this->session->flashdata('alert');
         $this->data['query'] = $this->m_global->find($this->table, $this->pk, $id)->row_array();
         $this->data['content'] = 'banner/create';
         $this->load->view('backend/index', $this->data);
      } else {
         $this->session->set_flashdata('alert', alert('error', status('404')));
         redirect($this->uri->segment(1));
      }
   }

   public function delete() {
      if (isset($_POST['delete']) && isset($_POST[$this->pk])) {
         $n = 0;
         foreach ($_POST[$this->pk] as $key) {
            $file = $this->m_global->find($this->table, $this->pk, $key)->row_array();
            if ($this->db->where($this->pk, $key)->delete($this->table)) {
               @unlink('./assets/banner/' . $file['gambar']);
               $n++;
            }
         }
         $n > 0 ?
         $this->session->set_flashdata('alert', alert('success', status('deleted'))) :
         $this->session->set_flashdata('alert', alert('info', status('not_deleted')));
      } else if ($this->uri->segment(3)) {
         $file = $this->m_global->find($this->table, $this->pk, $this->uri->segment(3))->row_array();
         if ($this->db->where($this->pk, $this->uri->segment(3))->delete($this->table)) {
            @unlink('./assets/banner/' . $file['gambar']);
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
      $data['url'] = prep_url($this->input->post('url'));
      $data['keterangan'] = $this->input->post('keterangan');
      if ($file != '') {
         $data['gambar'] = $file['file_name'];
      }
      return $data;
   }

   private function validation() {
      $this->load->library('form_validation');
      $this->form_validation->set_rules('url', 'URL', 'trim|required');
      $this->form_validation->set_rules('keterangan', 'Keterangan', 'trim|required');
      $this->form_validation->set_error_delimiters('', '<br>');
      return $this->form_validation->run();
   }

   private function upload() {
      $img = config_themes($this->setting['themes']);
      create_dir('./assets/banner/');
      $config['upload_path'] = './assets/banner/';
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
         $resize['source_image'] = './assets/banner/' . $data['file_name'];
         $resize['maintain_ratio'] = TRUE;
         $resize['width'] = $img['config']['banner']['width'];
         if ($img['config']['banner']['height'] > 0) {
            $resize['height'] = $img['config']['banner']['height'];
         }
         $this->load->library('image_lib', $resize);
         $this->image_lib->resize();
         return [
            'status' => 'success',
            'data' => $this->upload->data(),
         ];
      }
   }
}

/* End of file banner.php */
/* Location: ./application/controllers/banner.php */