<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use DB;
use Log;
use File;
Use Exception;
use Carbon\Carbon;
use \DateTime;

class CardManagementController extends Controller
{
    public function idCardListIndex(Request $request){
        try{

            $card_list = User::orderBy('id','DESC')->get();

            return view('id-card.index',compact('card_list'));


         }catch(Exception $exception)
         {  
              return redirect()->route('card.index')->with('error', 'Something went wrong!');
         }
    }

    public function idCardCreate($slug = ''){
        try{

            if(!empty($slug)){

                $edit_card = User::where('slug',$slug)->first();

                if($edit_card){
                    return view('id-card.create',compact('edit_card'));
                }

            }
            return view('id-card.create');

         }catch(Exception $exception)
         {  
              return redirect()->route('card.index')->with('error', 'Something went wrong!');
         }
    }

    public function idCardStore(Request $request){

        try{

            if(!empty($request->id)){

                $card_store = User::find($request->id);

            }else{
                $card_store = new User;
                do
                {
                    $rand_num = $request->person_name.'_'.mt_rand(100, 999);
                }
                while (User::where('slug', $rand_num)->exists());
                $card_store->slug = $rand_num;
            }

            if($card_store){

                $card_store->person_name = $request->person_name;
                $card_store->designation = $request->designation;
                $card_store->business_name = $request->business_name;
                $card_store->short_description = $request->short_description;
                $card_store->whatsapp_number = $request->whatsapp_number;
                $card_store->single_address = $request->single_address;
        
            
                $card_store->save();

            }

            $destinationPath = public_path('images/card');

            if(!File::exists($destinationPath)) {

                File::makeDirectory($destinationPath, 0755, true, true);
            }

            if(empty($request->id)){
                $image_name = "";
            }else{
                $image_name = $card_store->image;

            }

        
            if ($request->hasFile('image')) {

                if(!empty($request->id)){
                    // remove old image from folder
                    $image_path = public_path('images/card' . $card_store->image);
                
                    if (File::exists($image_path))
                    {
                        File::delete($image_path);
                    }

                }

                $filenameoriginal = $request->file('image')->getClientOriginalName();
            
                $image_name = 'ID' . '_' . time() . "." . $request->file('image')->getClientOriginalExtension();

                $request->file('image')->move($destinationPath, $image_name);

            }
        
            $card_store->image = $image_name;
            $card_store->save();

            return redirect()
            ->route('card.index')
            ->with('success', 'Card created or updated successfully!');
        }catch(Exception $exception)
        {  
            return redirect()->route('card.index')->with('error', 'Something went wrong!');
        }
    }
    public function idCardListDelete($id){
        try {

            $delete_card = User::where('id',$id)->first();
            //image deleted code
                if($delete_card->image){
                        $image_path = public_path('images/card' . $delete_card->image);
                                
                        if (File::exists($image_path))
                        {
                            File::delete($image_path);
                        }
                }
    
            $delete_card->delete();
    
            return redirect()->route('card.index')->with('error', 'Card deleted succesfully.');
      
        }catch(Exception $exception)
        {  
            return redirect()->route('card.index')->with('error', 'Something went wrong!');
        }
       }
}