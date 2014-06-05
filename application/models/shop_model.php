<?php
class shop_model extends CI_Model {
	
	public function get_all_shop_products($limit = 0,$limit_start = 0){
		$this->db->select('s.*')
		->from('tbl_shop_products  s')
		->order_by('s.p_id','DESC');
		$query = $this->db->get();
		$result['tot_count'] = $query->num_rows();
		
		$this->db->select('s.*')
		->from('tbl_shop_products  s')
		->limit($limit, $limit_start)
		->order_by('s.p_id','DESC');
		$query1 = $this->db->get();
		$result['all_shop_products']=$query1->result_array();
		return $result;
	}
	public function fetch_product_images($p_id){
		return $this->db->get_where('tbl_shop_product_images',array('p_id'=>$p_id))->result_array();
	}
	public function get_shop_product($p_id){
		return $this->db->get_where('tbl_shop_products',array('p_id'=>$p_id))->row_array();
	}
	public function fetch_product_colors($p_id){
		$this->db->select('sc.*,c.col_name')
		->from('tbl_shop_product_colors  sc')
		->join('tbl_colors  c', 'c.col_id = sc.col_id', 'left')
		->where(array('sc.p_id'=>$p_id))
		->order_by('sc.col_id','DESC');
		$query = $this->db->get();
		return $query->result_array();
		
	}
	public function fetch_product_color_name($c_id){
		return $this->db->get_where('tbl_colors',array('col_id'=>$c_id))->row_array();
	}
	
}



