<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subscriber extends Model {
	protected $table = 'subscribers';
	protected $primaryKey = "id";
	
	public function subscriberList()
	{
		return $this->belongsTo('App\Models\SubscriberList', 'list_id', 'id');
	}
}