<?php
/**
 * Created by PhpStorm.
 * User: thanhdc
 * Date: 1/22/15
 * Time: 7:47 AM
 */

namespace MyCore\Mvc\Model;

use MyCore\Lib\File;

class User
{
    public function __construct($credential)
    {
        if(is_object($credential)) {
            $credential = get_object_vars($credential);
        }

        foreach($credential as $key => $value) {
            $this->{$key} = $value;
        }
    }

    public function __get($name)
    {
        if(isset($this->{$name})) {
            return $this->{$name};
        }

        return null;
    }

    public function getFullName()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    /**
     * Get staff image link
     * @return string
     */
    public function getAvatar()
    {
        // Default staff image path
        $defaultStaffImage = '/upload/avatars/avatar_default.png';
        // Staff image
        $staffImage = STAFF_IMAGE_URL . $this->avatar;
        // Make sure staff image path is existed
        if(File::fileExist(PUBLIC_PATH . $staffImage)) {
            return $staffImage;
        }
        // Return staff image
        return $defaultStaffImage;
    }
}