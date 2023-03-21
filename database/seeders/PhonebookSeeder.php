<?php

namespace Database\Seeders;

use App\Models\Phonebook;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PhonebookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Phonebook::create([
            'name' => 'Renato Moura',
            'email' => 'renatomoura77@gmail.com',
            'birthdate' => '21/03/1999',
            'cpf' => '236.486.430-53',
            'phones' => json_encode(['0' => '(21)98005-6578', '1' => '(48)3235-7890', '2' => '(14)3436-5779', '3' => '(21)97678-9096']),
        ]);

        Phonebook::create([
            'name' => 'Peter Josh',
            'email' => 'peterjosh@hotmail.com',
            'birthdate' => '12/05/1989',
            'cpf' => '765.239.130-07',
            'phones' => json_encode(['0' => '(21)93105-6178', '1' => '(48)2235-2290', '2' => '(14)3236-5774', '3' => '(21)94278-2196']),
        ]);

        Phonebook::create([
            'name' => 'Ana Mary',
            'email' => 'anamary@gmail.com',
            'birthdate' => '10/01/1979',
            'cpf' => '121.949.260-46',
            'phones' => json_encode(['0' => '(21)98665-6577', '1' => '(48)3634-7891', '2' => '(14)3136-5771', '3' => '(21)91678-9016']),
        ]);

        Phonebook::create([
            'name' => 'Maria Souza',
            'email' => 'mariasouza91@outlook.com',
            'birthdate' => '13/09/1959',
            'cpf' => '003.428.800-71',
            'phones' => json_encode(['0' => '(21)98605-6572', '1' => '(48)3232-7892', '2' => '(14)3430-5079', '3' => '(21)97979-9090']),
        ]);

        Phonebook::create([
            'name' => 'Caio Pedro',
            'email' => 'caiopedro32@outlook.com',
            'birthdate' => '07/07/1991',
            'cpf' => '717.646.350-60',
            'phones' => json_encode(['0' => '(21)98403-6276', '1' => '(48)3235-7791', '2' => '(14)3132-5279', '3' => '(21)97778-9996']),
        ]);
    }
}
