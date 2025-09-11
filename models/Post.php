<?php

class Post
{
    private int $id;
    private string $title;
    private string $content;
    private string $resume;
    private string $date;
    private ?string $name_user;

    public function __construct($data)
    {
        $this->id = $data['id'];
        $this->title = $data['title'];
        $this->content = $data['content'];
        $this->resume = $data['resume'];
        $this->date = $data['date'];
        $this->name_user = $data['name'];
    }

    public function getId()
    {
        return $this->id;
    }

    public function getTitle()
    {
        return $this->title;
    }
    public function getContent()
    {
        return $this->content;
    }

    public function getResume()
    {
        return $this->resume;
    }

    public function getDate()
    {
        return $this->date;
    }

    public function getNameUser()
    {
        return $this->name_user;
    }
}
