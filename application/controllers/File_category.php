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

class File_category extends MY_Controller {

	private $pk = 'category_id';
	private $table = 'file_category';

	public function __construct() {
      parent::__construct();
   }

	public function index() {
		$this->data['title'] = 'Kategori File';
		$this->data['files'] = $this->data['file_category'] = true;
		$this->data['alert'] = $this->session->flashdata('alert');
		$this->data['query'] = $this->m_global->get_parent_table();
		$this->data['content'] = 'file_category/read';
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
			$this->data['title'] = 'Tambah Kategori File';
			$this->data['button'] = 'SIMPAN';
			$this->data['action'] = site_url(uri_string());
			$this->data['files'] = $this->data['file_category'] = true;
			$this->data['alert'] = $this->session->flashdata('alert');
			$this->data['parent'] = $this->parent_category();
			$this->data['query'] = false;
			$this->data['content'] = 'file_category/create';
			$this->load->view('backend/index', $this->data);
		}
	}

	public function update() {
		$id = $this->uri->segment(3);
		if ($_POST) {
			if ($this->validation()) {
				if ($this->m_global->update($this->pk, $id, $this->table, $this->field_data())) {
					$this->session->set_flashdata('alert', alert('success', status('updated')));
				} else {
					$this->session->set_flashdata('alert', alert('warning', status('existed')));
				}
			} else {
				$this->session->set_flashdata('alert', alert('error', validation_errors()));
			}
			redirect(uri_string());
		} elseif ($id && $id != 0 && ctype_digit((string) $id)) {
			$this->data['title'] = 'Edit Kategori File';
			$this->data['button'] = 'UPDATE';
			$this->data['action'] = site_url(uri_string());
			$this->data['files'] = $this->data['file_category'] = true;
			$this->data['alert'] = $this->session->flashdata('alert');
			$this->data['parent'] = $this->parent_category();
			$this->data['query'] = $this->m_global->find($this->table, $this->pk, $id)->row_array();
			$this->data['content'] = 'file_category/create';
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
				if (!$this->is_child_exist($key) && !$this->is_used($key)) {
					if ($this->db->where($this->pk, $key)->delete($this->table)) {
						$n++;
					}
				}
			}
			$n > 0 ?
			$this->session->set_flashdata('alert', alert('success', status('deleted'))) :
			$this->session->set_flashdata('alert', alert('info', status('not_deleted')));
		} else if ($this->uri->segment(3)) {
			if (!$this->is_child_exist($this->uri->segment(3)) && !$this->is_used($this->uri->segment(3))) {
				if ($this->db->where($this->pk, $this->uri->segment(3))->delete($this->table)) {
					$this->session->set_flashdata('alert', alert('success', status('deleted')));
				} else {
					$this->session->set_flashdata('alert', alert('info', status('not_deleted')));
				}
			} else {
				$this->session->set_flashdata('alert', alert('warning', 'Kategori file tidak bisa dihapus karena sudah digunakan sebagai parent kategori pada kategori lainnya!'));
			}
		} else {
			$this->session->set_flashdata('alert', alert('warning', status('not_selected')));
		}
		redirect($this->uri->segment(1));
	}

	private function field_data() {
		return [
			'category' => $this->input->post('category'),
			'parent' => $this->input->post('parent'),
		];
	}

	private function validation() {
		$this->load->library('form_validation');
		$this->form_validation->set_rules('category', 'Category', 'trim|required');
		$this->form_validation->set_error_delimiters('', '<br>');
		return $this->form_validation->run();
	}

	private function parent_category($category_id = '') {
		$this->db->select('category_id, category');
		$this->db->where('parent', 0);

		if ($category_id != '') {
			$this->db->where('category_id !=', $category_id);
		}
		$query = $this->db->get($this->table);
		$data[0] = '(No parent)';
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$data[$row->category_id] = $row->category;
			}
		}
		return $data;
	}

	private function is_child_exist($category_id) {
		return $this->db
			->where('parent', $category_id)
			->count_all_results($this->table) > 0 ? true : false;
	}

	private function is_used($category_id) {
		return $this->db
			->where('category_id', $category_id)
			->count_all_results('file') > 0 ? true : false;
	}
}

/* End of file file_category.php */
/* Location: ./application/controllers/file_category.php */
