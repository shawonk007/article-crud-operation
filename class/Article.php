<?php
namespace Article;
class Article {
  private $connection;
  private $table = 'articles';

  public function __construct($db) {
    $this->connection = $db;
  }

  public function index() {
    $query = "SELECT * FROM articles";
    $result = $this->connection->query($query);
    if ($result->num_rows > 0) {
      $articles = array();
      while ($article = $result->fetch_assoc()) {
        $articles[] = $article;
      }
      return $articles;
    } else {
      return array();
    }
  }

  public function create($title, $desc, $image, $slug, $tags, $status) {
    $query = "INSERT INTO " . $this->table . "
    (article_title, article_description, article_image, article_slug, article_tags, article_status, created_at, updated_at)
    VALUES (?, ?, ?, ?, ?, ?, NOW(), NOW())";
    $statement = $this->connection->prepare($query);
    $statement->bind_param("ssssss", $title, $desc, $image['imgName'], $slug, $tags, $status);
    if ($statement->execute()) {
      return true;
    } else {
      return false;
    }
  }

  public function edit($id) {
    $query = "SELECT * FROM articles WHERE id = ?";
    $statement = $this->connection->prepare($query);
    $statement->bind_param("i", $id);
    $statement->execute();
    $result = $statement->get_result();
    if ($result->num_rows === 1) {
      $article = $result->fetch_assoc();
      return $article;
    } else {
      return false;
    }
  }

  public function update($id, $title, $desc, $image, $slug, $tags, $status) {
    $query = "UPDATE articles SET article_title = ?, article_description = ?, article_image = ?, article_slug = ?, article_tags = ?, article_status = ? WHERE article_id = ?";
    $statement = $this->connection->prepare($query);
    $statement->bind_param("ssssssi", $title, $desc, $image, $slug, $tags, $status, $id);
    $statement->execute();
    if ($statement->affected_rows === 1) {
      return true;
    } else {
        return false;
    }
  }

  public function delete() {}
}
?>