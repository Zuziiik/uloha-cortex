<?php

	namespace App\Presenters;

	use Nette, Nette\Application\UI\Form, App\Model\UserManager;


	class RegistrationPresenter extends BasePresenter
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

		public function renderDefault()
		{

		}

		protected function createComponentRegistrationForm() 
		{
			$form = new Form();
			$form->getElementPrototype()->class = 'form-horizontal';
			$renderer = $form->getRenderer();
			$renderer->wrappers['controls']['container'] = NULL;
			$renderer->wrappers['pair']['container'] = 'div class="control-group"';
			$renderer->wrappers['label']['container'] = NULL;
			$renderer->wrappers['control']['container'] = 'div class="controls"';
			
			$form->addText(UserManager::COLUMN_NAME, 'Jmeno')->setRequired('Prosím vyplňte jmeno.')
				->setAttribute('class', 'form-control input-small');
			$form->addText(UserManager::COLUMN_SURNAME, 'Prijmeni')->setRequired('Prosím vyplňte prijmeni.')
				->setAttribute('class', 'form-control input-small');
			$form->addText(UserManager::COLUMN_EMAIL, 'email')->setRequired('Prosím vyplňte email.')
				->setAttribute('class', 'form-control input-small');
			$form->addText(UserManager::COLUMN_PHONE, 'telefon')->setRequired('Prosím vyplňte telefon.')
				->setAttribute('class', 'form-control input-small');
			$form->addText(UserManager::COLUMN_STREET, 'ulice')->setRequired('Prosím vyplňte ulici.')
				->setAttribute('class', 'form-control input-small');
			$form->addText(UserManager::COLUMN_CITY, 'mesto')->setRequired('Prosím vyplňte mesto.')
				->setAttribute('class', 'form-control input-small');
			$form->addText(UserManager::COLUMN_CP, 'cislo popisne')->setRequired('Prosím vyplňte cislo popisne.')
				->setAttribute('class', 'form-control input-small');
			$form->addText(UserManager::COLUMN_CO, 'cislo orientacni')
				->setAttribute('class', 'form-control input-small');
			$form->addText(UserManager::COLUMN_PSC, 'PSC')->setRequired('Prosím vyplňte PSC.')
				->setAttribute('class', 'form-control input-small');
			$form->addText(UserManager::COLUMN_STATE, 'stat')->setDefaultValue('Ceska Republika')
				->setAttribute('class', 'form-control input-small');
			$cards = $this->cardsManager->getFreeCards();
			$form->addSelect(UserManager::COLUMN_CARD, 'vernostni karta', $cards)
				->setAttribute('class', 'form-control input-small');
			$form->addSubmit('save', 'Uložit')->setAttribute('class', 'btn btn-primary');
			$form->onSubmit[] = $this->RegistrationFormSucceeded;
			return $form;
		}
		
		public function RegistrationFormSucceeded(Form $form)
		{
			$values = $form->getValues();
			$this->userManager->add($values);
			$this->flashMessage('Zakaznik byl uspesne registrovan','success');
			$this->redirect('Homepage:');
		}
	}