<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;
use Illuminate\View\View;

class ClearDatabaseController extends Controller
{
    function index() : View {
        return view('admin.clear-database.index');
    }

    function clearDB() {

        try{
            // wipe database
            Artisan::call('migrate:fresh');
            // Seed default data
            Artisan::call('db:seed', ['--class' => 'UserSeeder']);
            Artisan::call('db:seed', ['--class' => 'SettingSeeder']);
            Artisan::call('db:seed', ['--class' => 'PaymentGatewaySettingSeeder']);
            Artisan::call('db:seed', ['--class' => 'SectionTitleSeeder']);
            Artisan::call('db:seed', ['--class' => 'MenuBuilderSeeder']);

            // delete updated files
            $this->deleteFiles();

            return response(['status' => 'success', 'message' => 'Database wiped successfully!']);


        }catch(\Exception $e){
            throw $e;
        }
    }

    function deleteFiles() : void {
        $path = public_path('uploads');
        $preserveFiles = ['avatar.png', 'media_67301fb7d0a23.png'];

        $allFiles = File::allFiles($path);

        foreach($allFiles as $file){
            $filename = $file->getFilename();

            if(!in_array($filename, $preserveFiles)){
                File::delete($file->getPathname());
            }
        }
    }
}
