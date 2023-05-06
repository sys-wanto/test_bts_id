<?php
require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

defined('BASEPATH') or exit('No direct script access allowed');

class Login extends REST_Controller
{

  /**
   * Index Page for this controller.
   *
   * Maps to the following URL
   * 		http://example.com/index.php/welcome
   *	- or -
   * 		http://example.com/index.php/welcome/index
   *	- or -
   * Since this controller is set as the default controller in
   * config/routes.php, it's displayed at http://example.com/
   *
   * So any other public methods not prefixed with an underscore will
   * map to /index.php/welcome/<method_name>
   * @see https://codeigniter.com/userguide3/general/urls.html
   */

  public function __construct()
  {
    parent::__construct();
    $this->load->library('Authorization_Token');
    $this->load->model('user_model');
  }
  public function index_post()
  {
    $post = json_decode(file_get_contents('php://input'));
    $response = array(
      'is_error' => true,
      'data' => null,
      'msg' => array()
    );
    if (is_object($post)) {
      $_POST = (array) $post;
      $this->form_validation->set_rules('username', 'Username', 'required|alpha_numeric');
      $this->form_validation->set_rules('password', 'Password', 'required');

      if ($this->form_validation->run() == false) {
        $errors = $this->form_validation->error_array();
        $response['msg'] = $errors;
        $this->response($response, REST_Controller::HTTP_OK);
      } else {
        $username = $_POST['username'];
        $password = $_POST['password'];
        if ($this->user_model->resolve_user_login($username, $password)) {
          $user_id = $this->user_model->get_user_id_from_username($username);
          $user = $this->user_model->get_user($user_id);
          $response['is_error'] = false;

          $token_data = array(
            'uid' => $user_id,
            'username' => $_POST['username']);
          $tokenData = $this->authorization_token->generateToken($token_data);
          $response['data'] = array(
            'access_token' => $tokenData,
            'uid' => $user_id,
          );

          $response['msg'] = ['Berhasil login.'];
          $this->response($response, REST_Controller::HTTP_OK);
        }{
          $response['msg'] = ['Username not found'];
          $this->response($response, REST_Controller::HTTP_BAD_REQUEST);

        }
      }
    } else {
      $response['msg'] = ['Request Error'];
      $this->response($response, REST_Controller::HTTP_BAD_REQUEST);
    }
    // $this->response($msg, REST_Controller::HTTP_OK);
  }
}