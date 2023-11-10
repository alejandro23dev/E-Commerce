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

    public function index(): string
    {
        $data = array();
        $data['page'] = 'client/main';
        $data['categories'] = $this->objMainModel->objData('category');
        $data['products'] = $this->objMainModel->getProducts();
        return view('client/header/index', $data);
    }

    public function showSignUp(): string
    {
        $data['page'] = 'login/signUp';
        return view('client/header/index', $data);
    }

    public function showSignIn(): string
    {
        $data['page'] = 'login/signIn';
        return view('client/header/index', $data);
    }

    public function registerUser(): string
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

    public function showProductsByCategory(): string
    {

        $categoryID = htmlspecialchars(trim($this->objRequest->getPost('id')));

        $data = array();
        $data['categories'] = $this->objMainModel->objData('category');
        $data['categorySelected'] = $categoryID;
        if ($categoryID == 1) {
            $data['products'] = $this->objMainModel->getProducts();
        } else {
            $data['products'] = $this->objMainModel->getProductsByCategory($categoryID);
        }


        return view('client/main', $data);
    }
}
