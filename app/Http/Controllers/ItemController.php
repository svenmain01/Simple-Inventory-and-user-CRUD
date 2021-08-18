<?php

namespace App\Http\Controllers;

use App\Models\IndividualItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\QueryException;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = IndividualItem::all();

        // if (Auth::user()->hasRole('superadministrator|user')) {
        Auth::user();
        return view('dashboard', ['items'=>$items]);
        // }
        // else {
        //     return view('userdashboard', ['items'=>$items]);
        // }
        

        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('crud.new');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'category' => 'required',
            'item' => 'required',
            'description' => 'required',
            'quantification' => 'required',
            'quantity' => 'required',
            'priceperquantification' => 'required',
            'totalprice' => 'required',
            'acquisitiondate' => 'required',
        ]);

        try {
            IndividualItem::create([
                'category' => $request['category'],
                'item' => $request['item'],
                'description' => $request['description'],
                'quantification' => $request['quantification'],
                'quantity' => $request["quantity"],
                'priceperquantification' => $request['priceperquantification'],
                'totalprice' => $request['totalprice'],
                'acquisitiondate' => $request['acquisitiondate'],
                'propertynumber' => $request['propertynumber']
            ]);
            // return redirect('/dashboard');
            return redirect()->back()->with('message',$request['item']);
        }
        catch (QueryException $e){
            $errorCode = $e->errorInfo[1];
            if($errorCode == 1062){
                
                $itemname = $request['item'];
                $itempropertynumber = $request['propertynumber'];
                $itemselect = IndividualItem::where('propertynumber', $itempropertynumber)->first();
                $itemid = $itemselect["id"];
        
                return redirect()->back()->with('duplicateItemName', $itemname)->with('duplicateItemPN', $itempropertynumber)->with('duplicateItemID', $itemid);
            }
            
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\IndividualItem  $individualItem
     * @return \Illuminate\Http\Response
     */
    public function show(IndividualItem $individualItem)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\IndividualItem  $individualItem
     * @return \Illuminate\Http\Response
     */
    public function edit(IndividualItem $item)
    {
        return view('crud.edit', ['item' => $item]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int $itemid
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $itemid)
    {   

        IndividualItem::where('id',$itemid)->update([
            'category' => $request['category'],
            'item' => $request['item'],
            'description' => $request['description'],
            'quantification' => $request['quantification'],
            'quantity' => $request['quantity'],
            'priceperquantification' => $request['priceperquantification'],
            'totalprice' => $request['totalprice'],
            'acquisitiondate' => $request['acquisitiondate'],
            'propertynumber' => $request['propertynumber']
        ]);
        
        return redirect()->back()->with('message',$request['item']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\IndividualItem  $individualItem
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $itemid)
    {
        $itemname = $request['item'];
        IndividualItem::where('id',$itemid)->delete();
        return redirect('/dashboard')->with('remove',$itemname);
    }
}
