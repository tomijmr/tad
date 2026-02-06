<?php
class SimpleMail {
    private $host;
    private $port;
    private $user;
    private $pass;
    private $conn;

    public function __construct($host, $port, $user, $pass) {
        $this->host = $host;
        $this->port = $port;
        $this->user = $user;
        $this->pass = $pass;
    }

    public function send($from, $fromName, $to, $subject, $body) {
        $scheme = "";
        if ($this->port == 465) $scheme = "ssl://";
        if ($this->port == 587) $scheme = "tls://"; // tls uses tcp then starttls, but fsockopen usually needs ssl:// for direct ssl. 
        // For 587 often it is TCP then STARTTLS. 
        // Lets assume 465 SSL for safety if available, or just tcp for 25/587 and hope no STARTTLS is strictly required immediately (though it usually is).
        // A simple fsockopen wrapper works best with 465 ssl:// 
        
        $connectHost = ($this->port == 465 ? "ssl://" : "") . $this->host;

        $this->conn = fsockopen($connectHost, $this->port, $errno, $errstr, 30);
        if (!$this->conn) {
            error_log("SMTP Connect Error: $errstr ($errno)");
            return false;
        }

        $this->getResponse();
        $this->cmd("EHLO " . $_SERVER['HTTP_HOST']); // use localhost or domain
        
        // STARTTLS for 587 if needed
        if ($this->port == 587) {
            $this->cmd("STARTTLS");
            stream_socket_enable_crypto($this->conn, true, STREAM_CRYPTO_METHOD_TLS_CLIENT);
            $this->cmd("EHLO " . $_SERVER['HTTP_HOST']);
        }

        // AUTH LOGIN
        $this->cmd("AUTH LOGIN");
        $this->cmd(base64_encode($this->user));
        $this->cmd(base64_encode($this->pass));

        $this->cmd("MAIL FROM: <$from>");
        $this->cmd("RCPT TO: <$to>");
        $this->cmd("DATA");

        // Headers
        $headers  = "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
        $headers .= "Date: " . date('r') . "\r\n";
        $headers .= "From: $fromName <$from>\r\n";
        $headers .= "To: <$to>\r\n";
        $headers .= "Subject: $subject\r\n";
        $headers .= "X-Mailer: PHP SimpleMail\r\n";
        $headers .= "\r\n";

        fputs($this->conn, $headers . $body . "\r\n.\r\n");
        $this->getResponse();

        $this->cmd("QUIT");
        fclose($this->conn);
        return true;
    }

    private function cmd($cmd) {
        fputs($this->conn, $cmd . "\r\n");
        return $this->getResponse();
    }

    private function getResponse() {
        $response = "";
        while ($str = fgets($this->conn, 515)) {
            $response .= $str;
            if (substr($str, 3, 1) == " ") break;
        }
        return $response;
    }
}
?>