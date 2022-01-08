<?php

namespace App\Http\Controllers\Admin;

use App\Jobs\SendContent;
use App\Models\ChildNaming;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Input;

class ChildNamingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $children = ChildNaming::where('payment_status', 1)->orderBy('id','DESC')->paginate(5);
        return view('admin.child.index', compact('children'));
    }


    public function deliver(Request $request)
    {
        return view('admin.child.content')->with([
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


        $child = ChildNaming::where('id', $request->id)->first();
        $child->update([
            'is_delivered' => 1
        ]);

        $arguments = [
            'user_id' => $request->user_id,
            'content_file' => $uniqueFileName,
            'extension' => $extension,
            'id' => $child->id,
            'type' => 'child'
        ];
       SendContent::dispatch($arguments);
       return redirect()->route('admin.child.index')->with('message', 'Content Deliver Success!');
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
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
