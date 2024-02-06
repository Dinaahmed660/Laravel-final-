<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Models\Car;
use App\Models\Category;
use App\Traits\Common; 

class CarController extends Controller
{
    use Common;
    private $columns = ['Title', 'Content','Luggage','Doors','Passangers','Price'];
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cars = Car::get();
        return view('Cars', compact('cars'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::select('id', 'categoryname')->get();
        return view('addCar', compact('categories'));
    
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $messages= $this->messages();

        $data = $request->validate([
            'Title'=>'required|string',
            'Content'=>'required|string',
            'Luggage'=>'required',
            'Doors'=>'required',
            'Passangers'=>'required',
            'Price'=>'required',
            'image' => 'sometimes|mimes:png,jpg,jpeg|max:2048',
            'category_id' => 'required',
        ], $messages);

        $fileName = $this->uploadFile($request->image, 'assets/images');
        $data['image']= $fileName;
        $data['Active'] = isset($request->Active);
        Car::create($data);
        return 'done';
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $car = Car::findOrFail($id);
        return view('Dashboard/Single',compact('car'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $car = Car::findOrFail($id);
        $categories = Category::select('id', 'categoryname')->get();
        return view('editCar',compact('car','categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $messages= $this->messages();
        $data = $request->validate([
            'Title'=>'required|string',
            'Content'=>'required|string',
            'Luggage'=>'required',
            'Doors'=>'required',
            'Passangers'=>'required',
            'Price'=>'required',
            'image' => 'sometimes|mimes:png,jpg,jpeg|max:2048',
            'category_id' => 'required',
        ], $messages);
       
        $data['Active'] = isset($request->Active);

            // update image if new file selected
        if($request->hasFile('image')){
            $fileName = $this->uploadFile($request->image, 'assets/images');
            $data['image']= $fileName;
        }
            // return data
            Car::where('id', $id)->update($data);
        return 'Updated';
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id):RedirectResponse
    {
        Car::where('id', $id)->delete();
        return redirect('Cars');
    }
    public function trashed(){
        $cars = Car::onlyTrashed()->get();
        return view('trashed', compact('cars'));
    }

    public function restore(string $id): RedirectResponse
    {
        Car::where('id', $id)->restore();
        return redirect('Cars');
    }

    public function messages(){
        return [
            'Title.required'=>'Title is required',
            'Content.required'=> 'should be text',
            'Luggage.required'=> 'Enter how many luggage',
            'Doors.required'=> 'Enter num of doors',
            'Passangers.required'=> 'Passangers should be num',
            'Price.required'=> 'Price is required',
        ];
    }
}
