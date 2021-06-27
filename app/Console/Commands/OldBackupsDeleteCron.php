<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Hosting;
use App\Models\Schedule;
use App\Models\RemoteSettings;

class OldBackupsDeleteCron extends Command
{
    private $conn_id;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'oldbackupdelete:cron';

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

    private function recursiveDelete($dir){
        if( !(@ftp_rmdir($this->conn_id,$dir) || @ftp_delete($this->conn_id,$dir)) )
        {
            # if the attempt to delete fails, get the file listing
            $filelist = @ftp_nlist($this->conn_id, $dir);
            # loop through the file list and recursively delete the FILE in the list
            foreach($filelist as $file)
            {
            //  return json_encode($filelist);
                $this->recursiveDelete($file);/***THIS IS WHERE I MUST RESEND ABSOLUTE PATH TO FILE***/
            }

            #if the file list is empty, delete the DIRECTORY we passed
            $this->recursiveDelete($dir);
        }
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $finishedHosts = array();
        $schedule = Schedule::all();
        foreach($schedule as $item){
            if(in_array($item->hid, $finishedHosts)) continue;
            $hosting = Hosting::Find($item->hid);
            $remote = RemoteSettings::Find($item->remoteId);
            $ftp_server = $remote->remoteip;
            $ftp_username = $remote->remotelogin;
            $ftp_pass = $remote->remotepass;
            $this->conn_id = ftp_connect($ftp_server);
            ftp_set_option($this->conn_id, FTP_TIMEOUT_SEC, 18000000);

            // login with username and password
            $login_result = ftp_login($this->conn_id, $ftp_username, $ftp_pass);
            echo $login_result."\n";
            ftp_set_option($this->conn_id, FTP_USEPASVADDRESS, false); // set ftp option
            ftp_pasv($this->conn_id, true); //make connection to passive mode
            $dirlist = ftp_nlist($this->conn_id, $hosting->remotepath);
            $daily = array(); $weekly = array(); $monthly = array();
            foreach($dirlist as $dir){
                if (strpos($dir, 'daily') !== false) { $daily[] = $dir; }
                if (strpos($dir, 'weekly') !== false) { $weekly[] = $dir; }
                if (strpos($dir, 'monthly') !== false) { $monthly[] = $dir; }
            }
            $daily = array_reverse($daily); $weekly = array_reverse($weekly); $monthly = array_reverse($monthly);
            if (count($daily) > 4) for($i = count($daily)-3; $i < count($daily); $i++){ $this->recursiveDelete($daily[$i]); }
            if (count($weekly) > 4) for($i = count($weekly)-3; $i < count($weekly); $i++){ $this->recursiveDelete($weekly[$i]); }
            if (count($monthly) > 3) for($i = count($monthly)-2; $i < count($monthly); $i++){ $this->recursiveDelete($monthly[$i]); }
            var_dump($dirlist);
            //return 0;
            ftp_close($this->conn_id);
            $finishedHosts[] = $item->hid;
        }

        
    }
}
