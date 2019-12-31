<?php
class UploadVideoFormProvider {
    private $cn;
    public function __construct($cn) {
        $this->cn = $cn;
    }

    public function createUploadVideoForm() {
        $file = $this->fileInput();
        $text = $this->textInput(null);
        $textarea = $this->textareaInput(null);
        $privacyInput = $this->privacyInput(null);
        $submit = $this->submitButton();
        $categoriesInput = $this->categoriesInput(null);
        return "
            <form action='processing.php' name='videoUploadForm' id='videoUploadForm' method='POST' enctype='multipart/form-data'>
                $file
                $text
                $textarea
                $categoriesInput
                $privacyInput
                $submit
                </form>";
    }

    public function createEditVideoForm($video) {
        $text = $this->textInput($video->getTitle());
        $textarea = $this->textareaInput($video->getDescription());
        $privacyInput = $this->privacyInput($video->getPrivacy());
        $categoriesInput = $this->categoriesInput($video->getCategory());
        $saveButton = $this->saveButton();
        return "
            <form action='' method='POST'>
                $text
                $textarea
                $categoriesInput
                $privacyInput
                $saveButton
                </form>";
    }

    private function fileInput() {
        return "<div class='form-group'>
                <input type='file' class='form-control-file' name='file' id='file' placeholder='Video' required>        
            </div>";
    }

    private function textInput($text) {
        if($text == null) $text = "";
        return "<div class='form-group'>
                <input type='text' class='form-control' value='$text' name='title' id='title' placeholder='Title' required>
            </div>";
    }

    private function textareaInput($text) {
        if($text == null) $text = "";
        return "<div class='form-group'>
                <textarea name='description' id='description' class='form-control' cols='10' rows='2' placeholder='Description' required>$text</textarea>
            </div>";
    }

    private function categoriesInput($text) {
        if($text == null) $text = "";
        $query = $this->cn->prepare("SELECT * FROM categories");
        $query->execute();
    
        $element = "<div class='form-group'>
            <select class='form-control' name='categories' id='categories'>";

        while($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $id = $row["id"];
            $name = $row["name"];

            $selected = ($id == $text) ? "selected" : "";

            $element .= "<option value='$id' $selected>$name</option>";
        }

        $element .= "</select>
            </div>";

        return $element;
    }

    private function privacyInput($text) {
        if($text == null) $text = "";
        $privateSelected = ($text == 0) ? "selected" : "";
        $publicSelected = ($text == 1) ? "selected" : "";

        return "<div class='form-group'>
                <select class='form-control' name='privacyInput' id='privacyInput'>
                    <option value='0' $privateSelected>Private</option>
                    <option value='1' $publicSelected>Public</option>
                </select>
            </div>";
    }

    private function submitButton() {
        return "<div class='form-group'>
                <button type='submit' class='btn btn-primary' name='uploadButton'>UPLOAD</button>
            </div>";
    }

    private function saveButton() {
        return "<div class='form-group'>
                <button type='submit' class='btn btn-primary' name='saveButton'>Save</button>
            </div>";
    }
}
?>