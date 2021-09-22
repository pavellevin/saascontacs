<?php

namespace App\Services;

use Klaviyo\Klaviyo as Klaviyo;
use Klaviyo\Model\ProfileModel as KlaviyoProfile;


class ApiKlaviya
{
    public $client;

    private function adapterForProfileKlaviyo($data)
    {
        return array(new KlaviyoProfile(
            array(
                'first_name' => $data['name'],
                '$email' => $data['email'],
                '$phone_number' => $data['phone'],
            )
        ));
    }

    public function __construct()
    {
        $this->client = new Klaviyo(config('api.kPrivateApiKey'), config('api.kPublicApiKey'));
    }

    public function processAddMembersToList($data)
    {
        $profile = $this->adapterForProfileKlaviyo($data);

        try {
            $response = $this->client->lists->addMembersToList(config('api.kList'), $profile);
        } catch (Exception $e) {
            echo 'Выброшено исключение: ', $e->getMessage(), "\n";
        }
    }

    public function processUpdateMembersToList($data)
    {
        $profileId = $this->client->profiles->getProfileIdByEmail($data['old_email']);

        $profile = $this->adapterForProfileKlaviyo($data);

        try {
            $responce = $this->client->profiles->updateProfile($profileId['id'], $profile);
        } catch (Exception $e) {
            echo 'Выброшено исключение: ', $e->getMessage(), "\n";
        }
    }
}
