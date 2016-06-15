<?php
namespace Greenhex;
use PHPMailer;

class Mailer
{
	protected $config;
	protected $mailer;

	public function __construct($config = [])
	{
		$this->config = $config;

		$this->mailer = new PHPMailer;
		$this->mailer->Host = $this->config['host'];
		$this->mailer->Port = $this->config['port'];
		$this->mailer->Username = $this->config['username'];
		$this->mailer->Password = $this->config['password'];
		$this->mailer->isSMTP();
		$this->mailer->SMTPAuth = true;
		$this->mailer->SMTPSecure = 'tls';
		$this->mailer->From = $this->config['sender'];
		$this->mailer->isHTML(true);
		//$this->mailer->SMTPDebug = 2;
		//$this->mailer->Debugoutput = 'html';
	}

	public function send($receiver, $subject, $message, $callback = null)
	{
		$this->mailer->setFrom($this->config['sender'], $this->config['sender-name'] == null ? null : $this->config['sender-name']);
		$this->mailer->addAddress($receiver);
		$this->mailer->Subject = $subject;
		$this->mailer->Body = $message;
		
		if ($this->mailer->send())
		{
			echo "Message has been sent";
		}
		else
		{
			echo "Message could not be sent.";
			echo "Mailer Error: {$this->mailer->ErrorInfo}";
		}

		$this->mailer->clearAddresses();
	}
}
