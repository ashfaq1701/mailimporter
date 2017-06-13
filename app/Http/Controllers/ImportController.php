<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Importers\Mailchimp;

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
}

?>