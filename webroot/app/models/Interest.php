<?php


namespace app\models;


use app\Db;

class Interest
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    function __construct($id = null, $name = null)
    {
        $this->id = $id;
        $this->name = $name;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @param Db $db
     * @param int $interestId
     * @return Interest
     */
    public static function find($db, $interestId)
    {
        $conn = $db->getConnection();
        $stmt = $conn->prepare('SELECT name FROM interest_reason i WHERE i.id = ?');
        $stmt->bind_param('s', $interestId);
        if ($stmt->execute()) {
            $resultSet = $stmt->get_result();
            $resultArray = $resultSet->fetch_array(MYSQLI_ASSOC);
            return new Interest($interestId, $resultArray['name']);
        }
        exit($conn->connect_error . ' DB error fetching membership type');
    }
}
