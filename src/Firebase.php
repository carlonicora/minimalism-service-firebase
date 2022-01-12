<?php
namespace CarloNicora\Minimalism\Services\Firebase;

use CarloNicora\Minimalism\Abstracts\AbstractService;
use JsonException;

class Firebase extends AbstractService
{
    /**
     * firebase constructor.
     * @param string $MINIMALISM_SERVICES_FIREBASE_KEY
     * @param string $MINIMALISM_SERVICES_FIREBASE_URL
     */
    public function __construct(
        private string $MINIMALISM_SERVICES_FIREBASE_KEY,
        private string $MINIMALISM_SERVICES_FIREBASE_URL
    ) {
        parent::__construct();
    }

    /**
     * @param string $deviceId
     * @param array $data
     * @return array
     * @throws JsonException
     */
    public function sendMessage(string $deviceId, array $data): array {
        $fields = [
            'to'=>$deviceId,
            'notification'=>$data
        ];

        $headers = [
            'Content-Type:application/json',
            'Authorization:key='. $this->MINIMALISM_SERVICES_FIREBASE_KEY
        ];

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $this->MINIMALISM_SERVICES_FIREBASE_URL);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($fields, JSON_THROW_ON_ERROR));

        $result = curl_exec($curl);
        $error = curl_error($curl);
        $responseCode = curl_getinfo($curl, CURLINFO_RESPONSE_CODE);
        curl_close($curl);

        if (!empty($error)) {
            return ['failure' => [0 => [$error]]];
        }

        if ($responseCode >= 400) {
            return ['failue' => [0 => [$responseCode . ': ' . $result]]];
        }

        return json_decode($result, true, 512, JSON_THROW_ON_ERROR);
    }
}