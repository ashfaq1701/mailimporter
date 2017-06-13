<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model {
	protected $table = 'contacts';
	protected $primaryKey = "id";
	
	public function contactList()
	{
		return $this->belongsTo('App\Models\SubscriberList', 'contact_id', 'id');
	}
}