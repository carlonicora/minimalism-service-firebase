<?php
namespace CarloNicora\Minimalism\Services\Firebase\Configurations;

use CarloNicora\Minimalism\Core\Services\Abstracts\AbstractServiceConfigurations;
use CarloNicora\Minimalism\Core\Services\Exceptions\ConfigurationException;

class FirebaseConfigurations extends AbstractServiceConfigurations {
    /** @var string  */
    public string $url;

    /** @var string  */
    public string $key;

    /**
     * firebaseConfigurations constructor.
     * @throws ConfigurationException
     */
    public function __construct() {
        if (!($this->key = getenv('MINIMALISM_SERVICES_FIREBASE_KEY'))) {
            throw new ConfigurationException('firebase', 'MINIMALISM_SERVICES_FIREBASE_KEY is a required configuration');
        }

        if (!($this->url = getenv('MINIMALISM_SERVICES_FIREBASE_URL'))) {
            $this->url = 'https://fcm.googleapis.com/fcm/send';
        }
    }
}