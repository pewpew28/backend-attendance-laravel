<?php
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
class ValidateQrRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'qr_data' => 'required|string',
            'scan_time' => 'required|date',
        ];
    }
}