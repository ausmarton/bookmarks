<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tags extends CI_Controller {
	
    	function __construct()
    	{
        	parent::__construct();
		$this->load->model('tag');
    	}

	private function get_JSON($tag_models) {
                $tags = array();
                foreach($tag_models as $tag_model) {
                	$tags[] = array(
                        	'id' => $tag_model->id,
                                'name' => $tag_model->name
                        );
                }
                return $tags;
        }

	private function get_from_JSON() {
                return json_decode(file_get_contents("php://input"), true);
        }


	public function get_index()
	{
		$tag = new Tag();
		$data['tags'] = $tag->get();
		echo json_encode($this->get_JSON($data['tags']));		
	}


	public function post_create(){
                $tag = new Tag();
                $this->save($tag);
        }
        public function put_update($id){
                $tag = new Tag();
                $tag->id = $id;
                $this->save($tag);
        }
        private function save($tag) {
                $post_data = $this->get_from_JSON();
                $tag->name = $post_data['name'];
		$tag->save();
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
