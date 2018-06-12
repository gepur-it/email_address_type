<?php
/**
 * @author: Marina Mileva m934222258@gmail.com
 * @since: 17.05.18 14:55
 */

namespace GepurIt\EmailAddress;

/**
 * Class EmailHelper
 * @package GepurIt\EmailAddress
 */
class EmailHelper
{
    /**
     * @param EmailAddress $email
     * @return string
     */
    public function getEmailDomain(EmailAddress $email)
    {
        $e = explode('@', $email->getAddress());

        return end($e);
    }
}