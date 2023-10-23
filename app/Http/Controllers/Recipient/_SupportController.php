<?php

namespace App\Http\Controllers\Recipient;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class _SupportController extends Controller
{
    public function index(){
        return view('recipient.support');
    }
}
