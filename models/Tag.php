<?php
class Tag
{
    private int $id;
    private string $name;

    public function __construct($data)
    {
        $this->id = $data['id'];
        $this->name = $data['name'];
    }

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }
}
