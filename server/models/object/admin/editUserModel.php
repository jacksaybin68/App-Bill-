<?php
/**
* @author Vương Thanh Diệu
*/
class WsEditUser extends DatabaseConnection
{
    private $current_url;

    public function __construct($current_url) 
    {
        $this->current_url = $current_url;
    }    
    /**
     * Method UserID
     */
    public function UserID() 
    {
        return preg_replace('/[^0-9a-zA-Z\-]/','',strtok(basename($this->current_url),'?'));
    }    
    /**
     * Method TDGetUser
     *
     * @param $UserID $UserID 
     *
     */
    public function TDGetUser($UserID) 
    {
        $vtd = self::ThanhDieuDB()->prepare("SELECT * FROM users WHERE user_id=?");
        $vtd->bind_param("s", $UserID);
        $vtd->execute();
        $wusTeam = $vtd->get_result();
        if ($wusTeam && $wusTeam->num_rows > 0) {
            $userData = $wusTeam->fetch_assoc();
            return $userData;
        } else {
            header('location: /admin/users/list');
            exit; 
        }
    }
}
$User = new WsEditUser($current_url);
$UserID = $User->UserID();
$userData = $User->TDGetUser($UserID);