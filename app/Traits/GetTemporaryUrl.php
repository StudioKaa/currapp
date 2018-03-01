<?php
namespace App\Traits;
use Illuminate\Support\Facades\Storage;

trait GetTemporaryUrl{

	public function temporaryUrl($expires, $do_path)
    {
        $config = config('filesystems.disks')['spaces'];
        $request = "GET\n\n\n{$expires->timestamp}\n/{$config['bucket']}/{$do_path}";
        $signature = urlencode(base64_encode(hash_hmac('sha1', $request, $config['secret'], true)));
        return "{$config['endpoint']}{$config['bucket']}/{$do_path}?AWSAccessKeyId={$config['key']}&Expires={$expires->timestamp}&Signature={$signature}";
    }

}