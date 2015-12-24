<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Customers;
use App\Activities;
use App\Contacts;
use View;
use DB;
use Crypt;
use Mail;

class CRMController extends Controller
{
    public function homeView(Request $request){
        $staffId = explode(":", Crypt::decrypt($request->get("session")));
        
        $customers = Customers::all();
        $contacts = Contacts::all();
        $activities = DB::table('activities as a')->select('a.id as activityId', 'a.cusId', 'a.date', 'a.outcome', 'a.staffId', 'a.type', 'u.id as staffId', 'u.fullname as staffName')->leftJoin('user as u', 'a.staffId', '=', 'u.id')
        ->get();
        return View::make('home')
            ->with('staffId', $staffId[0])
            ->with('staffName', $staffId[1])
            ->with('customers', $customers)
            ->with('contacts', $contacts->toJson())
            ->with('activities', json_encode($activities));
    }
    
    public function createCustomer(Request $request){
        $session = $request->get('session');
        $staffId = $request->get('staffId');
        $companyname = $request->get("companyname");
        $regno = $request->get("regno");
        $address = $request->get("address");
        $website = $request->get("website");
        
        $customer = new Customers;
        $customer->staffId = $staffId;
        $customer->companyName = $companyname;
        $customer->regNo = $regno;
        $customer->address = $address;
        $customer->website = $website;
        
        $customer->save();
        
        $to      = 'amalgamage989@gmail.com';
        $subject = 'New Customer Created';
        $message = 'New Customer Created > ' . $customer->toJson();
        $headers = 'From: webmaster@senapavers.com' . "\r\n" .
            'Reply-To: webmaster@senapavers.com' . "\r\n" .
            'X-Mailer: PHP/' . phpversion();

        mail($to, $subject, $message, $headers);
        
        return redirect()->action('CRMController@homeView', ["session"=>$session]);
    }
    
    public function editCustomer(Request $request){
        $session = $request->get('session');
        $id = $request->get('id');
        $companyname = $request->get("companyname");
        $regno = $request->get("regno");
        $address = $request->get("address");
        $website = $request->get("website");
        
        $customer = Customers::find(intval($id));
        
        $customer->companyName = $companyname;
        $customer->regNo = $regno;
        $customer->address = $address;
        $customer->website = $website;
        
        $customer->save();
        
        return redirect()->action('CRMController@homeView', ["session"=>$session]);
    }
    
    public function createContact(Request $request){
        $session = $request->get('session');
        $cusid = $request->get('cusId');
        $name = $request->get("contactname");
        $email = $request->get("contactemail");
        $contactno = $request->get("contacttelno");
        
        $contact = new Contacts;
        
        $contact->cusId = $cusid;
        $contact->name = $name;
        $contact->email = $email;
        $contact->contactNo = $contactno;
        
        $contact->save();
        
        return Contacts::all()->toJson();
    }
    
    public function editContact(Request $request){
        $session = $request->get('session');
        $cusid = $request->get('contactcusid');
        $id = $request->get('contactid');
        $name = $request->get("contactname");
        $email = $request->get("contactemail");
        $contactno = $request->get("contacttelno");
        
        $contact = Contacts::find($id);
        
        $contact->cusId = $cusid;
        $contact->name = $name;
        $contact->email = $email;
        $contact->contactNo = $contactno;
        
        $contact->save();
        
        return Contacts::all()->toJson();
    }
    
    public function createActivity(Request $request){
        $session = $request->get('session');
        
        $staffId = $request->get('activitystaffId');
        $cusId = $request->get('cusId');
        $date = $request->get("activitydate");
        $type = $request->get("activitytype");
        $outcome = $request->get("activityoutcome");
        
        $activity = new Activities;
        
        $activity->cusId = $cusId;
        $activity->staffId = $staffId;
        $activity->date = $date;
        $activity->type = $type;
        $activity->outcome = $outcome;
        
        $activity->save();
        
        return json_encode(DB::table('activities as a')->select('a.id as activityId', 'a.cusId', 'a.date', 'a.outcome', 'a.staffId', 'a.type', 'u.id as staffId', 'u.fullname as staffName')->leftJoin('user as u', 'a.staffId', '=', 'u.id')->get());
    }
    
    public function editActivity(Request $request){
        $session = $request->get('session');
        
        $id = $request->get('id');
        $staffId = $request->get('activitystaffId');
        $cusId = $request->get('cusId');
        $date = $request->get("activitydate");
        $type = $request->get("activitytype");
        $outcome = $request->get("activityoutcome");
        
        $activity = Activities::find($id);
        
        $activity->cusId = $cusId;
        $activity->staffId = $staffId;
        $activity->date = $date;
        $activity->type = $type;
        $activity->outcome = $outcome;
        
        $activity->save();
        
        return json_encode(DB::table('activities as a')->select('a.id as activityId', 'a.cusId', 'a.date', 'a.outcome', 'a.staffId', 'a.type', 'u.id as staffId', 'u.fullname as staffName')->leftJoin('user as u', 'a.staffId', '=', 'u.id')->get());
    }
    
}
