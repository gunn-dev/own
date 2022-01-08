<?php

namespace App\Http\Controllers\Admin;

use App\Models\CallService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PhoneCallServiceController extends Controller
{
    public function index()
    {
        $phone_call_services = CallService::where('payment_status', 1)->orderBy('id', 'DESC')->paginate(5);
        return view('admin.call_service.index', compact('phone_call_services'));
    }

    public function edit($id)
    {
        $phone_call_service = CallService::where('id', $id)->first();
        $phone_call_service = $phone_call_service->update([
            'status' => 1
        ]);
        return response()->json('Success');
    }
}
