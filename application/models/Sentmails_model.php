<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sentmails_model extends CI_Model {

    public function record_mail($to_email, $subject, $body)
    {
        $this->to_email = $to_email;
        $this->subject = $subject;
        $this->body = $body;
        $this->created = date("Y-m-d H:i:s");
        $this->modified = date("Y-m-d H:i:s");

        $this->db->insert('sent_emails', $this);
    }

}