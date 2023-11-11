<?php

namespace App\Controllers;

use App\Models\MainModel;
use App\Models\AuthenticationModel;

class Admin extends BaseController
{
    protected $objRequest;
    protected $objSession;
    protected $objEmail;
    protected $objMainModel;
    protected $objAuthenticationModel;

    public function __construct()
    {
        $this->objRequest = \Config\Services::request();
        $this->objSession = session();
        $this->objMainModel = new MainModel;
        $this->objAuthenticationModel = new AuthenticationModel;

        $emailConfig = array();
        $emailConfig['protocol'] = EMAIL_PROTOCOL;
        $emailConfig['SMTPHost'] = EMAIL_SMTP_HOST;
        $emailConfig['SMTPUser'] = EMAIL_SMTP_USER;
        $emailConfig['SMTPPass'] = EMAIL_SMTP_PASSWORD;
        $emailConfig['SMTPPort'] = EMAIL_SMTP_PORT;
        $emailConfig['SMTPCrypto'] = EMAIL_SMTP_CRYPTO;
        $emailConfig['mailType'] = EMAIL_MAIL_TYPE;

        $this->objEmail = \Config\Services::email($emailConfig);
    }

    public function index()
    {
        # Verify Admin Session
        if (empty($this->objSession->get('user')) || $this->objSession->get('user')['role'] != 'admin') {
            $response = array();
            $response['error'] = 2;
            $response['msg'] = 'SESSION_EXPIRED';
            return json_encode($response);
        }
        $data = array();
        $data['user'] = $this->objSession->get('user');
        $data['page'] = 'admin/main';
        return view('admin/header/index', $data);
    }

    #PRODUCTS

    public function showViewProducts()
    {
        # Verify Admin Session
        if (empty($this->objSession->get('user')) || $this->objSession->get('user')['role'] != 'admin') {
            $response = array();
            $response['error'] = 2;
            $response['msg'] = 'SESSION_EXPIRED';
            return json_encode($response);
        }
        $data = array();
        $data['user'] = $this->objSession->get('user');
        $data['page'] = 'admin/products/products';
        $data['products'] = $this->objMainModel->objData('products');
        return view('admin/header/index', $data);
    }

    public function showViewCreateProduct()
    {
        # Verify Admin Session
        if (empty($this->objSession->get('user')) || $this->objSession->get('user')['role'] != 'admin') {
            $response = array();
            $response['error'] = 2;
            $response['msg'] = 'SESSION_EXPIRED';
            return json_encode($response);
        }
        $data = array();
        $data['user'] = $this->objSession->get('user');
        $data['page'] = 'admin/products/createProduct';
        $data['categories'] = $this->objMainModel->objData('category');
        $data['subCategories'] = $this->objMainModel->objData('subCategory');
        return view('admin/header/index', $data);
    }

    public function productActions()
    {
        # Verify Admin Session
        if (empty($this->objSession->get('user')) || $this->objSession->get('user')['role'] != 'admin') {
            $response = array();
            $response['error'] = 2;
            $response['msg'] = 'SESSION_EXPIRED';
            return json_encode($response);
        }

        $id = htmlspecialchars(trim($this->objRequest->getPost('id')));
        $action = htmlspecialchars(trim($this->objRequest->getPost('action')));
        $data = array();
        if ($action == 'edit') {
            $data['user'] = $this->objSession->get('user');
            $data['categories'] = $this->objMainModel->objData('category');
            $data['subCategories'] = $this->objMainModel->objData('subCategory');
            $data['product'] = $this->objMainModel->objDataByID('products', $id);
            $data['edit'] = 'yes';
            return view('admin/products/createProduct', $data);
        } elseif ($action == 'delete') {
            $response = $this->objMainModel->objDelete('products', $id);
            return json_encode($response);
        } elseif ($action == 'update') {
            $data['name'] = htmlspecialchars(trim($this->objRequest->getPost('name')));
            $data['description'] = htmlspecialchars(trim($this->objRequest->getPost('description')));
            $data['price'] = htmlspecialchars(trim($this->objRequest->getPost('price')));
            $data['status'] = htmlspecialchars(trim($this->objRequest->getPost('status')));
            $data['categoryID'] = htmlspecialchars(trim($this->objRequest->getPost('category')));
            $data['subcategoryID'] = htmlspecialchars(trim($this->objRequest->getPost('subCategory')));
            $data['quantity'] = htmlspecialchars(trim($this->objRequest->getPost('quantity')));
            $response = $this->objMainModel->objUpdate('products', $data, $id);
            return json_encode($response);
        }
    }

    public function createProduct()
    {
        # Verify Admin Session
        if (empty($this->objSession->get('user')) || $this->objSession->get('user')['role'] != 'admin') {
            $response = array();
            $response['error'] = 2;
            $response['msg'] = 'SESSION_EXPIRED';
            return json_encode($response);
        }

        $productID = '';
        $chars = '0123456789';
        $length = 10;

        for ($i = 0; $i < $length; $i++) {
            $index = mt_rand(0, strlen($chars) - 1);
            $productID .= $chars[$index];
        }

        $data = array();
        $data['productID'] = $productID;
        $data['name'] = htmlspecialchars(trim($this->objRequest->getPost('name')));
        $data['description'] = htmlspecialchars(trim($this->objRequest->getPost('description')));
        $data['price'] = htmlspecialchars(trim($this->objRequest->getPost('price')));
        $data['status'] = htmlspecialchars(trim($this->objRequest->getPost('status')));
        $data['categoryID'] = htmlspecialchars(trim($this->objRequest->getPost('category')));
        $data['subcategoryID'] = htmlspecialchars(trim($this->objRequest->getPost('subCategory')));
        $data['quantity'] = htmlspecialchars(trim($this->objRequest->getPost('quantity')));

        $response = $this->objMainModel->objCreate('products', $data);

        return json_encode($response);
    }

    public function showViewModalCreateCategory()
    {
        # Verify Admin Session
        if (empty($this->objSession->get('user')) || $this->objSession->get('user')['role'] != 'admin') {
            $response = array();
            $response['error'] = 2;
            $response['msg'] = 'SESSION_EXPIRED';
            return json_encode($response);
        }

        return view('admin/modals/createCategory');
    }

    public function createCategory()
    {
        # Verify Admin Session
        if (empty($this->objSession->get('user')) || $this->objSession->get('user')['role'] != 'admin') {
            $response = array();
            $response['error'] = 2;
            $response['msg'] = 'SESSION_EXPIRED';
            return json_encode($response);
        }

        $data['name'] = htmlspecialchars(trim($this->objRequest->getPost('name')));

        # Check Duplicate Category
        $checkName = $this->objMainModel->objCheckDuplicate('category', 'name', $data['name'], '');
        if (!empty($checkName)) {
            $response['error'] = 1;
            $response['msg'] = "DUPLICATE_USER_NAME";
            return json_encode($response);
        }

        $response = $this->objMainModel->objCreate('category', $data);

        return json_encode($response);
    }

    public function showViewModalCreateSubCategory()
    {
        # Verify Admin Session
        if (empty($this->objSession->get('user')) || $this->objSession->get('user')['role'] != 'admin') {
            $response = array();
            $response['error'] = 2;
            $response['msg'] = 'SESSION_EXPIRED';
            return json_encode($response);
        }

        $data['categories'] = $this->objMainModel->objData('category');

        return view('admin/modals/createSubCategory', $data);
    }

    public function createSubCategory()
    {
        # Verify Admin Session
        if (empty($this->objSession->get('user')) || $this->objSession->get('user')['role'] != 'admin') {
            $response = array();
            $response['error'] = 2;
            $response['msg'] = 'SESSION_EXPIRED';
            return json_encode($response);
        }
        $data = array();
        $data['name'] = htmlspecialchars(trim($this->objRequest->getPost('name')));
        $data['categoryID'] = htmlspecialchars(trim($this->objRequest->getPost('categoryID')));

        # Check Duplicate subCategory
        $checkName = $this->objMainModel->objCheckDuplicate('subcategory', 'name', $data['name'], '');
        if (!empty($checkName)) {
            $response['error'] = 1;
            $response['msg'] = "DUPLICATE_USER_NAME";
            return json_encode($response);
        }

        $response = $this->objMainModel->objCreate('subcategory', $data);

        return json_encode($response);
    }

    #END PRODUCTS

    public function showViewEmployees()
    {
        # Verify Admin Session
        if (empty($this->objSession->get('user')) || $this->objSession->get('user')['role'] != 'admin') {
            $response = array();
            $response['error'] = 2;
            $response['msg'] = 'SESSION_EXPIRED';
            return json_encode($response);
        }
        $data = array();
        $data['user'] = $this->objSession->get('user');
        $data['page'] = 'admin/main';
        return view('admin/header/index', $data);
    }

    public function showViewSales()
    {
        # Verify Admin Session
        if (empty($this->objSession->get('user')) || $this->objSession->get('user')['role'] != 'admin') {
            $response = array();
            $response['error'] = 2;
            $response['msg'] = 'SESSION_EXPIRED';
            return json_encode($response);
        }
        $data = array();
        $data['user'] = $this->objSession->get('user');
        $data['page'] = 'admin/main';
        return view('admin/header/index', $data);
    }
}
    //var_dump($data['user']);exit();