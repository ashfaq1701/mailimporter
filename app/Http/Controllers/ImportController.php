<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Importers\Mailchimp;
use App\Importers\GetResponseImporter as GetResponse;
use AWeberAPI;
use App\Importers\Aweber;

class ImportController extends Controller
{
	public function getImport()
	{
		return view('importer.importer', ['pageName' =>'importer']);
	}
	
	public function postImportMailchimp(Request $request)
	{
		$apiKey = $request->input('mailchimp-api-key');
		$mailchimp = new Mailchimp($apiKey);
		$mailchimp->importMailchimp();
		$alert = [
			'type' => 'success',
			'message' => 'Your contacts were successfully imported from Mailchimp'
		];
		return view('dashboard.dashboard', ['pageName' => 'importer', 'alert' => $alert]);
	}
	
	public function postImportGetResponse(Request $request)
	{
		$apiKey = $request->input('getresponse-api-key');
		$getResponse = new GetResponse($apiKey);
		$getResponse->getContacts();
		$alert = [
			'type' => 'success',
			'message' => 'Your contacts were successfully imported from GetResponse'
		];
		return view('dashboard.dashboard', ['pageName' => 'importer', 'alert' => $alert]);
	}
	
	public function getImportAweber(Request $request)
	{
		$consumerKey = config('constants.aweber_consumer_key');
		$consumerSecret = config('constants.aweber_consumer_secret');
		$aweber = new AWeberAPI($consumerKey, $consumerSecret);
		
		if(empty($request->cookie('aweber-access-token')))
		{
			if (!$request->has('oauth_token')) 
			{
				$callbackUrl = $request->url();
				list($requestToken, $requestTokenSecret) = $aweber->getRequestToken($callbackUrl);
				$aweberAuthorizeUrl = $aweber->getAuthorizeUrl();
				return redirect($aweberAuthorizeUrl)->cookie('requestTokenSecret', $requestTokenSecret, 15)->cookie('callbackUrl', $callbackUrl, 15);
			}
			$aweber->user->tokenSecret = $request->cookie('requestTokenSecret');
			$aweber->user->requestToken = $request->input('oauth_token');
			$aweber->user->verifier = $request->input('oauth_verifier');
			list($accessToken, $accessTokenSecret) = $aweber->getAccessToken();
			$callbackUrl = $request->cookie('callbackUrl');
			return redirect($callbackUrl)->cookie('aweber-access-token', $accessToken, 60*24)->cookie('aweber-access-token-secret', $accessTokenSecret);
		}
		$aweber->adapter->debug = false;
		$account = $aweber->getAccount($request->cookie('aweber-access-token'), $request->cookie('aweber-access-token-secret'));
		$aweberImporter = new Aweber($account);
		$aweberImporter->importContacts();
		$alert = [
			'type' => 'success',
			'message' => 'Your contacts were successfully imported from Aweber'
		];
		return view('dashboard.dashboard', ['pageName' => 'importer', 'alert' => $alert]);
	}
}

?>