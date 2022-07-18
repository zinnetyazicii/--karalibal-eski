<?php

use Journal3\Opencart\Model;
use Journal3\Utils\Arr;
use Journal3\Utils\Img;
use Journal3\Utils\Str;

class ModelJournal3Image extends Model {

	public function __construct($registry) {
		parent::__construct($registry);
		$this->load->model('tool/image');
	}

	public function transparent($width, $height) {
		static $imgs = [];

		$width  = (int) $width ?: 1;
		$height = (int) $height ?: 1;
		$key    = "{$width}x{$height}";

		if ( ! isset( $imgs[ $key ] ) ) {
			// REF: http://stackoverflow.com/questions/9370847/php-create-image-with-imagepng-and-convert-with-base64-encode-in-a-single-file
			ob_start();

			$img = imagecreatetruecolor( $width, $height );

			imagesavealpha( $img, true );
			imagetruecolortopalette( $img, false, 1 );

			$color = imagecolorallocatealpha( $img, 0, 0, 0, 127 );

			imagefill( $img, 0, 0, $color );
			imagepng( $img, null, 9 );
			imagedestroy( $img );

			$data = ob_get_contents();

			ob_end_clean();

			$imgs[ $key ] = 'data:image/png;base64,' . base64_encode( $data );
		}

		return $imgs[ $key ];
	}

	private function isNumeric($value) {
		return is_numeric($value) && $value > 0;
	}

	public function dimensions($filename) {
		if ($filename && is_file(DIR_IMAGE . $filename)) {
			list($width, $height) = @getimagesize(DIR_IMAGE . $filename);

			if (!$width || !$height) {
				trigger_error('Image <b>' . DIR_IMAGE . $filename . '</b> is invalid!');
			}
		} else {
			$width = null;
			$height = null;
		}

		return array($width, $height);
	}

	public function resize($filename, $width = null, $height = null, $resize_type = '') {
		if (is_array($filename)) {
			$filename = Arr::get($filename, $this->config->get('config_language_id'));
		}

		// Interstore remote image
		if (Str::endsWith($filename, '.http')) {
			return trim(file_get_contents(DIR_IMAGE . $filename));
		}

		// svg image
		if (Str::endsWith($filename, '.svg')) {
			return $this->model_tool_image->resize($filename, $width, $height, $resize_type);
		}

		// external image
		if (Str::startsWith($filename, 'http://') || Str::startsWith($filename, 'https://')) {
			return $filename;
		}

		if (!$filename || !is_file(DIR_IMAGE . $filename)) {
			$filename = 'placeholder.png';
		}

		list($width_orig, $height_orig) = $this->dimensions($filename);

		if (!$this->isNumeric($width) && !$this->isNumeric($height)) {
			return $this->model_tool_image->resize($filename, $width_orig, $height_orig);
		}

		$ratio_orig = (float)$width_orig / $height_orig;

		if ($this->isNumeric($width) && $this->isNumeric($height)) {
			if ($resize_type === 'fill' || $resize_type === 'crop') {
				$ratio = (float)$width / $height;

				if ($ratio > $ratio_orig) {
					$resize_type = 'w';
				} else if ($ratio < $ratio_orig) {
					$resize_type = 'h';
				} else {
					$resize_type = '';
				}
			} else {
				$ratio = (float)$width / $height;

				if ($ratio > $ratio_orig) {
					$resize_type = 'h';
				} else if ($ratio < $ratio_orig) {
					$resize_type = 'w';
				} else {
					$resize_type = '';
				}
			}
		} else if ($this->isNumeric($width)) {
			$height = $width / $ratio_orig;
		} else {
			$width = $height * $ratio_orig;
		}

		return $this->model_tool_image->resize($filename, $width, $height, $resize_type);
	}

}
