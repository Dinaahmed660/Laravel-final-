<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Models\Testimonial;
use App\Traits\Common; 

class TestimonialController extends Controller
{
    use Common;
    private $columns = ['name','position', 'Content','published'];

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $testimonials = Testimonial::latest()->paginate(10);
        return view('Testimonials', compact('testimonials'))
        ->with('i',(request()->input('page',1)-1)*10);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $testimonial = Testimonial::get();
        return view('addTestimonials', compact('testimonial'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $messages= $this->messages();

        $data = $request->validate([
            'name'=>'required|string',
            'position'=>'required',
            'Content'=>'required|string',
        ], $messages);

        $fileName = $this->uploadFile($request->image, 'assets/images');
        $data['image']= $fileName;
        $data['published'] = isset($request->published);
        Testimonial::create($data);
        return 'your testi has been added , thanks';
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $testimonial = Testimonial::findOrFail($id);
        return view('Testimonials',compact('testimonial'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $testimonial = Testimonial::findOrFail($id);
        return view('editTestimonials',compact('testimonial'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $messages= $this->messages();

        $data = $request->validate([
            'name'=>'required|string',
            'position'=>'required',
            'Content'=>'required|string',
        ], $messages);

        $fileName = $this->uploadFile($request->image, 'assets/images');
        $data['image']= $fileName;
        $data['published'] = isset($request->published);

        Testimonial::where('id', $id)->update($data);
        return 'Updated';

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id):RedirectResponse
    {
        Testimonial::where('id', $id)->delete();
        return redirect('Testimonials');
    }
    /**
         * Restoring data of testimonials .
         */
    public function restore(string $id): RedirectResponse
    {
        Testimonial::where('id', $id)->restore();
        return redirect('Testimonials');
    }
    /**
             * Restoring data of testimonials .
             */
    public function messages(){
        return [
            'name.required'=>'name is required',
            'position.required'=> 'should be text',
            'Content.required'=> 'should be text',
        ];
    }
}
