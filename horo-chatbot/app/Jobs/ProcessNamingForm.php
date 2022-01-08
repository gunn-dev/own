<?php

namespace App\Jobs;


use App\Models\BusinessNaming;
use App\Models\CallService;
use App\Models\ChildNaming;
use App\Models\DirectBaydin;
use App\Models\LoveBayDin;
use App\Models\OneYear;
use App\Models\Season;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Crypt;

class ProcessNamingForm implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    protected $request;
    protected $table;

    public function __construct($request, $table)
    {
        $this->request = $request;
        $this->table = $table;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        if ($this->table == 'child_namings') {
            $this->child();
        }

        if ($this->table == 'business_namings') {
            $this->business();
        }
        if ($this->table == 'one_years') {
            $this->one_year();
        }
        if ($this->table == 'lovebaydin') {
            $this->lovebaydin();
        }
        if ($this->table == 'directbaydin') {
            $this->directbaydin();
        }
        if ($this->table == 'baydinSayar_call') {
            $this->baydinSayarCall();
        }
        if ($this->table == 'season') {
            $this->season();
        }
    }

    public function child()
    {
        ChildNaming::create([
            'birth_date' => $this->request['birth_date'],
            'birth_time' => $this->request['birth_time'],
            'father_name' => $this->request['father_name'],
            'mother_name' => $this->request['mother_name'],
            'birth_place' => $this->request['birth_place'],
            'nyih_nan' => $this->request['nyih_nan'],
            'order_id' => $this->request['order_id'],
            "address" => $this->request['address'],
            'phone_number' => $this->request['phone_number'],
            'gender' => $this->request['gender'],
            'user_id' => Crypt::decrypt($this->request['user_id']),
            'category_id' => Crypt::decrypt($this->request['category_id'])
        ]);
    }

    public function business()
    {
        BusinessNaming::create([
         'date' => $this->request['date'],
         'owner_name' => $this->request['owner_name'],
         'facebook_name' => $this->request['facebook_name'],
         'birth_date' => $this->request['birth_date'],
         'nyih_nan' => $this->request['nyih_nan'],
         'gender' => $this->request['gender'],
         'business_type' => $this->request['business_type'],
         'job' => $this->request['job'],
         'reason' => $this->request['reason'],
         'phone_number' => $this->request['phone_number'],
         'address' => $this->request['address'],
         'viber_number' => $this->request['viber_number'],
         'order_id' => $this->request['order_id'],
         'user_id' => Crypt::decrypt($this->request['user_id']),
         'category_id' => Crypt::decrypt($this->request['category_id'])
        ]);
    }


    public function one_year()
    {
        OneYear::create([
            'birth_date' => $this->request['birth_date'],
            'birth_time' => $this->request['birth_time'],
            'name' => $this->request['name'],
            'birth_place' => $this->request['birth_place'],
            'nyih_nan' => $this->request['nyih_nan'],
            'career' => $this->request['career'],
            'marital_status' => $this->request['marital_status'],
            'phone_number' => $this->request['phone_number'],
            'about' => $this->request['about'],
            'order_id' => $this->request['order_id'],
            "address" => $this->request['address'],
            'user_id' => Crypt::decrypt($this->request['user_id']),
            'category_id' => Crypt::decrypt($this->request['category_id'])
        ]);
    }

    public function lovebaydin()
    {
        LoveBayDin::create([
            'g_name' => $this->request['g_name'],
            'g_birth_day' => $this->request['g_birth_day'],
            'g_birth_date' => $this->request['g_birth_date'],
            'g_address' => $this->request['g_address'],
            'b_name' => $this->request['b_name'],
            'b_birth_day' => $this->request['b_birth_day'],
            'b_birth_date' => $this->request['b_birth_date'],
            'b_address' => $this->request['b_address'],
            'phone_number' => $this->request['phone_number'],
            'order_id' => $this->request['order_id'],
            'user_id' => Crypt::decrypt($this->request['user_id']),
            'category_id' => Crypt::decrypt($this->request['category_id'])
        ]);
    }

    public function directbaydin()
    {
        DirectBaydin::create([
            'name' => $this->request['name'],
            'birth_date' => $this->request['birth_date'],
            'nyih_nan' => $this->request['nyih_nan'],
            'address' => $this->request['address'],
            'phone_number' => $this->request['phone_number'],
            'order_id' => $this->request['order_id'],
            'gender' => $this->request['gender'],
            'services' => json_encode($this->request['services']),
            'user_id' => Crypt::decrypt($this->request['user_id']),
            'category_id' => '55555',
            'about' => $this->request['about'],
            'baydin_sayar' => $this->request['baydin_sayar'],
            'marital_status' => $this->request['marital_status']
        ]);
    }

    public function baydinSayarCall()
    {
        CallService::create([
            'name' => $this->request['name'],
            'birth_date' => $this->request['birth_date'],
            'nyih_nan' => $this->request['nyih_nan'],
            'address' => $this->request['address'],
            'phone_number' => $this->request['phone_number'],
            'order_id' => $this->request['order_id'],
            'gender' => $this->request['gender'],
            'call_time' => $this->request['call_time'],
            'user_id' => Crypt::decrypt($this->request['user_id']),
            'about' => $this->request['about'],
            'category_id' => '44444',
            'marital_status' => $this->request['marital_status'],
            'order_id' => $this->request['order_id'],
            'user_id' => Crypt::decrypt($this->request['user_id']),
            'category_id' => Crypt::decrypt($this->request['category_id'])
        ]);
    }

    public function season()
    {
        Season::create([
            'date' => $this->request['date'],
            'name' => $this->request['name'],
            'facebook_name' => $this->request['facebook_name'],
            'birth_date' => $this->request['birth_date'],
            'nyih_nan' => $this->request['nyih_nan'],
            'gender' => $this->request['gender'],
            'career' => $this->request['career'],
            'phone_number' => $this->request['phone_number'],
            'address' => $this->request['address'],
            'viber_number' => $this->request['viber_number'],
            'order_id' => $this->request['order_id'],
            'user_id' => Crypt::decrypt($this->request['user_id']),
            'category_id' => Crypt::decrypt($this->request['category_id'])
        ]);
    }
}
