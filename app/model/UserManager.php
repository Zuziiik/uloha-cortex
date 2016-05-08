<?php
	namespace App\Model;

	use Nette;

	class UserManager extends Nette\Object
	{
		const TABLE_NAME = 'zakaznik';
		const COLUMN_ID = 'id';
		const COLUMN_NAME = 'jmeno';
		const COLUMN_SURNAME = 'prijmeni';
		const COLUMN_EMAIL = 'email';
		const COLUMN_PHONE = 'telefon';
		const COLUMN_REGISTRATION = 'daturm_registrace';
		const COLUMN_CARD = 'karta';
		const COLUMN_ADDRESS = 'adresa';

		const TABLE_ADDRESS = 'adresa';
		const COLUMN_STREET = 'ulice';
		const COLUMN_CITY = 'mesto';
		const COLUMN_CP = 'cislo_popisne';
		const COLUMN_CO = 'cislo_orientacni';
		const COLUMN_STATE = 'stat';


		/** @var Nette\Database\Context */
		private $database;

		public function __construct(Nette\Database\Context $database) {
			$this->database = $database;
		}

		public function selectAll() {
			return $this->database->table(self::TABLE_NAME);
		}

		public function add($data) {

			if($data[self::COLUMN_CO] == '')
			{
				$data[self::COLUMN_CO] = NULL;
			}
			$addressData = array(self::COLUMN_STREET => $data[self::COLUMN_STREET],
								 self::COLUMN_CITY => $data[self::COLUMN_CITY],
								 self::COLUMN_CP => $data[self::COLUMN_CP],
								 self::COLUMN_CO => $data[self::COLUMN_CO],
								 self::COLUMN_STATE => $data[self::COLUMN_STATE]
			);

			$row = $this->database->table(self::TABLE_ADDRESS)->insert($addressData);
			$id = $row->id;
			dump($id);
			$userData = array(self::COLUMN_NAME => $data[self::COLUMN_NAME],
							  self::COLUMN_SURNAME => $data[self::COLUMN_SURNAME],
							  self::COLUMN_EMAIL => $data[self::COLUMN_EMAIL],
							  self::COLUMN_PHONE => $data[self::COLUMN_PHONE],
							  self::COLUMN_ADDRESS => $id
			);
			$row = $this->database->table(self::TABLE_NAME)->insert($userData);
			$id = $row->id;
			$this->database->query('UPDATE vernostni_karta SET zakaznik=? WHERE id=?', $id, $data[self::COLUMN_CARD]);
		}
	}