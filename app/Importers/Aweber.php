<?php 

namespace App\Importers;

class Aweber
{
	private $account;
	
	public function __construct($account)
	{
		$this->account = $account;
	}
	
	public function importContacts()
	{
		return $this->account;
	}
}

?>