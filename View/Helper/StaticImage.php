<?php
/**
 * Project sgx.me.
 * User: Thanh Dang
 * Date: 4/16/15
 * Time: 9:36 PM
 */

namespace MyCore\View\Helper;

use Zend\View\Helper\AbstractHelper;
use MyCore\Lib\File;

class StaticImage extends AbstractHelper
{
    // TODO: Change to no image path file name
    const NO_IMAGE_PATH = '/assets/images/not_found.png';
    // TODO: Staff no image path
    const STAFF_NO_IMAGE_PATH = '/upload/avatars/avatar_default.png';
    // TODO: job category no image path
    const JOB_CATEGORY_NO_IMAGE_PATH = '/assets/images/not_found.png';
    // TODO: Project no image path
    const PROJECT_NO_IMAGE_PATH = '/assets/images/not_found.png';

    protected $path = null;
    protected $full = false;

    /**
     * Main helper execute function
     * @return \MyCore\View\Helper\StaticImage
     */
    public function __invoke($path = null, $full = false)
    {
        $this->path = $path;
        $this->full = $full;

        return $this;
    }

    /**
     * @param $path
     * @param $full
     * @return string Image path
     */
    public function staff($path, $full = false)
    {
        return $this->_getImage($path, $full, self::STAFF_NO_IMAGE_PATH);
    }

    /**
     * @param $path
     * @param $full
     * @return string Image path
     */
    public function jobCategory($path, $full = false)
    {
        return $this->_getImage($path, $full, self::JOB_CATEGORY_NO_IMAGE_PATH);
    }

    /**
     * @param $path
     * @param $full
     * @return string Image path
     */
    public function project($path, $full = false)
    {
        return $this->_getImage($path, $full, self::PROJECT_NO_IMAGE_PATH);
    }

    /**
     * Return default image path
     *
     * @return string
     */
    public function __toString()
    {
        return $this->_getImage($this->path, $this->full);
    }

    /**
     * @param $path
     * @param $full
     * @param null $default Default image path
     * @return string
     */
    private function _getImage($path, $full, $default = null)
    {
        // Set default image path
        $default = is_null($default) ? self::NO_IMAGE_PATH : $default;
        // Get server url
        $serverUrl = ($full === true) ? $this->getView()->serverUrl() : '';

        // Make sure image is existed
        if(!File::fileExist(PUBLIC_PATH . $path)) {
            return $serverUrl . $default;
        }

        // Return image url
        return $serverUrl . $path;
    }
}