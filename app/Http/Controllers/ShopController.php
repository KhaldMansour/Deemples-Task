<?php

namespace App\Http\Controllers;

use Hash;
use DataTables;
use App\Models\Shop;
use Illuminate\Http\Request;
use App\DataTables\ShopDataTable;
use App\Exports\ShopExport;
use App\Imports\ShopImport;
use Excel;

class ShopController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ShopDataTable $dataTable , Request $request)
    {
        if ($request->ajax()) {
            $data = Shop::select('*');
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
       
                        $btn = '<button id="edit" value="' .$row->id. '"'. 'class="edit btn btn-primary btn-sm" data-target="#edit-modal" data-toggle="modal">Edit</button>';

                        $btn = $btn.'<button  id="delete" value="' .$row->id. '"'. 'class="delete btn btn-danger btn-sm">Delete</button>';
         
                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        
        return view('shops.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string',
            'floor' => 'required|numeric',
            'shoplot' => 'required|numeric',
        ]);

        $data = request()->all();

        $shop = new Shop($data);

        $shop->hash = $this->generateHash($shop);

        $shop->save();

        return response()->json([
            'message' => 'Shop Created Successfully'
        ]);
    }

    public function update(Request $request)
    {
        $data = $this->validate($request, [
            'name' => 'required|string',
            'floor' => 'required|numeric',
            'shoplot' => 'required|numeric',
        ]);

        $shop = Shop::find($request->id);

        $shop->update($data);

        $shop->hash = $this->generateHash($shop);

        $shop->save();

        return response()->json([
            'message' => 'Shop Updated Successfully'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Shop  $shop
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $shop = Shop::findOrFail($id);

        $shop->delete();

        return response()->json([
            'message' => 'Shop Deleted Successfully'
        ]);
    }

    public function generateHash($shop)
    {
        $data = serialize($shop['name'] . $shop['floor'] . $shop['shoplot']);

        $hash = Hash::make($data);

        return $hash;
    }

    public function exportIntoExcel()
    {
        return Excel::download(new ShopExport , 'shops.xlsx');
    }

    public function import()
    {
        return view('shops.import');
    }

    public function uploadFile(Request $request)
    {
        $data = $this->validate($request, [
            'file' => 'required|mimes:xlsx'
        ]);

        Excel::import(new ShopImport , $request->file('file'));

        return back();
    }

}
