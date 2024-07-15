<?php

class Api
{
    private $db;

    public function __construct()
    {
        $database = new Database();
        $this->db = $database->getConnection();
    }

    public function getPosts()
    {
        $stmt = $this->db->query("SELECT * FROM posts");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getPost($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM posts WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function createPost($data)
    {
        $stmt = $this->db->prepare("INSERT INTO posts (title, content) VALUES (:title, :content)");
        $stmt->execute(['title' => $data['title'], 'content' => $data['content']]);
        return $this->getPost($this->db->lastInsertId());
    }

    public function updatePost($id, $data)
    {
        $stmt = $this->db->prepare("UPDATE posts SET title = :title, content = :content WHERE id = :id");
        $stmt->execute(['title' => $data['title'], 'content' => $data['content'], 'id' => $id]);
        return $this->getPost($id);
    }

    public function deletePost($id)
    {
        $stmt = $this->db->prepare("DELETE FROM posts WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return ['message' => 'Post deleted'];
    }
}