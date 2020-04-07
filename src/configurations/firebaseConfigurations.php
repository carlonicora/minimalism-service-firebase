<?php
namespace carlonicora\minimalism\services\firebase\configurations;

use carlonicora\minimalism\core\services\abstracts\abstractServiceConfigurations;
use carlonicora\minimalism\core\services\exceptions\configurationException;

class firebaseConfigurations extends abstractServiceConfigurations {
    /** @var string  */
    public string $url;

    /** @var string  */
    public string $key;

    /**
     * firebaseConfigurations constructor.
     * @throws configurationException
     */
    public function __construct() {
        if (!($this->key = getenv('MINIMALISM_SERVICES_FIREBASE_KEY')) !== false) {
            throw new configurationException('firebase', 'MINIMALISM_SERVICES_FIREBASE_KEY is a required configuration');
        }

        if (!($this->url = getenv('MINIMALISM_SERVICES_FIREBASE_URL')) !== false) {
            throw new configurationException('firebase', 'MINIMALISM_SERVICES_FIREBASE_URL is a required configuration');
        }
    }
}