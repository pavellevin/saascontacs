<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\UsersImport;
use App\Providers\RouteServiceProvider;


class ImportController extends Controller
{
    public function importView()
    {
        return view('import');
    }

    public function import()
    {
        Excel::import(new UsersImport, request()->file('file'));

        return redirect(RouteServiceProvider::HOME);
    }
}
