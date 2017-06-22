<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SubscriberList;
use App\Models\Contact;
use App\Models\Campaign;

class SubscriberListController extends Controller
{
	public function index()
	{
		$subscriberLists = SubscriberList::all();
		return view('subscriberLists.index', [
			'pageName' =>'lists',
			'subscriberLists' => $subscriberLists	
		]);
	}
	
	public function create()
	{
		return view('subscriberLists.form', [
			'pageName' => 'lists',
		]);
	}
	
	public function store(Request $request)
	{
		$name = $request->input('name');
		$permissionReminder = $request->input('permission_reminder');
		$company = $request->input('company');
		$address1 = $request->input('address1');
		$address2 = $request->input('address2');
		$city = $request->input('city');
		$state = $request->input('state');
		$zip = $request->input('zip');
		$country = $request->input('country');
		$phone = $request->input('phone');
		$fromName = $request->input('from_name');
		$fromEmail = $request->input('from_email');
		$subject = $request->input('subject');
		$language = $request->input('language');
		
		if(!empty($company) || !empty($address1) || !empty($address2) || !empty($city) || !empty($zip) || !empty($country) || !empty($phone))
		{
			$contact = new Contact();
			$contact->company = $company;
			$contact->address1 = $address1;
			$contact->address2 = $address2;
			$contact->city = $city;
			$contact->zip = $zip;
			$contact->country = $country;
			$contact->phone = $phone;
			$contact->save();
		}
		
		if(!empty($fromName) || !empty($fromEmail) || !empty($subject) || !empty($language))
		{
			$campaign = new Campaign();
			$campaign->from_name = $fromName;
			$campaign->from_email = $fromEmail;
			$campaign->subject = $subject;
			$campaign->language = $language;
			$campaign->save();
		}
		
		$subscriberList = new SubscriberList();
		$subscriberList->name = $name;
		$subscriberList->permission_reminder = $permissionReminder;
		if(!empty($contact))
		{
			$subscriberList->contact_id = $contact->id;
		}
		if(!empty($campaign))
		{
			$subscriberList->campaign_id = $campaign->id;
		}
		$subscriberList->save();
		
		return redirect('lists');
	}
	
	public function get($id)
	{
		$subscriberList = SubscriberList::find($id);
		return view('subscriberLists.form', [
			'pageName' => 'lists',
			'subscriberList' => $subscriberList
			
		]);
	}
	
	public function update($id, Request $request)
	{
		$name = $request->input('name');
		$permissionReminder = $request->input('permission_reminder');
		$company = $request->input('company');
		$address1 = $request->input('address1');
		$address2 = $request->input('address2');
		$city = $request->input('city');
		$state = $request->input('state');
		$zip = $request->input('zip');
		$country = $request->input('country');
		$phone = $request->input('phone');
		$fromName = $request->input('from_name');
		$fromEmail = $request->input('from_email');
		$subject = $request->input('subject');
		$language = $request->input('language');
		
		$subscriberList = SubscriberList::find($id);
		$subscriberList->name = $name;
		$subscriberList->permission_reminder = $permissionReminder;
		$subscriberList->save();
		
		if(!empty($company) || !empty($address1) || !empty($address2) || !empty($city) || !empty($zip) || !empty($country) || !empty($phone))
		{
			$contact = $subscriberList->contact;
			$contact->company = $company;
			$contact->address1 = $address1;
			$contact->address2 = $address2;
			$contact->city = $city;
			$contact->state = $state;
			$contact->zip = $zip;
			$contact->country = $country;
			$contact->phone = $phone;
			$contact->save();
		}
		
		if(!empty($fromName) || !empty($fromEmail) || !empty($subject) || !empty($language))
		{
			$campaign = $subscriberList->campaign;
			$campaign->from_name = $fromName;
			$campaign->from_email = $fromEmail;
			$campaign->subject = $subject;
			$campaign->language = $language;
			$campaign->save();
		}
		
		return redirect('lists');
	}
	
	public function delete($id)
	{
		$subscriberList = SubscriberList::find($id);
		$subscriberList->delete();
		return redirect('lists');	
	}
	
	public function subscribers($id)
	{
		$subscriberList = SubscriberList::find($id);
		$subscribers = $subscriberList->subscribers;
		return view('subscribers.index', [
			'pageName' =>'subscribers',
			'subscribers' => $subscribers
		]);
	}
}

?>