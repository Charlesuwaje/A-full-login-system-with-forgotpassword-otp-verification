<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\workers;
class crudcontroller extends Controller
{
    public function index(){
$data =workers::get();
// return $data;
return view ('workers-list',compact('data'));
}
Public function addworker(){
    return view('add-worker');

}
public function saveWorker(Request $request){
   $request->validate([
        'name' => 'required |unique:workers|max:255',
        'email' => 'required|unique:workers|max:255',
        'phone' => 'required |unique:workers|max:255',
        'address' => 'required',
        
      ]);

    // $request->validate([
// 'name'=> 'requried',
// 'email'=> 'required|email',
// 'phone'=> 'required',
// 'address'=> 'required',



// ]);
    $name = $request ->name;
   $email = $request ->email;
   $phone = $request ->phone;
   $address = $request ->address;
   
    // $validatedData = $request->validate([
    //     'name' => 'required',
    //     'email' => 'required|unique:employees|max:255',
    //     'phone' => 'required',
    //     'address' => 'required|unique:employees|max:255',
    //   ]);

$work = new workers();
$work->name= $name;
$work->email= $email;
$work->phone= $phone;
$work->address= $address;
$work->save();
return redirect()->back()->with('success','workers added succesfully' );
 
    }
    public function editworker($id)
    {
        $data =workers::where('id','=',$id)->first();
        return view('edit-worker',compact('data'));
    }
        public function updateworker(Request $request){
            $validatedData = $request->validate([
                'name' => 'required',
                'email' => 'required',  
                'phone' => 'required',
                'address' => 'required',
                
            ]);
                    // $work= workers::find($id);
                     $id= $request ->id;
                    $name = $request ->name;
                    $email = $request ->email;
                    $phone = $request ->phone;
                    $address = $request ->address;
                    
                    workers::where('id','=',$id)->update([
                    'name'=>$name,
                    'email'=>$email,
                    'phone'=>$phone,
                    'address'=>$address,

                    ]);
return redirect()->back()->with('success','worker updated succesfully');

        }
public function deleteworker($id){
    workers::where('id','=',$id)->delete();
    return redirect()->back()->with('success','worker deleted succesfully');
   



}public function home(){
return view('Home');
    
}



    // public function editworker(Request $request, worker $work)
    // {
    //     $request->validate([
    //         'name' => 'required',
    //         'email' => 'required',
    //         'phone' => 'required',

    //         'address' => 'required',
    //     ]);
        
    //     $work->fill($request->post())->save();

    //     return redirect()->route('edit-worker')->with('success','worker Has Been updated successfully');
    // }

        

//         $name = $request ->name;
//         $email = $request ->email;
//         $phone = $request ->phone;
//         $address = $request ->address;

//         $work = new workers();
// $work->name= $name;
// $work->email= $email;
// $work->phone= $phone;
// $work->address= $address;
// $work->update();
// return redirect()->back()->with('success','workers updated succesfully');
 
    }
// }
