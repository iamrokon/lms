<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Invoice;
// use LaravelDaily\Invoices\Invoice;
use LaravelDaily\Invoices\Classes\Buyer;
use LaravelDaily\Invoices\Classes\InvoiceItem;

class InvoiceController extends Controller
{
    public function index(){
        return view('invoice.index');
    }
    public function show($id){
        // $DBinvoice = Invoice::findOrFail($id);

        // $customer = new Buyer([
        //     'name' => $DBinvoice->user->name,
        //     'custom_fields' => [
        //         'email' => $DBinvoice->user->email,
        //     ],
        // ]);

        // $items = [];
        // foreach($DBinvoice->items as $item){
        //     $items[] = (new InvoiceItem())->title($item->name)->pricePerUnit($item->price)->quantity($item->quantity);
        // }

        // $invoice = \LaravelDaily\Invoices\Invoice::make()
        //     ->buyer($customer)
        //     ->addItems($items);

        // return $invoice->stream();
        return view('user.invoice.show', [
            'invoice' => Invoice::findOrFail($id),
        ]);
    }
}
