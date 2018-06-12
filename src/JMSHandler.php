<?php
/**
 * @author: Andrii yakovlev <yawa20@gmail.com>
 * @since: 29.05.18
 */

namespace GepurIt\EmailAddress;

use JMS\Serializer\Context;
use JMS\Serializer\GraphNavigator;
use JMS\Serializer\Handler\SubscribingHandlerInterface;
use JMS\Serializer\JsonDeserializationVisitor;
use JMS\Serializer\VisitorInterface;
use JMS\Serializer\XmlDeserializationVisitor;

/**
 * Class JMSHandler
 * @package GepurIt\PhoneNumber
 * @codeCoverageIgnore
 */
class JMSHandler implements SubscribingHandlerInterface
{
    /**
     * Return format:
     *
     *      [
     *          [
     *              'direction' => GraphNavigator::DIRECTION_SERIALIZATION,
     *              'format' => 'json',
     *              'type' => 'GepurIt\EmailAddress\EmailAddress',
     *              'method' => 'serializeEmailAddress',
     *          ],
     *      ]
     *
     * The direction and method keys can be omitted.
     *
     * @return array
     */
    public static function getSubscribingMethods()
    {
        $methods = [];

        foreach (['json', 'xml', 'yml'] as $format) {
            $methods[] = [
                'type'      => EmailAddress::class,
                'direction' => GraphNavigator::DIRECTION_DESERIALIZATION,
                'format'    => $format,
            ];
            $methods[] = [
                'type'      => EmailAddress::class,
                'format'    => $format,
                'direction' => GraphNavigator::DIRECTION_SERIALIZATION,
                'method'    => 'serializeEmailAddress',
            ];
        }

        return $methods;
    }

    /**
     * @param VisitorInterface $visitor
     * @param EmailAddress $emailAddress
     * @param array $type
     * @param Context $context
     * @return string
     */
    public function serializeEmailAddress(
        VisitorInterface $visitor,
        EmailAddress $emailAddress,
        array $type,
        Context $context
    ) {
        return $emailAddress->getAddress();
    }

    /**
     * @param XmlDeserializationVisitor $visitor
     * @param $data
     * @param array $type
     * @return EmailAddress|null
     */
    public function deserializeEmailAddressFromXml(XmlDeserializationVisitor $visitor, $data, array $type)
    {
        return new EmailAddress($data);
    }

    /**
     * @param JsonDeserializationVisitor $visitor
     * @param $data
     * @param array $type
     * @return EmailAddress|null
     */
    public function deserializeEmailAddressFromJson(JsonDeserializationVisitor $visitor, $data, array $type)
    {
        return new EmailAddress($data);
    }
}
