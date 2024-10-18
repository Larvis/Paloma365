<?php


use Illuminate\Foundation\Http\FormRequest;
use OpenApi\Attributes as OA;

#[OA\RequestBody(
    request: 'BookingRequestBody',
    required: true,
    content: new OA\JsonContent(ref: '#/components/schemas/BookingRequest')
)]

#[OA\Schema]
class BookingRequest extends FormRequest
{
    #[OA\Property(property: 'client_id', type: 'integer', example: 1)]
    #[OA\Property(property: 'room_id', type: 'integer', example: 1)]
    #[OA\Property(property: 'check_in_date', type: 'date', example: '2024-01-01')]
    #[OA\Property(property: 'check_out_date', type: 'date', example: '2024-01-05')]
    #[OA\Property(property: 'total_amount', type: 'integer', example: 1234)]

    /**
     * Determine if the user is authorized to make this request.
     */
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
            'client_id' => 'required|exists:clients,id',
            'room_id' => 'required|exists:rooms,id',
            'check_in_date' => 'required|date',
            'check_out_date' => 'required|date|',
            'total_amount' => 'required|numeric',
        ];
    }
}
