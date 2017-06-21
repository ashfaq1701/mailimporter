<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Importers\Mailchimp;
use App\Importers\GetResponseImporter as GetResponse;

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
}

?>