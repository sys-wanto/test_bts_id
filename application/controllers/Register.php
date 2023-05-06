<?php
require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

defined('BASEPATH') or exit('No direct script access allowed');

class Register extends REST_Controller
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
    $post = json_decode(file_get_contents('php://input', true));
    $response = array(
      'is_error' => true,
      'data' => null,
      'msg' => array()
    );
    if (is_object($post)) {
      $_POST = (array) $post;
      $this->form_validation->set_rules('username', 'Username', 'trim|required|alpha_numeric|min_length[4]|is_unique[users.username]', array('is_unique' => 'Username telah digunakan. Pilih username lain.'));
      $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[users.email]', array('is_unique' => 'Email sudah terdaftar.'));
      $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[6]');
      if ($this->form_validation->run() === false) {
        $errors = $this->form_validation->error_array();
        $response['msg'] = $errors;
        $this->response($response, REST_Controller::HTTP_OK);
      } else {
        if ($res = $this->user_model->create_user($_POST['username'], $_POST['email'], $_POST['password'])) {
          $response['is_error'] = false;

          $token_data = array(
            'uid' => $res,
            'username' => $_POST['username']);
          $tokenData = $this->authorization_token->generateToken($token_data);
          $response['data'] = array(
            'access_token' => $tokenData,
            'uid' => $res,
          );

          $response['msg'] = ['user berhasil di daftarkan.'];
          $this->response($response, REST_Controller::HTTP_OK);
        }
      }
    } else {
      $response['msg'] = ['Request Error'];
      $this->response($response, REST_Controller::HTTP_BAD_REQUEST);
    }
  }
}