<?php

	namespace App\Presenters;
	
	use Nette, Nette\Application\UI\Form, App\Model\UserManager, Nette\Forms\Controls\SubmitButton;

	class UsersPresenter extends BasePresenter
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
			
		}

		public function createComponentFindUser()
		{
			$form = new Form;
			$form->getElementPrototype()->class = 'form-horizontal';
			$renderer = $form->getRenderer();
			$renderer->wrappers['controls']['container'] = NULL;
			$renderer->wrappers['pair']['container'] = 'div class="control-group"';
			$renderer->wrappers['label']['container'] = NULL;
			$renderer->wrappers['control']['container'] = 'div class="controls"';

			$form->addText(UserManager::COLUMN_NAME, 'Jmeno')
				->setAttribute('class', 'form-control');
			$form->addText(UserManager::COLUMN_SURNAME, 'Prijmeni')
				->setAttribute('class', 'form-control');
			$form->addText(UserManager::COLUMN_CARD, 'Cislo karty')
				->setAttribute('class', 'form-control');
			$form->addSubmit('submit', 'Hledej')
				->setAttribute('class', 'btn btn-primary SelectDay');
			return $form;
		}

		public function getUsers(SubmitButton $button)
		{
			$form = $button->getForm();
			$users = $this->userManager->findUsers($form->getValues());
			dump($users);
		}

	}