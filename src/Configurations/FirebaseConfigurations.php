<?php
namespace CarloNicora\Minimalism\Services\Firebase\Configurations;

use CarloNicora\Minimalism\Core\Events\MinimalismErrorEvents;
use CarloNicora\Minimalism\Core\Services\Abstracts\AbstractServiceConfigurations;
use CarloNicora\Minimalism\Core\Services\Exceptions\ConfigurationException;
use Exception;

class FirebaseConfigurations extends AbstractServiceConfigurations {
    /** @var string  */
    public string $url;

    /** @var string  */
    public string $key;

    /**
     * firebaseConfigurations constructor.
     * @throws ConfigurationException
     * @throws Exception
     */
    public function __construct() {
        if (!($this->key = getenv('MINIMALISM_SERVICES_FIREBASE_KEY'))) {
            MinimalismErrorEvents::CONFIGURATION_ERROR('MINIMALISM_SERVICES_FIREBASE_KEY is a required configuration')
            ->throw(ConfigurationException::class);
        }

        if (!($this->url = getenv('MINIMALISM_SERVICES_FIREBASE_URL'))) {
            $this->url = 'https://fcm.googleapis.com/fcm/send';
        }
    }
}