<?php

namespace App\Jobs;

use App\Models\Phonebook;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class BuildReportJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $timeout = 3600;
    public $tries = 1;

    public function handle(): void
    {
        $this->exportCSV();
    }

    public function exportCSV(): void
    {
        $phonebooks = Phonebook::all();

//        $headers = array(
//            'Content-Type' => 'text/csv'
//        );

        $filename =  public_path("files/report.csv");
        $handle = fopen($filename, 'w');

        fputcsv($handle, [
            "Name",
            "E-mail",
            "Birthdate",
            "CPF",
            "Phones"
        ]);

        foreach ($phonebooks as $phonebook) {
            fputcsv($handle, [
                $phonebook->name,
                $phonebook->email,
                $phonebook->birthdate,
                $phonebook->cpf,
                $phonebook->phones
            ]);

        }
        fclose($handle);
    }
}
