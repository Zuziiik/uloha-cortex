<?php
	/**
	 * Created by PhpStorm.
	 * User: Zuzana Vilhelmova
	 * Date: 9.5.16
	 * Time: 22:40
	 */

	namespace App\Model;


	class Adresa
	{
		/**
		 * @var int $id
		 */
		protected $id;
		/**
		 * @var string $ulice
		 */
		protected $ulice;
		/**
		 * @var string $mesto
		 */
		protected $mesto;
		/**
		 * @var string $stat
		 */
		protected $stat;
		/**
		 * @var int $CP
		 */
		protected $CP;
		/**
		 * @var int $CO
		 */
		protected $CO;
		/**
		 * @var string $PSC
		 */
		protected $PSC;

		/**
		 * Adresa constructor.
		 *
		 * @param int    $id
		 * @param string $ulice
		 * @param string $mesto
		 * @param string $stat
		 * @param int    $CP
		 * @param int    $CO
		 */
		public function __construct( $id, $ulice, $mesto, $stat, $CP, $CO, $PSC )
		{
			$this->id = $id;
			$this->ulice = $ulice;
			$this->mesto = $mesto;
			$this->stat = $stat;
			$this->CP = $CP;
			$this->CO = $CO;
			$this->PSC = $PSC;
		}

		/**
		 * @return int
		 */
		public function getId()
		{
			return $this->id;
		}

		/**
		 * @param int $id
		 */
		public function setId( $id )
		{
			$this->id = $id;
		}

		/**
		 * @return string
		 */
		public function getUlice()
		{
			return $this->ulice;
		}

		/**
		 * @param string $ulice
		 */
		public function setUlice( $ulice )
		{
			$this->ulice = $ulice;
		}

		/**
		 * @return string
		 */
		public function getMesto()
		{
			return $this->mesto;
		}

		/**
		 * @param string $mesto
		 */
		public function setMesto( $mesto )
		{
			$this->mesto = $mesto;
		}

		/**
		 * @return string
		 */
		public function getStat()
		{
			return $this->stat;
		}

		/**
		 * @param string $stat
		 */
		public function setStat( $stat )
		{
			$this->stat = $stat;
		}

		/**
		 * @return int
		 */
		public function getCP()
		{
			return $this->CP;
		}

		/**
		 * @param int $CP
		 */
		public function setCP( $CP )
		{
			$this->CP = $CP;
		}

		/**
		 * @return int
		 */
		public function getCO()
		{
			return $this->CO;
		}

		/**
		 * @param int $CO
		 */
		public function setCO( $CO )
		{
			$this->CO = $CO;
		}

		/**
		 * @return string
		 */
		public function getPSC()
		{
			return $this->PSC;
		}

		/**
		 * @param string $PSC
		 */
		public function setPSC( $PSC )
		{
			$this->PSC = $PSC;
		}
		
	}