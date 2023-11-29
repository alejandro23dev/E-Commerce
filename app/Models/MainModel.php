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

    public function getProducts($categoryID = null)
    {
        $query = $this->db->table('products')
            ->select('*')
            ->where('status !=', '');
        if (!empty($categoryID))
            $query->where('categoryID', $categoryID);

        return $query->get()->getResult();
    }

    public function getBuyProducts($clientID)
    {
        $query = $this->db->table('shop')
            ->select('
            shop.id as shopID,
            shop.productID,
            shop.clientID,
            shop.quantity,
            shop.price as shopPrice,
            products.id as productId,
            products.name,
            products.productID,
            products.description,
            products.price,
            ')
            ->join('products', 'products.id = shop.productID')
            ->join('clients', 'clients.id = shop.clientID')
            ->where('clientID', $clientID);

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

    public function objDelete($table, $id)
    {
        $this->db->table($table)
            ->where('id', $id)
            ->delete();

        return $this->resultID;
    }

    public function objDeleteBy2Field($table, $field1, $value1, $field2, $value2)
    {
        $this->db->table($table)
            ->where($field1, $value1)
            ->where($field2, $value2)
            ->delete();

        return $this->resultID;
    }

    public function objCheckDuplicate($table, $field, $value, $id = null)
    {
        $query = $this->db->table($table)
            ->where($field, $value);

        if (!empty($id))
            $query->whereNotIn('id', [0 => $id]);

        return $query->get()->getResult();
    }

    public function objDataByField($table, $field1, $value1, $field2 = null, $value2 = null)
    {
        $query = $this->db->table($table)
            ->where($field1, $value1);

        if (!empty($field2) && !empty($value2)) {
            $query->where($field2, $value2);
        }

        return $query->get()->getResult();
    }

    public function objDataByID($table, $id)
    {
        $query = $this->db->table($table)
            ->where('id', $id);

        return $query->get()->getResult();
    }
}
