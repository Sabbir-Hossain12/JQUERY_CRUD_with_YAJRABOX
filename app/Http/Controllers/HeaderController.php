<?php

namespace App\Http\Controllers;

use App\Models\Header;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Yajra\DataTables\Services\DataTable;

class HeaderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        return view('pages.header');
    }

    public function getHeaderData()
    {
        $headers = Header::get();
        
        return DataTables::of($headers)
            ->addColumn('action', function ($header) {
                return '<a href="" class="btn btn-sm btn-success edit-btn"  data-id="'.$header->id .'"  data-bs-toggle="modal" data-bs-target="#editModal" >Edit</a>
                    <a href="" class="btn btn-sm btn-danger delete-btn" data-id="'.$header->id .'">Delete</a>';
            })
        ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
//        $request->validate(
//            [
//                'title_1' => 'string',
//                'title_2' => 'string',
//                'Short_desc' => 'string', 
//            ]
//        );
        
        
        $header= new Header();
        
        $header->title1= $request->title1;
        $header->title_2= $request->title_2;
        $header->Short_desc= $request->Short_desc;
        $header->btn_link= $request->btn_link;
        $header->btn_text= $request->btn_text;
        
        $check=   $header->save();
        
        if ($check)
        {
            return response()->json(['message'=>'success','data'=>$header],200);
        }


        return response()->json(['message'=>'failed','data'=>''],400);
        
    }

    /**
     * Display the specified resource.
     */
    public function show(Header $header)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Header $header)
    {
        return response()->json(['message'=>'success','data'=>$header],200);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Header $header)
    {
//        $request->validate(
//            [
//                'title_1' => 'string',
//                'title_2' => 'string',
//                'Short_desc' => 'string',
//            ]
//        );
        
        
        $header->title1= $request->title1;
        $header->title_2= $request->title_2;
        $header->Short_desc= $request->Short_desc;
        $header->btn_link= $request->btn_link;
        $header->btn_text= $request->btn_text;

        $check=   $header->save();

      
            return response()->json(['message'=>'success','data'=>$header],200);
       
            
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Header $header)
    {
        $header->delete();
        
        return response()->json(['message'=>'success','data'=>$header],200);

        
    }
}
