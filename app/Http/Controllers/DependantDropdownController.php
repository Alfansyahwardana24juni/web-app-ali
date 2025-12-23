<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse; // Tambahkan ini
use Laravolt\Indonesia\Facade as Indonesia;

// Perbaiki nama class dari Dependant menjadi Dependent
class DependantDropdownController extends Controller
{
    /**
     * Get all provinces
     */
    public function provinces(): JsonResponse
    {
        // Kembalikan data provinsi dalam format JSON {id: name}
        $provinces = Indonesia::allProvinces();
        return response()->json($provinces->pluck('name', 'id'));
    }

    /**
     * Get cities by province ID
     */
    public function cities(Request $request): JsonResponse
    {
        $provinceId = $request->input('id');
        $cities = Indonesia::findProvince($provinceId, ['cities'])->cities;
        return response()->json($cities->pluck('name', 'id'));
    }

    /**
     * Get districts by city ID
     */
    public function districts(Request $request): JsonResponse
    {
        $cityId = $request->input('id');
        $districts = Indonesia::findCity($cityId, ['districts'])->districts;
        return response()->json($districts->pluck('name', 'id'));
    }

    /**
     * Get villages by district ID
     */
    public function villages(Request $request): JsonResponse
    {
        $districtId = $request->input('id');
        $villages = Indonesia::findDistrict($districtId, ['villages'])->villages;
        return response()->json($villages->pluck('name', 'id'));
    }
}
