<?php
/**
 * Created by PhpStorm.
 * User: zogxray
 * Date: 05.06.18
 * Time: 13:55
 */

namespace GepurIt\EmailAddress\Tests;


use GepurIt\EmailAddress\EmailAddress;
use GepurIt\EmailAddress\EmailHelper;
use PHPUnit\Framework\TestCase;

/**
 * Class EmailHelperTest
 * @package GepurIt\EmailAddress\Tests
 */
class EmailHelperTest extends TestCase
{
    /**
     * @dataProvider dataProvider
     */
    public function testGetEmailDomain($assertion, $address)
    {
        $helper = new EmailHelper();
        $this->assertEquals($assertion, $helper->getEmailDomain(new EmailAddress($address)));
    }

    /**
     * @return array
     */
    public function dataProvider()
    {
        return [
            ['fkf.dd', 'rrrs465@fkf.dd'],
            ['fkf.dd', 'rzzz.rs@_465@fkf.dd'],
            ['fkf.dd', 'fkf.dd'],
        ];
    }
}