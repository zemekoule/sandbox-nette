<?php declare(strict_types = 1);

namespace App\Model\Orm;

use Nextras\Orm\Repository\Repository;

class UsersRepository extends Repository
{

	public static function getEntityClassNames(): array {
		return [
			User::class,
		];
	}
}
