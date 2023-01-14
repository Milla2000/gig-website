<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;


class ListingController extends Controller
{
    //show all listings
    public function index(){
        
        return view('listings.index',[
            'listings'=> Listing::latest()->filter(request(['tag', 'search']))->simplepaginate(6)
        ]);



    }
     //show single listing
    public function show(Listing $listing){
        return view('listings.show',[
            'listing'=> $listing
        ]);

    }
    //show create form
    public function create(){
        return view('listings.create');
    }
    //store listing data
    public function store(Request $request){
        // helper function, which is used to dump a variable's contents to the browser and prevent the further script execution.
       //dd($request->all());
       $formFields = $request->validate([
        'title' =>'required',
        'company' =>['required', Rule::unique('listings','company')],//if you have more than one rule use array
        'location' =>'required',
        'website' =>'required',
        'email' =>['required','email'],
        'tags' =>'required',      
        'description' =>'required'     
        ]);
        if($request->hasFile('logo')){
            $formFields['logo']=$request->file('logo')->store('logos','public');
        }
        $formFields['user_id'] = auth()->id();

        Listing::create($formFields);
        //Session::flash();
        return redirect('/')->with('message', 'Listing created successfully');
    }
    //show edit form
   public function edit(Listing $listing){
    return view('listings.edit', ['listing' =>$listing]);
   }


    //update listing data
    public function update(Request $request, Listing $listing){
         //make sure login user is owner
        if($listing->user_id!= auth()->id()){
            abort(403, 'Unauthorized Action');
        }
        // helper function, which is used to dump a variable's contents to the browser and prevent the further script execution.
       //dd($request->all());
       $formFields = $request->validate([
        'title' =>'required',
        'company' =>['required'],//if you have more than one rule use array
        'location' =>'required',
        'website' =>'required',
        'email' =>['required','email'],
        'tags' =>'required',      
        'description' =>'required', 
             
        ]);
        if($request->hasFile('logo')){
            $formFields['logo']=$request->file('logo')->store('logos','public');
        }

        $listing->update($formFields);
        //Session::flash();
        return back()->with('message', 'Listing updated successfully');
    }

    //Delete Listing
    public function destroy(Listing $listing){
        if($listing->user_id!= auth()->id()){
            abort(403, 'Unauthorized Action');
        }
        $listing->delete();
        return redirect('/')->with('message', 'Listing Deleted successfully');
    }
    //manage listing function
    public function manage(){
        $listings = Listing::where('user_id',auth()->id())->get();
        // dd(auth()->id());
        return view('listings.manage')->with('listings',$listings);
        // return view('listings.manage',['listings'=>auth()->user()->$listings->get()]);

    }
}   
