<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        {
            $contacts = Message::get();
            return view('Messages',compact('contacts'));
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $messagecontact = Message::get();
        return view('Dashboard/contact', compact('messagecontact'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $messages= $this->messages();
        $data = $request->validate([
            'Email'=>'required|string',
            'Content'=>'required|string',
        ], $messages);

        Message::create($data);
        return 'your testi has been added , thanks';
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        {
            $contact = Message::findOrFail($id);
            return view('showMessage', compact('contact'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
         * Remove the specified resource from storage.
         */
    public function destroy(string $id):RedirectResponse
    {
        Message::where('id', $id)->delete();
        return redirect('Messages');
    }

    public function messages(){
        return [
            'Email.required'=>'Enter your email',
            'Content.required'=> 'Enter the content',
        ];
    }
}
