<?php declare(strict_types=1);

namespace App\Model;

use MabeEnum\Enum;

/**
 * @method static ENABLED()
 * @method static DISABLED()
 */
class UserState extends Enum {
	const ENABLED = 'enabled';
	const DISABLED = 'disabled';
}
