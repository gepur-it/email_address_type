<?php
/**
 * @author: Marina Mileva <m934222258@gmail.com>
 * @since: 18.05.18 16:05
 */

namespace GepurIt\EmailAddress\Tests;

use GepurIt\EmailAddress\EmailAddress;
use PHPUnit\Framework\TestCase;

/**
 * Class EmailTest
 * @package GepurIt\EmailAddress\tests
 */
class EmailTest extends TestCase
{

    /**
     * @dataProvider dataProvider
     */
    public function testPrepare($assertion, $address)
    {
        $email = new EmailAddress($address);
        $this->assertEquals($assertion, $email->getAddress());
    }

    public function testGetAddress()
    {
        $email = new EmailAddress('cool@swag.raccon');
        $this->assertEquals('cool@swag.raccon', $email->getAddress());
    }

    public function testToString()
    {
        $email = new EmailAddress('cool@swag.raccon');
        $this->assertEquals('cool@swag.raccon', sprintf('%s', $email));
    }

    /**
     * @return array
     */
    public function dataProvider()
    {
        return [
            'trim all not allowed' => ['rrrs465@fkf.dd', '   rrrs465@fkf.dd,  ,
            .  .'],
            'and to lower case' => ['rzzz.rs_465@fkf.dd', 'rZZZ.rs_465@fkf.dd   '],
        ];
    }
}