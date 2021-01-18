<?php


namespace app\models;


use app\Db;

class MembershipType
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $type;

    /**
     * @var float
     */
    private $cost;

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
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType(string $type)
    {
        $this->type = $type;
    }

    /**
     * @return float
     */
    public function getCost(): float
    {
        return $this->cost;
    }

    /**
     * @param float $cost
     */
    public function setCost(float $cost)
    {
        $this->cost = $cost;
    }

    /**
     * @param Db $db
     * @param $typeId
     * @return MembershipType
     */
    public static function find($db, $typeId)
    {
        $conn = $db->getConnection();
        $stmt = $conn->prepare('SELECT * FROM membership_type m WHERE m.id = ?');
        $stmt->bind_param('s', $typeId);
        if ($stmt->execute()) {
            $resultSet = $stmt->get_result();
            $resultArray = $resultSet->fetch_array(MYSQLI_ASSOC);
            $membershipType = new MembershipType();
            $membershipType->id = $resultArray['id'];
            $membershipType->type = $resultArray['type'];
            $membershipType->cost = $resultArray['cost'];
            return $membershipType;
        }
        exit($conn->connect_error . ' DB error fetching membership type');
    }
}
