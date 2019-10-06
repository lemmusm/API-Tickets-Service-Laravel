<?php

namespace App\Http\Controllers;

use App\Models\versystem;

class VersystemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Versystem::select(
            'version_app',
            'version_registry',
            'version_name',
            'version_code'
        )
            ->get();
    }

}
