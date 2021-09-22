<?php

namespace App\Services;

use Klaviyo\Klaviyo as Klaviyo;
use Klaviyo\Model\ProfileModel as KlaviyoProfile;


class ApiKlaviya
{
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

        try {
            $response = $this->client->lists->addMembersToList(env('K_LIST'), $profile);
        } catch (Exception $e) {
            echo 'Выброшено исключение: ', $e->getMessage(), "\n";
        }
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

        try {
            $responce = $this->client->profiles->updateProfile($profileId['id'], $profile);
        } catch (Exception $e) {
            echo 'Выброшено исключение: ', $e->getMessage(), "\n";
        }
    }
}
