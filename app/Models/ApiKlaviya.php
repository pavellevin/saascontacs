<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Klaviyo\Klaviyo as Klaviyo;
use Klaviyo\Model\ProfileModel as KlaviyoProfile;


class ApiKlaviya extends Model
{
    use HasFactory;

    public $client;

    public function __construct()
    {
        $this->client = new Klaviyo(env('K_PRIVATE_API_KEY'), env('K_PUBLIC_API_KEY'));
    }

    public function processAddMembersToList($profile)
    {
        $profile = array(new KlaviyoProfile(
            array(
                'first_name' => $profile['name'],
                '$email' => $profile['email'],
                '$phone_number' => $profile['phone'],
            )
        ));

        return $this->client->lists->addMembersToList(env('K_LIST'), $profile);
    }

    public function processUpdateMembersToList($profile)
    {
        $profileId = $this->client->profiles->getProfileIdByEmail($profile['old_email']);

        $profile = array(new KlaviyoProfile(
            array(
                'first_name' => $profile['name'],
                '$email' => $profile['email'],
                '$phone_number' => $profile['phone'],
            )
        ));

        return $this->client->profiles->updateProfile($profileId['id'], $profile);
    }
}
