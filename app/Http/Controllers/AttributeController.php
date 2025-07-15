<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attribute;
use App\Models\AttributeValue;

class AttributeController extends Controller
{
    public function index()
    {
        return Attribute::with('values');
    }

    public function store(Request $request)
    {
        $attributes = Attribute::create([
            'name' => $request->name,
        ]);

        foreach($request->values as $value){

            $attributes->values()->create([
                "value"=> $value

            ]);

        }
        return response()->json(['message'=> 'Attribute and values stored successfully'],201);
    }

    public function show($id)
    {
        return Attribute::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $student = Attribute::findOrFail($id);
        $student->update($request->all());
        return $student;
    }

    public function destroy($id)
    {
        $student = Attribute::findOrFail($id);
        $student->delete();
        return response()->json(['message' => 'Student deleted']);
    }
}
