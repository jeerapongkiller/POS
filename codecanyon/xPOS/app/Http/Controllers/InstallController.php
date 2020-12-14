<?php

namespace App\Http\Controllers;

use App\User;
use DotEnvEditor\DotenvEditor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Hash;

class InstallController extends Controller
{

    /**
     * Show database blade view
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function database()
    {
        if(config('install.database') == 1){
            return redirect()->to('/install/mail');
        }
        $env = new DotenvEditor();
        $env->changeEnv([
           'APP_URL'    =>  request()->getHttpHost()
        ]);
        return view('install.mysql');
    }

    /**
     * Configure laravel cache using current input and migrate database
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function databaseSetup(Request $request)
    {

        $env = new DotenvEditor();
        $env->changeEnv([
            'DB_HOST' => $request->get('db_host'),
            'DB_PORT' => $request->get('db_port'),
            'DB_DATABASE' => '"' . $request->get('db_database_name') . '"',
            'DB_USERNAME' => '"' . $request->get('db_username') . '"',
            'DB_PASSWORD' => '"' . $request->get('db_password') . '"',
        ]);
        Artisan::call('config:cache');

        $isMigrate = Artisan::call('migrate');
        if($isMigrate == 0){
            $this->saveDatabaseEnv();
            return response()->json('Ok',200);
        }else{
            return response()->json('Error',500);
        }
    }


    /**
     * Show mail setup view
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function mail()
    {
        return view('install.mail');
    }

    /**
     * Configure laravel cache using current input
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function mailSetup(Request $request)
    {
        $env = new DotenvEditor();
        $env->changeEnv([
            'MAIL_HOST' => $request->get('host'),
            'MAIL_PORT' => $request->get('port'),
            'MAIL_USERNAME' => '"' . $request->get('username') . '"',
            'MAIL_PASSWORD' => '"' . $request->get('password') . '"',
            'MAIL_ENCRYPTION' => '"' . $request->get('encryption') != '' ?  $request->get('encryption') : null . '"',
            'MAIL' => 1
        ]);
        Artisan::call('config:cache');
        return redirect()->to('/install/localization');
    }

    /**
     * Skip mail setup
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function skipMail(Request $request)
    {
        $env = new DotenvEditor();
        $env->changeEnv([
            'MAIL' => 1
        ]);
        Artisan::call('config:cache');

        return redirect()->to('/install/admin');
    }

    /**
     * Show admin account blade view
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function admin()
    {
        $user = User::find(1);
        return view('install.admin', [
            'user' => $user
        ]);
    }

    /**
     * Create admin account
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function postAdmin(Request $request)
    {
        $user = new User();
        $user->name = $request->get('name');
        $user->email = $request->get('email');
        $user->password = Hash::make($request->get('password'));
        $user->role = 1;
        if ($request->hasFile('photo')) {
            $user->image = $request->file('photo')
                ->move('uploads/user', rand(100000, 900000) . '.' . $request->photo->extension());
        }
        if ($user->save()) {
            $env = new DotenvEditor();
            $env->changeEnv([
                'ADMIN' =>  1
            ]);
            Artisan::call('config:cache');
            return response()->json('Ok', 200);
        }
    }

    /**
     * Show localization view
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function localization()
    {
        return view('install.localization');
    }

    /**
     * Save localization by input value
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function saveLocal(Request $request)
    {
        $this->validate($request, [
            'timezone' => 'required|timezone'
        ]);
        $env = new DotenvEditor();
        $env->changeEnv([
            'TIMEZONE' => '"' . $request->get('timezone') . '"',
            'CURRENCY' => '"' . $request->get('currency') . '"'
        ]);
        Artisan::call('config:cache');
        return response()->json('Ok', 200);
    }

    /**
     * Show tax view
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function tax()
    {
        return view('install.tax');
    }

    /**
     * Save tax information
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function saveTax(Request $request)
    {
        $this->validate($request, [
            'tax' => 'required|numeric',
            'tin' => 'required'
        ]);

        $env = new DotenvEditor();
        $env->changeEnv([
            'TAX' => '"' . $request->get('tax') . '"',
            'TIN' => '"' . $request->get('tin') . '"'
        ]);
        Artisan::call('config:cache');
        return redirect()->to('/install/finish');
    }

    /**
     * Complete installation
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function finish()
    {
        $user = User::all();
        return view('install.finish', [
            'user' => $user
        ]);
    }

    public function toLogin(Request $request)
    {
        $env = new DotenvEditor();
        $env->changeEnv([
            'INSTALL' => 1
        ]);
        $exitCode = Artisan::call('config:cache');
        if ($exitCode == 0) {
            return redirect()->to('/login');
        } else {
            return redirect()->back();
        }
    }


    private function saveDatabaseEnv()
    {
        $env = new DotenvEditor();
        $env->changeEnv([
            'DATABASE' => 1
        ]);
        Artisan::call('config:cache');
    }
}
