<?php

namespace App\Http\Controllers;
use App\Models\FAQs;

use Illuminate\Http\Request;

class FaqsController extends Controller
{
    public function index(){
        try {
            $faqs = FAQs::all();

            return view('faqs.index', compact('faqs'));
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    public function create()
    {
        try {
            $faq = FAQs::all();

            return view('faqs.create', compact('faq'));
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    public function store(Request $request)
    {
        try {
            FAQs::create($request->all());

            // Redirect to the index or show view, or perform other actions
            return redirect()->route('faqs')->with('success', 'FAQ Successfully Added!');
        } catch (Exception $e) {
            // Handle the exception here, you can log it or return an error response
            return $e->getMessage();
        }
    }
    public function edit($id)
    {
        try {
            $faq = FAQs::findOrFail($id);
            
            return view('faqs.edit', compact('faq'));
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $ticket = FAQs::findOrFail($id);
            $ticket->update($request->all());
            
            return redirect()->route('faqs')->with('success', 'FAQ Successfully Updated!');
            // return redirect()->back()->with('success', 'Task Successfully Updated!');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $faq = FAQs::findOrFail($id);
            $faq->delete(); 
            
            // return redirect()->route('tickets')->with('success', 'Ticket Successfully Deleted!');
            
            return redirect()->back()->with('success', 'FAQ deleted successfully.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }

    }

}
