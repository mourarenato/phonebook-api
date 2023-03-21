<?php

namespace App\Http\Controllers;

use App\Models\Phonebook;
use App\Models\User;
use App\Services\BuildReportService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class PhonebookController extends Controller
{
    public function createRecord(Request $request)
    {
        try {
            $data = $request->all();

            $validator = Validator::make($data, [
                'name' => 'required',
                'email' => 'required|email',
                'cpf' => 'required',
            ]);

            if ($validator->fails()) {
                throw new Exception($validator->errors());
            }

            Phonebook::create([
                'name' => $request->name,
                'email' => $request->email,
                'birthdate' => $request->birthdate,
                'cpf' => $request->cpf,
                'phones' => json_encode($request->phones),
            ]);
            Log::info('Record was successful added!');
            return response()->json([
                'success' => true,
                'message' => 'Record was successful added!',
            ], 200);
        } catch (Exception $e) {
            Log::error('Error when trying to record user', ['error' => $e->getMessage()]);
            return response()->json([
                'success' => false,
                'message' => 'Could not create record',
                'errors' => $e->getMessage()
            ], 500);
        }
    }

    public function updateRecord(Request $request)
    {
        try {
            $data = $request->all();

            $validator = Validator::make($data, [
                'email' => 'required|email',
            ]);

            if ($validator->fails()) {
                throw new Exception($validator->errors());
            }

            $userEmail = User::where('email', $request->email)->get();

            if (!empty($userEmail[0])) {
                throw new Exception('User already exists!');
            }

            Phonebook::where('email', $request->email)
                ->update([
                    'name' => $request->name,
                    'email' => $request->email,
                    'birthdate' => $request->birthdate,
                    'cpf' => $request->cpf,
                    'phones' => json_encode($request->phones),
                ]);

            Log::info('Record updated with success!');
            return response()->json([
                'success' => true,
                'message' => 'Record updated with success!',
            ], 200);
        } catch (Exception $e) {
            Log::error('Error when trying to update record', ['error' => $e->getMessage()]);
            return response()->json([
                'success' => false,
                'message' => 'Could not update record',
                'errors' => $e->getMessage()
            ], 500);
        }
    }

    public function deleteRecord(Request $request)
    {
        try {
            $data = $request->only('email');

            $validator = Validator::make($data, [
                'email' => 'required|email',
            ]);

            if ($validator->fails()) {
                throw new Exception($validator->errors());
            }

            $data = Phonebook::where('email', $request->email)->first();
            $data->delete();
            Log::info('Record deleted with success!');
            return response()->json([
                'success' => true,
                'message' => 'Record deleted with success!',
            ], 200);
        } catch (Exception $e) {
            Log::error('Error when trying to delete record', ['error' => $e->getMessage()]);
            return response()->json([
                'success' => false,
                'message' => 'Could not delete record',
                'errors' => $e->getMessage()
            ], 500);
        }
    }

    public function exportReport(Request $request)
    {
        try {
            $service = new BuildReportService();
            $service->dispatchBuildReportJob();
            Log::info('Report exported with success!');
            return response()->json([
                'success' => true,
                'message' => 'Report exported with success!',
            ], 200);
        } catch (Exception $e) {
            Log::error('Error when trying to export report', ['error' => $e->getMessage()]);
            return response()->json([
                'success' => false,
                'message' => 'Error when trying to export report',
                'errors' => $e->getMessage()
            ], 500);
        }
    }
}
