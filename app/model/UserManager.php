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
		const COLUMN_PSC = 'PSC';


		/** @var Nette\Database\Context */
		private $database;

		public function __construct(Nette\Database\Context $database) {
			$this->database = $database;
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
								 self::COLUMN_PSC => $data[self::COLUMN_PSC],
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
		
		public function getCountUsers()
		{
			$res = $this->database->query('SELECT COUNT(id) AS pocet FROM zakaznik')->fetch();
			return $res->pocet;
		}

		public function getTop10()
		{
			$rows = $this->database->query('SELECT COUNT(n.id) AS pocet, z.id AS userId, CONCAT(z.jmeno, \' \', z.prijmeni) AS jmeno, z.email AS email, z.telefon AS telefon, 
											z.datum_registrace AS datum_registrace, a.id AS adressId, a.ulice AS ulice, a.mesto AS mesto, 
											a.cislo_popisne AS CP, a.cislo_orientacni AS CO, a.stat AS stat, a.PSC AS PSC
											FROM zakaznik z
											LEFT JOIN adresa a ON a.id=z.adresa
											LEFT JOIN vernostni_karta k ON z.id=k.zakaznik
											LEFT JOIN nakup n ON n.vernostni_karta=k.id
											WHERE n.datum > DATE_SUB(now(), INTERVAL 30 DAY)
											GROUP BY k.id
											ORDER BY pocet LIMIT 10')->fetchAll();
			$users = array();
			foreach($rows as $row) {
				$user = new User($row->userId, $row->jmeno, $row->email, $row->telefon, $row->datum_registrace,
					$row->adressId, $row->ulice, $row->mesto, $row->stat, $row->CP, $row->CO, $row->PSC);
				array_push($users, $user);
			}
			return $users;
		}
		
		public function findUsers($data)
		{
			$select = "SELECT z.id AS userId, CONCAT(z.jmeno, ' ', z.prijmeni) AS jmeno, z.email AS email, z.telefon AS telefon, 
											z.datum_registrace AS datum_registrace, a.id AS adressId, a.ulice AS ulice, a.mesto AS mesto, 
											a.cislo_popisne AS CP, a.cislo_orientacni AS CO, a.stat AS stat, a.PSC AS PSC, k.cislo_karty AS cislo_karty
											FROM zakaznik z
											LEFT JOIN adresa a ON a.id=z.adresa
											LEFT JOIN vernostni_karta k ON z.id=k.zakaznik";
			dump($data);
			if($data->jmeno !== '')
			{
				$select = $select." WHERE jmeno LIKE '%".$data->jmeno."%'";
			}
			if($data->prijmeni !== '')
			{
				$select = $select." WHERE prijmeni LIKE '%".$data->prijmeni."%'";
			}
			if($data->karta !== '')
			{
				$select = $select." WHERE cislo_karty =".$data->karta;
			}
			return $this->database->query($select)->fetchAll();
		}
	}