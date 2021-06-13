<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Schedule;
use App\Models\Hosting;
use App\Models\DatabaseUsers;
use App\Models\Log;
use App\Models\RemoteSettings;
use App\Models\Queue;
use Illuminate\Support\Facades\DB;

class AddQueueCron extends Command
{
    public $periods = array(0 => 'Daily', 1 => 'Weekly', 2 => 'Monthly');
    public $backupItems = array(0 => 'Files', 1 => 'Databases', 2 => 'Files And Databases');
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'addqueue:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->info('Queue starting...');
        $this->info(date('d-m-Y h:i:s'));
        $deactiveHostings = Hosting::where('status', 0)->get();
        foreach($deactiveHostings as $item){
            $affectedHosting = DB::table('schedule')->where('hid', $item->id)->delete();
        }
        //$affected1 = DB::update('update models set sort = ? where id = ?',[$model->sort_intown, $temp->id]);
        $schedule = Schedule::all();
        $cont = false;
        foreach($schedule as $item){
            if ($item->period == 0) $cont = true;
            else if ($item->period == 1 && date('w') == 1) $cont = true;
            else if ($item->period == 2 && date('d') == "01") $cont = true;
            if ($cont == true){
                $remote = RemoteSettings::Find($item->remoteId);
                $hosting = Hosting::Find($item->remoteId);
                $savedb = new Queue;
                $savedb->locked = 0;
                $savedb->hid = $item->hid;
                $savedb->hostingname = $hosting->name;
                $savedb->schid = $item->id;
                $savedb->backupItems = $item->backupItems;
                $savedb->remoteip = $remote->remoteip;
                $savedb->remotelogin = $remote->remotelogin;
                $savedb->remotepass = $remote->remotepass;                
                $savedb->remoteport = $remote->remoteport;
                $savedb->remotetype = $remote->remotetype;
                $savedb->path = $hosting->path;
                $savedb->dbpath = $hosting->dbpath;
                $savedb->remotepath = $hosting->remotepath;
                $savedb->save();
                $this->info($item);
            }               
            $cont = false;
        }
        //return 'hebele';
        
    }
}