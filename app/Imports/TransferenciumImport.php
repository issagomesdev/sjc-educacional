<?php

namespace App\Imports;

use App\Models\Transferencium;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class TransferenciumImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Transferencium([
          'ano_id' => $row[0],
          'escola_id' => $row[1],
          'new_escola_id' => $row[2],
          'old_turma_id' => $row[4],
          'aluno_id' => $row[5],
          'tipo_de_transferencia' => $row[6],
          'assinatura_id' => $row[7],
          'team_id' => $row[8],
        ]);
    }
}
