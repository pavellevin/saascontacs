<?php

namespace App\Imports;

use App\Models\ApiKlaviya;
use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Hash;

class UsersImport implements ToModel, WithHeadingRow
{
//    public $apiKlaviya;
//
//    public function __construct(ApiKlaviya $apiKlaviya)
//    {
//        $this->apiKlaviya = $apiKlaviya;
//    }
//
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        $apiKlaviya = new ApiKlaviya();

        $apiKlaviya->processAddMembersToList($row);

        return new User([
            'name' => $row['name'],
            'email' => $row['email'],
            'phone' => $row['phone'],
            'password' => Hash::make(rand(1, 10)),
        ]);
    }
}
