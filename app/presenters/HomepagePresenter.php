<?php

namespace App\Presenters;

use Nette;


final class HomepagePresenter extends Nette\Application\UI\Presenter
{
	/** @var \App\Model\Orm\UsersRepository @inject */
	public $usersRepository;

	public function renderDefault() {
		$users = $this->usersRepository->findAll();
		var_dump($users);
	}
}
