<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MediaController extends Controller {


	public function show(Request $request) {
		$file = $request->get('file');
		Storage::writeStream('file', fopen($file, 'r'));

		$dest = Storage::path('file');
		$out = '/tmp/out.json';


		exec("ffprobe -v quiet -print_format json -show_format -show_streams " . $dest . " > " . $out, $output, $result);

		$foo = json_decode(file_get_contents($out));

		return response()->json($foo);

	}
}
