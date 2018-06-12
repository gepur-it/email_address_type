<?php
/**
 * @author: Marina Mileva m934222258@gmail.com
 * @since: 17.05.18 14:53
 */

namespace GepurIt\EmailAddress;

/**
 * Class Email
 * @package GepurIt\EmailAddress
 */
class EmailAddress
{
    /** @var string */
    private $address;

    /**
     * Email constructor.
     * @param string $address
     */
    public function __construct(string $address)
    {
        $this->address = mb_strtolower(trim($address, " \t\n\r\0\x0B,."));
    }

    /**
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->address;
    }
}