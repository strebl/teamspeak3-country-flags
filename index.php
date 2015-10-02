<?php

use Intervention\Image\ImageManagerStatic as Image;

include __DIR__ . '/vendor/autoload.php';

$filesystem = new Illuminate\Filesystem\Filesystem;

$flags = $filesystem->files('input');
$countries = Country::all();

foreach($flags as $flag)
{
	$country = basename($flag, '.png');

	if(isset($countries[$country])) {
		$path = strtolower('output/' . $countries[$country] . '.png');
		$img = Image::make($flag);

		$img->resize(16, null, function ($constraint) {
		    $constraint->aspectRatio();
		});

		$img->save($path);
	}
}