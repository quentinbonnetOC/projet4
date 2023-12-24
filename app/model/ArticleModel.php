<?php
/**
 * class article
 */
class Article extends Bdd{
	/**
	 * @param $chapter
	 * @param $title
	 * @param $contenu
	 * @param $date
	 *
	 * @return false|PDOStatement
	 */
	public function createArticle($chapter, $title, $contenu, $date){
        $db = $this->dbConnect();
        $req = $db->prepare('INSERT INTO `articles`(chapter, title, contenu, date) VALUES (:chapter, :title, :contenu, :date)');
        $req->execute(array(
            'chapter' => $chapter,
            'title' => $title,
            'contenu' => $contenu,
            'date' => $date
        ));
        return $req;
    }

	/**
	 * lire tous les articles
	 * @return false|PDOStatement
	 */
	public function readArticle(){
        return $this->dbConnect()->query('SELECT * FROM articles');
    }

	/**
	 * @param $id
	 * supprime un article
	 * @return false|PDOStatement
	 */
	public function deleteArticle($id){
        $req = $this->dbConnect()->prepare('DELETE FROM `articles` WHERE id = :id');
        $req->execute(array(
            'id' => $id
        ));
        return $req;
    }

	/**
	 * modifie un article
	 * @param $chapter
	 * @param $title
	 * @param $contenu
	 * @param $id
	 *
	 * @return false|PDOStatement
	 */
	public function updateArticle($chapter, $title, $contenu, $id){
        $db = $this->dbConnect();
        $req = $db->prepare('UPDATE `articles` SET chapter = :chapter, contenu = :contenu, title = :title WHERE id = :id');
        $req->execute(array(
            'chapter' => $chapter,
            'title' => $title,
            'contenu' => $contenu,
            'id' => $id
        ));
        return $req;
    }
}