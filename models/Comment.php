<?php

class Comment
{
    // --- Propriétés ---
    private int $id;
    private string $content;
    private string $author;
    private string $date;

    // --- Constructeur ---
    public function __construct(array $data)
    {
        $this->id = $data['id'] ?? 0;
        $this->content = $data['content'] ?? '';
        $this->author = $data['author'] ?? 'Anonyme';
        $this->date = $data['date'] ?? date('d-m-Y'); // Si pas de date, utilise la date du jour
    }

    // --- Getters ---
    public function getId(): int
    {
        return $this->id;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function getAuthor(): string
    {
        return $this->author;
    }

    public function getDate(): string
    {
        return $this->date;
    }
}
