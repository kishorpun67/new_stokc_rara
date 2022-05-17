<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Order;
use App\Customer;
use Session;


class BillingController extends Controller
{
    public function billing()
    {
        $customer = Customer::get();
        Session::flash('page', 'billing');
        return view('admin.billing.view_billing', compact('customer'));
    }

    public function customerAllInvoice($id=null)
    {
        $customer = Customer::where('id', $id)->first();
        $sales = Order::with('ordrDetails')->where('id', $id)->first();
        Session::flash('page', 'billing');
        return view('admin.billing.billing_invoice', compact('customer'));
        
    }

    public function customerBillingPrint()
    {
        return view('admin.billing.bill_print');
    }
}
