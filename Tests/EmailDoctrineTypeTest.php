<?php
/**
 * Created by PhpStorm.
 * User: zogxray
 * Date: 05.06.18
 * Time: 14:13
 */

namespace GepurIt\EmailAddress\Tests;


use Doctrine\DBAL\DBALException;
use Doctrine\DBAL\Types\ConversionException;
use GepurIt\EmailAddress\EmailAddress;
use GepurIt\EmailAddress\EmailDoctrineType;
use PHPUnit\Framework\TestCase;
use Doctrine\DBAL\Types\Type;
use Doctrine\DBAL\Platforms\AbstractPlatform;

/**
 * Class EmailDoctrineTypeTest
 * @package GepurIt\EmailAddress\Tests
 */
class EmailDoctrineTypeTest extends TestCase
{
    /**
     * @var EmailDoctrineType
     */
    protected $type;

    /**
     * @throws DBALException
     */
    public static function setUpBeforeClass()
    {
        Type::addType(EmailDoctrineType::TYPE_NAME, EmailDoctrineType::class);
    }

    /**
     * @throws DBALException
     */
    protected function setUp()
    {
        $this->type = Type::getType(EmailDoctrineType::TYPE_NAME);
    }


    public function testInstanceOf()
    {
        $this->assertInstanceOf(EmailDoctrineType::class, $this->type);
    }

    public function testGetName()
    {
        $this->assertSame(EmailDoctrineType::TYPE_NAME, $this->type->getName());
    }

    public function testGetSQLDeclaration()
    {
        /**@var AbstractPlatform|\PHPUnit_Framework_MockObject_MockObject $platform */
        $platform = $this->createMock(AbstractPlatform::class);

        $this->assertSame('VARCHAR(120)', $this->type->getSQLDeclaration([], $platform));
    }

    public function testToString()
    {
        $this->assertSame('Email', sprintf('%s', $this->type));
    }

    /**
     * @throws ConversionException
     */
    public function testConvertToDatabaseValueWithNull()
    {
        /**@var AbstractPlatform|\PHPUnit_Framework_MockObject_MockObject $platform */
        $platform = $this->createMock(AbstractPlatform::class);

        $this->assertNull($this->type->convertToDatabaseValue(null, $platform));
    }

    /**
     * @throws ConversionException
     */
    public function testConvertToDatabaseValueException()
    {
        /**@var AbstractPlatform|\PHPUnit_Framework_MockObject_MockObject $platform */
        $platform = $this->createMock(AbstractPlatform::class);

        $this->expectException(ConversionException::class);

        $this->type->convertToDatabaseValue(new \stdClass(), $platform);
    }

    /**
     * @throws ConversionException
     */
    public function testConvertToDatabaseValue()
    {
        /**@var AbstractPlatform|\PHPUnit_Framework_MockObject_MockObject $platform */
        $platform = $this->createMock(AbstractPlatform::class);

        $result = $this->type->convertToDatabaseValue(new EmailAddress('cool@swag.raccon'), $platform);

        $this->assertEquals('cool@swag.raccon', $result);
    }

    public function testConvertToPHPValueWithNull()
    {
        /**@var AbstractPlatform|\PHPUnit_Framework_MockObject_MockObject $platform */
        $platform = $this->createMock(AbstractPlatform::class);

        $this->assertNull($this->type->convertToPHPValue(null, $platform));
    }

    public function testConvertToPHPValueWithNullEmail()
    {
        /**@var AbstractPlatform|\PHPUnit_Framework_MockObject_MockObject $platform */
        $platform = $this->createMock(AbstractPlatform::class);

        $this->assertInstanceOf(EmailAddress::class, $this->type->convertToPHPValue(new EmailAddress('cool@swag.raccon'), $platform));
    }

    public function testConvertToPHPValue()
    {
        /**@var AbstractPlatform|\PHPUnit_Framework_MockObject_MockObject $platform */
        $platform = $this->createMock(AbstractPlatform::class);

        $this->assertInstanceOf(EmailAddress::class, $this->type->convertToPHPValue('cool@swag.raccon', $platform));
    }
}