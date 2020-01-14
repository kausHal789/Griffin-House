<?php
class VideoProcessor {
    
    private $cn, $videoSizeLimit = 500000000;
    private $types = array('mp4', 'mkv', 'flv', 'webm', 'vob', 'ogv', 'ogg', 'avi', 'wmv', 'mov', 'mpeg', 'mpg');
    private $ffmpegPath;
    private $ffprobePath;

    public function __construct($cn) {
        $this->cn = $cn;
        $this->ffmpegPath = realpath("ffmpeg/bin/ffmpeg.exe");
        $this->ffprobePath = realpath("ffmpeg/bin/ffprobe.exe");
    }

    public function upload($videoUploadData) {
        $targetDir = "storage/public/videos/";
        // echo "videoProcessor<br>";
        $videoData = $videoUploadData->videoData;
        $tmpFileName = $targetDir . uniqid() . basename($videoData["name"]);
        $tmpFileName = str_replace(" ", "", $tmpFileName);
        // var_dump($videoData);
        // die("okay");
        $isValidData = $this->processData($videoData, $tmpFileName);

        if(! $isValidData) {
            return false;
        }

        if(move_uploaded_file($videoData['tmp_name'], $tmpFileName)) {

            $finalFilePath = $targetDir . uniqid() . ".mp4";
            
            
            if(! $this->convertToMp4($tmpFileName, $finalFilePath)) {
                echo "Upload fail";
                return false;   
            }
            
            if(! $this->insertVideoData($videoUploadData, $finalFilePath)) {
                echo "insert query failed";
                return false;
            }
            
            if(! $this->deleteTempVideo($tmpFileName)) {
                echo "Upload fail";
                return false;   
            }
            

            if(! $this->generateThumbnails($finalFilePath)) {
                echo "Upload fail - Could not generate Thumbnails";
                return false;   
            }
            
            // echo "Video is Succesfully uploaded";
            return true;
        } else {
            echo "Server problem please try again later";
            return false;
        }
    }

    private function processData($videoData, $tmpFileName) {
        $videoType = pathinfo($tmpFileName, PATHINFO_EXTENSION);
        // print_r($videoType);

        if(! $this->isValidSize($videoData)) {
            echo "Video too larage, Can't be more then " . $this->videoSizeLimit . " bytes";
            return false;
        } else if(! $this->isValidExtention($videoType)) {
            echo "Invalid file type";
            return false;   
        } elseif($this->hasError($videoData)) {
            echo "Something went wrong please try again";
            return false;
        }

        return true;
    }

    private function isValidSize($videoData) {
        return $videoData['size'] <= $this->videoSizeLimit;
    }

    private function isValidExtention($type) {
        $lowerCased = strtolower($type);
        return in_array($lowerCased, $this->types);
    }

    private function hasError($videoData) {
        return $videoData['error'] != 0;
    }

    private function insertVideoData($videoUploadData, $finalFilePath) {
        $query = $this->cn->prepare("INSERT INTO videos(username, title, description, category, privacy, url)
        VALUES(:username, :title, :description, :category, :privacy, :url)");

        $query->bindParam(":username", $videoUploadData->username);
        $query->bindParam(":title", $videoUploadData->title);
        $query->bindParam(":description", $videoUploadData->description);
        $query->bindParam(":category", $videoUploadData->category);
        $query->bindParam(":privacy", $videoUploadData->privacy);
        $query->bindParam(":url", $finalFilePath);

        return $query->execute();
    }

    public function updateVideoData($videoUploadData, $videoId) {
        $query = $this->cn->prepare("UPDATE videos 
            SET title=:title, description=:description, category=:category, privacy=:privacy 
            WHERE username=:username AND id=:videoId");

        $query->bindParam(":username", $videoUploadData->username);
        $query->bindParam(":videoId", $videoId);
        $query->bindParam(":title", $videoUploadData->title);
        $query->bindParam(":description", $videoUploadData->description);
        $query->bindParam(":category", $videoUploadData->category);
        $query->bindParam(":privacy", $videoUploadData->privacy);

        return $query->execute();
    }

    private function convertToMp4($tmpFileName, $finalFilePath) {
        $cmd = "$this->ffmpegPath -i $tmpFileName $finalFilePath 2>&1";
        $outputLog = array();
        exec($cmd, $outputLog, $returnCode);
        if($returnCode != 0) {
            foreach($outputLog as $line) {
                echo $line . "<br>";
            }
            return false;
        }
        return true;
    }

    private function deleteTempVideo($tmpFileName) {
        if(! unlink($tmpFileName)) {
            echo "Could not delete\n";
            return false;
        }
        return true;
    }

    private function generateThumbnails($filePath) {
        // This $filePath is a finalUploadedPath
        $thumbnailSize = "210x118";
        $numThumbnail = 3;
        $oldThumbnailPath = "storage/public/videos/thumbnails";

        $videoDuration = $this->getVideoDuration($filePath);
        // $videoDuration = (int)$videoDuration;
        $video_id = $this->cn->lastInsertId();
        if(! $this->updateDuration($videoDuration, $video_id)) {
            echo "not duration genetated\n";
        }

        for($i = 1; $i <= $numThumbnail; $i++) {
            $imageName = uniqid() . ".jpg";
            $tmp = uniqid();
            $interval = ($videoDuration * 0.8) / $numThumbnail * $i;
            $thumbnailPath = "$oldThumbnailPath/$video_id-$tmp-$imageName"; // This is new Thubmnail Path

            /**
             * -i : Input file name
             * -ss : Interval in sec
             * -s : Size of Thumbnails
             * -vframes : Numbers of thumbnail 
             * */ 

            $cmd = "$this->ffmpegPath -i $filePath -ss $interval -s $thumbnailSize -vframes 1 $thumbnailPath";
            $outputLog = array();
            exec($cmd, $outputLog, $returnCode);
            if($returnCode != 0) {
                foreach($outputLog as $line) {
                    echo $line . "<br>";
                }
            }

            $query = $this->cn->prepare("INSERT INTO thumbnails (video_id, url, selected) 
                VALUES(:video_id, :url, :selected)");

            $query->bindParam(":video_id", $video_id);
            $query->bindParam(":url", $thumbnailPath);
            $query->bindParam(":selected", $selected);
            $selected = $i == 1 ? 1 : 0;
            $success = $query->execute();

            if(! $success) {
                echo "Error in inserting Thumbnails\n";
            }
        }
        return true;
    }

    private function getVideoDuration($filePath) {
        return (int)shell_exec("$this->ffprobePath -v error -show_entries format=duration -of default=noprint_wrappers=1:nokey=1 $filePath");
    }

    private function updateDuration($duration, $video_id) {
        // echo "This is duration\n";
        // $duration = (int)$duration;
        $hour = floor($duration / 3600);
        $min = floor(($duration - ($hour*3600)) / 60);
        $sec = floor($duration % 60);

        $hour = ($hour < 1) ? "" : $hour . ":";
        $min = ($min < 10) ? "0" . $min . ":" : $min . ":";
        $sec = ($sec < 10) ? "0" . $sec : $sec;
        
        $duration = $hour.$min.$sec;

        $query = $this->cn->prepare("UPDATE videos SET duration=:duration WHERE id=:id");
        $query->bindParam(":duration", $duration);
        $query->bindParam(":id", $video_id);

        return $query->execute();
    }
}
?>