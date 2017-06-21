<?php 

namespace App\Importers;

use GetResponse;
use App\Models\Subscriber;
use App\Models\SubscriberList;

class GetResponseImporter
{
	private $apiKey;
	private $getResponse;
	
	//379ae2305618af7adb6f952d8524b25b
	public function __construct($apiKey)
	{
		$this->apiKey = $apiKey;
		$this->getResponse = new GetResponse($apiKey);
	}
	
	public function getContacts()
	{
		$page = 1;
		$contactCount = 100;
		while($contactCount == 100)
		{
			$contactCount = 0;
			$contacts = $this->getResponse->getContacts(['page'=>$page, 'perPage'=>100]);
			foreach ($contacts as $contact)
			{
				$listId = $contact->campaign->campaignId;
				$listName = $contact->campaign->name;
				$lists = SubscriberList::where('provider', 'getresponse')->where('provider_id', $listId)->where('name', $listName)->get();
				if($lists->count() > 0)
				{
					$list = $lists->first();
				}
				else
				{
					$list = new SubscriberList();
					$list->provider = 'getresponse';
					$list->provider_id = $listId;
					$list->name = $listName;
					$list->save();
					$list = SubscriberList::where('provider', 'getresponse')->where('provider_id', $listId)->first();
				}
				$subscriberName = $contact->name;
				$subscriberEmail = $contact->email;
				$subscribers = Subscriber::where('name', $subscriberName)->where('email', $subscriberEmail)->where('list_id', $list->id)->get();
				if($subscribers->count() == 0)
				{
					$subscriber = new Subscriber();
					$subscriber->name = $subscriberName;
					$subscriber->email = $subscriberEmail;
					$subscriber->list_id = $list->id;
					$subscriber->save();
				}
				$contactCount++;
			}
			$page++;
		}
	}
}

?>