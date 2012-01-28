<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
 
require_once(FUEL_PATH.'models/base_module_model.php');
  
class Static_model extends Base_module_model {
 
	public $foreign_keys = array('item_id' => 'items_model');
	
    function __construct()
    {
        parent::__construct('wa_static_shops');
    }
	function list_items($limit = NULL, $offset = NULL, $col = 'id', $order = 'asc')
    {
        $this->db->join('wa_items', 'wa_items.id = wa_static_shops.item_id', 'left');
        $this->db->select('wa_static_shops.id, wa_static_shops.item_id, wa_items.name AS name, wa_items.damage AS damage, wa_static_shops.buy, wa_static_shops.sell', FALSE);
        $data = parent::list_items($limit, $offset, $col, $order);
        return $data;
    }
	function get_static($static_id)
	{
		$this->db->join('wa_items', 'wa_items.id = wa_static_shops.item_id', 'left');
		$this->db->select('wa_static_shops.id, wa_static_shops.item_id, wa_items.name AS name, wa_items.damage AS damage, wa_static_shops.buy, wa_static_shops.sell', FALSE);
		$query = $this->db->get_where('wa_static_shops', array('wa_static_shops.id' => $static_id));
		return $query->result();
	}
	function delete_static($id)
	{
		$this->db->delete('wa_static_shops', array('id' => $id)); 	
	}
	function new_static($item_id, $buy, $selll)
	{
		$data = array(
   			'item_id' => $item_id ,
   			'buy' => $buy,
			'sell' => $sell
		);

		$this->db->insert('wa_static_shops', $data); 
	}
}
