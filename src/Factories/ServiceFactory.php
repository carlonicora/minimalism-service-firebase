<?php
namespace CarloNicora\Minimalism\Services\Firebase\Factories;

use CarloNicora\Minimalism\Core\Services\Abstracts\AbstractServiceFactory;
use CarloNicora\Minimalism\Core\Services\Exceptions\ConfigurationException;
use CarloNicora\Minimalism\Core\Services\Factories\ServicesFactory;
use CarloNicora\Minimalism\Services\Firebase\Configurations\FirebaseConfigurations;
use CarloNicora\Minimalism\Services\Firebase\Firebase;

class ServiceFactory extends AbstractServiceFactory {
    /**
     * serviceFactory constructor.
     * @param ServicesFactory $services
     * @throws ConfigurationException
     */
    public function __construct(ServicesFactory $services) {
        $this->configData = new FirebaseConfigurations();

        parent::__construct($services);
    }

    /**
     * @param ServicesFactory $services
     * @return Firebase
     */
    public function create(ServicesFactory $services): Firebase {
        return new Firebase($this->configData, $services);
    }
}