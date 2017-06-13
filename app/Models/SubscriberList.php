<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubscriberList extends Model {
	protected $table = 'lists';
	protected $primaryKey = "id";
	
	public function contact()
	{
		return $this->hasOne('App\Models\Contact', 'id', 'contact_id');
	}
	
	public function campaign()
	{
		return $this->hasOne('App\Models\Campaign',  'id', 'campaign_id');
	}
	
	public function subscribers()
	{
		return $this->hasMany('App\Models\Subscriber', 'list_id', 'id');
	}
}