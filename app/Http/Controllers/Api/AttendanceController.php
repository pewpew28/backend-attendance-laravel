<?php

// app/Http/Controllers/Api/AttendanceController.php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\GenerateQrRequest;
use App\Http\Requests\ValidateQrRequest;
use App\Http\Requests\StoreAttendanceRequest;
use App\Http\Resources\AttendanceResource;
use App\Http\Resources\LocationResource;
use App\Models\Attendance;
use App\Models\Location;
use App\Models\QrCode;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class AttendanceController extends Controller
{
    public function generateQr(GenerateQrRequest $request)
    {
        QrCode::where('location_id', $request->location_id)
            ->where('is_active', true)
            ->update(['is_active' => false]);

        $qr = QrCode::create([
            'location_id'  => $request->location_id,
            'qr_data'      => (string) Str::uuid(),
            'generated_at' => now(),
            'is_active'    => true,
        ]);

        return response()->json([
            'qr_data'     => $qr->qr_data,
        ]);
    }


    public function validateQr(ValidateQrRequest $request)
    {
        $qr = QrCode::where('qr_data', $request->qr_data)
            ->where('is_active', true)
            ->first();

        if (! $qr) {
            return response()->json(['message' => 'QR tidak valid'], 422);
        }

        return response()->json([
            'valid' => true,
            'location_id' => $qr->location_id,
            'location_name' => $qr->location->name,
        ]);
    }

    public function store(StoreAttendanceRequest $request)
    {
        $attendance = Attendance::create([
            'user_id' => Auth::id(),
            ...$request->validated(),
        ]);

        return new AttendanceResource($attendance);
    }

    public function today()
    {
        $data = Attendance::where('user_id', Auth::id())
            ->whereDate('time', today())
            ->orderBy('time')
            ->get();

        return AttendanceResource::collection($data);
    }

    public function history()
    {
        $data = Attendance::where('user_id', Auth::id())
            ->latest('time')
            ->paginate(20);

        return AttendanceResource::collection($data);
    }

    public function summary()
    {
        $data = Attendance::where('user_id', Auth::id())
            ->get()
            ->groupBy(fn($a) => $a->time->format('Y-m-d'));

        return response()->json($data);
    }

    public function status()
    {
        $last = Attendance::where('user_id', Auth::id())->latest('time')->first();

        return response()->json([
            'last_action' => $last?->action,
            'last_time' => $last?->time,
        ]);
    }

    public function locations()
    {
        return LocationResource::collection(
            Location::all()
        );
    }
}
