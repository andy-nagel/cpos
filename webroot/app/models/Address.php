<?php


namespace app\models;


use app\Db;

class Address
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $street1;

    /**
     * @var string
     */
    private $street2;

    /**
     * @var string
     */
    private $city;

    /**
     * @var string
     */
    private $state;

    /**
     * @var string
     */
    private $zipcode;

    public function __construct($street1, $street2, $city, $state, $zipcode)
    {
        $this->street1 = $street1;
        $this->street2 = $street2;
        $this->city = $city;
        $this->state = $state;
        $this->zipcode = $zipcode;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getStreet1(): string
    {
        return $this->street1;
    }

    /**
     * @param string $street1
     */
    public function setStreet1(string $street1)
    {
        $this->street1 = $street1;
    }

    /**
     * @return string
     */
    public function getStreet2(): string
    {
        return $this->street2;
    }

    /**
     * @param string $street2
     */
    public function setStreet2(string $street2)
    {
        $this->street2 = $street2;
    }

    /**
     * @return string
     */
    public function getCity(): string
    {
        return $this->city;
    }

    /**
     * @param string $city
     */
    public function setCity(string $city)
    {
        $this->city = $city;
    }

    /**
     * @return string
     */
    public function getState(): string
    {
        return $this->state;
    }

    /**
     * @param string $state
     */
    public function setState(string $state)
    {
        $this->state = $state;
    }

    /**
     * @return string
     */
    public function getZipcode(): string
    {
        return $this->zipcode;
    }

    /**
     * @param string $zipcode
     */
    public function setZipcode(string $zipcode)
    {
        $this->zipcode = $zipcode;
    }

    /**
     * @param Db $db
     */
    public function save($db)
    {
        $connection = $db->getConnection();
        $stmt = $connection->prepare('INSERT INTO address VALUES (null, ?, ?, ?, ?, ?)');
        $stmt->bind_param('sssss', $this->street1, $this->street2, $this->city, $this->state, $this->zipcode);
        $stmtResult = $stmt->execute();
        if ($stmtResult) {
            $this->id = $stmt->insert_id;
        } else {
            die("Error saving address to DB");
        }
    }
}
