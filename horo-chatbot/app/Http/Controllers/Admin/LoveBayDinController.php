<?php

namespace App\Http\Controllers\Admin;

use App\Jobs\SendContent;
use App\Models\LoveBayDin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

class LoveBayDinController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lovebaydins = LoveBayDin::where('payment_status', 1)->orderBy('id','DESC')->paginate(5);
        return view('admin.lovebaydin.index', compact('lovebaydins'));
    }

    public function deliver(Request $request)
    {
        return view('admin.lovebaydin.content')->with([
            'user_id' => $request->user_id,
            'id' => $request->id
        ]);
    }

    public function send(Request $request)
    {

        $file = Input::file('file');
        $extension =  $file->getClientOriginalExtension();
        $uniqueFileName = uniqid() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('/uploads/files/'), $uniqueFileName);


        $child = LoveBayDin::where('id', $request->id)->first();
        $child->update([
            'is_delivered' => 1
        ]);

        $arguments = [
            'user_id' => $request->user_id,
            'content_file' => $uniqueFileName,
            'extension' => $extension,
            'id' => $child->id,
            'type' => 'lovebaydin'
        ];
        SendContent::dispatch($arguments);
        return redirect()->route('admin.lovebaydin.index')->with('message', 'Content Deliver Success!');
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
