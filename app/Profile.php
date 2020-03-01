<?php

namespace App;

use Illuminate\Support\Facades\Auth; 
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    // テーブル名
    protected $table = 'profiles';

    // カスタムフィールド
    protected $appends = ['is_mine'];

    public function getIsMineAttribute()
    {
        // ログインユーザ取得
        $user = Auth::user();
        // APIからの場合は空であるため、その場合はfalse
        if(!empty($user)) {
            if ($this->user_id === $user->id) {
                // ログインユーザどうか
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    // IDが自動増分されない場合
    // public $incrementing = false;

    // 主キーが整数でない場合
    // protected $keyType = 'string';

    // 複数代入させない属性　主キー
    protected $guarded = array('id');

    // 自動でタイムスタンプ付与
    public $timestamps = true;

    // 複数代入する属性
    // Factoryでinsertを許可するカラム
    protected $fillable = [];

    Public function user()
    {
      return $this->belongsTo('App\User');
    }

    // dropboxの共有リンクを発行
    public static function createSharedLink($path)
    {
        $url = "https://api.dropboxapi.com/2/sharing/create_shared_link_with_settings";

        $ch = curl_init();

        $headers = array(
            'Authorization: Bearer ' . env('DROPBOX_ACCESS_TOKEN'),
            'Content-Type: application/json',
        );

        $post = array(
            "path" => "{$path}", //ファイルパス
            "settings" => array(
                "requested_visibility" => array(
                    ".tag" => "public" //公開
                ),
            ),
        );

        $options = array(
            CURLOPT_URL => $url,
            CURLOPT_HTTPHEADER => $headers,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => json_encode($post),
            CURLOPT_RETURNTRANSFER => true,
        );

        curl_setopt_array($ch, $options);

        $res = curl_exec($ch);
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        $link = "";
        if (!curl_errno($ch) && $http_code == "200") {
            $res = (array)json_decode($res);
            if ($res["url"]) {
                $link = $res["url"];
                // 画像表示用のurlに変更する
                $link = self::changeLink($link);
            } elseif ($res["error"]) {
                //既に設定済みなど
                $error = (array)$res["error"];
                print_r("WARNING: Failed to create shared link [{$path}] - {$error['.tag']}" . PHP_EOL);
            }
        } else {
            print_r("ERROR: Failed to access DropBox via API" . PHP_EOL);
            print_r(curl_error($ch) . PHP_EOL);
        }

        curl_close($ch);

        return $link;
    }

    // dropboxの共有リンクを画像src用に変更する
    public static function changeLink($link)
    {
        // www.dropbox.com を dl.dropboxusercontent.com を変更
        $link = str_replace('www.dropbox.com', 'dl.dropboxusercontent.com', $link);
        // ?dl=0を削除
        $link = str_replace('?dl=0', '', $link);

        return $link;
    }

    // dropboxの共有リンクを取得
    public static function getSharedLink($path)
    {
        $url = "https://api.dropboxapi.com/2/sharing/list_shared_links";

        $ch = curl_init();

        $headers = array(
            'Authorization: Bearer ' . env('DROPBOX_ACCESS_TOKEN'),
            'Content-Type: application/json',
        );

        $post = array(
            "path" => "{$path}", //ファイルパス
            "direct_only" => true, //ファイルへのアクセスのみ許可
        );

        $options = array(
            CURLOPT_URL => $url,
            CURLOPT_HTTPHEADER => $headers,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => json_encode($post),
            CURLOPT_RETURNTRANSFER => true,
        );

        curl_setopt_array($ch, $options);

        $res = curl_exec($ch);
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $link = "";
        if (!curl_errno($ch) && $http_code == "200") {
            $res = (array)json_decode($res);
            if ($res["links"]) {
                $links = (array)$res["links"];
                $firstlink = (array)$links[0];
                $link = $firstlink["url"];
            } else {
                //なければ共有リンク発行
                $link = self::createSharedLink($path);
            }
        } else {
            print_r("ERROR: Failed to access DropBox via API" . PHP_EOL);
            print_r(curl_error($ch) . PHP_EOL);
        }

        curl_close($ch);

        return $link;
    }
}
