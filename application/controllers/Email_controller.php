<?php 
class Email_controller extends CI_Controller {
 
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        // Load SMTP model
        $this->load->model('Smtp_model');
        $this->load->model('Sentmails_model');
    }
		
    public function index()
    {
        $this->load->view('email_view');
    }

    public function send_mail()
    {
        $data['email'] = $this->input->post('email');
        $data['subject'] = $this->input->post('subject');
        $data['message'] = $this->input->post('message');

        // Load email library
        $this->load->library('email');

        // Load SMTP general settings
        $stmp_settings = $this->Smtp_model->getGeneralSettings();

        foreach($stmp_settings as $smtp) {
            $name = $smtp['name'];
            $$name = $smtp['value'];
        }

        $config = Array(
            'protocol' => 'smtp',
            'smtp_host' => $smtp_host,
            'smtp_port' => $smtp_port,
            'smtp_crypto'  => $smtp_tls,
            'smtp_timeout' => 60,
            'smtp_user' => $smtp_username,
            'smtp_pass' => $smtp_password,
            'mailtype'  => 'html', 
            'charset'   => 'iso-8859-1'
        );
    
        $this->email->initialize($config);
        $this->email->set_mailtype("html");
        $this->email->set_newline("\r\n");

        $this->email->from('trackstreettester@gmail.com', 'TrackStreet tester');
        $this->email->to($data['email']);
        $this->email->subject($data['subject']);
        $this->email->message($data['message']);
            
        $arr = array('msg' => 'Something went wrong try again lator', 'success' =>false);

        if($this->email->send()){
            $arr = array('msg' => 'Mail has been sent successfully', 'success' =>true);

            //record mail
            $this->Sentmails_model->record_mail($data['email'], $data['subject'], $data['message']);

        } else {
            echo $this->email->print_debugger();
        }
        echo json_encode($arr);
    
    }
} 
?>