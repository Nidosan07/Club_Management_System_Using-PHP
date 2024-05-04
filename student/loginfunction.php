<?php
require_once 'config.php';

class loginfunction extends DBConnection {
    private $settings;

    public function __construct() {
        global $_settings;
        $this->settings = $_settings;
        parent::__construct();
        ini_set('display_errors', 1);
    }

    public function __destruct() {
        parent::__destruct();
    }

    public function index() {
        echo "<h1>Access Denied</h1> <a href='" . base_url . "'>Go Back.</a>";
    }

    public function slogin() {
        extract($_POST);
        $stmt = $this->conn->prepare("SELECT * FROM users WHERE username = ? AND `type` = 3 ");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $data = $result->fetch_array();
            if (password_verify($password, $data['password'])) {
                foreach ($data as $k => $v) {
                    if (!is_numeric($k) && $k != 'password') {
                        $this->settings->set_userdata($k, $v);
                    }
                }
                // Set the club_id session variable
                $this->settings->set_userdata('club_id', $data['club_id']);
                $this->settings->set_userdata('login_type', 1);
                $resp['status'] = 'success';
            } else {
                $resp['status'] = 'failed';
                $resp['msg'] = 'Incorrect Username or Password';
            }
        } else {
            $resp['status'] = 'failed';
            $resp['msg'] = 'Incorrect Username or Password';
        }
        return json_encode($resp);
    }

    public function slogout() {
        if ($this->settings->sess_des()) {
            redirect('student/login.php');
        }
    }
}

$action = !isset($_GET['f']) ? 'none' : strtolower($_GET['f']);
$auth = new loginfunction();
switch ($action) {
    case 'slogin_user':
        echo $auth->slogin();
        break;
    case 'slogout':
        echo $auth->slogout();
        break;
    default:
        echo $auth->index();
        break;
}
?>
