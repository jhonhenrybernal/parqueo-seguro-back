<?php

namespace App\Http\Controllers;

use App\Models\Parking;
use Illuminate\Http\Request;

class ParkingController extends Controller
{
    public function index()
    {
        return Parking::all();
    }

    public function store(Request $request)
    {
        // Validar los datos entrantes
        $validated = $request->validate([
            'parkingName' => 'required|string|max:255',
            'legalRepresentative' => 'required|string|max:255',
            'address' => 'required|string|max:500',
            'isCovered' => 'required|in:yes,no',
            'levels' => 'required|integer|min:1',
            'spaces' => 'required|array',
            'spaces.*.level' => 'required|integer',
            'spaces.*.carSpaces' => 'required|integer|min:0',
            'spaces.*.bikeSpaces' => 'required|integer|min:0',
            'totals.totalCars' => 'required|integer|min:0',
            'totals.totalBikes' => 'required|integer|min:0',
            'totals.totalCombined' => 'required|integer|min:0',
            'image' => 'required|string|max:500',
        ]);

        // Crear un nuevo registro en la tabla parkings
        $parking = Parking::create([
            'name' => $validated['parkingName'],
            'legal_representative' => $validated['legalRepresentative'],
            'address' => $validated['address'],
            'is_covered' => $validated['isCovered'] === 'yes',
            'levels' => $validated['levels'],
            'spaces' => json_encode($validated['spaces']),
            'image' => $validated['image'],
            'total_cars' => $validated['totals']['totalCars'],
            'total_bikes' => $validated['totals']['totalBikes'],
            'total_combined' => $validated['totals']['totalCombined'],
        ]);

        return response()->json(['message' => 'Parqueadero registrado exitosamente', 'parking' => $parking], 201);
    }

    public function show($id)
    {
        $parking = Parking::find($id);

        if (!$parking) {
            return response()->json(['message' => 'Parqueadero no encontrado'], 404);
        }

        return response()->json($parking, 200);
    }

    public function update(Request $request, $id)
    {
        $parking = Parking::findOrFail($id);
        $parking->update($request->all());
        return response()->json($parking, 200);
    }

    public function destroy($id)
    {
        Parking::destroy($id);
        return response()->json(null, 204);
    }
}
