<?php

namespace App\Http\Controllers;

use App\Models\Quotation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Notification;

class QuotationController extends Controller
{

    // public function store(Request $request)
    // {

       
    //     // $validated = $request->validate([
    //     //     'name' => 'required|string|max:255',
    //     //     'email' => 'required|email',
    //     //     'mobile_number' => 'required|string|max:20',
    //     //     'delivery_address' => 'required|string|max:255',
    //     //     'product_category' => 'required|string',
    //     //     'leather_category' => 'required|string',
    //     //     'units_of_product' => 'required|integer',
    //     //     'expected_delivery_time' => 'required|string',
    //     //     'design_prototype' => 'nullable|file|mimes:pdf,jpg,png|max:2048',
    //     //     'additional_request' => 'nullable|string',
    //     //     'qoutation_id' => 'required|exists:users,id',
    //     // ]);

    //     $quotation = new Quotation();
    //     $quotation->name = $request->name;
    //     $quotation->user_id  = Auth::id();
    //     $quotation->quotation_id  = $request->quotation_id;
    //     $quotation->email = $request->email;
    //     $quotation->phone = $request->phone;
    //     $quotation->delivery_address = $request->delivery_address;
    //     $quotation->product_category = $request->product_category;
    //     $quotation->leather_category = $request->leather_category;
    //     $quotation->units_of_product = $request->units_of_product;
    //     $quotation->expected_delivery_time = $request->expected_delivery_time;
    //     $quotation->design_prototype = $request->design_prototype;
    //     $quotation->additional_request = $request->additional_request;
    //     $quotation->save();

    //     $quotation->quote_id = 'K' . str_pad($quotation->id, 4, '0', STR_PAD_LEFT);
    //     // Save again with the quote_id
    //     $quotation->save();
        
    //     // Create notifications for suppliers and manufacturers
    //     Notification::createQuotationNotification($quotation, $request->quotation_id, $request->quotation_id);
        
    //     return redirect()->back()->with('success', 'Quotation request sent successfully!');
    // }
    
    public function store(Request $request)
{
    $quotation = new Quotation();

    $quotation->name = $request->name;
    $quotation->user_id = Auth::id();
    $quotation->quotation_id = $request->quotation_id;
    $quotation->email = $request->email;
    $quotation->phone = $request->phone;
    $quotation->delivery_address = $request->delivery_address;
    $quotation->product_category = $request->product_category;
    $quotation->leather_category = $request->leather_category;
    $quotation->units_of_product = $request->units_of_product;
    $quotation->expected_delivery_time = $request->expected_delivery_time;
    $quotation->additional_request = $request->additional_request;

     // Upload Design Prototype
    if ($request->hasFile('design_prototype')) {

        $file = $request->file('design_prototype');

        $filename = time() . '_' . $file->getClientOriginalName();

        $destinationPath = public_path('uploads/design_prototypes');

        // Create folder if it doesn't exist
        if (!file_exists($destinationPath)) {
            mkdir($destinationPath, 0777, true);
        }

        $file->move($destinationPath, $filename);

        // Save relative path in database
        $quotation->design_prototype = 'uploads/design_prototypes/' . $filename;
    }


    $quotation->save();

    // Generate Quote ID
    $quotation->quote_id = 'K' . str_pad($quotation->id, 4, '0', STR_PAD_LEFT);
    $quotation->save();

    // Notification
    Notification::createQuotationNotification(
        $quotation,
        $request->quotation_id,
        $request->quotation_id
    );

    return redirect()->back()->with('success', 'Quotation request sent successfully!');
}

}
