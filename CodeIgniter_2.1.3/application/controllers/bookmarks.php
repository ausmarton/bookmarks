<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Bookmarks extends CI_Controller {
	
    	function __construct()
    	{
        	parent::__construct();
    	}

	public function index()
	{
		$this->load->model('bookmark');
		$data['bookmarks'] = $this->Bookmark->all();
		$this->load->view('bookmarks',$data);
	}
	public function save() {
		$bookmark = new Bookmark();
		$bookmark->id = $this->input->post('id',TRUE);
		$bookmark->name = $this->input->post('name',TRUE);
		$bookmark->url = $this->input->post('url',TRUE);
		if($bookmark->save()) {
			redirect(site_url() . "/bookmarks/",'location');
		}
	}
	public function add()
	{
		$data['type'] = "create";
		$data['name'] = "";
		$data['url'] = "";
		$this->load->view('save_bookmark',$data);
	}
	public function edit($id)
	{
		$data['type'] = "edit";
		$this->load->model('bookmark');
		$bookmark = $this->Bookmark->get($id);
		$data['id'] = $bookmark->id;
		$data['name'] = $bookmark->name;
		$data['url'] = $bookmark->url;
		$this->load->view('save_bookmark',$data);
	}
	public function remove($id)
	{
		$bookmark = new Bookmark();
		$bookmark->id = $this->uri->segment(3);
		if($bookmark->remove()) {
			redirect(site_url() . "/bookmarks/",'location');
		}
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
