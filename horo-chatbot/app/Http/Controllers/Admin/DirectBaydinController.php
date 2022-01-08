<?php

namespace App\Http\Controllers\Admin;

use App\Jobs\SendContent;
use App\Models\DirectBaydin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

class DirectBaydinController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lovebaydins = DirectBaydin::where('payment_status', 1)->orderBy('id','DESC')->paginate(5);
        return view('admin.directbaydin.index', compact('lovebaydins'));
    }

    public function deliver(Request $request)
    {
        return view('admin.directbaydin.content')->with([
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


        $child = DirectBaydin::where('id', $request->id)->first();
        $child->update([
            'is_delivered' => 1
        ]);

        $arguments = [
            'user_id' => $request->user_id,
            'content_file' => $uniqueFileName,
            'extension' => $extension,
            'id' => $child->id,
            'type' => 'directbaydin'
        ];
        SendContent::dispatch($arguments);
        return redirect()->route('admin.directbaydin.index')->with('message', 'Content Deliver Success!');
    }


}
