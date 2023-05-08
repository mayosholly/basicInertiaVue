<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index(){
        $customers = Customer::all()->map(function($customer){
            return [
                'id' =>$customer->id,
                'name'=>$customer->name
            ];
        });
        return inertia('Index', [
            'customers' => $customers
        ]);
    }
    public function create(){
        return inertia('Create');
    }

    public function store(Request $request){
        $validated = $request->validate([
                'name' => 'required',
                'email' => 'required|unique:customers|email',
                'phone' => 'required|unique:customers'
        ]);
        Customer::create($validated);
        return redirect()->route('customers.index')->with('message', 'You have Successfully Created');
    }

    public function edit(Customer $customer){
        return inertia('Edit', [
            'customer' => $customer
        ]);
    }

    public function update(Request $request, Customer $customer){
        $validated = $request->validate([
                'name' => 'required',
                'email' => 'required|email',
                'phone' => 'required'
        ]);
        $customer->update($validated);
        return redirect()->route('customers.index')->with('message', 'You have Successfully Updated');
    }

    public function destroy(Customer $customer){
        $customer->delete();
        return redirect()->route('customers.index')->with('message', 'You have Successfully Deleted');

    }
}
