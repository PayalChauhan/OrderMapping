<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use App\Order;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Http\Requests;
use Illuminate\html;
use Carbon\Carbon;
use General;
use App\Country;

/**
 * Class TestController
 * @package App\Http\Controllers
 */

class TestController extends Controller{  
	
    /**
     * Get list of orders with countries
     *
     * @param 
     * @return view
     */
    public function index(Request $request) {
    	$OrderList = [];
    	$statusList = [];
		$OrderList = Order::all();
		$statusList = Order::groupBy('status')->get();
		return view('test',compact('OrderList','statusList'));
    }
	
	/**
     * store orders
     *
     * @param $request
     * @return view
     */ 
	public function store(Request $request) { 
		
		$this->validate($request,[
			'firstname'=>'required|max:50',
			'phone_number'=>'required',
			'order_type'=>'required',
			'scheduled_date'=>'required',
			'street_address'=>'required',
			'city'=>'required|max:50',
			'state'=>'required|max:50',
			'country'=>'required'

		]);
		$location = General::getLocation($request->input('street_address')); 
		$firstname = $request->input('firstname');
		$lastname = $request->input('lastname');
		$email = $request->input('email');
		$phone_number = $request->input('phone_number');
		$order_type = $request->input('order_type');
		$order_value = $request->input('order_value');
		$scheduled_date = $request->input('scheduled_date');
		$street_address = $request->input('street_address');
		$city = $request->input('city');
		$state = $request->input('state');
		$postal_zipcode = $request->input('postal_zipcode');
		$country = $request->input('country');
		$lat   = $location['lat'];
		$lng   = $location['lng'];
		$value = [  'firstname' => $firstname,
					'lastname' => $lastname,
					'email'=>$email,
					'phone_number'=>$phone_number,
					'order_type'=>$order_type,
					'order_value'=>$order_value,
					'scheduled_date'=>$scheduled_date,
					'street_address'=>$street_address,
					'city'=>$city,
					'state'=>$state,
					'postal_zipcode'=>$postal_zipcode,
					'country'=>$country,
					'latitude'=>$lat,
					'longitude'=>$lng,
					'created_at' => Carbon::now(),
					'updated_at' =>Carbon::now()
				];
		$order = Order::create($value);
		return redirect()->route('test')->withSuccess('added successfully!');
	}

	public function storeAjax(Request $request) {
		$this->validate($request,[
			'firstname'=>'required|max:50',
			'phone_number'=>'required',
			'order_type'=>'required',
			'scheduled_date'=>'required',
			'street_address'=>'required',
			'city'=>'required|max:50',
			'state'=>'required|max:50',
			'country'=>'required'

		]);
		$location = General::getLocation($request->input('street_address')); 
		$firstname = $request->input('firstname');
		$lastname = $request->input('lastname');
		$email = $request->input('email');
		$phone_number = $request->input('phone_number');
		$order_type = $request->input('order_type');
		$order_value = $request->input('order_value');
		$scheduled_date = $request->input('scheduled_date');
		$street_address = $request->input('street_address');
		$city = $request->input('city');
		$state = $request->input('state');
		$postal_zipcode = $request->input('postal_zipcode');
		$country = $request->input('country');
		$lat   = $location['lat'];
		$lng   = $location['lng'];
		$value = [  'firstname' => $firstname,
					'lastname' => $lastname,
					'email'=>$email,
					'phone_number'=>$phone_number,
					'order_type'=>$order_type,
					'order_value'=>$order_value,
					'scheduled_date'=>$scheduled_date,
					'street_address'=>$street_address,
					'city'=>$city,
					'state'=>$state,
					'postal_zipcode'=>$postal_zipcode,
					'country'=>$country,
					'latitude'=>$lat,
					'longitude'=>$lng,
					'created_at' => Carbon::now(),
					'updated_at' =>Carbon::now()
				];
		$order = Order::create($value);

		return response()->json(["success"=>true,"message"=>"order added success","order_data"=>$order]);
	}

	/**
     * delete order
     *
     * @param $request
     * @return view
     */
	public function delete($id)
	{
	    $order = Order::findOrFail($id);
	    $order->delete();
	    return redirect()->route('test');
	}

	/**
     * change status of list
     *
     * @param 
     * @return view
     */
    public function status(Request $request) {
    	$id = $request->id;
    	$status = $request->status;
		$order = Order::findOrFail($id);
		$order->status = $status;
		$order->save();
		return redirect()->route('test');
    }
}
