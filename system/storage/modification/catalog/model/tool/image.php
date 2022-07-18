<?php
class ModelToolImage extends Model {
	public function resize($filename, $width, $height, $type = '') {
		if (!is_file(DIR_IMAGE . $filename) || substr(str_replace('\\', '/', realpath(DIR_IMAGE . $filename)), 0, strlen(DIR_IMAGE)) != str_replace('\\', '/', DIR_IMAGE)) {
			return;
		}

		$extension = pathinfo($filename, PATHINFO_EXTENSION);

		$image_old = $filename;
		$image_new = 'cache/' . utf8_substr($filename, 0, utf8_strrpos($filename, '.')) . '-' . (int)$width . 'x' . (int)$height . $type . '.' . $extension;

		if (!is_file(DIR_IMAGE . $image_new) || (filemtime(DIR_IMAGE . $image_old) > filemtime(DIR_IMAGE . $image_new))) {
			list($width_orig, $height_orig, $image_type) = getimagesize(DIR_IMAGE . $image_old);
				 
			if (!in_array($image_type, array(IMAGETYPE_PNG, IMAGETYPE_JPEG, IMAGETYPE_GIF))) { 
				return DIR_IMAGE . $image_old;
			}
						
			$path = '';

			$directories = explode('/', dirname($image_new));

			foreach ($directories as $directory) {
				$path = $path . '/' . $directory;

				if (!is_dir(DIR_IMAGE . $path)) {
					@mkdir(DIR_IMAGE . $path, 0777);
				}
			}

			if ($width_orig != $width || $height_orig != $height) {
				$image = new Image(DIR_IMAGE . $image_old);
				$image->resize($width, $height, $type);
				$image->save(DIR_IMAGE . $image_new);

                if (defined('JOURNAL3_ACTIVE')) {
                    if ($this->journal3->settings->get('performanceCompressImagesStatus')) {
                        \Journal3\Utils\Img::optimise(DIR_IMAGE . $image_new);
                    }
                }
            
			} else {
				copy(DIR_IMAGE . $image_old, DIR_IMAGE . $image_new);

                if (defined('JOURNAL3_ACTIVE')) {
                    if ($this->journal3->settings->get('performanceCompressImagesStatus')) {
                        \Journal3\Utils\Img::optimise(DIR_IMAGE . $image_new);
                    }
                }
            
			}
		}
		

                if (defined('JOURNAL3_ACTIVE')) {
                    if ($this->journal3->settings->get('performanceCompressImagesStatus')) {
                        $image_new = \Journal3\Utils\Img::cwebp($image_new);
                    }
                }
            
		$image_new = str_replace(' ', '%20', $image_new);  // fix bug when attach image on email (gmail.com). it is automatic changing space " " to +
		

                if (defined('JOURNAL3_STATIC_URL')) {
                    return JOURNAL3_STATIC_URL . 'image/' . $image_new;
                }
            
		if ($this->request->server['HTTPS']) {
			return $this->config->get('config_ssl') . 'image/' . $image_new;
		} else {
			return $this->config->get('config_url') . 'image/' . $image_new;
		}
	}
}
