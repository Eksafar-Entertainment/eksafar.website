<?php

namespace App\Imports;

use App\Models\Contact;
use Maatwebsite\Excel\Validators\Failure;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Illuminate\Validation\Rule;


class ContactsImport implements ToModel, SkipsOnFailure, SkipsOnError, SkipsEmptyRows
{
    use Importable;
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Contact([
            'name'     => $row[0],
            'phone'    => $row[1],
            'email' => $row[2],
            'address' => $row[3],
        ]);
    }

    public function isEmptyWhen(array $row): bool
    {
        return ($row[1] == "" || $row[1] == null)&&
               ($row[2] == "" || $row[2] == null);
    }

    /**
     * @param Failure[] $failures
     */
    public function onFailure(Failure ...$failures)
    {
        // Handle the failures how you'd like.
    }

    /**
     * @param \Throwable $e
     */
    public function onError(\Throwable $e)
    {
        // Handle the exception how you'd like.
    }
}
