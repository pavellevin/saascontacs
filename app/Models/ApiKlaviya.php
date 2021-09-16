<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Klaviyo\Klaviyo as Klaviyo;
use Klaviyo\Model\ProfileModel as KlaviyoProfile;


class ApiKlaviya extends Model
{
    use HasFactory;

    public function processAddMembersToList($profile)
    {

        $client = new Klaviyo(env('K_PRIVATE_API_KEY'), env('K_PUBLIC_API_KEY'));

        $profile = array(new KlaviyoProfile(
            array(
                'first_name' => $profile['name'],
                '$email' => $profile['email'],
                '$phone_number' => $profile['phone'],
            )
        ));

        $client->lists->addMembersToList(env('K_LIST'), $profile);
    }

    public function processUpdateMembersToList($profile)
    {

        $client = new Klaviyo(env('K_PRIVATE_API_KEY'), env('K_PUBLIC_API_KEY'));

        $profileId = $client->profiles->getProfileIdByEmail($profile['old_email']);
//       dd($client->profiles->getProfile( '01FFNE81Q7JPCZ4EVDGAGNPCD9' ));
        $profile = array(new KlaviyoProfile(
            array(
                'first_name' => $profile['name'],
                '$email' => $profile['email'],
                '$phone_number' => $profile['phone'],
            )
        ));

        $client->profiles->updateProfile($profileId['id'], $profile);
    }
}
