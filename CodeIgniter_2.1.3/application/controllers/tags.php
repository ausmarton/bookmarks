<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tags extends CI_Controller {
	
    	function __construct()
    	{
        	parent::__construct();
		$this->load->model('tag');
    	}

	public function index()
	{
		$tag = new Tag();
		$data['tags'] = $tag->get();
		$this->load->view('tags',$data);
	}
	public function save() {
		$tag = new Tag();
		if(trim($this->input->post('id',TRUE)) != "")
			$tag->id = $this->input->post('id',TRUE);
		$tag->name = $this->input->post('name',TRUE);
		if($tag->save()) {
			redirect(site_url() . "/tags/",'location');
		}
	}
	public function add()
	{
		$data['type'] = "create";
		$data['name'] = "";
		$this->load->view('save_tag',$data);
	}
	public function edit($id)
	{
		$tags = new Tag();
		$data['type'] = "edit";
		$tags->where(array('id' => $id));
		$tag = $tags->get();
		$data['id'] = $tag->id;
		$data['name'] = $tag->name;
		$this->load->view('save_tag',$data);
	}
	public function remove($id)
	{
		$tag = new Tag();
		$tag->id = $this->uri->segment(3);
		if($tag->delete()) {
			redirect(site_url() . "/tags/",'location');
		}
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
