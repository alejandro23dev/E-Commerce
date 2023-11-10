<?php

namespace App\Models;

use CodeIgniter\Model;

class MainModel extends Model
{
    protected $db;

    function  __construct()
    {
        parent::__construct();
        $this->db = \Config\Database::connect();
    }

    public function objData($table)
    {
        $query = $this->db->table($table)
            ->select('*');

        return $query->get()->getResult();
    }

    public function getProducts()
    {
        $query = $this->db->table('products')
            ->select('*')
            ->where('status !=', '');

        return $query->get()->getResult();
    }

    public function getProductsByCategory($categoryID)
    {
        $query = $this->db->table('products')
            ->select('*')
            ->where('status !=', '')
            ->where('categoryID', $categoryID);

        return $query->get()->getResult();
    }

    public function objCreate($table, $data)
    {
        $this->db->table($table)
            ->insert($data);

        $result = array();
        if ($this->db->resultID !== null) {
            $result['error'] = 0;
            $result['id'] = $this->db->connID->insert_id;
        } else
            $result['error'] = 1;

        return $result;
    }

    public function objUpdate($table, $data, $id)
    {
        $query = $this->db->table($table)
            ->where('id', $id)
            ->update($data);

        $result = array();

        if ($query == true) {
            $result['error'] = 0;
            $result['id'] = $id;
        } else
            $result['error'] = 1;

        return $result;
    }

    public function objCheckDuplicate($table, $field, $value, $id = null)
    {
        $query = $this->db->table($table)
            ->where($field, $value);

        if (!empty($id))
            $query->whereNotIn('id', [0 => $id]);

        return $query->get()->getResult();
    }

    public function objDataByField($table, $field, $value)
    {
        $query = $this->db->table($table)
            ->where($field, $value);

        return $query->get()->getResult();
    }

    public function objDataByID($table, $id)
    {
        $query = $this->db->table($table)
            ->where('id', $id);

        return $query->get()->getResult();
    }
}
