<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Contact;
use Illuminate\Support\Facades\DB;

//use App\Contact;

class ContactController extends Controller
{
  public function index()
  {
    $row = Contact::orderBy('id')->get();
    return view('Pages.allContact')->with('contactpass', $row);

    //$contact = DB::table('contacts')->get();
    //return view('Pages.allContact')->with('contactpass', $contact); 2da forma
  }

  public function create()
  {

    return view('Pages.insertData');
  }

  public function store(Request $request)
  {

    $data = array();
    $data['name'] = $request->name;
    $data['email'] = $request->email;
    $data['phone'] = $request->phone;
    $data['description'] = $request->description;

    $insData = Contact::insert($data);
    //$insData = DB::table('contacts')->insert($data);

    return redirect()->route('all.contacts');
  }

  public function delete($id)
  {

    $del = Contact::where('id', $id)->delete();
    //$del = DB::table('contacts')->where('id', $id)->delete(); 2da forma

    return redirect()->route('all.contacts');
  }

  public function edit($id)
  {

    $edt = Contact::where('id', $id)->first();
    //$edt = DB::table('contacts')->where('id', $id)->first(); 2da forma

    return view('Pages.editContact', compact('edt'));
  }

  public function update(Request $request, $id)
  {

    $data = array();
    $data['name'] = $request->name;
    $data['email'] = $request->email;
    $data['phone'] = $request->phone;
    $data['description'] = $request->description;

    $updateCont = Contact::where('id', $id)->update($data);
    //$updateCont = DB::table('contacts')->where('id', $id)->update($data);2da forma

    return redirect()->route('all.contacts');
  }


  public function show($id)
  {

    $view = Contact::where('id', $id)->first();
    //$view = DB::table('contacts')->where('id', $id)->first();2da forma

    return view('Pages.viewDetails', compact('view'));
  }
}
