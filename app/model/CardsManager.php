<?php
	namespace App\Model;

	use Nette;

	class CardsManager extends Nette\Object
	{
		const TABLE_NAME = 'vernostni_karta';
		const COLUMN_ID = 'id';
		const COLUMN_NUMBER = 'cislo_karty';
		const COLUMN_TYPE = 'typ_karty';
		const COLUMN_USER = 'zakaznik';

		const TABLE_CARD_TYPE = 'typ_karty';
		const COLUMN_NAME = 'jmeno';

		/** @var Nette\Database\Context */
		private $database;

		public function __construct(Nette\Database\Context $database) {
			$this->database = $database;
		}

		public function selectAll() {
			return $this->database->table(self::TABLE_NAME);
		}

		public function getFreeCards() {
			$data = $this->database->query('SELECT k.id, concat(t.jmeno, \' - \', k.cislo_karty) AS card 
											FROM vernostni_karta k 
											LEFT JOIN typ_karty t ON t.id=k.typ_karty 
											WHERE zakaznik IS NULL')->fetchPairs(self::COLUMN_ID, 'card');

			return $data;
		}
	}