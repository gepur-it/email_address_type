---
How to write doctrine type "email" 
---

### to your Symfony project

Add ```email:  GepurIt\EmailAddress\EmailDoctrineType``` to types of dbal in doctrine. See example:

```yaml
# Doctrine Configuration
doctrine:
    dbal:
        default_connection: default
        connections:
            default:     
            some_other:
                
        types:
            email:  GepurIt\EmailAddress\EmailDoctrineType

```

SQL type = 'VARCHAR(120)'.

Example of entity:

```php
namespace YourBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as JMS;
use Symfony\Component\Validator\Constraints as Assert;
use GepurIt\EmailAddress\Email

/** Class EntityWithEmailField
  * @package YourBundle\Entity
  *
  * @ORM\Table(
  *     name="your_table_name",
  *     options={"collate"="utf8mb4_unicode_ci", "charset"="utf8mb4"}
  * )
  * @ORM\Entity(repositoryClass="YourBundle\Repository\EntityWithEmailFieldRepository")
  * @ORM\HasLifecycleCallbacks()
  * @codeCoverageIgnore
  */
class EntityWithEmailField
{
    /**
      * @var Email
      *
      * @ORM\Column(name="email_address_column", type="email_address")
      * @JMS\Expose()
      * @JMS\Groups({"full", "Default"})
      */
    private $email;

    /**
     * @return Email
     */
    public function getEmail()
    {
        return $this->email;
    }
    
    /** 
     * @param Email $email
     */
    public function setEmail(Email $email)
    {
        $this->email = $email;
    }
}
```

How to use service EmailHelper - see example:

```yaml
services:
    email.helper:
        class: GepurIt\EmailAddress\EmailHelper
        public: true

```

