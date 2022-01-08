<?php

namespace App\Http\Controllers\Admin;

use App\Jobs\SendContent;
use App\Models\BusinessNaming;
use App\Models\ChildNaming;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

class BusinessNamingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $businesses = BusinessNaming::where('payment_status', 1)->orderBy('id','DESC')->paginate(5);
        return view('admin.business.index', compact('businesses'));
    }

    public function deliver(Request $request)
    {
        return view('admin.business.content')->with([
            'user_id' => $request->user_id,
            'id' => $request->id
        ]);
    }

    public function send(Request $request)
    {

        $file = Input::file('file');
        $extenstion = $file->getClientOriginalExtension();
        $uniqueFileName = uniqid() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('/uploads/files/'), $uniqueFileName);

        $business = BusinessNaming::where('id', $request->id)->first();
        $business->update([
           'is_delivered' => 1
        ]);
        $arguments = [
            'user_id' => $request->user_id,
            'content_file' => $uniqueFileName,
            'extension' => $extenstion,
            'id' => $business->id,
            'type' => 'business'
        ];

        SendContent::dispatch($arguments);
        return redirect()->route('admin.business.index')->with('message', 'Content Deliver Success!');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
