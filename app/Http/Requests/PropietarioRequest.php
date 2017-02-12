<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class PropietarioRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nombre' => 'required',
            'apellido' => 'required',
            'apartamentos'=> 'required',
        ];
    }

    public function messages()
    {
        return [
            'nombre.required' => 'Ingrese el nombre del propietario',
            'apellido.required'  => 'Ingrese el apellido del propietario',
            'apartamentos.required'  => 'Olvido seleccionar el apartamento',
        ];
    }
}
