<?php
namespace CarloNicora\Minimalism\Services\Firebase;

use CarloNicora\Minimalism\Abstracts\AbstractService;
use CarloNicora\Minimalism\Services\Path;
use Exception;
use JsonException;
use Kreait\Firebase\Exception\FirebaseException;
use Kreait\Firebase\Exception\MessagingException;
use Kreait\Firebase\Factory;
use Kreait\Firebase\Messaging\AndroidConfig;
use Kreait\Firebase\Messaging\ApnsConfig;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase\Messaging\Notification;
use Kreait\Firebase\Messaging\WebPushConfig;

class Firebase extends AbstractService
{
    /**
     * firebase constructor.
     * @param Path $path
     * @param string $MINIMALISM_SERVICES_FIREBASE_KEY
     * @param string $MINIMALISM_SERVICES_FIREBASE_URL
     */
    public function __construct(
        private Path $path,
        private string $MINIMALISM_SERVICES_FIREBASE_KEY,
        private string $MINIMALISM_SERVICES_FIREBASE_URL
    ) {
    }

    /**
     * @param string $deviceId
     * @param string $title
     * @param string $body
     * @param string $action
     * @param string|null $imageUrl
     * @return array
     * @throws FirebaseException
     * @throws MessagingException
     */
    public function sendMessage(
        string $deviceId,
        string $title,
        string $body,
        string $action,
        ?string $imageUrl=null,
    ): array
    {
        $factory = (new Factory())
            ->withServiceAccount($this->path->getRoot() . $this->MINIMALISM_SERVICES_FIREBASE_KEY)
            ->withProjectId($this->MINIMALISM_SERVICES_FIREBASE_URL);
        $messaging = $factory->createMessaging();

        $apnsConfig = ApnsConfig::fromArray([
            'aps' => [
                'category' => $action,
            ],
        ]);
        $androidConfig = AndroidConfig::fromArray([
            'notification' => [
                'title' => $title,
                'body' => $body,
                'click_action' => $action,
            ],
        ]);
        $webPushConfig = WebPushConfig::fromArray([
            'fcm_options' => [
                'link' => $action,
            ],
        ]);

        $message = CloudMessage::withTarget(
                type: 'token',
                value: $deviceId,
            )->withNotification(
                Notification::create(
                    title: $title,
                    body: $body,
                    imageUrl: $imageUrl,
                ),
            )->withApnsConfig($apnsConfig)
            ->withAndroidConfig($androidConfig)
            ->withWebPushConfig($webPushConfig);

        return $messaging->send($message);
    }
}