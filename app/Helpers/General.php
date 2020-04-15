<?php

use Illuminate\Support\Facades\Redirect;
use App\CurrencyMaster;
use Carbon\Carbon;

class General
{
   /**
     *  get currency name by ids ( comaa seperated)
     *
     * @param $ids
     * @return name (comma seperated )
     */
     
     public static function getCurrencyNameByIds($ids=NULL){
         $ids = explode(",",$ids);
         if(empty($ids)){
             return;
         }
         $currencies = CurrencyMaster::select('name')->whereIn('id',$ids)->where('status','=','1')->get();
         if($currencies->count()){
             $names = '';
             foreach($currencies as $currency){
                 $names.=$currency->name.", ";
             }
             $names = trim($names, ", ");
             return $names;
         }
         return;
         
     }

    public static function getLocation($location)
    {    
        $location = preg_replace('/\s+/', '', $location); 
         $geocode_stats = file_get_contents("https://maps.googleapis.com/maps/api/geocode/json?address=".$location."&sensor=false&key=AIzaSyAzHs4vcqexf73dHTV-F6qHCBBRg8XYd0A"); 
            $output_deals = json_decode($geocode_stats); 
            if($output_deals->status=="OK"){ 
                $latLng = $output_deals->results[0]->geometry->location;
                $lat = $latLng->lat;
                $lng = $latLng->lng;
                
                $fullLocation = $output_deals->results[0]->formatted_address;
                $fullLocation_arr = explode(',',$fullLocation);
                    
                if(count($fullLocation_arr)==7) { //count 5 & 6 new added check it..... 
                    $city = $fullLocation_arr[4];
                    $state = substr($fullLocation_arr[5], 0, strrpos($fullLocation_arr[5], " "));
                    $country = $fullLocation_arr[6];
                }elseif(count($fullLocation_arr)==6) { //count 5 & 6 new added check it..... 
                    $city = $fullLocation_arr[3];
                    $state = substr($fullLocation_arr[4], 0, strrpos($fullLocation_arr[4], " "));
                    $country = $fullLocation_arr[5];
                }elseif(count($fullLocation_arr)==5) {
                    $city = $fullLocation_arr[2];
                    $state = substr($fullLocation_arr[3], 0, strrpos($fullLocation_arr[3], " "));
                    $country = $fullLocation_arr[4];
                }elseif(count($fullLocation_arr)==4) {
                    $city = $fullLocation_arr[1];
                    $state = substr($fullLocation_arr[2], 0, strrpos($fullLocation_arr[2], " "));
                    $country = $fullLocation_arr[3];
                } elseif(count($fullLocation_arr)==3) {
                    $city = $fullLocation_arr[0];
                    //$state = substr($fullLocation_arr[1], 0, strrpos($fullLocation_arr[1], " "));
                    $state = $fullLocation_arr[1];
                    $country = $fullLocation_arr[2];
                } elseif(count($fullLocation_arr)==2) {
                    $city = $fullLocation_arr[0];
                    $state = $fullLocation_arr[0];
                    $country = $fullLocation_arr[1];
                }elseif(count($fullLocation_arr)==1) {
                    $city = $fullLocation_arr[0];
                    $state = $fullLocation_arr[0];
                    $country = $fullLocation_arr[0];
                }
            }else{
                $lat = '';
                $lng = '';
                $city = '';
                $state = '';
                $country = '';
            } 
            $location = [
                'lat' => $lat,
                'lng' => $lng,
                'city' => $city,
                'state' => $state,
                'country' => $country,
            ];
        return  $location;
            
    }

    public static function statusList(){
        return ['Pending','Assigned','OnRoute','Done','Cancelled'];
    }
}