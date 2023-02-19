<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Invoice;
use App\Models\InvoiceItem;
use Stripe\StripeClient;
use App\Models\Payment;

class InvoiceEdit extends Component
{
    public $invoice_id;
    public $invoice;
    public $enableAddItem = false;
    public $name;
    public $quantity;
    public $price;

    public function mount() {
        $this->invoice = Invoice::findOrFail($this->invoice_id);
    }

    public function render()
    {
        return view('livewire.invoice-edit');
    }
    public function addNewItem(){
        $this->enableAddItem = !$this->enableAddItem;
    }
    public function saveNewItem() {
        InvoiceItem::create([
            'name' => $this->name,
            'price' => $this->price,
            'quantity' => $this->quantity,
            'invoice_id' => $this->invoice_id,
        ]);
        $this->name = '';
        $this->price = '';
        $this->quantity = '';

        flash()->addSuccess('Added!');
        return redirect()->route('invoice-detail', $this->invoice_id);
    }
    public function refund($payment_id){
        $payment = Payment::findOrFail($payment_id);
        if(strlen($payment->transaction_id) === 8){
            $payment->delete();
            flash()->addSuccess('Cash payment refunded!');
        }else{
            // $stripe = new \Stripe\StripeClient(
            //     'sk_test_51McnPUA7H92lEuxQ7r0SdRQ5fA1Vjluty65hczMPlhx1JLTpjMXQOOhTM3Mwq5JacubJQJJLflEBupvmzIsDqzbs00lLaSc9VI'
            //   );
            // $stripe->refunds->create([
            // 'charge' => 'ch_3MdHL6A7H92lEuxQ1JDinWGb',
            // ]);
            $stripe = new StripeClient(env('STRIPE_SECRET'));
            $stripe->refunds->create([
                'charge' => $payment->transaction_id,
            ]);
            $payment->delete();
            flash()->addSuccess('Stripe payment refunded!');
        }

        return redirect()->route('invoice-detail', $this->invoice_id);
    }
}
