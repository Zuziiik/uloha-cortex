<?php
	namespace App\Presenters;

	use Nette;

	class HomepagePresenter extends BasePresenter
	{
		/**
		 * @var \App\Model\CardsManager
		 * @inject
		 */
		public $cardsManager;

		/**
		 * @var \App\Model\UserManager
		 * @inject
		 */
		public $userManager;

		public function beforeRender()
		{
			$users = $this->userManager->getTop10();
			$this->template->users = $users;
			$this->template->cardsCount = $this->cardsManager->countNonFreeCards();
			$this->template->usersCount = $this->userManager->getCountUsers();
			
		}
		
	}