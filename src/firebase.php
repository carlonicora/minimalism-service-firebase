<?php
namespace carlonicora\minimalism\services\firebase;

use carlonicora\minimalism\core\services\abstracts\abstractService;
use carlonicora\minimalism\core\services\factories\servicesFactory;
use carlonicora\minimalism\core\services\interfaces\serviceConfigurationsInterface;
use carlonicora\minimalism\services\firebase\configurations\firebaseConfigurations;

class firebase extends abstractService {
    /** @var firebaseConfigurations  */
    private firebaseConfigurations $configData;

    /**
     * firebase constructor.
     * @param serviceConfigurationsInterface $configData
     * @param servicesFactory $services
     */
    public function __construct(serviceConfigurationsInterface $configData, servicesFactory $services) {
        parent::__construct($configData, $services);

        /** @noinspection PhpFieldAssignmentTypeMismatchInspection */
        $this->configData = $configData;
    }

    /**
     * @param string $deviceId
     * @param array $data
     * @return array
     */
    public function sendMessage(string $deviceId, array $data): array {
        $fields = [
            'to'=>$deviceId,
            'notification'=>$data
        ];

        $headers = [
            'Content-Type:application/json',
            'Authorization:key='.$this->configData->key
        ];

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $this->configData->url);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($fields, JSON_THROW_ON_ERROR, 512));

        $result = curl_exec($curl);
        curl_close($curl);

        return json_decode($result, true, 512, JSON_THROW_ON_ERROR);
    }
}