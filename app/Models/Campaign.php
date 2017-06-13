<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Campaign extends Model {
	protected $table = 'campaigns';
	protected $primaryKey = "id";
	
	public function contactList()
	{
		return $this->belongsTo('App\Models\SubscriberList', 'campaign_id', 'id');
	}
}