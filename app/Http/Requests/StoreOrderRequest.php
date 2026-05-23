<?php
// app/Http/Requests/StoreOrderRequest.php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
class StoreOrderRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'user_id'          => 'required|integer|exists:users,id',
            'shipping_address' => 'required|string',
            'pelanggan_id'     => 'nullable|integer|exists:pelanggan,id',
            'items'            => 'required|array|min:1',
            'items.*.produk_id'=> 'required|integer|exists:produks,id',
            'items.*.quantity' => 'required|integer|min:1',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
        response()->json([
                'success' => false,
                'message' => 'Validation Error',
                'errors' => $validator->errors()
                ], 422
            )
        );
    }
    
    public function messages(): array
    {
        return [
            'user_id.exists'           => 'User tidak ditemukan',
            'items.required'           => 'Keranjang belanja kosong',
            'items.*.produk_id.exists' => 'Produk tidak ditemukan',
            'items.*.quantity.min'     => 'Jumlah minimal 1',
        ];
    }
}