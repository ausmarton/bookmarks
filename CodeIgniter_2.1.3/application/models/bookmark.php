<?php
class Bookmark extends CI_Model {

    var $id = '';
    var $name   = '';
    var $url = '';

    function __construct()
    {
        parent::__construct();
    }
    
    function all()
    {
        $query = $this->db->get('bookmarks');
        return $query->result();
    }

    function save() {
	if(isset($this->id) && trim($this->id)!="")
		return $this->update();
	else
		return $this->insert();
    }

    function insert()
    {
	return $this->db->insert('bookmarks',$this);
    }

    public function remove()
    {
        $this->db->where('id', $this->id);
        return $this->db->delete('bookmarks');
    }


    function get($id) {
	$query = $this->db->get_where('bookmarks',array('id' => $id));
	return $query->row();
    }

    function update()
    {
        $this->db->set('name',$this->name);
        $this->db->set('url',$this->url);
        $this->db->where('id',$this->id);
        return $this->db->update('bookmarks');
    }

}
