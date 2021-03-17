<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Sheets;
use App\Models\User;

class UserController extends Controller
{

	/**
     * Import Users From Sheet.
     *
     * @return void
     */
	public function index(Request $request)
	{
	
		return view('import_users');
	}

	/**
     * Store Users From Sheet.
     *
     * @return void
     */
    public function store(Request $request)
    {
    	// true if the sheet has an header row
        $sheet_has_header = true;

        // I have taken the sheet columns as name, email, is_sync
        if ($request->get('spreadsheet_id') && $request->get('sheet_name')) {
        	$spreadsheet = $request->get('spreadsheet_id');
        	$sheetname = $request->get('sheet_name');
        }else {
			$spreadsheet = config('sheets.spreadsheet_id');
        	$sheetname = config('sheets.sheet_name');
        }

        // Read the sheet data with Spreadsheet Id and Sheet name
        $sheet = Sheets::spreadsheet($spreadsheet)->sheet($sheetname);
        
        $users = collect();
        $header = [];

        $data = $sheet->get();
        
        if (empty($data)) {
        	$request->session()->flash('message', 'There is no data in this sheet');
        	return redirect()->back();
        }

        if ($sheet_has_header){

        	// skip the header row if sheet has an header
        	$header = $data->pull(0);
			$users = Sheets::collection($header, $data);
    
        }else {
        	$header = ['name', 'email', 'is_sync'];
            $users = Sheets::collection($header, $data);
        }

        $updated_users = [];
        foreach ($users as $key => $user) {

            // from the is_sync column we are checking if this user is considered to store in our database (i.e if is_sync is 1 process the record)
            $existing_user = User::where('email', $user['email'])->first();
    
            if (!($user['is_sync']) && !($existing_user)) {
            
                User::create(['name' => $user['name'], 'email' => $user['email'], 'password' => bcrypt('secret')]);

                // As the user is created in our database we are not considering this user for the next time i.e when the same sheet is uploaded this user will be skipped

                $updated_user = [$user['name'], $user['email'], "1"];

                array_push($updated_users, $updated_user);
            }else{
                // all the users data 
                array_push($updated_users, array_values($user->toArray()));
            }
        }

        // Update sheet with the user data as duplicate flag for processed users
        if ($sheet_has_header) {
            array_unshift($updated_users, $header);
        }
       
        $sheet->update($updated_users);

        $request->session()->flash('message', 'Import was successful!');
        return redirect()->back();
    }
}
