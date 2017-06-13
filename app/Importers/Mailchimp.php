<?php 

namespace App\Importers;

use GuzzleHttp\Client as GuzzleClient;
use App\Models\SubscriberList;
use App\Models\Contact;
use App\Models\Campaign;
use App\Models\Subscriber;

class Mailchimp
{
	private $apiKey;
	private $datacenter;
	private $client;
	private $fetchedLists;
	
	//5edef5d505e896ee2555e3d974931661-us16
	public function __construct($apiKey)
	{
		$this->apiKey = $apiKey;
		$explodedApiKey = explode('-', $apiKey);
		$this->datacenter = $explodedApiKey[count($explodedApiKey) - 1];
		$this->client = new GuzzleClient();
		$this->fetchedLists = [];
	}
	
	public function importMailchimp()
	{
		$this->getSubscriberLists();
		$this->getSubscribers();
	}
	
	public function getSubscriberLists()
	{
		$url = 'http://'.$this->datacenter.'.api.mailchimp.com/3.0/lists?count=50';
		$countData = 0;
		$response = $this->client->get($url, [
			'auth' => [
				'demo',
				$this->apiKey
			]
		]);
		
		$jsonContent = (string) $response->getBody();
		$listsObj = json_decode($jsonContent, true);
		$listItems = $listsObj['lists'];
		$this->parseListsArray($listItems);
		$countData += count($listItems);
		$totalItems = $listsObj['total_items'];
		while($totalItems > $countData)
		{
			$url = 'http://'.$this->datacenter.'.api.mailchimp.com/3.0/lists?offset='.$countData.'&count=50';
			$response = $this->client->get($url, [
					'auth' => [
							'demo',
							$this->apiKey
					]
			]);
			$jsonContent = (string) $response->getBody();
			$listsObj = json_decode($jsonContent, true);
			$listItems = $listsObj['lists'];
			$this->parseListsArray($listItems);
			$countData += count($listItems);
		}
	}
	
	public function parseListsArray($listItems)
	{
		foreach ($listItems as $listItem)
		{
			$mailchimpId = $listItem['id'];
			$subscriberLists = SubscriberList::where('provider', 'mailchimp')->where('provider_id', $mailchimpId)->get();
			if($subscriberLists->count() == 0)
			{
				$contact = new Contact();
				if(!empty($listItem['contact']))
				{
					$contact->company = $listItem['contact']['company'];
					$contact->address1 = $listItem['contact']['address1'];
					$contact->address2 = $listItem['contact']['address2'];
					$contact->city = $listItem['contact']['city'];
					$contact->state = $listItem['contact']['state'];
					$contact->zip = $listItem['contact']['zip'];
					$contact->country = $listItem['contact']['country'];
					$contact->phone = $listItem['contact']['phone'];
				}
				$contact->save();
				
				$campaign = new Campaign();
				if(!empty($listItem['campaign_defaults']))
				{
					$campaign->from_name = $listItem['campaign_defaults']['from_name'];
					$campaign->from_email = $listItem['campaign_defaults']['from_email'];
					$campaign->subject = $listItem['campaign_defaults']['subject'];
					$campaign->language = $listItem['campaign_defaults']['language'];
				}
				$campaign->save();
				
				$subscriberList = new SubscriberList();
				$subscriberList->provider = 'mailchimp';
				$subscriberList->provider_id = $mailchimpId;
				$subscriberList->name = $listItem['name'];
				$subscriberList->permission_reminder = $listItem['permission_reminder'];
				$subscriberList->contact_id = $contact->id;
				$subscriberList->campaign_id = $campaign->id;
				$subscriberList->save();
				$this->fetchedLists[$subscriberList->provider_id] = $subscriberList->id;
			}
		}
	}
	
	public function getSubscribers()
	{
		foreach ($this->fetchedLists as $listId => $dbId)
		{
			$this->getSubscribersForList($listId, $dbId);
		}
	}
	
	public function getSubscribersForList($listId, $dbId)
	{
		$url = 'http://'.$this->datacenter.'.api.mailchimp.com/3.0/lists/'.$listId.'/members?count=50';
		$countData = 0;
		$response = $this->client->get($url, [
				'auth' => [
						'demo',
						$this->apiKey
				]
		]);
		
		$jsonContent = (string) $response->getBody();
		$subscribersObj = json_decode($jsonContent, true);
		$subscriberItems = $subscribersObj['members'];
		$this->parseSubscribersArray($subscriberItems, $dbId);
		$countData += count($subscriberItems);
		$totalItems = $subscribersObj['total_items'];
		while($totalItems > $countData)
		{
			$url = 'http://'.$this->datacenter.'.api.mailchimp.com/3.0/lists/'.$listId.'/members?offset='.$countData.'&count=50';
			$response = $this->client->get($url, [
					'auth' => [
							'demo',
							$this->apiKey
					]
			]);
			$jsonContent = (string) $response->getBody();
			$subscribersObj = json_decode($jsonContent, true);
			$subscriberItems = $subscribersObj['members'];
			$this->parseSubscribersArray($subscriberItems, $dbId);
			$countData += count($subscriberItems);
		}
	}
	
	public function parseSubscribersArray($subscriberItems, $listId)
	{
		foreach ($subscriberItems as $subscriberItem)
		{
			$email = $subscriberItem['email_address'];
			$status = $subscriberItem['status'];
			$firstName = $subscriberItem['merge_fields']['FNAME'];
			$lastName = $subscriberItem['merge_fields']['LNAME'];
			$subscribers = Subscriber::where('email', $email)
									->where('status', $status)
									->where('first_name', $firstName)
									->where('last_name', $lastName)
									->where('list_id', $listId)
									->get();
			if($subscribers->count() == 0)
			{
				$subscriber = new Subscriber();
				$subscriber->email = $email;
				$subscriber->status = $status;
				$subscriber->first_name = $firstName;
				$subscriber->last_name = $lastName;
				$subscriber->list_id = $listId;
				$subscriber->save();
			}
		}
	}
}

?>