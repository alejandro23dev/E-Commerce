<?php

namespace App\Controllers;

use App\Models\MainModel;

class Client extends BaseController
{
    protected $objRequest;
    protected $objSession;
    protected $objEmail;
    protected $objMainModel;

    public function __construct()
    {
        $this->objRequest = \Config\Services::request();
        $this->objSession = session();
        $this->objMainModel = new MainModel;

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
        $data['page'] = 'client/main';
        $data['categories'] = $this->objMainModel->objData('category');
        $data['products'] = $this->objMainModel->getProducts();
        # Verify client Session
        if (empty($this->objSession->get('user'))) {
            $data['notLogin'] = 'yes';
        } else {
            $data['user'] = $this->objMainModel->objDataByID('clients', $this->objSession->get('user')['userID']);
        }
        return view('client/header/index', $data);
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

    public function registerUser()
    {
        $userName = htmlspecialchars(trim($this->objRequest->getPost('userName')));
        $email = htmlspecialchars(trim($this->objRequest->getPost('email')));
        $password = password_hash(htmlspecialchars(trim($this->objRequest->getPost('password'))), PASSWORD_DEFAULT);
        $token = md5(uniqid());

        # Check Duplicate User
        $checkUserName = $this->objMainModel->objCheckDuplicate('clients', 'user', $userName, '');
        if (!empty($checkUserName)) {
            $response['error'] = 1;
            $response['msg'] = "DUPLICATE_USER_NAME";
            return json_encode($response);
        }

        # Check Duplicate Email
        $checkEmail = $this->objMainModel->objCheckDuplicate('clients', 'email', $email, '');
        if (!empty($checkEmail)) {
            $response['error'] = 1;
            $response['msg'] = "DUPLICATE_EMAIL";
            return json_encode($response);
        }

        $data = array();
        $data['user'] = $userName;
        $data['password'] = $password;
        $data['email'] = $email;
        $data['token'] = $token;

        # Create User
        $response = $this->objMainModel->objCreate('clients', $data);

        # Sen Activate Status Email
        /*$emailData = array();
        $emailData['title'] = COMPANY_NAME;
        $emailData['url'] = base_url('Authentication/confirmSignup') . '?token=' . $token;

        $this->objEmail->setFrom(EMAIL_SMTP_USER, COMPANY_NAME);
        $this->objEmail->setTo($email);
        $this->objEmail->setSubject(COMPANY_NAME);
        $this->objEmail->setMessage(view('email/mailSignup', $emailData), []);

        if ($this->objEmail->send(false)) {
            $response['error'] = 0;
            $response['msg'] = 'SUCCESS_SEND_EMAIL';
        } else {
            $response['error'] = 1;
            $response['msg'] = 'ERROR_SEND_EMAIL';
        }*/

        return json_encode($response);
    } // ok

    public function showProductsByCategory()
    {

        $categoryID = htmlspecialchars(trim($this->objRequest->getPost('id')));

        $data = array();
        # Verify client Session
        if (empty($this->objSession->get('user'))) {
            $data['notLogin'] = 'yes';
        }
        $data['categories'] = $this->objMainModel->objData('category');
        $data['categorySelected'] = $categoryID;
        if ($categoryID == 1 || empty($categoryID)) {
            $data['products'] = $this->objMainModel->getProducts();
        } else {
            $data['products'] = $this->objMainModel->getProductsByCategory($categoryID);
        }


        return view('products/main', $data);
    }

    public function showModalSignIn()
    {
        return view('client/modals/login');
    }
}
