<?php

namespace App\Imports;

use App\DataProfile;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class DataProfilesImport implements ToModel,  WithChunkReading, WithValidation, SkipsOnFailure, WithBatchInserts,ShouldQueue, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    use Importable, SkipsFailures;

    

    public function model(array $row)
    {
        ini_set('max_execution_time', 300);
        return new DataProfile([            
                
                'license'     => $row['license_number'],
                // 'address'     => $row[2], 
                // 'speciality'  => $row[3],
                // 'phone'       => $row[4],
                // 'name'        => $row[5],
                // 'content'     => $row[6],
                // 'in_progress' => $row[7],
                
            
        ]);
    }
    public function rules(): array
    {
        ini_set('max_execution_time', 300);
        return [
            'license_number' => Rule::unique('data_profiles', 'license'),
            // '0' => Rule::in() // Table name, field in your db
        ];
    }
    public function batchSize(): int
    {
        return 500;
    }
    public function chunkSize(): int
    {
        return 500;
    }
}

