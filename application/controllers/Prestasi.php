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

class Prestasi extends MY_Controller {

   private $pk = 'post_id';
   private $table = 'posts';

   public function __construct() {
      parent::__construct();
   }

   public function index() {
      $this->load->helper('text');
      $this->load->library('pagination');
      $config['base_url'] = site_url('prestasi/index');
      $config['uri_segment'] = 3;
      $config['total_rows'] = $this->db->where('post_type', 'prestasi')->count_all_results($this->table);
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
      $this->data['title'] = 'Prestasi';
      $this->data['module'] = $this->data['prestasi'] = TRUE;
      $this->data['alert'] = $this->session->flashdata('alert');
      $prestasi = array('prestasi_sekolah', 'prestasi_ptk', 'prestasi_siswa');
      $this->data['query'] = $this->db
         ->select('post_id, post_type, post_title, post_content')
         ->where_in('post_type', $prestasi)
         ->get($this->table, $config['per_page'], $this->uri->segment(3));
      $this->data['content'] = 'prestasi/read';
      $this->load->view('backend/index', $this->data);
   }

   public function create() {
      if ($_POST) {
         if ($this->validation()) {
            if (!empty($_FILES['file']['name'])) {
               $photo = $this->upload_photo();
               if ($photo['status'] == 'success') {
                  if ($this->db->insert($this->table, $this->field_data('create', $photo['data']))) {
                     $this->session->set_flashdata('alert', alert('success', status('created')));
                  } else {
                     @unlink('./assets/' . $photo['data']['file_name']);
                     $this->session->set_flashdata('alert', alert('warning', status('existed')));
                  }
               } else {
                  $this->session->set_flashdata('alert', alert('error', $photo['data']));
               }
            } else {
               if ($this->db->insert($this->table, $this->field_data('create'))) {
                  $this->session->set_flashdata('alert', alert('success', status('created')));
               } else {
                  $this->session->set_flashdata('alert', alert('warning', status('existed')));
               }
            }
         } else {
            $this->session->set_flashdata('alert', alert('error', validation_errors(), TRUE));
         }
         redirect(uri_string());
      } else {
         $this->data['title'] = 'Tambah Prestasi';
         $this->data['button'] = 'SAVE';
         $this->data['action'] = site_url(uri_string());
         $this->data['module'] = $this->data['prestasi'] = TRUE;
         $this->data['alert'] = $this->session->flashdata('alert');
         $this->data['query'] = FALSE;
         $this->data['content'] = 'prestasi/create';
         $this->load->view('backend/index', $this->data);
      }
   }

   public function update() {
      $id = $this->uri->segment(3);
      if ($_POST) {
         if ($this->validation()) {
            if (empty($_FILES['file']['name'])) {
               if ($this->m_global->update($this->pk, $id, $this->table, $this->field_data('update'))) {
                  $this->session->set_flashdata('alert', alert('success', status('updated')));
               } else {
                  $this->session->set_flashdata('alert', alert('warning', status('existed')));
               }
            } else {
               $photo = $this->upload_photo();

               if ($photo['status'] == 'success') {
                  $query = $this->m_global->find($this->table, $this->pk, $id)->row_array();

                  if ($this->m_global->update($this->pk, $id, $this->table, $this->field_data('update', $photo['data']))) {
                     // hapus photo lama
                     @unlink('./assets/post/thumb/' . $query['post_image']);
                     $this->session->set_flashdata('alert', alert('success', status('updated')));
                  } else {
                     // karena Update gagal, maka photo upload yang barusan harus dihapus
                     @unlink('./assets/post/thumb/' . $photo['post_image']);
                     $this->session->set_flashdata('alert', alert('warning', status('existed')));
                  }
               } else {
                  $this->session->set_flashdata('alert', alert('error', $photo['data']));
               }
            }
         }
         redirect(uri_string());
      } elseif ($id && $id != 0 && ctype_digit((string) $id)) {
         $this->data['title'] = 'Edit Prestasi';
         $this->data['button'] = 'UPDATE';
         $this->data['action'] = site_url(uri_string());
         $this->data['module'] = $this->data['prestasi'] = TRUE;
         $this->data['alert'] = $this->session->flashdata('alert');
         $this->data['query'] = $this->m_global->find($this->table, $this->pk, $id)->row_array();
         $this->data['content'] = 'prestasi/create';
         $this->load->view('backend/index', $this->data);
      } else {
         $this->session->set_flashdata('alert', alert('error', status('404')));
         redirect($this->uri->segment(1));
      }
   }

   public function delete() {
      if (isset($_POST[$this->pk]) && isset($_POST['delete'])) {
         $counter = 0;
         foreach ($_POST[$this->pk] as $key) {
            $query = $this->m_global->find($this->table, $this->pk, $key)->row_array();

            if ($this->m_global->delete($this->pk, $key, $this->table)) {
               @unlink('./assets/post/thumb/' . $query['post_image']);
               $counter++;
            }
         }
         $counter > 0 ?
         $this->session->set_flashdata('alert', alert('success', status('deleted'))) :
         $this->session->set_flashdata('alert', alert('error', status('not_deleted')));
      } elseif ($this->uri->segment(3)) {
         $query = $this->m_global->find($this->table, $this->pk, $this->uri->segment(3))->row_array();

         if ($this->m_global->delete($this->pk, $this->uri->segment(3), $this->table)) {
            @unlink('./assets/post/thumb/' . $query['post_image']);
            $this->session->set_flashdata('alert', alert('success', status('deleted')));
         } else {
            $this->session->set_flashdata('alert', alert('error', status('not_deleted')));
         }
      } else {
         $this->session->set_flashdata('alert', alert('warning', status('not_selected')));
      }
      redirect($this->uri->segment(1));
   }

   private function field_data($type = 'create', $photo = NULL) {
      $data['post_title'] = $this->input->post('post_title');
      $data['post_type'] = $this->input->post('post_type');
      $data['post_content'] = $this->input->post('post_content');
      if ($type == 'create') {
         $data['post_date'] = date('Y-m-d');
         $data['user_id'] = $this->session->userdata('id');
      }
      if ($photo != NULL) {
         $this->resize_photo($photo['file_name']);
         $data['post_image'] = $photo['file_name'];
      }

      return $data;
   }

   private function validation() {
      $this->load->library('form_validation');
      $this->form_validation->set_rules('post_title', 'Title', 'trim|required');
      $this->form_validation->set_rules('post_content', 'Content', 'trim|required');
      $this->form_validation->set_error_delimiters('', '<br>');
      return $this->form_validation->run();
   }

   private function upload_photo() {
      $config['upload_path'] = './assets';
      $config['allowed_types'] = 'gif|jpg|png';
      $config['max_size'] = 5000;
      $config['encrypt_name'] = TRUE;
      $config['overwrite'] = FALSE;
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
      $img = config_themes($this->setting['themes']);
      create_dir('./assets/post/thumb/');
      $this->load->library('image_lib');
      $config['image_library'] = 'gd2';
      $config['source_image'] = './assets/' . $photo;
      $config['new_image'] = './assets/post/thumb/' . $photo;
      $config['create_thumb'] = FALSE;
      $config['maintain_ratio'] = FALSE;
      $config['width'] = $img['config']['prestasi']['width'];
      $config['height'] = $img['config']['prestasi']['height'];
      $this->image_lib->initialize($config);
      $this->image_lib->resize();
      $this->image_lib->clear();
      @unlink('./assets/' . $photo);
   }
}

/* End of file prestasi.php */
/* Location: ./application/controllers/prestasi.php */