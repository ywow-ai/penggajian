<?php
class ModelZakat extends CI_Model
{
  function tampilZakat()
  {
    $this->db->order_by('id', 'ASC');
    return $this->db->from('zakat')
      ->get()
      ->result();
  }

  public function insert_data($data, $table)
  {
    $this->db->insert($table, $data);
  }

  public function update_data($table, $data, $where)
  {
    $this->db->update($table, $data, $where);
  }

  public function delete_data($whare, $table)
  {
    $this->db->where($whare);
    $this->db->delete($table);
  }
}
