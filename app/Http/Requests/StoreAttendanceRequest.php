<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAttendanceRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'action' => 'required|in:clock_in,start_break,end_break,clock_out',
            'time' => 'required|date',
            'location_id' => 'required|uuid|exists:locations,id',
            'location_name' => 'required|string|max:255',
        ];
    }
}
