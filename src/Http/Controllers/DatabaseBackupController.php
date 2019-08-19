<?php

namespace Amanatjuwel\DbDump\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use File;

class DatabaseBackupController extends Controller
{

    static $db_backup_folder = 'db_backup'; 

    public function __construct()
    {
        //$this->middleware('auth');
    }

    public function index()
    {
        
        $directories = Storage::disk('public')->files(self::$db_backup_folder);

        return view('db-dump::index',compact('directories'));
    }

    public function create()
    {

        $this->extractDatabase();

        return back()->with('success','Database Export Successfull');
        
    }


    /**
     * Take MySql Database backup 
     *
     * \App\Http\Controllers\DatabaseBackup\DatabaseBackupController::extractDatabase();
     * @return void
     */

    public static function extractDatabase()
    {

        //create backup folder if not exist
        $path = 'storage/app/public/'.self::$db_backup_folder;

        if(!File::isDirectory($path)){

            File::makeDirectory($path, 0777, true, true);

        }


        date_default_timezone_set('Asia/Dhaka');

        $filename = "backup-".date("Y-m-d-H-i-s").".sql";
        
        // use "mysqldump" isntead of "$mysqlPath" in server (worked on 7.2 version)
        $mysqldump_path = config('db-dump.mysqldump_path');

        $mysqlPath = (env('APP_ENV')=='local')? $mysqldump_path : "mysqldump";
        
        try{

            $command = "$mysqlPath --user=" . env('DB_USERNAME') ." --password=" . env('DB_PASSWORD') . " --host=" . env('DB_HOST') . " " . env('DB_DATABASE') . "  > " . storage_path() . "/app/public/".self::$db_backup_folder."/"  . $filename."  2>&1";
            $returnVar = NULL;
            $output  = NULL;
            exec($command, $output, $returnVar);

        }
        catch(Exception $e){

           //return redirect()->back()->with('success',$e->errorInfo);

        }

    }

    public function destroy(Request $request)
    {
        
        $filePath = 'storage/app/public/'.$request->file; 

        if(File::exists($filePath))
        {
            File::delete($filePath);
            return back()->with('success','File Deleted');
        }

        else
        {
            return back()->with('warning','Something Went Wrong');
        }

    }
}