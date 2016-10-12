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

class Pages extends MY_Controller {

   private $pk = 'post_id';
   private $table = 'posts';

   public function __construct() {
      parent::__construct();
   }

   public function index() {
      $this->load->helper('text');
      $this->load->library('pagination');
      $config['base_url'] = site_url('pages/index');
      $config['uri_segment'] = 3;
      $config['total_rows'] = $this->db->where('post_type', 'page')->count_all_results($this->table);
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
      $this->data['title'] = 'Pages';
      $this->data['pages'] = $this->data['page'] = TRUE;
      $this->data['alert'] = $this->session->flashdata('alert');
      $this->data['query'] = $this->db
         ->select('p.post_id, p.post_title, p.post_date, u.display_name')
         ->where('p.post_type', 'page')
         ->order_by('p.post_title', 'ASC')
         ->join('users u', 'p.user_id = u.id', 'LEFT')
         ->get($this->table . ' p', $config['per_page'], $this->uri->segment(3));
      $this->data['content'] = 'pages/read';
      $this->load->view('backend/index', $this->data);
   }

   public function create() {
      if ($_POST) {
         if ($this->validation()) {
            if ($this->db->insert($this->table, $this->field_data())) {
               $this->session->set_flashdata('alert', alert('success', status('created')));
            } else {
               $this->session->set_flashdata('alert', alert('warning', status('existed')));
            }
         } else {
            $this->session->set_flashdata('alert', alert('error', validation_errors()));
         }
         redirect(uri_string());
      } else {
         $this->data['title'] = 'Add New Page';
         $this->data['button'] = 'PUBLISH';
         $this->data['action'] = site_url(uri_string());
         $this->data['pages'] = $this->data['add_page'] = TRUE;
         $this->data['alert'] = $this->session->flashdata('alert');
         $this->data['parent'] = $this->parent_pages();
         $this->data['query'] = FALSE;
         $this->data['content'] = 'pages/create';
         $this->load->view('backend/index', $this->data);
      }
   }

   public function update() {
      $id = $this->uri->segment(3);
      if ($_POST) {
         if ($this->validation()) {
            if ($this->m_global->update($this->pk, $id, $this->table, $this->field_data('update'))) {
               $this->session->set_flashdata('alert', alert('success', 'Page updated'));
            } else {
               $this->session->set_flashdata('alert', alert('warning', status('existed')));
            }
         } else {
            $this->session->set_flashdata('alert', alert('error', validation_errors()));
         }
         redirect(uri_string());
      } elseif ($id && $id != 0 && ctype_digit((string) $id)) {
         $this->data['title'] = 'Edit Page';
         $this->data['button'] = 'UPDATE';
         $this->data['action'] = site_url(uri_string());
         $this->data['pages'] = $this->data['page'] = TRUE;
         $this->data['alert'] = $this->session->flashdata('alert');
         $this->data['parent'] = $this->parent_pages($id);
         $this->data['query'] = $this->m_global->find($this->table, $this->pk, $id)->row_array();
         $this->data['content'] = 'pages/create';
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
            if (!$this->is_child_exist($key)) {
               if ($this->db->where($this->pk, $key)->delete($this->table)) {
                  $n++;
               }
            }
         }
         $n > 0 ?
         $this->session->set_flashdata('alert', alert('success', status('deleted'))) :
         $this->session->set_flashdata('alert', alert('info', status('not_deleted')));
      } else if ($this->uri->segment(3)) {
         if (!$this->is_child_exist($this->uri->segment(3))) {
            if ($this->db->where($this->pk, $this->uri->segment(3))->delete($this->table)) {
               $this->session->set_flashdata('alert', alert('success', status('deleted')));
            } else {
               $this->session->set_flashdata('alert', alert('info', status('not_deleted')));
            }
         } else {
            $this->session->set_flashdata('alert', alert('warning', 'Page tidak bisa dihapus karena sudah digunakan sebagai parent page pada page lainnya!'));
         }
      } else {
         $this->session->set_flashdata('alert', alert('warning', status('not_selected')));
      }

      redirect($this->uri->segment(1));
   }

   private function field_data($type = 'create') {
      $data['post_title'] = $this->input->post('post_title');
      $data['post_parent'] = $this->input->post('post_parent');
      $data['post_content'] = $this->input->post('post_content');
      $data['slug'] = url_title(strtolower($this->input->post('post_title')));
      if ($type == 'create') {
         $data['post_type'] = 'page';
         $data['post_date'] = date('Y-m-d');
         $data['user_id'] = $this->session->userdata('id');
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

   /**
    * Save menu position
    */
   public function save_position() {
      if (NULL !== $this->input->post('page')) {
         $page = json_decode($this->input->post('page'), TRUE);
         $this->update_position(0, $page);
      }
      $response = [];
      $response['growl'] = 'success';
      $response['message'] = 'Your data have been saved.';
      $this->output
         ->set_content_type('application/json')
         ->set_output(json_encode($response));
   }

   /**
    * Recursive function for save menu position
    */
   private function update_position($parent, $children) {
      $i = 1;
      foreach ($children as $key => $value) {
         $post_id = $children[$key]['id'];
         $data['post_parent'] = $parent;
         $data['order_pages'] = $i;
         $this->db->where('post_id', $post_id)->update('posts', $data);
         if (isset($children[$key]['children'][0])) {
            $this->update_position($post_id, $children[$key]['children']);
         }
         $i++;
      }
   }

   private function parent_pages($post_id = '') {
      $this->db->select('post_id, post_title');
      $this->db->where('post_type', 'page');
      if ($post_id != '') {
         $this->db->where('post_id !=', $post_id);
      }
      $query = $this->db->get($this->table);
      $data[0] = '(No parent)';
      if ($query->num_rows() > 0) {
         foreach ($query->result() as $row) {
            $data[$row->post_id] = $row->post_title;
         }
      }
      return $data;
   }

   private function is_child_exist($post_id) {
      return $this->db
         ->where('post_parent', $post_id)
         ->count_all_results($this->table) > 0 ? TRUE : FALSE;
   }

   public function page_order() {
      $this->data['title'] = 'Page Order';
      $this->data['pages'] = $this->data['page_order'] = TRUE;
      $this->data['alert'] = $this->session->flashdata('alert');
      $this->data['query'] = $this->GetParentPages();
      $this->data['content'] = 'pages/order_pages';
      $this->load->view('backend/index', $this->data);
   }

   /**
    * Fungsi untuk menu recursive : TOP Navigasi
    */
   private function GetParentPages($parent = 0) {
      $data = [];
      $this->db->where('post_type', 'page');
      $this->db->where('post_parent', $parent);
      $this->db->order_by('order_pages', 'ASC');
      $result = $this->db->get('posts');
      foreach ($result->result() as $row) {
         $data[] = [
            'post_id' => $row->post_id,
            'post_title' => $row->post_title,
            'child' => $this->GetParentPages($row->post_id),
         ];
      }

      return $data;
   }
}

/* End of file pages.php */
/* Location: ./application/controllers/pages.php */