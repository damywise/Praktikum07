<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request as Psr7Request;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class ApiController extends Controller
{
    public function memanggilAPI()
    {
        // token bearer
        $token = '3|pUODvg0CS4FfL7WzZ1W5lCAJQ3OwgjGsFqVt5RRl';
        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . $token
        ])
            ->get('http://localhost:8000/api/getAllUsersToo');
        $jsonData = $response->json();
        return response()->json($jsonData, $response->getStatusCode());


        // $client = new Client();
        // $headers = [
        //     'Authorization' => 'Bearer 2|cuNUBUpb3ksM1qJ28W9v2ag55rPGE3Pu0dINLAdj',
        //     'Cookie' => 'XSRF-TOKEN=eyJpdiI6Ik1kdTNYOGRXZDNiN3gvQnJpcEJQREE9PSIsInZhbHVlIjoiUjJsVEZ3Smd4NHhUbHI0THRPTXpXbDdBcVh1SlhrRHlvT2NtZDJrbVlvQndqTUxLcTRqQ1ltYUdPZlZuOENXTDVCU1pSbktmb2QwVzRvM01lSlhHdDJRc24yaVpuRTVaTlVuOEZuVEdRSFJ2ZDB5VnRrQll0UjdKWk44NzB2NFEiLCJtYWMiOiIzYjRmY2Q2NTQ1NmM2NzM0OGI4NTE5OGUwYzRlODUxM2ZjNDg5MDIzM2E0MTIyNTcxODM1YjUxNjcwNjMzMjc5IiwidGFnIjoiIn0%3D; laravel_session=eyJpdiI6IjdjTzhzNVJWSytBTC9IczV4S29ubnc9PSIsInZhbHVlIjoiOTlyN2dGdEJVUmZseVplUXIrazJaeUhJZ3RNcG9YVXN5djhGaG0yNVliVmpabE12VEpuYXRONXVoemdKR1BjamY4WmRZYTE0NHhYUDgyYitiOTlqKzR1aVpHSkMwSTEwazhqWVlmMGVhcGlHTVlmSGhHOEdKd0N3SW5IK0ZUdWgiLCJtYWMiOiI2ZGM2ZTkyMjIxNjAwMTdjZDg2MmZkMDJhNDNhZTk4NmFlMTY3M2M4YTdkNzNjN2Y4NWExN2NmYTRhNjVmZTg5IiwidGFnIjoiIn0%3D'
        // ];
        // $request = new Psr7Request('GET', 'localhost:8000/api/getAllUsersToo', $headers);
        // $res = $client->sendAsync($request)->wait();
        // echo $res->getBody();
    }

    public function getCollections()
    {
        $collections = DB::table('collections')
            ->select('namaKoleksi', 'jenisKoleksi')
            ->get();
        return response()->json($collections, 200);
    }

    public function getLibraryUsers()
    {
        $users = DB::table('users')
            ->get();
        return response()->json($users, 200);
    }

    public function getLibraryUsersPinjam()
    {
        $sql = "select `users`.`id`, `name` from `users` inner join `transactions` as `t` on `t`.`userIdPeminjam` = `users`.`id` group by `users`.`id`";

        $sth = DB::getPdo()->prepare($sql);
        $sth->execute();
        $data = $sth->fetchAll(\PDO::FETCH_OBJ);
        return response()->json($data, 200);
    }
}

// SELECT `users`.`name`, `transactions`.`userIdPeminjam`
// FROM `users` 
// 	LEFT JOIN `transactions` ON `transactions`.`userIdPetugas` = `users`.`id`;
