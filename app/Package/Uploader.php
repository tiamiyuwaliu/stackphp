<?php
namespace App\Package;

use PHPImageWorkshop\ImageWorkshop;

class Uploader {
    /**
     * Allow image type
     */
    private $imageTypes = array('png', 'jpg', 'gif', 'jpeg');
    private $imageSizes = array(200, 920);

    /**
     * Allowed File types
     */
    private $fileTypes = array(
        'doc',
        'xml',
        'exe',
        'txt',
        'zip',
        'rar',
        'doc',
        'mp3',
        'jpg',
        'png',
        'css',
        'psd',
        'pdf',
        '3gp',
        'ppt',
        'pptx',
        'xls',
        'xlsx',
        'html',
        'docx',
        'fla',
        'avi',
        'mp4',
        'swf',
        'ico',
        'gif',
        'webm',
        'jpeg',
        'wav',
        'csv',
        'mkv'
    );

    /**
     * Allowed video types
     */
    private $videoTypes = array('mp4');
    private $audioTypes = array('mp3');
    private $sourceFile;
    private $linkContent = '';
    public $source;
    public $sourceName;
    public $sourceSize;
    public $extension;
    public $destinationPath;
    public $destinationName;
    public $baseDir;

    private $dbType;
    private $dbTypeId;
    private $type;

    //max sizes
    private $maxFileSize = 10000000;
    private $maxImageSize = 10000000;
    private $maxVideoSize = 10000000;
    private $maxAudioSize = 10000000;

    //allow Animated gif
    private $animatedGif = true;

    private $error = false;
    private $errorMessage;
    public $result;
    public  $insertedId;
    public $allowCDN = true;
    /**
     * @param $source
     * @param string $type
     * @param mixed $validate
     */
    public function __construct($source, $type = "image", $validate = false, $fromFile = false, $isLink = false,$itContent = false ,$fileTypes = null)
    {
        $this->source = $source;
        $this->type = $type;
        $this->maxFileSize = 100 * 10000000;
        $this->maxVideoSize = 100 * 10000000;
        $audioSize = config('audio-file-size', 55) * 10000000;
        $this->maxAudioSize = 100 * 10000000;
        $imagesSize = config('image-file-size', 2) * 10000000;
        $this->maxImageSize = 100 * 10000000;
        $videoSize = config('video-file-size', 55) * 10000000;
        $this->maxVideoSize = 100 * 10000000;
        $this->animatedGif = config("support-animated-image", $this->animatedGif);
        $this->imageTypes = explode(',', config('image-file-types', 'jpg,png,gif,jpeg'));
        $this->videoTypes = explode(',', config('video-file-types', 'mp4,mov,wmv,3gp,avi,flv,f4v,webm,mkv'));
        $this->audioTypes = explode(',', config('audio-file-types', 'mp3,m4a,mp4'));
        //$this->fileTypes = explode(',', config('files-file-types', 'doc,xml,exe,txt,zip,rar,mp3,jpg,png,css,psd,pdf,3gp,ppt,pptx,xls,xlsx,html,docx,fla,avi,mp4,swf,ico,gif,jpeg,webm'));

        if ($fileTypes) {
            $this->fileTypes = $fileTypes;
        }
        if(!$fromFile) {
            if ($source and $this->source->getSize() != 0) {
                $this->source = $source;
                $this->sourceFile = $this->source->getPathName();
                $this->sourceSize = $this->source->getSize();
                $this->sourceName = $this->source->getClientOriginalName();
                $name = pathinfo($this->sourceName);
                if (isset($name['extension'])) $this->extension = strtolower($name['extension']);

                $this->confirmFile();

            } else {
                if (!$validate) {
                    $this->error = true;
                    $this->errorMessage = __("messages.failed-to-upload-file");
                } else {
                    $this->validate($validate);
                }
            }
        } else {
            $this->source = $this->sourceFile = $this->sourceName = $source;
            if (!$itContent) {
                if (!$isLink) {
                    $name = pathinfo($this->sourceName);
                    if (isset($name['extension'])) $this->extension = strtolower($name['extension']);
                } else {

                    $content = file_get_contents($this->source);

                    if (!$content) {
                        $this->error = true;
                        $this->errorMessage = __("messages.failed-to-upload-file");
                    } else {
                        $this->extension = ($this->source->getClientOriginalExtension()) ? $this->source->getClientOriginalExtension() : 'png';
                        $this->linkContent = $content;

                    }

                }
            } else {
                $this->linkContent = $source;
                $this->extension = 'png';
            }
        }

        //confirm the creation of uploads directory
        if (!is_dir(public_path('uploads/'))) {
            @mkdir(public_path('uploads/'), 0777, true);
            $file = @fopen(public_path('uploads/index.html'), 'x+');
            @fclose($file);
        }

    }

    public function setFileTypes($types) {
        $this->fileTypes = $types;
        return $this;
    }

    public function noThumbnails() {
        $this->imageSizes = array(600, 920);
        return $this;
    }

    public function disableCDN() {
        $this->allowCDN = false;
    }

    public function enableCDN() {
        $this->allowCDN = true;
    }

    /**
     * Method to get the image width
     * @return null
     */
    function getWidth()
    {
        list($width, $height) = getimagesize($this->sourceFile);
        return ($width) ? $width : null;
    }

    /**
     * Method to get the image height
     * @return int
     */
    function getHeight()
    {
        list($width, $height) = getimagesize($this->sourceFile);
        return ($height) ? $height : null;
    }

    public function confirmFile()
    {
        switch($this->type) {
            case 'image':
                if (!in_array($this->extension, $this->imageTypes)){
                    $this->errorMessage = __("messages.upload-file-not-valid-image");
                    $this->error = true;
                }
                if ($this->sourceSize > $this->maxImageSize) {
                    $this->errorMessage = __("messages.upload-image-size-error", array('size' => format_bytes($this->maxImageSize)));
                    $this->error = true;
                }
                break;
            case 'video':
                if (!in_array($this->extension, $this->videoTypes)) {
                    $this->errorMessage = __("messages.upload-file-not-valid-video");
                    $this->error = true;
                }
                if ($this->sourceSize > $this->maxVideoSize) {
                    $this->errorMessage = __("messages.upload-video-size-error", array('size' => format_bytes($this->maxVideoSize)));
                    $this->error = true;
                }
                break;
            case 'audio':
                if (!in_array($this->extension, $this->audioTypes)) {
                    $this->errorMessage = __("messages.upload-file-not-valid-audio");
                    $this->error = true;
                }
                if ($this->sourceSize > $this->maxAudioSize) {
                    $this->errorMessage = __("messages.upload-audio-size-error", array('size' => format_bytes($this->maxAudioSize)));
                    $this->error = true;
                }
                break;
            case 'file':
                if (!in_array($this->extension, $this->fileTypes)) {
                    $this->errorMessage = __("messages.upload-file-not-valid-file");
                    $this->error = true;
                }

                if ($this->sourceSize > $this->maxFileSize) {
                    $this->errorMessage = __("messages.upload-file-size-error", array('size' => format_bytes($this->maxFileSize)));
                    $this->error = true;
                }
                break;
        }
    }

    /**
     * Validate upload files for multiple uploads
     * @param array $files
     * @return boolean
     */
    public function validate($files)
    {
        $isError = false;
        foreach($files as $file){
            $pathInfo = pathinfo($file['name']);
            $this->extension = strtolower($pathInfo['extension']);
            $this->sourceSize = $file['size'];
            switch($this->type) {
                case 'image':
                    if (!in_array($this->extension, $this->imageTypes)){
                        $this->errorMessage = __("messages.upload-file-not-valid-image");
                        $this->error = true;
                    }
                    if ($this->sourceSize > $this->maxImageSize) {
                        $this->errorMessage = __("messages.upload-file-size-error", array('size' => format_bytes($this->maxImageSize)));
                        $this->error = true;
                    }
                    break;
                case 'video':
                    if (!in_array($this->extension, $this->videoTypes)) {
                        $this->errorMessage = __("messages.upload-file-not-valid-video");
                        $this->error = true;
                    }
                    if ($this->sourceSize > $this->maxVideoSize) {
                        $this->errorMessage = __("messages.upload-file-size-error", array('size' => format_bytes($this->maxVideoSize)));
                        $this->error = true;
                    }
                    break;
                case 'audio':
                    if (!in_array($this->extension, $this->audioTypes)) {
                        $this->errorMessage = __("messages.upload-file-not-valid-audio");
                        $this->error = true;
                    }
                    if ($this->sourceSize > $this->maxAudioSize) {
                        $this->errorMessage = __("messages.upload-file-size-error", array('size' => format_bytes($this->maxAudioSize)));
                        $this->error = true;
                    }
                    break;
                case 'file':
                    if (!in_array($this->extension, $this->fileTypes)) {
                        $this->errorMessage = __("messages.upload-file-not-valid-file");
                        $this->error = true;
                    }

                    if ($this->sourceSize > $this->maxFileSize) {
                        $this->errorMessage = __("messages.upload-file-size-error", array('size' => format_bytes($this->maxFileSize)));
                        $this->error = true;
                    }
                    break;
            }
        }
    }

    /**
     * Function to confirm file passes
     */
    public function passed()
    {
        return !$this->error;
    }

    /**
     * Function to set destination
     */
    public function setPath($path)
    {
        $this->baseDir = "uploads/".$path;
        $path = public_path("uploads/").$path;
        if (!is_dir($path)) {
            mkdir($path, 0777, true);
            //create the index.html file
            if (!file_exists($path.'index.html')) {
                $file = fopen($path.'index.html', 'x+');
                fclose($file);
            }
        }

        $this->destinationPath = $path;
        return $this;
    }

    /**
     *Function to resize image
     * @param int $width
     * @param int $height
     * @param string $fit
     * @param string $any
     * @return $this
     */
    public function resize($width = null, $height = null, $fit = "inside", $any = "down")
    {
        if ($this->error) return false;
        $fileName = md5($this->sourceName.time()).'.'.$this->extension;
        $fileName = (!$width) ? '_%w_'.$fileName : '_'.$width.'_'.$fileName;

        $this->result = $this->baseDir.$fileName;

        if ($width) {
            $this->finalizeResize($fileName, $width, $height, $fit, $any);
        } else {
            foreach($this->imageSizes as $size) {
                $this->finalizeResize(str_replace('%w', $size, $fileName), $size, $size, $fit, $any);
            }
        }

        return $this;
    }

    /**
     * @param $filename
     * @param $width
     * @param $height
     * @param $fit
     * @param $any
     */
    private function finalizeResize($filename, $width, $height, $fit, $any)
    {
        try {
            if ($this->animatedGif and $this->extension == "gif") {
                $Gif = new \GIF_eXG($this->sourceFile, 1);
                if (!$height) $height = $width;
                $Gif->resize($this->destinationPath.$filename, $width, $height, 1, 0);
                if(extension_loaded('exif')) {
                    $layer = ImageWorkshop::initFromPath($this->sourceFile, true);
                } else {
                    $layer = ImageWorkshop::initFromPath($this->sourceFile);
                }

                if($width == 550) {
                    $layer->resizeInPixel($width, $height, true);
                }
                elseif ($width < 600) {
                    $layer->cropMaximumInPixel(0, 0, "MM");
                    $layer->resizeInPixel($width, $height);
                } else {
                    $layer->resizeToFit($width, $height, true);
                }
                $filename = str_replace($this->extension, 'jpg', $filename);
                $layer->save($this->destinationPath, $filename);
            } else {
                try{
                    if ($this->linkContent) {
                        $layer = ImageWorkshop::initFromString($this->linkContent);
                    } else {
                        if(extension_loaded('exif')) {
                            $layer = ImageWorkshop::initFromPath($this->sourceFile, true);
                        } else {
                            $layer = ImageWorkshop::initFromPath($this->sourceFile);
                        }
                    }
                    if($width == 550) {
                        $layer->resizeInPixel($width, $height, true);
                    }
                    elseif ($width < 600) {
                        $layer->cropMaximumInPixel(0, 0, "MM");
                        $layer->resizeInPixel($width, $height);
                    } else {
                        $layer->resizeToFit($width, $height, true);
                    }
                } catch (\PHPImageWorkshop\Exception\ImageWorkshopException $e) {
                    exit($e->getMessage());
                }

                $layer->save($this->destinationPath, $filename);
            }
        } catch(\Exception $e){
            $this->result = '';
        }
    }

    /**
     * Function to crop image
     * @param int $left
     * @param int $top
     * @param int $width
     * @param int $height
     * @return $this
     */
    public function crop($left = 0, $top = 0, $width = '100%', $height = '100%')
    {
        if ($this->error) return false;
        $fileName = md5($this->sourceName.time()).'.'.$this->extension;
        $fileName = '_'.str_replace('%', '', $width).'_'.$fileName;
        $this->result = $this->baseDir.$fileName;

        try{
            $layer = ImageWorkshop::initFromPath($this->sourceFile, true);
            $layer->cropInPixel($width, $height, $left, $top);
            $layer->save($this->destinationPath, $fileName);

        } catch(\Exception $e){$this->result = '';}

        return $this;
    }
    /**
     * Function to get result
     * @return string
     */
    public function result()
    {
        return $this->result;
    }



    /**
     * Function to upload video
     */
    public function uploadVideo()
    {
        return $this->directUpload();
    }

    /**
     * function to upload file
     */
    public function uploadFile()
    {
        return $this->directUpload();
    }

    protected function directUpload()
    {
        if ($this->error) return false;
        $fileName = md5($this->sourceName.time()).".".$this->extension;
        $this->result = $this->baseDir.$fileName;
        move_uploaded_file($this->sourceFile, $this->destinationPath.$fileName);
        return $this;
    }

    public function getError()
    {
        return $this->errorMessage;
    }

    public static function isImage($file) {
        $name = (isset($file['name'])) ? $file['name'] : false;
        if (!$name and $file) $name = $file;
        if ($name ) {
            $name = strtolower($name);
            foreach(array('png', 'jpg', 'gif', 'jpeg') as $type) {
                if (preg_match("#\.$type#", $name)) return true;
            }
        }
        return false;
    }
}
