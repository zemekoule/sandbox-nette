<?php declare(strict_types = 1);

namespace App\Model;

use Nette\Utils\Validators;


class Email
{

	/** @var string */
	private $email;


	/**
	 * Email constructor.
	 * @param string $email
	 * @throws \Nette\Utils\AssertionException
	 */
	public function __construct(string $email)
	{
		Validators::assert($email, 'email');
		$this->email = $email;
	}


	/**
	 * @return string
	 */
	public function getEmail(): string
	{
		return $this->email;
	}

}
