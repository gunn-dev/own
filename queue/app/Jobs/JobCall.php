<?php

namespace App\Jobs;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class JobCall implements ShouldQueue
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
        if ($this->table == 'user') {
            $this->user();
        }
        
    }

    public function user()
    {
        logger('Here from jobcall.');
        User::create([
            'name' => $this->request['name'],
            'email' => $this->request['email'],
            'password' => $this->request['password']
        ]);
    }
}
