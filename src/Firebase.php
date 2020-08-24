<?php
namespace CarloNicora\Minimalism\Services\Firebase;

use CarloNicora\Minimalism\Core\Services\Abstracts\AbstractService;
use CarloNicora\Minimalism\Core\Services\Factories\ServicesFactory;
use CarloNicora\Minimalism\Core\Services\Interfaces\ServiceConfigurationsInterface;
use CarloNicora\Minimalism\Services\Firebase\Configurations\FirebaseConfigurations;
use JsonException;

class Firebase extends AbstractService {
    /** @var FirebaseConfigurations  */
    private FirebaseConfigurations $configData;

    /**
     * firebase constructor.
     * @param ServiceConfigurationsInterface $configData
     * @param ServicesFactory $services
     */
    public function __construct(ServiceConfigurationsInterface $configData, ServicesFactory $services) {
        parent::__construct($configData, $services);

        /** @noinspection PhpFieldAssignmentTypeMismatchInspection */
        $this->configData = $configData;
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