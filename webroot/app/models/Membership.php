<?php

namespace app\models;

use app\Db;

class Membership
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var MembershipType
     */
    private $type;

    /**
     * @var \DateTime
     */
    private $start;

    /**
     * @var Person
     */
    private $primary;

    /**
     * @var Person
     */
    private $secondary;

    /**
     * @var Person[]
     */
    private $children = [];

    /**
     * @var Interest[]
     */
    private $interests = [];

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
     * @return MembershipType
     */
    public function getType(): MembershipType
    {
        return $this->type;
    }

    /**
     * @param MembershipType $type
     */
    public function setType(MembershipType $type)
    {
        $this->type = $type;
    }

    /**
     * @return \DateTime
     */
    public function getStart(): \DateTime
    {
        return $this->start;
    }

    /**
     * @param \DateTime $start
     */
    public function setStart(\DateTime $start)
    {
        $this->start = $start;
    }

    /**
     * @return Person
     */
    public function getPrimary(): Person
    {
        return $this->primary;
    }

    /**
     * @param Person $primary
     */
    public function setPrimary(Person $primary)
    {
        $this->primary = $primary;
    }

    /**
     * @return Person
     */
    public function getSecondary(): Person
    {
        return $this->secondary;
    }

    /**
     * @param Person $secondary
     */
    public function setSecondary(Person $secondary)
    {
        $this->secondary = $secondary;
    }

    /**
     * @return Person[]
     */
    public function getChildren(): array
    {
        return $this->children;
    }

    /**
     * @param Person[] $children
     */
    public function addChild(array $children)
    {
        $this->children[] = $children;
    }

    /**
     * @param Db $db
     * @param Person $person
     * @param String $memberType
     */
    public function addMember($db, $person, $memberType)
    {
        $connection = $db->getConnection();
        $stmt = $connection->prepare('INSERT INTO membership_person VALUES (?, ?, ?)');
        $stmt->bind_param(
            'sss',
            $this->id,
            $person->getId(),
            $memberType
        );
        $stmtResult = $stmt->execute();
        if (!$stmtResult) {
            exit("Error connecting {$memberType} user to membership in DB");
        }
    }

    /**
     * @return Interest[]
     */
    public function getInterests(): array
    {
        return $this->interests;
    }

    /**
     * @param Interest[] $interests
     */
    public function setInterests(array $interests)
    {
        $this->interests = $interests;
    }

    /**
     * @param Db $db
     * @param Interest $interest
     */
    public function addInterest($db, $interest)
    {
        $connection = $db->getConnection();
        $stmt = $connection->prepare('INSERT INTO membership_interests VALUES (?, ?)');
        $stmt->bind_param(
            'ss',
            $this->id,
            $interest->getId()
        );
        $stmtResult = $stmt->execute();
        if (!$stmtResult) {
            exit($connection->error . "   Error connecting interest to membership in DB");
        }
        $this->interests[] = $interest;
    }

    public function toEmailString()
    {
        $address = $this->getPrimary()->getAddress();
        $str = $this->getType()->getType() . ' Membership ' . $this->getStart()->format('M-d-Y') . "\n\nPrimary Member:\n"

            . $address->getStreet1() . "\n" . $address->getStreet1() . "\n"
            . $address->getCity() . ', ' . $address->getState() . ' ' . $address->getZipcode() . "\n\n";

        if ($this->getType()->getId() == 1) {
            $str .= "Secondary Member:\n" . $this->getSecondary()->getFirstName() . ' ' . $this->getSecondary()->getLastName() . "\n"
                . $this->getSecondary()->getPhone() . "\n" . $this->getSecondary()->getEmail() . "\n\n"
                . "Children:\n";
            foreach ($this->children as $child) {
                $str .= $child->getFirstName() . ' ' . $child->getLastName() . ', age ' . $child->getAge() . "\n";
            }
            $str .= "\n";
        }
        $str .= "Interests:\n";
        foreach ($this->getInterests() as $interest) {
            $str .= $interest->getName() . "\n";
        }
    }

    /**
     * @param Db $db
     */
    public function save($db)
    {
        $connection = $db->getConnection();
        $stmt = $connection->prepare('INSERT INTO membership VALUES (null, ?, ?)');
        $stmt->bind_param(
            'ss',
            $this->type->getId(),
            $this->start->format('Y-m-d H:i:s')
        );
        $stmtResult = $stmt->execute();
        if ($stmtResult) {
            $this->id = $stmt->insert_id;
        } else {
            exit("Error saving membership to DB");
        }
    }
}
