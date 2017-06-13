<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subscriber;
use App\Models\SubscriberList;

class SubscriberController extends Controller
{
	public function index()
	{
		$subscribers = Subscriber::all();
		return view('subscribers.index', [
			'pageName' =>'subscribers',
			'subscribers' => $subscribers
		]);
	}
	
	public function create()
	{
		$lists = SubscriberList::all();
		return view('subscribers.form', [
			'lists' => $lists,
			'pageName' => 'subscribers'
		]);
	
	}
	
	public function store(Request $request)
	{
		$email = $request->input('email');
		$status = $request->input('status');
		$firstName = $request->input('first_name');
		$lastName = $request->input('last_name');
		$listId = $request->input('list');
		
		$subscriber = new Subscriber();
		$subscriber->email = $email;
		$subscriber->first_name = $firstName;
		$subscriber->last_name = $lastName;
		if(!empty($listId))
		{
			$subscriber->list_id = $listId;
		}
		$subscriber->save();
		return redirect('subscribers');
	}
	
	public function get($id)
	{
		$lists = SubscriberList::all();
		$subscriber = Subscriber::find($id);
		return view('subscribers.form', [
			'lists' => $lists,
			'pageName' => 'subscribers',
			'subscriber' => $subscriber
		]);
	}
	
	public function update($id, Request $request)
	{
		$email = $request->input('email');
		$status = $request->input('status');
		$firstName = $request->input('first_name');
		$lastName = $request->input('last_name');
		$listId = $request->input('list');
		
		$subscriber = Subscriber::find($id);
		$subscriber->email = $email;
		$subscriber->first_name = $firstName;
		$subscriber->last_name = $lastName;
		if(!empty($listId))
		{
			$subscriber->list_id = $listId;
		}
		$subscriber->save();
		return redirect('subscribers');
	}
	
	public function delete($id)
	{
		$subscriber = Subscriber::find($id);
		$subscriber->delete();
		return redirect('subscribers');
	}
}

?>