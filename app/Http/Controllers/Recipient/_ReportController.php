<?php

namespace App\Http\Controllers\Recipient;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class _ReportController extends Controller
{
    public function index(){
        return view('recipient.reports');
    }
}
