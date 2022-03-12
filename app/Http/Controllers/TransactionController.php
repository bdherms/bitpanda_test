<?php

namespace App\Http\Controllers;

use App\Repo\Transaction;
use App\Http\Requests\StoreTransactionRequest;
use App\Http\Requests\UpdateTransactionRequest;
use Illuminate\Http\Request;
use App\Http\Requests\TransactionRequest;
use App\Models\Transaction as TransactionDB;
use Database\Factories\TransactionFactory;

class TransactionController extends Controller
{
    /**
     * @return \Illuminate\Http\Response
     */
    public function index(TransactionRequest $request, Transaction $transaction)
    {
        $validatedData = $request->validated();
        if($validatedData['source'] === "db"){
            $user = TransactionDB::all();
            $jsonUsers = [];
            collect($user)->map(function($u) use (&$jsonUsers){
                $u['source'] = 'db';
                array_push($jsonUsers, $u);
            });
            return json_encode($jsonUsers);

        } else if ($validatedData['source'] === "csv"){
            return $this->csvToJson('../transactions.csv');
        } else {
            throw new Exception("Source value `{$validatedData['source']}` is not valid.", 1);
        }
        $details = $transaction->details();
        dd($details);
    }

    private function csvToJson($fname) {
        try{
            $fp = fopen($fname, 'r');
        } catch (Exception) {
            throw new Exception("File `{$fname}` not found.", 1);
        }
        
        $key = fgetcsv($fp,"1024",",");
        array_push($key, 'source');
    
        $json = array();
        while ($row = fgetcsv($fp,"1024",",")) {
            $json[] = array_combine($key, $this->rowRefactor($row));
        }
        fclose($fp);
        return json_encode($json);
    }

    private function rowRefactor($row){
        array_push($row, 'csv');
        $row[0] = (int) $row[0];
        $row[3] = (int) $row[3];
        $date = date_create_from_format('Y-m-d H:i:s', $row[4]);
        $row[4] = $date->format('Y-m-d\TH:i:s.u\Z');
        $date = date_create_from_format('Y-m-d H:i:s', $row[5]);
        $row[5] = $date->format('Y-m-d\TH:i:s.u\Z');
        return $row;
    }
}
