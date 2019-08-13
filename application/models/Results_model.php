<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Results_model extends CI_Model
{
    /**
     * Author: Victor H
     * 
     * Model which queries the "results" table, containing the *user*name of the person
     * who got from a starting Wikipedia article to a randomly chosen destination article, and their 
     * *link path* to get there.
     */

    public function __construct()
    {
        $this->load->database();
    }

    public function add_result($user, $path)
    {
        $sql = "INSERT INTO results (User,Path) VALUES (?,?)";
        $this->db->query($sql, array($user,$path));
    }

    public function get_results()
    {
        $sql = "SELECT * FROM results ORDER BY id DESC";
        $query = $this->db->query($sql);
        //Returns to Controller "Main" function "viewresults"
        return $query->result_array();
    }
}

?>