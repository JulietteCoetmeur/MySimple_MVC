<?php
/**
 * Created by PhpStorm.
 * User: sylvain
 * Date: 07/03/18
 * Time: 18:20
 * PHP version 7
 */

namespace App\Model;

/**
 *
 */
class ItemManager extends AbstractManager
{
    /**
     *
     */
    const TABLE = 'article';

    /**
     *  Initializes this class.
     */
    public function __construct()
    {
        parent::__construct(self::TABLE);
    }


    /**
     * @param array $item
     * @return int
     */
    public function insert(array $item): int
    {
        // prepared request
        $statement = $this->pdo->prepare("INSERT INTO " . self::TABLE . " (`title`, `img`, `content`, `price`) VALUES (:title, :img, :content, :price)");
        $statement->bindValue('title', $item['title'], \PDO::PARAM_STR);
        $statement->bindValue('img', $item['img'], \PDO::PARAM_STR);
        $statement->bindValue('content', $item['content'], \PDO::PARAM_STR);
        $statement->bindValue('price', $item['price'], \PDO::PARAM_INT);

        if ($statement->execute()) {
            return (int)$this->pdo->lastInsertId();
        }
    }


    /**
     * @param int $id
     */
    public function delete(int $id): void
    {
        // prepared request
        $statement = $this->pdo->prepare("DELETE FROM " . self::TABLE . " WHERE id=:id");
        $statement->bindValue('id', $id, \PDO::PARAM_INT);
        $statement->execute();
    }


    /**
     * @param array $item
     * @return bool
     */
    public function update(array $item):bool
    {

        // prepared request
        $statement = $this->pdo->prepare("UPDATE " . self::TABLE . " SET `title` = :title, `img` = :img, `content` = :content, `price` = :price WHERE id=:id");
        $statement->bindValue('id', $item['id'], \PDO::PARAM_INT);
        $statement->bindValue('title', $item['title'], \PDO::PARAM_STR);
        $statement->bindValue('img', $item['img'], \PDO::PARAM_STR);
        $statement->bindValue('content', $item['content'], \PDO::PARAM_STR);
        $statement->bindValue('price', $item['price'], \PDO::PARAM_INT);

        return $statement->execute();
    }
}
