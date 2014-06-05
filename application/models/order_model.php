<?php
class order_model extends CI_Model {
	public function save_order($order_array=array()){
		$this->db->insert('tbl_orders',$order_array);
		return $this->db->insert_id();
	}
	public function get_paypal_info(){
		return $this->db->get_where('tbl_settings')->row_array();
	}
	public function save_order_tems($order_array=array()){
		$this->db->insert('tbl_order_items',$order_array);
		return $this->db->insert_id();
	}
	public function get_order_items($order_id){
		return $this->db->get_where('tbl_order_items',array('order_id'=>$order_id))->result_array();
	}
	public function check_ship_email($ship_email){
		$result = $this->db->get_where( "tbl_orders", array("ship_email" => $this->db->escape_str($ship_email)));
		return ( $result->num_rows()  );
	}
	public function check_ship_order($ship_order_id){
		$result = $this->db->get_where( "tbl_orders", array("order_id" =>$ship_order_id));
		return ( $result->num_rows() );
	}
	public function get_tracking_order($order_id,$ship_email){
		return $this->db->get_where('tbl_tracking_order',array('order_id'=>$order_id,'ship_email'=>$ship_email))->row_array();
	}
	public function get_user_info($u_id){
		return $this->db->get_where('tbl_users',array('u_id'=>$u_id))->row_array();
	}
		public function get_order_info($order_id){
		return $this->db->get_where('tbl_orders',array('order_id'=>$order_id))->row_array();
	}
	public function update($tbl,$data,$field,$value){
		$this->db->where($field,$value);
		return $this->db->update($tbl,$data);
	}
}



