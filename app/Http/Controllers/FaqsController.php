<?php

namespace App\Http\Controllers;
use App\Models\FAQs;
use App\Services\ActivityLogger;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

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

    public function uploadImage(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Adjust the validation rules
        ]);

        $image = $request->file('image');
        $imageName = time() . '_' . $image->getClientOriginalName();

        // Store the image in the 'public/uploads' directory
        $image->storeAs('public/uploads', $imageName);

        // Return the URL of the stored image
        return response()->json(['location' => asset('storage/uploads/' . $imageName)]);
    }

    public function store(Request $request)
    {
        // Extract YouTube link from the textarea
        $answer = $request->input('answer');
        $youtubeLink = $this->extractYouTubeLink($answer);

        $faq = new FAQs();
        $faq->question = $request->question;
        $faq->answer = $request->answer;
        $faq->youtube_link = $youtubeLink; // Save the extr
        $faq->save();

        return redirect()->route('faqs')->with('success', 'FAQ created successfully');
    }
    
    private function extractYouTubeLink($text)
    {
        // Use regex to find YouTube links in the text
        preg_match('/(?:youtube\.com\/(?:[^\/\n\s]+\/\S+\/|(?:v|e(?:mbed)?)\/|\S*?[?&]v=)|youtu\.be\/)([a-zA-Z0-9_-]{11})/', $text, $matches);

        // Check if a YouTube link was found
        if (isset($matches[1])) {
            return 'https://www.youtube.com/embed/' . $matches[1];
        }

        return null; // Return null if no YouTube link found
    }
  
    public function show($id)
    {
        try {
            // Retrieve and show the specific item using the provided ID
            $faq = FAQs::findOrFail($id);

            return view('faqs.show', compact('faq'));
        } catch (Exception $e) {
            // Handle the exception, you can log it for debugging or display an error message to the user.
            return back()->with('error', 'An error occurred while fetching the FAQs: ' . $e->getMessage());
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
            $faq = FAQs::findOrFail($id);
            $faq->update($request->all());
    
            // Log activity
            ActivityLogger::log('Updated', $faq, 'F.A.Q updated');
            
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
    
            // Log activity
            ActivityLogger::log('Deleted', $faq, 'F.A.Q deleted');
            
            return redirect()->back()->with('success', 'FAQ deleted successfully.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }

    }

}
