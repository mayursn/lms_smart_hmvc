<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Photo_gallery_model extends MY_Model {

    protected $primary_key = 'gallery_id';
    public $before_create = array('timestamps');

    /**
     * Set the timestamp
     * @param array $gallery
     * @return array
     */
    protected function timestamps($gallery) {
        $gallery['created_date'] = date('Y-m-d H:i:s');

        return $gallery;
    }

    function get_all_folder_photo($id) {
        return $this->db->get_where("photo_gallery", array("folder_id" => $id))->result();
    }

    function get_folder_name($folder_id, $field = 'folder_name') {
        return $this->db->get_where('gallery_folder', array("folder_id" => $folder_id))->row()->$field;
    }

    public function getgallery($id) {
        return $this->db->get_where("photo_gallery", array("gallery_id" => $id))->result();
    }

}
