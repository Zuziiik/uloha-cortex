<?php

	namespace App\Model;


	class User
	{
		/**
		 * @var int $id
		 */
		protected $id;
		/**
		 * @var string $jmeno
		 */
		protected $jmeno;
		/**
		 * @var string $email
		 */
		protected $email;
		/**
		 * @var string $telefon
		 */
		protected $telefon;
		/**
		 * @var string $datumRegistrace
		 */
		protected $datumRegistrace;
		/**
		 * @var Adresa $adresa
		 */
		protected $adresa;

		/**
		 * User constructor.
		 *
		 * @param int    $id
		 * @param string $jmeno
		 * @param string $prijmeni
		 * @param string $email
		 * @param string $telefon
		 * @param string $datumRegistrace
		 * @param int    $adresa
		 */
		public function __construct( $idUser, $jmeno, $email, $telefon, $datumRegistrace, $idAdresa, $ulice, $mesto, $stat, $CP, $CO, $PSC )
		{
			$this->id = $idUser;
			$this->jmeno = $jmeno;
			$this->email = $email;
			$this->telefon = $telefon;
			$this->datumRegistrace = $datumRegistrace;
			$this->adresa = new Adresa( $idAdresa, $ulice, $mesto, $stat, $CP, $CO, $PSC );
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
		public function getJmeno()
		{
			return $this->jmeno;
		}

		/**
		 * @param string $jmeno
		 */
		public function setJmeno( $jmeno )
		{
			$this->jmeno = $jmeno;
		}

		/**
		 * @return string
		 */
		public function getEmail()
		{
			return $this->email;
		}

		/**
		 * @param string $email
		 */
		public function setEmail( $email )
		{
			$this->email = $email;
		}

		/**
		 * @return string
		 */
		public function getTelefon()
		{
			return $this->telefon;
		}

		/**
		 * @param string $telefon
		 */
		public function setTelefon( $telefon )
		{
			$this->telefon = $telefon;
		}

		/**
		 * @return string
		 */
		public function getDatumRegistrace()
		{
			return $this->datumRegistrace;
		}

		/**
		 * @param string $datumRegistrace
		 */
		public function setDatumRegistrace( $datumRegistrace )
		{
			$this->datumRegistrace = $datumRegistrace;
		}

		/**
		 * @return Adresa
		 */
		public function getAdresa()
		{
			return $this->adresa;
		}

		/**
		 * @param Adresa $adresa
		 */
		public function setAdresa( $adresa )
		{
			$this->adresa = $adresa;
		}

	}