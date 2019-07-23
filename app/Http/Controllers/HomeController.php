<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\productstatus;
use App\registeredproduct;
use App\productid;
use App\analogstate;
use App\devicehistory;
use App\shareddevice;
use App\User;
use Auth;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }
    //  public function __construct()
    // {
    //     $this->middleware('auth:api');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
   
    public function index()
    {
        return view('user.home');
        // $devices = registeredproduct::where('email',Auth::user()->email)->get();
        // $pawnshared = shareddevice::where(['sharedto_id' => Auth::user()->id , 'status' => 'active' , 'level' => 'pawn' , 'status' => 'active'])->get();
        //  $knightshared = shareddevice::where(['sharedto_id' => Auth::user()->id, 'status' => 'active' , 'level' => 'knight','status' => 'active'])->get();
      
        // $products = registeredproduct::all();
        // $users  = User::all();
        // if(count($pawnshared) > 0){
        //     foreach ($pawnshared as $pawn) {
        //        foreach ($products as $product) {
        //            if($product->product_id == $pawn->device_id){
        //             $pawn['deviceid'] = $product->id;
                 

        //            }
        //        }
        //        foreach ($users as $user) {
        //             if($user->id == $pawn->sharedby_id){
        //                 $pawn['sharedby'] = $user->username;
        //             }
        //        }
        //     }

        // }
        // if(count($knightshared) > 0){
        //     foreach ($knightshared as $knight) {
        //        foreach ($products as $product) {
        //            if($product->product_id == $knight->device_id){
        //             $knight['deviceid'] = $product->id;
                    

        //            }
        //        }
        //        foreach ($users as $user ){
        //             if($user->id == $knight->sharedby_id){
        //                 $knight['sharedby'] = $user->username;
        //             }
        //        }
        //     }

        // }
        
        // // return view('user.home',['devices' => $devices , 'knightshared' => $knightshared , "pawnshared" => $pawnshared]);
        // $data['devices'] = $devices;
        // $data['knightshared'] = $knightshared;
        // $data['pawnshared'] = $pawnshared;

        // return $data;
    } 
    public function devices(){

    }

    public function putdevice()
    {
        return view('user.adddevice');
    }
    public function editdevice($device_id)
    {
        
        $device = registeredproduct::where(['email' => Auth::user()->email , 'product_id' => $device_id] )->first();;
        $shared = shareddevice::where(['sharedto_id' => Auth::user()->id , 'status' => 'active' , 'device_id' => $device_id])->first();
       if(count($device) > 0){
           
           return view('user.editdevice',['device' => $device]); 
       } 
        else if(count($shared) > 0 ){
          
         return view('user.editdevice',['device' => $shared]);    
        }

       
    }
    public function savedevice(request $request)
    {
          $this->validate($request,[
        
            "device_id" =>  "required",
            'name' => 'required'
            
         
            ]);
            $device_id = $request->device_id;
         $device = registeredproduct::where(['email' => Auth::user()->email , 'product_id' => $device_id] )->first();
        $shared = shareddevice::where(['sharedto_id' => Auth::user()->id , 'status' => 'active' , 'device_id' => $device_id])->first();
        
        if(count($device) > 0 ){
            $device->product_name = $request->name;
            $device->save();
            $log = new devicehistory;
             $log->user_id = Auth::user()->id;
             $log->action = "Edit Device"; 
             $log->source = "WEB";
             $log->device_id = $request->device_id;
             $log->port_id = 0;
             $log->save();
             return redirect('/dashboard');

        }
        else if(count($shared) > 0 ){
          
          $shared->product_name = $request->name;
            $shared->save();  
            $log = new devicehistory;
             $log->user_id = Auth::user()->id;
             $log->action = "Edit Device"; 
             $log->source = "WEB";
             $log->device_id = $request->device_id;
             $log->port_id = 0;
             $log->save();
             return redirect('/dashboard');
        }
        else{
            
           session()->flash('message',"invalid device");
                               return redirect()->bacK();
  
        }

       

        
    }  
    public function editport($port_id)
    {
        $device = productstatus::find($port_id);

        return view('user.editport',compact('device'));
    }
    public function saveport(request $request)
    {
          $this->validate($request,[
        
            "device_id" =>  "required",
            "port_id" =>  "required",
            'name' => 'required'
            
         
            ]);
          $route = registeredproduct::where('product_id' , $request->device_id)->first();
        $device = productstatus::find($request->port_id);
        if(count($device) > 0 ){
            $device->port_name = $request->name;
            $device->save();
            $log = new devicehistory;
             $log->user_id = Auth::user()->id;
             $log->action = "Edit Device"; 
             $log->source = "WEB";
             $log->device_id = $request->device_id;
             $log->port_id = $request->port_id;
             $log->save();
             return redirect('/devices/'.$route->id);

        }
        session()->flash('error',"invalid device");
                               return redirect()->bacK();


        
    }
     public function getdevice($id)
    {
        $device = registeredproduct::where(['id'=>$id , 'email' => Auth::user()->email])->first();
        $shared = registeredproduct::find($id);
       
         $sdevice = shareddevice::where(['device_id' => $shared->product_id , 'sharedto_id' => Auth::user()->id])->first();
       
        if(isset($device))
        {
             $ports = productstatus::where(['email'=>Auth::user()->email, 'product_id' => $device->product_id])->get();
             return view('user.device',['ports'=> $ports,'productid' => $device->product_id]);

        }
        else if(isset($sdevice) > 0){
            $user = User::find($sdevice->owner_id);

             $ports = productstatus::where(['email'=> $user->email, 'product_id' => $sdevice->device_id])->get();
             
             return view('user.device',['ports'=> $ports,'productid' => $sdevice->device_id ]);
        }
        else 
            return redirect()->back();
    } 
    public function control($productid,$id){
     
        $port = productstatus::where(['product_id' => $productid, 'id'=>$id , 'email' => Auth::user()->email])->first();
        if(isset($port) ){
        
           if( $port->new_value == '1'){
             $port->new_value = '0';
             $port->save();
            $log = new devicehistory;
             $log->user_id = Auth::user()->id;
             $log->action = "OFF"; 
             $log->source = "WEB";
             $log->device_id = $port->product_id;
             $log->port_id = $port->id;

             $log->save();
           }
           else{
            $port->new_value = '1';
             $port->save();
             $log = new devicehistory;
             $log->user_id = Auth::user()->id;
             $log->action = "ON"; 
             $log->source = "WEB";
             $log->device_id = $port->product_id;
             $log->port_id = $port->id;

             $log->save();
           }
           return redirect()->back();
        }
        else{

           $shareddevice = shareddevice::where(['device_id' => $productid , 'sharedto_id' => Auth::user()->id , 'status' => 'active' ])->first();
           if (count($shareddevice) > 0 ){
              $port = productstatus::where(['product_id' => $productid, 'id'=>$id ])->first();
        if(count($port) > 0){
        
           if( $port->new_value == '1'){
             $port->new_value = '0';
             $port->save();
            $log = new devicehistory;
             $log->user_id = Auth::user()->id;
             $log->action = "OFF"; 
             $log->source = "WEB";
             $log->device_id = $port->product_id;
             $log->port_id = $port->id;

             $log->save();
           }
           else{
            $port->new_value = '1';
             $port->save();
             $log = new devicehistory;
             $log->user_id = Auth::user()->id;
             $log->action = "ON"; 
             $log->source = "WEB";
             $log->device_id = $port->product_id;
             $log->port_id = $port->id;

             $log->save();
           }
         
           }

            return redirect()->back();
        }
        else{
            return redirect()->back();
        }
       
    }
    }
      public function setdevice(request $request)
    
    {
         $this->validate($request,[
            "product_id" =>  "required",
            "product_name" => "required",
         
            ]);
         $product = productid::where('product_id',$request->product_id)->first();
         if(count($product) > 0){
            if($product->status == 'unused'){
                $registerproduct = new registeredproduct;
                $registerproduct->product_name = $request->product_name;
                $registerproduct->product_id = $request->product_id;
                $registerproduct->email = Auth::user()->email;
                $registerproduct->port_number = $product->port_number;
                $registerproduct->status = 'active';

                $product->status = 'used';
                $registerproduct->save();
                $product->save();

                $count = 1;
               

                    for ($i = 1 ; $i <   $product->port_number + 1 ; $i++){
                        $productstatus = new productstatus;
                        $productstatus->email = Auth::user()->email;
                        $productstatus->product_id = $request->product_id;
                        $productstatus->pin_number =  $i;
                        $productstatus->port_name = 'port'.$i;
                        $productstatus->current_value =  '0';
                        $productstatus->new_value = '0';
                        
                        $productstatus->save();
                    }
                        for ($i = 1 ; $i < 3 ; $i++){
                        $analogstatus = new analogstate;
                        $analogstatus->email = Auth::user()->email;
                        $analogstatus->product_id = $request->product_id;
                        $analogstatus->pin_number =  $i;
                        $analogstatus->value =  '0';
               
                        
                        $analogstatus->save();
                    }
              

                  return redirect('/dashboard');
            }
           else{
              session()->flash('message',' Device ID has been used.'); 
             return redirect()->back();
           }
         }
         else{
           
         
          session()->flash('message','invalid device ID ');    
       return redirect()->back();
    }
}
}
