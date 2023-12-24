<?php
/**
 * Class Admin
 */
class Admin extends Bdd{

	/**
	 * @param $idt
	 *
	 * @return false|PDOStatement
	 */
	public function authentification($idt){
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT * FROM admin WHERE idt = :idt');
        $req->execute(array('idt' => $idt));
        return $req;
    }

	/**
	 * @param $email
	 *
	 * @return false|PDOStatement
	 */
	public function forgetMdp($email){
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT * FROM admin WHERE email = :email');
        $req->execute(array('email' =>$email));
        return $req;
    }
}