<?php 

namespace App\Importers;

use App\Models\Subscriber;
use App\Models\SubscriberList;

class Aweber
{
	private $account;
	
	public function __construct($account)
	{
		$this->account = $account;
	}
	
	public function importContacts()
	{
		$apiLists = $this->account->lists;
		foreach($apiLists as $apiList)
		{
			$listId = $apiList->id;
			$listName = $apiList->name;
			$lists = SubscriberList::where('provider', 'aweber')->where('provider_id', $listId)->where('name', $listName)->get();
			if($lists->count() > 0)
			{
				$list = $lists->first();
			}
			else
			{
				$list = new SubscriberList();
				$list->provider = 'aweber';
				$list->provider_id = $listId;
				$list->name = $listName;
				$list->save();
				$list = SubscriberList::where('provider', 'aweber')->where('provider_id', $listId)->first();
			}
			$apiSubscribers = $apiList->subscribers;
			foreach ($apiSubscribers as $apiSubscriber)
			{
				$subscriberName = $apiSubscriber->name;
				$subscriberEmail = $apiSubscriber->email;
				$subscribers = Subscriber::where('name', $subscriberName)->where('email', $subscriberEmail)->where('list_id', $list->id)->get();
				if($subscribers->count() == 0)
				{
					$subscriber = new Subscriber();
					$subscriber->name = $subscriberName;
					$subscriber->email = $subscriberEmail;
					$subscriber->list_id = $list->id;
					$subscriber->save();
				}
			}
		}
	}
}

?>