<?php
namespace App\Http\Controllers;

use App\Package\Uploader;
use App\Repositories\Media;
use App\Repositories\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MediaController extends Controller {
    public function index(Request $request) {
        $this->setTitle(__('messages.media-manager'));
        $this->setActiveMenu('media');

        if ($val = $request->input('val')) {
            if ($val['action'] == 'upload') {
                $files = $request->file('file');
                foreach($files as $file) {
                    $uploader = new Uploader($file, 'file');
                    $uploader->setPath("media/".User::repository()->authId.'/');
                    $uploader->setImageSizes([300]);
                    $uploader->setFileTypes('jpg,png,gif,jpeg,mp4');
                    if ($uploader->passed()) {
                        if (isImage($file->getClientOriginalExtension())) {
                            $image = $uploader->resize()->result();
                            $path = $uploader->uploadFile()->result();
                            $type = 'image';
                            $thumb =  str_replace('%w', 300, $image);
                        } else {
                            $path = $uploader->uploadFile()->result();
                            $thumb = '';
                            $type = 'video';
                        }
                        Media::repository()->add($path, $thumb, $type);
                    } else {
                        return json_encode([
                            'type' => 'error',
                            'message' => $uploader->getError()
                        ]);
                    }
                }
                return json_encode([
                    'type' => 'reload',
                    'message' => __('messages.upload-file-success')
                ]);
            } elseif($val['action'] == 'import') {
                $fileLink = $request->input('link');
                if ($canva = $request->input('canva')) $fileLink = $_POST['link'];

                //$fileLink = urldecode($fileLink);
                //exit($fileLink);
                $ext = getFileExtension($fileLink);
                $ext = ($ext) ? $ext : 'png';

                $dir = "uploads/media/".Auth::id().'/';
                if (!is_dir(public_path($dir))) mkdir(public_path($dir), 0777, true);
                $file = $dir.md5($fileLink).'.'.$ext;
                getFileViaCurl($fileLink, $file);
                $val = array();
                if (isImage($ext)) {

                    $uploader = new Uploader(public_path($file), 'image', false, true);
                    $uploader->setPath("media/".User::repository()->authId.'/');
                    $uploader->setImageSizes([300]);
                    $image = $uploader->resize()->result();
                    $path = $file;
                    $type = 'image';
                    $thumb =  str_replace('%w', 300, $image);
                    Media::repository()->add($path, $thumb, $type);
                    return json_encode(array(
                       'type' => 'reload-modal',
                        'message' => __('messages.media-imported-success'),
                        'content' => '#importImageModal'
                    ));
                }  else {
                    return json_encode(array(
                        'status' => 0,
                        'message'=> __('messages.no-image-found-import'),

                    ));
                }
            }
        }
        if ($dropbox = $request->input('dropbox')) {
            $fileName = $request->input('file_name');
            $fileSize = $request->input('file_size');
            $fileLink = $request->input('file');
            $ext = getFileExtension($fileName);
            $dir = "uploads/media/".Auth::id().'/';
            if (!is_dir(public_path($dir))) mkdir(public_path($dir), 0777, true);
            $file = $dir.md5($fileName).'.'.$ext;
            getFileViaCurl($fileLink, $file);

            if (isImage($ext)) {

                $uploader = new Uploader(public_path($file), 'image', false, true);
                $uploader->setPath("media/".User::repository()->authId.'/');
                $uploader->setImageSizes([300]);
                $image = $uploader->resize()->result();
                $path = $file;
                $type = 'image';
                $thumb =  str_replace('%w', 300, $image);
                Media::repository()->add($path, $thumb, $type);
            } else {
                $path = $file;
                $type = 'video';
                $thumb =  '';
                Media::repository()->add($path, $thumb, $type);
            }
        }
        if ($google = $request->input('google')) {
            $fileId = $request->input('file_id');
            $fileName = $request->input('file_name');
            $fileSize = $request->input('file_size');
            $oAuthToken = $request->input('oauthToken');
            $getUrl = 'https://www.googleapis.com/drive/v2/files/' . $fileId . '?alt=media';
            $authHeader = 'Authorization: Bearer ' . $oAuthToken;
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_URL, $getUrl);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array($authHeader));
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
            $data = curl_exec($ch);
            $error = curl_error($ch);
            curl_close($ch);

            $ext = getFileExtension($fileName);
            $file = md5($fileName.time()).'.'.$ext;
            $tempFileDir = 'uploads/media/'.Auth::id().'/';
            if (!is_dir(public_path($tempFileDir))) {
                @mkdir(public_path($tempFileDir), 0777, true);
            }
            $file = $tempFileDir.$file;
            file_put_contents(public_path($file), $data);
            if (isImage($ext)) {
                $uploader = new Uploader(public_path($file), 'image', false, true);
                $uploader->setPath("media/".User::repository()->authId.'/');
                $uploader->setImageSizes([300]);
                $image = $uploader->resize()->result();
                $path = $file;
                $type = 'image';
                $thumb =  str_replace('%w', 300, $image);
                Media::repository()->add($path, $thumb, $type);
            } else {
                $path = $file;
                $type = 'video';
                $thumb =  '';
                Media::repository()->add($path, $thumb, $type);
            }
        }
        if ($action = $request->input('action')) {
            if ($action == 'delete') {
                $ids = explode(',', $request->input('id'));
                foreach($ids as $id) {
                    Media::repository()->delete($id);
                }
                return json_encode([
                    'type' => 'function',
                    'value' => 'App.validateMediaDelete',
                    'content' => $ids
                ]);
            } elseif ($action == 'import-image') {
                $fileLink = $request->input('link');
                $ext = getFileExtension($fileLink);
                $ext = ($ext) ? $ext : 'png';

                $dir = "uploads/media/".Auth::id().'/';
                if (!is_dir(public_path($dir))) mkdir(public_path($dir), 0777, true);
                $file = $dir.md5($fileLink).'.'.$ext;
                getFileViaCurl($fileLink, $file);
                $val = array();
                if (isImage($ext)) {

                    $uploader = new Uploader(public_path($file), 'image', false, true);
                    $uploader->setPath("media/".User::repository()->authId.'/');
                    $uploader->setImageSizes([300]);
                    $image = $uploader->resize()->result();
                    $path = $file;
                    $type = 'image';
                    $thumb =  str_replace('%w', 300, $image);
                    Media::repository()->add($path, $thumb, $type);

                }
            } elseif($action == 'popup') {
                return view('app/media/popup', ['medias' => Media::repository()->getMedias(null, 0, 30)]);
            }
        }
        return $this->render(view('app/media/index', ['medias' => Media::repository()->getMedias()]), true);
    }
}
