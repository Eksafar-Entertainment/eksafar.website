<?php

namespace App\Imports;

use App\Models\Contact;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Validators\Failure;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsErrors;


class ContactImport implements ToModel, WithValidation,SkipsOnFailure, SkipsOnError
{
    use Importable, SkipsFailures, SkipsErrors;
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        //dd($row);
        return new Contact([
            //
            'name'     => $row[0],
            'phone'     => $row[1],
            'email'    => $row[2],
            'country' => "IN",
            'address' => $row[3],
        ]);
    }

    public function rules(): array
    {
        return [
            '0' => Rule::notIn(["", null]),
            '1' => Rule::notIn(["", null]),
            '2' => Rule::notIn(["", null]),
            '3' => Rule::notIn(["", null]),
        ];
    }
}
