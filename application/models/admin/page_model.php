<?php
class Page_Model extends CI_Model {
	public function get_pages() 
	{	
		$this->db->select('*');
		$this->db->order_by('page_id');
		$result = $this->db->get('tbl_pages');
		return $result->result();
	}
	public	function change_status($table, $column, $value, $uniqueNameCol, $uniqueColValue){
		$query = $this->db->query("UPDATE ".$table." SET `".$column."` = '".$value."' WHERE `".$uniqueNameCol."` = '".$uniqueColValue."' ");	
		return true;
	}
	public function delete_page($page_id){
		$query = $this->db->where('page_id', $page_id);
	    $query = $this->db->delete('tbl_pages');
		return ($this->db->affected_rows() > 0) ? TRUE : FALSE;
	}
	public function edit_page($page_id){
		$this->db->select('*');
		$this->db->where('page_id',$page_id);
		$result = $this->db->get('tbl_pages');
		return $result->row();
	}
	public function edit_save_page($page_id ,$page_data){
		$this->db->where("page_id", $page_id);
		$sql =$this->db->update('tbl_pages' ,$page_data);
		return true;
	}	
	public function add_page($page_data){
		$sql =$this->db->insert('tbl_pages' ,$page_data);
		return true;
	}
	public function get_news() {	
		$this->db->select('*');
		$this->db->order_by('id','DESC');			
		$result = $this->db->get('tbl_news');
		return $result->result();
	}
	public function save_news($news_data){		
		$sql =$this->db->insert('tbl_news' ,$news_data);
		return $this->db->insert_id();
	}
	public function edit_news($news_id){
		$this->db->select('*');
		$this->db->where('id',$news_id);
		$result = $this->db->get('tbl_news');
		return $result->row();
	}
	public function update_news($news_id ,$news_data){
		$this->db->where("id", $news_id);
		$sql =$this->db->update('tbl_news' ,$news_data);
		return true;
	}
	public function delete_news($news_id){
		$query = $this->db->where('id', $news_id);
		$query = $this->db->delete('tbl_news');
		return ($this->db->affected_rows() > 0) ? TRUE : FALSE;
	}
	public function get_faqs() {	
		$this->db->select('*');
		$this->db->order_by('id','DESC');			
		$result = $this->db->get('tbl_faqs');
		return $result->result();
	}
	public function save_faq($faq_data){
		$sql =$this->db->insert('tbl_faqs' ,$faq_data);
		return true;
	}
	public function edit_faq($faq_id){
		$this->db->select('*');
		$this->db->where('id',$faq_id);
		$result = $this->db->get('tbl_faqs');
		return $result->row();
	}		
	public function update_faq($faq_id ,$news_data){
		$this->db->where("id", $faq_id);
		$sql =$this->db->update('tbl_faqs' ,$news_data);
		return true;
	}
	public function delete_faq($faq_id){
		$query = $this->db->where('id', $faq_id);  
		$query = $this->db->delete('tbl_faqs');
		return ($this->db->affected_rows() > 0) ? TRUE : FALSE;
	}
}
