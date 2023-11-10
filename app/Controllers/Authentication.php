<?php

namespace App\Controllers;

use App\Models\MainModel;
use App\Models\AuthenticationModel;

class Authentication extends BaseController
{
    protected $objRequest;
    protected $objSession;
    protected $objEmail;
    protected $objMainModel;
    protected $objAuthenticationModel;

    public function __construct()
    {
        $this->objRequest = \Config\Services::request();
        $this->objMainModel = new MainModel;
        $this->objAuthenticationModel = new AuthenticationModel;
        $this->objSession = session();

        # DESTROY SESSION
        $sessionArray['userID'] = '';
        $sessionArray['user'] = '';
        $sessionArray['email'] = '';
        $sessionArray['rol'] = '';

        $this->objSession->set('user', $sessionArray);

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

    public function signIn()
    {
        $data['page'] = 'admin/login/signIn';
        return view('admin/header/index', $data);
    } // ok

    public function signInProcess(): string
    {
        $user = htmlspecialchars(trim($this->objRequest->getPost('user')));
        $password = htmlspecialchars(trim($this->objRequest->getPost('password')));

        $result = $this->objAuthenticationModel->login('admin', $user, $password);

        if ($result['error'] == 1)
            return json_encode($result);

        # CREATE SESSION
        $sessionArray = array();
        $sessionArray['userID'] = $result['data']->id;
        $sessionArray['user'] = $result['data']->user;
        $sessionArray['email'] = $result['data']->email;
        $sessionArray['role'] = $result['data']->role;

        $this->objSession->set('user', $sessionArray);

        $response = array();
        $response['error'] = 0;
        $response['role'] = $sessionArray['role'];

        return json_encode($response);
    }

    public function signup(): string
    {
        $data['page'] = 'admin/login/signIn';
        return view('admin/header/index', $data);
    } // ok

    public function signupProcess()
    {
        $userName = htmlspecialchars(trim($this->objRequest->getPost('userName')));
        $email = htmlspecialchars(trim($this->objRequest->getPost('email')));
        $password = password_hash(htmlspecialchars(trim($this->objRequest->getPost('password'))), PASSWORD_DEFAULT);
        $role = $this->objRequest->getPost('role');
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
        $data['pass'] = $password;
        $data['email'] = $email;
        $data['rol'] = $role;
        $data['token'] = $token;

        # Create User
        $resultCreateUser = $this->objMainModel->objCreate('user', $data);

        # Send Activate Status Email
        /* $emailData = array();
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

        return json_encode($resultCreateUser);
    } // ok

    public function confirmSignup(): string
    {
        $token = $this->objRequest->getPostGet();

        if (empty($token)) {
            $data = array();
            $data['title'] = "Error";
            $data['msg'] = "Empty Token";
            return view('errorPage/template', $data);
        }

        $result = $this->objMainModel->objDataByField('clients', 'token', $token);

        if (!empty($result)) {
            $data = array();
            $data['activate_status'] = 1;
            $data['token'] = '';

            # Update User 
            $this->objMainModel->objUpdate('clients', $data, $result[0]->id);

            $data = array();
            $data['title'] = "Success";
            $data['msg'] = "Activated Account";
            return view('errorPage/template', $data);
        } else {
            $data = array();
            $data['title'] = "Error";
            $data['msg'] = "Token Expired";
            return view('errorPage/template', $data);
        }
    } // ok

    public function forgotPassword(): string
    {
        $data = array();
        $data['uniqid'] = uniqid();
        return view('forgotPassword/mainForgotPassword', $data);
    } // ok

    public function forgotPasswordProcess(): string
    {
        $email = htmlspecialchars(trim($this->objRequest->getPost('email')));

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $response = array();
            $response['error'] = 1;
            $response['msg'] = 'INVALID_EMAIL';
            return json_encode($response);
        }

        $result = $this->objMainModel->objDataByField('user', 'email', $email);

        if (empty($result)) {
            $response = array();
            $response['error'] = 1;
            $response['msg'] = 'EMAIL_NOT_FOUND';
            return json_encode($response);
        }

        $data = array();
        $data['token'] = md5(uniqid());

        # Update User
        $this->objMainModel->objUpdate('user', $data, $result[0]->id);

        $emailData = array();
        $emailData['url'] = base_url('Authentication/showFormNewPassword') . '?token=' . $data['token'];

        $this->objEmail->setFrom(EMAIL_SMTP_USER, COMPANY_NAME);
        $this->objEmail->setTo($email);
        $this->objEmail->setSubject(COMPANY_NAME);
        $this->objEmail->setMessage(view('email/recoveryPassword', $emailData), []);

        if ($this->objEmail->send(false)) {
            $response = array();
            $response['error'] = 0;
            $response['msg'] = 'SUCCESS_SEND_EMAIL';
        } else {
            $response = array();
            $response['error'] = 1;
            $response['msg'] = 'ERROR_SEND_EMAIL';
        }

        return json_encode($response);
    } // ok

    public function showFormNewPassword()
    {
        $token = $this->objRequest->getPostGet();

        if (empty($token)) {
            $data = array();
            $data['title'] = "Error";
            $data['msg'] = "Empty Token";
            return view('errorPage/template', $data);
        }

        $result = $this->objMainModel->objDataByField('user', 'token', $token);

        if (!empty($result)) {
            $data = array();
            $data['id'] = $result[0]->id;
            $data['uniqid'] = uniqid();
            return view('recoveryPassword/mainRecoveryPassword', $data);
        } else {
            $data = array();
            $data['title'] = "Error";
            $data['msg'] = "Token Expired";
            return view('errorPage/template', $data);
        }
    } // ok

    public function updatePassword()
    {
        $data = array();
        $data['token'] = '';
        $data['pass'] = password_hash($this->objRequest->getPost('newPassword'), PASSWORD_DEFAULT);
        # Update User
        $result = $this->objMainModel->objUpdate('user', $data, $this->objRequest->getPost('id'));
        return json_encode($result);
    } // ok
}
