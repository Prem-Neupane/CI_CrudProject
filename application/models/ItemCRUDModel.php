<?php


class ItemCRUDModel extends CI_Model
{
    public function get_itemCRUD()
    {
        if (!empty($this->input->get("search"))) {
            $this->db->like('title', $this->input->get("search"));
            $this->db->or_like('description', $this->input->get("search"));
        }
        // var_dump($this->db);
        $query = $this->db->get("items");
        return $query->result();
    }


    public function insert_item()
    {
        $data = array(
            'title' => $this->input->post('title'),
            'description' => $this->input->post('description')
        );
        return $this->db->insert('items', $data);
    }


    public function update_item($id)
    {
        $data=array(
            'title' => $this->input->post('title'),
            'description'=> $this->input->post('description')
        );
        if ($id==0) {
            return $this->db->insert('items', $data);
        } else {
            $this->db->where('id', $id);
            return $this->db->update('items', $data);
        }
    }


    public function find_item($id)
    {
        return $this->db->get_where('items', array('id' => $id))->row();
    }


    public function delete_item($id)
    {
        return $this->db->delete('items', array('id' => $id));
    }
}
