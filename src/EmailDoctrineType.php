<?php
/**
 * @author: Marina Mileva m934222258@gmail.com
 * @since: 17.05.18 14:53
 */

namespace GepurIt\EmailAddress;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\ConversionException;
use Doctrine\DBAL\Types\Type;

/**
 * Class EmailDoctrineType
 * @package GepurIt\EmailAddress
 */
class EmailDoctrineType extends Type
{
    const TYPE_NAME = 'email_address';

    /**
     * @param $value
     * @param AbstractPlatform $platform
     * @return mixed|null|string
     * @throws ConversionException
     */
    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        if (null === $value) {
            return null;
        }

        if (!$value instanceof EmailAddress) {
            throw new ConversionException('Expected '. EmailAddress::class.', got ' . gettype($value));
        }

        /** @var EmailAddress $value */
        $stringToSave = $value->getAddress();

        return $stringToSave;
    }

    /**
     * @param mixed $value
     * @param AbstractPlatform $platform
     * @return EmailAddress
     */
    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        if (null === $value || $value instanceof EmailAddress) {
            return $value;
        }

        $result = null;
        $result = parent::convertToPHPValue($value, $platform);

        if(is_string($value)) {
            $result = new EmailAddress($value);
        }

        return $result;
    }

    /**
     * Gets the SQL declaration snippet for a field of this type.
     *
     * @param array                                     $fieldDeclaration The field declaration.
     * @param \Doctrine\DBAL\Platforms\AbstractPlatform $platform         The currently used database platform.
     *
     * @return string
     */
    public function getSQLDeclaration(array $fieldDeclaration, AbstractPlatform $platform)
    {
        return 'VARCHAR(120)';
    }

    /**
     * @return string
     */
    public function __toString()
    {
        $e = explode('\\', get_class($this));

        return str_replace('DoctrineType', '', end($e));
    }

    /**
     * Gets the name of this type.
     *
     * @return string
     */
    public function getName()
    {
        return self::TYPE_NAME;
    }
}