<?php

namespace App\Models;

use CodeIgniter\Model;

class AuthenticationModel extends Model
{
    protected $db;

    function  __construct()
    {
        parent::__construct();
        $this->db = \Config\Database::connect();
    }

    public function login($table,$user, $password)
    {
        $query = $this->db->table($table)
            ->where('user', $user);

        $data = $query->get()->getResult();
        $result = array();

        if (empty($data)) {
            $result['error'] = 1;
            $result['msg'] = 'USER_NOT_FOUND';
            return $result;
        }

        if (password_verify($password, $data[0]->password)) {
            if ($data[0]->status == 1) {
                $result['error'] = 0;
                $result['data'] = $data[0];
            } else {
                $result['error'] = 1;
                $result['msg'] = 'STATUS';
            }
        } else {
            $result['error'] = 1;
            $result['msg'] = 'INVALID_PASSWORD';
        }

        return $result;
    }
}
