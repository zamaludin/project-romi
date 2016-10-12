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

class Hubungi_kami extends MY_Controller {

	private $pk    = 'id';
	private $table = 'hubungi_kami';

    public function __construct() {
      parent::__construct();
   }

	public function index() {
		$this->load->library('pagination');
        $config['base_url']    	   = site_url('hubungi_kami/index');
        $config['uri_segment'] 	   = 3;
        $config['total_rows']  	   = $this->db->count_all_results($this->table);
        $config['per_page']    	   = 10;
        $config['prev_link']   	   = 'Prev';
        $config['next_link']   	   = 'Next';
        $config['prev_tag_open']   = '<li>';
        $config['prev_tag_close']  = '</li>';
        $config['next_tag_open']   = '<li>';
        $config['next_tag_close']  = '</li>';
        $config['first_link']  	   = '&laquo;';
        $config['last_link']   	   = '&raquo;';
        $config['first_tag_open']  = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['last_tag_open']   = '<li>';
        $config['last_tag_close']  = '</li>';
        $config['num_tag_open']    = '<li>';
        $config['num_tag_close']   = '</li>';
        $config['cur_tag_open']    = '<li><a>';
        $config['cur_tag_close']   = '</a></li>';
        $this->pagination->initialize($config);
        $this->data['pagination']  = $this->pagination->create_links();
        $this->data['total_rows']  = $config['total_rows'];
		$this->data['title']   	   = 'Hubungi Kami';
        $this->data['module']      = $this->data['hubungi_kami'] = TRUE;
		$this->data['alert']   	   = $this->session->flashdata('alert');
		$this->data['query']   	   = $this->db->order_by('tanggal', 'DESC')->get($this->table, $config['per_page'], $this->uri->segment(3));
		$this->data['content'] 	   = 'hubungi_kami/read';
		$this->load->view('backend/index', $this->data);
	}

    public function reply() {
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
            $this->data['title']   = 'Post hubungi_kami';
            $this->data['button']  = 'UPDATE';
            $this->data['action']  = site_url(uri_string());
            $this->data['posts']   = $this->data['hubungi_kami'] = TRUE;
            $this->data['alert']   = $this->session->flashdata('alert');
            $this->data['query']   = $this->m_global->find($this->table, $this->pk, $id)->row_array();
            $this->data['content'] = 'hubungi_kami/create';
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
                if ($this->db->where($this->pk, $key)->delete($this->table)) {
                    $n++;
                }
            }
            $n > 0 ? 
            $this->session->set_flashdata('alert', alert('success', status('deleted'))) :
            $this->session->set_flashdata('alert', alert('info', status('not_deleted')));
        } else if ($this->uri->segment(3)) {
            if ($this->db->where($this->pk, $this->uri->segment(3))->delete($this->table)) {
                $this->session->set_flashdata('alert', alert('success', status('deleted')));
            } else {
                $this->session->set_flashdata('alert', alert('info', status('not_deleted')));
            }
        } else {
            $this->session->set_flashdata('alert', alert('warning', status('not_selected')));
        }
        redirect($this->uri->segment(1));
    }

    private function field_data() {
        return [
        	'nama'       => $this->input->post('nama'),
            'email'      => $this->input->post('email'),
            'url'        => prep_url($this->input->post('url')),
            'pertanyaan' => $this->input->post('pertanyaan'),
            'tanggal'    => date('Y-m-d H:i:s'),
            'ip_address' => $this->input->ip_address()
		];
    }

	private function validation() {
		$this->load->library('form_validation');
        $this->form_validation->set_rules('nama',       'Nama',  'trim|required');
        $this->form_validation->set_rules('email',      'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('url',        'URL',   'trim|');
        $this->form_validation->set_rules('pertanyaan', 'Pesan', 'trim|required');
        $this->form_validation->set_error_delimiters('', '');
        return $this->form_validation->run();
	}
}

/* End of file hubungi_kami.php */
/* Location: ./application/controllers/hubungi_kami.php */