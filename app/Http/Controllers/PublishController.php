<?php
namespace App\Http\Controllers;

use App\Package\Uploader;
use App\Repositories\Channel;
use App\Repositories\Emoji;
use App\Repositories\Post;
use App\Repositories\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PublishController extends Controller {
    public function __construct()
    {
        parent::__construct();
        $this->setTitle(__('messages.scheduling'));
    }

    public function index(Request $request) {
        $this->setActiveMenu('publish');
        $displayType = $request->session()->get('post-display', 'month');
        $type = Post::repository()->getStatusNumber($request->segment(2, 'scheduled'));

        if ($display = $request->input('display')) {
            $request->session()->put('post-display', $display);
            return true;
        }

        if ($val = $request->input('val')) {
            if ($val['action'] == 'post') {
                $posting = 0;
                $posted = [];
                foreach($val['account'] as $account) {
                    $postId = Post::repository()->add($val, $account);
                    if ($postId) {
                        $posted[] = $postId;
                        if ($val['post_type'] == 1) {
                            Post::repository()->postNow($postId);
                        }
                    }
                    $posting++;
                }

                if (count($posted) == $posting) {
                    return json_encode([
                        'type' => 'function',
                        'value' => 'App.postCompleted',
                        'message' =>  __('messages.post-submit-success')
                    ]);
                } else {
                    return json_encode([
                        'type' => 'error',
                        'message' => __('messages.posting-error')
                    ]);
                }
            } elseif($val['action'] == 'edit-post') {
                Post::repository()->save($val, $val['id']);
                return json_encode([
                    'type' => 'reload-modal',
                    'content' => '#editPostModal'.$val['id'],
                    'message' => __('messages.post-save-success')
                ]);
            }
        }

        if ($action = $request->input('action')) {
            if ($action == 'change-date') {
                Post::repository()->changePostDate($request->input('id'), $request->input('date'));
            } elseif($action == 'delete-post') {
                Post::repository()->delete($request->input('id'));
                return json_encode([
                    'type' => 'reload-modal',
                    'modal' => '#calendarPostModal'.$request->input('id'),
                    'message' => __('messages.post-deleted-success')
                ]);
            }
        }
        return $this->render(view('app/publish/index', ['display' => $displayType, 'type' => $type, 'posts' => Post::repository()->getPosts($type)]), true);
    }

    public function bulk(Request $request) {
        $this->setActiveMenu('bulk');
        $this->setTitle(__('messages.bulk-upload'));

        if ($val = $request->input('val')) {
            if ($val['action'] == 'upload') {
                $file = $request->file('file');
                $uploader = new Uploader($file, 'file');
                $uploader->setPath("bulk/".User::repository()->authId.'/');
                $uploader->setFileTypes('csv');
                if ($uploader->passed()) {
                    $result = $uploader->uploadFile()->result();
                    $request->session()->put('csv-file', $result);
                    return json_encode([
                        'value' => 'App.switchBulkPane',
                        'type' => 'function',
                        'content' => 'account'
                    ]);
                } else {
                    return json_encode([
                        'type' => 'error',
                        'message' => $uploader->getError()
                    ]);
                }
            } elseif($val['action'] == 'complete') {
                $accounts = (isset($val['accounts'])) ? $val['accounts'] : [];
                $file = $request->session()->get('csv-file');
                if (!$accounts) {
                    return json_encode([
                        'type' => 'error',
                        'message' => __('messages.need-select-accounts')
                    ]);
                } else {
                    $fullFile = public_path($file);
                    $open = fopen($fullFile, 'r');
                    $completed = 0;
                    while(($data = fgetcsv($open, 500, ',')) !== FALSE) {
                        $caption = (isset($data[0])) ? $data[0] : '';
                        $media = (isset($data[1])) ? $data[1] : '';
                        $time = (isset($data[2])) ? $data[2] : '';
                        if (($caption or $media) and $time) {
                            $ext = getFileExtension($media);
                            $ext = ($ext) ? $ext : 'png';

                            $dir = "uploads/media/".Auth::id().'/';
                            if (!is_dir(public_path($dir))) mkdir(public_path($dir), 0777, true);
                            $file = $dir.md5($media).'.'.$ext;
                            getFileViaCurl($media, $file);

                            foreach($accounts as $account) {
                                Post::repository()->add([
                                    'caption' => $caption,
                                    'media' => explode(',', $file),
                                    'post_type' => 0,
                                    'time' => $time,
                                    'status' => 2
                                ], $account);
                            }

                            $completed++;
                        }
                    }
                    fclose($open);
                    if ($completed < 1) {
                        return json_encode([
                            'type' => 'error',
                            'message' => __('messages.problem-with-csv-file')
                        ]);
                    } else {
                        return json_encode([
                            'type' => 'function',
                            'value' => 'App.switchBulkPane',
                            'content' => 'finish'
                        ]);
                    }
                }
            }
        }
        return $this->render(view('app/publish/bulk/index', ['channels' => Channel::repository()->getChannels()]), true);
    }

    public function rss(Request $request) {
        $this->setActiveMenu('rss');
        $this->setTitle(__('messages.rss-feed'));

        if ($val = $request->input('val')) {
            if ($val['action'] == 'add') {

                if(!Post::repository()->testRss($val['url'])) {
                    return json_encode([
                        'type' => 'error',
                        'message' => __('messages.feed-url-error')
                    ]);
                } else {
                    Post::repository()->saveRSS($val);
                    return json_encode([
                        'type' => 'reload-modal',
                        'content' => '#newFeedModal',
                        'message' => __('messages.rss-added-success')
                    ]);
                }
            } elseif($val['action'] == 'edit') {
                if(!Post::repository()->testRss($val['url'])) {
                    return json_encode([
                        'type' => 'error',
                        'message' => __('messages.feed-url-error')
                    ]);
                }
                Post::repository()->saveRSS($val, $val['id']);
                return json_encode([
                    'type' => 'reload-modal',
                    'content' => '#editFeedModal'.$val['id'],
                    'message' => __('messages.rss-saved-success')
                ]);
            }
        }

        if ($action = $request->input('action')) {
            if ($action == 'change-status') {
                Post::repository()->changeRssStatus($request->input('id'), $request->input('status'));
            } elseif($action == 'delete') {
                Post::repository()->deleteRSS($request->input('id'));
                return json_encode([
                    'type' => 'url',
                    'value' => url('publish/rss'),
                    'message' => __('messages.rss-feed-deleted')
                ]);
            }
        }
        return $this->render(view('app/publish/rss/index', [
            'rssLists' => Post::repository()->listRSS(),
            'channels' => Channel::repository()->getChannels()]), true);
    }

    public function rssPage(Request $request, $id) {
        $this->setActiveMenu('rss');
        $this->setTitle(__('messages.rss-feed'));

        $rss = Post::repository()->findRSS($id);
        if (!$rss) redirect(url('publish/rss'));

        return $this->render(view('app/publish/rss/page', [
            'rss' => $rss,
            'posts' => Post::repository()->getRssPosts($id)
            ]), true);
    }

    public function calendarData(Request $request) {
        $type = $request->input('type');
        $posts = Post::repository()->getPosts($type, 0, -1);
        $result = [];
        foreach($posts as $post) {
            $caption = Emoji::repository()->toImage($post->caption);
            $medias = ($post->medias) ? json_decode($post->medias) : array();
            $channel = Channel::repository()->findById($post->account);
            $display  = (string) view('app/publish/calendar/display', ['post' => $post, 'channel' => $channel, 'medias' => $medias]);
            $result[] = [
                'id' => $post->id,
                'postId' => $post->id,
                'start' => date('Y-m-d', $post->schedule_time).'T'.date('h', $post->schedule_time).':00:00',
                'image' => ($medias) ? url($medias[0]) : '',
                'account' => [
                    'name' => $channel->username,
                    'type' => $channel->social,
                    'icon' => '<i class="bi bi-'.$channel->social.'"></i>'
                ],
                'displayContent' => $display,
                'preview' => (string) view('app/publish/calendar/preview', ['post' => $post, 'channel' => $channel, 'medias' => $medias]),
                'schedule_date' => date(choosenDateFormat().'h:iA', $post->schedule_time),
                'time' => date('h:iA', $post->schedule_time),
            ];
        }

        return json_encode($result);
    }
}
