<?php
namespace carlonicora\minimalism\services\firebase\factories;

use carlonicora\minimalism\core\services\abstracts\abstractServiceFactory;
use carlonicora\minimalism\core\services\exceptions\configurationException;
use carlonicora\minimalism\core\services\factories\servicesFactory;
use carlonicora\minimalism\services\firebase\configurations\firebaseConfigurations;
use carlonicora\minimalism\services\firebase\firebase;

class serviceFactory extends abstractServiceFactory {
    /**
     * serviceFactory constructor.
     * @param servicesFactory $services
     * @throws configurationException
     */
    public function __construct(servicesFactory $services) {
        $this->configData = new firebaseConfigurations();

        parent::__construct($services);
    }

    /**
     * @param servicesFactory $services
     * @return firebase
     */
    public function create(servicesFactory $services): firebase {
        return new firebase($this->configData, $services);
    }
}