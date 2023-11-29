<?php

namespace App\Controllers;

use App\Models\MainModel;
use App\Models\AuthenticationModel;

class Client extends BaseController
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
        $data = array();
        # Verify client Session
        if (empty($this->objSession->get('user')['role']) || $this->objSession->get('user')['role'] != 'client') {
            $data['user'] = '';
        } else {
            $data['user'] = $this->objMainModel->objDataByID('clients', $this->objSession->get('user')['id']);
            $data['buyProducts'] = $this->objMainModel->getBuyProducts($this->objSession->get('user')['id']);
        }

        $data['page'] = 'client/main';
        $data['categories'] = $this->objMainModel->objData('category');
        $data['products'] = $this->objMainModel->getProducts();

        //var_dump($data);exit();

        return view('client/header/index', $data);
    }

    public function logout()
    {
        # DESTROY SESSION
        $sessionArray['id'] = '';
        $sessionArray['user'] = '';
        $sessionArray['email'] = '';
        $sessionArray['role'] = '';

        $this->objSession->set('user', $sessionArray);
    }

    public function showSignUp()
    {
        $data['page'] = 'login/signUp';
        return view('client/header/index', $data);
    }

    public function showSignIn()
    {
        $data['page'] = 'login/signIn';
        return view('client/header/index', $data);
    }

    public function getProducts()
    {
        $data = array();
        # Verify client Session
        if (empty($this->objSession->get('user')['role']) || $this->objSession->get('user')['role'] != 'client') {
            $data['user'] = '';
        } else {
            $data['user'] = $this->objMainModel->objDataByID('clients', $this->objSession->get('user')['id']);
            $data['buyProducts'] = $this->objMainModel->getBuyProducts($this->objSession->get('user')['id']);
        }
        $categoryID = $this->objRequest->getPost('categoryID');

        $data['categories'] = $this->objMainModel->objData('category');
        $data['categorySelected'] = $categoryID;
        if ($categoryID == 1 || empty($categoryID)) {
            $data['products'] = $this->objMainModel->getProducts();
        } else {
            $data['products'] = $this->objMainModel->getProducts($categoryID);
        }

        return view('products/main', $data);
    }

    public function showModalSignIn()
    {
        return view('client/modals/login');
    }

    public function addProductToShop()
    {
        # Verify client Session
        if (empty($this->objSession->get('user')['role']) || $this->objSession->get('user')['role'] != 'client') {
            $response['error'] = 3;
            $response['msg'] = "SESSION_EXPIRED";
            return json_encode($response);
        }

        $data = array();
        $data['productID'] = $this->objRequest->getPost('productID');
        $data['clientID'] = $this->objSession->get('user')['id'];
        $data['quantity'] = 1;
        $data['price'] = $this->objRequest->getPost('productPrice');

        $response = $this->objMainModel->objCreate('shop', $data);
        return json_encode($response);
    }

    public function removeProductToShop()
    {
        # Verify client Session
        if (empty($this->objSession->get('user')['role']) || $this->objSession->get('user')['role'] != 'client') {
            $response['error'] = 3;
            $response['msg'] = "SESSION_EXPIRED";
            return json_encode($response);
        }
        $productID = $this->objRequest->getPost('productID');

        $response = $this->objMainModel->objDeleteBy2Field('shop', 'productID', $productID, 'clientID', $this->objSession->get('user')['id']);
        return json_encode($response);
    }

    public function account()
    {
        $data = array();
        # Verify client Session
        if (empty($this->objSession->get('user')['role']) || $this->objSession->get('user')['role'] != 'client')
            return view('logoutClient');
        else {
            $data['user'] = $this->objMainModel->objDataByID('clients', $this->objSession->get('user')['id']);
            $data['buyProducts'] = $this->objMainModel->getBuyProducts($this->objSession->get('user')['id']);
            $data['page'] = 'client/account/mainAccount';
            return view('client/header/index', $data);
        }
    }

    public function basket()
    {
        return view('client/modals/shop');
    }

    public function getDtShop()
    {
        $data = array();
        # Verify client Session
        if (empty($this->objSession->get('user')['role']) || $this->objSession->get('user')['role'] != 'client') {
            $data['user'] = '';
        } else {
            $data = array();
            $data['user'] = $this->objMainModel->objDataByID('clients', $this->objSession->get('user')['id']);
            $data['buyProducts'] = $this->objMainModel->getBuyProducts($this->objSession->get('user')['id']);
           // var_dump($data['buyProducts']);exit();
        }

        return view('client/dataTables/dtShop', $data);
    }
}
