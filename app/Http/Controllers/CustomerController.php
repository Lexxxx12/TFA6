<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\View\View;

class CustomerController extends Controller
{
    public function index(): View
    {
        return view('customers.index', [
            'title' => 'Customer Accounts',
            'customers' => Customer::query()->orderBy('id')->get(),
        ]);
    }
}
