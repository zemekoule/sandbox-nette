<?php declare(strict_types = 1);

namespace App\Model\Orm;

use App\Model\Email;
use App\Model\EmailProperty;
use App\Model\EnumProperty;
use App\Model\UserState;
use Nextras\Orm\Entity\Entity;

/**
 * Class User
 * @property-read int $id                	{primary}
 * @property-read Email $email           	{container EmailProperty}
 * @property-read string $name
 * @property-read UserState $state 			{container EnumProperty}
 */
class User extends Entity {

	public function __construct(Email $email, string $name, UserState $state) {
		parent::__construct();

		$this->setReadOnlyValue('email', $email);
		$this->setReadOnlyValue('name', $name);
		$this->setReadOnlyValue('state', $state);
	}
}
