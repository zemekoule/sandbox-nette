<?php

namespace App\Presenters;

use App\Model\Email;
use Nette;


final class HomepagePresenter extends Nette\Application\UI\Presenter
{
	/** @var \App\Model\Orm\UsersRepository @inject */
	public $usersRepository;

	public function renderDefault() {
		$users = $this->usersRepository->findAll()->fetchPairs('id', 'email');
		dump($users);
		$user = $this->usersRepository->getById(1);
		$user->setEmail(new Email('ja@robot.cz'));
		$this->usersRepository->persistAndFlush($user);
	}
}
